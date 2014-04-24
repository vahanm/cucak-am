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

render_check('clotofferedto', __('Clothing is offered to'),  array( 
	array('men', __('men')),
	array('women', __('women'))
	) );

render_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));


render_value('clothingbrand', __('Brand'), '%s ' );	

render_check('clothingitem', __('Garment'),  array( 
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
	) );



render_check_key('wearingseason', __('Season'), array('allseason', __('for all seasons')), array( 
	array('spring', __('spring')),
	array('summer', __('summer')),
	array('autumn', __('autumn')),
	array('winter', __('winter')),
	) );










///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////



render_group_sub(__('Features'));


render_check('clothingtype', __('Clothing type'),  array( 
	array('everydayclothes', __('everyday clothes')),
	array('sportswear', __('sportswear')),
	array('uniform', __('uniform')),
	array('eveninggown', __('evening gown')),
	array('stagecostumes', __('stage costumes')),
	array('weddingdress', __('wedding dress')),
	array('other', __('other'))
	) );



render_creative_design();

render_check('clothtype', __('Cloth type'),  array( 
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
	) );


//render_color('clothingcolor', __('Clothing color'));

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
