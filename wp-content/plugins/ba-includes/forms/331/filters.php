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

//filter_text("dcammodel", __('Camcorder model'), __('Please enter desired model.'));

/*
filter_select(array(
'id'			=>'camcordertype'
, 'title'		=>__('Camcorder type')
, 'values'		=>array( 
	array(1, __('everyday')),
	array(2, __('professional')),
	array(6, __('security')),
	array(3, __('hidden')),
	array(4, __('for car')),
	array(5, __('other'))
				)
			, priority => PRIMARY_FILTER
			));

*/

filter_creative_design();



filter_select(array(
  'id'			=>'videores'
, 'title'		=>__('Video resolution')
	, 'values'		=>array( 
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
				array('other', __('other')))
, priority => PRIMARY_FILTER
	));


filter_slider(array(
	'id'			=>'optzoom'
	, 'title'	=>__('Optical zoom')
	, 'rate'		=>0.5
	, 'min'			=>4
	, 'max'			=>100
	, 'text'		=>'%s X'
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_slider('digzoom', __('Digital zoom'), 2, 2, 100, '%s X');


filter_yes_no("3drec", __('3D recording'));


filter_select('micsystem', __('Microphone'),  array( 
	array('none', __('none')),
	array(1 , '1 (mono)'),
	array(2 , '2.0 (stereo)'), 
	array(3 , '4.0 (quadro)'),
	array(4 , '5.1 (surround)'), 
	array(5 , '7.1 (surround)')
	) );



/*

filter_group_sub('meminfo', __('Memory'));

filter_number("memrysizecam", __('Memory size'), __('Please enter the memory size.'),  array( 
	array(1, 'GB'),  
	array(2, __('minutes')) 
	) );
*/

filter_select(array(
  'id'			=>'storagetype'
, 'title'		=>__('Storage type')
, 'values'		=>array( 
	array(1, __('film')),
	array(2, 'VHS'),
	array(3, 'DVD'),
	array(4, __('Blu-Ray disc')),
	array(5, __('memory card')),
	array(6, 'HDD'),
	array('other', __('other'))
				)
			, priority => PRIMARY_FILTER
			));



filter_number("memrysizecam", __('Memory size'), __('Please enter the memory size.'),  array( 
	array(1, 'GB'),  
	array(2, 'MB') 
	) );













filter_yes_no("phodemode", __('Photo mode'));

filter_slider('dcamresol', __('Image resolution'), 0.5, 2, 60, '%s MP');

filter_yes_no("extmiccon", __('External microphone possibility'));

filter_yes_no("videolight", __('Video light'));






filter_group_sub('display', __('Display'));

filter_select('color', __('Color quantity'), array( 
	array(4, __('256K')),
	array(5, __('16M')),
	array(6, __('other'))
	) );

filter_slider('diagonal', __('Diagonal'), 0.1, 20, 50, '%s "', '%s "', '%s "');






filter_yes_no("touchscreendisplay", __('Touchscreen display'));

filter_yes_no("swiveldisplay", __('Swivel display'));

filter_yes_no("multitouch", __('Multitouch'));







filter_check('extra', __('Extra things'),  array( 
	array('charger', __('charger')),
	array('usbcable', __('USB cable')),
	array('extrabattery', __('extra battery')),	
	array('bag', __('bag')),
	array('tripod', __('tripod')),
	) ,1);




?>