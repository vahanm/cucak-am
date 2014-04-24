<?php

filter_group_sub('general', __('General'));
/*
filter_slider_by_list2('floorquantity', __('Floor quantity'), 1, 4, __('from %v1 to %2'), __('%s storeys'), array(
	1 => __('%s storey')
	), __('%s storey'), __('%s storeys'));
*/
filter_location(array(
	'id'			=>	'item_location'
	, 'title' 		=>	__('House location')
	, 'priority'	=> PRIMARY_FILTER
	));


filter_slider_by_list(array(
	id			=> 	'floorquantity'
	, title		=> 	__('Floor quantity')
	, min		=> 	1
	, max		=> 	4
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s storeys')
	, listItems	=>  array(	1 =>  __('%s storey'))
	, begin		=> __('%s storey')
	, end		=> __('%s storey')
	, priority	=> PRIMARY_FILTER			
	));

filter_slider_by_list(array(
	id		=> 'roomquantityhouse'
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
/*
filter_slider_by_list2('roomquantityhouse', __('Room quantity'), 1, 15, __('from %v1 to %2'),  __('%s rooms'), array(
	1 =>  __('%s room'),
	15 =>  __('%s rooms or more')
	),  __('%s room'),  __('%s or more')
		);
*/
filter_slider_by_list2('bathroom', __('Bathroom quantity'),  0, 5, __('from %v1 to %2'),  __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 =>  __('%s bathroom'), 
	), __('no bathroom'),  __('%s bathrooms'));


filter_slider_by_list2('kitchen', __('Kitchen quantity'), 0, 4, __('from %v1 to %2'), __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 =>  __('%s kitchen'), 
	), __('no kitchen'),  __('%s kitchens'));


filter_slider_by_list2('balcony', __('Balcony quantity'), 0, 5, __('from %v1 to %2'), __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony'), 
	), __('no balcony'),  __('%s balconies'));

//filter_yes_no("sportroom", __('Sport/Gameroom'), true);

//filter_yes_no("storeroom", __('Storeroom'), true);

//filter_yes_no("cellar", __('Cellar'), true);



filter_select(array(
    'id'			=> 'wall'
    , 'title'		=> __('Wall')
    , 'values'	=>  array( 
				    array('stone', __('stone')),
				    array('concrete', __('concrete')),
				    array('other', __('other'))
				    )
    , 'byKeys' => true
    , 'priority' => PRIMARY_FILTER
    , 'fromDB' => true
));


/*
filter_check('wall', __('Wall'),  array( 
	array('stone', __('stone')),
	array('concrete', __('concrete')),
	array('other', __('other'))
	) );
*/
filter_select(array(
id			=>	'ceiling'
, title		=>	__('Ceiling')
, values	=>	array( 
	array('concrete', __('concrete')),
	array('panel', __('panel')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));

//filter_yes_no("summercottage", __('Summer cottage'));



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

//filter_slider('total_area', __('Total area'), 5, 6, 100, __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

filter_slider('residential_area', __('Residential area'), 5, 5, 96, __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

filter_slider('heightofroom', __('Ceiling height'), 0.1, 25, 60, __('%s m'), __('%s m'), __('%s m'));

filter_slider(array(
	id			=>	'land_area'
	, title		=>	__('Land area')
	, rate		=>	20
	, min		=>	0
	, max		=>	200
	, text		=>	__('%s m') . '²'
	, begin		=>	__('no land')
	, end		=>	__('%s m') . '²'
	, priority	=>	PRIMARY_FILTER
	));


filter_slider_by_list2(array(
	id			=> 	'garage'
	, title		=> 	__('Garage')
	, min		=> 	0
	, max		=> 	5
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s cars')
	, listItems	=> 	array(0 => __('no garage'), 1 => __('%s car'))
	, begin		=> 	__('no garage')
	, end		=> 	__('%s cars')
	, priority	=>	PRIMARY_FILTER
	));

/*
filter_slider_by_list2('garage', __('Garage'), 0, 5, __('from %v1 to %2'), __('%s cars'), array(
	0 => __('no garage'), 
	1 => __('%s car'), 
	5 => __('%s cars or more')
	), __('no garage'), __('%s or more'));
*/

filter_select(array(
  'id'			=>		'parking'
, 'title'		=>		__('Parking')
, 'values'		=>		 array(
	array('none', __('none')), 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));










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
/*
filter_select('renovation', __('Renovation state'), array( 
	array(1, __('zero state')), 
	array(2, __('bad')), 
	array(3, __('average')), 
	array(4, __('good')),
	array(5, __('excellent')) 
	),5 );

*/
//filter_creative_design();


filter_select(array(
  'id'			=>	'windows'
, 'title'		=>	__('Windows')
, 'values'		=>	array(
	array('none', __('none')), 
	array('wood', __('wood')), 
	array('metal', __('metal-based laminate')), 
	array('aluminium', __('aluminium')) 
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));


filter_select(array(
  'id'			=>	'entrance_door'
, 'title'		=>	__('Entrance door')
, 'values'		=>	array( 
	array('wood', __('wood')), 
	array('iron', __('iron')) 
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));



filter_yes_no("parquetry", __('Parquetry'), true);

filter_yes_no("furniture", __('Furniture'), true);





filter_group_sub('communal_possibilities', __('Communal possibilities'));

filter_select('gas', __('Gas existence'), array( 
	array(1, __('none')), 
	array(2, __('exists')), 
	array(3, __('possible')) 
	) );

filter_yes_no("permanent_water", __('Permanent water'), true);

filter_yes_no("hot_water", __('Hot water'), true);

filter_yes_no("irrigation_water", __('Irrigation water'), true);



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


filter_yes_no("three_phase_current", __('Three-phase current'));




filter_group_sub('additional_information', __('Additional'));

filter_yes_no("swimming_pool", __('Swimming pool'), true);

filter_yes_no("orchard", __('Orchard'), true);

filter_yes_no("landline_phone", __('Landline phone'));

filter_yes_no("internet", __('Internet'));

filter_select(array(
      'id'	 =>		'TV'
    , 'title'	 =>		__('TV') 
    , 'values' =>			array(	
            array('none', __('none')), 
            array('sattv', __('Sat. TV')),
            array('cabtv', __('Cab. TV')), 
            array('inttv', __('Int. TV')) 
        )
    , 'byKeys' => true
    , 'priority' => SECONDARY_FILTER
    , 'fromDB' => true
));
