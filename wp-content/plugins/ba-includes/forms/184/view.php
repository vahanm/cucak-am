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

render_value('speakermodel', __('Speakers model'), '%s ' );		

render_value('speaker_system', __('Speakers system'), '%s', array(
	1 => '2.0 (stereo)', 
	2 => '2.1 (stereo)', 
	3 => '4.0 (quadro)', 
	4 => '4.1 (quadro)', 
	5 => '5.1 (surround)', 
	6 => '7.1 (surround)'
	));






///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));

render_value('watts', __('RMS watts'), __('%s Watts'));


render_yes_no("remotecontrol", __('Remote control'));

render_yes_no("5input", __('5.1 input'));


render_creative_design();


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
