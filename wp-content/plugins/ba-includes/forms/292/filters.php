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


//filter_text("hddmodel", __('HDD model'), __('Please enter desired model.'));



filter_slider_by_list2(array(
  'id'			=>'hddmemorysize'
, 'title'		=>__('Memory size')
, 'min'			=>1
, 'max'			=>32
, 'format'		=>__('%1 - %2')
, 'text'		=>'%s GB'
, 'listItems'	=>array(
	21 => '40 ' . 'GB', 
	22 => '80 ' . 'GB', 
	23 => '120 ' . 'GB', 
	24 => '160 ' . 'GB', 
	25 =>  '250 ' . 'GB',
	26 =>  '320 ' . 'GB',
	27 =>  '500 ' . 'GB',
	28 =>  '640 ' . 'GB',
	29 =>  '750 ' . 'GB',
	30 =>  '1 ' . 'TB',
	31 =>  '1.5 ' . 'TB',
	32 =>  '2 ' . 'TB'
	)
, 'begin'		=>'1 ' . 'GB'
, 'end'			=>'2 ' . 'TB'
, 'priority'	=>	PRIMARY_FILTER
	));

	

filter_select(array(
'id'			=>'form_factor'
, 'title'		=>__('Form factor')
	, 'values'		=>array( 
				array(1, '1.8"'),  
				array(2, '2.5"'),  
				array(3, '3.5"'))
, 'priority'	=>	PRIMARY_FILTER
	));


filter_select(array(
'id'			=>'extinterface'
, 'title'		=>__('Interfaces')
, 'values'		=>array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	array('esata', 'eSATA'),
	array('lan', 'LAN'),
	array('wireless', __('wireless')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));









?>


