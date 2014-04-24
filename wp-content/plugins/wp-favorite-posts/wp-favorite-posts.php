<?php
/*
Plugin Name: WP Favorite Posts
Plugin URI: http://nxsn.com/my-projects/wp-favorite-posts-plugin/
Description: Allows users to add favorite posts. This plugin use cookies for saving data so unregistered users can favorite a post. Put <code>&lt;?php wpfp_link(); ?&gt;</code> where ever you want on a single post. Then create a page which includes that text : <code>{{wp-favorite-posts}}</code> That's it!
Version: 1.5.8
Author: Huseyin Berberoglu
Author URI: http://nxsn.com

*/

define('WPFP_PATH', plugins_url() . '/wp-favorite-posts');
define('WPFP_META_KEY', "wpfp_favorites");
define('WPFP_USER_OPTION_KEY', "wpfp_useroptions");
define('WPFP_COOKIE_KEY', "wp-favorite-posts");

$ajax_mode = 1;

function wp_favorite_posts() {
    if (isset($_REQUEST['wpfpaction'])):
        global $ajax_mode;
        $ajax_mode = $_REQUEST['ajax'];
        if ($_REQUEST['wpfpaction'] == 'add') {
            wpfp_add_favorite();
        } else if ($_REQUEST['wpfpaction'] == 'remove') {
            wpfp_remove_favorite();
        } else if ($_REQUEST['wpfpaction'] == 'clear') {
            if (wpfp_clear_favorites()) wpfp_die_or_go(wpfp_get_option('cleared'));
            else wpfp_die_or_go("ERROR");
        }
    endif;
}
add_action('template_redirect', 'wp_favorite_posts');

function wpfp_add_favorite($post_id = "") {
    if ( empty($post_id) ) $post_id = $_REQUEST['postid'];
    if (wpfp_get_option('opt_only_registered') && !is_user_logged_in() )
        wpfp_die_or_go(wpfp_get_option('text_only_registered') );

    if (wpfp_do_add_to_list($post_id)) {
        // added, now?
        do_action('wpfp_after_add', $post_id);
        if (wpfp_get_option('statics')) wpfp_update_post_meta($post_id, 1);
        if (wpfp_get_option('added') == 'show remove link') {
            $str = wpfp_link(1, "remove", 0, array( 'post_id' => $post_id ) );
            wpfp_die_or_go($str);
        } else {
            wpfp_die_or_go(wpfp_get_option('added'));
        }
    }
}
function wpfp_do_add_to_list($post_id) {
    if (wpfp_check_favorited($post_id))
        return false;
    if (is_user_logged_in()) {
        return wpfp_add_to_usermeta($post_id);
    } else {
        return wpfp_set_cookie($post_id, "added");
    }
}

function wpfp_remove_favorite($post_id = "") {
    if (empty($post_id)) $post_id = $_REQUEST['postid'];
    if (wpfp_do_remove_favorite($post_id)) {
        // removed, now?
        do_action('wpfp_after_remove', $post_id);
        if (wpfp_get_option('statics')) wpfp_update_post_meta($post_id, -1);
        if (wpfp_get_option('removed') == 'show add link') {
            if ($_REQUEST['page']==1):
                $str = '';
            else:
                $str = wpfp_link(1, "add", 0, array( 'post_id' => $post_id ) );
            endif;
            wpfp_die_or_go($str);
        } else {
            wpfp_die_or_go(wpfp_get_option('removed'));
        }
    }
    else return false;
}

function wpfp_die_or_go($str) {
    global $ajax_mode;
    if ($ajax_mode):
        die($str);
    else:
        wp_redirect($_SERVER['HTTP_REFERER']);
    endif;
}

function wpfp_add_to_usermeta($post_id) {
    $wpfp_favorites = wpfp_get_user_meta();
    $wpfp_favorites[] = $post_id;
    wpfp_update_user_meta($wpfp_favorites);
    return true;
}

