<?php

global $hide_empty_values;
$hide_empty_values = true;

render_table_begin();





render_group_sub(__('Job description'));


render_location('item_location', __('Job location'));


render_check('offered', __('Offered'),  array( 
	array('job', __('Job')),
	array('training', __('Courses, trainings')),
	) );

render_value('worktype', __('Work type'), 'Error', array(
	1 => __('Full time'),
	2 => __('Part time'),
	3 => __('Night shift'),
	4 => __('Shift work'),
	5 => __('24 hours'),
	6 => __('Flexible'),
	7 => __('Job from home'),
	8 => __('other')
	));

render_check('spherelist', __('Corresponding sphere(s)'),  array( 
array('accounting', __('Accounting / Finance ')),
array('administrativ', __('Administrative / Clerical')),
array('architectureco', __('Architecture / Construction')),
array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
array('bankingaudit', __('Banking / Audit')),
array('beautysalonssaunas', __('Beauty Salons / Saunas')),
array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
array('carservicingrepair', __('Car servicing and repair')),
array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
array('certificationinspection', __('Certification / Inspection')),
array('cooking', __('Cooking')),
array('customerser', __('Customer service / Call center')),
array('drivermechanic', __('Driver / Mechanic')),
array('energyutilityservices', __('Energy / Utility services')),
array('furniturewoodworking', __('Furniture / Woodworking')),
array('healthmedicine', __('Health / Medicine')),
array('houseworks', __('House works')),
array('humanresources', __('Human resources / Staff management')),
array('insurance', __('Insurance')),
array('itcomputerequ', __('IT / Computer equipment / Internet')),
array('legalservices', __('Legal services')),
array('mediajournalism', __('Media / Journalism')),
array('personalcareservice', __('Personal care and service')),
array('photovideodesign', __('Photo / Video / Design')),
array('production', __('Production / Agriculture')),
array('programming', __('Programming')),
array('repairsupportofel', __('Repair and support of electrical equipments')),
array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
array('salesmarketing', __('Sales / Marketing / Dealer')),
array('scienceeducati', __('Science / Education / Teaching')),
array('securitybodyguard', __('Security / Bodyguard')),
array('sportfitnessclubs', __('Sport / Fitness clubs')),
array('telecommunications', __('Telecommunications / Post')),
array('other', __('other'))
	) );



/*
render_value('beginapp', __('Applications beginning'), '%s ' );
	
render_value('appdeadline', __('Applications deadline'), '%s ' );	

render_value('openingdate', __('Opening date'), '%s ' );	
*/

render_value('duration', __('Duration'), __('%s months'), array(
	1 => _t('%s month', 1),
	25 =>  __('permanent')
	));


render_text('vacantposition', __('Vacant position name'), '%s ' );
	
render_text('jobresponsibilities', __('Job responsibilities'), '%s ' );	

render_text('jobdescription', __('Job description'), '%s ' );	








render_group_sub(__('Requirements'));



render_value('educationdegree', __('Required education'), 'Error', array(
	'notrequired'=> __('Not required'),
	'secondaryed' => __('Secondary'),
	'specializedsecondary' => __('Specialized secondary'), 
	'bachalor' => __('Bachelor'), 
	'master' => __('Master&#39;s'),
	'phd' =>  __('PhD')
	));

/*
render_check_key('windows', __('Windows'), array('none', 'image:no'), array( 
	array('wood', __('wood')), 
	array('metal', __('metal-based laminate')), 
	array('aluminium', __('aluminium')) 
	) );
*/

render_check_key('language', __('Languages'), array('none', __('does not matter')), array( 
	array('armenian', __('Armenian')),
	array('russian', __('Russian')),
	array('english', __('English')),
	array('german', __('German')),
	array('french', __('French')),
	array('spanish', __('Spanish')),	
	array('turkish', __('Turkish')),	
	array('persian', __('Persian')),	
	array('other', __('other'))
	) );


render_value('workexperience', __('Work experience'), __('%s years'), array(
	1 => __('not necessarily'),
	2 => __('half year'),
	3 => __('one year'),
	4 => __('year and a half'),
	5 => _t('%s years', 2),	
	6 => _t('%s years', 2.5),	
	7 => _t('%s years', 3),
	8 => _t('%s years', 3.5),
	9 => _t('%s years', 4),
	10 => _t('%s years', 4.5),
	11 => _t('%s years', 5),
	12 => _t('%s years', 5.5),
	13 => _t('%s years and more', 6)
	));

render_check('sex', __('Sex'),  array( 
	array('frmale', __('Female')),
	array('male', __('Male')),
	));		


render_value('maximumage', __('Maximum age'), __('%s age'), array(
	19 => __('does not matter'),
	));


render_text('qualifications', __('Required qualifications'), '%s ' );	

render_text('personalqualities', __('Required personal qualities'), '%s ' );	


render_table_end();
?>
