<?php
/* Plugin Name: BA Map adapter
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin helps to use maps
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

wp_enqueue_script('googleapis-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '3.exp');

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
wp_enqueue_script('ba-map', $plugindir . '/ba-map.js', array('jQuery', 'jQuery UI', 'googleapis-maps'), '1.0');

function helper_map() {
    
}