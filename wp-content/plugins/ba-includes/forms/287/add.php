<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('headphone', __('Headphones'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("headphonemodel", __('Headphones model'), __('Please enter the model.'));




helper_radio('speakerquantity', __('Speaker quantity'), array( 
	array(1, '1 ' .__('headspeaker')),  
	array(2, '2 ' .__('headspeakers'))
	) );


helper_yes_no("microphone", __('Microphone'), true);

helper_yes_no("volume_control", __('Volume controller'), true);

helper_yes_no("35mmjack", __('3.5 mm audio jack'), true);

helper_yes_no("vacuum", __('Vacuum-ear'), true);

helper_yes_no("wireless", __('Wireless'), true);

helper_yes_no("vibration", __('Vibration'), true);

helper_yes_no("usbinput", __('USB input'), true);

helper_yes_no("mp3player", __('Integrated mp3 player'), true);

helper_yes_no("radio", __('Integrated radio'), true);


helper_creative_design();



?>