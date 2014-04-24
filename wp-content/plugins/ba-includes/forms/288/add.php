
<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('microphone', __('Microphone'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("micmodel", __('Microphone model'), __('Please enter the model.'));


helper_yes_no("35mmjack", __('3.5 mm audio jack'));

helper_yes_no("wireless", __('Wireless'));

helper_yes_no("usb", __('USB connector'));


helper_creative_design();



?>