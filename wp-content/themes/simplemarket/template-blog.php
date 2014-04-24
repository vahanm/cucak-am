<?php
/**
 * Blog or news custom template
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
/*
Template Name: blog
*/
?>
<?php get_header(); ?>
<section id="content" role="main">
	<?php rewind_posts();
		$page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=10&paged=$page");
		while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
		endwhile; 
		simplemarket_pagination();
	?>
</section>
<?php get_sidebar(); ?>
<?php get_footer() ?>
