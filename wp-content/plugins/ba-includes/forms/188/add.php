<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));

helper_group('groupcase', __('Case'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("casemodel", __('Case model'), __('Please enter the model.'));

helper_slider('power', __('Power supply'), __('Please select'), 50, 0, 24, __('%s W'), __('no power supply'));

helper_check_key('frontconnectors', __('Front connectors'), array('none', __('none')), array( 
	array('mic', __('microphonecase')),
	array('headphone', __('headphones')), 	
	array('usb', 'USB'), 
	array('extsata', 'eSATA'),
	array('1394', '1394')
	) ,5);


helper_creative_design();



?>