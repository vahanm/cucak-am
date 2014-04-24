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

render_value('monitormodel', __('Monitor model'), '%s ' );		

render_value('diagonal', __('Diagonal'), '%s' . '"');


render_value('displaytype', __('Display type'), 'Error', array(
	1 => 'LCD', 
	2 => 'LED', 
	3 => 'OLED', 
	4 => __('Plasma'), 
	5 => __('CRT'), 
	6 => __('other')
	));

render_format('resolutionconf', __('Resolution'));

/*
render_value('resolution', __('Resolution'), 'Error', array(
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


render_yes_no("3dmonitor", __('3D monitor'));




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));


render_value('responsetime', __('Response time'), __('%s ms'));

render_check('inputs', __('Inputs'), array( 			
	array('vga', 'VGA'), 
	array('dvi', 'DVI'), 
	array('hdmi', 'HDMI'), 
	array('displayport', 'Display Port'), 
	array('speakers', 'Speakers'), 
	array('other', __('other')) 
	) );

render_check('outputs', __('Outputs'), array( 			
	array('usb', 'USB'), 
	array('audioout', 'Audio Out'), 
	array('webcam', 'Web Cam'), 
	array('other', __('other')) 
	) );


render_yes_no("integrspeakers", __('Integrated speakers'));

render_yes_no("webcam", __('Integrated web camera'));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
