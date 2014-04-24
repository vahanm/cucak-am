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


helper_check('shoestofferedto', __('Accessory is offered to'),  array( 
	array('men', __('menacc')),
	array('women', __('womenacc'))
	) );

helper_yes_no(array(
	'id'		=>	'forkids'
	,'title'	=>	__('For kids')
	,'hideNo'	=> true
	));

helper_check('accessorytype', __('Accessory type'),  array( 
	array('scarf', __('scarf')),
	array('glove', __('glove')),
	array('belt', __('belt')),
	array('tie', __('tie')),
	array('bow tie', __('bow tie')),
	array('bag', __('bag')),
	array('wallet', __('wallet')),
	array('sunglasses', __('glasses')),
	array('watch', __('watch')),
	array('other', __('other'))
	),3 );

helper_check('accessorymaterial', __('Accessory material'),  array( 
	array('leather', __('leather')),
	array('fur', __('fur')),
	array('suede', __('suede')),
	array('jeans', __('jeans')),
	array('textile', __('textile')),
	array('velour', __('velour')),
	array('rubber', __('rubber')),
	array('plastic', __('plastic')),
    array('wood', __('matwood')),	
	array('cutglass', __('cut glass')),
	array('glass', __('glass')),
	array('caoutchouc', __('caoutchouc')),
	array('cupronickel', __('cupronickel')),
	array('copper', __('copper')),
	array('steel', __('steel')),
	array('other', __('other'))
	) , 4);



helper_yes_no("handmade", __('Handmade'));


//helper_text("shoesbrand", __('Brand'), __('Please enter the brand.'));


helper_creative_design();





//helper_colors('accessorycolor', __('Accessory color'));

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