<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')
	
	$error .= require_price();
	
	$error .= require_selection('areatype', __('Please select the type.'));
	
	$error .= require_selection('item_location', __('Please select the commercial area location.'));
	
	$error .= require_oneof(
		require_selection('address', __('Please enter the address.')),
		require_length_min('address', 4, __('The address is invalid.')),
		require_length_max('address', 80, _t('Address must be contents %s chars maximum.', 80))
		);
	
	$error .= require_comparison('floornumber', '<=', 'floorquantity' , __('Floor number must be less or equal to floor quantity.'));
		
	$error .= require_selection('total_area', __('Please select the total area.'));
	
	$error .= require_selection('renovation', __('Please select renovation state.'));	
	

	$error .= require_selection_of_one('parking', array('none','indoor','outdoor'), __('Please select parking possibility.'));
	
	$error .= require_length_max('previously', 35, _t('Previous description must be contents %s chars maximum.', 35));
	
	//$error .= require_selection('floorquantity', __('Please select a floor quantity'));


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
