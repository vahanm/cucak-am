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

render_value('headphonemodel', __('Headphones model'), '%s ' );		


render_value('speakerquantity', __('Speaker quantity'), 'Error', array(
	1 => '1 ' .__('headspeaker'), 
	2 => '2 ' .__('headspeakers')
	));




render_yes_no("microphone", __('Microphone'));

render_yes_no("volume_control", __('Volume controller'));

render_yes_no("35mmjack", __('3.5 mm audio jack'));





///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));

render_yes_no("vacuum", __('Vacuum-ear'));

render_yes_no("wireless", __('Wireless'));

render_yes_no("vibration", __('Vibration'));

render_yes_no("usbinput", __('USB input'));

render_yes_no("mp3player", __('Integrated mp3 player'));

render_yes_no("radio", __('Integrated radio'));


render_creative_design();

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

