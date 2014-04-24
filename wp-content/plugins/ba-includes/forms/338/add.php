<?php

function CheckFormForErrors()
{
	return '';
}

helper_price(array('allow_donation' => false));




helper_group('general_information', __('General'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
	array(1, __('new')),  
	array(2, __('used')),  
	array(3, __('broken')) 
	
	) );

helper_text("furnituremodel", __('Furniture model'), __('Please enter the model.'));

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


helper_check('furnituretype', __('Furniture type'),  array( 
    array('kitchen', __('kitchen')),
    array('diningroom', __('dining room')),
    array('livingroom', __('living room')),
    array('bedroom', __('bedroom')),
    array('bathroom', __('bathroom')),
    array('office', __('office')),
    array('outdoorfurniture', __('outdoor furniture')),
    array('storehouse', __('storehouse')),
    array('exposition', __('exposition')),
    array('other', __('other'))
    ), 3,4);

helper_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


helper_check('usedmaterials', __('Used materials'),  array( 
	array('naturalwood', __('natural wood')),
	array('woodchipboard', __('wood chipboard')),
	array('laminat', __('laminat')),
	array('fibreboard', __('fibreboard')),
	array('mdf', __('MDF')),
	array('pvc', __('PVC')),
	array('plastic', __('plastic')),
	array('tamburat', __('tamburat')),
	array('leather', __('leather')),		
	array('glass', __('furglass')),
	array('mirror', __('mirror')),	
	array('metal', __('metal')),
	array('naturalstone', __('natural stone')),	
	array('artificialstone', __('artificial stone')),		
	array('other', __('other'))
	),3,6 );




helper_check('piecesoffurniture', __('Pieces of furniture'),  array( 
	array('tabouret', __('tabouret')),
	array('chair', __('chair')),
	array('computerchair', __('computer chair')),
	array('rockingchair', __('rocking chair')),
	array('couch', __('couch')),
	array('armchair', __('armchair')),
	array('sofa', __('sofa')),
	array('bed', __('bed')),
	array('table', __('table')),
	array('coffeetable', __('coffee table')),
	array('computertable', __('computer table')),	
	array('pierglass', __('pier-glass')),	
	array('wardrobe', __('wardrobe')),
	array('secretaire', __('secretaire')),
	array('bookcase', __('bookcase')),
	array('bedsidetable', __('bedside table')),
	array('cupboard', __('cupboard')),
	array('sideboard', __('sideboard')),
	array('inflatablefurniture', __('inflatable furniture')),	
	array('chandelier', __('chandelier')),
	array('hanger', __('hanger')),
	array('pillow', __('pillow')),
	array('blind', __('blind')),
	array('carpet', __('carpet')),
	array('other', __('other'))	) , 3,8);

helper_colors('furcolor', __('Furniture color'));


helper_creative_design();



?>