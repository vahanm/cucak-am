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

render_check('shoestofferedto', __('Offered to'),  array( 
	array('men', __('men')),
	array('women', __('women'))
	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));



//render_value('shoesbrand', __('Brand'), '%s ' );	

render_check('bijouterieitem', __('Bijouterie type'),  array( 
	array('necklace', __('necklace')),
	array('bracelet', __('bracelet')),
	array('beads', __('beads')),
	array('ring', __('ring')),
	array('earrings', __('earrings')),
    array('pendent', __('pendent')),
    array('brooc', __('brooc')),
	array('hairpin', __('hairpin')),
    array('trinket', __('trinket')),
    array('other', __('other'))
	) );



///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));



render_check('bijouteriematerial', __('Bijouterie material'),  array( 
	array('pearls', __('pearls')),
	array('garnet', __('garnet')),
	array('turquoise', __('turquoise')),
	array('emerald', __('emerald')),
	array('jacinth', __('jacinth')),
	array('ruby', __('ruby')),
	array('coral', __('coral')),
	array('agate', __('agate')),
	array('amber', __('amber')),
	array('obsidian', __('obsidian')),
	array('cutglass', __('cut glass')),
	array('glass', __('glass')),
	array('caoutchouc', __('caoutchouc')),
	array('cupronickel', __('cupronickel')),
	array('copper', __('copper')),
	array('steel', __('steel')),
	array('leather', __('leather')),
	array('fur', __('fur')),
	array('suede', __('suede')),
	array('jeans', __('jeans')),
	array('plastic', __('plastic')),
    array('wood', __('matwood')),
    array('clay', __('clay')),
	array('other', __('other'))
	));

render_yes_no("handmade", __('Handmade'));

render_creative_design();


//render_color('bijouteriecolor', __('Bijouterie color'));

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