function wpfp_check_favorited($cid) {
    if (is_user_logged_in()) {
        $favorite_post_ids = wpfp_get_user_meta();
        if ($favorite_post_ids)
            foreach ($favorite_post_ids as $fpost_id)
                if ($fpost_id == $cid) return true;
    } else {
        if (wpfp_get_cookie()):
            foreach (wpfp_get_cookie() as $fpost_id => $val)
                if ($fpost_id == $cid) return true;
        endif;
    }
    return false;
}

function wpfp_link( $return = 0, $action = "", $show_span = 1, $args = array() ) {
    global $post;
    $post_id = $post->ID;
    extract($args);
    $str = "";
    if ($show_span)
        $str = "<span class='wpfp-span'>";
    $str .= wpfp_before_link_img();
    $str .= wpfp_loading_img();
    if ($action == "remove"):
        $str .= wpfp_link_html($post_id, wpfp_get_option('remove_favorite'), "remove");
    elseif ($action == "add"):
        $str .= wpfp_link_html($post_id, wpfp_get_option('add_favorite'), "add");
    elseif (wpfp_check_favorited($post_id)):
        $str .= wpfp_link_html($post_id, wpfp_get_option('remove_favorite'), "remove");
    else:
        $str .= wpfp_link_html($post_id, wpfp_get_option('add_favorite'), "add");
    endif;
    if ($show_span)
        $str .= "</span>";
    if ($return) { return $str; } else { echo $str; }
}

function wpfp_link_html($post_id, $opt, $action) {
    $link = "<a class='wpfp-link' href='?wpfpaction=".$action."&amp;postid=". $post_id . "' title='". __($opt) ."' rel='nofollow'>". __($opt) ."</a>";
    $link = apply_filters( 'wpfp_link_html', $link );
    return $link;
}

function wpfp_get_users_favorites($user = "") {
    $favorite_post_ids = array();

    if (!empty($user)):
        return wpfp_get_user_meta($user);
    endif;

    # collect favorites from cookie and if user is logged in from database.
    if (is_user_logged_in()):
        $favorite_post_ids = wpfp_get_user_meta();
    else:
        if (wpfp_get_cookie()):
            foreach (wpfp_get_cookie() as $post_id => $post_title) {
                array_push($favorite_post_ids, $post_id);
            }
        endif;
    endif;
    return $favorite_post_ids;
}

function wpfp_list_favorite_posts( $args = array() ) {
    $user = $_REQUEST['user'];
    extract($args);
    global $favorite_post_ids;
    if (!empty($user)):
        if (!wpfp_is_user_favlist_public($user)):
            $favorite_post_ids = wpfp_get_users_favorites($user);
        endif;
    else:
        $favorite_post_ids = wpfp_get_users_favorites();
    endif;

    if ( @file_exists(TEMPLATEPATH.'/wpfp-page-template.php') || @file_exists(STYLESHEETPATH.'/wpfp-page-template.php') ):
        if(@file_exists(TEMPLATEPATH.'/wpfp-page-template.php')) :
            include(TEMPLATEPATH.'/wpfp-page-template.php');
        else :
            include(STYLESHEETPATH.'/wpfp-page-template.php');
        endif;
    else:
        include("wpfp-page-template.php");
    endif;
}

function wpfp_list_most_favorited($limit=5) {
    global $wpdb;
    $query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
    $query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
    $query .= " WHERE post_status='publish' AND meta_key='".WPFP_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, $limit";
    $results = $wpdb->get_results($query);
    if ($results) {
        echo "<ul>";
        foreach ($results as $o):
            $p = get_post($o->post_id);
            echo "<li>";
            echo "<a href='".get_permalink($o->post_id)."' title='". $p->post_title ."'>" . $p->post_title . "</a> ($o->meta_value)";
            echo "</li>";
        endforeach;
        echo "</ul>";
    }
}

include("wpfp-widgets.php");

function wpfp_loading_img() {
    return "<img src='".WPFP_PATH."/img/loading.gif' alt='Loading' title='Loading' class='wpfp-hide wpfp-img' />";
}

function wpfp_before_link_img() {
    $options = wpfp_get_options();
    $option = $options['before_image'];
    if ($option == '') {
        return "";
    } else if ($option == 'custom') {
        return "<img src='" . $options['custom_before_image'] . "' alt='Favorite' title='Favorite' class='wpfp-img' />";
    } else {
        return "<img src='". WPFP_PATH . "/img/" . $option . "' alt='Favorite' title='Favorite' class='wpfp-img' />";
    }
}

