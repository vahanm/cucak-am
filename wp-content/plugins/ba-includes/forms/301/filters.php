<?php


//filter_group_sub('general', __('General'));


filter_location(array(
	  'id'			=>	'item_location'
	, 'title' 		=>	__('Land area location')
	, 'priority'	=> PRIMARY_FILTER
));

/*
filter_number("land_area", __('Size of the land area'), __('Please enter the size of the land area.'),  array( 
	array(1, __('square metres')),
	array(2, __('hectare')) 
));
*/

filter_number(array(
	  'id'			=>	'land_area'
	, 'title'		=>	__('Size of the land area')
	, 'units'		=> array(
				1 => array(
					'name'		=> __('square metres')
					, 'rate'		=>	5
					, 'min'			=>	0
					, 'max'			=>	10000
					, 'text'		=>	__('%s m') . '²'
					, 'begin'		=>	__('%s m') . '²'
					, 'end'			=>	__('%s m') . '²'
					),
				
				2 => array(
					'name'		=> __('hectare')
					, 'rate'		=>	5
					, 'min'			=>	0
					, 'max'			=>	10000
					, 'text'		=>	__('%s m') . '²'
					, 'begin'		=>	__('%s m') . '²'
					, 'end'			=>	__('%s m') . '²'
					)
	)
	, 'priority'	=>	PRIMARY_FILTER
));

filter_select(array(
	  id	 =>	'greenhouse'
	, title	 =>	__('Greenhouse')
	, values =>	array( 
		array('none', __('none')), 
		array('plastic', __('plastic')), 
		array('glass', __('from glass')),
		array('other', __('other'))
	)
	, byKeys => true
	, priority => PRIMARY_FILTER
));


filter_yes_no(array(
	  id		=> "lodge"
	, title		=> __('Lodge')
	, priority	=> PRIMARY_FILTER
));






filter_yes_no(array(
	  id		=>	"fenced"
	, title		=>	__('Fenced')
	, priority	=>	PRIMARY_FILTER
));


filter_yes_no(array(
	  id		=>	"orchard"
	, title		=>	__('Orchard')
	, priority	=>	PRIMARY_FILTER
));

filter_yes_no(array(
	  id		=>	"irrigation_water"
	, title		=>	__('Irrigation water')
	, priority	=>	PRIMARY_FILTER
));


//filter_yes_no("partialsale", __('Partial sale'));

filter_slider('container', __('Water container'),  0.1, 0, 100, __('%s ton'), __('no water container'), __('%s ton'));

filter_yes_no("drinkingwater", __('Drinking water'));

filter_select('gas', __('Gas existence'), array( 
	array(1, __('none')), 
	array(2, __('exists')), 
	array(3, __('possible')) 
));

filter_yes_no("electricity", __('Electricity'));

?>


