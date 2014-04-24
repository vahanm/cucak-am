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

render_value('keyboardmodel', __('Keyboard model'), '%s ' );		

render_check('interface', __('Interface'),  array( 
	array('usb', 'USB'), 
	array('ps', 'PS/2'), 
	array('wireless', __('wireless'))
	) );






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));

render_yes_no("multimedia", __('Multimedia'));

render_yes_no("backlights", __('Backlights'));


render_creative_design();


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
