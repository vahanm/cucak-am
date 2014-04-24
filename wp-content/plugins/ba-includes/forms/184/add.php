<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('speaker', __('Speakers'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_text("speakermodel", __('Speakers model'), __('Please enter the model.'));


helper_slider_by_list('speaker_system', __('Speakers system'), __('Please select'), 1, 6, '%s ', array(
	1 => '2.0 (stereo)', 
	2 => '2.1 (stereo)', 
	3 => '4.0 (quadro)', 
	4 => '4.1 (quadro)', 
	5 => '5.1 (surround)', 
	6 => '7.1 (surround)'
	),'2.0 (stereo)', '7.1 (surround)');

helper_slider('watts', __('RMS watts'), __('Please select'), 1, 1, 70,__('%s Watts'));

helper_yes_no("remotecontrol", __('Remote control'));

helper_yes_no("5input", __('5.1 input'));


helper_creative_design();




?>


