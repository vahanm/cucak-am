<?php
/* Plugin Name: BA Animated tooltips
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Replacing tooltips with animated.
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-tooltip', $plugindir . '/ba-tooltip.js', array('jQuery', 'jQuery UI'), '1.1');
