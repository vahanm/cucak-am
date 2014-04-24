<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('keyboard', __('Keyboard'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("keyboardmodel", __('Keyboard model'), __('Please enter the model.'));

helper_check('interface', __('Interface'), array( 			
	array('usb', 'USB'), 
	array('ps', 'PS/2'), 
	array('wireless', __('wireless'))
	) );

helper_yes_no("multimedia", __('Multimedia'));

helper_yes_no("backlights", __('Backlights'));


helper_creative_design();




?>


