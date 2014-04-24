<?php
/**
 * Archive page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>
<section id="content" role="main">
	<?php if ( have_posts() ) the_post(); ?>
		<header class="post-header">
		<h1 class="post-title">
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: <span>%s</span>', TEMPLATE_DOMAIN), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: <span>%s</span>', TEMPLATE_DOMAIN), get_the_date( 'F Y' ) ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: <span>%s</span>', TEMPLATE_DOMAIN), get_the_date( 'Y' ) ); ?>
		<?php else : ?>
			<?php _e( 'Blog Archives', TEMPLATE_DOMAIN); ?>
	<?php endif; ?>
	</h1>
	</header>
	<?php
	rewind_posts();
	while ( have_posts() ) : the_post();
		get_template_part( 'content', get_post_format() );
	endwhile;
		simplemarket_pagination();
	?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

