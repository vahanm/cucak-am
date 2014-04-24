<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));

render_location('item_location', __('Land area location'));

render_value('address', __('Address'), '%s ' );


render_number('land_area', __('Size of the land area'), array(
	1 => __('square metres'), 
	2 => __('hectare')
	));	 


render_yes_no("lodge", __('Lodge'));


render_check_key('greenhouse', __('Greenhouse'), array('none', 'image:no'), array( 
	array('plastic', __('plastic')), 
	array('glass', __('from glass')),
	array('other', __('other'))
	) );


render_yes_no("orchard", __('Orchard'));




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////


render_group_sub(__('Additional'));

render_yes_no("fenced", __('Fenced'));

render_yes_no("irrigation_water", __('Irrigation water'));

render_value('container', __('Water container'), __('%s ton'));

render_yes_no("drinkingwater", __('Drinking water'));
		
render_value('gas', __('Gas existence'), 'Error', array(
	1 => 'image:no', 
	2 => 'image:yes', 
	3 => __('possible')
	));


render_yes_no("electricity", __('Electricity'));




///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
