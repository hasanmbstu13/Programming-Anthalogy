// Display the image that are present in the theme directory
<img src="<?php echo bloginfo('template_url'); ?>/product-images/prod-supersprocket.png" alt="Image of Super Sprocket 1000" />

// Include different template files
    To include the header, use <?php get_header() ?>
    To include the sidebar, use <?phpget_sidebar()?>
    To include the footer, use <?php get_footer() ?>
    To include the search form, use <?php get_search_form()?>
    To include custom theme files, use <?php get_template_part()?>

<!-- Wordpress recognize a page as a template by writng Template Name in comment -->
<!-- Product Page template will parse those page where the template page is product page -->
<?php  
	// Wordpress recognize a template by following code
	// We create template to serve our own purpose
	// If we need a page where custom things are needed but wordpress doesn't fullfill this 
	// then we create our own custom template to serve our own purposes
	
	/*
		Template Name: Product Page
	 */
	
		// Get cusomt field by following code
		// $post->ID take a the post id
		echo get_post_meta($post->ID, 'product_large', true);
		// Here, true means return us string not array
		// False means return an array
	
	// if we need only single post not multiple then use simply the_post();
	the_post();

	// No need to use query_posts();
	query_posts();
?>
<!--  To check template and add stylesheet as follows -->
	<?php if(is_page_template('page-category.php')) { ?>
		    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/store.css">
	<?php } ?>


<?php 
	// If we only need the text not paragrap in the content
	// Then use
	echo get_the_content();

	// register_nav_menus This function automatically registers multiple custom menu support for the theme, 
	// therefore you do not need to call add_theme_support( 'menus' );
	register_nav_menus( array(
		'pluginbuddy_mobile' => 'PluginBuddy Mobile Navigation Menu',
		'footer_menu' => 'My Custom Footer Menu',
		'primary-menu' => 'Primary Menu',
	) );

	// Displaying The Menu
	if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */
	      wp_nav_menu( array( 'theme_location' => 'primary-menu') ); 
	}
