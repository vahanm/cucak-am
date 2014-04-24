<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));

//helper_group('cpugroup', __('CPU'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);

