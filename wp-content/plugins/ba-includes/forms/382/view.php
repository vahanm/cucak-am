<?php
///////////////////////////////////////////////////////////////////////
render_table_begin();
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
	

//render_value('producer', __('Producer'), 'Error');
	
//render_value('model', __('Model'), 'Error');	
	
render_value('usmodel', __('Model'), '%s' );		

	
render_value('usbflashmemory', __('Memory size'), '%s GB', array(
	1  =>  '512 MB',
	2  =>  '1 GB',
	3  =>  '2 GB',
	4  =>  '3 GB',
	5  =>  '4 GB',
	6  =>  '5 GB',
	7  =>  '6 GB',
	8  =>  '7 GB',
	9  =>  '8 GB',
	10  =>  '16 GB',
	11  =>  '32 GB',
	12  =>  '64 GB',
	13  =>  '128 GB',
	14  =>  '256 GB',
	));

render_value('usbinterfaces', __('Interface'), 'Error', array(
	'usb2' => 'USB2',
	'usb3' => 'USB3'
	));


render_yes_no("usbcardreader", __('Card reader'));







///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
