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

render_value('coolermodel', __('Cooler model'), '%s ' );	





///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));


render_check_key('cpusocket', __('CPU socket'), array('notforcpu', __('not for CPU')), array( 			
	array('775', '775'), 
	array('1155', '1155'), 
	array('1156', '1156'), 
	array('1366', '1366'), 
	array('2011', '2011'), 
	array('am2', 'AM2'), 
	array('am21', 'AM2+'), 
	array('am3', 'AM3'), 
	array('am31', 'AM3+'), 
	array('fm1', 'FM1'), 
	array('other', __('other')) 
	));

render_yes_no("fanspeedcontrol", __('Fan speed control'));

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
