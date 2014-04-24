<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));

helper_group('motherboardgroup', __('Motherboard'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("mbmodel", __('Motherboard model'), __('Please enter the model.'));


helper_select('cpusocket', __('CPU socket'), array( 			
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
		) );
	


helper_check('dimm_socket', __('DIMM socket'),  array( 
	array('sdr', 'SD'), 
	array('ddr', 'DDR'), 
	array('ddr2', 'DDR2'), 
	array('ddr3', 'DDR3'), 
	array('other', __('other'))
	) , 5);



helper_slider('memory_slots', __('Memory slot quantity'), __('Please select'), 1, 2, 12, __('%s slots'));


helper_check('storage_interface', __('Storage interface'),  array( 
	array('ide', 'IDE'), 
	array('sata', 'SATA'), 
	array('sata2', 'SATA2'), 
	array('sata3', 'SATA3'), 
	array('other', __('other'))
	), 5 );


helper_yes_no("usb3", 'USB3');



helper_check_key('onboard_graphics', __('Onboard graphics'), array('none', __('none')), array( 
				array('dsub', 'D-Sub (VGA)'), 
				array('dvi', 'DVI-D'), 
				array('hdmi', 'HDMI')
				) );
				
				

helper_check_key('onboard_audio', __('Onboard audio'), array('none', __('none')), array( 
	array('2', '2 (stereo)'), 
	array('4', '4 (quadro)'), 
	array('5', '5.1 (surround)'), 
	array('7', '7.1 (surround)'), 
	array('other', __('other'))
	),5 );


?>


