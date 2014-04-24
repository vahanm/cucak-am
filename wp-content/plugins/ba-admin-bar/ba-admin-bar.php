<?php
/*
Plugin Name: BA Admin bar
Plugin URI: http://cucak.am
Description: 
Version: 1.0
Author: Vahan Mkhitaryan
Author URI: http://www.facebook.com/vahan.mkhitaryan
*/

$dir = dirname(__FILE__);
$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

//wp_enqueue_script('ba-reports', $plugindir . '/ba-reports.js', array('jQuery', 'jQuery UI'), '1.0');

register_activation_hook(__FILE__, 'ba_admin_bar_install');
register_deactivation_hook(__FILE__, 'ba_admin_bar_uninstall');

function ba_admin_bar_install() {
    
}

function ba_admin_bar_uninstall() {

}

/* API - BEGIN */
function admin_icon($id, $dual = false) {
    if ($dual) {
        $icon = site_url("/wp-includes/images/special-icons/admin-bar/$id.png");
        $html = "<style>.menupop .admin-bar-icon-$id { background: url($icon); } .menupop.hover .admin-bar-icon-$id { background-position: 0px -16px; }</style>"
              . "<div class=\"admin-bar-icon admin-bar-icon-$id\"></div>";
    } else {
        $icon = site_url("/wp-includes/images/special-icons/admin-bar/$id.png");
        $html = "<img class=\"admin-bar-icon admin-bar-icon-$id\" src=\"$icon\" height=\"16\" width=\"16\" />";
    }
    return $html;
}
/* API -  END  */


/* Author menus - BEGIN */

function ba_admin_bar_author_menu() {
    if  (getBaForm(get_current_user_id(), 'author-menu', '', '', 'authors')) {
        global $AuthorMenu; $AuthorMenu = new AuthorMenu();
    }
}

function ba_admin_bar_guest_menu() {
    global $wp_admin_bar;

    $wp_admin_bar->add_menu(array(
        'id' => 'ba-home',
        'title' => admin_icon('ba-home'),
        'href' => '//cucak.am',
        'meta' => array('title' => __('Home'))
    ));
}
/* Author menus - END   */

/*
// User related, aligned right.
add_action( 'admin_bar_menu', 'wp_admin_bar_my_account_menu', 0 );
*add_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
*add_action( 'admin_bar_menu', 'wp_admin_bar_my_account_item', 7 );

// Site related.
add_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 );
add_action( 'admin_bar_menu', 'wp_admin_bar_my_sites_menu', 20 );
*add_action( 'admin_bar_menu', 'wp_admin_bar_site_menu', 30 );
add_action( 'admin_bar_menu', 'wp_admin_bar_updates_menu', 40 );

// Content related.
if ( ! is_network_admin() && ! is_user_admin() ) {
    add_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    add_action( 'admin_bar_menu', 'wp_admin_bar_new_content_menu', 70 );
}
add_action( 'admin_bar_menu', 'wp_admin_bar_edit_menu', 80 );

add_action( 'admin_bar_menu', 'wp_admin_bar_add_secondary_groups', 200 );
*/

add_action( 'add_admin_bar_menus', 'ba_add_admin_bar_menus', 1000 );

function ba_add_admin_bar_menus() {
    /* System Menus */
    remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
    add_action( 'admin_bar_menu', 'ba_admin_bar_search_menu', 40 );
        
    remove_action( 'admin_bar_menu', 'wp_admin_bar_my_account_item', 7 );
    add_action( 'admin_bar_menu', 'ba_admin_bar_my_account_item', 7 );
    
    remove_action( 'admin_bar_menu', 'wp_admin_bar_site_menu', 30);
    add_action( 'admin_bar_menu', 'ba_admin_bar_site_menu', 30);
    
    /* Author menus */
    
    $get_current_user_id = get_current_user_id();
    if ($get_current_user_id > 0) {
        ba_admin_bar_author_menu();
    } else {
        ba_admin_bar_guest_menu();
    }
    
    add_action( 'admin_bar_menu', 'ba_admin_bar_remove_menus', 1000);
}

function ba_admin_bar_remove_menus( $wp_admin_bar ) {
    //$wp_admin_bar->remove_menu('bp-notifications');
}

function ba_admin_bar_my_account_item( $wp_admin_bar ) {
    $user_id      = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url  = get_edit_profile_url( $user_id );

    if ( ! $user_id )
        return;

    $avatar = get_avatar( $user_id, 16 );
    $class  = empty( $avatar ) ? '' : 'with-avatar';

    $wp_admin_bar->add_menu( array(
        'id'        => 'my-account',
        'parent'    => 'top-secondary',
        'title'     => $current_user->display_name,
        'href'      => $profile_url,
        'meta'      => array(
            'class'     => $class,
            'title'     => __('My Account'),
        ),
    ) );
}


function ba_admin_bar_site_menu( $wp_admin_bar ) {
    global $current_site;

    // Don't show for logged out users.
    if ( ! is_user_logged_in() )
        return;

    // Show only when the user is a member of this site, or they're a super admin.
    if ( /*! is_user_member_of_blog() && */ ! is_super_admin() )
        return;

    $blogname = get_bloginfo('name');

    if ( empty( $blogname ) )
        $blogname = preg_replace( '#^(https?://)?(www.)?#', '', get_home_url() );

    if ( is_network_admin() ) {
        $blogname = sprintf( __('Network Admin: %s'), esc_html( $current_site->site_name ) );
    } elseif ( is_user_admin() ) {
        $blogname = sprintf( __('Global Dashboard: %s'), esc_html( $current_site->site_name ) );
    }

    $title = wp_html_excerpt( $blogname, 40 );
    if ( $title != $blogname )
        $title = trim( $title ) . '&hellip;';

    $wp_admin_bar->add_menu( array(
        'id'    => 'site-name',
        'title' => $title,
        'href'  => is_admin() ? home_url( '/' ) : admin_url(),
    ) );

    // Create submenu items.

    if ( is_admin() ) {
        // Add an option to visit the site.
        $wp_admin_bar->add_menu( array(
            'parent' => 'site-name',
            'id'     => 'view-site',
            'title'  => __( 'Visit Site' ),
            'href'   => home_url( '/' ),
        ) );

    // We're on the front end, print a copy of the admin menu.
    } else {
        // Add the dashboard item.
        $wp_admin_bar->add_menu( array(
            'parent' => 'site-name',
            'id'     => 'dashboard',
            'title'  => __( 'Dashboard' ),
            'href'   => admin_url(),
        ) );

        // Add the appearance submenu items.
        wp_admin_bar_appearance_menu( $wp_admin_bar );
    }
}

function ba_admin_bar_search_menu( $wp_admin_bar ) {
    if ( is_admin() )
        return;
    
    $wp_admin_bar->remove_menu('search');
    
    $form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch">';
    $form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
    $form .= '<input type="submit" class="adminbar-button" value="' . __('Search') . '"/>';
    $form .= '</form>';

    $wp_admin_bar->add_menu( array(
        //'parent' => 'top-secondary',
        'id'     => 'search',
        'title'  => $form,
        'meta'   => array(
            'class'    => 'admin-bar-search',
            'tabindex' => -1,
        )
    ) );
}
