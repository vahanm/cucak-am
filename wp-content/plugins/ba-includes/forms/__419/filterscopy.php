<?php
filter_group('building_information', __('Building information'));

filter_text("address", __('Address'), __('Please enter the address.'));

filter_slider_by_list('structureyear', __('Year of the structure'), __('Please select'), 1940, date('Y'), __('%sy'), array(1940 => __('%sy or older')
	), __('%sy or older'), date('Y') . __('y'));

filter_slider_by_list('floorquantity', __('Floor quantity of the building'), __('Please select'), 1, 20, __('%s storeys'), array(
	1 =>  __('%s storey'), 
	20 =>  __('%s storeys or more')
	), __('%s storey'),   __('%s storeys or more'));

filter_slider_by_list('floornumber', __('Floor number'), __('Please select'), 1, 20, __('%s floornumber'), array(
	1 =>  __('%s floornumberone'),
	20 =>  __('%s floornumber or more')
	),  __('%s floornumberone'), __('%s floornumber or more') );

filter_radio('bulidingmodel', __('Buliding model'), array( 
	array(1, __('No typical')),  
	array(2, __('Khrushchev')),  
	array(3, __('Stalin')), 
	array(4, __('Czechian')), 
	array(5, __('Badalyan')), 
	array(6, __('Yerevan HBF')), 
	array(7, __('Moscow HBF'))
	) ,3);

filter_check('wall', __('Wall'),  array( 
	array('panel', __('panel')),
	array('monolith', __('monolith')),
	array('stone', __('stone')),
	array('other', __('other'))
	) );

filter_check('ceiling', __('Ceiling'),  array( 
	array('concrete', __('concrete')),
	array('panel', __('panel')),
	array('other', __('other'))
	) );




filter_yes_no("rubbish", __('Rubbish chute'));

filter_yes_no("elevator", __('Elevator'));









filter_group('flat_information', __('Flat'));

filter_group_sub('general', __('Basic information'));

filter_slider('total_area', __('Total area'), __('Please select'), 5, 6, 100,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

filter_slider('residential_area', __('Residential area'), __('Please select'), 5, 5, 96,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');

filter_slider('heightofroom', __('Ceiling height'), __('Please select'), 0.1, 25, 60,  __('%s m'), __('%s m'), __('%s m'));

filter_slider('land_area', __('Land area'), __('Please select'), 10, 0, 200, __('%s m') . '²', __('no land'), __('%s m') . '²');

filter_slider_by_list('garage', __('Garage'), __('Please select'), 0, 5, __('for %s cars'), array(
	0 => __('no garage'), 
	1 => __('for %s car'), 
	5 => __('for %s cars or more')
	), __('no garage'), __('for %s cars or more'));


filter_check_key('parking', __('Parking'), array('none', __('none')), array( 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
	) );









filter_group_sub('room', __('Rooms'));

filter_slider_by_list('roomquantity', __('Room quantity'), __('Please select'), 1, 15,  __('%s rooms'), array(
	1 =>  __('%s room'), 
	15 =>  __('%s rooms or more')
	),  __('%s room'),  __('%s rooms or more'));

filter_slider_by_list('bedroom', __('Bedroom quantity'), __('Please select'), 0, 10,  __('%s bedrooms'), array(
	0 => __('no bedroom'), 
	1 => __('%s bedroom'), 
	10 =>  __('%s bedrooms or more')
	), __('no bedroom'),  __('%s bedrooms or more'));

filter_slider_by_list('bathroom', __('Bathroom quantity'), __('Please select'), 0, 5, __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 =>  __('%s bathroom'), 
	5 =>  __('%s bathrooms or more')
	), __('no bathroom'),  __('%s bathrooms or more'));

filter_slider_by_list('kitchen', __('Kitchen quantity'), __('Please select'), 0, 4, __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 =>  __('%s kitchen'), 
	4 =>  __('%s kitchens or more')
	), __('no kitchen'),  __('%s kitchens or more'));

filter_slider_by_list('balcony', __('Balcony quantity'), __('Please select'), 0, 5, __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony'), 
	5 =>  __('%s balconies or more')
	), __('no balcony'),  __('%s balconies or more'));

filter_yes_no("sportroom", __('Sport/Gameroom'));

filter_yes_no("storeroom", __('Storeroom'));

filter_yes_no("cellar", __('Cellar'));









filter_group_sub('interior', __('Interior'));

filter_radio('renovation', __('Renovation state'), array( 
	array(1, __('zero state')), 
	array(2, __('bad')), 
	array(3, __('average')), 
	array(4, __('good')),
	array(5, __('excellent')) 
	),5 );
			
filter_check_key('windows', __('Windows'), array('none', __('none')), array( 
				array('wood', __('wood')), 
				array('metal', __('metal-based laminate')),
				array('aluminium', __('aluminium'))
			) );


filter_check('entrance_door', __('Entrance door'),  array( 
				array('wood', __('wood')),
				array('iron', __('iron'))
			) );



filter_yes_no("parquetry", __('Parquetry'));

filter_yes_no("furniture", __('Furniture'));





filter_group_sub('communal_possibilities', __('Communal possibilities'));

filter_radio('gas', __('Gas existence'), array( 
				array(1, __('none')), 
				array(2, __('exists')), 
				array(3, __('possible')) 
			) );

filter_yes_no("permanent_water", __('Permanent water'));

filter_yes_no("hot_water", __('Hot water'));

//filter_yes_no("irrigation_water", __('Irrigation water'));

filter_slider('container', __('Water container'), __('Please select'), 50, 0, 60, __('%s litres'), __('no water container'),  __('%s litres'));


filter_check_key('heating_system', __('Heating system'), array('none', __('none')), array( 
	array('gasboiler', __('gas boiler')), 
	array('gasheater', __('gas heater')), 
	array('centralized', __('centralized')), 
	array('electrical', __('electrical')), 
	array('underfloor', __('underfloor')), 
	array('conditioner', __('conditioner')) 
	),3 );

filter_yes_no("three_phase_current", __('Three-phase current'));






filter_group_sub('additional_information', __('Additional'));

filter_yes_no("sunny_side", __('Sunny side'), true);

filter_yes_no("swimming_pool", __('Swimming pool'), true);

filter_yes_no("orchard", __('Orchard'), true);

filter_yes_no("digital_counter", __('Digital counter of current'), true);

filter_yes_no("landline_phone", __('Landline phone'), true);

filter_yes_no("internet", __('Internet'), true);

filter_check_key('TV', __('TV'), 
	array('none', __('none')), 	array(
			array('sattv', __('Sat. TV')),
			array('cabtv', __('Cab. TV')), 
			array('inttv', __('Int. TV')) 
			) );

?>


