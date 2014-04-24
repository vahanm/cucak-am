<?php

filter_group_sub('general', __('General'));

filter_location(array(
	'id'			=>	'item_location'
	, 'title' 		=>	__('Commercial area location')
	, 'priority'	=> PRIMARY_FILTER
	));


filter_select(array(
	id	 =>		'areatype'
	, title	 =>__('Type')
	, values =>array( 
				array(1, __('Office area')),  
				array(2, __('Trading area')), 
				array(3, __('Universal area')), 
				array(4, __('Industrial area')), 	
				array(5, __('Cafe')), 
				array(6, __('other')))
			, priority => PRIMARY_FILTER
			));


filter_slider_by_list(array(
	id			=> 	'floorquantity'
	, title		=> 	__('Floor quantity of the building')
	, min		=> 	1
	, max		=> 	30
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s storeys')
	, listItems	=>  array(	1 =>  __('%s storey'))
	, begin		=> __('%s storey')
	, end		=> __('%s storeys')
	, priority	=> PRIMARY_FILTER			
	));

filter_slider_by_list(array(
	id			=> 	'floornumber'
	, title		=> 	__('Floor number')
	, min		=> 	0
	, max		=> 	30
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s floornumber')
	, listItems	=> 	array(0 => __('basement'), 1 =>  __('%s floornumberone'))
	, begin		=> 	__('basement')
	, end		=> 	__('%s floornumber')
	, priority	=>	PRIMARY_FILTER	
	));

/*
filter_slider_by_list2('floornumber', __('Floor number'),  0, 30, __('from %v1 to %2'), __('%s floornumber'), array(
	0 => __('basement'),
	1 =>  __('%s floornumberone')
	),  __('basement'), __('%s floornumber') );
*/
filter_yes_no("elevator", __('Elevator'));


filter_slider(array(
	id			=>	'total_area'
	, title		=>	__('Total area')
	, rate		=>	5
	, min		=>	6
	, max		=>	100
	, text		=>	__('%s m') . '²'
	, begin		=>	__('%s m') . '²'
	, end		=>	__('%s m') . '²'
	, priority	=>	PRIMARY_FILTER
	));

//filter_slider('total_area', __('Total area'),  5, 6, 100,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

		
filter_slider(array(
	id			=>	'heightofroom'
	, title		=>	__('Ceiling height')
	, rate		=>	0.1
	, min		=>	25
	, max		=>	70
	, text		=>	__('%s m')
	, begin		=>	__('%s m')
	, end		=>	__('%s m')
	, priority	=>	PRIMARY_FILTER
	));


//filter_slider('heightofroom', __('Ceiling height'),  0.1, 25, 100,  __('%s m'), __('%s m'), __('%s m'));

filter_slider('land_area', __('Land area'),  20, 0, 200, __('%s m') . '²', __('no land'), __('%s m') . '²');

