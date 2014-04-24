<?php



function CheckFormForErrors()
{
    return '';
}


//////// Message ///////// BEGIN /////////

helper_group_required('attention', __('Attention'));
?>

<div class="addpostinnerdiv">
	<p>
		<strong>
		<?php _e('If you want to add bouquet or flower composition, go to:') ?>
		
		<a href="/addnew/?type=409"><?php _e('Add composition') ?></a>
		</strong>	
	</p>
</div>



<?php
//////// Message //////// End //////////




helper_price(array('allow_rent' => false, 'allow_exchange' => false));

//helper_group('cpugroup', __('CPU'));


helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);


helper_slider('headsize', __('Head size'), __('Please select'), 0.5, 2, 30, __('%s cm'));

helper_slider('sizeaperture', __('Final size of the aperture'), __('Please select'), 0.5, 4, 60, __('%s cm'));

helper_slider('stemlength', __('Stem length'), __('Please select'), 1, 5, 150, __('%s cm'));




helper_select('lifetime', __('Lifetime'), array( 			
    array(10, __('about one week')),  
    array(20, __('about two weeks')),  
    array(30, __('about one month')),  
    array(40, __('unlimited'))
		) );
