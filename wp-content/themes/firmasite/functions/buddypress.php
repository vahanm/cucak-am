<?php


add_action( 'after_setup_theme', "firmasite_social_buddypress_setup");
function firmasite_social_buddypress_setup() {
	// bp 1.7+
	add_theme_support( 'buddypress' );

	// Load the AJAX functions for the theme
	require( get_template_directory() . '/assets/_inc/ajax.php' );

	if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button',           5 );

		// Activity button
		if ( bp_is_active( 'activity' ) )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button',           5 );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button',      20 );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}


add_action( 'wp_enqueue_scripts', "firmasite_social_buddypress_scripts");
function firmasite_social_buddypress_scripts() {

	// Enqueue the global JS - Ajax will not work without it
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/assets/_inc/global.js', array( 'jquery' ), bp_get_version() );

	// Add words that we need to use in JS to the end of the page so they can be translated and still used.
	$params = array(
		'my_favs'           => __( 'My Favorites', 'firmasite' ),
		'accepted'          => __( 'Accepted', 'firmasite' ),
		'rejected'          => __( 'Rejected', 'firmasite' ),
		'show_all_comments' => __( 'Show all comments for this thread', 'firmasite' ),
		'show_all'          => __( 'Show all', 'firmasite' ),
		'comments'          => __( 'comments', 'firmasite' ),
		'close'             => __( 'Close', 'firmasite' ),
		'view'              => __( 'View', 'firmasite' ),
		'mark_as_fav'	    => __( 'Favorite', 'firmasite' ),
		'remove_fav'	    => __( 'Remove Favorite', 'firmasite' )
	);
	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );
}