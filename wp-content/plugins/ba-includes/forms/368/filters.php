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

//filter_text("dcammodel", __('Camera model'), __('Please enter desired model.'));


//filter_colors('dcamcolor', __('Camera color'));


filter_creative_design();



filter_group_sub('imsensinf', __('Image sensor'));


filter_select('imsentype', __('Image sensor type'), array( 
	array(1, 'CMOS'), 
	array(2, 'CCD'), 
	array(3, __('other')) 
	));



filter_slider(array(
  'id'			=>'dcamresol'
	, 'title'	=>__('Image resolution')
, 'rate'		=>0.2
, 'min'			=>10
, 'max'			=>150
, 'text'		=>'%s MP'
	, 'priority'	=>	PRIMARY_FILTER
	));



filter_select('shutterspeed', __('Shutter speed'), array( 
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


filter_slider_by_list2('isosensitivity', __('ISO sensitivity'), 1, 10, __('%1 - %2'), '%s', array(
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



filter_group_sub('lensinfo', __('Lens'));

filter_slider(array(
  'id'			=>'optzoom'
	, 'title'	=>__('Optical zoom')
, 'rate'		=>0.5
, 'min'			=>4
, 'max'			=>80
, 'text'		=>'%s X'
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_slider('digzoom', __('Digital zoom'), 1, 8, 100, '%s X');


filter_group_sub('videorec', __('Video recording'));

filter_select(array(
  'id'			=>'videores'
, 'title'		=>__('Video recording')
	, 'values'		=>array( 
				array(1, __('no video recording')),
				array(2, '640x480'),  
				array(3, '1280x720'),  
				array(4, '1920x1080'), 
				array(5, __('other')))
	, 'priority'	=>	PRIMARY_FILTER
	));



filter_group_sub('meminfo', __('Memory'));


filter_check('memorycard', __('Memory card type'),  array( 
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
	) ,1);


filter_slider_by_list2('memory', __('Memory card'), 1, 9, __('%1 - %2'), 'Error', array(
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














filter_group_sub('display', __('Display'));

filter_select('color', __('Color quantity'), array( 
	array(4, __('256K')),
	array(5, __('16M')),
	array(6, __('other'))
	) );

filter_slider(array(
  'id'			=>'diagonal'
	, 'title'	=>__('Diagonal')
, 'rate'		=>0.1
, 'min'			=>20
, 'max'			=>50
, 'text'		=>'%s "'
	, 'priority'	=>	PRIMARY_FILTER
));





filter_yes_no(array(
	'id'			=>"touchscreendisplay"
	, 'title'		=>__('Touchscreen display')
	, priority => PRIMARY_FILTER
	));


filter_yes_no(array(
	'id'			=>"multitouch"
	, 'title'		=>__('Multitouch')
	, priority => PRIMARY_FILTER
	));

filter_yes_no("swiveldisplay", __('Swivel display'));






filter_check('extra', __('Extra things'),  array( 
	array('charger', __('charger')),
	array('usbcable', __('USB cable')),
	array('extrabattery', __('extra battery')),	
	array('bag', __('bag')),
	array('tripod', __('tripod')),

	) ,1);







?>