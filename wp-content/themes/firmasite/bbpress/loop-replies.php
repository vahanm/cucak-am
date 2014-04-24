<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<div id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">



		<ul class="bbp-reply-content pager">

			<?php if ( !bbp_show_lead_topic() ) : ?>

				<li class="next">
				<?php bbp_user_favorites_link(); ?>
                </li>
				<li class="next">
				<?php bbp_user_subscribe_link(array('before' => '')); ?>
                </li>

			<?php else : ?>

				<?php //_e( 'Replies', 'firmasite' ); ?>

			<?php endif; ?>

		</ul><!-- .bbp-reply-content -->

	<!-- .bbp-header -->


		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>


</div><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
