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
				array(2, __('used'))
				)
			, priority => PRIMARY_FILTER
			));
	
	
//filter_text("cpu", __('CPU (processor) model'), __('Please enter desired model.'));


filter_select(array(
'id'			=>'cpusocket'
, 'title'		=>__('CPU socket')
, 'values'		=>array( 			
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
				)
			, priority => PRIMARY_FILTER
			));



filter_slider(array(
	'id'			=>'cpufrequency'
	, 'title'	=>__('CPU frequency')
	, 'rate'		=>0.1
	, 'min'			=>4
	, 'max'			=>50
	, 'text'		=>'%s ' . 'GHz'
	, 'begin'		=>'400 ' . 'MHz'
	, 'end'			=>'5 ' . 'GHz'
, 'priority'	=>	PRIMARY_FILTER
));


filter_slider_by_list(array(
	'id'			=>'core'
	, 'title'		=>__('Core quantity')
	, 'rate'		=>1
	, 'min'			=>1
	, 'max'			=>12
	, 'format'		=> 	__('from %v1 to %2')	
	, 'text'		=>__('%s cores')
	, 'begin'		=>__('%s core')
	, 'end'			=>__('%s cores')
	, 'priority'	=>	PRIMARY_FILTER
	));

filter_slider_by_list2('cache', __('Cache size'), 1, 18, __('%1 - %2'), '%s MB', array(
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


filter_yes_no(array(
  'id'			=>"hyper_threading"
, 'title'		=>'Hyper Threading'
, 'priority'	=>	PRIMARY_FILTER
	));


filter_yes_no(array(
  'id'			=>"turbo_boost"
, 'title'		=>'Turbo Boost'
, 'priority'	=>	PRIMARY_FILTER
	));



filter_select(array(
  'id'			=>'instruction_set'
, 'title'		=>__('Instruction set')
, 'values'		=>array( 
array(1, _t('%s bit', 32)),  
array(2, _t('%s bit', 64)) )
			, priority => SECONDARY_FILTER
			));



filter_yes_no("integrated_graphics", __('Integrated graphics'));

filter_select('lithography', __('Lithography'), array( 
	array(1, _t('%s nm', 11)),  
	array(2, _t('%s nm', 16)),  
	array(3, _t('%s nm', 22)),  
	array(4, _t('%s nm', 32)),  
	array(5, _t('%s nm', 45)),  
	array(6, _t('%s nm', 65)),  
	array(7, _t('%s nm', 90)),  
	array(8, __('other'))
	) );

filter_yes_no("cooler", __('Cooler'));

?>


