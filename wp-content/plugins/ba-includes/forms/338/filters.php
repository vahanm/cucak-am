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
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));
	

//filter_text("furnituremodel", __('Furniture model'), __('Please enter desired model.'));

filter_select(array(
  'id'			=>'thecountry'
, 'title'		=>__('Producing country')
, 'values'		=>array( 
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
		)
, priority => PRIMARY_FILTER
	));


filter_select(array(
  'id'			=>'furnituretype'
, 'title'		=>__('Furniture type')
, 'values'		=>array( 
	array('kitchen', __('kitchen')),
	array('diningroom', __('dining room')),
	array('livingroom', __('living room')),
	array('bedroom', __('bedroom')),
	array('bathroom', __('bathroom')),
	array('office', __('office')),
	array('outdoorfurniture', __('outdoor furniture')),
    array('storehouse', __('storehouse')),
    array('exposition', __('exposition')),
    array('other', __('other')))
	, byKeys => true
	, priority => PRIMARY_FILTER
	));


filter_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


filter_select(array(
  'id'			=>'usedmaterials'
, 'title'		=>__('Used materials')
	, 'values'		=>array( 
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
				array('other', __('other')))
	, byKeys => true
	, priority => PRIMARY_FILTER
	));





filter_select(array(
  'id'			=>'piecesoffurniture'
, 'title'		=>__('Pieces of furniture')
, 'values'		=>array( 
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
	array('other', __('other'))	) 
	, byKeys => true
	, priority => PRIMARY_FILTER
	));

//filter_colors('furcolor', __('Furniture color'));




filter_creative_design();



?>