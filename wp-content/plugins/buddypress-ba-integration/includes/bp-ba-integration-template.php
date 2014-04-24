<?php

function bp_ba_integration_has_items( $args = '' ) {
	global $bp, $items_template;

	// This keeps us from firing the query more than once
	if ( empty( $items_template ) ) {
		/***
		 * This function should accept arguments passes as a string, just the same
		 * way a 'query_posts()' call accepts parameters.
		 * At a minimum you should accept 'per_page' and 'max' parameters to determine
		 * the number of items to show per page, and the total number to return.
		 *
		 * e.g. bp_get_ba_integration_has_items( 'per_page=10&max=50' );
		 */

		/***
		 * Set the defaults for the parameters you are accepting via the "bp_get_ba_integration_has_items()"
		 * function call
		 */
		$defaults = array(
			'high_fiver_id' => 0,
			'recipient_id'  => 0,
			'per_page'      => 10,
			'paged'		=> 1
		);

		/***
		 * This function will extract all the parameters passed in the string, and turn them into
		 * proper variables you can use in the code - $per_page, $max
		 */
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$items_template = new BP_BA_Intergration_Highfive();
		$items_template->get( $r );
	}

	return $items_template->have_posts();
}

function bp_ba_integration_the_item() {
	global $items_template;
	return $items_template->query->the_post();
}

function bp_ba_integration_item_name() {
	echo bp_ba_integration_get_item_name();
}
	/* Always provide a "get" function for each template tag, that will return, not echo. */
	function bp_ba_integration_get_item_name() {
		global $items_template;
		echo apply_filters( 'bp_ba_integration_get_item_name', $items_template->item->name ); // Example: $items_template->item->name;
	}

/**
 * Echo "Viewing x of y pages"
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_pagination_count() {
	echo bp_ba_integration_get_pagination_count();
}
	/**
	 * Return "Viewing x of y pages"
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 */
	function bp_ba_integration_get_pagination_count() {
		global $items_template;

		$pagination_count = sprintf( __( 'Viewing page %1$s of %2$s', 'bp-ba-integration' ), $items_template->query->query_vars['paged'], $items_template->query->max_num_pages );

		return apply_filters( 'bp_ba_integration_get_pagination_count', $pagination_count );
	}

/**
 * Echo pagination links
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_item_pagination() {
	echo bp_ba_integration_get_item_pagination();
}
	/**
	 * return pagination links
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 */
	function bp_ba_integration_get_item_pagination() {
		global $items_template;
		return apply_filters( 'bp_ba_integration_get_item_pagination', $items_template->pag_links );
	}

/**
 * Echo the high-fiver avatar (post author)
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_high_fiver_avatar( $args = array() ) {
	echo bp_ba_integration_get_high_fiver_avatar( $args );
}
	/**
	 * Return the high-fiver avatar (the post author)
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 *
	 * @param mixed $args Accepts WP style arguments - either a string of URL params, or an array
	 * @return str The HTML for a user avatar
	 */
	function bp_ba_integration_get_high_fiver_avatar( $args = array() ) {
		$defaults = array(
			'item_id' => get_the_author_meta( 'ID' ),
			'object'  => 'user'
		);

		$r = wp_parse_args( $args, $defaults );

		return bp_core_fetch_avatar( $r );
	}

/**
 * Echo the "title" of the high-five
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_high_five_title() {
	echo bp_ba_integration_get_high_five_title();
}
	/**
	 * Return the "title" of the high-five
	 *
	 * We'll assemble the title out of the available information. This way, we can insert
	 * fancy stuff link links, and secondary avatars.
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 */
	function bp_ba_integration_get_high_five_title() {
		// First, set up the high fiver's information
		$high_fiver_link = bp_core_get_userlink( get_the_author_meta( 'ID' ) );

		// Next, get the information for the high five recipient
		$recipient_id    = get_post_meta( get_the_ID(), 'bp_ba_integration_recipient_id', true );
		$recipient_link  = bp_core_get_userlink( $recipient_id );

		// Use sprintf() to make a translatable message
		$title 		 = sprintf( __( '%1$s gave %2$s a high-five!', 'bp-ba-integration' ), $high_fiver_link, $recipient_link );

		return apply_filters( 'bp_ba_integration_get_high_five_title', $title, $high_fiver_link, $recipient_link );
	}

