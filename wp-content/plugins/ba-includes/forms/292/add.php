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
		<?php _e('If you want to add internal device, go to:') ?>
		
		<a href="/addnew/?type=181"><?php _e('Add internal HDD') ?></a>
		</strong>	
	</p>
</div>



<?php
//////// Message //////// End //////////



helper_group('exthdd', __('External HDD'));

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


helper_check('extinterface', __('Interfaces'),  array( 
	array('usb2', 'USB2'),
	array('usb3', 'USB3'),
	array('esata', 'eSATA'),
	array('lan', 'LAN'),
	array('wireless', __('wireless')),
	array('other', __('other'))
	) );

helper_slider_by_list('hddmemorysize', __('Memory size'), __('Please select'), 1,32, '%s GB', array(
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
	32 =>  '2 ' . 'TB'
	),'1 ' . 'GB', '2 ' . 'TB');











?>


