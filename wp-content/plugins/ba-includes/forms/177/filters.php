<?php

filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));
	
	
//filter_text("rammodel", __('RAM model'), __('Please enter desired model.'));


filter_select(array(
'id'			=>'slottype'
, 'title'		=>__('Slot type')
, 'values'		=>array( 			
		array(1, 'SD'),  
		array(2, 'DDR'),     
		array(3, 'DDR2'), 
		array(4, 'DDR3'),
		array(5, __('other'))
				)
			, priority => PRIMARY_FILTER
			));
		
		
filter_slider_by_list(array(
  'id'			=>'memorysize'
, 'title'		=>__('Memory size')
, 'min'			=>1
, 'max'			=>8
, 'format'		=>__('%1 - %2')
, 'text'		=>'%s Mb'
, 'listItems'	=>array(
	1 => '128 ' . 'MB', 
	2 => '256 ' . 'MB', 
	3 => '512 ' . 'MB', 
	4 => '1 ' . 'GB', 
	5 => '2 ' . 'GB', 
	6 => '4 ' . 'GB', 
	7 => '8 ' . 'GB', 
	8 => '16 ' . 'GB' )
, 'begin'		=>'128 ' . 'MB'
, 'end'			=>'16 ' . 'GB' 
, 'priority'	=>	PRIMARY_FILTER
			));


filter_slider_by_list2('ramfrequency', __('Frequency'), 1, 9, __('%1 - %2'), '%s MHz', array(
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

filter_yes_no("radiator", __('Radiator'));

filter_yes_no("warranty", __('Lifetime warranty'));

filter_yes_no("forlaptop", __('For laptop'));	
?>


