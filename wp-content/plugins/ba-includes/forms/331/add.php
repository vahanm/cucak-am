<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false, 'allow_donation' => false));




helper_group('general_information', __('General'));



helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );

helper_text("dcammodel", __('Camcorder model'), __('Please enter the model.'));

/*
helper_radio('camcordertype', __('Camcorder type'), array( 
	array(1, __('everyday')),
	array(2, __('professional')),
	array(6, __('security')),
	array(3, __('hidden')),
	array(4, __('for car')),
	array(5, __('other'))
	) ,5);
*/

helper_creative_design();



helper_select('videores', __('Video resolution'), array( 
	array('320x240', '320x240 QVGA'),
	array('352x288', '352x288'),
	array('640x480', '640x480 VGA'),
	array('720x480', '720x480'),
	array('848x480', '848x480'),
	array('1280x720', '1280x720 HD'),
	array('1280x960', '1280x960'),
	array('1280x1024', '1280x1024'),
	array('1920x1080', '1920x1080 FullHD'),
	array('2048x1536', '2048x1536'),
	array('other', __('other'))
	));


helper_slider('optzoom', __('Optical zoom'), __('Please select'), 0.5, 4, 100, '%s X');

helper_slider('digzoom', __('Digital zoom'), __('Please select'), 2, 2, 100, '%s X');


helper_yes_no("3drec", __('3D recording'));


helper_select('micsystem', __('Microphone'),  array( 
	array('none', __('none')),
	array(1 , '1 (mono)'),
	array(2 , '2.0 (stereo)'), 
	array(3 , '4.0 (quadro)'),
	array(4 , '5.1 (surround)'), 
	array(5 , '7.1 (surround)')
) );



/*

helper_group_sub('meminfo', __('Memory'));

helper_number("memrysizecam", __('Memory size'), __('Please enter the memory size.'),  array( 
	array(1, 'GB'),  
	array(2, __('minutes')) 
	) );
*/

helper_select('storagetype', __('Storage type'), array( 
	array(1, __('film')),
	array(2, 'VHS'),
	array(3, 'DVD'),
	array(4, __('Blu-Ray disc')),
	array(5, __('memory card')),
	array(6, 'HDD'),
	array('other', __('other'))
	));


helper_number("memrysizecam", __('Memory size'), __('Please enter the memory size.'),  array( 
	array(1, 'GB'),  
	array(2, 'MB') 
	) );













helper_yes_no("phodemode", __('Photo mode'));

helper_slider('dcamresol', __('Image resolution'), __('Please select'), 0.5, 2, 60, '%s MP');

helper_yes_no("extmiccon", __('External microphone possibility'), true);

helper_yes_no("videolight", __('Video light'), true);






helper_group_sub('display', __('Display'));

helper_radio('color', __('Color quantity'), array( 
		array(4, __('256K')),
		array(5, __('16M')),
		array(6, __('other'))
		) );

helper_slider('diagonal', __('Diagonal'), __('Please select'), 0.1, 20, 50, '%s "', '%s "', '%s "');






helper_yes_no("touchscreendisplay", __('Touchscreen display'), true);

helper_yes_no("swiveldisplay", __('Swivel display'), true);

helper_yes_no("multitouch", __('Multitouch'), true);







helper_check('extra', __('Extra things'),  array( 
	array('charger', __('charger')),
	array('usbcable', __('USB cable')),
	array('extrabattery', __('extra battery')),	
	array('bag', __('bag')),
	array('tripod', __('tripod')),
	) ,3);




/*
helper_group_sub('extra', __('Extra things'));












helper_yes_no("charger", __('Charger'), true);


helper_yes_no("usbcable", __('USB cable'), true);

helper_yes_no("extrabattery", __('Extra battery'), true);

helper_yes_no("bag", __('Bag'), true);

helper_yes_no("tripod", __('Tripod'), true);

helper_yes_no("extralens", __('Extra lens'), true);

helper_yes_no("extraspeedlight", __('Extra speedlight'), true);


//helper_yes_no("secondary_display", __('Secondary display'));



//helper_yes_no("headphone", __('Headphones'), true);





helper_group_sub('cameragroup', __('Camera'));
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

helper_yes_no("seccamera", __('Camera (secondary)'), true); 

helper_yes_no("videocall", __('Videocall'), true);

helper_yes_no("camera_flash", __('Camera flash'), true);










helper_group_sub('data', __('Data and memory'));


helper_slider('gsm', __('GSM generations'), __('Please select'), 1, 1, 5, '%s' . 'G', '1' . 'G', '5' . 'G');

helper_yes_no("wifi", 'Wi-Fi', true);

helper_yes_no("bluetooth", 'Bluetooth', true);

helper_yes_no("IrDA", __('IrDA'), true);

helper_slider_by_list('internal_memory', __('Internal memory'), __('Please select'), 1, 12, 'Error', array(
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
	12 => '64' . 'GB' 
	),__('none'),'64' . 'GB');


helper_slider_by_list('memory', __('Memory card'), __('Please select'), 1, 9, 'Error', array(
	1 => __('none'), 
	2 => '512' . 'MB',
	3 => '1' . 'GB', 
	4 => '2' . 'GB', 
	5 => '4' . 'GB', 
	6 => '8' . 'GB',
	7 => '16' . 'GB', 
	8 => '32' . 'GB', 
	9 => '64' . 'GB' 
	),__('none'), '64' . 'GB');








helper_group_sub('features', __('Features'));

helper_yes_no("gps", 'GPS', true);

helper_yes_no("radio", __('Radio'), true);

helper_yes_no("audio_jack", __('3.5 mm audio jack'), true);





*/
?>