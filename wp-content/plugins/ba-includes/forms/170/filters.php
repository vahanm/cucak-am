<?php


//filter_group_sub('general', __('General'));

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
	
	
//filter_text("cpu", __('CPU (processor) model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'cpufrequency'
	, 'title'	=>__('CPU frequency')
, 'rate'		=>0.1
, 'min'			=>4
, 'max'			=>50
, 'text'		=>'%s GHz'
, 'begin'		=>'400 MHz'
, 'end'			=>'%s GHz'
	, 'priority'	=>	PRIMARY_FILTER
));



filter_slider_by_list(array(
  'id'			=>'core'
	, 'title'	=>__('Core quantity')
, 'rate'		=>1
, 'min'			=>1
, 'max'			=>12
, 'format'		=> 	__('from %v1 to %2')	
, 'text'		=>__('%s cores')
, 'begin'		=>__('%s core')
, 'end'			=>__('%s cores')
	, 'priority'	=>	PRIMARY_FILTER
	));



filter_yes_no("hyper_threading", 'Hyper Threading');

//filter_text("mb", __('Motherboard model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'ram'
, 'title'		=>__('RAM size')
, 'rate'		=>0.5
, 'min'			=>0
, 'max'			=>32
, 'text'		=>'%s ' . 'GB'
, 'begin'		=>__('no RAM')
, 'end'			=>'16 ' . 'GB'
	, 'priority'	=>	PRIMARY_FILTER
));



filter_select('slottype', __('Slot type'), array( 			
	array(1, 'SD'),  
	array(2, 'DDR'),     
	array(3, 'DDR2'), 
	array(4, 'DDR3'),
	array(5, __('other'))
	) );


filter_slider_by_list(array(
  'id'			=>	'hdd'
, 'title'		=>	__('HDD memory size')
, 'min'			=>	1
, 'max'			=>	16
, 'format'		=>	__('%1 - %2')
, 'text'		=>	'%s GB'
, 'listItems'	=>	array(
	1 =>  __('no HDD'),
	2 =>  '20 ' . 'GB', 
	3 =>  '40 ' . 'GB', 
	4 =>  '80 ' . 'GB',
	5 =>  '120 ' . 'GB',
	6 =>  '160 ' . 'GB',			
	7 =>  '250 ' . 'GB',
	8 =>  '320 ' . 'GB',
	9 =>  '500 ' . 'GB',
	10 =>  '640 ' . 'GB',
	11 =>  '750 ' . 'GB',
	12 =>  '1 ' . 'TB',
	13 =>  '1.5 ' . 'TB',
	14 =>  '2 ' . 'TB',
	15 =>  '3 ' . 'TB',
	16 =>  '4 ' . 'TB')
, 'begin'		=>__('no HDD')
, 'end'			=>'4 ' . 'TB'
, 'priority'	=>	PRIMARY_FILTER
	));

	
	

filter_select(array(
  'id'			=>	'optic'
, 'title'		=>	__('Optical disc drive')
, 'values'		=>	array( 
	array(1, __('no optical drive')),
	array(2, 'CD-ROM'),  
	array(3, 'CD-RW'),  
	array(4, 'DVD-ROM'), 
	array(5, 'DVD/CD-RW Combo'),
	array(6, 'DVD-RW'),
	array(7, 'Blu-Ray/DVD-RW Combo'),
	array(8, 'Blu-Ray-RW')
				)
, priority => SECONDARY_FILTER
	));




filter_group_sub('monitorgroup', __('Monitor'));

//filter_text("monitormodel", __('Monitor model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'monitor'
, 'title'		=>__('Monitor diagonal')
, 'rate'		=>0.5
, 'min'			=>26
, 'max'			=>80
, 'text'		=>'%s ' . '"'
, 'begin'		=>'13 ' . '"'
, 'end'			=>'40 '. '"'
, 'priority'	=>	PRIMARY_FILTER
));




filter_yes_no("widemonitor", __('Wide monitor'));






filter_group_sub('graphicsgroup', __('Graphics'));

//filter_text("videocard", __('Video card model'), __('Please enter desired model.'));

filter_slider_by_list(array(
	  'id'			=>'videocardmemory'
	, 'title'	    =>__('Video card memory')
	, 'min'			=>1
	, 'max'			=>8
	, 'format'		=>__('%1 - %2')
	, 'text'		=>'%s MB'
	, 'listItems'	=>array(
	1 =>  __('onboardcomp'),
	2 =>  '64 ' . 'MB', 
	3 =>  '128 ' . 'MB',
	4 =>  '256 ' . 'MB',		
	5 =>  '512 ' . 'MB',
	6 =>  '1 ' . 'GB',
	7 =>  '1.5 ' . 'GB',
	8 =>  '2 ' . 'GB')
, 'begin'		=>	__('onboardcomp')
, 'end'			=>	'2 ' . 'GB'
	, 'priority'	=> PRIMARY_FILTER
));



filter_group_sub('accessories', __('Accessories'));		

filter_yes_no("keyboard", __('Keyboard'), true);

filter_yes_no("mouse", __('Mouse'), true);

filter_yes_no("web_cam", __('Web camera'), true);

filter_yes_no("speaker", __('Speakers'), true);

filter_yes_no("headphone", __('Headphones'), true);


filter_group_sub('extradevices', __('Extra devices'));		

filter_check('printerscanner', __('Printer / Scanner'),  array( 
	array('printer', __('printer')),
	array('scanner', __('scanner')),
	array('copier', __('copier'))
	),1 );

filter_yes_no("ups", __('UPS'));





?>


