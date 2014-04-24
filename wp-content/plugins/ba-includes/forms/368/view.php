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


render_creative_design();



	
render_group_sub(__('Image sensor'));
	
render_value('imsentype', __('Image sensor type'), 'Error', array(
	1 => 'CMOS', 
	2 => 'CCD', 
	3 => __('other') 
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


render_value('optzoom', __('Optical zoom'), '%s X');	
  

render_value('digzoom', __('Digital zoom'), '%s X');	
  




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
	array('bag', __('bag')),
	array('tripod', __('tripod')),
	));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
