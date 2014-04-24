<?php
/*
Plugin Name: Browser Update Ribbon
Plugin URI: http://www.duckinformatica.it
Description: Puts a ribbon on the website if the user browser is older than expected.
Author: duckinformatica, whiletrue
Version: 1.2.2
Author URI: http://www.duckinformatica.it
*/

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2, 
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

add_action('wp_footer', 'browser_update_ribbon_show');

add_filter('plugin_action_links', 'browser_update_ribbon_add_settings_link', 10, 2 );

add_action('admin_menu', 'browser_update_ribbon_menu');


//GET ARRAY OF STORED VALUES
$browser_update_ribbon_option = browser_update_ribbon_get_options_stored();


function browser_update_ribbon_menu() {
	add_options_page('Browser Update Ribbon Options', 'Update Ribbon', 'manage_options', 'browser_update_ribbon_options', 'browser_update_ribbon_options');
}


function browser_update_ribbon_add_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
 
	if ($file == $this_plugin){
		$settings_link = '<a href="admin.php?page=browser_update_ribbon_options">'.__("Settings").'</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
} 


function browser_update_ribbon_show () {
	if(is_admin()){
		return;
	}

	global $browser_update_ribbon_option;
	
	require_once('browser.php');
	$browser = new Browser();

	$browser_name = strtolower(str_replace(' ', '_', $browser->getBrowser()));
	
	if ($browser_update_ribbon_option['debug']) {
		echo 'Detected browser: '.$browser_name.' -- Detected version: '.(int)$browser->getVersion().' -- User agent string: '.$browser->getUserAgent().'<br />';
	}
	if(isset($browser_update_ribbon_option['blocked_browsers'][$browser_name]) 
	and $browser_update_ribbon_option['blocked_browsers'][$browser_name] > (int)$browser->getVersion()) {
            $img_url = get_option('siteurl').'/wp-content/plugins/' . basename(dirname(__FILE__)).'/browser_update_ribbon_' . WPLANG . '.png';
		$target = ($browser_update_ribbon_option['link_target']=='blank') ? ' target="_blank" ' : '';
		echo '<a href="'.$browser_update_ribbon_option['link'].'" title="'.$browser_update_ribbon_option['title'].'" '.$target.'><img src="'.$img_url.'" 
			alt="'.$browser_update_ribbon_option['title'].'" title="'.$browser_update_ribbon_option['title'].'" 
			style="position: fixed; top:0; left: 0; z-index: 100000; cursor: pointer; border:none; background-color:transparent;" /></a>';
	}
}




