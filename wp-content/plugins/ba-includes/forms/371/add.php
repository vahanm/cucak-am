<?php


function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));




helper_group('general_information', __('General'));

helper_location('item_location', __('Location of animal'), USER_LOCATION);



?>
