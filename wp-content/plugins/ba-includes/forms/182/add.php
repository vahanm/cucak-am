<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));


helper_group('videocard', __('Video card'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
		

	
helper_text("videocardmodel", __('Video card model'), __('Please enter the model.'));


helper_select('sdramtype', __('SDRAM type'), array( 			
		array(1, 'DDR'),  
		array(2, 'DDR2'),     
		array(3, 'GDDR3'), 
		array(4, 'GDDR4'),
		array(5, 'GDDR5'),
		array(6, __('other'))
		) );
		
		
helper_slider_by_list('videomemorysize', __('Memory size'), __('Please select'), 1, 9, '%s MB', array(
	1 => '64 ' . 'MB', 
	2 => '128 ' . 'MB', 
	3 => '256 ' . 'MB', 
	4 => '512 ' . 'MB', 
	5 => '1 ' . 'GB', 
	6 => '1.5 ' . 'GB', 
	7 => '2 ' . 'GB', 
	8 => '3 ' . 'GB', 
	9 => '4 ' . 'GB' 
	), '64 ' . 'MB', '4 ' . 'GB');

helper_slider_by_list('memintewidth', __('Memory interface width'), __('Please select'), 1, 8, __('%s bit'), array(
	1 => _t('%s bit', 16), 
	2 => _t('%s bit', 32),
	3 => _t('%s bit', 64),
	4 => _t('%s bit', 128),
	5 => _t('%s bit', 256),
	6 => _t('%s bit', 384),
	7 => _t('%s bit', 512),
	8 => _t('%s bit', 1024)
	),_t('%s bit', 16),_t('%s bit', 1024));


	

helper_select('slotetype', __('Slot type'), array( 			
		array(1, 'PCI'),  
		array(2, 'AGP 1x'),     
		array(3, 'AGP 2x'), 
		array(4, 'AGP 4x'),
		array(5, 'AGP 8x'),
		array(6, 'PCIe x1'),  
		array(7, 'PCIe x4'),     
		array(8, 'PCIe x8'), 
		array(9, 'PCIe x16'),
		array(10, 'PCIe x16 2.0'),
		array(11, 'PCIe X1 3.0'),  
		array(12, 'PCIe X4 3.0'),     
		array(13, 'PCIe X8 3.0'), 
		array(14, 'PCIe X16 3.0'),
		array(15, __('other'))
		) );
		
		
		
		
		
		
		
		
		
helper_check('display_connectors', __('Display connectors'),  array( 
				array('vga', 'VGA'),
				array('dvi', 'DVI'),
				array('hdmi', 'HDMI'),
				array('compositevideo', 'Composite video'),
				array('svideo', 'S-Video'),
				array('compvideo', 'Component video'),
				array('dms', 'DMS-59'),
				array('displayport', 'DisplayPort')
			) );




helper_radio('directx', 'DirectX', array( 
	array(1, '8'),  
	array(2, '9'),  
	array(3, '10'), 
	array(4, '10.1'), 
	array(5, '11'), 
	array(6, '11.1'), 
	array(7, '12')
	) ,7);


helper_yes_no("3dvision", '3D Vision/AMD HD3D', true);

helper_yes_no("cuda", 'CUDA', true);

helper_yes_no("physx", 'PhysX', true);

helper_yes_no("sli", 'SLI/AMD CrossFire™', true);

helper_yes_no("adaptivevsync", 'Adaptive VSync', true);

helper_yes_no("gpuboost", 'GPU Boost', true);

?>


