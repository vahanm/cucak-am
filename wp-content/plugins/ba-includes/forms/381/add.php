<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_donation' => false));



helper_group('general', __('General'));

helper_location('item_location', __('Garage location'), USER_LOCATION);

helper_text("address", __('Address'), __('Please enter the address.'));
		
helper_slider_by_list('garage', __('Garage size'), __('Please select'), 1, 5, __('for %s cars'), array(
	1 => __('for %s car')
	), __('for %s car'),__('for %s cars'));



?>


