<?php

// Tell the TinyMCE editor to use a custom stylesheet
add_filter('the_editor_content', "firmasite_tinymce_style");
function firmasite_tinymce_style($content) {
	global $firmasite_settings,$wp_version;
	add_editor_style('style.css');
	add_editor_style('assets/css/wpeditor.php');
	
	// This is for front-end tinymce customization
	if ( ! is_admin() ) {
		global $editor_styles;
		
		$editor_styles = (array) $editor_styles;
		$stylesheet    = array();
		
		$stylesheet[] = 'style.css';
		$stylesheet[] = 'assets/css/wpeditor.php';		

		$editor_styles = array_merge( $editor_styles, $stylesheet );
		
	}
	return $content;
}

// http://codex.wordpress.org/Function_Reference/wp_title
// If you are using a custom homepage with custom loops and stuff, you will have an empty wp_title.
add_filter( 'wp_title', 'firmasite_wp_title', 10, 2 );
function firmasite_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;
		
	if ( defined( 'WPSEO_VERSION' ) )
		return $title; 

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'firmasite' ), max( $paged, $page ) );

	return $title;
}


// Shorter excerpt is better for promotion bar
add_filter( 'excerpt_length', 'firmasite_excerpt_length' );
function firmasite_excerpt_length( $length ) {
	return 30;
}





// - - - - - - - - - - - - - - - - - - - - 
// We are adding javascript default caller
// - - - - - - - - - - - - - - - - - - - - 
add_action( 'wp_footer', "firmasite_bootstrapjs_init" ,999);
function firmasite_bootstrapjs_init() {
	?>
	<script type="text/javascript">
	function firmasite_edits(){
		/* removing double thumbnail frame */
		jQuery('[rel=carousel].carousel a').removeClass("thumbnail");
		jQuery("[role='search']").addClass("form-search"); // search boxes
		jQuery("[type='submit']").addClass("btn");
		jQuery("[type='button']").addClass("btn");
		jQuery("table").addClass("table");
	}
	jQuery(document).ready(function() {
		firmasite_edits();
		jQuery('[rel=tooltip]').tooltip();
		jQuery('[rel=popover]').popover();
		jQuery('[rel=carousel]').carousel();
		/* audio - video player */
		if(jQuery.isFunction(jQuery.mediaelementplayer)){
			jQuery('audio,video').mediaelementplayer();
		}
	});
	jQuery(document).on("DOMNodeInserted", function(){
           firmasite_edits();
    });
	/* carousels was causing content move when reading if slides dont have same height */
	jQuery('.container').hover(
		function () { jQuery('[rel=carousel]').carousel("pause"); },
		function () { jQuery('[rel=carousel]').carousel("cycle");  }
	);
	</script>
	<?php
}


// - - - - - - - - - - - - - - - - - - - - 
// We are adding tinymce to comments
// http://www.techytalk.info/add-tinymce-quicktags-visual-editors-wordpress-comments-form/
// - - - - - - - - - - - - - - - - - - - - 
function firmasite_wp_editor($content = '', $editor_id = 'comment', $textarea_name = ""){
    ob_start();
	if (empty($textarea_name)) { $textarea_name = $editor_id; }
    wp_editor( $content, $editor_id, apply_filters( 'firmasite_front_editor', array(
        'media_buttons' => false,
		'textarea_name' => $textarea_name,
        'textarea_rows' => '3',
        'tinymce' => array(
            'theme_advanced_buttons1' => 'bold, italic, underline, strikethrough',
            'theme_advanced_buttons2' => ''
            ),
        'quicktags' => array('buttons' => 'strong,em,block,del,code,close')
        ))
    );
 
    return ob_get_clean();
}

add_filter('comment_form_defaults', "firmasite_comment_editor");
function firmasite_comment_editor($args) {
    $args['comment_field'] = firmasite_wp_editor();
    return $args;
}



