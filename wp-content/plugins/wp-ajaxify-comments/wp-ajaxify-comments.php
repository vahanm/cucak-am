<?php
/*
Plugin Name: WP-Ajaxify-Comments
Plugin URI: http://wordpress.org/extend/plugins/wp-ajaxify-comments/
Description: WP-Ajaxify-Comments hooks into your current theme and adds AJAX functionality to the comment form.
Author: Jan Jonas
Author URI: http://janjonas.net
Version: 0.6.3
License: GPLv2
Text Domain: wpac
*/ 

/*  
	Copyright 2012, Jan Jonas, (email : mail@janjonas.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('WPAC_PLUGIN_NAME', 'WP-Ajaxify-Comments');
define('WPAC_SETTINGS_URL', 'admin.php?page='.WPAC_PLUGIN_NAME);
define('WPAC_DOMAIN', 'wpac');
define('WPAC_SESSION_VAR', WPAC_DOMAIN.'_session');
define('WPAC_OPTION_PREFIX', WPAC_DOMAIN.'_');

$wpac_config = array(
	array(
		'section' => 'General',
		'options' => array(
			'enable' => array(
				'type' => 'boolean',
				'default' => '0',
				'label' => 'Enabled plugin:',
			),
			'debug' => array(
				'type' => 'boolean',
				'default' => '0',
				'label' => 'Debug mode:',
			),
		),
	),
	array(
		'section' => 'Selectors',
		'options' => array(
			'selectorCommentForm' => array(
				'type' => 'string',
				'default' => '#commentform',
				'label' => 'Comment form selector:',
			),
			'selectorCommentsContainer' => array(
				'type' => 'string',
				'default' => '#comments',
				'label' => 'Comments container selector:',
			),
			'selectorRespondContainer' => array(
				'type' => 'string',
				'default' => '#respond',
				'label' => 'Respond container selector:',
			),
			'selectorErrorContainer' => array(
				'type' => 'string',
				'default' => 'p:parent',
				'label' => 'Error container selector:',
			),
		),
	),
	array(
		'section' => 'Popup overlay',
		'options' => array(
			'popupCornerRadius' => array(
				'type' => 'int',
				'default' => '5',
				'label' => 'Corner radius (px):',
				'pattern' => '/^[0-9]*$/',
			),
			'popupMarginTop' => array(
				'type' => 'int',
				'default' => '10',
				'label' => 'Margin top (px):',
				'pattern' => '/^[0-9]*$/',
			),
			'popupFadeIn' => array(
				'type' => 'int',
				'default' => '400',
				'label' => 'Fade in time (ms):',
				'pattern' => '/^[0-9]*$/',
			),
			'popupFadeOut' => array(
				'type' => 'int',
				'default' => '400',
				'label' => 'Fade out time (ms):',
				'pattern' => '/^[0-9]*$/',
			),
			'popupTimeout' => array(
				'type' => 'int',
				'default' => '3000',
				'label' => 'Timeout (ms):',
				'pattern' => '/^[0-9]*$/',
			),
			'popupBackgroundColorLoading' => array(
				'type' => 'string',
				'default' => '#000',
				'label' => 'Loading background color:',
			),
			'popupTextColorLoading' => array(
				'type' => 'string',
				'default' => '#fff',
				'label' => 'Loading text color:',
			),
			'popupBackgroundColorSuccess' => array(
				'type' => 'string',
				'default' => '#008000',
				'label' => 'Success background color:',
			),
			'popupTextColorSuccess' => array(
				'type' => 'string',
				'default' => '#fff',
				'label' => 'Success text color:',
			),			
			'popupBackgroundColorError' => array(
				'type' => 'string',
				'default' => '#f00',
				'label' => 'Error background color:',
			),
			'popupTextColorError' => array(
				'type' => 'string',
				'default' => '#fff',
				'label' => 'Error text color:',
			),			
			'popupOpacity' => array(
				'type' => 'int',
				'default' => '70',
				'label' => 'Opacity (%):',
				'pattern' => '/^(100|[1-9][0-9]|[1-9])$/',
			),
			'popupTextAlign' => array(
				'type' => 'string',
				'default' => 'center',
				'label' => 'Text align (left|center|right):',
				'pattern' => '/^(left|center|right)$/',
			),
			'popupZindex' => array(
				'type' => 'int',
				'default' => '1000',
				'label' => 'Z-Index:',
				'pattern' => '/^[0-9]*$/',
			),
		),
	),
	array(
		'section' => 'Miscellaneous',
		'options' => array(
			'scrollSpeed' => array(
				'type' => 'int',
				'default' => '500',
				'label' => 'Scroll speed (ms):',
			),
		)
	)
	,array(
		'section' => 'Expert settings (JavaScript callbacks)',
		'options' => array(
			'callbackOnBeforeUpdateComments' => array(
				'type' => 'multiline',
				'default' => '',
				'label' => 'Before update comments',
				'specialOption' => true,
			),
			'callbackOnAfterUpdateComments' => array(
				'type' => 'multiline',
				'default' => '',
				'label' => 'After update comments',
				'specialOption' => true,
			),
		)
	)
);

function wpac_enqueue_scripts() {
	$version = wpac_get_version();
	wp_enqueue_script('jQueryBlockUi', WP_PLUGIN_URL.'/wp-ajaxify-comments/jquery.blockUI.js', array('jquery'), $version);
	wp_enqueue_script('ajaxifyComments', WP_PLUGIN_URL.'/wp-ajaxify-comments/wp-ajaxify-comments.js', array('jquery', 'jQueryBlockUi'), $version);
}

function wpac_get_version() {
	if (!function_exists('get_plugins')) require_once(ABSPATH .'wp-admin/includes/plugin.php');
	$data = get_plugin_data(__FILE__);
    return $data['Version'];
}

function wpac_plugins_loaded() {
	$dir = dirname(plugin_basename(__FILE__)).DIRECTORY_SEPARATOR.'languages'.DIRECTORY_SEPARATOR;
	load_plugin_textdomain(WPAC_DOMAIN, false, $dir);
}
add_action('plugins_loaded', 'wpac_plugins_loaded');

function wpac_js_escape($s) {
	return str_replace('"',"\\\"", $s);
}

function wpac_initialize() {

	if (get_option(WPAC_OPTION_PREFIX.'enable')) {

		global $post;
		global $wpac_config;

		echo '<script type="text/javascript">';
		
		// Options
		echo 'var wpac_options = {';
		foreach($wpac_config as $config) {
			foreach($config['options'] as $optionName => $option) {
				if ($option['specialOption']) continue;
				$value = trim(get_option(WPAC_OPTION_PREFIX.$optionName));
				if (strlen($value) == 0) $value = $option['default'];
				echo $optionName.':'.($option['type'] == 'int' ? $value :'"'.wpac_js_escape($value).'"').',';
			}
		}
		echo 'textLoading:"'.wpac_js_escape(__('Posting your comment. Please wait&hellip;', WPAC_DOMAIN)).'",';
		echo 'textUnknownError:"'.wpac_js_escape(__('Something went wrong, your comment has not been posted.', WPAC_DOMAIN)).'",';
		echo 'textPosted:"'.wpac_js_escape(__('Your comment has been posted. Thank you!', WPAC_DOMAIN)).'",';
		echo 'textPostedUnapproved:"'.wpac_js_escape(__('Your comment has been posted and is awaiting moderation. Thank you!', WPAC_DOMAIN)).'",';
		echo 'textReloadPage:"'.wpac_js_escape(__('Reloading page. Please wait&hellip;', WPAC_DOMAIN)).'",';
		echo 'commentsEnabled:'.((is_page() || is_single()) && comments_open($post->ID) ? 'true' : 'false').',';
		echo 'debug:'.(get_option(WPAC_OPTION_PREFIX.'debug') ? 'true' : 'false').',';
		echo 'version:"'.wpac_get_version().'"};';

		// Callbacks
		echo 'var wpac_callbacks = {};';
		echo 'wpac_callbacks["onBeforeUpdateComments"] = function() {'.get_option(WPAC_OPTION_PREFIX.'callbackOnBeforeUpdateComments').'};';
		echo 'wpac_callbacks["onAfterUpdateComments"] = function() {'.get_option(WPAC_OPTION_PREFIX.'callbackOnAfterUpdateComments').'};';
		
		echo '</script>';
		
	}
}

function wpac_is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

function wpac_add_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
	if ($file == $this_plugin){
		$settings_link = '<a href="'.WPAC_SETTINGS_URL.'">Settings</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}
add_filter('plugin_action_links', 'wpac_add_settings_link', 10, 2);

function wpac_admin_notice() {
	if (basename($_SERVER['PHP_SELF']) == 'plugins.php') {
		if (!get_option(WPAC_OPTION_PREFIX.'enable')) {
			// Show error if plugin is not enabled
			echo '<div class="error"><p><strong>'.WPAC_PLUGIN_NAME.' is not enabled!</strong> Click <a href="'.WPAC_SETTINGS_URL.'">here</a> to configure the plugin.</p></div>';
		} else if (get_option(WPAC_OPTION_PREFIX.'debug')) {
			// Show info if plugin is running in debug mode
			echo '<div class="updated"><p><strong>'.WPAC_PLUGIN_NAME.' is running in debug mode!</strong> Click <a href="'.WPAC_SETTINGS_URL.'">here</a> to configure the plugin.</p></div>';
		}
	}
}
add_action('admin_notices', 'wpac_admin_notice');

function wpac_init()
{
	// Start session
	if (!session_id()) {
		@session_cache_limiter('private, must-revalidate');
		@session_cache_expire(0);
		@session_start();	
	}

	// Update session var and add header if session var is defined
	if (isset($_SESSION[WPAC_SESSION_VAR]) && $_SESSION[WPAC_SESSION_VAR]) {
		$currentUrl = 'http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') ? 's' : '')
			.'://'.$_SERVER['SERVER_NAME'].($_SERVER['SERVER_PORT'] != '80' ? ':'.$_SERVER['SERVER_PORT'] : '').$_SERVER['REQUEST_URI'];
		$sessionUrl = $_SESSION[WPAC_SESSION_VAR]['url'];
		if ($sessionUrl !== $currentUrl && strpos($sessionUrl, $currentUrl.'#') !== 0) {	
			$_SESSION[WPAC_SESSION_VAR] = null;
		} else  {
			header('X-WPAC-UNAPPROVED: '.$_SESSION[WPAC_SESSION_VAR]['unapproved']);
			header('X-WPAC-URL: '.$sessionUrl);
		}
	}
}
add_action('init', 'wpac_init');

function wpac_comment_post_redirect($location)
{
	global $comment;

	// Save comment data in session
	$_SESSION[WPAC_SESSION_VAR] = array(
		'url' => $location, 
		'unapproved' => ($comment && $comment->comment_approved == '0') ? '1' : '0',
	);
	
	return $location;
}
add_action('comment_post_redirect', 'wpac_comment_post_redirect');

function wpac_option_page() {
	if (!current_user_can('manage_options'))  {
		wp_die('You do not have sufficient permissions to access this page.');
	} 

	global $wpac_config;
	
	$errors = array();
	
	if (!empty($_POST) && isset($_POST['wpac']) && check_admin_referer('wpac_update_settings','wpac_nonce_field'))
	{
		foreach($_POST['wpac'] as $section => $options) {
		
			foreach ($options as $optionName => $value) {

				if (!isset($wpac_config[$section])) continue;
				if (!isset($wpac_config[$section]['options'][$optionName])) continue;
			
				$value = trim(stripslashes($value));
				$pattern = isset($wpac_config[$section]['options'][$optionName]['pattern']) ? $wpac_config[$section]['options'][$optionName]['pattern'] : null;
				
				if (strlen($value) > 0) {
					$error = $pattern ? (preg_match($pattern, $value) !== 1) : null;
					if ($error) {
						$errors[] = $optionName;
					} else {
						update_option(WPAC_OPTION_PREFIX.$optionName, $value);
					}
				} else {
					delete_option(WPAC_OPTION_PREFIX.$optionName);
				}
			
			}
		
		}
		
		if (count($errors) == 0) {
			echo '<div class="updated"><p><strong>Settings saved successfully.</strong></p></div>';
		} else {
			echo '<div class="error"><p><strong>Settings not saved! Please correct the red marked input fields.</strong></p></div>';
		}
	}
  
  ?>
	<div class="wrap">
	<h2>Plugin Settings: <?php echo WPAC_PLUGIN_NAME.' '.wpac_get_version(); ?></h2>

	<div class="postbox-container" style="width: 100%;" >

		<form name="wp-ajaxify-comments-settings-update" method="post" action="">
			<?php if (function_exists('wp_nonce_field') === true) wp_nonce_field('wpac_update_settings','wpac_nonce_field'); ?>	 

			<div id="poststuff">
				<div class="postbox">
			
					<h3 id="plugin-settings">Plugin Settings</h3>
					<div class="inside">

						<table class="form-table">

	<?php
	
		$section = 0;
		foreach($wpac_config as $config) {
			echo '<tr><th colspan="2"><h4>'.$config['section'].'</h4></th></tr>';
			foreach($config['options'] as $optionName => $option) {

				$color = in_array($optionName, $errors) ? 'red' : '';

				echo '<tr><th scope="row"><label for="'.$optionName.'" style="color: '.$color.'">'.$option['label'].'</label></th><td>';
				
				$value = (isset($_POST['wpac']) && $_POST['wpac'][$section][$optionName]) ? stripslashes($_POST['wpac'][$section][$optionName]) : get_option(WPAC_OPTION_PREFIX.$optionName);
				$name = 'wpac['.$section.']['.$optionName.']';
				
				if ($option['type'] == 'boolean') {
					echo '<input type="hidden" name="'.$name.'" value="0">';
					echo '<input type="checkbox" name="'.$name.'" id="'.$optionName.'" '.($value ? 'checked="checked"' : '').' value="1"/>';
				} else {
					if ($option['type'] == 'multiline') {
						echo '<textarea name="'.$name.'" id="'.$optionName.'" style="width: 300px; color: '.$color.'">'.htmlentities($value).'</textarea>';
					} else {
						echo '<input type="input" name="'.$name.'" id="'.$optionName.'" value="'.htmlentities($value).'" style="width: 300px; color: '.$color.'"/>';
					} 
					if ($option['default']) echo '<br/>Leave empty for default value <em>'.$option['default'].'</em>';
				}
				echo '</td></tr>';
			}
			$section++;
		}
	
	?>
	
						</table>
						<p class="submit">
						  <input type="hidden" name="action" value="wpac_update_settings"/>
						  <input type="submit" name="wpac_update_settings" class="button-primary" value="Save Changes"/>
						</p>
					</div>
				</div>
			</div>

		</form>	
	
	</div>

	<div class="postbox-container" style="width: 100%;" >

		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="MLKQ3VNZUBEQQ">
			<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">

			<div id="poststuff">
				<div class="postbox">
					<h3 id="plugin-settings">Contact & Donation</h3>
					<div class="inside">	
						<p>If you have trouble using the plugin or you miss a feature please do not hesitate to use the plugin's support forum (<a target="_blank" href="http://wordpress.org/support/plugin/wp-ajaxify-comments">Link</a>).
						</p>
						<p>
							If you would like to support future development, please consider making a small donation. Thank you!
							<br/>
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						</p>
					</div>
				</div>
			</div>
		</form>		
	</div>
		
<?php }

function wpac_admin_menu() {
	add_options_page(WPAC_PLUGIN_NAME, WPAC_PLUGIN_NAME, 'manage_options', WPAC_PLUGIN_NAME, 'wpac_option_page');
}

if (!is_admin() && !wpac_is_login_page()) {
	if (get_option(WPAC_OPTION_PREFIX.'enable')) {
		add_action('wp_head', 'wpac_initialize');
		add_action('init', 'wpac_enqueue_scripts');
	}
} else {
	require_once(ABSPATH.'/wp-admin/includes/plugin.php');
	require_once(ABSPATH.'/wp-admin/includes/template.php');
	require_once(ABSPATH.WPINC.'/pluggable.php');
	add_action('admin_menu', 'wpac_admin_menu');
}

?>