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
	

	
render_value('dcammodel', __('Camera model'), '%s' );		

	
render_color('dcamcolor', __('Camera color'));



	
render_group_sub(__('Image sensor'));
	/*
render_value('imsentype', __('Image sensor type'), 'Error', array(
	1 => 'CMOS', 
	2 => 'CCD', 
	3 => __('other') 
	));
	*/
	
render_value('imagesensor', __('Image sensor size'), 'Error', array(
	'128' =>'1.28x0.96' .__('mm') . ' - 1/10"',
	'160' =>'1.6x1.2' .__('mm') . ' - 1/8"',
	'240' =>'2.4x1.8' .__('mm') . ' - 1/6"',
	'320' =>'3.2x2.4' .__('mm') . ' - 1/4"',
	'400' =>'4x3' .__('mm') . ' - 1/3.6"',
	'454' =>'4.54x3.42' .__('mm') . ' - 1/3.2"',
	'480' =>'4.8x3.6' .__('mm') . ' - 1/3"',
	'537' =>'5.37x4.04' .__('mm') . ' - 1/2.7"',
	'576' =>'5.76x4.29' .__('mm') . ' - 1/2.5"',
	'617' =>'6.17x4.55' .__('mm') . ' - 1/2.3"',
	'640' =>'6.4x4.8' .__('mm') . ' - 1/2"',
	'718' =>'7.18x5.32' .__('mm') . ' - 1/1.8"',
	'760' =>'7.6x5.7' .__('mm') . ' - 1/1.7"',
	'808' =>'8.08x6.01' .__('mm') . ' - 1/1.6"',
	'880' =>'8.8x6.6' .__('mm') . ' - 2/3"',
	'1067' =>'10.67x8' .__('mm') . ' - 1/1.2"',
	'1252' =>'12.52x7.41' .__('mm') . ' - Super 16mm',
	'1320' =>'13.2x8.8' .__('mm') . ' - Nikon CX and Sony RX100',
	'1280' =>'12.8x9.6' .__('mm') . ' - 1"',
	'1730' =>'17.3x13' .__('mm') . ' - 4/3" (Four Thirds)',
	'1870' =>'18.7x14' .__('mm') . ' - 1.5"',
	'2070' =>'20.7x13.8' .__('mm') . ' - Sigma Foveon X3',
	'2220' =>'22.2x14.8' .__('mm') . ' - Canon APS-C',
	'2360' =>'23.6-23.7x15.6' .__('mm') . ' - General APS-C',
	'2790' =>'27.9x18.6' .__('mm') . ' - Canon APS-H',
	'3600' =>'36x23.9-24.3' .__('mm') . ' - 35mm Full-frame',
	'other' =>__('other')
	));
	



render_value('dcamresol', __('Image resolution'), '%s MP');



	
render_value('shutterspeed', __('Shutter speed'), 'Error', array(
	'125' =>'1/125 ' . __('s'),
	'250' =>'1/250 ' . __('s'),
	'500' =>'1/500 ' . __('s'),
	'1000' =>'1/1000 ' . __('s'),
	'2000' =>'1/2000 ' . __('s'),
	'4000' =>'1/4000 ' . __('s'),
	'8000' =>'1/8000 ' . __('s'),
	'16000' =>'1/16000 ' . __('s'),
	'32000' =>'1/32000 ' . __('s')
	));




render_value('continuousshootingjpeg', __('Continuous shooting (JPEG)'), __('%s shots per second') );




render_value('isosensitivity', __('ISO sensitivity'), '%s', array(
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
	));


render_group_sub(__('Memory'));


render_check('memorycard', __('Memory card type'),  array( 
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
	));


render_value('memory', __('Memory card'), '%sGB', array(
	1 => 'image:no', 
	2 => '512' . 'MB',
	3 => '1' . 'GB', 
	4 => '2' . 'GB', 
	5 => '4' . 'GB', 
	6 => '8' . 'GB',
	7 => '16' . 'GB', 
	8 => '32' . 'GB', 
	9 => '64' . 'GB' 
	));


///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Lens'));



render_value('camleans', __('Camera lens'), 'Error', array(
	1 => __('without lens'), 
	2 => __('factory lens'), 
	3 => __('replaced lens'),
	4 => __('other')
	));


render_value('cameralenstype', __('Lens options'), '%s ' );


render_group_sub(__('Video recording'));

render_value('videores', __('Video recording'), 'Error', array(
	1 => __('no video recording'),
	2 => '640x480',  
	3 => '1280x720',  
	4 => '1920x1080', 
	5 => __('other')
	));


render_group_sub(__('Display'));


render_value('color', __('Color quantity'), 'Error', array(
	4 => __('256K'), 
	5 => __('16M'), 
	6 => __('other')
	));
	
	 
render_value('diagonal', __('Diagonal'), '%s "');	  



	 

render_yes_no("touchscreendisplay", __('Touchscreen display'));


render_yes_no("multitouch", __('Multitouch'));

render_yes_no("swiveldisplay", __('Swivel display'));


render_check('extra', __('Extra things'),  array( 
	array('charger', __('charger')),
	array('usbcable', __('USB cable')),
	array('extrabattery', __('extra battery')),	
	array('extralens', __('extra lens')),
	array('extraspeedlight', __('extra speedlight')),
	array('bag', __('bag')),
	array('tripod', __('tripod')),
	));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////
