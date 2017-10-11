<?php 
// Enque the ajax url
wp_localize_script( 'child-script', 'dt_ajax_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

// php code
add_action( 'wp_ajax_register_action_hook', 'checked_user_logged_in' );
function checked_user_logged_in() {
    if ( is_user_logged_in() ) {    	
    	$url_segments 		= explode("/",$_GET['url']);
    	$slug 	= array_slice($url_segments, -2, 1);
    	$args = array(
    	  'name'        => $slug[0],
    	  'post_type'   => 'post',
    	  'post_status' => 'publish',
    	  'numberposts' => 1
    	);
    	
    	$current_post = get_posts($args);
		if($current_post){
			$edit_link = get_edit_post_link($current_post['0']->ID);    	
	    	$response = json_encode(array(
	    	    'status' => 'success',
	    	    'message' => 'logged in!',
	    	    'post_id' => $current_post['0']->ID,
	    	    'edit_link' => $edit_link,
	    	    'slug' => $slug[0]
	    	  ));
	    	 header( "Content-Type: application/json" );
	    	 echo $response;
	    	 die();
	    }
	    	 
    } else {
    }
}

?>

<script type="text/javascript">
	// js code for ajax request
	//Generate edit link
		jQuery.ajax({
		    url: dt_ajax_obj.ajaxurl,
		    type: 'GET',
		    data: {
		        action: 'register_action_hook',
		        url   : window.location.href,
		    },
		    cache: false,
		    // dataType: json,
		    success: function( data,response ) {
		    	// console.log(data.post_id);
			     if(data.status == 'success'){
			     
		    	 	jQuery('<div id="edit-article" style="text-align:right"><a href="#" target="_blank">Edit this article</a></div>').prependTo('body');
		    	 	jQuery('#edit-article a').attr('href',data.edit_link.replace('&amp;', '&') );
			     	
			     }else{
			     	console.log('nope...');
			     }
		    },
		});
</script>