function browser_update_ribbon_options () {

	$option_name = 'browser_update_ribbon';

	//must check that the user has the required capability 
	if (!current_user_can('manage_options')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	$browsers = array(
		'chrome',
		'firefox',
		'internet_explorer',
		'opera',
		'safari'
	);	
		
	$out = '';
	
	// See if the user has posted us some information
	if( isset($_POST[$option_name.'_title'])) {
		$option = array();

		foreach ($browsers as $item) {
			$option['blocked_browsers'][$item]  = esc_html($_POST[$option_name.'_blocked_'.$item]);
		}
		$option['title'] = esc_html($_POST[$option_name.'_title']);
		$option['link']  = esc_html($_POST[$option_name.'_link']);
		$option['link_target']  = esc_html($_POST[$option_name.'_link_target']);
		$option['debug'] = (isset($_POST[$option_name.'_debug']) and $_POST[$option_name.'_debug']=='on') ? true : false;
		
		update_option($option_name, $option);
		// Put a settings updated message on the screen
		$out .= '<div class="updated"><p><strong>'.__('Settings saved.', 'menu-test' ).'</strong></p></div>';
	}
	
	//GET (EVENTUALLY UPDATED) ARRAY OF STORED VALUES
	$option = browser_update_ribbon_get_options_stored();
	
	$debug = ($option['debug']) ? 'checked="checked"' : '';
	$link_target_blank = ($option['link_target']=='blank') ? 'selected="selected"' : '';
	
	// SETTINGS FORM

	$out .= '
	<style>
		#browser_update_ribbon_form h3 { cursor: default; }
		#browser_update_ribbon_form td { vertical-align:top; padding-bottom:15px; }
	</style>
	
	<div class="wrap">
	<h2>'.__( 'Browser Update Ribbon', 'menu-test' ).'</h2>
	<div id="poststuff" style="padding-top:10px; position:relative;">

	<div>

		<form id="browser_update_ribbon_form" name="form1" method="post" action="">

		<div class="postbox">
		<h3>'.__("General options", 'menu-test' ).'</h3>
		<div class="inside">
			<table>
			<tr><td style="width:130px;">'.__("Browsers control", 'menu-test' ).':<br /><br />
				<span class="description">'.__("To disable for some browser, set value to 1", 'menu-test' ).'</span>
			</td>
			<td>';
		
			$out .= '<ul>';
			
			foreach (array_keys($option['blocked_browsers']) as $name) {

				$out .= '<li class="ui-state-default" id="'.$name.'" style="width:300px;">
						<div style="float:left; width:150px;">
							<b>'.ucwords(str_replace('_', ' ', $name)).'</b>
						</div>
						<div style="float:left; width:150px;">
							'.__('Minimum version','menu-test').': <input type="text" name="'.$option_name.'_blocked_'.$name.'" value="'.stripslashes($option['blocked_browsers'][$name]).'" style="width:35px; margin:0; padding:0; text-align:right;" />
						</div>
					</li>';
			}

			$out .= '</ul>';


			$out .= '</td></tr>
			<tr><td>'.__("Title", 'menu-test' ).':</td>
			<td><input type="text" name="'.$option_name.'_title" value="'.stripslashes($option['title']).'" size="60" /><br />
				<span class="description">'.__("Text shown when the user's mouse is over the ribbon", 'menu-test' ).'</span>
			</td></tr>
			<tr><td>'.__("Link", 'menu-test' ).':</td>
			<td><input type="text" name="'.$option_name.'_link" value="'.stripslashes($option['link']).'" size="60" /><br />
				<span class="description">'.__("Link activated when the user clicks on the ribbon. The link can be a page of your website or an external url", 'menu-test' ).'</span>
			</td></tr>
			<tr><td>'.__("Link target", 'menu-test' ).':</td>
			<td><select name="'.$option_name.'_link_target">
				<option value=""> '.__('same window', 'menu-test' ).'</option>
				<option value="blank" '.$link_target_blank.' > '.__('new window', 'menu-test' ).'</option>
				</select>
			</td></tr>
			<tr><td>'.__("Debug mode", 'menu-test' ).':</td>
			<td><input type="checkbox" name="'.$option_name.'_debug" '.$debug.' />
					<span class="description">'.__("Enable debug mode (shows browser version in the footer)", 'menu-test' ).'</span>
			</td></tr>
			</table>
		</div>
		</div>'
		.'<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="'.esc_attr('Save Changes').'" />
		</p>

		</form>

	</div>
	
	</div>
	</div>
	';
	echo $out; 
}


// PRIVATE FUNCTIONS

function browser_update_ribbon_box_content ($title, $content) {
	if (is_array($content)) {
		$content_string = '<table>';
		foreach ($content as $name=>$value) {
			$content_string .= '<tr>
				<td style="width:130px;">'.__($name, 'menu-test' ).':</td>	
				<td>'.$value.'</td>
				</tr>';
		}
		$content_string .= '</table>';
	} else {
		$content_string = $content;
	}

	$out = '
		<div class="postbox">
			<h3>'.__($title, 'menu-test' ).'</h3>
			<div class="inside">'.$content_string.'</div>
		</div>
		';
	return $out;
}


function browser_update_ribbon_get_options_stored () {
	//GET ARRAY OF STORED VALUES
	$option = get_option('browser_update_ribbon');
	 
	if(!is_array($option)) {
		$option = array();
	}	
	
	// MERGE DEFAULT AND STORED OPTIONS
	$option_default = browser_update_ribbon_get_options_default();
	$option = array_merge($option_default, $option);

	return $option;
}

function browser_update_ribbon_get_options_default () {
	$option = array();
    $option['title'] = __('Please update your browser');
	$option['link'] = 'http://www.updateyourbrowser.net/en/';
	$option['link_target'] = '';
	$option['debug'] = false;

	// THE NUMBER REPRESENTS THE MINUMUM ACCEPTED VERSION
	$option['blocked_browsers'] = array( 
		'chrome'=>'26',
		'firefox'=>'20',
		'internet_explorer'=>'8',
		'opera'=>'12',
		'safari'=>'6'
	);
	return $option;
}
