<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Settings page

add_submenu_page(
	'options-general.php',				// parent menu slug or wordpress filename
	$this->info['name'] . ' Settings',			// page <title>
	$this->info['name'],					// submenu title
	'delete_users',					// capability
	$this->info['slug_prefix'] . '_settings',		// unique page slug (i.e. ?page=slug)
	array( &$this, 'admin_page_settings' )		// function to be called to output the page
);
?>