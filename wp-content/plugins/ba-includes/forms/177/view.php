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
	
render_value('rammodel', __('RAM model'), '%s' );		
	
	

render_value('slottype', __('Slot type'), 'Error', array(
		1 =>  'SD', 
		2 =>  'DDR', 
		3 =>  'DDR2', 
		4 =>  'DDR3', 
		5 =>  __('other')
	));
		
render_value('memorysize', __('Memory size'), '%s Mb', array(		
		1 => '128 ' . 'MB', 
		2 => '256 ' . 'MB', 
		3 => '512 ' . 'MB', 
		4 => '1 ' . 'GB', 
		5 => '2 ' . 'GB', 
		6 => '4 ' . 'GB', 
		7 => '8 ' . 'GB', 
		8 => '16 ' . 'GB' 
	));
		 
	

	

///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));
	
render_value('ramfrequency', __('Frequency'), 'MHz', array(	
		1 => '400 ' . 'MHz', 
		2 => '533 ' . 'MHz', 
		3 => '667 ' . 'MHz', 
		4 => '800 ' . 'MHz', 
		5 => '1066 ' . 'MHz', 
		6 => '1333 ' . 'MHz', 
		7 => '1600 ' . 'MHz', 
		8 => '1866 ' . 'MHz',
		9 => '2133 ' . 'MHz'
	));

render_yes_no("radiator", __('Radiator'));

render_yes_no("warranty", __('Lifetime warranty'));

render_yes_no("forlaptop", __('For laptop'));	
///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
