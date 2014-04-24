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


//filter_text("keyboardmodel", __('Keyboard model'), __('Please enter desired model.'));

filter_select(array(
  'id'			=>'interface'
, 'title'		=>__('Interface')
	, 'values'		=>array( 			
				array('usb', 'USB'), 
				array('ps', 'PS/2'), 
				array('wireless', __('wireless')))
, byKeys => true
, priority => PRIMARY_FILTER
	));

filter_yes_no(array(
  'id'			=>"multimedia"
, 'title'		=>__('Multimedia')
	, priority => PRIMARY_FILTER
	));

filter_yes_no("backlights", __('Backlights'));


filter_creative_design();



?>


