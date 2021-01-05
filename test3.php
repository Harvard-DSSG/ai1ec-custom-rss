<?php 
// Set the arguments for the query
require('../../../wp-blog-header.php');
$args = array( 
  'posts_per_page'	=> -1, // -1 is for all
  'post_type'		=> 'ai1ec_event', // or 'post', 'page'
  //'orderby' 		=> 'date', // or 'date', 'rand'
  //'order' 		=> 'DESC', // or 'DESC'
  'tax_query' 		=> array(
        array(
            'taxonomy' => 'events_categories',
            'field'    => 'slug',
            'terms'    => 'dssg',
        ),
    ),
  //'tag'			=> 'dssg',
  //'category' 		=> $category_id,
  //'exclude'		=> get_the_ID()
  // ...
  // http://codex.wordpress.org/Template_Tags/get_posts#Usage
);

// Get the posts
$the_query = new WP_Query($args);
//print_r($the_query);
$the_query = sort_by_date(array('query' => $the_query, 'order' => 'DESC'));
if ( $the_query->have_posts() ) {
    header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
    echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
    ?>
    <rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>
    >
    <channel>
        <title>Harvard University Digital Scholarship Support Group - Event Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss("description") ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <?php the_generator( 'rss2' ); ?>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
    <?php
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
	?>
	<item>
		<title><?php the_title_rss(); ?></title>
		<link><?php the_permalink_rss(); ?></link>
		<dc:creator><?php the_author(); ?></dc:creator>
		<testDate><?php
			echo ai1ec_next_occurrence_shortcode_render(array('format' => 'D, d M Y H:i:s -0400'));
		?></testDate>
		<?php the_category_rss(); ?>
        	<guid isPermaLink="false"><?php the_guid(); ?></guid>
	</item>
	<?php
	}
	?>
	</channel>
	</rss>
	<?php
}
/* Restore original Post Data */
wp_reset_postdata();
