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
	

//render_value('producer', __('Producer'), 'Error');
	
//render_value('model', __('Model'), 'Error');	
	
render_value(array(
    id => 'tabletmodel',
    title => __('Tablet model'),
    searchIcon => true
    ));
	
render_value('operation_system', __('Operating system'), 'Error', array(
'andr22froyo' => 'Android 2.2 Froyo',
'andr23gingerbread' => 'Android 2.3 Gingerbread',
'andr3xhoneycomb' => 'Android 3.x Honeycomb',
'andr40icecreamsandwich' => 'Android 4.0 Ice Cream Sandwich',
'andr41jellybean' => 'Android 4.1 Jelly Bean',
'andr42jellybean' => 'Android 4.2 Jelly Bean',
'andr43jellybean' => 'Android 4.3 Jelly Bean',
'andr44kitkat' => 'Android 4.4 KitKat',
'andr4x'=> 'Android 4.x',
    /*
'appleios1' => 'Apple iOS 1',
'appleios2' => 'Apple iOS 2',
'appleios3' => 'Apple iOS 3',
*/
'appleios4' => 'Apple iOS 4',
'appleios511' => 'Apple iOS 5',
'appleios60' => 'Apple iOS 6',
'appleios70' => 'Apple iOS 7',
'blackberrytabletos' => 'BlackBerry Tablet OS',
'windows7' => 'Windows 7',
'windows8' => 'Windows 8',
'windows8.1' => 'Windows 8.1',
//'googlechromeos' => 'Google Chrome OS',
//'jolicloud' => 'Jolicloud',
//'meego' => 'meeGo',
//'webos1' => 'webOS 1',
//'webos2' => 'webOS 2',
//'webos3' => 'webOS 3',
12 =>__('other')
	));
	


render_value('cpumodeltab', __('CPU model'), '%s' );

render_value('cpufrequency', __('Frequency'), '%s ' . 'MHz');	

render_value('core', __('Core quantity'), '%s ' . __('cores'));		
	
render_value('tabram', __('RAM size'), '%s MB', array(
	1 => '16 MB',
	2 => '32 MB',
	3 => '64 MB',
	4 => '128 MB',
	5 => '256 MB',
	6 => '384 MB',
	7 => '512 MB',
	8 => '750 MB',
	9 => '1 GB',
	10 => '1.5 GB',
	11 => '2 GB',
	12 => '3 GB',
	13 => '4 GB',
	14 => '5 GB',
	15 => '6 GB',
	16 => '7 GB',
	17 => '8 GB',
	),'16 MB', '8 GB');

render_color('tabletcolor', __('Tablet color'));

//render_creative_design();


render_yes_no("qwerty", __('Keyboard'));

render_value('sim', __('SIM card quantity'), __('%s'), array(
	0 => __('no SIM card'),
	1 => '1 ' . __('SIM card')
	));
	
		
	
	
render_group_sub(__('Display'));
		
render_value('tabdiagonal', __('Diagonal'), '%s "');	  
	
render_value('color', __('Color quantity'), 'Error', array(
	1 => __('black and white'), 
	2 => __('grayscale'), 
    3 => __('64K'), 
    4 => __('256K'), 
	5 => __('16M'), 
	6 => __('other')
	));
	
	
render_format('resolutionconf', __('Resolution'));
 
/*

render_value('resolution', __('Resolution'), 'Error', array(
'480x320' => '480x320',
'480x640' => '480x640',
'480x800' => '480x800',
'480x854' => '480x854',
'480x1024' => '480x1024',
'528x436' => '528x436',
'540x960' => '540x960',
'600x800' => '600x800',
'640x360' => '640x360',
'640x480' => '640x480',
'640x960' => '640x960',
'720x480' => '720x480',
'720x576' => '720x576',
'720x1280' => '720x1280',
    '768x1024' => '768x1024',
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
    '1536x2048' => '1536x2048',
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


render_yes_no("touchscreendisplay", __('Touchscreen display'));

//render_yes_no("multitouch", __('Multitouch'));




render_group_sub(__('Camera'));

render_value('camresol', __('Camera'), '%s MP');
/*
render_value('camera', __('Camera'), 'Error', array(
	1 =>  'image:no', 	
	2 => _t('%s MP or less', 1), 
	3 => '1.3 ' . 'MP',
	4 => '2 ' . 'MP', 
	5 => '3 ' . 'MP',
	6 => '3.2 ' . 'MP', 
	7 => '5 ' . 'MP',
	8 => '8 ' . 'MP',
	9 => _t('%s MP or more', 10)
	));
*/
render_yes_no("seccamera", __('Camera (secondary)'));        

//render_yes_no("videocall", __('Videocall'));

render_yes_no("camera_flash", __('Camera flash'));








///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Data and memory'));

render_value('gsm', __('GSM generations'), '%s' . 'G');	

render_yes_no("wifi", 'WiFi');

render_yes_no("bluetooth", 'Bluetooth');
	
render_value('internal_memory', __('Internal memory'), 'Error', array(
		1 => 'image:no', 
		2 => '64' . 'MB',
		3 => '128' . 'MB', 
		4 => '256' . 'MB', 
		5 => '512' . 'MB',
		6 => '1' . 'GB', 
		7 => '2' . 'GB', 
		8 => '4' . 'GB', 
		9 => '8' . 'GB',
		10 => '16' . 'GB', 
		11 => '32' . 'GB', 
		12 => '64' . 'GB', 
		13 => '128' . 'GB' 
	));
	
	

	
render_value('memory', __('Memory card'), 'Error', array(
		1 => 'image:no', 
		2 => '512' . 'MB',
		3 => '1' . 'GB', 
		4 => '2' . 'GB', 
		5 => '4' . 'GB', 
		6 => '8' . 'GB',
		7 => '16' . 'GB', 
		8 => '32' . 'GB', 
		9 => '64' . 'GB', 
		10 => '128' . 'GB' 
));
	







render_group_sub(__('Features'));

render_yes_no("gps", 'GPS');

render_yes_no("radio", __('Radio'));

render_yes_no("audio_jack", __('3.5 mm audio jack'));






render_group_sub(__('Extra things'));

render_yes_no("charger", __('Charger'));

render_yes_no("headphone", __('Headphones'));

render_yes_no("usbcable", __('USB cable'));

render_yes_no("extra_body", __('Extra body'));

render_yes_no("box", __('Box'));

render_yes_no("warranty", __('Warranty'));




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
