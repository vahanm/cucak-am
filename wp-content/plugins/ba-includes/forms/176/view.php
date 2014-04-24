<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('General'));

render_item_status();


render_location('item_location', __('Item location'));



render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used')
	));

render_value('cpu', __('CPU (processor) model'), '%s ' );	

render_value('cpusocket', __('CPU socket'), 'Error', array(
		1 =>  '775', 
		2 =>  '1155', 
		3 =>  '1156', 
		4 =>  '1366', 
		5 =>  '2011', 
		6 =>  'AM2', 
		7 =>  'AM2+', 
		8 =>  'AM3', 
		9 =>  'AM3+', 
		10 =>  'FM1', 
		11 =>  __('other')
	));
		
	

render_value('cpufrequency', __('Frequency'), '%s ' . 'GHz');	

render_value('core', __('Core quantity'), '%s ' . __('cores'));	

render_value('cache', __('Cache size'), 'Error', array(
	1 => '128 ' . 'KB',
	2 => '256 ' . 'KB',
	3 => '512 ' . 'KB',
	4 => '1 ' . 'MB',
	5 => '2 ' . 'MB',
	6 => '3 ' . 'MB',
	7 => '4 ' . 'MB',
	8 => '5 ' . 'MB',
	9 => '6 ' . 'MB',
	10 => '7 ' . 'MB',
	11 => '8 ' . 'MB',
	12 => '9 ' . 'MB',
	13 => '10 ' . 'MB',
	14 => '11 ' . 'MB',
	15 => '12 ' . 'MB',
	16 => '13 ' . 'MB',
	17 => '14 ' . 'MB',
	18 => '15 ' . 'MB'
	));


	
		
		






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));

render_yes_no("hyper_threading", 'Hyper Threading');

render_yes_no("turbo_boost", 'Turbo Boost');

render_yes_no("integrated_graphics", __('Integrated graphics'));

render_value('instruction_set', __('Instruction set'), 'Error', array(
	1 => _t('%s bit', 32), 
	2 => _t('%s bit', 64), 
	));




render_value('lithography', __('Lithography'), 'Error', array(
	1 =>  _t('%s nm', 11), 
	2 =>  _t('%s nm', 16),  
	3 =>  _t('%s nm', 22),  
	4 => _t('%s nm', 32), 
	5 => _t('%s nm', 45),  
	6 =>  _t('%s nm', 65), 
	7 =>  _t('%s nm', 90), 
	8 =>  __('other')
	));

render_yes_no("cooler", __('Cooler'));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