/**
 * Is this page part of the Example component?
 *
 * Having a special function just for this purpose makes our code more readable elsewhere, and also
 * allows us to place filter 'bp_is_ba_integration_component' for other components to interact with.
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 *
 * @uses bp_is_current_component()
 * @uses apply_filters() to allow this value to be filtered
 * @return bool True if it's the example component, false otherwise
 */
function bp_is_ba_integration_component() {
	$is_ba_integration_component = bp_is_current_component( 'ba_integration' );

	return apply_filters( 'bp_is_ba_integration_component', $is_ba_integration_component );
}

/**
 * Echo the component's slug
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_slug() {
	echo bp_get_ba_integration_slug();
}
	/**
	 * Return the component's slug
	 *
	 * Having a template function for this purpose is not absolutely necessary, but it helps to
	 * avoid too-frequent direct calls to the $bp global.
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 *
	 * @uses apply_filters() Filter 'bp_get_ba_integration_slug' to change the output
	 * @return str $ba_integration_slug The slug from $bp->ba_integration->slug, if it exists
	 */
	function bp_get_ba_integration_slug() {
		global $bp;

		// Avoid PHP warnings, in case the value is not set for some reason
		$ba_integration_slug = isset( $bp->ba_integration->slug ) ? $bp->ba_integration->slug : '';

		return apply_filters( 'bp_get_ba_integration_slug', $ba_integration_slug );
	}

/**
 * Echo the component's root slug
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_root_slug() {
	echo bp_get_ba_integration_root_slug();
}
	/**
	 * Return the component's root slug
	 *
	 * Having a template function for this purpose is not absolutely necessary, but it helps to
	 * avoid too-frequent direct calls to the $bp global.
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 *
	 * @uses apply_filters() Filter 'bp_get_ba_integration_root_slug' to change the output
	 * @return str $ba_integration_root_slug The slug from $bp->ba_integration->root_slug, if it exists
	 */
	function bp_get_ba_integration_root_slug() {
		global $bp;

		// Avoid PHP warnings, in case the value is not set for some reason
		$ba_integration_root_slug = isset( $bp->ba_integration->root_slug ) ? $bp->ba_integration->root_slug : '';

		return apply_filters( 'bp_get_ba_integration_root_slug', $ba_integration_root_slug );
	}

/**
 * Echo the total of all high-fives across the site
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_total_high_five_count() {
	echo bp_ba_integration_get_total_high_five_count();
}
	/**
	 * Return the total of all high-fives across the site
	 *
	 * The most straightforward way to get a post count is to run a WP_Query. In your own plugin
	 * you might consider storing data like this with update_option(), incrementing each time
	 * a new item is published.
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 *
	 * @return int
	 */
	function bp_ba_integration_get_total_high_five_count() {
		$high_fives = new BP_BA_Intergration_Highfive();
		$high_fives->get();

		return apply_filters( 'bp_ba_integration_get_total_high_five_count', $high_fives->query->found_posts, $high_fives );
	}

/**
 * Echo the total of all high-fives given to a particular user
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
function bp_ba_integration_total_high_five_count_for_user( $user_id = false ) {
	echo bp_ba_integration_get_total_high_five_count_for_user( $user_id = false );
}
	/**
	 * Return the total of all high-fives given to a particular user
	 *
	 * The most straightforward way to get a post count is to run a WP_Query. In your own plugin
	 * you might consider storing data like this with update_option(), incrementing each time
	 * a new item is published.
	 *
	 * @package BuddyPress_Skeleton_Component
	 * @since 1.6
	 *
	 * @return int
	 */
	function bp_ba_integration_get_total_high_five_count_for_user( $user_id = false ) {
		// If no explicit user id is passed, fall back on the loggedin user
		if ( !$user_id ) {
			$user_id = bp_loggedin_user_id();
		}

		if ( !$user_id ) {
			return 0;
		}

		$high_fives = new BP_BA_Intergration_Highfive();
		$high_fives->get( array( 'recipient_id' => $user_id ) );

		return apply_filters( 'bp_ba_integration_get_total_high_five_count', $high_fives->query->found_posts, $high_fives );
	}

?>