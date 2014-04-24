<?php
/* Plugin Name: BA Default Value Support
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Enabling text input default value support
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

$plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-input-default-value-support', $plugindir . '/inputdefaultvaluesupport.js', array('jQuery', 'jQuery UI'), '1.1');
