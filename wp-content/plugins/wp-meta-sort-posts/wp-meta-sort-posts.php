<?php

/*
  Plugin Name: WP Meta Sort Posts
  Plugin URI:
  Description: This plugin allows you to create pages of posts sorted using shortcodes. Sort Posts by your custom fields or anything else you can pass to the query_posts function.
  Version: 0.9
  Author: Jason Pitts
  Author URI: http://jasonpitts.com/
  License: GPLv2
 */

/*      USAGE NOTES
 * 
 * query_string allows a full custom query string 
 * 
 * DO NOT ADD offset or page to query string those will be added to the end of the string for you.
 */


/* Handle pages containing shortcode */

function msp_the_posts($args) { //shortcode handler - build query from shortcode arguments

    /* Handle shortcode Arguments */
    if (isset($args['query_string'])) { // if full query string is set use that and skip everything else.
        $the_query = html_entity_decode($args['query_string']); //convert html entites to text
    } else {
        $the_query = '';
        $count_args = 0;
        foreach ($args as $arg => $val) {
            if ($count_args == 0) {
                $the_query .= $arg . '=' . $val;
                $count_args++;
            } else {
                $the_query .= '&' . $arg . '=' . $val;
                $count_args++;
            }
        }
        unset($count_args);
    }


    /* Build the custom query with pagination */

    if (isset($the_query)) {
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($page == 1) {
            $the_modified_query = $the_query . "&paged=" . get_query_var('paged');
        } else {
            $numposts = get_option('posts_per_page');

            // work out pagination offset
            $offset = (($page - 1) * $numposts); // i.e. page 2 - 1 = 1 * 10 (10 for the number of posts)
            $the_modified_query = $the_query . "&offset=$offset" . "&paged=" . get_query_var('paged'); //paged must be set this way
        }
    }
    
    /* Run the Query */

    msp_query_hook($the_modified_query);
}

function msp_query_hook($msp_query) {
    query_posts($msp_query); //perform the modified query

    $MspNavLocation = get_option('msp_nav_location');

    if ($MspNavLocation == 'top' || $MspNavLocation == 'both')
        msp_add_page_nav();


    echo '<div id="msp-sort" class="msp-sort-posts">'; //TODO configure div id/class
    msp_the_loop();
    echo '</div>';


    if ($MspNavLocation == 'bottom' || $MspNavLocation == 'both')
        msp_add_page_nav();

    wp_reset_query(); //reset back to default wordpress query    
}

function msp_add_page_nav() {
    $page_nav = '<div class="post-nav"><p>' . posts_nav_link() . '</div></p>'; //pagination link
    return $page_nav;
}

/* determine which loop to use */

function msp_the_loop() {
    $MspLoopFile = get_option('msp_loop_file'); //get loop file setting

    if (strtolower($MspLoopFile) == "msp") { //set default loop if setting = msp
        include ('msp-loop.php'); //default loop file
    } else {

        get_template_part($MspLoopFile); //get common.php for the list TODO Make configurable, check if exists if not use a simple loop
    }
}

/* Admin Pages and settings */

function msp_admin_menu() {

    add_options_page("Meta Sort Post Plugin Options", "WP Meta Sort Posts Options", "administrator", "msp-options-page", "msp_admin_content");
}

/* Admin Options Form */

function msp_admin_content() {

    include('msp-options.php'); //settings page
}

/* Configures Default Options based on Theme */

function default_msp_settings() {
    $current_theme = get_current_theme();

    if (preg_match("/HeatMap/", $current_theme) > 0) {
        //settings for HeatMap Theme Pro V5
        update_option('msp_loop_file', 'common');
        update_option('msp_nav_location', 'bottom');
        update_option('msp_theme_support', 'yes');
    } elseif ($current_theme == "Twenty Ten") {
        //settings for Twenty Ten Theme
        update_option('msp_loop_file', 'loop');
        update_option('msp_nav_location', 'none');
        update_option('msp_theme_support', 'yes');
    } else {
        //use MSP built-in loop
        update_option('msp_loop_file', 'MSP');
        update_option('msp_nav_location', 'bottom');
        update_option('msp_theme_support', 'no');
    }
}

/* removes settings when plugin is deactivated */

function remove_msp_settings() {
    delete_option('msp_loop_file');
    delete_option('msp_nav_location');
    delete_option('msp_theme_support');
}

/* actions */

register_activation_hook(__FILE__, 'default_msp_settings'); //configures default settings based on current theme
register_deactivation_hook(__FILE__, 'remove_msp_settings'); //removes settings when plugin is removed
add_action('switch_theme', 'default_msp_settings'); //reconfigures default settings when theme is changed (TODO may want to request permission from user)
add_shortcode('msp', 'msp_the_posts'); //adds shortcode functionality


/* TODO possibly needs to check if is admin first */
add_action('admin_menu', 'msp_admin_menu'); //adds admin menu item
?>
