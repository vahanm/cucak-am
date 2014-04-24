<?php
// We are adding thumbnail support for forums
add_action('init', 'firmasite_social_bbpress_init');
function firmasite_social_bbpress_init() {
	add_post_type_support( 'forum', 'thumbnail' );

}


// removing default plugin css.. bootstrap is enough :)
add_action( 'bbp_theme_compat_actions', 'firmasite_social_remove_default_style' );
function firmasite_social_remove_default_style( $BBP_Default ) {
    remove_action( 'bbp_enqueue_scripts', array( $BBP_Default, 'enqueue_styles'  ) );
}



// we removing pagination and breadcrumbs for bbpress pages
add_action( 'wp_head', "firmasite_social_bbpress_remove_pagination" );
function firmasite_social_bbpress_remove_pagination() {
	if (is_bbpress()) {
		remove_action('close_content', "firmasite_navigation_bottom" ,999);
		remove_action('open_content', "firmasite_navigation_top");
	}
}




add_filter ( 'bbp_get_topic_class', 'firmasite_social_bbp_get_topic_class', 10, 2);
function firmasite_social_bbp_get_topic_class ($classes, $topic_id) {
	$bbp       = bbpress();
	$count     = isset( $bbp->topic_query->current_post ) ? $bbp->topic_query->current_post : 1;
	if(bbp_is_topic_sticky( $topic_id, false )) {
		$classes[] = 'alert modal-body';		
	} else if(bbp_is_topic_super_sticky( $topic_id  )) {
		$classes[] = 'alert alert-success modal-body';		
	} else {
		$classes[] = ( (int) $count % 2 ) ? 'modal-footer' : 'modal-body';
	}
	$classes[] = "clearfix";
	return $classes;
}



add_filter ( 'bbp_get_reply_class', 'firmasite_social_bbp_reply_class');
function firmasite_social_bbp_reply_class ($classes) {
	$classes[] = " modal firmasite-modal-static";
	return $classes;
}



add_filter( 'bbp_get_forum_class', "firmasite_social_bbp_get_forum_class" );
function firmasite_social_bbp_get_forum_class ($classes) {
	$classes[] = " well well-small";
	return $classes;
}



add_filter( 'bbp_replies_pagination', "firmasite_social_bbp_replies_pagination");
add_filter( 'bbp_topic_pagination', "firmasite_social_bbp_replies_pagination");
function firmasite_social_bbp_replies_pagination($array){
	$array['type'] = 'list';
	
	return $array;
}



function firmasite_social_bbp_get_reply_class_modal($reply_id = 0) {
	$bbp       = bbpress();
	$reply_id  = bbp_get_reply_id( $reply_id );
	$count     = isset( $bbp->reply_query->current_post ) ? $bbp->reply_query->current_post : 1;
	$class = 	( (int) $count % 2 ) ? 'modal-footer' : 'modal-body';
	
	return $class;
}


// we re-created function for adding bootstrap tooltip. re-creating function was better solution then others
function firmasite_social_bbp_get_topic_freshness_link( $topic_id = 0 ) {
	$topic_id   = bbp_get_topic_id( $topic_id );
	$link_url   = bbp_get_topic_last_reply_url( $topic_id );
	$title      = bbp_get_topic_last_reply_title( $topic_id );
	$time_since = bbp_get_topic_last_active_time( $topic_id );

	if ( !empty( $time_since ) )
		$anchor = '<a href="' . $link_url . '" rel="popover" data-placement="left" data-trigger="hover" data-html="true" data-original-title="'. __( 'Freshness', 'firmasite' ) . '" data-content="' . esc_attr( $time_since ) . '"><i class="icon-time"></i></a>';
	else
		$anchor = __( 'No Replies', 'firmasite' );

	return apply_filters( 'bbp_get_topic_freshness_link', $anchor, $topic_id );
}


// we re-created function for adding bootstrap tooltip. re-creating function was better solution then others
function firmasite_social_bbp_get_forum_freshness_link( $forum_id = 0 ) {
	$forum_id  = bbp_get_forum_id( $forum_id );
	$active_id = bbp_get_forum_last_active_id( $forum_id );

	if ( empty( $active_id ) )
		$active_id = bbp_get_forum_last_reply_id( $forum_id );

	if ( empty( $active_id ) )
		$active_id = bbp_get_forum_last_topic_id( $forum_id );

	if ( bbp_is_topic( $active_id ) ) {
		$link_url = bbp_get_forum_last_topic_permalink( $forum_id );
		$title    = bbp_get_forum_last_topic_title( $forum_id );
	} elseif ( bbp_is_reply( $active_id ) ) {
		$link_url = bbp_get_forum_last_reply_url( $forum_id );
		$title    = bbp_get_forum_last_reply_title( $forum_id );
	}

	$time_since = bbp_get_forum_last_active_time( $forum_id );

	if ( !empty( $time_since ) && !empty( $link_url ) )
		$anchor = '<a href="' . $link_url . '" rel="popover" data-placement="left" data-trigger="hover" data-html="true" data-original-title="'. __( 'Freshness', 'firmasite' ) .'" data-content="' . esc_attr( $time_since ) . '"><i class="icon-time"></i></a>&nbsp;'. __( 'Freshness', 'firmasite' ) . ':';
	else
		$anchor = __( 'No Topics', 'firmasite' );

	return apply_filters( 'bbp_get_forum_freshness_link', $anchor, $forum_id );
}


// Sadly we needed to re-create bbp_get_topic_pagination just because to add 'type' => 'list' to $pagination args -.-'
function firmasite_social_bbp_get_topic_pagination( $args = '' ) {
	global $wp_rewrite;

	$defaults = array(
		'topic_id' => bbp_get_topic_id(),
		'before'   => '<div class="pagination pagination-small">',
		'after'    => '</div>',
	);
	$r = bbp_parse_args( $args, $defaults, 'get_topic_pagination' );
	extract( $r );

	// If pretty permalinks are enabled, make our pagination pretty
	if ( $wp_rewrite->using_permalinks() )
		$base = trailingslashit( get_permalink( $topic_id ) ) . user_trailingslashit( $wp_rewrite->pagination_base . '/%#%/' );
	else
		$base = add_query_arg( 'paged', '%#%', get_permalink( $topic_id ) );

	// Get total and add 1 if topic is included in the reply loop
	$total = bbp_get_topic_reply_count( $topic_id, true );

	// Bump if topic is in loop
	if ( !bbp_show_lead_topic() )
		$total++;

	// Pagination settings
	$pagination = array(
		'type'      => 'list', // yes.. this little bastard is reason to re-create that function
		'base'      => $base,
		'format'    => '',
		'total'     => ceil( (int) $total / (int) bbp_get_replies_per_page() ),
		'current'   => 0,
		'prev_next' => false,
		'mid_size'  => 2,
		'end_size'  => 3,
		'add_args'  => ( bbp_get_view_all() ) ? array( 'view' => 'all' ) : false
	);

	// Add pagination to query object
	$pagination_links = paginate_links( $pagination );
	if ( !empty( $pagination_links ) ) {

		// Remove first page from pagination
		if ( $wp_rewrite->using_permalinks() ) {
			$pagination_links = str_replace( $wp_rewrite->pagination_base . '/1/', '', $pagination_links );
		} else {
			$pagination_links = str_replace( '&#038;paged=1', '', $pagination_links );
		}

		// Add before and after to pagination links
		$pagination_links = $before . $pagination_links . $after;
	}

	return apply_filters( 'bbp_get_topic_pagination', $pagination_links, $args );
}