<?php

/**
* 	CUSTOM THEME function definitions
*/

//===========================
// IMPORTANT!!!
// remove all unused features from this file!!!

include('inc/mainMenuWalker.class');
include('inc/instagram.class');
include_once('inc/resize-image.php');
if(!class_exists('Abraham\TwitterOAuth\TwitterOAuth')){
	include_once('inc/abraham/twitteroauth/autoload.php');
}
use Abraham\TwitterOAuth\TwitterOAuth;

function modify_jquery() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery

        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', false, '2.1.0');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modify_jquery');



// include custom theme javascript files
add_action('wp_print_scripts', 'custom_print_scripts', 20);
function custom_print_scripts(){
	
	//disable scripts for admin
	if( is_admin() ) return;
	
	// use our jquery build instead of standard wp
	//wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery', theme( 'js/jquery-1.xx.min.js', false ), array(), '1.xx', true ); // set path to your jquery file and jquery version
	
	$scripts = array(
		// TODO: add additional scripts if you need
		//
		'main.js'
	);
	
	foreach($scripts as $script){
		wp_enqueue_script( $script, esc_url( get_template_directory_uri()) . '/js/' . $script, array( 'jquery' ) ); 
	}
}
 

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function custom_theme_setup() {

	// init menu placeholders
	register_nav_menu( 'primary', 'Header Menu' );
	register_nav_menu( 'footer', 'Footer Menu' ); // delete if you don't have this

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// default thumbnail size: change to what you use in your theme
	$content_width = 580; // change to what you use
	$half_width = (int)($content_width/2);
	$quater_width = (int)($content_width/4);
	set_post_thumbnail_size( $quater_width, $quater_width, $crop = true );
	
	// set default sizes for image uploader
	add_image_size( 'thumbnail', $quater_width, $quater_width, $crop = true ); // used for small thumbs, quarter size
	add_image_size( 'medium', $half_width, (int)($half_width*0.75) ); // used for medium images in content (half of the content width)
	add_image_size( 'large', $content_width, (int)($content_width*0.75) ); // full width content image
	add_image_size( 'mobile_slide', 640, 1078, $crop = true ); // mobile slide
	add_image_size( 'slide', 1600, 866, $crop = true ); // full width slide
	add_image_size( 'employee', 529, 438, $crop = true ); // employee size
	add_image_size( 'film', 533, 497, $crop = true ); // film size
	add_image_size( 'news', 800, 374, $crop = true ); // film size
    add_image_size( 'news-instagram', 380, 355, $crop = true ); // instagram image size
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


/**
 * Sets the post excerpt length to 40 words.
 */
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );


