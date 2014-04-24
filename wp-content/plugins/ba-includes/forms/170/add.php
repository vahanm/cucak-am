<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));



helper_group('computer', __('Computer'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("cpu", __('CPU (processor) model'), __('Please enter the model.'));

helper_slider('cpufrequency', __('Frequency'), __('Please select'), 0.1, 4, 50, '%s GHz','400 MHz', '%s GHz');

helper_slider('core', __('Core quantity'), __('Please select'), 1, 1, 12, __('%s cores'));

helper_yes_no("hyper_threading", 'Hyper Threading');

helper_text("mb", __('Motherboard model'), __('Please enter the model.'));

helper_slider('ram', __('RAM size'), __('Please select'), 0.25, 0, 64, '%s ' . 'GB', __('no RAM'), '16 ' . 'GB');

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
	16 =>  '4 ' . 'TB',
	), __('no HDD'), '4 ' . 'TB');

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




helper_group_sub('monitorgroup', __('Monitor'));
	
helper_text("monitormodel", __('Monitor model'), __('Please enter the model.'));

helper_slider('monitor', __('Monitor diagonal'), __('Please select'), 0.5, 26, 80, '%s ' . '"', '13 ' . '"', '40 '. '"');

helper_yes_no("widemonitor", __('Wide monitor'));






helper_group_sub('graphicsgroup', __('Graphics'));

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
		
		
		
helper_group_sub('accessories', __('Accessories'));		
		
helper_yes_no("keyboard", __('Keyboard'), true);

helper_yes_no("mouse", __('Mouse'), true);

helper_yes_no("web_cam", __('Web camera'), true);

helper_yes_no("speaker", __('Speakers'), true);

helper_yes_no("headphone", __('Headphones'), true);


helper_group_sub('extradevices', __('Extra devices'));		

helper_check('printerscanner', __('Printer / Scanner'),  array( 
	array('printer', __('printer')),
	array('scanner', __('scanner')),
	array('copier', __('copier'))
	) );

helper_yes_no("ups", __('UPS'));





?>


