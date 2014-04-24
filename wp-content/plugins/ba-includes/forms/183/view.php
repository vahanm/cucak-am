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
	
render_value('opticdevice', __('Blu-Ray/DVD/CD drive model'), '%s ' );		
	
	
render_value('optic', __('Type'), 'Error', array(
		2 =>  'CD-ROM', 
		3 =>  'CD-RW',
		4 =>  'DVD-ROM',		
		5 =>  'DVD/CD-RW Combo',
		6 =>  'DVD-RW',
		7 =>  'Blu-Ray/DVD-RW Combo',
		8 =>  'Blu-Ray-RW'
		));









///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));
	

render_value('opticinterface', __('Interface'), 'Error', array(
	1 => 'IDE', 
	2 => 'SATA'
	));

render_value('discreadmaxspeed', __('Disc read max speed'), '%s' . 'X');


render_yes_no("forlaptop", __('For laptop'));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
