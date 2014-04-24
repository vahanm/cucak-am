<?php


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));
	
	
//filter_text("mbmodel", __('Motherboard model'), __('Please enter desired model.'));


filter_select(array(
'id'			=>'cpusocket'
, 'title'		=>__('CPU socket')
, 'values'		=>array( 			
		array(1, '775'),  
		array(2, '1155'),     
		array(3, '1156'), 
		array(4, '1366'),
		array(5, '2011'),
		array(6, 'AM2'), 
		array(7, 'AM2+'),      
		array(8, 'AM3'),     
		array(9, 'AM3+'), 
		array(10, 'FM1'),
		array(11, __('other'))
				)
			, priority => PRIMARY_FILTER
			));



filter_select(array(
  'id'		=>'dimm_socket'
, 'title'	=>__('DIMM socket')
, 'values'	=>array( 
	array('sdr', 'SD'), 
	array('ddr', 'DDR'), 
	array('ddr2', 'DDR2'), 
	array('ddr3', 'DDR3'), 
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


filter_slider('memory_slots', __('Memory slot quantity'), 1, 2, 12, __('%s slots'));


filter_select(array(
  'id'		=>'storage_interface'
, 'title'	=>__('Storage interface')
, 'values'	=>array( 
	array('ide', 'IDE'), 
	array('sata', 'SATA'), 
	array('sata2', 'SATA2'), 
	array('sata3', 'SATA3'), 
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


filter_yes_no("usb3", 'USB3');



filter_select(array(
 'id'		=>'onboard_graphics'
, 'title'	=>__('Onboard graphics')
,'values'	=> array(
	array('none', __('none')), 
	array('dsub', 'D-Sub (VGA)'), 
	array('dvi', 'DVI-D'), 
	array('hdmi', 'HDMI')
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));




filter_select(array(
 'id'		=>'onboard_audio'
, 'title'	=>__('Onboard audio')
,'values'	=>array( 
	array('none', __('none')), 
	array('2', '2 (stereo)'), 
	array('4', '4 (quadro)'), 
	array('5', '5.1 (surround)'), 
	array('7', '7.1 (surround)'), 
	array('other', __('other'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));



?>


