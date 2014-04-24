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
/*
render_value('tvtype', __('TV type'), 'Error', array(
	1 => __('TV_type'), 
	2 => __('Home theatre')
	));
*/
render_value('tvmodel', __('TV / Home theatre model'), '%s ' );		



render_value('diagonal', __('Diagonal'), '%s' . '"');

render_value('scrrate', __('Screen refresh rate'), '%s ' . 'HZ');

render_value('displaytype', __('Display type'), 'Error', array(
	1 => 'LCD', 
	2 => 'LED', 
	3 => 'OLED', 
	4 => __('Plasma'), 
	5 => __('CRT'), 
	6 => __('other')
	));


render_format('resolutionconf', __('Resolution'));


render_yes_no("3dtv", '3D TV', true);

render_yes_no("smarttv", 'Smart TV', true);

/*
render_value('resolution', __('Resolution'), 'Error', array(
'320x240' => '320x240',
'320x480' => '320x480',
'352x416' => '352x416',
'420x293' => '420x293',
'480x272' => '480x272',
'480x272' => '480x272',
'480x320' => '480x320',
'480x640' => '480x640',
'480x800' => '480x800',
'480x854' => '480x854',
'480x1024' => '480x1024',
'528x436' => '528x436',
'540x960' => '540x960',
'600x800' => '600x800',
'640x360' => '640x360',
'640x480' => '640x480',
'640x960' => '640x960',
'720x480' => '720x480',
'720x576' => '720x576',
'720x1280' => '720x1280',
'800x480' => '800x480',
'800x600' => '800x600',
'800x1280' => '800x1280',
'854x480' => '854x480',
'864x1152' => '864x1152',
'960x540' => '960x540',
'1024x600' => '1024x600',
'1024x768' => '1024x768',
'1152x768' => '1152x768',
'1152x864' => '1152x864',
'1200x824' => '1200x824',
'1280x720' => '1280x720',
'1280x768' => '1280x768',
'1280x800' => '1280x800',
'1280x854' => '1280x854',
'1280x1024' => '1280x1024',
'1360x768' => '1360x768',
'1366x720' => '1366x720',
'1366x768' => '1366x768',
'1400x1050' => '1400x1050',
'1440x900' => '1440x900',
'1600x768' => '1600x768',
'1600x900' => '1600x900',
'1600x1200' => '1600x1200',
'1680x945' => '1680x945',
'1680x1050' => '1680x1050',
'1920x1080' => '1920x1080',
'1920x1200' => '1920x1200',
'1920x1440' => '1920x1440',
'2048x1050' => '2048x1050',
'2048x1152' => '2048x1152',
'2048x1536' => '2048x1536',
'2560x1440' => '2560x1440',
'2560x1600' => '2560x1600',
'2880x1800' => '2880x1800',
'3840x2160' => '3840x2160',
'3840x2400' => '3840x2400',
'other'=> __('other'),  
	));
*/

render_yes_no("widescreen", __('Widescreen'));





///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));


render_value('responsetime', __('Response time'), __('%s ms'));

render_check('inputs', __('Inputs'), array( 			
	array('usb', 'USB'), 
	array('vga', 'VGA'), 
	array('dvi', 'DVI'), 
	array('hdmi', 'HDMI'), 
	array('displayport', 'Display Port'), 
	array('lan', 'LAN'), 
	) );

render_value('speaker_system', __('Speakers system'), '%s', array(
	0 => 'image:no',
	1 => '1 (mono)',
	2 => '2.0 (stereo)', 
	3 => '2.1 (stereo)', 
	4 => '4.0 (quadro)', 
	5 => '4.1 (quadro)', 
	6 => '5.1 (surround)', 
	7 => '7.1 (surround)'
	));


render_value('tvspwatts', __('Speaker power'), __('%s Watts'));


render_yes_no("intdiscdrive", __('Integrated disc drive'));

render_yes_no("webcam", __('Integrated web camera'));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
