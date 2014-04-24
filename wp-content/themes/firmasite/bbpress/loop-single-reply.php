<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php ob_start(); ?>
<div class="bbp-reply-header">

	<div class="bbp-meta">

		<span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span>

		<?php if ( bbp_is_single_user_replies() ) : ?>

			<span class="bbp-header">
				<?php _e( 'in reply to: ', 'firmasite' ); ?>
				<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>" title="<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
			</span>

		<?php endif; ?>

		<a href="<?php bbp_reply_url(); ?>" title="<?php bbp_reply_title(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

		<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

		<?php bbp_reply_admin_links(); ?>

		<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

	</div><!-- .bbp-meta -->

</div><!-- .bbp-reply-header -->
<?php $reply_manage = ob_get_contents(); ob_end_clean(); ?>

<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>
<div class="<?php echo firmasite_social_bbp_get_reply_class_modal();?>">
	<div class="row-fluid">
	<div class="span3 bbp-reply-author muted clearfix">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'sep' => '', 'show_role' => true ) ); ?>

		<?php if ( is_super_admin() ) : ?>

			<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

			<div class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

			<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

		<?php endif; ?>
		<a href="#<?php bbp_reply_id(); ?>" class="" rel="popover" data-html="true" data-placement="right" data-original-title="" data-content="<?php echo esc_attr($reply_manage); ?>">
                         	<span class="edit-link muted"><i class="icon-edit"></i><?php _e( 'Edit', 'firmasite' );?></span>
                         </a>
		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->

	<div class="span9 bbp-reply-content">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->
    </div>
</div>
</div><!-- #post-<?php bbp_reply_id(); ?> -->
