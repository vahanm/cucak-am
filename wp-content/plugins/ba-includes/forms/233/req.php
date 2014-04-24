<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the flat location.'));
	
	$error .= require_oneof(
		require_selection('address', __('Please enter the address.')),
		require_length_min('address', 4, __('The address is invalid.')),
		require_length_max('address', 80, _t('Address must be contents %s chars maximum.', 80))
		);
	$error .= require_oneof(
		require_selection('floorquantity', __('Please select the floor quantity of the building.')),
		require_comparison('floornumber', '<=', 'floorquantity' , __('Floor number must be less or equal to floor quantity.'))
		);
	
	$error .= require_selection('floornumber', __('Please select the floor number of the flat.'));
	
	$error .= require_selection('total_area', __('Please enter the total area.'));
	
	$error .= require_comparison('residential_area', '<=', 'total_area' , __('Residential area must be less or equal to total area.'));
	
	
	$error .= require_oneof(
		require_selection('roomquantity', __('Please select the room quantity.')),
		require_comparison('bedroom', '<=', 'roomquantity' , __('Bedroom quantity must be less or equal to room quantity.'))
		);
	
	//$error .= require_selection('floorquantity', __('Please select a floor quantity'));


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
