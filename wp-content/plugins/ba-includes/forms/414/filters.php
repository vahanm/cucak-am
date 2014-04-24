<?php
//filter_group_sub('building_information', __('Building information'));

//filter_text("address", __('Address'), __('Please enter the address.'));



//filter_group_sub('room', __('Rooms'));


filter_group_sub('general', __('General'));

/*filter_slider_by_list2(array(
      id		=> 'structureyear'
    , title		=> __('Year of the structure')
    , min		=> 1940
    , max		=> date('Y')
    , format	=> __('from %v1 to %2')
    , text		=> __('%sy')
    , listItems	=> array( 1940 => __('%sy or older') )
    , begin		=> __('%sy or older')
    , end		=> date('Y') . __('y')
    , priority	=> SECONDARY_FILTER
));
*/

filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Flat location')
, 'priority'	=> PRIMARY_FILTER
));




filter_slider_by_list(array(
	  'id'			=> 'roomquantity'
	, 'title'		=> __('Room quantity')
	, 'min'			=> 1
	, 'max'			=> 15
	, 'format'		=> __('from %v1 to %2')
	, 'text'		=> __('%s rooms')
	, 'listItems'	=> array( 1 =>  __('%s room'))
	, 'begin'		=> __('%s room')
	, 'end'			=> __('%s rooms')
	, 'priority'	=> PRIMARY_FILTER
));

/*
filter_slider_by_list2('roomquantity', __('Room quantity'), 1, 15,  __('%s rooms'), array(
	1 =>  __('%s room'), 
	15 =>  __('%s rooms or more')
	),  __('%s room'),  __('%s or more'));
*/

/*
filter_slider_by_list2('bedroom', __('Bedroom quantity'), 0, 10,  __('%s bedrooms'), array(
	0 => __('no bedroom'), 
	1 => __('%s bedroom'), 
	10 =>  __('%s bedrooms or more')
	), __('no bedroom'),  __('%s bedrooms or more'));
*/
filter_slider_by_list2('bathroom', __('Bathroom quantity'),  0, 5, __('from %v1 to %2'),  __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 =>  __('%s bathroom'), 
	), __('no bathroom'),  __('%s bathrooms'));
/*
filter_slider_by_list2('kitchen', __('Kitchen quantity'), 0, 4, __('from %v1 to %2'), __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 =>  __('%s kitchen'), 
	4 =>  __('%s kitchens or more')
	), __('no kitchen'),  __('%s or more'));
*/
filter_slider_by_list2('balcony', __('Balcony quantity'), 0, 5, __('from %v1 to %2'), __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony'), 
	), __('no balcony'),  __('%s balconies'));

//filter_yes_no("sportroom", __('Sport/Gameroom'));

//filter_yes_no("storeroom", __('Storeroom'),true);

//filter_yes_no("cellar", __('Cellar'),true);
/*filter_slider_by_list2(array(
	id		=> 'roomquantity'
	, title		=> __('Room quantity')
	, min		=> 1
	, max		=> 15
	, format	=> __('from %v1 to %2')
	, text		=>	__('%s rooms')
	, listItems	=> array( 1 =>  __('%s room'), 15 =>  __('%s rooms or more') )
	, begin		=> __('%s room')
	, end		=> __('%s or more')
	, priority	=> PRIMARY_FILTER
	));
*/

filter_slider_by_list(array(
	  'id'			=> 	'floorquantity'
	, 'title'		=> 	__('Floor quantity of the building')
	, 'min'			=> 	1
	, 'max'			=> 	30
	, 'format'		=> 	__('from %v1 to %2')
	, 'text'		=>	__('%s storeys')
	, 'listItems'	=>  array(	1 =>  __('%s storey'))
	, 'begin'		=> __('%s storey')
	, 'end'			=> __('%s storeys')
	, 'priority'	=> PRIMARY_FILTER			
));

//filter_slider_by_list2('floorquantity2', __('Floor quantity of the building'), 1, 20, __('from %1s to %2s'), array(
//	1 =>  __('up to %s floors'), 
//	20 =>  __('%s floors or more')
//	), __('%s storey'),   __('%s or more'));

filter_slider_by_list(array(
	  'id'			=> 	'floornumber'
	, 'title'		=> 	__('Floor number')
	, 'min'			=> 	1
	, 'max'			=> 	30
	, 'format'		=> 	__('from %v1 to %2')
	, 'text'		=>	__('%s floornumber')
	, 'listItems'	=> 	array(1 =>  __('%s floornumberone'))
	, 'begin'		=> 	__('%s floornumberone')
	, 'end'			=> 	__('%s floornumber')
	, 'priority'	=>	PRIMARY_FILTER	
));

/*
filter_select('bulidingmodel', __('Buliding model'), array( 
	array(1, __('No typical')),  
	array(2, __('Khrushchev')),  
	array(3, __('Stalin')), 
	array(4, __('Czechian')), 
	array(5, __('Badalyan')), 
	array(6, __('Yerevan HBF')), 
	array(7, __('Moscow HBF'))
	), 2);
*/
filter_select(array(
	  'id'		=>		'bulidingmodel'
	, 'title'	=> __('Buliding model')
	, 'values'	=>	array( 
				array(1, __('No typical')),  
				array(2, __('Khrushchev')),  
				array(3, __('Stalin')), 
				array(4, __('Czechian')), 
				array(5, __('Badalyan')), 
				array(6, __('Yerevan HBF')), 
				array(7, __('Moscow HBF'))
				)
	, 'priority'=> PRIMARY_FILTER
));


