<?php

function CheckFormForErrors()
{
	return '';
}

helper_price();




helper_group('general_information', __('General'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	
	) );

//helper_text("furnituremodel", __('Furniture model'), __('Please enter the model.'));

helper_check('ornamentofferedto', __('Ornament is offered to'),  array( 
	array('men', __('menornament')),
	array('women', __('womenornament'))
	) );

helper_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));

helper_check('ornamenttype', __('Ornament type'),  array( 
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
	),3 );

helper_check('ornamentmaterial', __('Ornament material'),  array( 
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
	) , 4);

//helper_text("shoesbrand", __('Brand'), __('Please enter the brand.'));



helper_yes_no("handmade", __('Handmade'));


helper_creative_design();



helper_select('thecountry', __('Producing country'), array( 
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