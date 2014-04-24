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
<section id="content" role="main">
	<nav class="postpagination">
		<div class="postpagination-previous"><?php next_post_link( '%link', '%title', true, '' ); ?></div>
		<div class="postpagination-next"><?php previous_post_link( '%link', '%title', true, '' ); ?></div>
	</nav>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
			get_template_part( 'content', 'single' );
			simplemarket_pagination();
			comments_template( '', true ); 
	endwhile; ?>
	
	<nav class="pagination">
		<div class="postpagination-previous"><?php next_post_link( '%link', '%title', true, '' ); ?></div>
		<div class="postpagination-next"><?php previous_post_link( '%link', '%title', true, '' ); ?></div>
	</nav>
</section>
<?php get_sidebar(); ?>
<?php get_footer() ?>