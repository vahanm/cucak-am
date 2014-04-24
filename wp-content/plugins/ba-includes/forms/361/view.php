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
render_value('cpu', __('CPU (processor) model'), '%s ' );	

render_value('cpufrequency', __('Frequency'),'%s GHz');	

render_value('core', __('Core quantity'), __('%s cores'));	

render_yes_no("hyper_threading", 'Hyper Threading');

render_value('mb', __('Motherboard model'), '%s ' );	 

render_value('ram', __('RAM size'), '%s ' . 'GB', array(
	0 => 'image:no',
	'0.25' => '256 MB',
	'0.5' => '512 MB',
	'0.75' => '768 MB'
));	

render_value('slottype', __('Slot type'), 'Error', array(
	1 =>  'SDR', 
	2 =>  'DDR', 
	3 =>  'DDR2', 
	4 =>  'DDR3', 
	5 =>  __('other')
	));

render_value('hdd', __('HDD memory size'), 'Error', array(
	1 =>  'image:no',
	2 =>  _t('%s GB or less', 20), 
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
	16 =>  _t('%s TB or more', 4)
	));

render_value('optic', __('Optical disc drive'), 'Error', array(
		1 => 'image:no',
		2 =>  'CD-ROM', 
		3 =>  'CD-RW',
		4 =>  'DVD-ROM',		
		5 =>  'DVD/CD-RW Combo',
		6 =>  'DVD-RW',
		7 =>  'Blu-Ray/DVD-RW Combo',
		8 =>  'Blu-Ray-RW'
		));
	
	
render_group_sub(__('Graphics'));

render_value('videocard', __('Video card model'), '%s ' );

render_value('videocardmemory', __('Video card memory'), 'Error', array(
	1 =>  __('onboardcomp'),
	2 =>  '64 ' . 'MB', 
	3 =>  '128 ' . 'MB',
	4 =>  '256 ' . 'MB',		
	5 =>  '512 ' . 'MB',
	6 =>  '1 ' . 'GB',
	7 =>  '1.5 ' . 'GB',
	8 =>  _t('%s GB or more', 2)
	));
	


*/
	
		
		
		






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////


render_group_sub(__('Creative design'));

render_creative_design();
/*
render_value('monitormodel', __('Monitor model'), '%s ' );	

render_value('monitor', __('Monitor diagonal'), '%s' . '"');	

render_yes_no("widemonitor", __('Wide monitor'));






render_group_sub(__('Accessories'));

render_yes_no("keyboard", __('Keyboard'));

render_yes_no("mouse", __('Mouse'));

render_yes_no("web_cam", __('Web camera'));

render_yes_no("speaker", __('Speakers'));

render_yes_no("headphone", __('Headphones'));



render_group_sub(__('Extra devices'));

render_check('printerscanner', __('Printer / Scanner'),  array( 
	array('printer', __('printer')),
	array('scanner', __('scanner')),
	array('copier', __('copier'))
	) );

render_yes_no("ups", __('UPS'));

*/

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
