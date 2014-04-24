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

helper_check('shoestofferedto', __('Offered to'),  array( 
	array('men', __('men')),
	array('women', __('women'))
	) );

helper_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));

//helper_text("furnituremodel", __('Furniture model'), __('Please enter the model.'));

helper_check('bijouterieitem', __('Bijouterie type'),  array( 
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
	),3 );

helper_check('bijouteriematerial', __('Bijouterie material'),  array( 
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
	) , 3);

//helper_text("shoesbrand", __('Brand'), __('Please enter the brand.'));



helper_yes_no("handmade", __('Handmade'));

//helper_colors('bijouteriecolor', __('Bijouterie color'));


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