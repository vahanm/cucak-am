<?php
/*
Plugin Name: BA BuddyPress Integration Component
Plugin URI: http://cucak.am/
Description: BA BuddyPress Integration Component
Version: 1.0.0
Revision Date: Jun 24, 2013
Requires at least: WP 3.2.1, BuddyPress 1.2.9
Tested up to: What WP 3.2.1, BuddyPress 1.2.9
License: 
Author: Vahan Mkhitaryan
Author URI: http://myprojects.0fees.net
Network: true
*/

// Define a constant that can be checked to see if the component is installed or not.
define( 'BP_BA_INTEGRATION_IS_INSTALLED', 1 );

// Define a constant that will hold the current version number of the component
// This can be useful if you need to run update scripts or do compatibility checks in the future
define( 'BP_BA_INTEGRATION_VERSION', '1.6.1' );

// Define a constant that we can use to construct file paths throughout the component
define( 'BP_BA_INTEGRATION_PLUGIN_DIR', dirname( __FILE__ ) );

/* Define a constant that will hold the database version number that can be used for upgrading the DB
 *
 * NOTE: When table defintions change and you need to upgrade,
 * make sure that you increment this constant so that it runs the install function again.
 *
 * Also, if you have errors when testing the component for the first time, make sure that you check to
 * see if the table(s) got created. If not, you'll most likely need to increment this constant as
 * BP_BA_INTEGRATION_DB_VERSION was written to the wp_usermeta table and the install function will not be
 * triggered again unless you increment the version to a number higher than stored in the meta data.
 */
define ( 'BP_BA_INTEGRATION_DB_VERSION', '1' );

/* Only load the component if BuddyPress is loaded and initialized. */
function bp_ba_integration_init() {
	// Because our loader file uses BP_Component, it requires BP 1.5 or greater.
	if ( version_compare( BP_VERSION, '1.3', '>' ) )
		require( dirname( __FILE__ ) . '/includes/bp-ba-integration-loader.php' );
}
add_action( 'bp_include', 'bp_ba_integration_init' );

/* Put setup procedures to be run when the plugin is activated in the following function */
function bp_ba_integration_activate() {

}
register_activation_hook( __FILE__, 'bp_ba_integration_activate' );

/* On deacativation, clean up anything your component has added. */
function bp_ba_integration_deactivate() {
	/* You might want to delete any options or tables that your component created. */
}
register_deactivation_hook( __FILE__, 'bp_ba_integration_deactivate' );
