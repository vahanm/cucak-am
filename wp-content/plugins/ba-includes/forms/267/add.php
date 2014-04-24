<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_donation' => false));



helper_group('house_information', __('House'));

helper_location('item_location', __('House location'), USER_LOCATION);

helper_text("address", __('Address'), __('Please enter the address.'));

helper_slider_by_list('structureyear', __('Year of the structure'), __('Please select'), 1940, date('Y'), __('%sy'), array(
	1940 => __('%sy or older')
	), __('%sy or older'), date('Y') . __('y'));

helper_slider_by_list('floorquantity', __('Floor quantity'), __('Please select'), 1, 4, __('%s storeys'), array(
	1 => __('%s storey')
	), __('%s storey'), __('%s storeys'));




helper_check('wall', __('Wall'),  array( 
	array('stone', __('stone')),
	array('concrete', __('concrete')),
	array('other', __('other'))
	) );

helper_check('ceiling', __('Ceiling'),  array( 
	array('concrete', __('concrete')),
	array('panel', __('panel')),
	array('other', __('other'))
	) );

//helper_yes_no("summercottage", __('Summer cottage'));




helper_group_sub('general', __('Basic information'));

//helper_slider('total_area', __('Total area'), __('Please select'), 5, 6, 100,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');
helper_number("total_area", __('Total area'), __('Please enter the total area.'),  array( 
	array(1, __('square metres')),  
	) );

//helper_slider('residential_area', __('Residential area'), __('Please select'), 5, 5, 96,  __('%s m') . '²', __('%s m') . '²', __('%s m') . '²');
helper_number("residential_area", __('Residential area'), __('Please enter the residential area.'),  array( 
	array(1, __('square metres')),  
	) );


helper_slider('heightofroom', __('Ceiling height'), __('Please select'), 0.05, 50, 80,  __('%s m'), __('%s m'), __('%s m'));

//helper_slider('land_area', __('Land area'), __('Please select'), 10, 0, 200, __('%s m') . '²', __('no land'), __('%s m') . '²');
helper_number("land_area", __('Land area'), __('Please enter the size of the land area.'),  array( 
	array(1, __('square metres')),  
	array(2, __('hectare')) 
	) );

		
helper_slider_by_list('garage', __('Garage'), __('Please select'), 0, 5, __('for %s cars'), array(
	0 => __('no garage'), 
	1 => __('for %s car')
	), __('no garage'),__('for %s cars'));


helper_check_key('parking', __('Parking'), array('none', __('none')), array( 
	array('indoor', __('indoor')), 
	array('outdoor', __('outdoor')),
	) );









helper_group_sub('room', __('Rooms'));

helper_slider_by_list('roomquantityhouse', __('Room quantity'), __('Please select'), 1, 15, __('%s rooms'), array(
	1 => __('%s room')
	), __('%s room'), __('%s rooms'));

helper_slider_by_list('bedroom', __('Bedroom quantity'), __('Please select'), 0, 10, __('%s bedrooms'), array(
	0 => __('no bedroom'), 
	1 => __('%s bedroom')
	), __('no bedroom'), __('%s bedrooms'));

helper_slider_by_list('bathroom', __('Bathroom quantity'), __('Please select'), 0, 5, __('%s bathrooms'), array(
	0 => __('no bathroom'), 
	1 => __('%s bathroom')
	), __('no bathroom'), __('%s bathrooms'));

helper_slider_by_list('kitchen', __('Kitchen quantity'), __('Please select'), 0, 4, __('%s kitchens'), array(
	0 => __('no kitchen'), 
	1 => __('%s kitchen')
	), __('no kitchen'), __('%s kitchens'));

helper_slider_by_list('balcony', __('Balcony quantity'), __('Please select'), 0, 5, __('%s balconies'), array(
	0 => __('no balcony'), 
	1 => __('%s balcony')
	), __('no balcony'), __('%s balconies'));

helper_yes_no("sportroom", __('Sport/Gameroom'), true);

helper_yes_no("storeroom", __('Storeroom'), true);

helper_yes_no("cellar", __('Cellar'), true);









helper_group_sub('interior', __('Interior'));

helper_radio('renovation', __('Renovation state'), array( 
	array(1, __('zero state')), 
	array(2, __('bad')), 
	array(3, __('average')), 
	array(4, __('good')),
	array(5, __('excellent')) 
	),5 );

//helper_creative_design();

helper_check_key('windows', __('Windows'), array('none', __('none')), array( 
				array('wood', __('wood')), 
				array('metal', __('metal-based laminate')), 
				array('aluminium', __('aluminium')) 
			) );


helper_check('entrance_door', __('Entrance door'),  array( 
				array('wood', __('wood')), 
				array('iron', __('iron')) 
			) );



helper_yes_no("parquetry", __('Parquetry'), true);

helper_yes_no("furniture", __('Furniture'), true);





helper_group_sub('communal_possibilities', __('Communal possibilities'));

helper_radio('gas', __('Gas existence'), array( 
				array(1, __('none')), 
				array(2, __('exists')), 
				array(3, __('possible')) 
			) );

helper_yes_no("permanent_water", __('Permanent water'), true);

helper_yes_no("hot_water", __('Hot water'), true);

helper_yes_no("irrigation_water", __('Irrigation water'), true);

helper_slider('container', __('Water container'), __('Please select'), 50, 0, 60, __('%s litres'), __('no water container'), __('%s litres'));



helper_check_key('heating_system', __('Heating system'), array('none', __('none')), array( 
	array('gasboiler', __('gas boiler')), 
	array('gasheater', __('gas heater')), 
	array('centralized', __('centralized')), 
	array('electrical', __('electrical')), 
	array('underfloor', __('underfloor')), 
	array('conditioner', __('conditioner')) 
	),3 );

helper_yes_no("three_phase_current", __('Three-phase current'));






helper_group_sub('additional_information', __('Additional'));

helper_yes_no("elevator", __('Elevator'), true);

helper_yes_no("sunny_side", __('Sunny side'), true);

helper_yes_no("swimming_pool", __('Swimming pool'), true);

helper_yes_no("orchard", __('Orchard'), true);

//helper_yes_no("digital_counter", __('Digital counter of current'), true);

helper_yes_no("landline_phone", __('Landline phone'), true);

helper_yes_no("internet", __('Internet'), true);

helper_check_key('TV', __('TV'), 
	array('none', __('none')), 
	array(
			array('sattv', __('Sat. TV')),
			array('cabtv', __('Cab. TV')), 
			array('inttv', __('Int. TV')) 
	) );

?>


