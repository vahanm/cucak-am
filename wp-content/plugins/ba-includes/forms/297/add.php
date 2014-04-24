<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_donation' => false));




helper_group('general_information', __('General'));


helper_item_status();


helper_location('item_location', __('Bus location'), USER_LOCATION);
/*

helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );
*/

helper_text("busmodel", __('Bus model'), __('Please enter the model.'));

helper_yes_no("customsclearance", __('Customs clearance'));

//jq_colorpicker('carcolor', __('Color'));

helper_slider_by_list('yearcar', __('Year'), __('Please select'), 1980, date('Y'), __('%sy'), array(1980 => __('%sy or older')
	), _t('%sy or older', 1980), date('Y') . __('y'));

helper_number("mileage", __('Mileage'), __('Please enter the mileage.'),  array( 
	array(1, __('km')),  
	array(2, __('mile')) 
	) );


helper_select('transmission', __('Transmission'), array( 
	array(1, __('Manual')),  
	array(2, __('Automatic')),  
	array(3, __('Tiptronic'))
	) );


helper_slider('doors', __('Door quantity'), __('Please select'), 1, 2, 7,  __('%s doors'));




		
helper_check('fuel', __('Fuel type'), array( 
	array('petrol', __('Petrol')),  
	array('diesel', __('Diesel')),  
	array('gas', __('Gas')), 
	array('liquidgas', __('Liquid gas')), 
	array('electric', __('Electric')), 
	array('hybrid', __('Hybrid')), 
	array('other', __('other'))
	) );



helper_slider('enginevolume', __('Engine volume'), __('Please select'), 0.1, 3, 80, __('%s litres'));


helper_number("motorpower", __('Motor power'), __('Please enter the motor power.'),  array( 
	array(1, __('h/p')),
	array(2, __('kW'))
	) );

//helper_slider('motorpower', __('Motor power'), __('Please select'), 2, 50, 300, __('%s h/p'));

helper_slider_by_list('cylinders', __('Cylinders quantity'), __('Please select'), 4, 9, __('%s cylinders'), array(
	7 => _t('%s cylinders', 8) , 
	8 => _t('%s cylinders', 10) ,
	9 => _t('%s cylinders', 12)
	), _t('%s cylinders', 4) , _t('%s cylinders', 12));	



helper_radio('cylinderconfiguration', __('Cylinder configuration'), array( 
	array('T', __('straight')),  
 	array('V', 'V'),  
  array('W', 'W'),	
	//array('U', 'U'),  
	//array('X', 'X'), 
	array('other', __('other')) 
	),6 );


/*
helper_select('thecountry', __('The country'), array( 
	array('armenia', __('Armenia')),  
	array('usa', __('USA')),  
	array('uae', __('UAE')), 
	array('belgium', __('Belgium')), 
	array('bulgaria', __('Bulgaria')), 
	array('germany', __('Germany')), 
	array('turkey', __('Turkey')),  
	array('iran', __('Iran')),  
	array('poland', __('Poland')), 
	array('south_korea', __('South Korea')), 
	array('japan', __('Japan')), 
	array('united_kingdom', __('United Kingdom')), 
	array('netherlands', __('Netherlands')), 
	array('czech', __('Czech')), 
	array('china', __('China')), 
	array('romania', __('Romania')), 	
	array('russia', __('Russia')), 
	array('georgia', __('Georgia')), 
	array('france', __('France')), 
	array('other', __('other'))
	));
*/
helper_colors('carcolor', __('Bus color'));

helper_radio('painttype', __('Paint type'), array( 
	array(1, __('Metallic')),
	array(2, __('Matt')),  
	array(3, __('other')) 
	) );

