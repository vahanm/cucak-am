<?php


filter_location(array(
	'id'			=>	'item_location'
	, 'title' 		=>	__('Event location')
	, 'priority'	=> PRIMARY_FILTER
	));


filter_select(array(  
id	 =>'entrance'
, title	 =>__('Entrance')
, values =>array( 
	array('free', __('free')),
	array('ticket', __('with ticket')),
	array('invitation', __('with invitation'))
				)
			, byKeys => true
			, priority => PRIMARY_FILTER
			));


//filter_group_sub('events', __('Event'));


filter_select(array(
  id	 =>	'event_type'
, title	 =>	__('Event type')
, values =>	array( 
	array('campaign', __('campaign')),  
	array('procession', __('procession')),  
	array('competition', __('competition')),
	array('performance', __('performance')), 
	array('cinema', __('cinema')),  
	array('concert', __('concert')),  
	array('exhibition', __('exhibition')), 
	array('presentation', __('presentation')),  
	array('celebration', __('celebration')), 
	array('party', __('party')),  
	array('rally', __('rally')),  
	array('flashmob', __('flash mob')), 
	array('seminar', __('seminar')), 
	array('other', __('other'))
					)
		, byKeys => true
		, priority => PRIMARY_FILTER
	));





?>


