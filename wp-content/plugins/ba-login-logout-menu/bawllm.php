<?php
/*
Plugin Name: BA Login/Logout menu
Plugin URI: http://cucak.am/
Description: You can now add a correct login & logout link in your WP menus.
Version: 1.0.0
Author: Vahan
Author URI: http://cucak.am/
*/

define( 'BA_LLM_VERSION', '1.0.0' );

add_action( 'plugins_loaded', create_function( '', '
	$filename  = "inc/";
	$filename .= is_admin() ? "backend-" : "frontend-";
	$filename .= defined( "DOING_AJAX" ) && DOING_AJAX ? "" : "no";
	$filename .= "ajax.inc.php";
	if( file_exists( plugin_dir_path( __FILE__ ) . $filename ) )
		include( plugin_dir_path( __FILE__ ) . $filename );
	$filename  = "inc/";
	$filename .= "bothend-";
	$filename .= defined( "DOING_AJAX" ) && DOING_AJAX ? "" : "no";
	$filename .= "ajax.inc.php";
	if( file_exists( plugin_dir_path( __FILE__ ) . $filename ) )
		include( plugin_dir_path( __FILE__ ) . $filename );
' )
 );