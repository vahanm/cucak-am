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

//filter_text("dcammodel", __('Camera model'), __('Please enter desired model.'));




filter_select('shutterspeed', __('Shutter speed'), array( 
	array('60', '1/60 ' . __('s')),
	array('125', '1/125 ' . __('s')),
	array('250', '1/250 ' . __('s')),
	array('500', '1/500 ' . __('s')),
	array('1000', '1/1000 ' . __('s')),
	array('2000', '1/2000 ' . __('s'))
	));




//filter_group_sub('lensinfo', __('Lens'));

filter_select('camleans', __('Camera lens'), array( 
	array(1, __('without lens')), 
	array(5, __('integrated lens')), 
	array(2, __('factory lens')), 
	array(3, __('replaced lens')), 	
	array(4, __('other')) 
	),2);


//filter_textarea('cameralenstype', __('Lens options'), __('Please enter the lens options.'), _t('%s characters max', 1000), 50);


filter_slider(array(
  'id'			=>'optzoom'
	, 'title'	=>__('Optical zoom')
, 'rate'		=>0.5
, 'min'			=>4
, 'max'			=>80
, 'text'		=>'%s X'
	, 'priority'	=>	PRIMARY_FILTER
	));



filter_yes_no("autofocus", __('Auto focus'));


filter_select('viewfindertype', __('Viewfinder type'), array( 
	array(1, __('Direct optical viewfinder')), 
	array(2, __('Single-lens reflex viewfinder')), 
	array(3, __('Twin-lens reflex viewfinder')), 
	array(4, __('Electronic viewfinder')), 	
	array(5, __('other')) 
	), 2);

filter_select(array(
  'id'			=>'photographicfilm'
, 'title'		=>__('Photographic film type')
, 'values'		=>array( 
	array(1, '16 ' . __('mm')), 
	array(2, '24 ' . __('mm')), 
	array(3, '35 ' . __('mm')), 
	array(4, '61.5 ' . __('mm')), 	
	array(5, __('other')))
			, priority => PRIMARY_FILTER
			));


filter_select('lightmeter', __('Light meter'), array( 
	array(1, __('No light meter')), 
	array(2, __('Internal')), 
	array(3, __('External')), 
	array(4, __('other')) 
	));

filter_yes_no("intspeedli", __('Integrated speedlight'));

filter_yes_no(array(
  'id'			=>"digitaldisplayslr"
, 'title'		=>__('Digital display')
		, priority => PRIMARY_FILTER
			));







filter_check('extra', __('Extra things'),  array( 
	array('extralens', __('extra lens')),
	array('extraspeedlight', __('extra speedlight')),
	array('bag', __('bag')),
	array('tripod', __('tripod')),

	) ,1);







?>