<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Only show message in admin area

if ( is_admin() == false ) {
	
	return; // stop executing file
	
}
?>
<div class="<?php echo $class; ?>">
	<p><?php echo $message; ?></p>
</div>