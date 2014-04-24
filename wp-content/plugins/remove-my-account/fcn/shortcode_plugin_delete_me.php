<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// User does not have capability, link will not be shown, content ( if any ) inside of shortcode serves as alternative

if ( current_user_can( $this->info['cap'] ) == false ) {
	
	return; // stop execution of this file
	
}

// User has capability, prepare delete link

$attributes = array();

$attributes['href'] = esc_url( add_query_arg( array( $this->info['trigger'] => $this->user_ID, $this->info['nonce'] => wp_create_nonce( $this->info['nonce'] ) ), get_permalink() ) );
$attributes['onclick'] = "if ( confirm( 'WARNING!" . '\n\n' . "Are you sure you want to delete user " . $this->user_login . "?' ) ) { window.location.href=this.href } return false;";
$attributes['class'] = $this->option['settings']['shortcode_class'];
$attributes['style'] = $this->option['settings']['shortcode_style'];

// Remove empty attributes

$attributes = array_filter( $attributes );

// Assemble attributes in key="value" pairs

foreach ( $attributes as $key => $value ) {
	
	$paired_attributes[] = $key . '="' . $value . '"';
	
}

// Implode attributes, return longcode as delete link

$longcode = '<a ' . implode( ' ', $paired_attributes ) . '>' . $this->option['settings']['shortcode_anchor'] . '</a>';
?>