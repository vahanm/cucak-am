<?php


filter_group_sub('general', __('General'));


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select('item_condition', __('Item condition'), array( 
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );


filter_creative_design();



?>


