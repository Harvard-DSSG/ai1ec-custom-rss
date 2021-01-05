<?php 
// Set the arguments for the query
require('../../../wp-blog-header.php');
$args = array( 
  'posts_per_page'	=> -1, // -1 is for all
  'post_type'		=> 'ai1ec_event', // or 'post', 'page'
  'orderby' 		=> 'date', // or 'date', 'rand'
  'order' 		=> 'DESC', // or 'DESC'
  //'category' 		=> $category_id,
  //'exclude'		=> get_the_ID()
  // ...
  // http://codex.wordpress.org/Template_Tags/get_posts#Usage
);

// Get the posts
$the_query = new WP_Query($args);
// The Loop
if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
	$cats = get_the_category_list();
        echo '<li>' . get_the_title() . ' ' . '</li>';
	echo($post->ID);
	$post_tags = get_the_terms($post->ID, 'categories');
	var_dump($post_tags);
	var_dump($cats); 
	if ( $post_tags ) {
    		foreach( $post_tags as $tag ) {
    			echo $tag->name . ', '; 
    		}
	}
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
