<?php

function CheckFormForErrors()
{
	return '';
}

//filter_price(array('allow_donation' => false));




filter_group_sub('general_information', __('General'));

filter_carmodels();


filter_item_status();


/*
filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));
*/
//filter_carmodels();
//filter_text("minibusmodel", __('Minibus model'), __('Please enter the model.'));

filter_yes_no(array(
	'id'			=>"customsclearance"
	, 'title'		=>__('Customs clearance')
	, priority => PRIMARY_FILTER
	));




filter_slider_by_list(array(
	'id'			=>	'yearcar'
	, 'title'	    => 	__('Year')
	, 'min'			=>	1980
	, 'max'			=>	date('Y')
	, 'format'		=>	__('from %v1 to %2')
	, 'text'		=>	__('%sy')
	, 'listItems'	=> 	array(1980 => __('%sy or older'))
	, 'textMore'	=>  __('%s or newer')
	, 'begin'		=> 	1980
	, 'end'			=> 	date('Y')
	, 'priority'	=> PRIMARY_FILTER
	));



/*
filter_number("mileage", __('Mileage'), __('Please enter the mileage.'),  array( 
	array(1, __('km')),  
	array(2, __('mile')) 
	) );
	
	
	????????????????????????????????????????????????????????????????????????????????????????????????????????
	
	
*/




/*
filter_select(array(
	id	 =>	'transmission'
	, title	 =>	__('Transmission')
	, values =>	array( 
				array(1, __('Manual')),  
				array(2, __('Automatic')),  
				array(3, __('Tiptronic')), 
				array(4, __('Automanual')))
			, 'priority'	=> SECONDARY_FILTER
			));
*/


filter_slider('doors', __('Door quantity'),  1, 2, 7,  __('%s doors'));

filter_slider(array(
  'id'			=>'seatsquantity'
, 'title'		=>__('Seat quantity')
, 'rate'		=>1
, 'min'			=>2
, 'max'			=>25
, 'text'		=>__('%s seats')
	, 'priority'	=>	PRIMARY_FILTER
	));


/*
filter_select('drivetrain', __('Drivetrain'), array( 
	array(1, __('FWD')),  
	array(2, __('BWD')),  
	array(3, __('4x4'))
	) );

*/
		
filter_select(array(
	id	 =>'fuel'
	, title	 =>__('Fuel type')
	, values =>array( 
				array('petrol', __('Petrol')),  
				array('diesel', __('Diesel')),  
				array('gas', __('Gas')), 
				array('liquidgas', __('Liquid gas')), 
				array('electric', __('Electric')), 
				array('hybrid', __('Hybrid')), 
				array('other', __('other'))
				) 
			, byKeys => true
			, 'priority'	=> PRIMARY_FILTER
			));


filter_slider(array(
	'id'			=>'enginevolume'
	, 'title'		=>__('Engine volume')
	, 'rate'		=>0.1
	, 'min'			=>3
	, 'max'			=>80
	, 'text'		=>__('%s litres')
	, 'priority'	=>	PRIMARY_FILTER
	));


filter_select('motortype', __('Motor type'), array( 
	array('simple', __('simple')),
	array('turbo', __('Turbo')),  
	array('compr', __('Kompressor'))
	));

/*
filter_number("motorpower", __('Motor power'), __('Please enter the motor power.'),  array( 
	array(1, __('h/p')),
	array(2, __('kW'))
	) );
	????????????????????????????????????????????????????????????????????????????????????????????????????????
*/


//filter_slider('motorpower', __('Motor power'),  2, 30, 300, __('%s h/p'));

filter_slider_by_list(array(
  'id'			=>'cylinders'
, 'title'		=>__('Cylinders quantity')
, 'min'			=>4
, 'max'			=>9
, 'format'		=>__('from %v1 to %2')
, 'text'		=>__('%s cylinders')
, 'listItems'	=>array(
	7 => _t('%s cylinders', 8) , 
	8 => _t('%s cylinders', 10) ,
	9 => _t('%s cylinders', 12)
	)
, 'begin'		=>_t('%s cylinders', 4)
, 'end'			=>_t('%s cylinders', 12)
	, 'priority'	=>	PRIMARY_FILTER
));
	



filter_select('cylinderconfiguration', __('Cylinder configuration'), array( 
	array('T', __('straight')),  
 	array('V', 'V'),  
  array('W', 'W'),	
	//array('U', 'U'),  
	//array('X', 'X'), 
	array('other', __('other')) 
	),6 );





filter_select(array(
	id	 =>'rudder'
	, title	 =>__('Rudder side')
	, values =>array( 
				array(1, __('left')),  
				array(2, __('right')),
				array(3, __('left(transformed)'))
				)
			, 'priority'	=>	PRIMARY_FILTER
			));


