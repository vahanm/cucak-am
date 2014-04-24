<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

  <div class="pull-left">
	<div class="bbp-topic-title lead">
		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_user_favorites_link( array( 'mid' => '+', 'post' => '' ), array( 'pre' => '', 'mid' => '&times;', 'post' => '' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_topic_title' ); ?>

		<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><?php bbp_topic_title(); ?></a>

		<?php do_action( 'bbp_theme_after_topic_title' ); ?>
	</div>
		<?php echo firmasite_social_bbp_get_topic_pagination(); ?>
		<?php bbp_topic_row_actions(); ?>
  </div>
  <div class="pull-right muted">
    <small>
		<div class="clearfix">
			<div><span class="bbp-topic-reply-count badge badge-info"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></span> <?php bbp_show_lead_topic() ? _e( 'Replies', 'firmasite' ) : _e( 'Posts', 'firmasite' ); ?></div>

            <div class="bbp-topic-freshness clearfix">
        		 &nbsp;<?php _e( 'Freshness', 'firmasite' ); ?>:
                 
				<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>
    
                <span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 14 ) ); ?></span>
    
                <?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>
 
                <?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>
        
                <?php echo firmasite_social_bbp_get_topic_freshness_link(); ?>
        
                <?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
        
            </div>

		<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

		<div class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>

			<div class="bbp-topic-started-by clearfix">&nbsp;<?php printf( __( 'Started by: %1$s', 'firmasite' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) ); ?></div>

			<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

			<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() != bbp_get_forum_id() ) ) : ?>

				<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

				<div class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'firmasite' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></div>

				<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

			<?php endif; ?>

		</div>

		<?php do_action( 'bbp_theme_after_topic_meta' ); ?>


</div></small></div>

</div><!-- #topic-<?php bbp_topic_id(); ?> -->