filter_slider_by_list2('garage', __('Garage'),  0, 15, __('from %v1 to %2'), __('%s cars'), array(
	0 => __('no garage'), 
	1 => __('%s car')
	), __('no garage'), __('%s cars'));



	filter_select(array(
	  'id'		=>		'parking'
	, 'title'	=>__('Parking')
	, 'values'	=> array( 
					array('none', __('none')),
					array('indoor', __('indoor')), 
					array('outdoor', __('outdoor')),
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));



	filter_select(array(
	  'id'		=>	'entrances'
	, 'title'	=>	__('Entrance from')
	, 'values'	=>	array( 
	array('street', __('street')),
	array('parking', __('parking')),
	array('yard', __('yard'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));






filter_group_sub('room', __('Rooms'));

filter_slider_by_list(array(
	id		=> 'roomquantity'
	, title		=> __('Room quantity')
	, min		=> 1
	, max		=> 15
	, format	=> __('from %v1 to %2')
	, text		=> __('%s rooms')
	, listItems	=> array( 1 =>  __('%s room'))
	, begin		=> __('%s room')
	, end		=> __('%s rooms')
	, priority	=> PRIMARY_FILTER
	));


filter_slider_by_list2('bathroom', __('Bathroom quantity'),  0, 5, __('from %v1 to %2'), __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 =>  __('%s bathroom')
	), __('no bathroom'),  __('%s bathrooms'));

filter_slider_by_list2('kitchen', __('Kitchen quantity'),  0, 4, __('from %v1 to %2'), __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 =>  __('%s kitchen')
	), __('no kitchen'),  __('%s kitchens'));

filter_slider_by_list2('balcony', __('Balcony quantity'),  0, 5, __('from %v1 to %2'), __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony')
	), __('no balcony'),  __('%s balconies'));

filter_yes_no(array(
	id			=>	"storehouse"
	, title		=>	__('Storehouse')
	, half		=>	true
	, priority	=>	PRIMARY_FILTER
	));

//filter_yes_no("storehouse", __('Storehouse'), true);

filter_yes_no(array(
	id			=>	"cellar"
	, title		=>	__('Cellar')
	, half		=>	true
	, priority	=>	PRIMARY_FILTER
	));

//filter_yes_no("cellar", __('Cellar'), true);

//filter_yes_no("storeroom", __('Storeroom'), true);

//filter_yes_no("sportroom", __('Sport/Gameroom'), true);










filter_group_sub('interior', __('Interior'));

filter_slider_by_list(array(
	id	    =>	'renovation'
	, title	    => 	__('Renovation state')
	, min		=>	1
	, max		=>	5
	, format	=>	__('between %1 and %2')
	, text		=>	'%s'
	, listItems	=> 	array( 
				1 => __('zero state'), 
				2 =>  __('bad'), 
				3 => __('average'), 
				4 => __('good'),
				5 => __('excellent') 
				)
			, textMore  =>  __('at least %s')
			, textUpTo  =>  __('at most %s')
			, begin		=> 	__('zero state')
			, end		=> 	__('excellent')
			, priority => PRIMARY_FILTER
			));


//filter_creative_design();


filter_select(array(
  id	 =>	'windows'
, title	 =>	__('Windows')
, values =>	array( 
	array('none', __('none')), 
	array('wood', __('wood')), 
	array('metal', __('metal-based laminate')),
	array('aluminium', __('aluminium'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));



	filter_select(array(
  id	 =>	'entrance_door'
, title	 =>	__('Entrance door')
, values =>	array( 
	array('glass', __('from glass')),
	array('wood', __('wood')),
	array('iron', __('iron'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));



filter_yes_no("furniture", __('Furniture'));





filter_group_sub('communal_possibilities', __('Communal possibilities'));

filter_select('gas', __('Gas existence'), array( 
	array(1, __('none')), 
	array(2, __('exists')), 
	array(3, __('possible')) 
	) );

filter_yes_no("permanent_water", __('Permanent water'), true);

filter_yes_no("hot_water", __('Hot water'), true);

filter_slider('container', __('Water container'),  50, 0, 60, __('%s litres'), __('no water container'),  __('%s litres'));

filter_yes_no("conditioner", __('Conditioner'));

filter_select(array(
  id	 =>		'heating_system'
, title	 =>		__('Heating system')
, values =>		array( 
	array('none', __('none')), 
	array('gasboiler', __('gas boiler')), 
	array('gasheater', __('gas heater')), 
	array('centralized', __('centralized')), 
	array('electrical', __('electrical')), 
	array('underfloor', __('underfloor')), 
	array('conditioner', __('conditioner')) 
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));

filter_yes_no("refrigerator", __('Refrigerator'), true);

filter_yes_no("three_phase_current", __('Three-phase current'), true);






filter_group_sub('additional_information', __('Additional'));

//filter_yes_no("sunny_side", __('Sunny side'), true);

filter_yes_no("landline_phone", __('Landline phone'), true);

filter_yes_no("internet", __('Internet'));

filter_select(array(
	id	 =>		'TV'
	, title	 =>		__('TV') 
	, values =>			array(	
				array('none', __('none')), 
				array('sattv', __('Sat. TV')),
				array('cabtv', __('Cab. TV')), 
				array('inttv', __('Int. TV')) 
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));









?>


