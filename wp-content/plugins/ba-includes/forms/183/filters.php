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



//filter_text("opticdevice", __('Blu-Ray/DVD/CD drive model'), __('Please enter desired model.'));

filter_select(array(
'id'			=>'optic'
, 'title'		=>__('Type')
, 'values'		=>array( 
	array(2, 'CD-ROM'),  
	array(3, 'CD-RW'),  
	array(4, 'DVD-ROM'), 
	array(5, 'DVD/CD-RW Combo'),
	array(6, 'DVD-RW'),
	array(7, 'Blu-Ray/DVD-RW Combo'),
	array(8, 'Blu-Ray-RW')
	)
, priority => PRIMARY_FILTER
));


filter_slider(array(
  'id'			=>'discreadmaxspeed'
	, 'title'	=>__('Disc read max speed')
, 'rate'		=>2
, 'min'			=>4
, 'max'			=>28
, 'text'		=>'%s' . 'X'
, 'begin'		=>'8X'
, 'end'			=>'56X'
, 'priority'	=>	PRIMARY_FILTER
	));




filter_select(array(
'id'			=>'opticinterface'
, 'title'		=>__('Interface')
, 'values'		=>array( 
	array(1, 'IDE'),  
	array(2, 'SATA')
)
, priority => PRIMARY_FILTER
	));


filter_yes_no(array(
  'id'			=>"forlaptop"
, 'title'		=>__('For laptop')
, 'priority'	=>	PRIMARY_FILTER
));


?>


