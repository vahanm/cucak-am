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

	
	$error .= require_selection_of_one('shoestofferedto', array('men', 'women'), __('Please select to whom bijouterie is offered.'));
	
	
	$error .= require_selection_of_one('bijouterieitem', array(
		'necklace', 
		'bracelet', 
		'beads',
		'ring',
		'earrings',
        'pendent',
		'brooc',
		'hairpin',
        'trinket',
		'other'), __('Please select the bijouterie type.'));

	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
