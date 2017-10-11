<?php 
 // Query Posts example
 $args = array(
    'post_type'=> 'movie',
    'actor'    => 'Bruce Campbell, Chuck Norris',
    'order'    => 'ASC'
);
query_posts( $args );

if ( have_posts() ) :
	// The Loop
	while ( have_posts() ) : the_post();
	    echo '<li>';
	    	the_title();
	    echo '</li>';
	endwhile;
endif;
// Reset Query
wp_reset_query();

// wp-query argument list github
// https://gist.github.com/luetkemj/2023628
// wp-query
// https://codex.wordpress.org/Class_Reference/WP_Query
// Wordpress pagination
// https://codex.wordpress.org/Pagination


// Another loop
$the_query = new WP_Query( $args );
// The Loop
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  // Do Stuff
endwhile;
endif;
// Reset Post Data
wp_reset_postdata();

// Another example to extract data in wordpress
 $args = array(
  	 	'category_name' => 'News', // extract only those posts who has category news
  	    'post_type'=> 'post',
  	    'posts_per_page' => 1,
  	    'order'    => 'DESC',
  	    'orderby'  => 'date'
  	);
$posts_array = get_posts( $args );
foreach ( $posts_array as $post ) : setup_postdata( $post ); 
	echo get_the_date(); // use this when we need date in multiple times because when we use 
						 // only the_date() it returns date in first time in other case it will return null
	the_title();
	echo get_the_title(); // Print the current post’s title
	the_permalink(); //Displays the URL for the permalink to the post currently being processed in The Loop
	
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		the_post_thumbnail_url($size); // use this if we need only the image url not the image
		the_post_thumbnail_url();                  // without parameter -> 'post-thumbnail'		 
		the_post_thumbnail_url( 'thumbnail' );       // Thumbnail (default 150px x 150px max)
		the_post_thumbnail_url( 'medium' );          // Medium resolution (default 300px x 300px max)
		the_post_thumbnail_url( 'large' );           // Large resolution (default 640px x 640px max)
		the_post_thumbnail_url( 'full' );            // Full resolution (original size uploaded)		 
		the_post_thumbnail_url( array(100, 100) );  // Other resolutions
?>

<!-- Post Thumbnail Linking to the Post Permalink -->
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<img src="<?php the_post_thumbnail_url(); ?>"/>
</a>

<!-- Use the_title_attribute() instead of get_the_title() if you’re outputting the post title for html attributes. -->
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

<?php	} ?>
<?php endforeach; wp_reset_postdata(); ?>