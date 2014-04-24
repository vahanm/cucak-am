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

	$error .= require_selection('dcammodel', __('Please enter the camera model.'));	
	
	//$error .= require_selection('imsentype', __('Please select the image sensor type.'));
	
	$error .= require_selection('dcamresol', __('Please select the image resolution.'));
	
	$error .= require_selection('camleans', __('Please select the camera lens.'));
	
	$error .= require_selection('videores', __('Please select the video recording.'));
	
	
	


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
