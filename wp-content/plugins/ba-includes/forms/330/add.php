<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));




helper_group('general_information', __('General'));



helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );

helper_text("dcammodel", __('Camera model'), __('Please enter the model.'));




helper_select('shutterspeed', __('Shutter speed'), array( 
	array('60', '1/60 ' . __('s')),
	array('125', '1/125 ' . __('s')),
	array('250', '1/250 ' . __('s')),
	array('500', '1/500 ' . __('s')),
	array('1000', '1/1000 ' . __('s')),
	array('2000', '1/2000 ' . __('s'))
	));




//helper_group_sub('lensinfo', __('Lens'));

helper_radio('camleans', __('Camera lens'), array( 
	array(1, __('without lens')), 
	array(5, __('integrated lens')), 
	array(2, __('factory lens')), 
	array(3, __('replaced lens')), 	
	array(4, __('other')) 
	),2);


helper_textarea('cameralenstype', __('Lens options'), __('Please enter the lens options.'), _t('%s characters max', 1000), 50);


helper_slider('optzoom', __('Optical zoom'), __('Please select'), 0.5, 4, 80, '%s X');


helper_yes_no("autofocus", __('Auto focus'));


helper_radio('viewfindertype', __('Viewfinder type'), array( 
	array(1, __('Direct optical viewfinder')), 
	array(2, __('Single-lens reflex viewfinder')), 
	array(3, __('Twin-lens reflex viewfinder')), 
	array(4, __('Electronic viewfinder')), 	
	array(5, __('other')) 
	), 2);

helper_radio('photographicfilm', __('Photographic film type'), array( 
	array(1, '16 ' . __('mm')), 
	array(2, '24 ' . __('mm')), 
	array(3, '35 ' . __('mm')), 
	array(4, '61.5 ' . __('mm')), 	
	array(5, __('other')) 
	), 5);


helper_radio('lightmeter', __('Light meter'), array( 
	array(1, __('No light meter')), 
	array(2, __('Internal')), 
	array(3, __('External')), 
	array(4, __('other')) 
	));

helper_yes_no("intspeedli", __('Integrated speedlight'), true);

helper_yes_no("digitaldisplayslr", __('Digital display'), true);







helper_check('extra', __('Extra things'),  array( 
	array('extralens', __('extra lens')),
	array('extraspeedlight', __('extra speedlight')),
	array('bag', __('bag')),
	array('tripod', __('tripod')),

	) ,2);







?>