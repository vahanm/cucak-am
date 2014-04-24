<?php
///////////////////////////////////////////////////////////////////////
render_table_begin();
///////////////////////////////////////////////////////////////////////

/*
///////////////////////////////////////////////////////////////////////
render_table_end();
render_table_begin_right();
///////////////////////////////////////////////////////////////////////
*/

render_group(__('Group'));

render_group_sub(__('Subgroup'));

render_location('location', 'Location');

render_value('text', __('Text'), '%s ' );	

render_text('textarea', __('Text area'), '%s ' );	

render_yes_no("yesno", __('YesNo'));

render_date('datepicker', __('Date picker'));

render_number('number', __('Number'), array(
	1 => __('square metres'), 
	2 => __('hectare')
	));	 

render_value('slider', __('Slider'), __('%s litres'), array( 0 => 'image:no'));


render_value('sliderbylist', __('Slider by list'), __('%s balconies'), array(
	0 => 'image:no', 
	1 => __('%s balcony')
	));

render_value('select', __('Select'), 'Error', array(
    1 => __('Full time'),
    2 => __('Part time'),
    3 => __('Night shift'),
    4 => __('Shift work'),
    5 => __('24 hours'),
    6 => __('Flexible'),
    7 => __('Job from home'),
    8 => __('other')
    ));

render_value('radio', 'Radio', 'Error', array(
    1 => 'image:no', 
    2 => 'image:yes', 
    3 => __('possible')
    ));


render_check('check', __('Check'),  array( 
	array('wood', __('wood')), 
	array('iron', __('iron')) 
	) );


render_check_key('checkkey', __('Check Key'), array('none', 'image:no'), array( 
	array('sattv', __('Sat. TV')), 
	array('cabtv', __('Cab. TV')),
	array('inttv', __('Int. TV')) 
	) );


///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
