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

//filter_text("tabletmodel", __('Tablet model'), __('Please enter desired model.'));



filter_select(array(
'id'			=>'operation_system'
, 'title'		=>__('Operating system')
, 'values'		=>array( 
array('andr22froyo', 'Android 2.2 Froyo'),
array('andr23gingerbread', 'Android 2.3 Gingerbread'),
array('andr3xhoneycomb', 'Android 3.x Honeycomb'),
array('andr40icecreamsandwich', 'Android 4.0 Ice Cream Sandwich'),
array('andr41jellybean', 'Android 4.1 Jelly Bean'),
array('andr42jellybean', 'Android 4.2 Jelly Bean'),
array('andr43jellybean', 'Android 4.3 Jelly Bean'),
array('andr44kitkat', 'Android 4.4 KitKat'),
array('andr4x', 'Android 4.x'),
/*
array('appleios1', 'Apple iOS 1'),
array('appleios2', 'Apple iOS 2'),
array('appleios3', 'Apple iOS 3'),
*/
array('appleios4', 'Apple iOS 4'),
array('appleios511', 'Apple iOS 5'),
array('appleios60', 'Apple iOS 6'),
array('appleios70', 'Apple iOS 7'),
array('blackberrytabletos', 'BlackBerry Tablet OS'),
array('windows7', 'Windows 7'),
array('windows8', 'Windows 8'),
array('windows8.1', 'Windows 8.1'),
/*
array('googlechromeos', 'Google Chrome OS'),
array('jolicloud', 'Jolicloud'),
array('meego', 'meeGo'),
array('webos1', 'webOS 1'),
array('webos2', 'webOS 2'),
array('webos3', 'webOS 3'),
*/
array(12,__('other'))
				)
	, priority => PRIMARY_FILTER
	));





//filter_text("cpumodeltab", __('CPU model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'cpufrequency'
	, 'title'	=>__('CPU frequency')
, 'rate'		=>50
, 'min'			=>4
, 'max'			=>40
, 'text'		=>'%s ' . 'MHz'
, 'begin'		=>'200 ' . 'MHz'
, 'end'			=>'2 ' . 'GHz'
, 'priority'	=>	PRIMARY_FILTER
));




