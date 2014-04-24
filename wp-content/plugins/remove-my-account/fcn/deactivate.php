<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Deactivate

if ( $this->option['settings']['uninstall_on_deactivate'] == true ) {
	
	// Remove capability
	
	foreach ( $this->wp_roles->role_objects as $role ) {
		
		$role->remove_cap( $this->info['cap'] );
		
	}
	
	// Delete option
	
	delete_option( $this->info['option'] );
	
}
?>