function custom_continue_reading_link(){
	return '<a href="'. esc_url( get_permalink() ) . '">Continue reading <span class="meta-nav">&rarr;</span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and continue_reading_link.
 */
function custom_excerpt_more( $more ) {
	return ' &hellip; '.custom_continue_reading_link();
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function custom_users_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= custom_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'custom_users_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function custom_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'custom_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. 
 */
function custom_widgets_init() {

	register_sidebar( array(
		'name' => 'Main Sidebar',
		'id' => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'custom_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function custom_content_page_nav( $nav_id, $query_class = NULL ){
	if( is_null($query_class) ){
		global $wp_query;
		$query_class = $wp_query;
	}
	
	if ( $query_class->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text">Post navigation</h3>
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
			<div class="nav-next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav><!-- #nav-<?php echo $nav_id; ?> -->
	<?php endif;
}

// Prints HTML with meta information for the current post-date/time and author.
function the_posted_on() {
	$posted_on = '<span class="meta-prep-date">Posted on</span>';
	$posted_on .= ' <span class="entry-date">'.get_the_date().'</span> ';
	$posted_on .= ' <span class="meta-sep">by</span> ';
	$posted_on .= '<a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a>';
	echo $posted_on;
}

// Prints HTML with meta information for the current post (category, tags and permalink).
function the_posted_in() {
	$show_sep = false;
	if ( 'post' != get_post_type() )
		return $show_sep;
	
	$posted_in = '';
	if ( count( get_the_category() ) ) {
		$posted_in .= '<span class="entry-utility-prep entry-utility-prep-cat-links">Posted in</span> ' . get_the_category_list( ', ' );
		$show_sep = true;
	}
	
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ){
		if( $show_sep ){
			$posted_in .= ' <span class="sep">|</span> ';
		}
		$posted_in .= '<span class="entry-utility-prep entry-utility-prep-tag-links">Tagged</span> ' . $tags_list;
		$show_sep = true;
	}
	
	echo $posted_in;
	
	if ( comments_open() ) : ?>
		<?php if ( $show_sep ) : ?>
		<span class="sep"> | </span>
		<?php endif; // End if $show_sep ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment' ), __( '1 Comment' ), __( '% Comments' ) ); ?></span>
	<?php
	endif; 
}

// add filter for the content to have the ability include images from theme with simple shorttag
add_filter('the_content', 'custom_the_content');
function custom_the_content($content){
	$content = str_replace('"~images/', '"'.theme('images/', 0), $content);
	
	return $content;
}

if( ! function_exists('pa') ) :
function pa($mixed, $stop = false) {
	$ar = debug_backtrace(); $key = pathinfo($ar[0]['file']); $key = $key['basename'].':'.$ar[0]['line'];
	$print = array($key => $mixed); echo( '<pre>'.(print_r($print,1)).'</pre>' );
	if($stop == 1) exit();
}
endif;

function theme( $path, $echo = 1 ){
	$path = get_template_directory_uri().'/'.$path;
	if( $echo )
		echo $path;
	return $path;
}

function url( $uri, $echo = 1 ){
	$url = home_url( '/' ).$uri;
	if( $echo )
		echo $url;
	return $url;
}


function get_attachment_id_from_src ($src) {
  global $wpdb;
  $reg = "/-[0-9]+x[0-9]+?.(jpg|jpeg|png|gif)$/i";
  $src1 = preg_replace($reg,'',$src);

  if($src1 != $src){
      $ext = pathinfo($src, PATHINFO_EXTENSION);
      $src = $src1 . '.' .$ext;
  }
  $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$src'";
  $id = $wpdb->get_var($query);
  return $id;
}

// Home slider data
function get_home_slider(){
    $slides_args = array(
        'post_type' => 'heropost',
        'post_per_page' => -1,
        'post_status' => 'publish',
    );
    $items = array();
    $slides = get_posts($slides_args);
    foreach($slides as $slide){
        $items[] = slide_item($slide);
    }
    return $items;
}

// Create slider's items
function slide_item($slide){
    $item = new stdClass();
    $video_shortcode = str_replace('][/video]', ' ][/video]', $slide->post_content);
    $video_atts = shortcode_parse_atts($video_shortcode);
    $item->video = $video_atts['mp4'];
    $item->title = $slide->post_title;
    $item->image_mobile = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'mobile_slide');
    $item->image = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'slide');
    $item->description = get_post_meta($slide->ID, '_field_textarea__1442417517', true);
    $item->herowork = get_post_meta($slide->ID, '_herowork', true);
    return $item;
}

add_action('wp_ajax_nopriv_more_employees', 'get_employees');
add_action('wp_ajax_more_employees', 'get_employees');

// Get all employees
function get_employees(){
    $employees_args = array(
        'post_type' => 'employee',
        'post_status' => 'publish',
        'order' => 'ASC'
    );
    if(!empty($_POST['paged'])){
        $employees_args['posts_per_page'] = '';
        $employees_args['offset'] = 7;
    }
    else{
        $employees_args['posts_per_page'] = -1;
    }
    $employees = get_posts($employees_args);
    foreach($employees as $employee){
        $items[] = employee_item($employee);
    }
    if(!empty($_POST['paged'])){
        if(!empty($items)){
            foreach($items as $employee){
                $html .= '<section class="about-item about-human-item js-added" id="' . $employee->id . '">
                    <div class="about-photo">
                        <img src="' . $employee->preview[0] . '" alt="" class="green-photo svg-filter">
                        <picture class="hover-photo">
                            <!--[if IE 9]><video style="display: none;"><![endif]-->
                            <source srcset="' . $employee->image[0] . '" media="(min-width: 768px)">
                            <!--[if IE 9]></video><![endif]-->
                            <img src="' . $employee->image[0] . '" alt="">
                        </picture>
                        <div class="photo-title">
                            <h3>' . $employee->title . '</h3>
                            <h4>' . $employee->position . '</h4>
                        </div>
                    </div>
                    <div class="about-desc">
                        <h3>' . $employee->title . '</h3>
                        ' . $employee->content . '
                        <div class="close icon-close"></div>
                    </div>
                </section>';
            }
            echo $html;
        }
        exit();
    }
    else{
        return $items;
    }
    
}

// Create slider's items
function employee_item($employee){
    $preview = get_post_meta($employee->ID, '_field_uploadmedia__1442417621',true);
    $item = new stdClass();
    $item->title = $employee->post_title;
    $item->content = $employee->post_content;
    $item->preview = wp_get_attachment_image_src(get_attachment_id_from_src($preview[0]['image']), 'employee');
    $item->image = wp_get_attachment_image_src(get_post_thumbnail_id($employee->ID), 'employee');
    $item->position = get_post_meta($employee->ID, '_field_inputtext__1442417632', true);
    $item->id = $employee->post_name;
    return $item;
}

// Add global js variable
add_action ( 'wp_head', 'eleven_js_variables' );
function eleven_js_variables(){ ?>
  <script type="text/javascript">
    var ajaxurl = <?php echo json_encode( admin_url( "admin-ajax.php" ) ); ?>;      
  </script><?php
}

// Get slug for page or post
function get_the_slug($id = false) {
    global $post;

    if ( is_single() || is_page()) {
        return $post->post_name;
    }
    else {
        return "";
    }
}

// Get categories of works
function get_works_categories(){
    $cat_args = array(
        'type'             => 'film',
        'taxonomy'    => 'category',
        'orderby'                  => 'name',
        'order'                    => 'DESC',
    );
    $works_categories = get_categories($cat_args);
    return $works_categories;
}

// Get works
function get_works($category = ''){
    $works_args = array(
        'post_type' => 'film',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'category_name' => $category
    );

    $works = get_posts($works_args);

    foreach($works as $work){
        $items[] = work_item($work);
    }
    return $items;
}

// Create work items
function work_item($work){
    $item = new stdClass();
    $item->title = $work->post_title;
    $item->description = get_post_meta($work->ID, '_field_inputtext__1442417677', true);
    $item->image = wp_get_attachment_image_src(get_post_thumbnail_id($work->ID), 'film');
    $item->link = get_permalink($work->ID);
    return $item;
}

//Get posts from instagram
function get_posts_from_instagram($params = array()){
    $eleven_settings = get_option('Eleven');
    $app = array(
        'apiKey'      => $eleven_settings['instagram_client_id'],
        'apiSecret'   => $eleven_settings['instagram_client_secret'],
        'apiCallback' => ''
    );
    $posts = array();
    $user_name = $params['user_name'];
    $tag = $params['tag'];
    $limit = $params['limit'];
    $instagram = new Instagram( $app );
    if(!empty($user_name) && !empty($tag)){
        $user = $instagram->searchUser($user_name, $limit);
        $media = $instagram->getUserMedia($user->data[0]->id, $limit);
        foreach($media->data as $data) {
            if(!empty($tag) && in_array($tag, $data->tags)){
                $posts[] = $data;
            }
        }
    }
    elseif(!empty($user_name) && empty($tag)){
        $user = $instagram->searchUser($user_name, $limit);
        $media = $instagram->getUserMedia($user->data[0]->id, $limit);
        foreach($media->data as $data) {
            $posts[] = $data;
        }
    }
    elseif(empty($user_name) && !empty($tag)){
        $media = $instagram->getTagMedia($tag, $limit);
        foreach($media->data as $data) {
            $posts[] = $data;
        }
    }
    return $posts; 
}

function twitter_connect(){
	$twitter_section = get_option('Eleven');
	$twitter_customer_key           = !empty($twitter_section['twitter_customer_key'])        ? $twitter_section['twitter_customer_key']        : '';
	$twitter_customer_secret        = !empty($twitter_section['twitter_customer_secret'])     ? $twitter_section['twitter_customer_secret']     : '';
	$twitter_access_token           = !empty($twitter_section['twitter_access_token'])        ? $twitter_section['twitter_access_token']        : '';
	$twitter_access_token_secret    = !empty($twitter_section['twitter_access_token_secret']) ? $twitter_section['twitter_access_token_secret'] : '';
	$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);
	return $connection;
}

//Get posts from twitter
function get_posts_from_twitter($params = array(), $connection){
        $user_name = $params['user_name'];
        $tag = $params['tag'];
        $limit = $params['limit'];
        $posts = array();

        if(!empty($user_name) && !empty($tag)){
            $my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $user_name, 'count' => $limit));
            $hasTweetErrors = !empty($my_tweets->errors) && is_array($my_tweets->errors) && count($my_tweets->errors);
            if(!$hasTweetErrors){
                foreach($my_tweets as $tweet){
                    if(!empty($tweet->entities->hashtags)){
                        foreach($tweet->entities->hashtags as $tags){
                            if(in_array(str_replace('#', '', $tag), (array)$tags)){
                                $posts[] = $tweet;
                            }
                        }
                    }
                }
            }
        }
        elseif(!empty($user_name) && empty($tag)){
            $my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $user_name, 'count' => $limit));
            $hasTweetErrors = !empty($my_tweets->errors) && is_array($my_tweets->errors) && count($my_tweets->errors);
            if(!$hasTweetErrors){
                foreach($my_tweets as $tweet){
                    $posts[] = $tweet;
                }
            }
        }
        elseif(empty($user_name) && !empty($tag)){
            $my_tweets = $connection->get('search/tweets', array('q' => $tag));
            $hasTweetErrors = !empty($my_tweets->errors) && is_array($my_tweets->errors) && count($my_tweets->errors);
            if(!$hasTweetErrors){
                foreach($my_tweets as $tweet){
                    $posts[] = $tweet;
                }
            }
        }
        return $posts;
}

