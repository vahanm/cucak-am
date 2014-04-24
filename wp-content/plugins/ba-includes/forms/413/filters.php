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
    array(2, __('used'))
    )
, priority => PRIMARY_FILTER
));