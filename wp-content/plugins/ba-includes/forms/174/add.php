<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));








helper_group('general_information', __('General'));


//helper_select_mobile();

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );

helper_text("tabletmodel", __('Tablet model'), __('Please enter the model.'));



helper_select('operation_system', __('Operating system'), array( 
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
	) );




helper_text("cpumodeltab", __('CPU model'), __('Please enter the model.'));

helper_slider('cpufrequency', __('Frequency'), __('Please select'), 50, 4, 60, '%s ' . 'MHz','200 ' . 'MHz', '3 ' . 'GHz');

helper_slider('core', __('Core quantity'), __('Please select'), 1, 1, 8, __('%s cores'));

helper_slider_by_list('tabram', __('RAM size'), __('Please select'), 1, 17, '%s '. 'MB', array(
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

helper_colors('tabletcolor', __('Tablet color'));


//helper_creative_design();


helper_yes_no("qwerty", __('Keyboard'));

helper_slider_by_list('sim', __('SIM card quantity'), __('Please select'), 0, 3, '%s '. __('SIM cards'), array(
    0 => __('no SIM card'),
    1 => '1 ' . __('SIM card')		
    ),__('no SIM card'),'3 ' . __('SIM cards'));




helper_group_sub('display', __('Display'));

helper_slider('tabdiagonal', __('Diagonal'), __('Please select'), 0.1, 40, 130, '%s "', '%s "', '%s "');

helper_select('color', __('Color quantity'), array( 
		array(1, __('black and white')),  
		array(2, __('grayscale')),  
        array(3, __('64K')), 
		array(4, __('256K')),
		array(5, __('16M')),
		array(6, __('other'))
		) );


helper_resolution(array(
    'id' => 'resolution',
    'title' => __('Resolution'),
    'suggestions' => array(

                array(2560, 1600),
                array(1536, 2048, 'iPad 3, 4, Air, mini2'),
                array(1920, 1080, 'Full HD'),
                array(1280, 800),
                array(768, 1024, 'iPad , iPad 2, mini'),
                array(1024, 600),

                )
            ));

/*
helper_select('resolution', __('Resolution'), array( 
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

helper_yes_no("touchscreendisplay", __('Touchscreen display'));

//helper_yes_no("multitouch", __('Multitouch'));





helper_group_sub('cameragroup', __('Camera'));


helper_slider('camresol', __('Camera'), __('Please select'), 0.2, 1, 205, '%s MP');


//helper_slider('seccamresol', __('Secondary camera'), __('Please select'), 0.1, 1, 100, '%s MP');

/*
helper_slider_by_list('camera', __('Camera'), __('Please select'), 1, 9, 'Error', array(
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


helper_yes_no("seccamera", __('Camera (secondary)'), true); 

//helper_yes_no("videocall", __('Videocall'), true);

helper_yes_no("camera_flash", __('Camera flash'), true);










helper_group_sub('data', __('Data and memory'));


helper_slider('gsm', __('GSM generations'), __('Please select'), 1, 2, 4, '%s' . 'G', '2' . 'G', '4' . 'G');

helper_yes_no("wifi", 'Wi-Fi', true);

helper_yes_no("bluetooth", 'Bluetooth', true);


helper_slider_by_list('internal_memory', __('Internal memory'), __('Please select'), 1, 13, 'Error', array(
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
	),__('none'),'128' . 'GB');


helper_slider_by_list('memory', __('Memory card'), __('Please select'), 1, 10, 'Error', array(
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








helper_group_sub('features', __('Features'));

helper_yes_no("gps", 'GPS', true);

helper_yes_no("radio", __('Radio'), true);

helper_yes_no("audio_jack", __('3.5 mm audio jack'), true);





helper_group_sub('extra', __('Extra things'));


helper_yes_no("charger", __('Charger'), true);

helper_yes_no("headphone", __('Headphones'), true);

helper_yes_no("usbcable", __('USB cable'), true);

helper_yes_no("extra_body", __('Extra body'), true);

helper_yes_no("box", __('Box'), true);

helper_yes_no("warranty", __('Warranty'), true);

?>