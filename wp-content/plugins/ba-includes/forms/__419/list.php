<table style="width: 49%; float: left; margin-left: 5px;">
<colgroup>
	<col width="50%"/>
	<col width="50%"/>
</colgroup>
<tbody>

<?php

render_group(__('Building information'));

render_value('structureyear', __('Year of the structure'), __('%s'), array(1940 => __('%s or older')));

render_value('floorquantity', __('Floor quantity of building'), __('%s floors'), array(1 => __('1 floor'), 40 => __('%s floors and more')));

render_value('floornumber', __('Floor'), __('%s floor'), array(0 => __('basement'), 40 => __('%s floor and above')));

render_category('wall', __('Wall'));

render_category('ceiling', __('Ceiling'));

render_yes_no("rubbish", __('Rubbish chute'));

render_yes_no("elevator", __('Elevator'));

render_group_sub(__('Basic information'));

render_value('total_area', __('Total area'), '%s ' . __('m') . '²');

render_value('residential_area', __('Residential area'), '%s ' . __('m') . '²');

render_value('heightofroom', __('Height of room'), '%s ' . __('m'));

render_value('land_area', __('Land area'), '%s ' . __('m') . '²');

render_value('garage', __('Garage'), __('for %s cars'), array(0 => __('no garage'), 1 => __('for 1 car'), 5 => __('for %s cars and more')));

render_category('parking', __('Parking'));

render_group_sub(__('Communal possibilities'));

render_yes_no("permanent_water", __('Permanent water'));

render_yes_no("hot_water", __('Hot water'));

render_yes_no("irrigation_water", __('Irrigation water'));

render_value('container', __('Water container'), __('%s litres'));

render_category('gas', __('Gas'));

//render_check_key('heating_system', __('Heating system'), array(283, __('none')), array( array(277, __('gas boiler')), array(278, __('gas heater')), array(279, __('centralized')), array(280, __('electrical')), array(281, __('underfloor')), array(282, __('conditioner')) ) );

render_yes_no("three_phase_current", __('Three-phase current'));

?>
</tbody>

</table>

<table style="width: 49%; float: right; margin-right: 5px;">
<colgroup>
	<col width="50%"/>
	<col width="50%"/>
</colgroup>
<tbody>

<?php
render_group(__('Interior'));

render_category('renovation', __('Renovation state'));

render_yes_no("parquetry", __('Parquetry'));

render_yes_no("furniture", __('Furniture'));

render_group_sub(__('Room information'));

render_value('roomquantity', __('Room quantity'), __('%s rooms'), array(1 => __('1 room'), 15 => __('%s rooms and more')));

render_value('bedroom', __('Bedroom quantity'), __('%s bedrooms'), array(0 => __('no bedroom'), 1 => __('1 bedroom'), 10 => __('%s bedrooms and more')));

render_value('bathroom', __('Bathroom quantity'), __('%s bathrooms'), array(0 => __('no bathrooms'), 1 => __('1 bathroom'), 10 => __('%s bathrooms and more')));

render_value('kitchen', __('Kitchen'), __('%s kitchens'), array(0 => __('no kitchen'), 1 => __('1 kitchen'), 4 => __('%s kitchens and more')));

render_value('balcony', __('Balcony quantity'), __('%s balconies'), array(0 => __('no balcony'), 1 => __('1 balcony'), 5 => __('%s balconies and more')));

render_yes_no("sportroom", __('Sport/Gameroom'));

render_yes_no("storeroom", __('Storeroom'));

render_yes_no("cellar", __('Cellar'));

render_group_sub(__('Additional information'));

render_yes_no("sunny_side", __('Sunny side'));

render_yes_no("swimming-pool", __('Swimming pool'));

render_yes_no("orchard", __('Orchard'));

render_yes_no("digital_counter", __('Digital counter'));

render_yes_no("landline_phone", __('Landline phone'));

render_yes_no("internet", __('Internet'));

render_yes_no("satellite-TV", __('Sat. TV'));

render_yes_no("cab-TV", __('Cab. TV'));

?>


</tbody>

</table>
