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

	$error .= require_selection_of_one('clotofferedto', array('men', 'women'), __('Please select to whom clothing is offered.'));
	
	
	$error .= require_selection_of_one('clothingitem', array(
		'trousers',
		'shorts',
		'skirt',
		'dress',
		'underwear', 
		'tshirt',
		'shirt',
		'sweater',
		'suit',
		'coat', 
		'cloak', 
		'jacket', 
		'topcoat', 
		'furcoat', 
		'hat', 
		'waistcoat', 
		'other'  ), __('Please select the garment.'));


	$error .= require_selection_of_one('wearingseason', array('allseason', 'spring', 'summer', 'autumn', 'winter'), __('Please select the season.'));
	
	
	$error .= require_selection_of_one('clothingtype', array(
		'everydayclothes',
		'sportswear',
		'uniform', 
		'eveninggown', 
		'stagecostumes',
		'weddingdress', 
		'other'
		), __('Please select the clothing type.'));
	
	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
