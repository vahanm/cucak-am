<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));




render_item_status();


render_location('item_location', __('Item location'));



render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	4 => __('other')
	));

render_check('shoestofferedto', __('Shoes is offered to'),  array( 
	array('men', __('men')),
	array('women', __('women'))
	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


/*
render_check('forkids', __('For kids'),  array( 
	array('forkids', __('')),
*/
render_value('shoesbrand', __('Brand'), '%s ' );	

render_check('shoesitem', __('Shoes form'),  array( 
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
	) );



render_check_key('wearingseason', __('Season'), array('allseason', __('for all seasons')), array( 
	array('spring', __('spring')),
	array('summer', __('summer')),
	array('autumn', __('autumn')),
	array('winter', __('winter')),
	) );










///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));


render_check('shoestype', __('Shoes type'),  array( 
	array('daily', __('daily shoes')),
	array('sports', __('sports')),
	array('other', __('other'))
	) );



render_creative_design();

render_check('shoesmaterial', __('Shoes material'),  array( 
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
	));


//render_color('shoescolor', __('Shoes color'));

render_value('thecountry', __('Producing country'), 'Error', array(
	'armenia'=> __('Armenia'),  
	'usa'=> __('USA'),  
	'uae'=> __('UAE'), 
	'belarus'=> __('Belarus'), 		
	'belgium'=> __('Belgium'), 
	'bulgaria'=> __('Bulgaria'), 
	'germany'=> __('Germany'), 
	'egypt'=> __('Egypt'), 		
	'estonia'=> __('Estonia'), 	
	'turkey'=> __('Turkey'),  
	'italy'=> __('Italy'), 	
	'spain'=> __('Spain'),  	
	'iran'=> __('Iran'),  
	'latvia'=> __('Latvia'),  	
	'poland'=> __('Poland'), 
	'lithuania'=> __('Lithuania'), 	
	'south_korea'=> __('South Korea'), 
	'hungary'=> __('Hungary'), 	
	'japan'=> __('Japan'), 
	'malaysia'=> __('Malaysia'), 	
	'united_kingdom'=> __('United Kingdom'), 
	'netherlands'=> __('Netherlands'), 
	'czech'=> __('Czech'), 
	'china'=> __('China'), 
	'romania'=> __('Romania'), 
	'russia'=> __('Russia'), 	
	'georgia'=> __('Georgia'), 
	'finland'=> __('Finland'), 	
	'france'=> __('France'), 
	'other'=> __('other')
	));



///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
