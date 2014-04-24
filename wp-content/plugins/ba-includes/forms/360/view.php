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

render_check('ornamentofferedto', __('Ornament is offered to'),  array( 
	array('men', __('menornament')),
	array('women', __('womenornament'))
	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


render_check('ornamenttype', __('Ornament type'),  array( 
	array('bracelet', __('bracelet')),
	array('braceletsfeet', __('bracelet for feet')),
	array('brooc', __('brooc')),
	array('beads', __('beads')),
	array('stumbling', __('stumbling')),
	array('ring', __('ring')),
	array('earrings', __('earrings')),
	array('pendent', __('pendent')),
	array('medallion', __('medallion')),
	array('necklace', __('necklace')),
	array('chain', __('chain')),
	array('watch', __('watch')),
	array('other', __('other'))
	) );



///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));



render_check('ornamentmaterial', __('Ornament material'),  array( 
array('platin', __('platin')),
array('gold', __('gold')),
array('silver', __('silver')),
array('cupronickel', __('cupronickel')),
array('diamond', __('diamond')),
array('diamond_almaz', __('diamond(almaz)')),
array('zircon', __('zircon')),
array('emerald', __('emerald')),
array('garnet', __('garnet')),
array('pearls', __('pearls')),
array('alexandrite', __('alexandrite')),
array('ruby', __('ruby')),
array('malachite', __('malachite')),
array('coral', __('coral')),
array('rockcrystal', __('rock crystal')),
array('aquamarine', __('aquamarine')),
array('turquoise', __('turquoise')),
array('agate', __('agate')),
array('sapphire', __('sapphire')),
array('amethyst', __('amethyst')),
array('opal', __('opal')),
array('topaz', __('topaz')),
array('tiger eye', __('tiger eye')),
array('amber', __('amber')),
array('jasper', __('jasper')),
array('obsidian', __('obsidian')),
array('onyx', __('onyx')),
	array('other', __('other'))
	));


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
