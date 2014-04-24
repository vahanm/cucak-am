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
	
render_value(array(
		id => 'hddmodel',
		title => __('HDD model'),
		searchIcon => true
	));

	
	 
render_value('form_factor', __('Form factor'), 'Error', array(
	1 => '1.8"', 
	2 => '2.5"', 
	3 => '3.5"'

	));	 
	
	

render_value('interface', __('Interface type'), 'Error', array(
		1 =>  'ATA/IDE (133MB/s)', 
		2 =>  'SATA-1 (1.5GB/s)', 
		3 =>  'SATA-2 (3GB/s)', 
		4 =>  'SATA-3 (6GB/s)', 
		5 =>  'SAS (6GB/s)', 
		6 =>  'Fibre Channel (4GB/s)', 
		7 =>  'SCSI (Ultra 320)', 
		8 =>  __('other')
	));
		
	
////////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));

render_value('hddmemorysize', __('Memory size'), '%s ' . 'GB', array(
	21 => '40 ' . 'GB', 
	22 => '80 ' . 'GB', 
	23 => '120 ' . 'GB', 
	24 => '160 ' . 'GB', 
	25 =>  '250 ' . 'GB',
	26 =>  '320 ' . 'GB',
	27 =>  '500 ' . 'GB',
	28 =>  '640 ' . 'GB',
	29 =>  '750 ' . 'GB',
	30 =>  '1 ' . 'TB',
	31 =>  '1.5 ' . 'TB',
	32 =>  '2 ' . 'TB',
	33 =>  '3'  . 'TB',
	34 =>  '4'  . 'TB'


	));
	
render_value('rotational_speed', __('Rotational speed'), 'Error', array(	
		1 => '4800 ' . 'RPM', 
		2 => '5400 ' . 'RPM', 
		3 => '7200 ' . 'RPM', 
		4 => '10000 ' . 'RPM', 
		5 => '15000 ' . 'RPM', 

	));
	
	
render_value('cache', __('Cache size'), 'Error', array(		
		1 => '512 ' . 'KB', 
		2 => '1 ' . 'MB', 
		3 => '2 ' . 'MB', 
		4 => '4 ' . 'MB', 
		5 => '8 ' . 'MB', 
		6 => '16 ' . 'MB', 
		7 => '32 ' . 'MB', 
		8 => '64 ' . 'MB', 
		9 => '128 ' . 'MB', 
		10 => '256 ' . 'MB', 
	));

	
	
render_yes_no("forlaptop", __('For laptop'));


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
