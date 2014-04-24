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
	
/*
filter_select('tvtype', __('TV type'), array( 
	array(1, __('TV_type')),  
	array(2, __('Home theatre'))
	) );
*/
//filter_text("tvmodel", __('TV / Home theatre model'), __('Please enter desired model.'));



filter_slider(array(
  'id'			=>'diagonal'
	, 'title'	=>__('Diagonal')
, 'rate'		=>0.5
, 'min'			=>10
, 'max'			=>200
, 'text'		=>'%s "'
	, 'priority'	=>	PRIMARY_FILTER
	));



filter_slider(array(
  'id'			=>'scrrate'
	, 'title'	=>__('Screen refresh rate')
, 'rate'		=>5
, 'min'			=>5
, 'max'			=>120
, 'text'		=>'%s Hz'
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_select(array(
  'id'			=>'displaytype'
, 'title'		=>__('Display type')
	, 'values'		=>array( 
				array(1, 'LCD'),  
				array(2, 'LED'), 
				array(3, 'OLED'), 
				array(4, __('Plasma')),
				array(5, __('CRT')),  	
				array(6, __('other')))
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_yes_no(array(
  'id'			=>"3dtv"
, 'title'		=>'3D TV'
, 'half'		=>true
	, 'priority'	=>	PRIMARY_FILTER
	));

filter_yes_no(array(
  'id'			=>"smarttv"
, 'title'		=>'Smart TV'
, 'half'		=>true
	, 'priority'	=>	PRIMARY_FILTER
	));


/*
filter_select('resolution', __('Resolution'), array( 
	array('320x240', '320x240'),
	array('320x480', '320x480'),
	array('352x416', '352x416'),
	array('420x293', '420x293'),
	array('480x272', '480x272'),
	array('480x272', '480x272'),
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


filter_yes_no("widescreen", __('Widescreen'));




filter_check('inputs', __('Inputs'), array( 			
	array('usb', 'USB'), 
	array('vga', 'VGA'), 
	array('dvi', 'DVI'), 
	array('hdmi', 'HDMI'), 
	array('displayport', 'Display Port'), 
	array('lan', 'LAN'), 
	),1 );



filter_slider_by_list(array(
  'id'			=>'speaker_system'
, 'title'		=>__('Speakers system')
, 'min'			=>0
, 'max'			=>7
, 'format'		=>__('%1 - %2')
, 'text'		=>'%s '
, 'listItems'	=>array(
	0 => __('no speakers'),
	1 => '1 (mono)',
	2 => '2.0 (stereo)', 
	3 => '2.1 (stereo)', 
	4 => '4.0 (quadro)', 
	5 => '4.1 (quadro)', 
	6 => '5.1 (surround)', 
	7 => '7.1 (surround)'
	)
, 'begin'		=>__('no speakers')
, 'end'			=>'7.1 (surround)'
			, 'priority'	=>	PRIMARY_FILTER
			));


filter_slider('tvspwatts', __('Speaker power'), 2, 1, 100,__('%s Watts'));


filter_yes_no("intdiscdrive", __('Integrated disc drive'));

filter_yes_no(array(
  'id'			=>"webcam"
, 'title'		=>__('Integrated web camera')
			, 'priority'	=>	PRIMARY_FILTER
			));



?>


