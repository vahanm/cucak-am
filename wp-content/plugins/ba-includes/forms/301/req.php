<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the land area location.'));
	
	$error .= require_oneof(
		require_selection('address', __('Please enter the address.')),
		require_length_min('address', 4, __('The address is invalid.')),
		require_length_max('address', 80, _t('Address must be contents %s chars maximum.', 80))
		);
	
	$error .= require_selection('land_area', __('Please select the size of the land area.'));

	
	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
