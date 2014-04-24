<?php

/**
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */

?>

<?php do_action( 'bp_before_ba_integration_loop' ); ?>

<?php if ( bp_ba_integration_has_items( bp_ajax_querystring( 'ba_integration' ) ) ) : ?>
<?php // global $items_template; var_dump( $items_template ) ?>
	<div id="pag-top" class="pagination">

		<div class="pag-count" id="ba-integration-dir-count-top">

			<?php bp_ba_integration_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="ba-integration-dir-pag-top">

			<?php bp_ba_integration_item_pagination(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_ba_integration_list' ); ?>

	<ul id="ba-integration-list" class="item-list" role="main">

	<?php while ( bp_ba_integration_has_items() ) : bp_ba_integration_the_item(); ?>

		<li>
			<div class="item-avatar">
				<?php bp_ba_integration_high_fiver_avatar( 'type=thumb&width=50&height=50' ); ?>
			</div>

			<div class="item">
				<div class="item-title"><?php bp_ba_integration_high_five_title() ?></div>

				<?php do_action( 'bp_directory_ba_integration_item' ); ?>

			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_ba_integration_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="ba-integration-dir-count-bottom">

			<?php bp_ba_integration_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="ba-integration-dir-pag-bottom">

			<?php bp_ba_integration_item_pagination(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no high-fives found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_ba_integration_loop' ); ?>
