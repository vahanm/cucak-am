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


//filter_text("speakermodel", __('Speakers model'), __('Please enter desired model.'));


filter_select(array(
  'id'			=>'speaker_system'
, 'title'		=>__('Speakers system')
, 'values'		=>array(
	array(1 , '2.0 (stereo)'), 
	array(2 , '2.1 (stereo)'), 
	array(3 , '4.0 (quadro)'), 
	array(4 , '4.1 (quadro)'), 
	array(5 , '5.1 (surround)'), 
	array(6 , '7.1 (surround)'))
, priority => PRIMARY_FILTER
	));


filter_slider(array(
  'id'			=>'watts'
	, 'title'	=>__('RMS watts')
, 'rate'		=>1
, 'min'			=>1
, 'max'			=>70
, 'text'		=>__('%s Watts')
, 'priority'	=>	PRIMARY_FILTER
));


filter_yes_no("remotecontrol", __('Remote control'));

filter_yes_no("5input", __('5.1 input'));



filter_creative_design();




?>


