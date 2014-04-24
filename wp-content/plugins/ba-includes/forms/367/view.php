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

//render_value('shoesbrand', __('Brand'), '%s ' );	

render_check('shoestofferedto', __('Accessory is offered to'),  array( 
	array('men', __('menacc')),
	array('women', __('womenacc'))
	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));



render_check('accessorytype', __('Accessory type'),  array( 
	array('scarf', __('scarf')),
	array('glove', __('glove')),
	array('belt', __('belt')),
	array('tie', __('tie')),
	array('bow tie', __('bow tie')),
	array('bag', __('bag')),
	array('wallet', __('wallet')),
	array('sunglasses', __('glasses')),
	array('watch', __('watch')),
	array('other', __('other'))
	) );



///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));



render_check('accessorymaterial', __('Accessory material'),  array( 
	array('leather', __('leather')),
	array('fur', __('fur')),
	array('suede', __('suede')),
	array('jeans', __('jeans')),
	array('textile', __('textile')),
	array('velour', __('velour')),
	array('rubber', __('rubber')),
	array('plastic', __('plastic')),
    array('wood', __('matwood')),	
	array('cutglass', __('cut glass')),
	array('glass', __('glass')),
	array('caoutchouc', __('caoutchouc')),
	array('cupronickel', __('cupronickel')),
	array('copper', __('copper')),
	array('steel', __('steel')),
	array('other', __('other'))
	));


//render_color('accessorycolor', __('Accessory color'));

render_yes_no("handmade", __('Handmade'));




render_creative_design();


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
