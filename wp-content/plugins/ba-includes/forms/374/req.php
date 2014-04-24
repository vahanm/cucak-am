<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_selection('item_location', __('Please select the event location.'));
	
	$error .= require_selection_of_one('entrance', array(
		'free', 
		'ticket', 
		'invitation'
		), __('Please select the entrance type.'));


	
		$error .= require_oneof(
		require_selection_of_one('event_type', array(
		'campaign',
		'procession',
		'competition', 
		'performance', 
		'cinema',
		'concert',
		'exhibition',
		'presentation',
		'celebration', 
		'party',
		'rally',
		'flashmob',
		'other'		
		), __('Please select the event type.')),


			require_selection_of('event_type', 3,  array(
					'campaign',
					'procession',
					'competition', 
					'performance', 
					'cinema',
					'concert',
					'exhibition',
					'presentation',
					'celebration', 
					'party',
					'rally',
					'flashmob',
					'seminar',
					'other'	
					), _t('Max %s type should be selected.', 3))
		);
	
	
	

	
	


	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
