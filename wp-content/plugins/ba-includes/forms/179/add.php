<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('monitor', __('Monitor'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("monitormodel", __('Monitor model'), __('Please enter the model.'));

helper_slider('diagonal', __('Diagonal'), __('Please select'), 0.5, 26, 80, '%s "');

helper_radio('displaytype', __('Display type'), array( 
	array(1, 'LCD'),  
	array(2, 'LED'), 
	array(3, 'OLED'), 
	array(4, __('Plasma')),
	array(5, __('CRT')),  	
	array(6, __('other'))
	) ,6);



helper_resolution(array(
    'id' => 'resolution',
    'title' => __('Resolution'),
    'suggestions' => array(
                
                array(2560, 1440, 'Apple 27"'),
                array(1920, 1200),
                array(1920, 1080),
                array(1680, 1050),
                array(1600, 900),
                array(1440, 900),
                array(1366, 768),
                array(1280, 1024)
                )
            ));
    
    /*
    
$color1 = '#666';
$color2 = '#000';
$color3 = '#444';

$colorA = '#dfd';

helper_select('resolution', __('Resolution'), array( 
	array('800x480', '800x480', $color1),
	array('800x600', '800x600', $color2),
	array('800x1280', '800x1280', $color3),
	array('854x480', '854x480', $color1),
	array('864x1152', '864x1152', $color1),
	array('960x540', '960x540', $color3),
	array('1024x600', '1024x600', $color3),
	array('1024x768', '1024x768', $color2),
	array('1152x768', '1152x768', $color3),
	array('1152x864', '1152x864', $color3),
	array('1200x824', '1200x824', $color3),
	array('1280x720', '1280x720', $color2),
	array('1280x768', '1280x768', $color3),
	array('1280x800', '1280x800', $color3),
	array('1280x854', '1280x854', $color3),
	array('1280x1024', '1280x1024', $color2),
	array('1360x768', '1360x768', $color3),
	array('1366x720', '1366x720', $color3),
	array('1366x768', '1366x768', $color2),
	array('1400x1050', '1400x1050', $color3),
	array('1440x900', '1440x900', $color3),
	array('1600x768', '1600x768', $color3),
	array('1600x900', '1600x900', $color2),
	array('1600x1200', '1600x1200', $color3),
	array('1680x945', '1680x945', $color3),
	array('1680x1050', '1680x1050', $color3),
	array('1920x1080', '1920x1080', $color2, $colorA),
	array('1920x1200', '1920x1200', $color3),
	array('1920x1440', '1920x1440', $color3),
	array('2048x1050', '2048x1050', $color3),
	array('2048x1152', '2048x1152', $color3),
	array('2048x1536', '2048x1536', $color3),
	array('2560x1440', '2560x1440', $color3),
	array('2560x1600', '2560x1600', $color3),
	array('2880x1800', '2880x1800', $color3),
	array('3840x2160', '3840x2160', $color3),
	array('3840x2400', '3840x2400', $color3),
	array('other', __('other')),  
	) );

*/


helper_yes_no("widescreen", __('Widescreen'));


helper_slider('responsetime', __('Response time'), __('Please select'), 1, 1, 20, __('%s ms'));



helper_yes_no("3dmonitor", __('3D monitor'));


helper_check('inputs', __('Inputs'), array( 			
	array('vga', 'VGA'), 
	array('dvi', 'DVI'), 
	array('hdmi', 'HDMI'), 
	array('displayport', 'Display Port'), 
	),6 );

helper_check('outputs', __('Outputs'), array( 			
	array('usb', 'USB'), 
	array('audioout', __('Audio output')), 
	) );


helper_yes_no("integrspeakers", __('Integrated speakers'));

helper_yes_no("webcam", __('Integrated web camera'));


?>


