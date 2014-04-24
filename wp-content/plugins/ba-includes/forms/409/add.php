<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false, 'allow_exchange' => false));

//helper_group('cpugroup', __('CPU'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_check('flcomponents', __('Components'),  array( 
    array('flower', __('flower')),
    array('candle', __('candle')),
    array('orplant', __('ornamental plant')),
    array('toy', __('toy')),
    array('colribbon', __('colored ribbon')),
    array('sweets', __('sweets')),
    array('basket', __('basket')),
    array('beverage', __('beverage'))
    ),2);																

helper_select('lifetime', __('Lifetime'), array( 			
    array(10, __('about one week')),  
    array(20, __('about two weeks')),  
    array(30, __('about one month')),  
    array(40, __('unlimited'))
		) );
