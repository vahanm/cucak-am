<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));

helper_group('cooler', __('Cooler'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("coolermodel", __('Cooler model'), __('Please enter the model.'));


helper_check_key('cpusocket', __('CPU socket'), array('notforcpu', __('not for CPU')), array( 			
	array('775', '775'), 
	array('1155', '1155'), 
	array('1156', '1156'), 
	array('1366', '1366'), 
	array('2011', '2011'), 
	array('am2', 'AM2'), 
	array('am21', 'AM2+'), 
	array('am3', 'AM3'), 
	array('am31', 'AM3+'), 
	array('fm1', 'FM1'), 
	array('other', __('other')) 
	) , 5);

helper_yes_no("fanspeedcontrol", __('Fan speed control'));




?>