/*
filter_select('thecountry', __('The country'), array( 
	array('armenia',__('Armenia')),  
	array('usa',__('USA')),  
	array('uae',__('UAE')), 
	array('belgium',__('Belgium')), 
	array('bulgaria',__('Bulgaria')), 
	array('germany',__('Germany')), 
	array('turkey',__('Turkey')),  
	array('iran',__('Iran')),  
	array('poland',__('Poland')), 
	array('south_korea',__('South Korea')), 
	array('japan',__('Japan')), 
	array('united_kingdom',__('United Kingdom')), 
	array('netherlands',__('Netherlands')), 
	array('czech',__('Czech')), 
	array('china',__('China')), 
	array('russia',__('Russia')), 
	array('romania',__('Romania')), 
	array('georgia',__('Georgia')), 
	array('france',__('France')), 
	array('other',__('other'))
	));
*/


filter_group_sub('exterior', __('Exterior'));


//filter_colors('carcolor', __('Car color'));  ?????????????????????????????????????????????????????????????????????????
filter_colors(array(
	'id'			=>'carcolor'
	, 'title'		=>__('Minibus color')
	, 'priority'	=>	PRIMARY_FILTER
	));

/*
filter_select('minicolor', __('Minibus color'), array( 
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
//filter_colors('minicolor', __('Minibus color'));

filter_select('painttype', __('Paint type'), array( 
	array(1, __('Metallic')),
	array(2, __('Matt')),  
	array(3, __('other')) 
	) );

filter_slider('discs', __('Discs'),  0.5, 28, 44, '%s \"', '14 &#34;', '22 &#34;' );

filter_yes_no("tintedglass", __('Tinted glasses'));





filter_group_sub('interior', __('Interior'));

//filter_colors('salooncolor', __('Saloon color'));
/*
filter_select('salooncolor', __('Saloon color'), array( 
	array('1', __('Black'),'#ffffff', '#000'),
	array('2', __('White'),'#000', '#ffffff'),
	array('3', __('Gray'),'#000', '#bdbdbd'),
	array('4', __('Beige'),'#000', '#eee4d3'),
	array('5', __('Yellow'),'#000', '#f8f191'),
	array('6', __('Red'),'#000', '#FF0000'),
	array('7', __('Brown'),'#fff', '#A62A2A'),
	array('8', __('Green'),'#000', '#98e058'),
	array('9', __('Blue'),'#fff', '#5861e0'),
	array('other', __('other')),  
	) );
*/

filter_yes_no("leatherinterior", __('Leather interior'));


filter_yes_no("airconditioning", __('Air conditioning'));

filter_yes_no("climatcontrol", __('Climat control'));

filter_yes_no("manhole", __('Manhole'));

filter_yes_no("refrigerator", __('Refrigerator'));





filter_group_sub('securitysystems', __('Security systems'));


filter_yes_no("abs", 'ABS', true);

filter_yes_no("trc", 'TRC', true);

filter_yes_no("esp", 'ESP', true);

filter_yes_no("ebd", 'EBD', true);

filter_yes_no("srs", __('SRS'));

filter_yes_no("hydraulicrudder", __('Power assisted steering'));



filter_group_sub('electroniccontrol', __('Electronics'));


filter_yes_no("bortcomputer", __('Bort computer'));

filter_yes_no("cruisecontrol", __('Cruise control'));

filter_yes_no("navigationnsystem", __('Navigation system'));

filter_yes_no("parktronick", __('Parktronick'));

filter_yes_no("rearvisioncam", __('Rear vision camera'));

filter_yes_no("glasses", __('Electric windows'));

filter_yes_no("mirrors", __('Electric mirrors'));

filter_yes_no("mirrorsheating", __('Mirrors heating'));

filter_yes_no("seats", __('Adjusting the driver&#39;s seat'));

filter_yes_no("seatspass", __('Adjusting the passenger&#39;s seat'));

filter_yes_no("seatwarming", __('Seat warming'));

filter_yes_no("centrallocking", __('Central locking'));

filter_yes_no("signalingsystem", __('Alarm system'));




//jq_colorpicker('carcolor', __('Color'));










//filter_yes_no("full", 'Full');




filter_group_sub('lights', __('Lights'));

filter_yes_no("xsenonheadlights", __('Xsenon headlights'));

filter_yes_no("antifogheadlights", __('Antifog headlights'));








filter_group_sub('audiovideosystem', __('Audio and video systems'));



filter_yes_no("cddvdplayer", __('CD/DVD player'));

filter_yes_no("cddvdchanger", __('CD/DVD changer'));

filter_yes_no("mp3player", __('MP3 player'));

//filter_yes_no("cassettetapeplayer", __('Cassette tape player'));

filter_yes_no("subwoofer", __('Subwoofer'));

filter_yes_no("monitortv", __('Monitor / TV'));

filter_yes_no("microphone", __('Microphone'));



filter_group_sub('additional', __('Additional'));


filter_yes_no("sparetires", __('Spare tires'));





?>