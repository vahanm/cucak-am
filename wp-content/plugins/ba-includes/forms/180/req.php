<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the item location.'));
	
	
	$error .= require_selection('item_condition', __('Please select the item condition.'));

	$error .= require_oneof(
		require_selection('mbmodel', __('Please enter the model.')),
		require_length_min('mbmodel', 2, __('Model is invalid.')),
		require_length_max('mbmodel', 30, _t('Model must be contents %s chars maximum.',30))
		);

	$error .= require_selection('cpusocket', __('Please select the processor socket.'));

	
	$error .= require_selection_of_one('dimm_socket', array('sdr', 'ddr', 'ddr2', 'ddr3', 'other'), __('Please select the DIMM socket.'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>

