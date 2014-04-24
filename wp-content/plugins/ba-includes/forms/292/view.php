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

render_value('hddmodel', __('HDD model'), '%s ' );		



render_value('form_factor', __('Form factor'), 'Error', array(
	1 => '1.8"', 
	2 => '2.5"', 
	3 => '3.5"'

	));	 





///////////////////////////////////////////////////////////////////////
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
	32 =>  '2 ' . 'TB'
));


render_check('extinterface', __('Interfaces'),  array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	array('sata', 'SATA'),
	array('esata', 'eSATA'),
	array('lan', 'LAN'),	
	array('wireless', __('wireless')),
	array('other', __('other'))
	) );




	




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
