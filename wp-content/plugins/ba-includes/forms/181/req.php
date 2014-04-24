﻿<?php
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
		require_length_min('hddmodel', 2, __('Model is invalid.')),
		require_length_max('hddmodel', 30, _t('Model must be contents %s chars maximum.',30))
		);

	$error .= require_selection('interface', __('Please select the interface type.'));
	
	$error .= require_selection('hddmemorysize', __('Please select the HDD memory size.'));

	


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>