<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));

render_item_status();


render_location('item_location', __('Item location'));



render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	3 => __('broken'), 
	4 => __('other')
	));
	
render_value('notebooktype', __('Notebook type'), 'Error', array(
	1 => __('Notebook'), 
	2 => __('Netbook')
	));

render_value(array(
		id => 'notnetmodel',
		title => __('Notebook (netbook) model'),
		searchIcon => true
	));	
	
render_value('opersystem', __('Operating system'), '%s ' );	
	
render_value('cpu', __('CPU (processor) model'), '%s ' );	

render_value('cpufrequency', __('Frequency'),'%s GHz');	

render_value('core', __('Core quantity'), __('%s cores'));	

render_yes_no("hyper_threading", 'Hyper Threading');


render_format('ramname', __('The RAM'));

/*
render_value('ram', __('RAM size'), '%s ' . 'GB', array(
	0 => 'image:no',
	'0.25' => '256 MB',
	'0.5' => '512 MB',
	'0.75' => '768 MB'
));	

render_value('slottype', __('Slot type'), 'Error', array(
	1 =>  'SD', 
	2 =>  'DDR', 
	3 =>  'DDR2', 
	4 =>  'DDR3', 
	5 =>  __('other')
	));
*/
/*
render_value('hdd', __('HDD memory size'), 'Error', array(
	1 =>  'image:no',
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
	16 =>  '4 ' . 'TB'
	));
*/

render_format('notmemory', __('Memory size'));


render_value('optic', __('Optical disc drive'), 'Error', array(
	1 => 'image:no',
	2 =>  'CD-ROM', 
	3 =>  'CD-RW',
	4 =>  'DVD-ROM',		
	5 =>  'DVD/CD-RW Combo',
	6 =>  'DVD-RW',
	7 =>  'Blu-Ray/DVD-RW Combo',
	8 =>  'Blu-Ray-RW'
		));
	
	
	
render_group_sub(__('Display'));

render_value('display', __('Display diagonal'), '%s' . '"');	


render_format('resolutionconf', __('Resolution'));

/*
render_value('resolution', __('Resolution'), 'Error', array(
	'800x480' => '800x480',
'800x600' => '800x600',
'800x1280' => '800x1280',
'854x480' => '854x480',
'864x1152' => '864x1152',
'960x540' => '960x540',
'1024x600' => '1024x600',
'1024x768' => '1024x768',
'1152x768' => '1152x768',
'1152x864' => '1152x864',
'1200x824' => '1200x824',
'1280x720' => '1280x720',
'1280x768' => '1280x768',
'1280x800' => '1280x800',
'1280x854' => '1280x854',
'1280x1024' => '1280x1024',
'1360x768' => '1360x768',
'1366x720' => '1366x720',
'1366x768' => '1366x768',
'1400x1050' => '1400x1050',
'1440x900' => '1440x900',
'1600x768' => '1600x768',
'1600x900' => '1600x900',
'1600x1200' => '1600x1200',
'1680x945' => '1680x945',
'1680x1050' => '1680x1050',
'1920x1080' => '1920x1080',
'1920x1200' => '1920x1200',
'1920x1440' => '1920x1440',
'2048x1050' => '2048x1050',
'2048x1152' => '2048x1152',
'2048x1536' => '2048x1536',
'2560x1440' => '2560x1440',
'2560x1600' => '2560x1600',
'2880x1800' => '2880x1800',
'3840x2160' => '3840x2160',
'3840x2400' => '3840x2400',
	'other'=> __('other'),  
	));
*/

render_yes_no("ledbacklight", __('LED backlight'));

render_yes_no("glossydisplay", __('Glossy display'));

render_yes_no("touchscreen", __('Touchscreen'));

render_yes_no("3D", '3D');





		
		
		






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Color and graphics'));

render_color('notcolor', __('Notebook color'));

render_value(array(
		id => 'videocard',
		title => __('Video card model'),
		searchIcon => true
	));

render_value('videocardmemory', __('Video card memory'), 'Error', array(
	1 =>  __('onboardcomp'),
	2 =>  '64 ' . 'MB', 
	3 =>  '128 ' . 'MB',
	4 =>  '256 ' . 'MB',		
	5 =>  '512 ' . 'MB',
	6 =>  '1 ' . 'GB',
	7 =>  '1.5 ' . 'GB',
	8 =>  '2 ' . 'GB'
	));
	
render_group_sub(__('Features'));

render_yes_no("web_cam", __('Web camera'));		

//render_yes_no("builtinbic", __('Built-in microphone'));

render_yes_no("backlitkeyboard", __('Backlit keyboard'));

render_yes_no("numerickeypad", __('Numeric keypad'));
		
render_yes_no("multitouch", __('Multitouch touchpad'));
		
render_yes_no("fingerprintsensor", __('Fingerprint sensor'));

render_check('communications', __('Communications'),  array( 
	array('lan', 'LAN'),
	array('wifi', 'WiFi'),
	array('bluetooth', 'Bluetooth'),
//	array('irda', __('IrDA')),
	array('gsmmodule', __('GSM module')),
	) );

render_check('ports', __('Ports'),  array( 
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
	) );




render_group_sub(__('Accessories'));


render_yes_no("charger", __('Charger'));

render_yes_no("bag", __('Bag'));


render_group_sub(__('Gifts'));

render_yes_no("extrabattery", __('Extra battery'));

render_yes_no("mouse", __('Mouse'));

render_yes_no("headphone", __('Headphones'));

//render_yes_no("wifiac", __('WiFi access point'));




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
