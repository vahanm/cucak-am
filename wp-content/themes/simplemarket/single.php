<?php
/**
 * Single
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<section id="content" role="main">
	<?php /* ?>
	<div class="postpagination" style="margin-bottom: 10px;">
		<div class="postpagination-previous"><?php next_post_link( '%link', '%title', true, '' ); ?></div>
		<div class="postpagination-next"><?php previous_post_link( '%link', '%title', true, '' ); ?></div>
	</div>
	<?php */ ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
			get_template_part( 'content', 'single' );
			simplemarket_pagination();
			comments_template( '', true ); 
	endwhile; ?>
		
	<?php /* ?>
	<div class="postpagination" style="margin-top: 10px;">
		<div class="postpagination-previous"><?php next_post_link( '%link', '%title', true, '' ); ?></div>
		<div class="postpagination-next"><?php previous_post_link( '%link', '%title', true, '' ); ?></div>
	</div>
	<?php */ ?>
</section>
<?php get_footer() ?>