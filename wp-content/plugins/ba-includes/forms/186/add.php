<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('mouse', __('Mouse'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("mousemodel", __('Mouse model'), __('Please enter the model.'));

helper_check('interface', __('Interface'), array( 			
	array('usb', 'USB'), 
	array('ps', 'PS/2'), 
	array('wireless', __('wireless'))
	) );



helper_slider('msens', __('Sensitivity'), __('Please select'), 100, 1, 40, '%s dpi');


helper_yes_no("addkeys", __('Extra buttons'));


helper_yes_no("4d", '4D scrolling');


helper_creative_design();




?>
