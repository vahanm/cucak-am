<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false));


//////// Message ///////// BEGIN /////////

helper_group_required('attention', __('Attention'));
?>

<div class="addpostinnerdiv">
	<p>
		<strong>
		<?php _e('If you want to add external device, go to:') ?>
		
		<a href="/addnew/?type=292"><?php _e('Add external HDD') ?></a>
		</strong>	
	</p>
</div>



<?php
//////// Message //////// End //////////



helper_group('hdd', __('HDD'));

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("hddmodel", __('HDD model'), __('Please enter the model.'));

helper_radio('form_factor', __('Form factor'), array( 
		array(1, '1.8"'),  
		array(2, '2.5"'),  
		array(3, '3.5"')
	) );
	
	

helper_select('interface', __('Interface type'), array( 			
		array(1, 'ATA/IDE (133MB/s)'),  
		array(2, 'SATA-1 (1.5GB/s)'),     
		array(3, 'SATA-2 (3GB/s)'), 
		array(4, 'SATA-3 (6GB/s)'),
		array(5, 'SAS (6GB/s)'),     
		array(6, 'Fibre Channel (4GB/s)'), 
		array(7, 'SCSI (Ultra 320)'),
		array(8, __('other'))
		) );



helper_slider_by_list('hddmemorysize', __('Memory size'), __('Please select'), 1,34, '%s GB', array(
	21 => '40 ' . 'GB', 
	22 => '80 ' . 'GB', 
	23 => '120 ' . 'GB', 
	24 => '160 ' . 'GB', 
	25 =>  '250 ' . 'GB',
	26 =>  '320 ' . 'GB',
	27 =>  '500 ' . 'GB',
	28 =>  '640 ' . 'GB',
	29 =>  '750 ' . 'GB',
	30 =>  '1 ' . 'TB',
	31 =>  '1.5 ' . 'TB',
	32 =>  '2 ' . 'TB',
	33 =>  '3'  . 'TB',
	34 =>  '4'  . 'TB'
	),'1 ' . 'GB', '4 ' . 'TB');
	




helper_slider_by_list('rotational_speed', __('Rotational speed'), __('Please select'), 1,5, '%s RPM', array(
	1 => '4800 ' . 'RPM', 
	2 => '5400 ' . 'RPM', 
	3 => '7200 ' . 'RPM', 
	4 => '10000 ' . 'RPM', 
	5 => '15000 ' . 'RPM', 
	), '4800 ' . 'RPM', '15000 ' . 'RPM');
	
	
		
helper_slider_by_list('cache', __('Cache size'), __('Please select'), 1,10, '%s MB', array(
	1 => '512 ' . 'KB', 
	2 => '1 ' . 'MB', 
	3 => '2 ' . 'MB', 
	4 => '4 ' . 'MB', 
	5 => '8 ' . 'MB', 
	6 => '16 ' . 'MB', 
	7 => '32 ' . 'MB', 
	8 => '64 ' . 'MB', 
	9 => '128 ' . 'MB', 
	10 => '256 ' . 'MB', 
	), '512 ' . 'KB', '256 ' . 'MB');


helper_yes_no("forlaptop", __('For laptop'));	
	
?>


