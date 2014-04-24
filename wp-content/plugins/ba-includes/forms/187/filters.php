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


//filter_text("webcammodel", __('Web camera model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'webresolution'
	, 'title'	=>__('Resolution')
, 'rate'		=>0.1
, 'min'			=>1
, 'max'			=>120
, 'text'		=>'%s MP'
	, 'priority'	=>	PRIMARY_FILTER
));


filter_yes_no("autofocus", __('Auto focus'));

filter_yes_no(array(
  'id'			=>"webbuiltinmic"
, 'title'		=>__('Built-in microphone')
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_yes_no("ledlights", __('LED lights'));




//filter_creative_design();


?>