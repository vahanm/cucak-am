<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));




render_item_status();




render_location('item_location', __('Car location'));
/*
render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	3 => __('broken'), 
	4 => __('other')
	));
*/



render_format('carname', __('Car model'));
/*
render_value(array(
		id => 'carbrandname',
		title => __('Car brand'),
		searchIcon => true
	));

render_value(array(
		id => 'carmodelname',
		title => __('Car model'),
		searchIcon => true
	));
*/

render_yes_no("customsclearance", __('Customs clearance'));

render_value('yearcar', __('Year'), __('%sy'), array(
	1980 => __('%sy or older') 	
	));


render_number('mileage', __('Mileage'), array(
	1 => __('km'), 
	2 => __('mile')
	));	 




render_value('bodystyle', __('Body style'), 'Error', array(
	1 => __('Sedan'), 
	2 => __('Hetchback'), 
	3 => __('Coupe'), 
	4 => __('Cabriolet/Roadster'), 
	5 => __('Wagon'), 
	6 => __('SUV'), 
	7 => __('Minivan')
	));



render_value('transmission', __('Transmission'), 'Error', array(
	1 => __('Manual'), 
	2 => __('Automatic'), 
	3 => __('Tiptronic'), 
	4 => __('Automanual')
	));



render_value('doors', __('Door quantity'), __('%s doors'));	  


render_value('drivetrain', __('Drivetrain'), 'Error', array(
	1 => __('FWD'), 
	2 => __('BWD'), 
	3 => __('4x4')
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



render_value('motortype', __('Motor type'), 'Error', array(
	'simple' => __('simple'), 
	'turbo' => __('Turbo'), 
	'compr' => __('Kompressor')
	));	 

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

render_value('rudder', __('Rudder side'), 'Error', array(
	1 => __('left'), 
	2 => __('right'),
	3 => __('left(transformed)')
	));	 



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


render_group_sub(__('Security systems'));


render_yes_no("abs", 'ABS');

render_yes_no("trc", 'TRC');

render_yes_no("esp", 'ESP');

render_yes_no("ebd", 'EBD');

render_yes_no("srs", __('SRS'));

render_yes_no("hydraulicrudder", __('Power assisted steering'), true);



//render_group_sub(__('Driving comfort'));

render_group_sub(__('Audio and video systems'));



render_yes_no("cddvdplayer", __('CD/DVD player'));

render_yes_no("cddvdchanger", __('CD/DVD changer'));

render_yes_no("mp3player", __('MP3 player'));

//render_yes_no("cassettetapeplayer", __('Cassette tape player'));

render_yes_no("subwoofer", __('Subwoofer'));

render_yes_no("monitortv", __('Monitor / TV'));




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Exterior'));

render_color('carcolor', __('Car color'));


render_value('painttype', __('Paint type'), 'Error', array(
	1 => __('Metallic'),
	2 => __('Matt'),  
	3 => __('other') 
));	


/*
render_value('carcolor', __('Car color'), 'Error', array(
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
'other'=> __('other')
	));
	
*/


render_yes_no("tuning", __('Tuning'));


//render_creative_design();


render_value('discs', __('Discs'), '%s ' . '"');

render_yes_no("aluminumdiscs", __('Aluminum discs'));

render_yes_no("tintedglass", __('Tinted glasses'));






render_group_sub(__('Interior'));

render_color('salooncolor', __('Saloon color'));

/*		
render_value('salooncolor', __('Saloon color'), 'Error', array(
'1' => __('Black'),
'2' => __('White'),
'3' => __('Gray'),
'4' => __('Beige'),
'5' => __('Yellow'),
'6' => __('Red'),
'7' => __('Brown'),
'8' => __('Green'),
'9' => __('Blue'),
'other'=> __('other')
	));
*/


render_yes_no("leatherinterior", __('Leather interior'));

//render_yes_no("soundproof", __('Soundproofing'));


render_yes_no("airconditioning", __('Air conditioning'));

render_yes_no("climatcontrol", __('Climat control'));

render_yes_no("manhole", __('Manhole'));





render_group_sub(__('Electronics'));

render_yes_no("bortcomputer", __('Bort computer'));

render_yes_no("cruisecontrol", __('Cruise control'));

render_yes_no("navigationnsystem", __('Navigation system'));

render_yes_no("parktronick", __('Parktronick'));

render_yes_no("rearvisioncam", __('Rear vision camera'));

render_yes_no("glasses", __('Electric windows'));

render_yes_no("mirrors", __('Electric mirrors'));

render_yes_no("mirrorsheating", __('Mirrors heating'));

render_yes_no("seats", __('Adjusting the driver&#39;s seat'));

render_yes_no("seatspass", __('Adjusting the passenger&#39;s seat'));

render_yes_no("seatwarming", __('Seat warming'));

render_yes_no("centrallocking", __('Central locking'));

render_yes_no("signalingsystem", __('Alarm system'));




render_group_sub(__('Lights'));

render_yes_no("xsenonheadlights", __('Xsenon headlights'));

render_yes_no("antifogheadlights", __('Antifog headlights'));












render_group_sub(__('Additional'));

render_yes_no("sparetires", __('Spare tires'));




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
