<?php
/* Plugin Name: BA Hints
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Replacing tooltips with animated.
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-hint', $plugindir . '/ba-hints.js', array('jQuery', 'jQuery UI'), '1.0');

$helper_hints = array (


// ------------- ------------- -------------- ------------- -------------- ---------
// Grum es nuin ID-n inchvor cankacac HELPER ogtagorceluc, henc araji argumentum
// 'ID' => __('Hushman text'),
// ------------- ------------- -------------- ------------- -------------- ---------

	'location' => __('Open the list and select the location of the transaction object'),

	'aname' => __('Enter the name of the person (company) who is engaged in this transaction'),

	'phone' => __('Enter your phone numbers. Example (010)999-777, (010)99-88-77'),


	'structureyear' => __('Ada d gf dfh gh fgjhj jh jh'),

// -------------- ---------------- ----------------- ----------------- -------------

	'none' => ''

);


function the_hint($id)
{
	echo ' hint="test:' . $helper_hints[$id] . '" ';
	
	//if($helper_hints[$id])
	//{
	//	echo ' hint="' . $helper_hints[$id] . '" ';
	//}
}