/*
helper_select('buscolor', __('Bus color'), array( 
	array('3', __('Black'),'#ffffff', '#000'),
	array('4', __('Black metallic'),'#ffffff', '#000'),
	array('1', __('White'),'#000', '#ffffff'),
	array('2', __('White metallic'),'#000', '#ffffff'),
	array('5', __('Silver'),'#000', '#f0f0f0'),
	array('6', __('Silver metallic'),'#000', '#f0f0f0'),
	array('7', __('Gray'),'#000', '#bdbdbd'),
	array('8', __('Gray metallic'),'#000', '#bdbdbd'),
	array('29', __('Beige'),'#000', '#eee4d3'),
	array('30', __('Beige metallic'),'#000', '#eee4d3'),
	array('19', __('Yellow'),'#000', '#f8f191'),
	array('20', __('Yellow metallic'),'#000', '#f8f191'),
	array('21', __('Gold'),'#000', '#ead18b'),
	array('22', __('Gold metallic'),'#000', '#ead18b'),
	array('27', __('Orange'),'#000', '#FF7F00'),
	array('28', __('Orange metallic'),'#000', '#FF7F00'),
	array('9', __('Red'),'#000', '#FF0000'),
	array('10', __('Red metallic'),'#000', '#FF0000'),
	array('33', __('Cherry'),'#fff', '#cc1539'),
	array('34', __('Cherry metallic'),'#fff', '#cc1539'),
	array('23', __('Brown'),'#fff', '#A62A2A'),
	array('24', __('Brown metallic'),'#fff', '#A62A2A'),
	array('31', __('Aubergine'),'#fff', '#7b425a'),
	array('32', __('Aubergine metallic'),'#fff', '#7b425a'),
	array('15', __('Light blue'),'#000', '#bcdbf1'),
	array('16', __('Light blue metallic'),'#000', '#bcdbf1'),
	array('17', __('Lilac'),'#000', '#d1b6e8'),
	array('18', __('Lilac metallic'),'#000', '#d1b6e8'),
	array('25', __('Purple'),'#fff', '#d14db6'),
	array('26', __('Purple metallic'),'#fff', '#d14db6'),
	array('13', __('Blue'),'#fff', '#5861e0'),
	array('14', __('Blue metallic'),'#fff', '#5861e0'),
	array('11', __('Green'),'#000', '#98e058'),
	array('12', __('Green metallic'),'#000', '#98e058'),
	array('other', __('other')),  
	) );
*/


helper_group('interior', __('Interior'));


helper_slider('seatsquantity', __('Seat quantity'), __('Please select'), 1, 15, 70,  __('%s seats'));

helper_yes_no("airconditioning", __('Air conditioning'), true);

helper_yes_no("climatcontrol", __('Climat control'), true);

helper_yes_no("manhole", __('Manhole'), true);

helper_yes_no("toilet", __('Toilet'), true);

helper_yes_no("refrigerator", __('Refrigerator'), true);




helper_group('drivingcomfort', __('Electronics'));



//helper_yes_no("hydraulicrudder", __('Hydraulic rudder'), true);

helper_yes_no("bortcomputer", __('Bort computer'), true);

helper_yes_no("cruisecontrol", __('Cruise control'), true);

helper_yes_no("navigationnsystem", __('Navigation system'), true);

helper_yes_no("parktronick", __('Parktronick'), true);

helper_yes_no("rearvisioncam", __('Rear vision camera'), true);

helper_yes_no("mirrorsheating", __('Mirrors heating'), true);

//helper_yes_no("rearwindowdefroster", __('Rear window defroster'), true);

//helper_yes_no("centrallocking", __('Central locking'), true);

//helper_yes_no("signalingsystem", __('Alarm system'), true);











helper_group('audiovideosystem', __('Audio and video systems'));



helper_yes_no("cddvdplayer", __('CD/DVD player'), true);

helper_yes_no("cddvdchanger", __('CD/DVD changer'), true);

helper_yes_no("mp3player", __('MP3 player'), true);

//helper_yes_no("cassettetapeplayer", __('Cassette tape player'), true);

helper_yes_no("monitortv", __('Monitor / TV'), true);

helper_yes_no("microphone", __('Microphone'), true);





helper_group('additional', __('Additional'));


helper_yes_no("sparetires", __('Spare tires'), true);





?>