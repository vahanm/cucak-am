﻿<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the item location.'));

	$error .= require_selection('item_condition', __('Please select the item condition.'));

	$error .= require_selection_of_one('ornamentofferedto', array('men', 'women'), __('Please select to whom ornament is offered.'));

	
	$error .= require_selection_of_one('ornamenttype', array(
		'bracelet',
		'braceletsfeet', 
		'brooc',
		'beads',
		'stumbling',
		'ring',
		'earrings', 
		'pendent',
		'medallion', 
		'necklace', 
		'chain', 
		'watch', 
		'other'), __('Please select the ornament type.'));

	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
