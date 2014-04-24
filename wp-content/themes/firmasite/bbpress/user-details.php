<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>
    <div id="bbp-user-avatar" class="clearfix">

        <span class='vcard'>
            <a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
                <?php echo get_avatar( bbp_get_displayed_user_field( 'user_email' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
            </a>
        </span>

    </div><!-- #author-avatar -->

	<div id="bbp-single-user-details" class="clearfix">

		<div id="bbp-user-navigation">
			<ul class="nav nav-tabs">
				<li class="<?php if ( bbp_is_single_user_profile() ) :?>current active<?php endif; ?>">
						<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( __( "%s's Profile", 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>" rel="me"><?php _e( 'Profile', 'firmasite' ); ?></a>
				</li>

				<li class="<?php if ( bbp_is_single_user_topics() ) :?>current active<?php endif; ?>">
						<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( __( "%s's Topics Started", 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Topics Started', 'firmasite' ); ?></a>
				</li>

				<li class="<?php if ( bbp_is_single_user_replies() ) :?>current active<?php endif; ?>">
						<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( __( "%s's Replies Created", 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Replies Created', 'firmasite' ); ?></a>
				</li>

				<?php if ( bbp_is_favorites_active() ) : ?>
					<li class="<?php if ( bbp_is_favorites() ) :?>current active<?php endif; ?>">
							<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( __( "%s's Favorites", 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Favorites', 'firmasite' ); ?></a>							
					</li>
				<?php endif; ?>

				<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

					<?php if ( bbp_is_subscriptions_active() ) : ?>
						<li class="<?php if ( bbp_is_subscriptions() ) :?>current active<?php endif; ?>">
								<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( __( "%s's Subscriptions", 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Subscriptions', 'firmasite' ); ?></a>							
						</li>
					<?php endif; ?>

					<li class="<?php if ( bbp_is_single_user_edit() ) :?>current active<?php endif; ?>">
							<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( __( 'Edit Profile of User %s', 'firmasite' ), esc_attr( bbp_get_displayed_user_field( 'display_name' ) ) ); ?>"><?php _e( 'Edit', 'firmasite' ); ?></a>
					</li>

				<?php endif; ?>

			</ul>
		</div><!-- #bbp-user-navigation -->
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
