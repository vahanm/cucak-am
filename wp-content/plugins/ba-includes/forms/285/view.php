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
		id => 'phonemodel',
		title => __('Phone model'),
		searchIcon => true
	));

	
render_value('operation_system', __('Operating system'), 'Error', array(
1 => __('Feature phone'), 
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
'windowsmobile5' => 'Windows Mobile 5',
'windowsmobile6' => 'Windows Mobile 6',
'windowsmobile7' => 'Windows Mobile 7',
'windowsphone70' => 'Windows Phone 7.0',
'windowsphone75' => 'Windows Phone 7.5',
'windowsphone78' => 'Windows Phone 7.8',
'windowsphone8' => 'Windows Phone 8',
'blackberryos50' => 'BlackBerry OS 5.0',
'blackberryos60' => 'BlackBerry OS 6.0',
'blackberryos70' => 'BlackBerry OS 7.0',
'blackberryos71' => 'BlackBerry OS 7.1',
'symbianos8' => 'Symbian OS 8',
'symbianos9' => 'Symbian OS 9',
'symbianos2' => 'Symbian OS 2',
'symbianos3' => 'Symbian OS 3',
    /*
    'nokiabelle' => 'Nokia Belle',
    'meego' => 'meeGo',
    'maemo ' => 'Maemo',
    'bada' => 'bada',
    'webos1' => 'webOS 1',
    'webos2' => 'webOS 2',
    'webos3' => 'webOS 3',
    */
12 =>__('other')
	));
	
	
	
	
render_value('form', __('Form'), 'Error', array(
	1 => __('bar'), 
	2 => __('flip'),  
	3 => __('slide'), 
	4 => __('swivel'), 
	5 => __('other')
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

    ),'16 MB', '4 GB');



render_color('phonecolor', __('Phone color'));

//render_creative_design();

render_yes_no("qwerty", __('QWERTY keyboard'));

render_value('sim', __('SIM card quantity'), __('%s'), array(
	1 => '1 ' . __('SIM card')
	));
	
		
	
	
render_group_sub(__('Display'));
		
	 
render_value('diagonal', __('Diagonal'), '%s "');	  

	
render_value('color', __('Color quantity'), 'Error', array(
	1 => __('black and white'), 
	2 => __('grayscale'), 
    3 => __('64K'), 
	4 => __('256K'), 
	5 => __('16M'), 
	6 => __('other')
	));

//"{$id}_width" -- "{$id}_height"


//render_format('cylnumconf', __('Cylinders2'));

render_format('resolutionconf', __('Resolution'));

/*	
render_value('resolution', __('Resolution'), 'Error', array(
	'176x132' => '176x132',
	'176x208' => '176x208',
	'176x220' => '176x220',
	'226x170' => '226x170',
	'230x173' => '230x173',
	'230x180' => '230x180',
	'240x180' => '240x180',
	'240x320' => '240x320',
	'272x480' => '272x480',
	'306x230' => '306x230',
	'320x240' => '320x240',
	'320x480' => '320x480',
	'352x416' => '352x416',
	'420x293' => '420x293',
	'480x272' => '480x272',
	'480x272' => '480x272',
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
    '640x1136' => '640x1136',           //iPhone 5S
    '720x480' => '720x480',
	'720x576' => '720x576',
	'720x1280' => '720x1280',
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
	'other'=> __('other'),  
	));

*/

	 

render_yes_no("touchscreendisplay", __('Touchscreen display'));


//render_yes_no("multitouch", __('Multitouch'));


render_yes_no("secondary_display", __('Secondary display'));







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

render_yes_no("IrDA", __('IrDA'));
	
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
