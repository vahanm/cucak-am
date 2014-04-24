<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Building information'));

render_location('item_location', __('Flat location'));

render_value('address', __('Address'), '%s ' );	

render_value('structureyear', __('Year of the structure'), __('%sy'), array(1940 => __('%sy or older')));

render_value('floorquantity', __('Floor quantity of the building'), __('%s storeys'), array(
	1 => __('%s storey')
	));

render_value('floornumber', __('Floor number'), __('%s floornumber'), array(
	1 =>  __('%s floornumberone')
	));


render_value('bulidingmodel', __('Buliding model'), 'Error', array(
	1 => __('No typical'), 
	2 => __('Khrushchev'), 
	3 => __('Stalin'), 
	4 => __('Czechian'), 
	5 => __('Badalyan'), 
	6 => __('Yerevan HBF'), 
	7 => __('Moscow HBF')
	));




render_check('wall', __('Wall'),  array( 
	array('panel', __('panel')),
	array('monolith', __('monolith')),
	array('stone', __('stone')),
	array('other', __('other'))
	) );

render_check('ceiling', __('Ceiling'),  array( 
	array('concrete', __('concrete')),
	array('panel', __('panel')),
	array('other', __('other'))
	) );



render_yes_no("rubbish", __('Rubbish chute'));

render_yes_no("elevator", __('Elevator'));

render_group_sub(__('Basic information'));

//render_value('total_area', __('Total area'), __('%s m') . '²');
render_number('total_area', __('Total area'), array(
	1 => __('square metres'), 
	));	 


//render_value('residential_area', __('Residential area'), __('%s m') . '²');
render_number('residential_area', __('Residential area'), array(
	1 => __('square metres'), 
	));	 


render_value('heightofroom', __('Ceiling height'), __('%s m'));

//render_value('land_area', __('Land area'), __('%s m') . '²', array(0 => 'image:no'));
render_number('land_area', __('Land area'), array(
	1 => __('square metres'), 
	2 => __('hectare')
	));	 

render_value('garage', __('Garage'), __('for %s cars'), array(
	0 => 'image:no', 
	1 => __('for %s car')
	));


render_check_key('parking', __('Parking'), array('none', 'image:no'), array( 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
	) );

render_group_sub(__('Communal possibilities'));

render_value('gas', __('Gas existence'), 'Error', array(
	1 => 'image:no', 
	2 => 'image:yes', 
	3 => __('possible')
	));

render_yes_no("permanent_water", __('Permanent water'));

render_yes_no("hot_water", __('Hot water'));

//render_yes_no("irrigation_water", __('Irrigation water'));

render_value('container', __('Water container'), __('%s litres'), array( 0 => 'image:no'));



render_check_key('heating_system', __('Heating system'), array('none', 'image:no'), array( 
	array('gasboiler', __('gas boiler')), 
	array('gasheater', __('gas heater')), 
	array('centralized', __('centralized')), 
	array('electrical', __('electrical')), 
	array('underfloor', __('underfloor')), 
	array('conditioner', __('conditioner')) 
	) );


//render_yes_no("three_phase_current", __('Three-phase current'));


///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Rooms'));

render_value('roomquantity', __('Room quantity'), __('%s rooms'), array(
	1 => __('%s room')
	));

render_value('bedroom', __('Bedroom quantity'), __('%s bedrooms'), array(
	0 => 'image:no', 
	1 => __('%s bedroom')
	));

render_value('bathroom', __('Bathroom quantity'), __('%s bathrooms'), array(
	0 => 'image:no', 
	1 => __('%s bathroom')
	));

render_value('kitchen', __('Kitchen quantity'), __('%s kitchens'), array(
	0 => 'image:no', 
	1 => __('%s kitchen')
	));

render_value('balcony', __('Balcony quantity'), __('%s balconies'), array(
	0 => 'image:no', 
	1 => __('%s balcony')
	));

render_yes_no("sportroom", __('Sport/Gameroom'));

render_yes_no("storeroom", __('Storeroom'));

render_yes_no("cellar", __('Cellar'));






render_group_sub(__('Interior'));

render_value('renovation', __('Renovation state'), 'Error', array(
	1 => __('zero state'), 
	2 => __('bad'), 
	3 => __('average'), 
	4 => __('good'), 
	5 => __('excellent')
	));

//render_creative_design();


render_check_key('windows', __('Windows'), array('none', 'image:no'), array( 
	array('wood', __('wood')), 
	array('metal', __('metal-based laminate')), 
	array('aluminium', __('aluminium')) 
	) );


render_check('entrance_door', __('Entrance door'),  array( 
	array('wood', __('wood')), 
	array('iron', __('iron')) 
	) );

render_yes_no("parquetry", __('Parquetry'));

render_yes_no("furniture", __('Furniture'));








render_group_sub(__('Additional'));

render_yes_no("sunny_side", __('Sunny side'));

//render_yes_no("swimming_pool", __('Swimming pool'));

//render_yes_no("orchard", __('Orchard'));

//render_yes_no("digital_counter", __('Digital counter of current'));

render_yes_no("landline_phone", __('Landline phone'));

render_yes_no("internet", __('Internet'));

render_check_key('TV', __('TV'), array('none', 'image:no'), array( 
	array('sattv', __('Sat. TV')), 
	array('cabtv', __('Cab. TV')),
	array('inttv', __('Int. TV')) 
	) );


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
