<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));

render_item_status();


render_location('item_location', __('Item location'));



render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	3 => __('broken'), 
	4 => __('other')
	));


render_value('itemtype', __('Item type'), 'Error', array(
	'refrigeratorsandfreezers' => __('Refrigerator / Freezer'),
	'washersanddryers' => __('Washer / Dryer'),
	'cookers' => __('Cooker'),
	'dishwashers' => __('Dish washer'),
	'hoods' => __('Hood'),
	'conditioners' => __('Conditioner'),
	'fans' => __('Fan'),
	'heaters' => __('Heater'),
	'waterheaters' => __('Water heater'),
	'chandelier' => __('Chandelier / Wall lamp'),
	'vacuumcleaners' => __('Vacuum cleaner'),
	'kettles' => __('Kettle'),
	'coffeemakers' => __('Coffee maker'),
	'irons' => __('Iron'),
	'microwaveovens' => __('Microwave oven'),
	'ovens' => __('Oven'),
	'grill' => __('Grill'),
	'meatgrinders' => __('Meat grinder'),
	'coffeemills' => __('Coffee mill'),
	'mixers' => __('Mixer'),
	'toasters' => __('Toaster'),
	'fryers' => __('Fryer'),
	'juicers' => __('Juicer'),
	'foodprocessors' => __('Food processor'),
	'blenders' => __('Blender'),
	'choppersandgraters' => __('Chopper / Grater'),
	'sandwichandwafflemakers' => __('Sandwich and waffle maker'),
	'elknifes' => __('Electric knife'),
	'scales' => __('Scale'),
	'hairdriers' => __('Hair dryer'),
	'shavers' => __('Shaver'),
	'clippersandtrimmers' => __('Clipper / Trimmer'),
	'epilators' => __('Epilator'),
	'kitchenutensils' => __('Kitchen utensils'),
	'other'=> __('other'),  
	));




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));

render_value('workingprinciple', __('Working principle'), 'Error', array(
	1 => __('non electrical'), 
	2 => __('electricalhouse')
	));

render_value('itemmodel', __('Item model'), '%s ' );		

render_creative_design();

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
