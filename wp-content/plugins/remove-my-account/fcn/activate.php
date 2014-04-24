<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Activate

if ( empty( $this->option ) ) {
	
	// Add option defaults
	
	add_option( $this->info['option'], $this->default_option );
	
}
?>