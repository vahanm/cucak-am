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

	$error .= require_selection('notebooktype', __('Please select the type.'));
	
	$error .= require_oneof(
		require_selection('notnetmodel', __('Please enter the notebook (netbook) model.')),
		require_length_min('notnetmodel', 5, __('Notebook (netbook) model is invalid.')),
		require_length_max('notnetmodel', 40, _t('Notebook (netbook) model must be contents %s chars maximum.',40))
		);
	
	
	$error .= require_length_min('opersystem', 2, __('Name of the operating system is invalid.'));
	
	$error .= require_length_max('opersystem', 30, _t('Name of the operating system must be contents %s chars maximum.', 30));		
	
	$error .= require_oneof(
		require_selection('cpu', __('Please enter the processor model.')),
		require_length_min('cpu', 2, __('Processor model is invalid.')),
		require_length_max('cpu', 30, _t('Processor model must be contents %s chars maximum.',30))
		);
	
	$error .= require_selection('cpufrequency', __('Please select the processor frequency.'));
	
	$error .= require_selection('ram', __('Please select the RAM size.'));
	
	$error .= require_selection('hdd', __('Please select the HDD memory size.'));
	
	$error .= require_selection('display', __('Please select the display diagonal.'));	
		
	$error .= require_length_max('videocard', 30, _t('Video card model must be contents %s chars maximum.', 30));		
	
	
	
	
	

	
	


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