//Get news
function get_news(){
    $posts = get_posts(array('posts_per_page' => -1));
    foreach($posts as $post){
        $news[] = article_item($post);
    }
    return $news;
}

// Create article items
function article_item($post){
    $item = new stdClass();
    $item->title = $post->post_title;
    $item->content = apply_filters('the_content', $post->post_content);
    $item->image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'news');
    $item->date1 = date('M d', strtotime($post->post_date));
    $item->date2 = date('Y-m-d', strtotime($post->post_date));
    $item->link = get_permalink($post->ID);
    return $item;
}


//Add class for 404 page in body
function error_class( $classes ) {
    if(is_404()){
        $classes[] = 'error-page';
    } 
    return $classes;
}
add_filter( 'body_class', 'error_class' );

// register the meta box for herowork
add_action( 'add_meta_boxes', 'eleven_select_work' );
add_action( 'admin_init', 'eleven_select_work', 1 );

function eleven_select_work() {
    add_meta_box(
        'eleven_select_work_id',
        'Select work page',
        'get_works_for_select',
        'heropost',
        'normal',
        'default'
    );
}

// display the metabox for herowork
function get_works_for_select( $post ) {
	$work_meta = get_post_meta($post->ID, '_herowork', true);
    $works = get_works();
	$works_options .= '<option value="" ' . ($work_meta == '' ? 'selected="selected"' : '') . '>---</option>';
	foreach($works as $key => $work){
		$works_options .= '<option value="' . $work->link . '" ' . ($work->link == $work_meta ? 'selected="selected"' : '') . '>' . $work->title . '</option>';
	}

	echo '
		<select name="herowork">
			' . $works_options . '
		</select>
	';
}

// save data for herowork
add_action( 'save_post', 'save_works_for_hero' );
function save_works_for_hero($post_id) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

	if ( !current_user_can( 'edit_post', $post_id ) )
	return;

    if ( isset( $_POST['herowork'] ) )
	update_post_meta( $post_id, '_herowork', $_POST['herowork'] );
}