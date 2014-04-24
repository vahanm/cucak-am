<?php


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));



//filter_text("headphonemodel", __('Headphones model'), __('Please enter desired model.'));




filter_select(array(
'id'			=>'speakerquantity'
, 'title'		=>__('Speaker quantity')
, 'values'		=>array( 
	array(1, '1 ' .__('headspeaker')),  
	array(2, '2 ' .__('headspeakers'))
				)
			, priority => PRIMARY_FILTER
			));




filter_yes_no(array(
  'id'			=>"microphone"
, 'title'		=>__('Microphone')
			, priority => PRIMARY_FILTER
			));



filter_yes_no("volume_control", __('Volume controller'));

filter_yes_no("35mmjack", __('3.5 mm audio jack'));

filter_yes_no("vacuum", __('Vacuum-ear'));

filter_yes_no(array(
  'id'			=>"wireless"
, 'title'		=>__('Wireless')
			, priority => PRIMARY_FILTER
			));


filter_yes_no("vibration", __('Vibration'));

filter_yes_no("usbinput", __('USB input'));

filter_yes_no("mp3player", __('Integrated mp3 player'));

filter_yes_no("radio", __('Integrated radio'));



filter_creative_design();



?>