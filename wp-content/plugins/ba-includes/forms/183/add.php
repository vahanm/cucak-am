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
		
		<a href="/addnew/?type=290"><?php _e('Add external optical device') ?></a>
		</strong>	
	</p>
</div>



<?php
//////// Message //////// End //////////




helper_group('dvdcd', __('Blu-Ray / DVD / CD'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
		array(1, __('new')),  
		array(2, __('used')),  
		array(3, __('broken')) 
		
	) );
	
	
helper_text("opticdevice", __('Blu-Ray/DVD/CD drive model'), __('Please enter the model.'));

helper_select('optic', __('Type'), array( 
	array(2, 'CD-ROM'),  
	array(3, 'CD-RW'),  
	array(4, 'DVD-ROM'), 
	array(5, 'DVD/CD-RW Combo'),
	array(6, 'DVD-RW'),
	array(7, 'Blu-Ray/DVD-RW Combo'),
	array(8, 'Blu-Ray-RW')
	) );
	
	
helper_slider('discreadmaxspeed', __('Disc read max speed'), __('Please select'), 2, 4, 28, '%s' . 'X', '8X' , '56X' );

helper_radio('opticinterface', __('Interface'), array( 
		array(1, 'IDE'),  
		array(2, 'SATA')
	) );

helper_yes_no("forlaptop", __('For laptop'));

?>


