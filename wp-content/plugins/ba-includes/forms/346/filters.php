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


filter_select(array(
  'id'			=>'itemtype'
, 'title'		=>__('Item type')
, 'values'		=>array( 
array('refrigeratorsandfreezers', __('Refrigerator / Freezer')),
array('washersanddryers', __('Washer / Dryer')),
array('cookers', __('Cooker')),
array('dishwashers', __('Dish washer')),
array('hoods', __('Hood')),
array('conditioners', __('Conditioner')),
array('fans', __('Fan')),
array('heaters', __('Heater')),
array('waterheaters', __('Water heater')),
array('chandelier', __('Chandelier / Wall lamp')),
array('vacuumcleaners', __('Vacuum cleaner')),
array('kettles', __('Kettle')),
	array('coffeemakers', __('Coffee maker')),
	array('irons', __('Iron')),
	array('microwaveovens', __('Microwave oven')),
	array('ovens', __('Oven')),
	array('grill', __('Grill')),
	array('meatgrinders', __('Meat grinder')),
	array('coffeemills', __('Coffee mill')),
	array('mixers', __('Mixer')),
	array('toasters', __('Toaster')),
	array('fryers', __('Fryer')),
	array('juicers', __('Juicer')),
	array('foodprocessors', __('Food processor')),
	array('blenders', __('Blender')),
	array('choppersandgraters', __('Chopper / Grater')),
	array('sandwichandwafflemakers', __('Sandwich and waffle maker')),
	array('elknifes', __('Electric knife')),
	array('scales', __('Scale')),
	array('hairdriers', __('Hair dryer')),
	array('shavers', __('Shaver')),
	array('clippersandtrimmers', __('Clipper / Trimmer')),
	array('epilators', __('Epilator')),
	array('kitchenutensils', __('Kitchen utensils')),
	array('other', __('other')),  
				)
			, priority => PRIMARY_FILTER
			));


//filter_text("itemmodel", __('Item model'), __('Please enter desired model.'));

filter_select(array(
  'id'			=>'workingprinciple'
, 'title'		=>__('Working principle')
, 'values'		=>array( 
	array(1, __('non electrical')),  
	array(2, __('electricalhouse'))
		)
, priority => PRIMARY_FILTER
	));


filter_yes_no("creativedesign", __('Creative design'));




?>


