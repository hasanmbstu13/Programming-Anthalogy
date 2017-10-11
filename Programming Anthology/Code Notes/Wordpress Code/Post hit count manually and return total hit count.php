<?php 
// Enqueue the ajax url
wp_localize_script( 'main', 'dt_ajax_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

// PHP Code for count hit manually as well as return total hit
add_action( 'wp_ajax_register_action_hook', 'hit_count' );
add_action( 'wp_ajax_nopriv_register_action_hook', 'hit_count' );

function hit_count(){	
	$url_segments 		= explode("/",$_GET['url']);
	$slug 	= array_slice($url_segments, -2, 1);
	$args = array(
	  'name'        => $slug[0],
	  'post_type'   => 'post',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	
	$current_post = get_posts($args);
	$post_id = $current_post['0']->ID;

	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($post_id, $count_key, true);
	if($count==''){
	    $count = 0;
	    delete_post_meta($post_id, $count_key);
	    add_post_meta($post_id, $count_key, '0');
	}else{
	    $count++;
	    update_post_meta($post_id, $count_key, $count);
	}

	// hit count
	$count_key = 'wpb_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0 View";
    }
	//     // return $count.' Views';

	$response = json_encode(array(
	    'status' => 'success',
	    'post_hit' => $count
	  ));
	 header( "Content-Type: application/json" );
	 echo $response;
	 die();

}


?>
<script type="text/javascript">
	// Javascript code for Ajax request
	// View post hit count by ajax request
	jQuery.ajax({
		    url: dt_hit_count_ajax_obj.ajaxurl,
		    type: 'GET',
		    data: {
		        action: 'register_post_hit_count_hook',
		        url   : window.location.href,
		    },
		    cache: false,
		    success: function( data,response ) {
		    	// console.log(data.post_id);
			     if(data.status == 'success'){
			     	// console.log('success.....');
			     	console.log(data);
			     	// console.log('Total hit of this post is: ' + data.post_hit);
			     }else{
			     	console.log(data);
			     	console.log('sorry database not updated');
			     }
		    },
	});


</script>