// - - - - - - - - - - - - - - - - - - - - 
// We are adding navigation and comment system to bottom of content
// - - - - - - - - - - - - - - - - - - - - 
add_action('close_content', "firmasite_navigation_bottom" ,999);
function firmasite_navigation_bottom() {
	global $firmasite_settings;

	if(!isset($firmasite_settings["comments"]) || $firmasite_settings["comments"] != true ) {
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) 
			comments_template( '', true );
		
	}
?>	
	<ul id="breadcrumbs-bottom" class="pager">
<?php	
	// Adding breadcrumb
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<li><i class="icon-home"></i> ','</li>');
	}
		
	// prev - next links
	firmasite_content_nav( 'nav-below' );
?>	
	</ul>
	
<?php
}



// - - - - - - - - - - - - - - - - - - - - 
// We are adding navigation to top of content
// - - - - - - - - - - - - - - - - - - - - 
add_action('open_content', "firmasite_navigation_top");
function firmasite_navigation_top() {
?>	
	<ul id="breadcrumbs" class="pager">
<?php	
	// Adding breadcrumb
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<li><i class="icon-home"></i> ','</li>');
	}
	if (!is_home())
		// prev - next links
		firmasite_content_nav( 'nav-top' );
?>	
	</ul>
	
<?php
}



// - - - - - - - - - - - - - - - - - - - - 
// We are adding btn class to more link
// - - - - - - - - - - - - - - - - - - - -
add_filter( 'the_content_more_link', 'firmasite_more_link_scroll' );
function firmasite_more_link_scroll( $link ) {
	$link = str_replace( 'class="more-link"', 'class="more-link btn"', $link );
	return $link;
}



// http://wordpress.stackexchange.com/questions/54700/why-time-functions-show-invalid-time-zone-when-using-c-time-format
add_filter( 'date_i18n', 'firmasite_fix_c_time_format', 10, 4 );
function firmasite_fix_c_time_format( $date, $format, $timestamp, $gmt ) {
    if ( 'c' == $format )
        $date = date_i18n( DATE_ISO8601, $timestamp, $gmt );
    return $date;
}

// Fix for custom menu widget
// http://wordpress.stackexchange.com/questions/53950/add-a-custom-walkter-to-a-menu-created-in-a-widget
// http://wpsmith.net/2011/tutorials/how-to-add-menu-descriptions-featured-images-to-wordpress-menu-items/
add_filter( 'wp_nav_menu_args', "firmasite_fix_widget_custommenu" );
function firmasite_fix_widget_custommenu( $args ) {
	if ( ( $args['theme_location'] != 'main_menu' ) && ( $args['theme_location'] != 'footer_menu' ) ) {
		return array_merge( $args, array(
			// we dont want to effect main-menu
			'items_wrap' => '<ul id="%1$s" class="%2$s nav nav-tabs nav-stacked">%3$s</ul>',
			// another setting go here ... 
		) );
	} else {
		return $args;
	}
}



// Adding class="thumbnail" to <a> for bootstrap
// http://codex.wordpress.org/Function_Reference/the_post_thumbnail
add_filter( 'post_thumbnail_html', "firmasite_fix_thumbnail_html" , 10, 3 );
function firmasite_fix_thumbnail_html( $html, $post_id, $post_image_id ) {
	if ( ! is_admin() )
		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" class="thumbnail">' . $html . '</a>';
  return $html;

}


/*
 * Child Themes can add/remove custom bootstrap styles. 
 * This function is using last option from style list when selected bootstrap style does not registered in active theme
 */
add_action( 'after_setup_theme', "firmasite_settings_fix_unregister_theme_style", 11);
// firmasite_settings_close action already fired normally but this one is for customizer preview in admin panel
add_action( 'firmasite_settings_close', "firmasite_settings_fix_unregister_theme_style", 11);
function firmasite_settings_fix_unregister_theme_style(){
	global $firmasite_settings;
	if (!array_key_exists($firmasite_settings["style"], $firmasite_settings["styles"])) {
		if(0 < count($firmasite_settings["styles"])) {
			// last option from style list
			$firmasite_settings["style"] = array_pop(array_keys($firmasite_settings["styles"]));			
		} else {
			// style list is empty.. fallback to united
			$firmasite_settings["style"] = "united";
		}
	}	 	
}
