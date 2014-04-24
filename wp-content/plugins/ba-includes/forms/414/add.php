<?php
helper_price(array('allow_donation' => false));

helper_salary();

helper_payment();

helper_group('group', __('Group'));

helper_group_sub('groupsub', __('Subgroup'));

helper_location('location', 'Location', USER_LOCATION);

helper_text("text", __('Text'), __('Please enter the address.'));

helper_textarea('textarea', __('Text area'), __('Please enter required personal qualities.'), _t('%s characters max', 1500), 100);

helper_yes_no("yesno", __('YesNo'));

helper_datepicker('datepicker', __('Date picker'), $minDate = '-3M',  $default, __('Please select the applications beginning.'));

helper_number("number", __('Number'), __('Please enter the size of the land area.'),  array( 
	array(1, __('square metres')),  
	array(2, __('hectare')) 
	) );


helper_slider('slider', __('Slider'), __('Please select'), 50, 0, 60, __('%s litres'), __('no water container'),  __('%s litres'));

helper_slider_by_list('sliderbylist', __('Slider by list'), __('Please select'), 0, 5, __('%s balconies'), array(
	0 => __('no balcony'), 
	1 =>  __('%s balcony')
	), __('no balcony'),  __('%s balconies'));

helper_select('select', __('Select'), array(                        
    array(1, __('Full time')),
    array(2, __('Part time')),
    array(3, __('Night shift')),
    array(4, __('Shift work')),
    array(5, __('24 hours')),	
    array(6, __('Flexible')),
    array(7, __('Job from home')),
    array(8, __('other'))
    ) );

helper_radio('radio', 'Radio', array( 
				array(1, __('none')), 
				array(2, __('exists')), 
				array(3, __('possible')) 
			) );
    

helper_check('check', __('Check'),  array( 
				array('wood', __('wood')),
				array('iron', __('iron'))
			) );
    

helper_check_key('checkkey', __('Check Key'), 
	array('none', __('none')), 	array(
			array('sattv', __('Sat. TV')),
			array('cabtv', __('Cab. TV')), 
			array('inttv', __('Int. TV')) 
			) );

