<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the item location.'));

	$error .= require_selection('item_condition', __('Please select the item condition.'));

	$error .= require_selection_of_one('shoestofferedto', array('men', 'women'), __('Please select to whom shoes are offered.'));
	
	
	$error .= require_selection_of_one('shoesitem', array(
		'shoes',
		'pumps',
		'moccasins',
		'balletslipper',
		'sandals',
		'sabot',
		'wedgeheel',
		'walkingshoes', 
		'boots',
		'uggboots',
		'cossackboots', 
		'lowboots',
		'highboots',
		'jackboots',
		'rubberboots',
		'footballboots',
		'keds',
		'sneakers',
		'slippers',
		'bedroomslippers',
		'flipflops',
		'other'), __('Please select the shoes form.'));


	$error .= require_selection_of_one('wearingseason', array('allseason', 'spring', 'summer', 'autumn', 'winter'), __('Please select the season.'));
	
	
	$error .= require_selection_of_one('shoestype', array(
		'daily',
		'sports',
		'other'
		), __('Please select the shoes type.'));
	
	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
