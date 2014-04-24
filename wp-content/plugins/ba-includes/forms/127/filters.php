<?php


filter_location(array(
	'id'			=>	'item_location'
	, 'title' 		=>	__('Job location')
	, 'priority'	=> PRIMARY_FILTER
	));


	filter_select(array(
  id	 =>		'offered'
, title	 =>		__('Offered')
, values =>		array( 
	array('job', __('Job')),
	array('training', __('Courses, trainings')),
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));


filter_select(array(
	id	 =>		'worktype'
	, title	 => __('Work type')
	, values =>	array(                        
	array(1, __('Full time')),
	array(2, __('Part time')),
	array(3, __('Night shift')),
	array(4, __('Shift work')),
	array(5, __('24 hours')),	
	array(6, __('Flexible')),
				array(7, __('Job from home')),
				array(8, __('other'))
				)
			, priority => PRIMARY_FILTER
			));
	




//filter_group_sub('spherelistgroup', __('Corresponding sphere(s)'));

if(WPLANG == 'en_EN')
	filter_select(array(
		  id	 =>	'spherelist'
		, title	 =>	__('Sphere') 
		, values =>	array( 
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
					)
		, byKeys => true
		, priority => PRIMARY_FILTER
	));





if(WPLANG == 'ru_RU')
	filter_select(array(
		  id	 =>	'spherelist'
		, title	 =>	__('Sphere') 
		, values =>	array( 
						array('architectureco', __('Architecture / Construction')),
						array('bankingaudit', __('Banking / Audit')),
						array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
						array('accounting', __('Accounting / Finance ')),
						array('drivermechanic', __('Driver / Mechanic')),
						array('healthmedicine', __('Health / Medicine')),
						array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
						array('itcomputerequ', __('IT / Computer equipment / Internet')),
						array('cooking', __('Cooking')),
						array('furniturewoodworking', __('Furniture / Woodworking')),
						array('mediajournalism', __('Media / Journalism')),
						array('scienceeducati', __('Science / Education / Teaching')),
						array('carservicingrepair', __('Car servicing and repair')),
						array('customerser', __('Customer service / Call center')),
						array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
						array('securitybodyguard', __('Security / Bodyguard')),
						array('personalcareservice', __('Personal care and service')),
						array('programming', __('Programming')),
						array('salesmarketing', __('Sales / Marketing / Dealer')),
						array('production', __('Production / Agriculture')),
						array('houseworks', __('House works')),
						array('repairsupportofel', __('Repair and support of electrical equipments')),
						array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
						array('beautysalonssaunas', __('Beauty Salons / Saunas')),
						array('administrativ', __('Administrative / Clerical')),
						array('certificationinspection', __('Certification / Inspection')),
						array('sportfitnessclubs', __('Sport / Fitness clubs')),
						array('insurance', __('Insurance')),
						array('telecommunications', __('Telecommunications / Post')),
						array('photovideodesign', __('Photo / Video / Design')),
						array('humanresources', __('Human resources / Staff management')),
						array('energyutilityservices', __('Energy / Utility services')),
						array('legalservices', __('Legal services')),
						array('other', __('other'))
						)
		, byKeys => true
		, priority => PRIMARY_FILTER
	));





if(WPLANG == 'am_HY')
filter_select(array(
	  id	 =>		'spherelist'
	, title	 =>	__('Sphere') 
	, values =>	array( 
						array('personalcareservice', __('Personal care and service')),
						array('insurance', __('Insurance')),
						array('salesmarketing', __('Sales / Marketing / Dealer')),
						array('healthmedicine', __('Health / Medicine')),
						array('carservicingrepair', __('Car servicing and repair')),
						array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
						array('production', __('Production / Agriculture')),
						array('bankingaudit', __('Banking / Audit')),
						array('beautysalonssaunas', __('Beauty Salons / Saunas')),
						array('scienceeducati', __('Science / Education / Teaching')),
						array('mediajournalism', __('Media / Journalism')),
						array('repairsupportofel', __('Repair and support of electrical equipments')),
						array('energyutilityservices', __('Energy / Utility services')),
						array('legalservices', __('Legal services')),
						array('cooking', __('Cooking')),
						array('programming', __('Programming')),
						array('furniturewoodworking', __('Furniture / Woodworking')),
						array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
						array('customerser', __('Customer service / Call center')),
						array('accounting', __('Accounting / Finance ')),
						array('telecommunications', __('Telecommunications / Post')),
						array('architectureco', __('Architecture / Construction')),
						array('humanresources', __('Human resources / Staff management')),
						array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
						array('securitybodyguard', __('Security / Bodyguard')),
						array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
						array('certificationinspection', __('Certification / Inspection')),
						array('sportfitnessclubs', __('Sport / Fitness clubs')),
						array('drivermechanic', __('Driver / Mechanic')),
						array('houseworks', __('House works')),
						array('itcomputerequ', __('IT / Computer equipment / Internet')),
						array('administrativ', __('Administrative / Clerical')),
						array('photovideodesign', __('Photo / Video / Design')),
						array('other', __('other'))
					)
		, byKeys => true
		, priority => PRIMARY_FILTER
	));

/*
filter_datepicker('beginapp', __('Applications beginning'), $minDate = '-3M',  $default, __('Does not matter the applications beginning.'));

filter_datepicker('appdeadline', __('Applications deadline'), $minDate = 1, $default, __('Does not matter the applications deadline.'));

filter_datepicker('openingdate', __('Opening date'), $minDate = 1, $default, __('Does not matter the opening date.'));
*/



filter_slider_by_list2('duration', __('Duration'), 1, 25, __('from %v1 to %2'), __('%s months'), array(
	1 => _t('%s month', 1),
	25 =>  __('permanent')
	), _t('%s month', 1), __('permanent'));
/*
filter_textarea('vacantposition', __('Vacant position name'), __('Please enter the vacant position name.'), _t('%s characters max', 1500), 100);

filter_textarea('jobresponsibilities', __('Job responsibilities'), __('Please enter the job responsibilities.'), _t('%s characters max', 1500), 100);

filter_textarea('jobdescription', __('Job description'), __('Please enter the job description.'), _t('%s characters max', 1500), 100);

*/


filter_group_sub('requirements', __('Requirements'));

filter_select(array(
	id	 =>				'educationdegree'
	, title	 =>			__('Required education')
	, values =>			array( 
	array('notrequired', __('Not required')),
	array('secondaryed', __('Secondary')),	
	array('specializedsecondary', __('Specialized secondary')),	
	array('bachalor', __('Bachelor')),
	array('master', __('Master&#39;s')),
	array('phd', __('PhD'))
				)
			, priority => PRIMARY_FILTER
			));




filter_select(array(
	  'id'		=>	'language'
	, 'title'	=>	__('Languages') 
	, 'values'	=>	array( 
	array('none', __('not required')),
	array('armenian', __('Armenian')),
	array('russian', __('Russian')),
	array('english', __('English')),
	array('german', __('German')),
	array('french', __('French')),
	array('spanish', __('Spanish')),	
	array('turkish', __('Turkish')),	
	array('persian', __('Persian')),	
	array('other', __('other'))
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));


filter_slider_by_list2('workexperience', __('Work experience'), 1, 13,  __('from %v1 to %2'), __('%s years'), array(
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
	),__('not necessarily'), _t('%s years and more', 6));

filter_select(array(
	id	 =>				'sex'
	, title	 =>		__('Sex')
	, values =>		array( 
	array('frmale', __('Female')),
				array('male', __('Male')),
				)
			, byKeys => true
			, priority => SECONDARY_FILTER
			));


															


filter_slider_by_list2(array(
	id			=> 	'maximumage'
	, title		=> 	__('Maximum age')
	, min		=> 	19
	, max		=> 	75
	, format	=> 	__('from %v1 to %2')
	, text		=>	__('%s age')
	, listItems	=> 	array(	19 => __('does not matter'))
	, begin		=> 	__('does not matter')
	, end		=> 	__('%s age')
	, priority	=>	PRIMARY_FILTER
	));


//filter_textarea('qualifications', __('Required qualifications'), __('Please enter required qualifications.'), _t('%s characters max', 1500), 100);

//filter_textarea('personalqualities', __('Required personal qualities'), __('Please enter required personal qualities.'), _t('%s characters max', 1500), 100);


?>