<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<div id="forums-list-<?php bbp_forum_id(); ?>" class="bbp-forums">


	<div class="bbp-body">

		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	</div><!-- .bbp-body -->



</div><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
