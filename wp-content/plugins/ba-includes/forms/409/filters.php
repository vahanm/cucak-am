<?php

filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));





filter_check(array(
    'id'			=>'flcomponents'
    , 'title'		=>__('Components')
, 'values'		=>  array(  
    array('flower', __('flower')),
     array('orplant', __('ornamental plant')),
    array('colribbon', __('colored ribbon')),
    array('basket', __('basket')),
    array('candle', __('candle')),
    array('toy', __('toy')),
    array('sweets', __('sweets')),
    array('beverage', __('beverage')
				))
            , cols     =>   1
			, priority => PRIMARY_FILTER
			));



filter_select(array(
    'id'			=>'lifetime'
    , 'title'		=>__('Lifetime')
    , 'values'		=>    
    array(10, __('about one week')),  
    array(20, __('about two weeks')),  
    array(30, __('about one month')),  
    array(40, __('unlimited')
                )
            , priority => PRIMARY_FILTER
            ));
