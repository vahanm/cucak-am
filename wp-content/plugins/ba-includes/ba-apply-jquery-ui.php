<?php
/* Plugin Name: BA Apply jQuery UI
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Apply jQuery UI Visual Style
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-apply-jquery-ui', $plugindir . '/ba-apply-jquery-ui.js', array('jQuery', 'jQuery UI'), '1.1');
