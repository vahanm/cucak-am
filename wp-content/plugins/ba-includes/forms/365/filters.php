<?php


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used'))
				)
			, priority => PRIMARY_FILTER
			));

filter_select(array(
'id'			=>'shoestofferedto'
, 'title'		=>__('Shoes is offered to')
, 'values'		=>array( 
	array('men', __('men')),
	array('women', __('women'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));

filter_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	, priority => SECONDARY_FILTER
	));


//filter_text("furnituremodel", __('Furniture model'), __('Please enter desired model.'));

filter_select(array(
'id'			=>'shoesitem'
, 'title'		=>__('Shoes form')
, 'values'		=>array( 
	array('shoes', __('shoes')),
	array('pumps', __('pumps')),
	array('moccasins', __('moccasins')),
	array('balletslipper', __('ballet slipper')),
	array('sandals', __('sandals')),
	array('sabot', __('sabot')),
	array('wedgeheel', __('wedge heel')),
	array('walkingshoes', __('walking shoes')),
	array('boots', __('boots')),
	array('uggboots', __('ugg boots')),
	array('cossackboots', __('cossack boots')),
	array('lowboots', __('low boots')),
	array('highboots', __('high boots')),
	array('jackboots', __('jackboots')),
	array('rubberboots', __('rubber boots')),
	array('footballboots', __('football boots')),
	array('keds', __('keds')),
	array('sneakers', __('sneakers')),
	array('slippers', __('slippers')),
	array('bedroomslippers', __('bedroom slippers')),
	array('flipflops', __('flip-flops')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


filter_select(array(
'id'			=>'shoesmaterial'
, 'title'		=>__('Shoes material')
, 'values'		=>array( 
	array('smoothleather', __('smooth leather')),
	array('patentleather', __('patent leather')),
	array('calfleather', __('calf leather')),
	array('leatherette', __('leatherette')),
	array('suede', __('suede')),
	array('calfsuede', __('calf suede')),
	array('naturaltextiles', __('natural textiles')),
	array('synthetictextile', __('synthetic textile')),
	array('artificialtextile', __('artificial textile')),
	array('velour', __('velour')),
	array('caoutchouc', __('caoutchouc')),
	array('rubber', __('rubber')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));
	
	

//filter_text("shoesbrand", __('Brand'), __('Please enter the brand.'));


filter_select(array(
	'id'			=>'wearingseason'
	, 'title'		=>__('Season')
	, 'values'		=>array( 
				array('allseason', __('for all seasons')),
				array('spring', __('spring')),
				array('summer', __('summer')),
				array('autumn', __('autumn')),
				array('winter', __('winter')),
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));







filter_select(array(
'id'			=>'shoestype'
, 'title'		=>__('Shoes type')
, 'values'		=>array( 
	array('daily', __('daily shoes')),
	array('sports', __('sports')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));




filter_creative_design();





////filter_colors('shoescolor', __('Shoes color'));

filter_select('thecountry', __('Producing country'), array( 
	array('armenia', __('Armenia')),  
	array('usa', __('USA')),  
	array('uae', __('UAE')), 
	array('belarus', __('Belarus')), 		
	array('belgium', __('Belgium')), 
	array('bulgaria', __('Bulgaria')), 
	array('germany', __('Germany')), 
	array('egypt', __('Egypt')), 		
	array('estonia', __('Estonia')), 	
	array('turkey', __('Turkey')),  
	array('italy', __('Italy')), 	
	array('spain', __('Spain')),  	
	array('iran', __('Iran')),  
	array('latvia', __('Latvia')),  	
	array('poland', __('Poland')), 
	array('lithuania', __('Lithuania')), 	
	array('south_korea', __('South Korea')), 
	array('hungary', __('Hungary')), 	
	array('japan', __('Japan')), 
	array('malaysia', __('Malaysia')), 	
	array('united_kingdom', __('United Kingdom')), 
	array('netherlands', __('Netherlands')), 
	array('czech', __('Czech')), 
	array('china', __('China')), 
	array('romania', __('Romania')), 
	array('russia', __('Russia')), 	
	array('georgia', __('Georgia')), 
	array('finland', __('Finland')), 	
	array('france', __('France')), 
	array('other', __('other'))
	));



?>