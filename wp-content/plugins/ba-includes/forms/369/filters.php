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

filter_group_sub('imsensinf', __('Image sensor'));

/*
filter_select('imsentype', __('Image sensor type'), array( 
	array(1, 'CMOS'), 
	array(2, 'CCD'), 
	array(3, __('other')) 
	));
*/
filter_select(array(
'id'			=>'imagesensor'
, 'title'		=>__('Image sensor size')
, 'values'		=>array( 
	array('128', '1.28x0.96' .__('mm') . ' - 1/10"'),
	array('160', '1.6x1.2' .__('mm') . ' - 1/8"'),
	array('240', '2.4x1.8' .__('mm') . ' - 1/6"'),
	array('320', '3.2x2.4' .__('mm') . ' - 1/4"'),
	array('400', '4x3' .__('mm') . ' - 1/3.6"'),
	array('454', '4.54x3.42' .__('mm') . ' - 1/3.2"'),
	array('480', '4.8x3.6' .__('mm') . ' - 1/3"'),
	array('537', '5.37x4.04' .__('mm') . ' - 1/2.7"'),
	array('576', '5.76x4.29' .__('mm') . ' - 1/2.5"'),
	array('617', '6.17x4.55' .__('mm') . ' - 1/2.3"'),
	array('640', '6.4x4.8' .__('mm') . ' - 1/2"'),
	array('718', '7.18x5.32' .__('mm') . ' - 1/1.8"'),
	array('760', '7.6x5.7' .__('mm') . ' - 1/1.7"'),
	array('808', '8.08x6.01' .__('mm') . ' - 1/1.6"'),
	array('880', '8.8x6.6' .__('mm') . ' - 2/3"'),
	array('1067', '10.67x8' .__('mm') . ' - 1/1.2"'),
	array('1252', '12.52x7.41' .__('mm') . ' - Super 16mm'),
	array('1320', '13.2x8.8' .__('mm') . ' - Nikon CX and Sony RX100'),
	array('1280', '12.8x9.6' .__('mm') . ' - 1"'),
	array('1730', '17.3x13' .__('mm') . ' - 4/3" (Four Thirds)'),
	array('1870', '18.7x14' .__('mm') . ' - 1.5"'),
	array('2070', '20.7x13.8' .__('mm') . ' - Sigma Foveon X3'),
	array('2220', '22.2x14.8' .__('mm') . ' - Canon APS-C'),
	array('2360', '23.6-23.7x15.6' .__('mm') . ' - General APS-C'),
	array('2790', '27.9x18.6' .__('mm') . ' - Canon APS-H'),
	array('3600', '36x23.9-24.3' .__('mm') . ' - 35mm Full-frame'),
	array('other', __('other')),  
				)
			, priority => PRIMARY_FILTER
			));




filter_slider(array(
  'id'			=>'dcamresol'
	, 'title'	=>__('Image resolution')
, 'rate'		=>1
, 'min'			=>4
, 'max'			=>40
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


filter_slider('continuousshootingjpeg', __('Continuous shooting (JPEG)'), 0.1, 1, 100, __('%s shots/s'));

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

filter_select('camleans', __('Camera lens'), array( 
	array(1, __('without lens')), 
	array(2, __('factory lens')), 
	array(3, __('replaced lens')), 	
	array(4, __('other')) 
	),2);


//filter_textarea('cameralenstype', __('Lens options'), __('Please enter the lens options.'), _t('%s characters max', 1000), 50);


filter_group_sub('videorec', __('Video recording'));

filter_select(array(
  'id'			=>'videores'
, 'title'		=>__('Video recording')
, 'values'		=>array( 
	array(1, __('no video recording')),
	array(2, '640x480'),  
	array(3, '1280x720'),  
	array(4, '1920x1080'), 
	array(5, __('other'))
				)
			, priority => PRIMARY_FILTER
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

filter_slider('diagonal', __('Diagonal'), 0.1, 20, 50, '%s "', '%s "', '%s "');






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
	array('extralens', __('extra lens')),
	array('extraspeedlight', __('extra speedlight')),
	array('bag', __('bag')),
	array('tripod', __('tripod')),

	) ,1);




?>