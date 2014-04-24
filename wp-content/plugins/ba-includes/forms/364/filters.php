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
  'id'			=>'clotofferedto'
, 'title'		=>__('Clothing is offered to')
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
  'id'			=>'clothingitem'
, 'title'		=>__('Garment')
, 'values'		=>array( 
	array('trousers', __('trousers')),
	array('shorts', __('shorts')),
	array('skirt', __('skirt')),
	array('dress', __('dress')),
	array('underwear', __('underwear')),
	array('tshirt', __('t-shirt')),			
	array('shirt', __('shirt')),
	array('sweater', __('sweater')),
	array('waistcoat', __('waistcoat')),
	array('jacket', __('jacket')),
	array('coat', __('coat')),
	array('suit', __('suit')),
	array('cloak', __('cloak')),	
	array('topcoat', __('topcoat')),	
	array('furcoat', __('fur coat')),
	array('hat', __('headgear')),
	array('other', __('other'))
				)
, byKeys => true
, priority => PRIMARY_FILTER
	));


//filter_text("clothingbrand", __('Brand'), __('Please enter the brand.'));






filter_select(array(
  'id'			=>'wearingseason'
, 'title'		=>__('Season')
, 'values'		=>array( 
	array('allseason', __('for all seasons')),
	array('spring', __('spring')),
	array('summer', __('summer')),
	array('autumn', __('autumn')),
	array('winter', __('winter')),
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));




filter_select(array(
  'id'			=>'clothingtype'
, 'title'		=>__('Clothing type')
, 'values'		=>array( 
	array('everydayclothes', __('everyday clothes')),
	array('sportswear', __('sportswear')),
	array('uniform', __('uniform')),
	array('eveninggown', __('evening gown')),
	array('stagecostumes', __('stage costumes')),
	array('weddingdress', __('wedding dress')),
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


filter_creative_design();




filter_check('clothtype', __('Cloth type'),  array( 
	array('wool', __('wool')),
	array('cotton', __('cotton')),
	array('silk', __('silk')),
	array('jeans', __('jeans')),
	array('guipure', __('guipure')),
	array('velours', __('velours')),
	array('velveteen', __('velveteen')),
	array('velvet', __('velvet')),
	array('panne', __('panne')),
	array('suede', __('suede')),
	array('fur', __('fur')),
	array('leather', __('leather')),
	array('flax', __('flax')),
	array('chintz', __('chintz')),
	array('batiste', __('batiste')),
	array('staple', __('staple')),
	array('cashmere', __('cashmere')),
	array('chiffon', __('chiffon')),
	array('thick cloth', __('thick cloth')),
	array('canvas', __('canvas')),
	array('other', __('other'))
	) , 1);


////filter_colors('clothingcolor', __('Clothing color'));

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