<?php
/*
Plugin Name: #BW LESS-CSS
Plugin URI: http://support.briteweb.com/plugins/bw-less-css/
Version: 1.6.1
Description: Helper plugin to compile and include LESS CSS files. 
Author: #BRITEWEB
Author URI: http://www.briteweb.com/
*/



define( 'BW_LESSCSS_SETTINGS_OPTION', 'bw_lesscss' );
define( 'BW_LESSCSS_DB_VERSION', "1.6.1" );

global $bw_less_mobile_devices, $bw_less_options;
$bw_less_mobile_devices = array( 
					"android" => "Android",
					"androidtablet" => "Android Tablet",
					"blackberry" => "Blackberry",
					"blackberrytablet" => "Blackberry Tablet",
					"iphone" => "iPhone, iPod",
					"ipad" => "iPad",
					"palm" => "Palm",
					"windows" => "Windows Mobile",
					"windowsphone" => "Windows Phone",
					"generic" => "Other Mobile"
					);
$bw_less_options = get_option( BW_LESSCSS_SETTINGS_OPTION );

// Update to 1.5+

if ( empty( $bw_less_options['db_version'] ) ) {
	if ( empty( $bw_less_options['styles'] ) && empty( $bw_less_options['mobile_devices'] ) ) {
		$new_devices = array();
		foreach ( $bw_less_mobile_devices as $key=>$row ) $new_devices[] = $key;
	
		$upgrade = array( 'styles' => $bw_less_options, 'mobile_devices' => $new_devices, 'db_version' => BW_LESSCSS_DB_VERSION );
		update_option( BW_LESSCSS_SETTINGS_OPTION, $upgrade );
		$bw_less_options = $upgrade;
	}
}

register_activation_hook( __FILE__, 'bw_lesscss_activation' );
function bw_lesscss_activation() {
	global $bw_less_mobile_devices, $bw_less_options;
	$new_devices = array();
	foreach ( $bw_less_mobile_devices as $key=>$row ) $new_devices[] = $key;
	$default = array( 'styles' => array( array( 'file' => 'style.less', 'active' => 0 ) ), 'mobile_devices' => $new_devices, 'db_version' => BW_LESSCSS_DB_VERSION );
	
	if ( !$bw_less_options ) {
		update_option( BW_LESSCSS_SETTINGS_OPTION, $default );
		$bw_less_options = $default;
	}
}

add_action( 'after_setup_theme', 'bw_lesscss_include' );
function bw_lesscss_include() {
	global $bw_less_options, $bw_mobile;
	$styles = $bw_less_options['styles'];
	$hide_mobile = $bw_less_options['hide_mobile'];
	
	$force = $bw_less_options['dev_mode'] == 1 ? true : false;
	
	if ( !empty( $styles ) )
		foreach ( $styles as $style ) {
			if ( $style['active'] ) {
				$media = ( !empty( $style['cmedia'] ) ) ? $style['cmedia'] : $style['media'];
				if ( $style['mobile'] && empty( $style['cmedia'] ) ) $media = false;
				bw_less_css( $style['file'], array( 'media' => $media, 'minify' => $style['minify'], 'mobile' => $style['mobile'], 'hide_mobile' => $hide_mobile, 'force' => $force ) );
			}
		}
	
}

/* ========| INCLUDE DEPENDENCIES |======== */

require_once( dirname(__FILE__).'/bw_menu.php');// Add BW top-level menu
require_once( dirname(__FILE__).'/lessc.inc.php');
require_once( dirname(__FILE__).'/Mobile_Detect.php');

$detect = new Mobile_Detect( $bw_less_options['mobile_devices'] );
$bw_mobile = $detect->isMobile();
define( 'BW_LESSCSS_IS_MOBILE', $bw_mobile );

function bw_is_mobile() {
	return BW_LESSCSS_IS_MOBILE;
}

/* ========| LESS INCLUDE |======== */

function bw_less_css( $less = "", $args = array() ) {

	$defaults = array( 'media' => 'all', 'minify' => false, 'mobile' => false, 'hide_mobile' => false, 'force' => false );
	extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );
	
	if ( $mobile == 1 && ! BW_LESSCSS_IS_MOBILE ) return;
	if ( $hide_mobile == 1 && !$mobile && BW_LESSCSS_IS_MOBILE ) return;
	if ( is_admin() || empty( $less ) ) return;
		
		$output_name =  $less . '.css';
		
		$changed = false;
		if ( file_exists( STYLESHEETPATH . '/' . $output_name ) && filemtime( STYLESHEETPATH . '/' . $less ) > filemtime( STYLESHEETPATH . '/' . $output_name ) ) $changed = true;
		if ( $force ) $changed = true;

 		try {
			lessc::ccompile( STYLESHEETPATH . '/' . $less, STYLESHEETPATH . '/' . $output_name, $force );
		} catch ( Exception $ex ) {
			wp_die( '<strong>#BW LESS-CSS:</strong> lessc fatal error<br />' . $ex->getMessage() );
		}
		
		if ( $minify && $changed ) {
			require_once( dirname(__FILE__).'/minifycss.php');// CSS minify library
			$css = file_get_contents( STYLESHEETPATH . '/' . $output_name );
			$css = Minify_CSS_Compressor::process( $css );
			file_put_contents( STYLESHEETPATH . '/' . $output_name, $css );
		}
		
		if ( BW_LESSCSS_IS_MOBILE ) $media = "all";
		
		$name = str_replace( '.', '', $less ) . "_css";
		wp_enqueue_style( $name, get_bloginfo( 'stylesheet_directory' ) . '/' . $output_name, false, false, $media );
		
}

