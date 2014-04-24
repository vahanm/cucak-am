<?php
/**
 * Index main page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<section id="content" role="main">
<?php
	helper_filters();

	simplemarket_viewmodes();

	while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
		endwhile;
	
	simplemarket_pagination(); ?>
</section>
<?php

get_footer();