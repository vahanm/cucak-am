<?php

// Add Briteweb top-level menu if does not already exist

add_action( 'admin_menu', 'bw_plugin_menu' );

if ( !function_exists( 'bw_plugin_menu' ) ) {
function bw_plugin_menu() {
	add_menu_page( '#BW Options', '#BW Options', 'manage_options', 'bw_plugin_menu', 'bw_plugin_menu_page', plugins_url( '/images/bw-menu-icon.png' , __FILE__ ) );
}
}

if ( !function_exists( 'bw_plugin_menu_page' ) ) {
function bw_plugin_menu_page() {
	
	?>
	<div class="wrap">
		<h2>#BW Plugin Options</h2>
		<p>This section is for managing #Briteweb plugins.</p>
	</div>
	<?php
	
}
}

?>