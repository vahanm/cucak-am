<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

//-------------------------------------------------------------------------------------------------------------------------------
// ADMIN & FRONT-END
//-------------------------------------------------------------------------------------------------------------------------------

// Version

if ( isset( $this->option['version'] ) ) {
	
	if ( version_compare( $this->option['version'], $this->info['version'], '<' ) ) {
		
		$this->upgrade(); // do upgrade
		
	} elseif ( version_compare( $this->option['version'], $this->info['version'], '>' ) ) {
		
		add_action( 'admin_notices', array( &$this, 'downgrade_notice' ) );
		return; // stop executing file
		
	}
	
}

// Copy $_GET | stripslashes, trim

$this->GET = $this->striptrim_deep( $_GET );

// Delete user if trigger in URL

if ( isset( $this->GET[$this->info['trigger']] ) ) {
	
	$this->delete_user();
	
}

//-------------------------------------------------------------------------------------------------------------------------------
// ADMIN
//-------------------------------------------------------------------------------------------------------------------------------

if ( is_admin() ) {
	
	$this->POST = $this->striptrim_deep( $_POST ); // Copy $_POST | stripslashes, trim
	
	$this->admin_init();
	
	return;
	
}

//-------------------------------------------------------------------------------------------------------------------------------
// FRONT-END
//-------------------------------------------------------------------------------------------------------------------------------

// Actions

add_action( 'wp', array( &$this, 'add_shortcodes' ) );
?>