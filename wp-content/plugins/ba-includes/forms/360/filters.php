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

//filter_text("furnituremodel", __('Furniture model'), __('Please enter desired model.'));

filter_select(array(
'id'			=>'ornamentofferedto'
, 'title'		=>__('Ornament is offered to')
, 'values'		=>array( 
	array('men', __('menornament')),
	array('women', __('womenornament'))
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

filter_select(array(
'id'			=>'ornamenttype'
, 'title'		=>__('Ornament type')
, 'values'		=>array( 
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
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));

filter_select(array(
'id'			=>'ornamentmaterial'
, 'title'		=>__('Ornament material')
, 'values'		=>array( 
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
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));

//filter_text("shoesbrand", __('Brand'), __('Please enter the brand.'));



filter_yes_no(array(
	'id'			=>"handmade"
	, 'title'		=>__('Handmade')
	, priority => PRIMARY_FILTER
	));



filter_creative_design();




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