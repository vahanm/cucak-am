
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



//filter_text("micmodel", __('Microphone model'), __('Please enter desired model.'));


filter_yes_no(array(
  'id'			=>"35mmjack"
, 'title'		=>__('3.5 mm audio jack')
			, priority => PRIMARY_FILTER
			));


filter_yes_no(array(
  'id'			=>"wireless"
, 'title'		=>__('Wireless')
	, priority => PRIMARY_FILTER
	));


filter_yes_no("usb", __('USB connector'));



filter_creative_design();


?>