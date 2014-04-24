<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));


helper_group('ram', __('RAM'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("rammodel", __('RAM model'), __('Please enter the model.'));


helper_select('slottype', __('Slot type'), array( 			
		array(1, 'SD'),  
		array(2, 'DDR'),     
		array(3, 'DDR2'), 
		array(4, 'DDR3'),
		array(5, __('other'))
		) );
		
		
helper_slider_by_list('memorysize', __('Memory size'), __('Please select'), 1, 8, '%s Mb', array(
	1 => '128 ' . 'MB', 
	2 => '256 ' . 'MB', 
	3 => '512 ' . 'MB', 
	4 => '1 ' . 'GB', 
	5 => '2 ' . 'GB', 
	6 => '4 ' . 'GB', 
	7 => '8 ' . 'GB', 
	8 => '16 ' . 'GB' 
	),'128 ' . 'MB','16 ' . 'GB' );

helper_slider_by_list('ramfrequency', __('Frequency'), __('Please select'), 1, 9, '%s MHz', array(
	1 => '400 ' . 'MHz', 
	2 => '533 ' . 'MHz', 
	3 => '667 ' . 'MHz', 
	4 => '800 ' . 'MHz', 
	5 => '1066 ' . 'MHz', 
	6 => '1333 ' . 'MHz', 
	7 => '1600 ' . 'MHz', 
	8 => '1866 ' . 'MHz',
	9 => '2133 ' . 'MHz'
	
	),'400 ' . 'MHz','2133 ' . 'MHz');

helper_yes_no("radiator", __('Radiator'));

helper_yes_no("warranty", __('Lifetime warranty'));

helper_yes_no("forlaptop", __('For laptop'));	
?>


