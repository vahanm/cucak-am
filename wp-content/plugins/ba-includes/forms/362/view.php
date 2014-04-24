<?php

global $hide_empty_values;
$hide_empty_values = true;

render_table_begin();





render_group_sub(__('Personal information'));


render_value('sex', __('Sex'), 'Error', array(
	'frmale' => __('Female'), 
	'male' => __('Male')
	));	 


render_value('yearofbirth', __('Year of birth'), __('%sy'), array(
	
	));


render_value('educationdegree', __('Education degree'), 'Error', array(
	'secondaryed' => __('Secondary'),
	'specializedsecondary' => __('Specialized secondary'),
	'bachalor' => __('Bachelor'), 
	'master' => __('Master&#39;s'),
	'phd' =>  __('PhD')
	));



render_value('educfree', __('Education'), '%s ' );
	
	
render_check('language', __('Languages'),  array( 
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
	
	
	
	
	
	
	
render_value('qualifications', __('Qualifications'), '%s ' );	




render_value('workexperience', __('Work experience'), __('%s years'), array(
	1 => __('none'),
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




render_value('profexp', __('Professional experience'), '%s ' );	

render_value('personalhobb', __('Personal qualities / Hobbies / Interests'), '%s ' );	








render_group_sub(__('Preferred job description'));


render_location('item_location', __('Preferred job location'));



render_check('lookingfor', __('Looking for'),  array( 
	array('job', __('Job')),
	array('training', __('Courses, trainings')),
	array('other', __('other')),
	) );


render_check('prefworktype', __('Preferred work type'),  array( 
	array('fulltime', __('Full time')),
	array('parttime', __('Part time')),
	array('nightshift', __('Night shift')),
	array('shiftwork', __('Shift work')),
	array('24hours', __('24 hours')),
	array('flexible', __('Flexible')),
	array('jobfromhome', __('Job from home')),
	array('other', __('other')),
	) );


render_check('spherelist', __('Preferred area(s)'),  array( 
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


render_value('prefposition', __('Preferred position'), '%s ' );



render_table_end();
?>
