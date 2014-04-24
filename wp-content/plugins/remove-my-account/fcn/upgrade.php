<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Record previous version

$previous_version = $this->option['version'];

// Make option changes

$this->option['version'] = $this->info['version'];
$this->option = $this->sync_arrays( $this->default_option, $this->option ); // sync old & new option arrays

// Save changes

$this->save_option(); // update option with the newly synced option array
?>