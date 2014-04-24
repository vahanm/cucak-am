<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));




render_item_status();


render_location('item_location', __('Truck location'));
/*
render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	3 => __('broken'), 
	4 => __('other')
	));
*/

render_value('truckmodel', __('Truck model'), '%s' );		

render_yes_no("customsclearance", __('Customs clearance'));

//render_color('carcolor', __('Color'));

render_value('yearcar', __('Year'), __('%sy'), array(
	1980 => __('%sy or older') 	
	));


render_number('mileage', __('Mileage'), array(
	1 => __('km'), 
	2 => __('mile')
	));	 

render_value('bodystyle', __('Body style'), 'Error', array(
	1 => __('tipper'), 
	2 => __('container'), 
	3 => __('tent'), 
	4 => __('cistern'), 
	5 => __('other')
	));


render_value('transmission', __('Transmission'), 'Error', array(
	1 => __('Manual'), 
	2 => __('Automatic'), 
	3 => __('Tiptronic'), 
	4 => __('Automanual')
	));

render_check('fuel', __('Fuel type'), array( 
	array('petrol', __('Petrol')),  
	array('diesel', __('Diesel')),  
	array('gas', __('Gas')), 
	array('liquidgas', __('Liquid gas')), 
	array('electric', __('Electric')), 
	array('hybrid', __('Hybrid')), 
	array('other', __('other'))
	) );


render_value('enginevolume', __('Engine volume'), __('%s litres'));

render_number('motorpower', __('Motor power'), array(
	1 => __('h/p'),
	2 => __('kW')
	));	 
//render_value('motorpower', __('Motor power'), __('%s h/p'));


render_format('cylnumconf', __('Cylinders2'));

/*

render_value('cylinders', __('Cylinders quantity'), __('%s cylinders'), array(
	7 => _t('%s cylinders', 8) , 
	8 => _t('%s cylinders', 10),
	9 => _t('%s cylinders', 12),
	10 => _t('%s cylinders', 16)	
	));


render_value('cylinderconfiguration', __('Cylinder configuration'), 'Error', array(
	'W' => 'W', 
	'V' => 'V', 
	'T' => __('straight'),
	//'U' => 'U', 
	//'X' => 'X', 
	'other' => __('other'), 
	));	 
  */
/*

render_value('thecountry', __('The country'), 'Error', array(
	'armenia' => __('Armenia'),  
	'usa' => __('USA'),  
	'uae' => __('UAE'), 
	'belgium' => __('Belgium'), 
	'bulgaria' => __('Bulgaria'), 
	'germany' => __('Germany'), 
	'turkey' => __('Turkey'),  
	'iran' => __('Iran'),  
	'poland' => __('Poland'), 
	'south_korea' => __('South Korea'), 
	'japan' => __('Japan'), 
	'united_kingdom' => __('United Kingdom'), 
	'netherlands' => __('Netherlands'), 
	'czech' => __('Czech'), 
	'china' => __('China'), 
	'russia' => __('Russia'), 
	'romania' => __('Romania'), 
	'georgia' => __('Georgia'), 
	'france' => __('France'), 
	'other' => __('other')
	));



*/



///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



//render_group_sub(__('Exterior'));



render_group_sub(__('Color'));



render_color('carcolor', __('Truck color'));

/*
render_value('painttype', __('Paint type'), 'Error', array(
	1 => __('Metallic'),
	2 => __('Matt'),  
	3 => __('other') 
	));	
*/
/*		
render_value('truckcolor', __('Truck color'), 'Error', array(
	'1' => __('White'),
	'2' => __('White metallic'),
	'3' => __('Black'),
	'4' => __('Black metallic'),
	'5' => __('Silver'),
	'6' => __('Silver metallic'),
	'7' => __('Gray'),
	'8' => __('Gray metallic'),
	'9' => __('Red'),
	'10' => __('Red metallic'),
	'11' => __('Green'),
	'12' => __('Green metallic'),
	'13' => __('Blue'),
	'14' => __('Blue metallic'),
	'15' => __('Light blue'),
	'16' => __('Light blue metallic'),
	'17' => __('Lilac'),
	'18' => __('Lilac metallic'),
	'19' => __('Yellow'),
	'20' => __('Yellow metallic'),
	'21' => __('Gold'),
	'22' => __('Gold metallic'),
	'23' => __('Brown'),
	'24' => __('Brown metallic'),
	'25' => __('Purple'),
	'26' => __('Purple metallic'),
	'27' => __('Orange'),
	'28' => __('Orange metallic'),
	'29' => __('Beige'),
	'30' => __('Beige metallic'),
	'31' => __('Aubergine'),
	'32' => __('Aubergine metallic'),
	'33' => __('Cherry'),
	'34' => __('Cherry metallic'),
	'other'=> __('other'),  
	));

*/

render_group_sub(__('Electronics'));

//render_yes_no("hydraulicrudder", __('Hydraulic rudder'));

render_yes_no("bortcomputer", __('Bort computer'));

render_yes_no("cruisecontrol", __('Cruise control'));

render_yes_no("navigationnsystem", __('Navigation system'));

render_yes_no("parktronick", __('Parktronick'));

render_yes_no("rearvisioncam", __('Rear vision camera'));





render_group_sub(__('Interior'));




render_yes_no("airconditioning", __('Air conditioning'));

render_yes_no("climatcontrol", __('Climat control'));

render_yes_no("manhole", __('Manhole'));




render_group_sub(__('Additional'));

render_yes_no("sparetires", __('Spare tires'));




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
