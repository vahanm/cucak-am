<?php
helper_price(array('allow_donation' => false));


helper_group('general', __('General'));

helper_select('areatype', __('Type'), array( 
	array(1, __('Office area')),  
	array(2, __('Trading area')), 
	array(3, __('Universal area')), 
	array(4, __('Industrial area')), 	
	array(5, __('Cafe')), 
	array(6, __('other'))
	) );



helper_location('item_location', __('Commercial area location'), USER_LOCATION);



helper_text("address", __('Address'), __('Please enter the address.'));

helper_slider_by_list('floorquantity', __('Floor quantity of the building'), __('Please select'), 1, 30, __('%s storeys'), array(
	1 =>  __('%s storey'), 
	), __('%s storey'),   __('%s storeys'));


helper_slider_by_list('floornumber', __('Floor number'), __('Please select'), 0, 30, __('%s floornumber'), array(
	0 => __('basement'),
	1 =>  __('%s floornumberone')
	),  __('basement'), __('%s floornumber') );

helper_yes_no("elevator", __('Elevator'));


//helper_slider('total_area', __('Total area'), __('Please select'), 5, 6, 100,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');
helper_number("total_area", __('Total area'), __('Please enter the total area.'),  array( 
	array(1, __('square metres')),  
	) );


helper_slider('heightofroom', __('Ceiling height'), __('Please select'), 0.1, 25, 70,  __('%s m'), __('%s m'), __('%s m'));

//helper_slider('land_area', __('Land area'), __('Please select'), 10, 0, 200, __('%s m') . '²', __('no land'), __('%s m') . '²');
helper_number("land_area", __('Land area'), __('Please enter the size of the land area.'),  array( 
	array(1, __('square metres')),  
	array(2, __('hectare')) 
	) );

helper_slider_by_list('garage', __('Garage'), __('Please select'), 0, 15, __('for %s cars'), array(
	0 => __('no garage'), 
	1 => __('for %s car'), 
	), __('no garage'), __('for %s cars'));



helper_check_key('parking', __('Parking'), array('none', __('none')), array( 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
	) );



helper_check('entrances', __('Entrance from'),  array( 
	array('street', __('street')),
	array('parking', __('parking')),
	array('yard', __('yard'))
	) );






helper_group_sub('room', __('Rooms'));

helper_slider_by_list('roomquantity', __('Room quantity'), __('Please select'), 1, 15,  __('%s rooms'), array(
	1 =>  __('%s room')
	),  __('%s room'),  __('%s rooms'));


helper_slider_by_list('bathroom', __('Bathroom quantity'), __('Please select'), 0, 5, __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 =>  __('%s bathroom')
	), __('no bathroom'),  __('%s bathrooms'));

helper_slider_by_list('kitchen', __('Kitchen quantity'), __('Please select'), 0, 4, __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 =>  __('%s kitchen')
	), __('no kitchen'),  __('%s kitchens'));

helper_slider_by_list('balcony', __('Balcony quantity'), __('Please select'), 0, 5, __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony')
	), __('no balcony'),  __('%s balconies'));

helper_yes_no("storehouse", __('Storehouse'), true);

helper_yes_no("cellar", __('Cellar'), true);

//helper_yes_no("storeroom", __('Storeroom'), true);

helper_yes_no("sportroom", __('Sport/Gameroom'), true);










helper_group_sub('interior', __('Interior'));

helper_radio('renovation', __('Renovation state'), array( 
	array(1, __('zero state')), 
	array(2, __('bad')), 
	array(3, __('average')), 
	array(4, __('good')),
	array(5, __('excellent')) 
	), 5 );

//helper_creative_design();


helper_check_key('windows', __('Windows'), array('none', __('none')), array( 
				array('wood', __('wood')), 
				array('metal', __('metal-based laminate')),
				array('aluminium', __('aluminium'))
			) );


helper_check('entrance_door', __('Entrance door'),  array( 
	array('glass', __('from glass')),
				array('wood', __('wood')),
				array('iron', __('iron'))
			) );



helper_yes_no("furniture", __('Furniture'));





helper_group_sub('communal_possibilities', __('Communal possibilities'));

helper_radio('gas', __('Gas existence'), array( 
				array(1, __('none')), 
				array(2, __('exists')), 
				array(3, __('possible')) 
			) );

helper_yes_no("permanent_water", __('Permanent water'), true);

helper_yes_no("hot_water", __('Hot water'), true);

helper_slider('container', __('Water container'), __('Please select'), 50, 0, 60, __('%s litres'), __('no water container'),  __('%s litres'));

helper_yes_no("conditioner", __('Conditioner'));

helper_check_key('heating_system', __('Heating system'), array('none', __('none')), array( 
	array('gasboiler', __('gas boiler')), 
	array('gasheater', __('gas heater')), 
	array('centralized', __('centralized')), 
	array('electrical', __('electrical')), 
	array('underfloor', __('underfloor')), 
	array('conditioner', __('conditioner')) 
	),3 );

helper_yes_no("refrigerator", __('Refrigerator'), true);

helper_yes_no("three_phase_current", __('Three-phase current'), true);






helper_group_sub('additional_information', __('Additional'));

helper_yes_no("sunny_side", __('Sunny side'), true);

helper_yes_no("landline_phone", __('Landline phone'), true);

helper_yes_no("internet", __('Internet'));

helper_check_key('TV', __('TV'), 
	array('none', __('none')), 	array(
			array('sattv', __('Sat. TV')),
			array('cabtv', __('Cab. TV')), 
			array('inttv', __('Int. TV')) 
			) );

helper_text("previously", __('Previously used as'), __('Please enter what it was used for.'));
?>


