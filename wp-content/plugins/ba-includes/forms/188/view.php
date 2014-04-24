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

render_value('casemodel', __('Case model'), '%s ' );	








///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Features'));
render_value('power', __('Power supply'), __('%s W'), array(0 => 'image:no'));



render_check('frontconnectors', __('Front connectors'),  array( 
	array('mic', __('microphonecase')), 
	array('headphone', __('headphones')), 
	array('usb', 'USB'), 
	array('extsata', 'eSATA'), 
	array('1394', '1394')
	) );



render_creative_design();



///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
