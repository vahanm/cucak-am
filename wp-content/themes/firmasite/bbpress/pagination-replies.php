<?php

/**
 * Pagination for pages of replies (when viewing a topic)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination">
	<div class="bbp-pagination-count muted">

		<?php bbp_topic_pagination_count(); ?>

	</div>

	<div class="bbp-pagination-links pagination pagination-large pagination-centered">

		<?php bbp_topic_pagination_links(); ?>

	</div>
</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
