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
	
render_value('videocardmodel', __('Video card model'), '%s ' );		
	
	

render_value('sdramtype', __('SDRAM type'), 'Error', array(
		1 =>  'DDR', 
		2 =>  'DDR2', 
		3 =>  'GDDR3', 
		4 =>  'GDDR4', 
		5 =>  'GDDR5', 		
		6 =>  __('other')
	));
		
render_value('videomemorysize', __('Memory size'), 'Error', array(		
		1 => '64 ' . 'MB', 
		2 => '128 ' . 'MB', 
		3 => '256 ' . 'MB', 
		4 => '512 ' . 'MB', 
		5 => '1 ' . 'GB', 
		6 => '1.5 ' . 'GB', 
		7 => '2 ' . 'GB', 
		8 => '3 ' . 'GB', 
		9 => '4 ' . 'GB' 
	));
		 
	

render_value('memintewidth', __('Memory interface width'), __('%s bit'), array(			
	1 => _t('%s bit', 16), 
	2 => _t('%s bit', 32),
	3 => _t('%s bit', 64),
	4 => _t('%s bit', 128),
	5 => _t('%s bit', 256),
	6 => _t('%s bit', 384),
	7 => _t('%s bit', 512),
	8 => _t('%s bit', 1024)
	));
	
	

render_value('slotetype', __('Slot type'), 'Error', array(			
		1 => 'PCI' , 
		2 => 'AGP 1x' , 
		3 => 'AGP 2x' , 
		4 => 'AGP 4x' , 
		5 => 'AGP 8x' , 
		6 => 'PCIe x1' , 
		7 => 'PCIe x4' , 
		8 => 'PCIe x8' , 
		9 => 'PCIe x16' , 
		10 => 'PCIe x16 2.0' , 
		11 => 'PCIe X1 3.0' , 
		12 => 'PCIe X4 3.0' , 
		13 => 'PCIe X8 3.0' , 
		14 => 'PCIe X16 3.0' , 
		15 => __('other')
	));
	

	
	
	
		
render_check('display_connectors', __('Display connectors'),  array( 
				array('vga', 'VGA'),
				array('dvi', 'DVI'),
				array('hdmi', 'HDMI'),
				array('compositevideo', 'Composite video'),
				array('svideo', 'S-Video'),
				array('compvideo', 'Component video'),
				array('dms', 'DMS-59'),
				array('displayport', 'DisplayPort')
	) );




///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
render_group_sub(__('Features'));



render_value('directx', 'DirectX', 'Error', array(
	1 => '8', 
	2 => '9', 
	3 => '10', 
	4 => '10.1', 
	5 => '11', 
	6 => '11.1', 
	7 => '12'
	));







render_yes_no("3dvision", '3D Vision/AMD HD3D');

render_yes_no("cuda", 'CUDA');

render_yes_no("physx", 'PhysX');

render_yes_no("sli", 'SLI/AMD CrossFire™');

render_yes_no("adaptivevsync", 'Adaptive VSync');

render_yes_no("gpuboost", 'GPU Boost');

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
