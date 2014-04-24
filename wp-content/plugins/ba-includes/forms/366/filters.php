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
, 'title'		=>__('Offered to')
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
'id'			=>'bijouterieitem'
, 'title'		=>__('Bijouterie type')
, 'values'		=>array( 
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
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));




filter_select(array(
'id'			=>'bijouteriematerial'
, 'title'		=>__('Bijouterie material')
, 'values'		=>array( 
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




////filter_colors('bijouteriecolor', __('Bijouterie color'));

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