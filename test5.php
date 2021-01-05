<?php 
require('../../../wp-blog-header.php');
/**$args = array( 
  'posts_per_page'      => -1, // -1 is for all
  'post_type'           => 'page',//'ai1ec_event', // or 'post', 'page'
  'orderby'             => 'date', // or 'date', 'rand'
  'order'               => 'DESC', // or 'DESC'
  //'meta_query'                => array(
  //    array(
  //            key => '_yoast_wpseo_primary_events_categories',
  //            value => '11'
  //    )
  //)
  //'category'          => $category_id,
  //'exclude'           => get_the_ID()
  // ...
  // http://codex.wordpress.org/Template_Tags/get_posts#Usage
);
**/
// Get the posts
//$the_query = new WP_Query($args);

//print_r($the_query);
$the_query = new WP_Query( array( 'post_type' => 'ai1ec_event', 'posts_per_page' => -1 ));
//print_r($the_query->posts);
if ($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        the_title();
endwhile;
endif;
