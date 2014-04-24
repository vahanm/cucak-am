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
	
	
	/*
	$error .= require_selection('carbrand', __('Please select the brand.'));
	
	
	$error .= require_oneof(
		require_selection('carmodelname', __('Please enter the model.')),
		require_length_min('carmodelname', 2, __('Model is invalid.')),
		require_length_max('carmodelname', 30, _t('Model must be contents %s chars maximum.',30))
		);
	*/
		
	$error .= require_oneof(
		require_numbercomparison('carbrand', '>', 0 , __('Please select the brand.')),
		require_selection('carbrand', __('Please select the brand.')),
		require_selection('carmodel', __('Please select the model.')),
		require_selection('carmodelname', __('Please enter the model.')),
		require_length_min('carmodelname', 2, __('Model is invalid.')),
		require_length_max('carmodelname', 30, _t('Model must be contents %s chars maximum.',30))
		);	
	
	/*
	$error .= require_oneof(
		require_selection('minibusmodel', __('Please enter the model.')),
		require_length_min('minibusmodel', 2, __('Model is invalid.')),
		require_length_max('minibusmodel', 30, _t('Model must be contents %s chars maximum.',30))
		);
	*/
	$error .= require_selection('customsclearance', __('Please select the customs clearance.'));
	
	$error .= require_selection('yearcar', __('Please select the year.'));
	
	$error .= require_selection('mileage', __('Please enter the mileage.'));
	
//	$error .= require_selection('transmission', __('Please select the transmission.'));
	
	//$error .= require_selection('drivetrain', __('Please select the drivetrain type.'));
	
	$error .= require_oneof(
		require_selection_of_one('fuel', array(
					'petrol', 
					'diesel', 
					'gas',
					'liquidgas',
					'electric',
					'hybrid',
					'other'		
					), __('Please select the fuel type.')),
			
			
			require_selection_of('fuel', 3,  array(
					'petrol', 
					'diesel', 
					'gas',
					'liquidgas',
					'electric',
					'hybrid',
					'other'	
					), _t('Max %s fuel type should be selected.', 3))
			);
	
	$error .= require_selection('enginevolume', __('Please select the engine volume.'));
			
	$error .= require_selection('cylinders', __('Please select the cylinders quantity.'));
					
	$error .= require_selection('rudder', __('Please select the rudder side.'));
	
	//$error .= require_selection('thecountry', __('Please select the country.'));
	
		
	$error .= require_selection('carcolor', __('Please select the minibus color.'));	


	


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
