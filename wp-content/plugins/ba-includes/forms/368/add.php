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

helper_text("dcammodel", __('Camera model'), __('Please enter the model.'));


helper_colors('dcamcolor', __('Camera color'));

helper_creative_design();




helper_group_sub('imsensinf', __('Image sensor'));


helper_radio('imsentype', __('Image sensor type'), array( 
	array(1, 'CMOS'), 
	array(2, 'CCD'), 
	array(3, __('other')) 
	));



helper_slider('dcamresol', __('Image resolution'), __('Please select'), 0.2, 10, 150, '%s MP');




helper_select('shutterspeed', __('Shutter speed'), array( 
	array('125', '1/125 ' . __('s')),
	array('250', '1/250 ' . __('s')),
	array('500', '1/500 ' . __('s')),
	array('1000', '1/1000 ' . __('s')),
	array('2000', '1/2000 ' . __('s')),
	array('4000', '1/4000 ' . __('s')),
	array('8000', '1/8000 ' . __('s')),
	array('16000', '1/16000 ' . __('s')),
	array('32000', '1/32000 ' . __('s'))
	));


helper_slider_by_list('isosensitivity', __('ISO sensitivity'), __('Please select'), 1, 10, '%s', array(
	1 => 'ISO 800',
	2 => 'ISO 1600',
	3 => 'ISO 3200',
	4 => 'ISO 6400',
	5 => 'ISO 12800',
	6 => 'ISO 25600',
	7 => 'ISO 51200',
	8 => 'ISO 102400',
	9 => 'ISO 204800',
	10 => 'ISO 409600',
	), 'ISO 800', 'ISO 409,600');



helper_group_sub('lensinfo', __('Lens'));

helper_slider('optzoom', __('Optical zoom'), __('Please select'), 0.5, 4, 80, '%s X');

helper_slider('digzoom', __('Digital zoom'), __('Please select'), 1, 8, 100, '%s X');


helper_group_sub('videorec', __('Video recording'));

helper_radio('videores', __('Video recording'), array( 
	array(1, __('no video recording')),
	array(2, '640x480'),  
	array(3, '1280x720'),  
	array(4, '1920x1080'), 
	array(5, __('other'))
	),5 );



helper_group_sub('meminfo', __('Memory'));


helper_check('memorycard', __('Memory card type'),  array( 
	array(1, 'SD'),
	array(2, 'SDXC'),
	array(3, 'Micro SD'),
	array(4, 'Mini SD'),
	array(5, 'SDHC'),
	array(6, 'Micro SDHC'),
	array(7, 'Mini SDHC'),
	array(8, 'CF'),
	array(9, 'UDMA'),
	array(10, 'CFast'),
	array(11, 'XD'),
	array(12, 'Memory stick'),
	array(13, __('other'))
	) ,4);


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














helper_group_sub('display', __('Display'));

helper_radio('color', __('Color quantity'), array( 
		array(4, __('256K')),
		array(5, __('16M')),
		array(6, __('other'))
		) );

helper_slider('diagonal', __('Diagonal'), __('Please select'), 0.1, 20, 50, '%s "', '%s "', '%s "');






helper_yes_no("touchscreendisplay", __('Touchscreen display'), true);

helper_yes_no("multitouch", __('Multitouch'), true);


helper_yes_no("swiveldisplay", __('Swivel display'), true);






helper_check('extra', __('Extra things'),  array( 
	array('charger', __('charger')),
	array('usbcable', __('USB cable')),
	array('extrabattery', __('extra battery')),	
	array('bag', __('bag')),
	array('tripod', __('tripod')),

	) ,3);







?>