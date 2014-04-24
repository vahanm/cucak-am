<?php

/**
 * BuddyPress - Example Directory
 *
 * @package BuddyPress_Skeleton_Component
 */

?>

<?php get_header( 'buddypress' ); ?>

	<?php do_action( 'bp_before_directory_ba_integration_page' ); ?>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_directory_ba_integration' ); ?>

		<form action="" method="post" id="ba-integration-directory-form" class="dir-form">

			<h3><?php _e( 'High Fives Directory', 'bp-ba-integration' ); ?></h3>

			<?php do_action( 'bp_before_directory_ba_integration_content' ); ?>

			<?php do_action( 'template_notices' ); ?>

			<div class="item-list-tabs no-ajax" role="navigation">
				<ul>
					<li class="selected" id="groups-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_ba_integration_root_slug() ); ?>"><?php printf( __( 'All High Fives <span>%s</span>', 'buddypress' ), bp_ba_integration_get_total_high_five_count() ); ?></a></li>

					<?php do_action( 'bp_ba_integration_directory_ba_integration_filter' ); ?>

				</ul>
			</div><!-- .item-list-tabs -->

			<div id="ba-integration-dir-list" class="example dir-list">

				<?php bp_core_load_template( 'ba-integration/ba-integration-loop' ); ?>

			</div><!-- #examples-dir-list -->

			<?php do_action( 'bp_directory_ba_integration_content' ); ?>

			<?php wp_nonce_field( 'directory_ba_integration', '_wpnonce-ba-integration-filter' ); ?>

			<?php do_action( 'bp_after_directory_ba_integration_content' ); ?>

		</form><!-- #ba-integration-directory-form -->

		<?php do_action( 'bp_after_directory_ba_integration' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_ba_integration_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>

