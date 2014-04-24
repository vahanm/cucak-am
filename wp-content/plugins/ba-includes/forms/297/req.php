<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the country.'));

//	$error .= require_selection('item_condition', __('Please select the item condition.'));
	
	$error .= require_oneof(
		require_selection('busmodel', __('Please enter the model.')),
		require_length_min('busmodel', 2, __('Model is invalid.')),
		require_length_max('busmodel', 30, _t('Model must be contents %s chars maximum.',30))
		);
	
	$error .= require_selection('customsclearance', __('Please select the customs clearance.'));
	
	$error .= require_selection('yearcar', __('Please select the year.'));
	
	$error .= require_selection('mileage', __('Please enter the mileage.'));
	
	//$error .= require_selection('transmission', __('Please select the transmission.'));
	
	$error .= require_selection_of_one('fuel', array(
		'petrol', 
		'diesel', 
		'gas',
		'liquidgas',
		'electric',
		'hybrid',
		'other'		
		), __('Please select the fuel type.'));		
	
	$error .= require_selection('enginevolume', __('Please select the engine volume.'));
	
	$error .= require_selection('cylinders', __('Please select the cylinders quantity.'));
	
//	$error .= require_selection('thecountry', __('Please select the country.'));
	
	

	
	$error .= require_selection('carcolor', __('Please select the bus color.'));	
	


	///////////////////////////////////////////////////////////////////////////////////	

	return $error;
}
?>
