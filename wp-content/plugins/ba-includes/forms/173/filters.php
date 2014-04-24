<?php

//filter_group_sub('notnet', __('Notebook / Netbook'));

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

filter_select(array(
	'id'			=>	'notebooktype'
	, 'title'		=>	__('Notebook type')
	, 'values'		=>	array( 
	array(1, __('Notebook')),  
	array(2, __('Netbook'))
	)
	, priority => PRIMARY_FILTER
	));


//filter_text("notnetmodel", __('Notebook (netbook) model'), __('Please enter desired model.'));

//filter_text("opersystem", __('Operating system'), __('Please enter the name of the operating system.'));
	
//filter_text("cpu", __('CPU (processor) model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'cpufrequency'
	, 'title'	=>__('CPU frequency')
, 'rate'		=>0.1
, 'min'			=>4
, 'max'			=>40
, 'text'		=>'%s GHz'
, 'begin'		=>'400 MHz'
, 'end'			=>'%s GHz'
, 'priority'	=>	PRIMARY_FILTER
));




filter_slider_by_list(array(
	'id'			=>'core'
	, 'title'		=>__('Core quantity')
	, 'rate'		=>1
	, 'min'			=>1
	, 'max'			=>8
	, 'format'		=> 	__('from %v1 to %2')	
	, 'text'		=>__('%s cores')
	, 'begin'		=>__('%s core')
	, 'end'			=>__('%s cores')
	, 'priority'	=>	PRIMARY_FILTER
	));

filter_yes_no("hyper_threading", 'Hyper Threading');

		
filter_slider(array(
  'id'			=>'ram'
, 'title'		=>__('RAM size')
, 'rate'		=>0.5
, 'min'			=>0
, 'max'			=>24
, 'text'		=>'%s ' . 'GB'
, 'begin'		=>__('no RAM')
, 'end'			=>'12 ' . 'GB'
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
  'id'			=>'hdd'
, 'title'		=>__('HDD memory size')
, 'min'			=>1
, 'max'			=>16
, 'format'		=>__('%1 - %2')
, 'text'		=>'%s GB'
, 'listItems'	=>array(
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
, 'begin'		=>__('No HDD')
, 'end'			=>'4 ' . 'TB'
, 'priority'	=>	PRIMARY_FILTER
	));




filter_slider(array(
    'id'			=>'ssdmem'
    , 'title'		=>__('SSD memory size')
    , 'rate'		=>64
    , 'min'			=>0
    , 'max'			=>16
    , 'text'		=>__('%s GB')
    , 'begin'		=>__('No SSD')
    , 'end'			=>__('1 TB')
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
			, priority => PRIMARY_FILTER
			));




filter_group_sub('displaygroup', __('Display'));


filter_slider(array(
  'id'			=>'display'
, 'title'		=>__('Display diagonal')
, 'rate'		=>0.1
, 'min'			=>90
, 'max'			=>200
, 'text'		=>'%s "'
, 'priority'	=>	PRIMARY_FILTER
));


$color1 = '#666';
$color2 = '#000';
$color3 = '#444';

$colorA = '#dfd';

/*
filter_select('resolution', __('Resolution'), array( 
	array('800x480', '800x480'),
	array('800x600', '800x600'),
	array('800x1280', '800x1280'),
	array('854x480', '854x480'),
	array('864x1152', '864x1152'),
	array('960x540', '960x540'),
	array('1024x600', '1024x600'),
	array('1024x768', '1024x768'),
	array('1152x768', '1152x768'),
	array('1152x864', '1152x864'),
	array('1200x824', '1200x824'),
	array('1280x720', '1280x720'),
	array('1280x768', '1280x768'),
	array('1280x800', '1280x800'),
	array('1280x854', '1280x854'),
	array('1280x1024', '1280x1024'),
	array('1360x768', '1360x768'),
	array('1366x720', '1366x720'),
	array('1366x768', '1366x768',$color2, $colorA),
	array('1400x1050', '1400x1050'),
	array('1440x900', '1440x900'),
	array('1600x768', '1600x768'),
	array('1600x900', '1600x900',$color2, $colorA),
	array('1600x1200', '1600x1200'),
	array('1680x945', '1680x945'),
	array('1680x1050', '1680x1050'),
	array('1920x1080', '1920x1080',$color2, $colorA),
	array('1920x1200', '1920x1200'),
	array('1920x1440', '1920x1440'),
	array('2048x1050', '2048x1050'),
	array('2048x1152', '2048x1152'),
	array('2048x1536', '2048x1536'),
	array('2560x1440', '2560x1440'),
	array('2560x1600', '2560x1600'),
	array('2880x1800', '2880x1800'),
	array('3840x2160', '3840x2160'),
	array('3840x2400', '3840x2400'),
	array('other', __('other')),  
	) );
*/

filter_yes_no("ledbacklight", __('LED backlight'));

filter_yes_no("glossydisplay", __('Glossy display'));

filter_yes_no("touchscreen", __('Touchscreen'));

filter_yes_no("3D", '3D');





filter_group_sub('graphicsgroup', __('Graphics'));

//filter_colors('notcolor', __('Notebook color'));

//filter_text("videocard", __('Video card model'), __('Please enter desired model.'));

filter_slider_by_list2('videocardmemory', __('Video card memory'), 1, 8, __('%1 - %2'), '%s MB', array(
	1 =>  __('onboardcomp'),
	2 =>  '64 ' . 'MB', 
	3 =>  '128 ' . 'MB',
	4 =>  '256 ' . 'MB',		
	5 =>  '512 ' . 'MB',
	6 =>  '1 ' . 'GB',
	7 =>  '1.5 ' . 'GB',
	8 =>  '2 ' . 'GB'
	),__('onboardcomp'), '2 ' . 'GB');



filter_group_sub('features', __('Features'));		

filter_yes_no(array(
	  'id'			=>"web_cam"
	, 'title'		=>__('Web camera')		
	, priority => PRIMARY_FILTER
			));
	
	
filter_yes_no("backlitkeyboard", __('Backlit keyboard'));

filter_yes_no(array(
  'id'			=>"numerickeypad"
, 'title'		=>__('Numeric keypad')
, priority => PRIMARY_FILTER
			));


filter_yes_no("multitouch", __('Multitouch touchpad'));

filter_yes_no("fingerprintsensor", __('Fingerprint sensor'));

filter_check('communications', __('Communications'),  array( 
	array('lan', 'LAN'),
	array('wifi', 'WiFi'),
	array('bluetooth', 'Bluetooth'),
//	array('irda', __('IrDA')),
	array('gsmmodule', __('GSM module')),
	) ,1 );

filter_check('ports', __('Ports'),  array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	array('esata', 'eSATA'),
	array('hdmi', 'HDMI'),
	array('vga', 'VGA'),
	array('dvi', 'DVI'),
	array('1394', '1394'),	
	array('compositevideo', 'Composite video'),
	array('svideo', 'S-Video'),
	array('compvideo', 'Component video'),
	array('dms', 'DMS-59'),
	array('displayport', 'DisplayPort'),
	),1 );




filter_group_sub('accessories', __('Accessories'));		

filter_yes_no("charger", __('Charger'), true);

filter_yes_no("bag", __('Bag'), true);



/*

filter_group_sub('extrathings', __('Extra things'));		

filter_yes_no("extrabattery", __('Extra battery'));

filter_yes_no("mouse", __('Mouse'));

filter_yes_no("headphone", __('Headphones'));

//filter_yes_no("wifiac", __('WiFi access point'), true);

*/
