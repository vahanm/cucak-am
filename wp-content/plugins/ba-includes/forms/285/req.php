<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the item location.'));

	$error .= require_selection('item_condition', __('Please select the item condition.'));

	$error .= require_oneof(
		require_selection('phonemodel', __('Please enter the model.')),
		require_length_min('phonemodel', 3, __('Model is invalid.')),
		require_length_max('phonemodel', 30, _t('Model must be contents %s chars maximum.',30))
		);

	//$error .= require_selection('operation_system', __('Please select the name of the operating system.'));
	
	//$error .= require_selection('form', __('Please select the form type.'));
	
	$error .= require_selection('sim', __('Please select the SIM card quantity.'));
	
	$error .= require_selection('touchscreendisplay', __('Please select the display type.'));
	
	//$error .= require_selection('camresol', __('Please select the camera.'));

	$error .= require_selection('box', __('Please select the box.'));
	


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
