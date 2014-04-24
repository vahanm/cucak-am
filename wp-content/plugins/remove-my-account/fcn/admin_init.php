<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Actions

add_action( 'admin_menu', array( &$this, 'action_admin_menu' ) );
add_action( 'show_user_profile', array( &$this, 'action_show_user_profile' ) );
?>