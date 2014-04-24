<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));



helper_group('notnet', __('Notebook / Netbook'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);
;


helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );

helper_radio('notebooktype', __('Notebook type'), array( 
	array(1, __('Notebook')),  
	array(2, __('Netbook'))
	) );


helper_text("notnetmodel", __('Notebook (netbook) model'), __('Please enter the model.'));

helper_text("opersystem", __('Operating system'), __('Please enter the name of the operating system.'));
	
helper_text("cpu", __('CPU (processor) model'), __('Please enter the model.'));

helper_slider('cpufrequency', __('Frequency'), __('Please select'), 0.1, 4, 40, '%s GHz','400 MHz', '%s GHz');

helper_slider('core', __('Core quantity'), __('Please select'), 1, 1, 8, __('%s cores'));

helper_yes_no("hyper_threading", 'Hyper Threading');

helper_slider('ram', __('RAM size'), __('Please select'), 0.25, 0, 48, '%s ' . 'GB', __('no RAM'), '12 ' . 'GB');

helper_select('slottype', __('Slot type'), array( 			
	array(1, 'SD'),  
	array(2, 'DDR'),     
	array(3, 'DDR2'), 
	array(4, 'DDR3'),
	array(5, __('other'))
	) );

helper_slider_by_list('hdd', __('HDD memory size'), __('Please select'), 1, 16, '%s GB', array(
	1 =>  __('no HDD'),
	2 =>  '20 ' . 'GB', 
	3 =>  '40 ' . 'GB', 
	4 =>  '80 ' . 'GB',
	5 =>  '120 ' . 'GB',
	6 =>  '160 ' . 'GB',			
	7 =>  '250 ' . 'GB',
	8 =>  '320 ' . 'GB',
	9 =>  '500 ' . 'GB',
	10 =>  '640 ' . 'GB',
	11 =>  '750 ' . 'GB',
	12 =>  '1 ' . 'TB',
	13 =>  '1.5 ' . 'TB',
	14 =>  '2 ' . 'TB',
	15 =>  '3 ' . 'TB',
	16 =>  '4 ' . 'TB'
	), __('no HDD'), _t('%s TB or more', 4));


//helper_slider('ssdmem', __('SSD memory size'), __('Please select'), 32, 1, 32, __('%s GB'), '%s ' . __('GB'), __('1 TB'));
helper_number("ssdmem", __('SSD memory size'), __('Please enter the memory size.'),  array( 
    array(1, __('GB'))
    ) );


helper_select('optic', __('Optical disc drive'), array( 
	array(1, __('no optical drive')),
	array(2, 'CD-ROM'),  
	array(3, 'CD-RW'),  
	array(4, 'DVD-ROM'), 
	array(5, 'DVD/CD-RW Combo'),
	array(6, 'DVD-RW'),
	array(7, 'Blu-Ray/DVD-RW Combo'),
	array(8, 'Blu-Ray-RW')
		) );




helper_group_sub('displaygroup', __('Display'));


helper_slider('display', __('Display diagonal'), __('Please select'), 0.1, 90, 200, '%s "');



helper_resolution(array(
    'id' => 'resolution',
    'title' => __('Resolution'),
    'suggestions' => array(
               
            
array(2880, 1800, 'MacBook Pro 15"'),
array(2560, 1600, 'MacBook Pro 13"'),
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
    
helper_select('resolution', __('Resolution'), array( 
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

helper_yes_no("ledbacklight", __('LED backlight'), true);

helper_yes_no("glossydisplay", __('Glossy display'), true);

helper_yes_no("touchscreen", __('Touchscreen'), true);

helper_yes_no("3D", '3D', true);



helper_group_sub('graphicsgroup', __('Color and graphics'));

helper_colors('notcolor', __('Notebook color'));

helper_text("videocard", __('Video card model'), __('Please enter the model.'));

helper_slider_by_list('videocardmemory', __('Video card memory'), __('Please select'), 1, 8, '%s MB', array(
	1 =>  __('onboardcomp'),
	2 =>  '64 ' . 'MB', 
	3 =>  '128 ' . 'MB',
	4 =>  '256 ' . 'MB',		
	5 =>  '512 ' . 'MB',
	6 =>  '1 ' . 'GB',
	7 =>  '1.5 ' . 'GB',
	8 =>  '2 ' . 'GB',
	),__('onboardcomp'), '2 ' . 'GB');
		


helper_group_sub('features', __('Features'));		

helper_yes_no("web_cam", __('Web camera'), true);		

//helper_yes_no("builtinbic", __('Built-in microphone'), true);
helper_yes_no("fingerprintsensor", __('Fingerprint sensor'), true);

helper_yes_no("backlitkeyboard", __('Backlit keyboard'), true);


helper_yes_no("numerickeypad", __('Numeric keypad'), true);
		
		

helper_yes_no("multitouch", __('Multitouch touchpad'));

helper_check('communications', __('Communications'),  array( 
	array('lan', 'LAN'),
	array('wifi', 'WiFi'),
	array('bluetooth', 'Bluetooth'),
//	array('irda', __('IrDA')),
	array('gsmmodule', __('GSM module')),
	) ,5 );

helper_check('ports', __('Ports'),  array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	array('esata', 'eSATA'),
	array('hdmi', 'HDMI'),
	array('vga', 'VGA'),
	array('dvi', 'DVI'),
	array('1394', '1394'),	
	array('compositevideo', 'Composite video'),
	array('svideo', 'S-Video'),
	array('compvideo', 'Component video'),
	array('dms', 'DMS-59'),
	array('displayport', 'DisplayPort'),
	) );



		
helper_group_sub('accessories', __('Accessories'));		

helper_yes_no("charger", __('Charger'), true);

helper_yes_no("bag", __('Bag'), true);




		
helper_group_sub('extrathings', __('Gifts'));		

helper_yes_no("extrabattery", __('Extra battery'), true);

helper_yes_no("mouse", __('Mouse'), true);

helper_yes_no("headphone", __('Headphones'), true);

//helper_yes_no("wifiac", __('WiFi access point'), true);