function wpfp_clear_favorites() {
    if (wpfp_get_cookie()):
        foreach (wpfp_get_cookie() as $post_id => $val) {
            wpfp_set_cookie($post_id, "");
            wpfp_update_post_meta($post_id, -1);
        }
    endif;
    if (is_user_logged_in()) {
        $favorite_post_ids = wpfp_get_user_meta();
        if ($favorite_post_ids):
            foreach ($favorite_post_ids as $post_id) {
                wpfp_update_post_meta($post_id, -1);
            }
        endif;
        if (!delete_user_meta(wpfp_get_user_id(), WPFP_META_KEY)) {
            return false;
        }
    }
    return true;
}
function wpfp_do_remove_favorite($post_id) {
    if (!wpfp_check_favorited($post_id))
        return true;

    $a = true;
    if (is_user_logged_in()) {
        $user_favorites = wpfp_get_user_meta();
        $user_favorites = array_diff($user_favorites, array($post_id));
        $user_favorites = array_values($user_favorites);
        $a = wpfp_update_user_meta($user_favorites);
    }
    if ($a) $a = wpfp_set_cookie($_REQUEST['postid'], "");
    return $a;
}

function wpfp_content_filter($content) {
    if (is_page()):
        if (strpos($content,'{{wp-favorite-posts}}')!== false) {
            $content = str_replace('{{wp-favorite-posts}}', wpfp_list_favorite_posts(), $content);
        }
    endif;
    //if (is_single()):
        if (strpos($content,'[wpfp-link]')!== false) {
            $content = str_replace('[wpfp-link]', wpfp_link(1), $content);
        }
    //endif;

    if (is_single()) {
        if (wpfp_get_option('autoshow') == 'before') {
            $content = wpfp_link(1) . $content;
        } else if (wpfp_get_option('autoshow') == 'after') {
            $content .= wpfp_link(1);
        }
    }
    return $content;
}
add_filter('the_content','wpfp_content_filter');
function wpfp_shortcode_func() {
    wpfp_list_favorite_posts();
}
add_shortcode('wp-favorite-posts', 'wpfp_shortcode_func');


function wpfp_add_js_script() {
    if (!wpfp_get_option('dont_load_js_file'))
        wp_enqueue_script( "wp-favroite-posts", WPFP_PATH . "/wpfp.js", array( 'jquery' ) );
}
add_action('wp_print_scripts', 'wpfp_add_js_script');

function wpfp_wp_print_styles() {
    if (!wpfp_get_option('dont_load_css_file'))
        echo "<link rel='stylesheet' id='wpfp-css' href='" . WPFP_PATH . "/wpfp.css' type='text/css' />" . "\n";
}
add_action('wp_print_styles', 'wpfp_wp_print_styles');

function wpfp_init() {
    $wpfp_options = array();
    $wpfp_options['add_favorite'] = "Add to favorites";
    $wpfp_options['added'] = "Added to favorites!";
    $wpfp_options['remove_favorite'] = "Remove from favorites";
    $wpfp_options['removed'] = "Removed from favorites!";
    $wpfp_options['clear'] = "Clear favorites";
    $wpfp_options['cleared'] = "<p>Favorites cleared!</p>";
    $wpfp_options['favorites_empty'] = "Favorite list is empty.";
    $wpfp_options['cookie_warning'] = "Your favorite posts saved to your browsers cookies. If you clear cookies also favorite posts will be deleted.";
    $wpfp_options['rem'] = "remove";
    $wpfp_options['text_only_registered'] = "Only registered users can favorite!";
    $wpfp_options['statics'] = 1;
    $wpfp_options['widget_title'] = '';
    $wpfp_options['widget_limit'] = 5;
    $wpfp_options['before_image'] = 'star.png';
    $wpfp_options['custom_before_image'] = '';
    $wpfp_options['dont_load_js_file'] = 0;
    $wpfp_options['dont_load_css_file'] = 0;
    $wpfp_options['post_per_page'] = 20;
    add_option('wpfp_options', $wpfp_options, 'Favorite Posts Options');
}
add_action('activate_wp-favorite-posts/wp-favorite-posts.php', 'wpfp_init');

