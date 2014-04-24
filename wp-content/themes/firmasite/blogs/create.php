<?php

/**
 * BuddyPress - Create Blog
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

global $firmasite_settings;
get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_blogs_content' ); ?>

	<div id="primary" class="content-area <?php echo $firmasite_settings["layout_primary_class"]; ?>">
		<div class="padder" role="main">
		
		<?php do_action( 'bp_before_create_blog_content_template' ); ?>

		<?php do_action( 'template_notices' ); ?>

			<h3 class="page-header"><?php _e( 'Create a Site', 'firmasite' ); ?> &nbsp;<a class="button btn " href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_blogs_root_slug() ); ?>"><?php _e( 'Site Directory', 'firmasite' ); ?></a></h3>

		<?php do_action( 'bp_before_create_blog_content' ); ?>

		<?php if ( bp_blog_signup_enabled() ) : ?>

			<?php bp_show_blog_signup_form(); ?>

		<?php else: ?>

			<div id="message" class="info">
				<p><?php _e( 'Site registration is currently disabled', 'firmasite' ); ?></p>
			</div>

		<?php endif; ?>

		<?php do_action( 'bp_after_create_blog_content' ); ?>
		
		<?php do_action( 'bp_after_create_blog_content_template' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_blogs_content' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>