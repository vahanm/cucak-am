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


//filter_text("coolermodel", __('Cooler model'), __('Please enter desired model.'));


filter_select(array(
  'id'			=>'cpusocket'
, 'title'		=>__('CPU socket')
, 'values'		=> array(
	array('notforcpu', __('not for CPU')), 			
	array('775', '775'), 
	array('1155', '1155'), 
	array('1156', '1156'), 
	array('1366', '1366'), 
	array('2011', '2011'), 
	array('am2', 'AM2'), 
	array('am21', 'AM2+'), 
	array('am3', 'AM3'), 
	array('am31', 'AM3+'), 
	array('fm1', 'FM1'), 
	array('other', __('other')) 
	)
, byKeys => true
, priority => PRIMARY_FILTER
));


filter_yes_no(array(
  'id'			=>"fanspeedcontrol"
, 'title'		=>__('Fan speed control')
, priority => PRIMARY_FILTER
));




?>


