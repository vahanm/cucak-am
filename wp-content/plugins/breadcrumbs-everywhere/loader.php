<?php
/*
/**
 * Plugin Name: Breadcrumbs Everywhere
 * Plugin URI: http://www.umaitech.com/cms/?p=154
 * Description: Adds breadcrumb trail navigation to BuddyPress. Simple, just add one line of code to your template.
 * Requires: WordPress 3.0 / BuddyPress 1.5
 * Compatible up to: WordPress 3.5.1 / BuddyPress 1.7-beta1
 * Author: Betsy Kimak
 * Version: 1.4
 * Author URI: http://www.umaitech.com
 * Tags: buddypress, wordpress, breadcrumb, navigation, theme, developer
 * License: GPL2
 

Copyright 2012 Betsy Kimak

This script is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This script is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details: http://www.gnu.org/licenses/

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( !defined( 'CRUMBS_PLUGIN_NAME' ) ) {
	global $wpdb;
	define ( 'CRUMBS_PLUGIN_NAME', 'Breadcrumbs Everywhere');
	define ( 'CRUMBS_IS_INSTALLED', 1 );
	define ( 'CRUMBS_VERSION', '1.0' );
	define ( 'CRUMBS_DIRNAME', str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );
	define ( 'CRUMBS_PLUGIN_DIR',  WP_PLUGIN_DIR . '/' . CRUMBS_DIRNAME );
	define ( 'CRUMBS_PLUGIN_URL', WP_PLUGIN_URL . '/' . CRUMBS_DIRNAME );
}


/* Only load the component if BuddyPress is loaded and initialized. */
function crumbs_init() {
    require_once( CRUMBS_PLUGIN_DIR . '/includes/crumbs-core.php' );
	require_once( CRUMBS_PLUGIN_DIR . '/includes/crumbs-admin.php' );
}

if ( defined( 'BP_VERSION' ) || did_action( 'bp_init' ) )
	crumbs_init();
else
	//add_action( 'bp_init', 'crumbs_init' ); //* v. 1.0
	add_action( 'bp_include', 'crumbs_init' ); //* v. 1.1

/* If you have code that does not need BuddyPress to run, then add it here. */

?>