function wpfp_config() { include('wpfp-admin.php'); }

function wpfp_config_page() {
    if ( function_exists('add_submenu_page') )
        add_options_page(__('Favorite Posts'), __('Favorite Posts'), 'manage_options', 'wp-favorite-posts', 'wpfp_config');
}
add_action('admin_menu', 'wpfp_config_page');

function wpfp_update_user_meta($arr) {
    return update_usermeta(wpfp_get_user_id(),WPFP_META_KEY,$arr);
}

function wpfp_update_post_meta($post_id, $val) {
    $oldval = wpfp_get_post_meta($post_id);
    if ($val == -1 && $oldval == 0) {
        $val = 0;
    } else {
        $val = $oldval + $val;
    }
    return add_post_meta($post_id, WPFP_META_KEY, $val, true) or update_post_meta($post_id, WPFP_META_KEY, $val);
}

function wpfp_delete_post_meta($post_id) {
    return delete_post_meta($post_id, WPFP_META_KEY);
}

function wpfp_get_cookie() {
    return $_COOKIE[WPFP_COOKIE_KEY];
}

function wpfp_get_options() {
   return get_option('wpfp_options');
}

function wpfp_get_user_id() {
    global $current_user;
    get_currentuserinfo();
    return $current_user->ID;
}

function wpfp_get_user_meta($user = "") {
    if (!empty($user)):
        $userdata = get_userdatabylogin($user);
        $user_id = $userdata->ID;
        return get_usermeta($user_id, WPFP_META_KEY);
    else:
        return get_usermeta(wpfp_get_user_id(), WPFP_META_KEY);
    endif;
}

function wpfp_get_post_meta($post_id) {
    $val = get_post_meta($post_id, WPFP_META_KEY, true);
    if ($val < 0) $val = 0;
    return $val;
}

function wpfp_set_cookie($post_id, $str) {
    $expire = time()+60*60*24*30;
    return setcookie("wp-favorite-posts[$post_id]", $str, $expire, "/");
}

function wpfp_is_user_favlist_public($user) {
    $user_opts = wpfp_get_user_options($user);
    if ($user_opts['list_is_public'])
        return true;
    else
        return false;
}

function wpfp_get_user_options($user) {
    $userdata = get_userdatabylogin($user);
    $user_id = $userdata->ID;
    return get_usermeta($user_id, WPFP_USER_OPTION_KEY);
}
function wpfp_is_user_can_edit() {
    if ($_REQUEST['user'])
        return false;
    return true;
}
function wpfp_remove_favorite_link($post_id) {
    if (wpfp_is_user_can_edit()) {
        $wpfp_options = wpfp_get_options();
        $class = 'wpfp-link remove-parent';
        $link = "<a id='rem_$post_id' class='$class' href='?wpfpaction=remove&amp;page=1&amp;postid=". $post_id ."' title='".wpfp_get_option('rem')."' rel='nofollow'>".wpfp_get_option('rem')."</a>";
        $link = apply_filters( 'wpfp_remove_favorite_link', $link );
        echo $link;
    }
}
function wpfp_clear_list_link() {
    if (wpfp_is_user_can_edit()) {
        $wpfp_options = wpfp_get_options();
        echo wpfp_before_link_img();
        echo wpfp_loading_img();
        echo "<a class='wpfp-link' href='?wpfpaction=clear' rel='nofollow'>". wpfp_get_option('clear') . "</a>";
    }
}
function wpfp_cookie_warning() {
    if (!is_user_logged_in() && !isset($_GET['user']) ):
        echo "<p>".wpfp_get_option('cookie_warning')."</p>";
    endif;
}

function wpfp_get_option($opt) {
    $wpfp_options = wpfp_get_options();
    return htmlspecialchars_decode( stripslashes ( $wpfp_options[$opt] ) );
}

include('wpfp-admin-bar.php');