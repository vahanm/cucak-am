<?php

filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));



filter_slider(array(
    'id'			=>'headsize'
    , 'title'	=>__('Head size')
    , 'rate'		=>0.5
    , 'min'			=>2
    , 'max'			=>30
    , 'text'		=>__('%s cm')
    , 'priority'	=>	PRIMARY_FILTER
    ));

filter_slider(array(
    'id'			=>'sizeaperture'
    , 'title'	=>__('Final size of the aperture')
    , 'rate'		=>0.5
    , 'min'			=>4
    , 'max'			=>60
    , 'text'		=>__('%s cm')
    , 'priority'	=>	PRIMARY_FILTER
    ));

filter_slider(array(
    'id'			=>'stemlength'
    , 'title'	=>__('Stem length')
    , 'rate'		=>1
    , 'min'			=>5
    , 'max'			=>150
    , 'text'		=>__('%s cm')
    , 'priority'	=>	PRIMARY_FILTER
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
