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
	
	$error .= require_selection('memorysize', __('Please select the RAM size.'));
	
	
	//$error .= require_selection('floorquantity', __('Please select a floor quantity'));


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