filter_select(array(
	  'id'		=> 'wall'
	, 'title'	=> __('Wall')
	, 'values'	=>  array( 
					array('panel', __('panel')),
					array('monolith', __('monolith')),
					array('stone', __('stone')),
					array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


filter_select(array(
	  'id'			=>	'ceiling'
	, 'title'		=>	__('Ceiling')
	, 'values'		=>	array( 
						array('concrete', __('concrete')),
						array('panel', __('panel')),
						array('other', __('other'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));




//filter_yes_no("rubbish", __('Rubbish chute'),true);

filter_yes_no(array(
	  'id'			=>	"rubbish"
	, 'title'		=>	__('Rubbish chute')
	, 'half'		=>	true
	, 'priority'	=>	SECONDARY_FILTER
	));


//filter_yes_no("elevator", __('Elevator'),true);

filter_yes_no(array(
	  'id'			=>	"elevator"
	, 'title'		=>	__('Elevator')
	, 'half'		=>	true
	, 'priority'	=>	SECONDARY_FILTER
	));







//filter_group_sub('flat_information', __('Flat'));

//filter_group_sub('general', __('Basic information'));

filter_slider(array(
	  'id'			=>	'total_area'
	, 'title'		=>	__('Total area')
	, 'rate'		=>	5
	, 'min'			=>	6
	, 'max'			=>	100
	, 'text'		=>	__('%s m') . '²'
	, 'begin'		=>	__('%s m') . '²'
	, 'end'			=>	__('%s m') . '²'
	, 'priority'	=>	PRIMARY_FILTER
));


//filter_slider('residential_area', __('Residential area'), 5, 5, 96,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

filter_slider(array(
	  'id'			=>	'heightofroom'
	, 'title'		=>	__('Ceiling height')
	, 'rate'		=>	0.1
	, 'min'			=>	25
	, 'max'			=>	40
	, 'text'		=>	__('%s m')
	, 'begin'		=>	__('%s m')
	, 'end'			=>	__('%s m')
	, 'priority'	=>	PRIMARY_FILTER
));


//filter_slider('land_area', __('Land area'), 10, 0, 200, __('%s m') . '²', __('no land'), __('%s m') . '²');

filter_slider_by_list(array(
	  'id'			=> 	'garage'
	, 'title'		=> 	__('Garage')
	, 'min'			=> 	0
	, 'max'			=> 	5
	, 'format'		=> 	__('from %v1 to %2')
	, 'text'		=>	__('%s cars')
	, 'listItems'	=> 	array(0 => __('no garage'), 1 => __('%s car'))
	, 'begin'		=> 	__('no garage')
	, 'end'			=> 	__('%s cars')
	, 'priority'	=>	PRIMARY_FILTER
));


filter_check_key('parking', __('Parking'), array('none', __('none')), array( 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
	) );















filter_group_sub('interior', __('Interior'));
/*
filter_slider_by_list(array(
	id			=> 	'floornumber'
	, title		=> 	__('Floor number')
	, min		=> 	1
	, max		=> 	20
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s floornumber')
	, listItems	=> 	array(1 =>  __('%s floornumberone'), 20 =>  __('%s or more'))
	, begin		=> 	__('%s floornumberone')
	, end		=> 	__('%s or more')
	, priority	=>	PRIMARY_FILTER	
	));
*/
	
filter_slider_by_list(array(
	  'id'			=>	'renovation'
	, 'title'	    => 	__('Renovation state')
	, 'min'			=>	1
	, 'max'			=>	5
	, 'format'		=>	__('between %1 and %2')
	, 'text'		=>	'%s'
	, 'listItems'	=> 	array( 
							1 => __('zero state'), 
							2 =>  __('bad'), 
							3 => __('average'), 
							4 => __('good'),
							5 => __('excellent') 
							)
	, 'textMore'	=>  __('at least %s')
	, 'textUpTo'	=>  __('at most %s')
	, 'begin'		=> 	__('zero state')
	, 'end'			=> 	__('excellent')
	, 'priority'	=> PRIMARY_FILTER
));


//filter_creative_design();

			

filter_select(array(
	id	 =>			'windows'
, title	 =>			__('Windows')
, values =>			array( 
	array('none', __('none')), 	
	array('wood', __('wood')), 
	array('metal', __('metal-based laminate')),
	array('aluminium', __('aluminium'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));


filter_select(array(
	id	 =>		'entrance_door'
, title	 =>		__('Entrance door')
, values =>		array( 
	array('iron', __('iron')),
	array('wood', __('wood'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));



filter_yes_no("parquetry", __('Parquetry'),true);

filter_yes_no("furniture", __('Furniture'),true);





filter_group_sub('communal_possibilities', __('Communal possibilities'));

filter_select('gas', __('Gas existence'), array( 
	array(1, __('none')), 
	array(2, __('exists')), 
	array(3, __('possible')) 
	));

//filter_yes_no("permanent_water", __('Permanent water'),true);

filter_yes_no("hot_water", __('Hot water'));

//filter_yes_no("irrigation_water", __('Irrigation water'));

//filter_slider('container', __('Water container'), 50, 0, 60, __('%s litres'), __('no water container'),  __('%s litres'));


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


//filter_yes_no("three_phase_current", __('Three-phase current'));






filter_group_sub('additional_information', __('Additional'));

//filter_yes_no("sunny_side", __('Sunny side'), true);

/*


filter_yes_no("swimming_pool", __('Swimming pool'), true);

//filter_yes_no("orchard", __('Orchard'), true);

//filter_yes_no("digital_counter", __('Digital counter of current'), true);
*/
filter_yes_no("landline_phone", __('Landline phone'));

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


