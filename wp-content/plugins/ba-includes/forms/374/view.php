<?php
///////////////////////////////////////////////////////////////////////
render_table_begin_Left();
///////////////////////////////////////////////////////////////////////

render_group_sub(__('Entrance'));


render_location('item_location', __('Event location'));

render_check('entrance', __('Entrance'),  array( 
	array('free', __('free')),
	array('ticket', __('with ticket')),
	array('invitation', __('with invitation'))
	) );


///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////


render_group_sub(__('Event type'));

render_check('event_type', __('Event type'), array( 
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
	),3 );

///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////


?>