/* ========| CREATE ADMIN PAGE |======== */

add_action('admin_print_scripts', 'bw_lesscss_admin_js');
function bw_lesscss_admin_js() {
	wp_enqueue_script( 'bw_lesscss_js', plugins_url( 'bw_js.js', __FILE__ ) );
}

add_action( 'admin_menu', 'bw_lesscss_admin_menu'); // Add admin settings page for plugin
function bw_lesscss_admin_menu() {
	add_submenu_page( 'bw_plugin_menu', '#BW LESS-CSS', 'LESS-CSS', 'manage_options', 'bw-lesscss', 'bw_lesscss_admin');
}

function bw_lesscss_admin_css() {
	wp_enqueue_style( 'bw_admin_css', plugins_url( 'bw_admin.css', __FILE__ ) );
}
add_action( 'admin_print_styles', 'bw_lesscss_admin_css' );

function bw_lesscss_admin() {

	global $bw_less_options, $bw_less_mobile_devices;
	
	$media_types = array( 'all' => 'All', 'print' => 'Print', 'screen' => 'Screen' );
		
	if ( !empty( $_POST ) && $_POST['action'] == 'less_fields_save' && check_admin_referer( 'less_fields_save' ) ) {
	
		$new_styles = array();
								
		foreach ( $_POST['field_file'] as $key=>$name ) {
			if ( !empty( $name ) && strpos( $name, '.less' ) !== false ) {
				$active = ( $_POST['field_active'][$key] == 1 ) ? 1 : 0;
				$minify = ( $_POST['field_minify'][$key] == 1 ) ? 1 : 0;
				$mobile = ( $_POST['field_mobile'][$key] == 1 ) ? 1 : 0;
				
				$new_styles[] = array( 
					'file' => trim( $name ),
					'active' => $active,
					'media' => $_POST['field_media'][$key],
					'cmedia' => $_POST['field_cmedia'][$key],
					'minify' => $minify,
					'mobile' => $mobile
				);
										
			}
		}
				
		$test = array();
		foreach ( $new_styles as $key=>$row ) $test[$key] = $row['file'];
		$unique = array_unique( $test );	
    	$new_styles = array_intersect_key( $new_styles, $unique );
    	
    	$new_devices = array();
    	foreach ( $bw_less_mobile_devices as $key=>$row ) {
    		if ( $_POST['field_devices'][$key] == 1 ) $new_devices[] = $key;
    	}
    	
    	$hide_mobile = ( $_POST['field_hidemobile'] == 1 ) ? 1 : 0;
    	$devmode = ( $_POST['field_devmode'] == 1 ) ? 1 : 0;
    	
    	$new_options = array( 'styles' => $new_styles, 'mobile_devices' => $new_devices, 'hide_mobile' => $hide_mobile, 'dev_mode' => $devmode, 'db_version' => BW_LESSCSS_DB_VERSION );
    	
		update_option( BW_LESSCSS_SETTINGS_OPTION, $new_options );
		$bw_less_options = $new_options;
	
	}
						
	?><div class="wrap">
	
	<h2><img src="<?php echo plugins_url('/images/bw-page-logo.png', __FILE__); ?>" alt="#BW LESS-CSS" /></h2><br />
	
	<div id="info"></div>
	
	<form method="post" id="bw_lesscss_form">
	
	<table class="widefat" style="width:620px">
	<thead>
		<tr>
			<th scope="col" class="check-column">&nbsp;</th>
			<th scope="col">File</th>
			<th scope="col">Media</th>
			<th scope="col">…or Custom Media</th>
			<th scope="col">Mobile Only</th>
			<th scope="col">Minify</th>
			<th scope="col">Active</th>
			<th scope="col">&nbsp;</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope="col" class="check-column">&nbsp;</th>
			<th scope="col">File</th>
			<th scope="col">Media</th>
			<th scope="col">…or Custom Media</th>
			<th scope="col">Mobile Only</th>
			<th scope="col">Minify</th>
			<th scope="col">Active</th>
			<th scope="col">&nbsp;</th>
		</tr>
	</tfoot>
	<tbody class="field-rows">
	<?php foreach ( (array)$bw_less_options['styles'] as $key=>$field ) : ?>	
		<tr class="field-row">
			<td></td>
			<td><input type="text" name="field_file[]" value="<?php echo $field['file']; ?>" /></td>
			<td><select name="field_media[]">
				<?php foreach ( $media_types as $key=>$row ) : ?>
				<option value="<?php echo $key; ?>" <?php selected( $field['media'], $key ); ?>><?php echo $row; ?></option>
				<?php endforeach; ?>
			</select></td>
			<td><input type="text" name="field_cmedia[]" value="<?php echo $field['cmedia']; ?>" /></td>
			<td><input type="checkbox" name="field_mobile[]" value="1" <?php checked( $field['mobile'], 1 ); ?> style="margin-top:7px" /></td>
			<td><input type="checkbox" name="field_minify[]" value="1" <?php checked( $field['minify'], 1 ); ?> style="margin-top:7px" /></td>
			<td><input type="checkbox" name="field_active[]" value="1" <?php checked( $field['active'], 1 ); ?> style="margin-top:7px" /></td>
			<td><a href="#delete" class="bw-delete-field"><img src="<?php echo plugins_url('/images/delete.png', __FILE__); ?>" title="Delete Row" style="margin-top:5px" /></a></td>
		</tr>
	<?php endforeach; ?>
		<tr class="field-row field-template">
			<td><a href="#add" class="bw-add-field"><img src="<?php echo plugins_url('/images/add.png', __FILE__); ?>" title="Delete Row" style="margin-top:5px" /></a></td>
			<td><input type="text" name="field_file[]" value="" /></td>
			<td><select name="field_media[]">
				<?php foreach ( $media_types as $key=>$row ) : ?>
				<option value="<?php echo $key; ?>"><?php echo $row; ?></option>
				<?php endforeach; ?>
			</select></td>
			<td><input type="text" name="field_cmedia[]" value="" /></td>
			<td><input type="checkbox" name="field_mobile[]" value="1" <?php checked( 1, 0 ); ?> style="margin-top:6px;" /></td>
			<td><input type="checkbox" name="field_minify[]" value="1" <?php checked( 1, 1 ); ?> style="margin-top:6px;" /></td>
			<td><input type="checkbox" name="field_active[]" value="1" <?php checked( 1, 1 ); ?> style="margin-top:6px;" /></td>
			<td><a href="#delete" class="bw-delete-field"><img src="<?php echo plugins_url('/images/delete.png', __FILE__); ?>" title="Delete Row" style="margin-top:5px" /></a></td>
		</tr>
	</tbody>
	</table>
	
	<table class="form-table" style="width:620px"><tbody>
	
		<tr valign="top">
			<th scope="row">Hide non-mobile stylesheets on mobile devices?</th>
			<td>
				<input type="checkbox" name="field_hidemobile" value="1" <?php checked( $bw_less_options['hide_mobile'], 1 ); ?> /> <label>&nbsp;</label>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Detect Mobile for:</th>
			<td>
				<?php $num = count( $bw_less_mobile_devices ); $i=0;
				foreach ( $bw_less_mobile_devices as $key=>$row ) :
				$i++;
				if ( in_array( $key, $bw_less_options['mobile_devices'] ) ) $active = 1;
				else $active = 0; ?>
				<input type="checkbox" name="field_devices[<?php echo $key; ?>]" value="1" <?php checked( $active, 1 ); ?> /> <label><?php echo $row; ?></label><br />
				<?php if ( $i == ( ceil( $num / 2 ) ) ) echo "</td><td>";
				endforeach; ?>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Developer Mode<br />
			<small>(forces recompile every page load)</small></th>
			<td>
				<input type="checkbox" name="field_devmode" value="1" <?php checked( $bw_less_options['dev_mode'], 1 ); ?> /> <label>On</label>
			</td>
		</tr>
		
	</tbody></table>
	
	<p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>
	<input type="hidden" name="action" value="less_fields_save" />
	<?php wp_nonce_field( "less_fields_save" ); ?>
	
	</form>
	
	<style type="text/css">
		#bw-dashboard-logo {
		bottom: -18px;
		display: block;
		position: absolute;
		right: -18px;
		}
	</style>
	
	<?php
	
}

/* ========| UTILITY FUNCTIONS |======== */

if ( !function_exists( 'bw_trim_value' ) ) {
function bw_trim_value( &$value ) { 
    $value = trim( $value ); 
}
}

function bw_pre_dump($arr) {
	echo "<pre>";
	var_dump($arr);
	echo "</pre>";
}


?>