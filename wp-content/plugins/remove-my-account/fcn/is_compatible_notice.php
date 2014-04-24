<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}
?>
<div class="error">
	
	<p><strong>Plugin <em style="text-decoration: underline;">Remove My Account</em> not compatible</strong></p>
	
	<p>Detected &rsaquo; PHP <?php echo PHP_VERSION; ?>, WordPress <?php echo $this->wp_version; ?>, Multisite=<?php echo ( version_compare( $this->wp_version, 3.0, '>=' ) == true && is_multisite() == true ) ? 'Yes' : 'No'; ?></p>
	
	<p>Supported &rsaquo; PHP <?php echo $this->info['php_version_min']; ?>+, WordPress <?php echo $this->info['wp_version_min']; ?>+, Multisite=No</p>
	
</div>