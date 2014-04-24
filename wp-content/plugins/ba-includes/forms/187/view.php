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

render_value('webcammodel', __('Web camera model'), '%s ' );	

render_value('webresolution', __('Resolution'), '%s MP');






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));

render_yes_no("autofocus", __('Auto focus'));

render_yes_no("webbuiltinmic", __('Built-in microphone'));

render_yes_no("ledlights", __('LED lights'));

//render_creative_design();



///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
