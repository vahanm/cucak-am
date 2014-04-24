<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_rent' => false));



helper_group('ouseholdkitchen', __('Household product'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );


helper_select('itemtype', __('Item type'), array( 
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
	) );

helper_text("itemmodel", __('Item model'), __('Please enter the model.'));


helper_radio('workingprinciple', __('Working principle'), array( 
	array(1, __('non electrical')),  
	array(2, __('electricalhouse'))
	) );


helper_creative_design();





?>


