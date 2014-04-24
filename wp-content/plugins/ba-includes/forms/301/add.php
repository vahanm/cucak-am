<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_donation' => false));



helper_group('general', __('General'));

helper_location('item_location', __('Land area location'), USER_LOCATION);

helper_text("address", __('Address'), __('Please enter the address.'));

helper_number("land_area", __('Size of the land area'), __('Please enter the size of the land area.'),  array( 
	array(1, __('square metres')),  
	array(2, __('hectare')) 
	) );

helper_yes_no("lodge", __('Lodge'));

helper_check_key('greenhouse', __('Greenhouse'), array('none', __('none')), array( 
	array('plastic', __('plastic')), 
	array('glass', __('from glass')),
	array('other', __('other'))
	) );

helper_yes_no("orchard", __('Orchard'));

//helper_yes_no("partialsale", __('Partial sale'));


helper_yes_no("fenced", __('Fenced'));

//helper_yes_no("permanent_water", __('Permanent water'));

helper_yes_no("irrigation_water", __('Irrigation water'));

helper_slider('container', __('Water container'), __('Please select'), 0.1, 0, 100, __('%s ton'), __('no water container'), __('%s ton'));

helper_yes_no("drinkingwater", __('Drinking water'));
		
helper_radio('gas', __('Gas existence'), array( 
	array(1, __('none')), 
	array(2, __('exists')), 
	array(3, __('possible')) 
	) );


helper_yes_no("electricity", __('Electricity'));

?>