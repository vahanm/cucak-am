<?php
/*
Template Name: Full Width
*/
/**
 * @package firmasite
 */
// this one letting us translate page template names
esc_attr__( 'Full Width', 'firmasite' );
global $firmasite_settings;
get_header();
 ?>

		<div id="primary" class="content-area clearfix <?php echo $firmasite_settings["layout_primary_fullwidth_class"]; ?>">

			<?php if ( have_posts() ) : ?>

				<?php do_action( 'open_content' ); ?>
				<?php do_action( 'open_page' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Type-specific template for the content.
						   If you want to support Post-Format, i suggest customize loop files with switch()
						 */
						global $post;
						get_template_part( 'templates/single_full', $post->post_type );
					?>

				<?php endwhile; ?>

				<?php do_action( 'close_page' ); ?>
				<?php do_action( 'close_content' ); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/no-results', 'index' ); ?>

			<?php endif; ?>

			
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>