<?php


function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));

helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
    array(1, __('new')),  
    array(2, __('used')),  
    array(3, __('broken')) 
    ) );

/*

helper_group('general_information', __('General'));

helper_location('item_location', __('Location of animal'), USER_LOCATION);

*/

