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

render_value('mbmodel', __('Motherboard model'), '%s ' );	

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
		

render_check('dimm_socket', __('DIMM socket'),  array( 
		array('sdr', 'SD'), 
		array('ddr', 'DDR'), 
		array('ddr2', 'DDR2'), 
		array('ddr3', 'DDR3'), 
		array('other', __('other'))
			) );




render_value('memory_slots', __('Memory slot quantity'), '%s' );




render_check('storage_interface', __('Storage interface'),  array( 
				array('ide', 'IDE'), 
				array('sata', 'SATA'), 
				array('sata2', 'SATA2'), 
				array('sata3', 'SATA3'), 
				array('other', __('other'))
			) );




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////




render_group_sub(__('Features'));

render_yes_no("usb3", 'USB3');




render_check_key('onboard_graphics', __('Onboard graphics'), array('none', 'image:no'), array( 
				array('dsub', 'D-Sub (VGA)'), 
				array('dvi', 'DVI-D'), 
				array('hdmi', 'HDMI')
				) );
				

render_check_key('onboard_audio', __('Onboard audio'), array('none', 'image:no'), array( 
				array('2', '2 (stereo)'), 
				array('4', '4 (quadro)'), 
				array('5', '5.1 (surround)'), 
				array('7', '7.1 (surround)'), 
				array('other', __('other'))
				) );





///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
