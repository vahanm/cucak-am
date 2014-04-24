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
	

	
render_value('dcammodel', __('Camcorder model'), '%s' );		

	
	/*
render_value('camcordertype', __('Camcorder type'), 'Error', array(
	1 => __('everyday'),
	2 => __('professional'),
	6 => __('security'),
	3 => __('hidden'),
	4 => __('for car'),
	5 => __('other')
	));
*/



render_creative_design();



render_value('videores', __('Video resolution'), 'Error', array(
	'320x240' => '320x240 QVGA',
	'352x288' => '352x288',
	'640x480' => '640x480 VGA',
	'720x480' => '720x480',
	'848x480' => '848x480',
	'1280x720' => '1280x720 HD',
	'1280x960' 	=>	'1280x960',
	'1280x1024'	=>	'1280x1024',
	'1920x1080'	=>	'1920x1080 FullHD',
	'2048x1536'	=>	'2048x1536',
	'other'	=>	__('other')
	));


render_value('optzoom', __('Optical zoom'), '%s X');	


render_value('digzoom', __('Digital zoom'), '%s X');	


render_yes_no("3drec", __('3D recording'));	
	

render_value('micsystem', __('Microphone'), 'Error', array(
	'none' => __('none') . ' - 1/10"',
	1 => '1 (mono)',
	2 => '2.0 (stereo)', 
	3 => '4.0 (quadro)',
	4 => '5.1 (surround)',
	5 => '7.1 (surround)'
	));



//render_group_sub(__('Memory'));

render_value('storagetype', __('Storage type'), 'Error', array(
	1 => __('film'),
	2 => 'VHS',
	3 => 'DVD',
	4 => __('Blu-Ray disc'),
	5 => __('memory card'),
	6 => 'HDD',
	'other'	=>	__('other')
	));




render_number('memrysizecam', __('Memory size'), array(
	1 => 'GB', 
	2 => 'MB'
	));	 


render_yes_no("phodemode", __('Photo mode'));



render_value('dcamresol', __('Image resolution'), '%s MP');



render_yes_no("extmiccon", __('External microphone possibility'));

render_yes_no("videolight", __('Video light'));















///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////


render_group_sub(__('Display'));


render_value('color', __('Color quantity'), 'Error', array(
	4 => __('256K'), 
	5 => __('16M'), 
	6 => __('other')
	));
	
	 
render_value('diagonal', __('Diagonal'), '%s "');	  



	 

render_yes_no("touchscreendisplay", __('Touchscreen display'));


render_yes_no("swiveldisplay", __('Swivel display'));

render_yes_no("multitouch", __('Multitouch'));


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
