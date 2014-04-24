<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));

helper_group('cpugroup', __('CPU'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used'))
	) );
	
	
helper_text("cpu", __('CPU (processor) model'), __('Please enter the model.'));


helper_select('cpusocket', __('CPU socket'), array( 			
		array(1, '775'),  
		array(2, '1155'),     
		array(3, '1156'), 
		array(4, '1366'),
		array(5, '2011'),
		array(6, 'AM2'), 
		array(7, 'AM2+'),      
		array(8, 'AM3'),     
		array(9, 'AM3+'), 
		array(10, 'FM1'),
		array(11, __('other'))
		) );
	
	

helper_slider('cpufrequency', __('Frequency'), __('Please select'), 0.1, 4, 50, '%s ' . 'GHz','400 ' . 'MHz', '5 ' . 'GHz');

helper_slider('core', __('Core quantity'), __('Please select'), 1, 1, 12, __('%s cores'));

helper_slider_by_list('cache', __('Cache size'), __('Please select'), 1, 18, '%s MB', array(
	1 => '128 ' . 'KB',
	2 => '256 ' . 'KB',
	3 => '512 ' . 'KB',
	4 => '1 ' . 'MB',
	5 => '2 ' . 'MB',
	6 => '3 ' . 'MB',
	7 => '4 ' . 'MB',
	8 => '5 ' . 'MB',
	9 => '6 ' . 'MB',
	10 => '7 ' . 'MB',
	11 => '8 ' . 'MB',
	12 => '9 ' . 'MB',
	13 => '10 ' . 'MB',
	14 => '11 ' . 'MB',
	15 => '12 ' . 'MB',
	16 => '13 ' . 'MB',
	17 => '14 ' . 'MB',
	18 => '15 ' . 'MB'
	),'128 ' . 'KB', '15 ' . 'MB');


helper_yes_no("hyper_threading", 'Hyper Threading');

helper_yes_no("turbo_boost", 'Turbo Boost');

helper_radio('instruction_set', __('Instruction set'), array( array(1, _t('%s bit', 32)),  array(2, _t('%s bit', 64)) ) );

helper_yes_no("integrated_graphics", __('Integrated graphics'));

helper_radio('lithography', __('Lithography'), array( 
	array(1, _t('%s nm', 11)),  
	array(2, _t('%s nm', 16)),  
	array(3, _t('%s nm', 22)),  
	array(4, _t('%s nm', 32)),  
	array(5, _t('%s nm', 45)),  
	array(6, _t('%s nm', 65)),  
	array(7, _t('%s nm', 90)),  
	array(8, __('other'))
		) );

helper_yes_no("cooler", __('Cooler'));

?>


