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
	

	
render_value('dcammodel', __('Camera model'), '%s' );		

	
//render_color('phonecolor', __('Phone color'));



	
	
render_value('shutterspeed', __('Shutter speed'), 'Error', array(
	'60' =>'1/60 ' . __('s'),
	'125' =>'1/125 ' . __('s'),
	'250' =>'1/250 ' . __('s'),
	'500' =>'1/500 ' . __('s'),
	'1000' =>'1/1000 ' . __('s'),
	'2000' =>'1/2000 ' . __('s')
	));



render_value('camleans', __('Camera lens'), 'Error', array(
	1 => __('without lens'), 
	5 => __('integrated lens'), 
	2 => __('factory lens'), 
	3 => __('replaced lens'),
	4 => __('other')
	));


render_value('cameralenstype', __('Lens options'), '%s ' );



render_value('optzoom', __('Optical zoom'), '%s X');	


render_yes_no("autofocus", __('Auto focus'));


///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));



render_value('viewfindertype', __('Viewfinder type'), 'Error', array(
	1 =>  __('Direct optical viewfinder'), 
	2 =>  __('Single-lens reflex viewfinder'), 
	3 =>  __('Twin-lens reflex viewfinder'), 
	4 =>  __('Electronic viewfinder'), 	
	5 =>  __('other') 
	));

render_value('photographicfilm', __('Photographic film type'), 'Error', array(
	1 =>  '16 ' . __('mm'), 
	2 =>  '24 ' . __('mm'), 
	3 =>  '35 ' . __('mm'), 
	4 =>  '61.5 ' . __('mm'),
	5 =>  __('other') 
	));

render_value('lightmeter', __('Light meter'), 'Error', array(
	1 =>  __('No light meter'), 
	2 =>  __('Internal'), 
	3 =>  __('External'), 
	4 =>  __('other')
	));

render_yes_no("intspeedli", __('Integrated speedlight'));

render_yes_no("digitaldisplayslr", __('Digital display'));


render_check('extra', __('Extra things'),  array( 
	array('extralens', __('extra lens')),
	array('extraspeedlight', __('extra speedlight')),
	array('bag', __('bag')),
	array('tripod', __('tripod')),
	));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
