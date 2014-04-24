<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Does user have the capability?

if ( $profileuser->has_cap( $this->info['cap'] ) == false ) {
	
	return; // stop executing file
	
}

// Does the link is setup to be shown on Profile page?

if ( $this->option['settings']['show_on_profile_page'] == false ) {

	return; // stop executing file

}

// User has capability, prepare delete link

$attributes = array();

$attributes['href'] = esc_url( add_query_arg( array( $this->info['trigger'] => $profileuser->ID, $this->info['nonce'] => wp_create_nonce( $this->info['nonce'] ) ) ) );
$attributes['onclick'] = "if ( confirm( 'WARNING!" . '\n\n' . "Are you sure you want to delete user " . $profileuser->user_login . "?' ) ) { window.location.href=this.href } return false;";
$attributes['class'] = $this->option['settings']['your_profile_class'];
$attributes['style'] = $this->option['settings']['your_profile_style'];

// Remove empty attributes

$attributes = array_filter( $attributes );

// Assemble attributes in key="value" pairs

foreach ( $attributes as $key => $value ) {
	
	$paired_attributes[] = $key . '="' . $value . '"';
	
}

// Output delete link
?>
<table class="form-table">
	
	<tr>
		<th>&nbsp;</th>
		<td><?php echo '<a ' . implode( ' ', $paired_attributes ) . '>' . $this->option['settings']['your_profile_anchor'] . '</a>'; ?></td>
	</tr>
	
</table>