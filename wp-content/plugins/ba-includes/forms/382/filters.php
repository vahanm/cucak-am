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

//filter_text("furnituremodel", __('Furniture model'), __('Please enter desired model.'));


filter_slider_by_list(array(
	'id'			=>'usbflashmemory'
	, 'title'		=>__('Memory size')
	, 'min'			=>1
	, 'max'			=>14
	, 'format'		=>__('%1 - %2')
	, 'text'		=>'%s GB'
	, 'listItems'	=>array(
				1  =>  '512 MB',
				2  =>  '1 GB',
				3  =>  '2 GB',
				4  =>  '3 GB',
				5  =>  '4 GB',
				6  =>  '5 GB',
				7  =>  '6 GB',
				8  =>  '7 GB',
				9  =>  '8 GB',
				10  =>  '16 GB',
				11  =>  '32 GB',
				12  =>  '64 GB',
				13  =>  '128 GB',
				14  =>  '256 GB')
				, 'begin'		=> '512 MB'
				, 'end'			=> '256 GB'
				, 'priority'	=>	PRIMARY_FILTER
				));



filter_select(array(
	'id'			=>	'usbinterfaces'
	, 'title'		=>	__('Interface')
	, 'values'		=>	array( 
				array('usb2', 'USB2'),
				array('usb3', 'USB3')
				)
			, priority => PRIMARY_FILTER
			));


filter_yes_no(array(
	'id'			=>"usbcardreader"
	, 'title'		=>__('Card reader')		
	, priority => PRIMARY_FILTER
	));

