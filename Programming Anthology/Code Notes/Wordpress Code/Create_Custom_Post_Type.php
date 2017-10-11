<?php 
// Custom Post Type Team
function custom_post_team() {
    $labels = array(
	'name' => _x('Team', 'post type general name'),
	'singular_name' => _x('Team', 'post type singular name'),
	'add_new' => _x('Add New', 'member'),
	'add_new_item' => __('Add New Member'),
	'edit_item' => __('Edit Team'),
	'new_item' => __('New Team'),
	'all_items' => __('All Member'),
	'view_item' => __('View Member'),
	'search_items' => __('Search Members'),
	'not_found' => __('No member found'),
	'not_found_in_trash' => __('No member found in the Trash'),
	'parent_item_colon' => '',
	'menu_name' => 'Team'
    );
    $args = array(
	'labels' => $labels,
	'description' => 'Holds our team and team specific data',
	'public' => true,
	'menu_position' => 5,
	'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
	'has_archive' => true,
    );
    register_post_type('team', $args);
}

add_action('init', 'custom_post_team');