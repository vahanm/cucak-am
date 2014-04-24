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


//filter_text("mousemodel", __('Mouse model'), __('Please enter desired model.'));

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

filter_slider(array(
	'id'			=>'msens'
	, 'title'	=>__('Sensitivity')
	, 'rate'		=>100
	, 'min'			=>1
	, 'max'			=>40
	, 'text'		=>'%s dpi'
	, 'priority'	=>	PRIMARY_FILTER
	));

filter_yes_no("addkeys", __('Extra buttons'));


filter_yes_no("4d", '4D scrolling');



filter_creative_design();



?>
