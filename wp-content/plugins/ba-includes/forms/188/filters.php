<?php


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));





filter_select(array(
'id'			=>'item_condition'
, 'title'		=>__('Item condition')
, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
, priority => PRIMARY_FILTER
));

	
	
//filter_text("casemodel", __('Case model'), __('Please enter desired model.'));

filter_slider(array(
  'id'			=>'power'
	, 'title'	=>__('Power supply')
, 'rate'		=>50
, 'min'			=>0
, 'max'			=>24
, 'text'		=>__('%s W')
, 'begin'		=>__('no power supply')
, 'priority'	=>	PRIMARY_FILTER
));


filter_check_key('frontconnectors', __('Front connectors'), array('none', __('none')), array( 
	array('mic', __('microphonecase')),
	array('headphone', __('headphones')), 	
	array('usb', 'USB'), 
	array('extsata', 'eSATA'),
	array('1394', '1394')
	) ,1);


filter_creative_design();


?>