filter_slider_by_list(array(
	'id'			=>'core'
	, 'title'	=>__('Core quantity')
	, 'rate'		=>1
	, 'min'			=>1
	, 'max'			=>4
	, 'format'		=> 	__('from %v1 to %2')	
	, 'text'		=>__('%s cores')
	, 'begin'		=>__('%s core')
	, 'end'			=>__('%s cores')
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_slider_by_list(array(
	'id'			=>'tabram'
	, 'title'		=>__('RAM size')
	, 'min'			=>1
	, 'max'			=>17
	, 'format'		=>__('%1 - %2')
	, 'text'		=>'%s '. 'MB'
	, 'listItems'	=>array(
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
	)
	, 'begin'		=>'16 MB'
	, 'end'			=>'8 GB'
	, 'priority'	=>	PRIMARY_FILTER
	));




filter_colors('tabletcolor', __('Tablet color'));


//filter_creative_design();


filter_yes_no("qwerty", __('Keyboard'));

filter_slider_by_list(array(
    'id'			=>'sim'
    , 'title'		=>__('SIM card quantity')
    , 'min'			=>0
    , 'max'			=>3
    , 'format'		=>__('%v1 - %2')
    , 'text'		=>__('%s SIM cards')
    , 'listItems'	=>array(
                0 => __('no SIM card'),
                1 => '1 ' . __('SIM card')		
                )
            , 'begin'		=>  __('no SIM card')
            , 'end'			=>'3 ' . __('SIM cards')
            , 'priority'	=>	PRIMARY_FILTER
            ));
    /*
filter_slider_by_list2('sim', __('SIM card quantity'), 0, 3, __('%v1 - %2'), '%s '. __('SIM cards'), array(
    0 => __('no SIM card'),
    1 => '1 ' . __('SIM card')		
    ),__('no SIM card'),'3 ' . __('SIM cards'));
*/
//SECONDARY_FILTER


filter_group_sub('display', __('Display'));

filter_slider(array(
  'id'			=>'tabdiagonal'
	, 'title'	=>__('Diagonal')
, 'rate'		=>0.1
, 'min'			=>40
, 'max'			=>130
, 'text'		=>'%s "'
, 'begin'		=>'%s "'
, 'end'			=>'%s "'
, 'priority'	=>	PRIMARY_FILTER
));

filter_select('color', __('Color quantity'), array( 
	array(1, __('black and white')),  
	array(2, __('grayscale')),  
    array(3, __('64K')), 
    array(4, __('256K')),
	array(5, __('16M')),
	array(6, __('other'))
	) );


/*

filter_select('resolution', __('Resolution'), array( 
	array('480x320', '480x320'),
	array('480x640', '480x640'),
	array('480x800', '480x800'),
	array('480x854', '480x854'),
	array('480x1024', '480x1024'),
	array('528x436', '528x436'),
	array('540x960', '540x960'),
	array('600x800', '600x800'),
	array('640x360', '640x360'),
	array('640x480', '640x480'),
	array('640x960', '640x960'),
	array('720x480', '720x480'),
	array('720x576', '720x576'),
	array('720x1280', '720x1280'),
    array('768x1024', '768x1024'),
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
	array('1366x768', '1366x768'),
	array('1400x1050', '1400x1050'),
    array('1440x900', '1440x900'),
    array('1536x2048', '1536x2048'),
	array('1600x768', '1600x768'),
	array('1600x900', '1600x900'),
	array('1600x1200', '1600x1200'),
	array('1680x945', '1680x945'),
	array('1680x1050', '1680x1050'),
	array('1920x1080', '1920x1080'),
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
filter_yes_no("touchscreendisplay", __('Touchscreen display'));

//filter_yes_no("multitouch", __('Multitouch'));





filter_group_sub('cameragroup', __('Camera'));

filter_slider('camresol', __('Camera'), 0.2, 1, 205, '%s MP');
/*
filter_slider_by_list2('camera', __('Camera'), 1, 9, __('%1 - %2'), 'Error', array(
	1 =>  __('no camera'), 	
	2 => _t('%s MP or less', 1), 
	3 => '1.3 ' . 'MP',
	4 => '2 ' . 'MP', 
	5 => '3 ' . 'MP',
	6 => '3.2 ' . 'MP', 
	7 => '5 ' . 'MP',
	8 => '8 ' . 'MP',
	9 => _t('%s MP or more', 10)
	), __('no camera'),_t('%s MP or more', 10));
*/
filter_yes_no("seccamera", __('Camera (secondary)')); 

//filter_yes_no("videocall", __('Videocall'));

filter_yes_no("camera_flash", __('Camera flash'));





filter_group_sub('data', __('Data and memory'));


filter_slider('gsm', __('GSM generations'), 1, 2, 4, '%s' . 'G', '2' . 'G', '4' . 'G');

filter_yes_no("wifi", 'Wi-Fi', true);

filter_yes_no("bluetooth", 'Bluetooth', true);


filter_slider_by_list(array(
	'id'			=>'internal_memory'
	, 'title'		=>__('Internal memory')
	, 'min'			=>1
	, 'max'			=>13
	, 'format'		=>__('%1 - %2')
	, 'text'		=>'Error'
	, 'listItems'	=>array(
	1 => __('none'), 
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

	)
, 'begin'		=>__('none')
, 'end'			=>'128' . 'GB'
			, 'priority'	=>	PRIMARY_FILTER
			));



filter_slider_by_list2('memory', __('Memory card'), 1, 10, __('%1 - %2'), 'Error', array(
    1 => __('none'), 
    2 => '512' . 'MB',
    3 => '1' . 'GB', 
    4 => '2' . 'GB', 
    5 => '4' . 'GB', 
    6 => '8' . 'GB',
    7 => '16' . 'GB', 
    8 => '32' . 'GB', 
    9 => '64' . 'GB',
    10 => '128' . 'GB'
    ),__('none'), '128' . 'GB');








filter_group_sub('features', __('Features'));

filter_yes_no("gps", 'GPS', true);

filter_yes_no("radio", __('Radio'), true);

filter_yes_no("audio_jack", __('3.5 mm audio jack'));





filter_group_sub('extra', __('Extra things'));


filter_yes_no("charger", __('Charger'), true);

filter_yes_no("headphone", __('Headphones'), true);

filter_yes_no("usbcable", __('USB cable'), true);


filter_yes_no("box", __('Box'), true);

filter_yes_no("warranty", __('Warranty'));

filter_yes_no("extra_body", __('Extra body'));

?>