<?php

filter_group_sub('general', __('General'));
/*
filter_slider_by_list2('floorquantity', __('Floor quantity'), 1, 4, __('from %v1 to %2'), __('%s storeys'), array(
	1 => __('%s storey')
	), __('%s storey'), __('%s storeys'));
*/
filter_location(array(
	'id'			=>	'item_location'
	, 'title' 		=>	__('Garage location')
	, 'priority'	=> PRIMARY_FILTER
	));



filter_slider_by_list2(array(
	id			=> 	'garage'
	, title		=> 	__('Garage size')
	, min		=> 	1
	, max		=> 	5
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s cars')
	, listItems	=> 	array(1 => __('%s car'))
	, begin		=> 	__('%s car')
	, end		=> 	__('%s cars')
	, priority	=>	PRIMARY_FILTER
	));

