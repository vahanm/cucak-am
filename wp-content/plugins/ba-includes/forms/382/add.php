<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false, 'allow_exchange' => false));








helper_group('general_information', __('General'));


//helper_select_mobile();

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	
	) );

helper_text("usmodel", __('Model'), __('Please enter the model.'));


helper_slider_by_list('usbflashmemory', __('Memory size'), __('Please select'), 1, 14, '%s '. 'GB', array(
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
	),'512 MB', '256 GB');

helper_radio('usbinterfaces', __('Interface'), array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	) );


helper_yes_no("usbcardreader", __('Card reader'));

