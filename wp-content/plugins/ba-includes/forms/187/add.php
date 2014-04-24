<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));







helper_group('webcam', __('Web camera'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );

helper_text("webcammodel", __('Web camera model'), __('Please enter the model.'));

helper_slider('webresolution', __('Resolution'), __('Please select'), 0.1, 1, 120, '%s MP');

helper_yes_no("autofocus", __('Auto focus'));

helper_yes_no("webbuiltinmic", __('Built-in microphone'));

helper_yes_no("ledlights", __('LED lights'));



//helper_creative_design();



?>