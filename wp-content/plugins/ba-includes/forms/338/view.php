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
	3 => __('broken'), 
	4 => __('other')
	));

render_check('furnituretype', __('Furniture type'),  array( 
	array('kitchen', __('kitchen')),
	array('diningroom', __('dining room')),
	array('livingroom', __('living room')),
	array('bedroom', __('bedroom')),
	array('bathroom', __('bathroom')),
	array('office', __('office')),
	array('outdoorfurniture', __('outdoor furniture')),
    array('storehouse', __('storehouse')),
    array('exposition', __('exposition')),
    array('other', __('other'))	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


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



render_value('furnituremodel', __('Furniture model'), '%s' );		




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));

render_color('furcolor', __('Furniture color'));

render_check('usedmaterials', __('Used materials'),  array( 
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
	) );


render_check('piecesoffurniture', __('Pieces of furniture'),  array( 
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
	array('other', __('other'))
	));



render_creative_design();


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
