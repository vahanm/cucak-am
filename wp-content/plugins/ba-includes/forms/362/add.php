<?php

function CheckFormForErrors()
{
    return '';
}

//helper_salary();

helper_group_required('attention', __('Attention'));
?>

<div class="addpostinnerdiv">
	<p>
		<strong>
		<?php _e('Your resume is available for each visitor.') ?>
		
		
		</strong>	
	</p>
</div>

<?php

helper_group('persinf', __('Personal information'));

helper_radio('sex', __('Sex'), array( 
	array('frmale', __('Female')),
	array('male', __('Male')),
	));											


helper_slider_by_list('yearofbirth', __('Year of birth'), __('Please select'), date('Y')-75, date('Y')-16, __('%sy'),'',  date('Y')-75 . __('y'), date('Y')-16 . __('y'));



helper_radio('educationdegree', __('Education degree'), array( 
	array('secondaryed', __('Secondary')),	
	array('specializedsecondary', __('Specialized secondary')),	
	array('bachalor', __('Bachelor')),
	array('master', __('Master&#39;s')),
	array('phd', __('PhD'))
	), 3 );




helper_textarea('educfree', __('Education'), __('Please enter the education.'), _t('%s characters max', 1500), 150);

		
				
helper_check('language', __('Languages'),  array( 
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


helper_textarea('qualifications', __('Qualifications'), __('Please enter the qualifications.'), _t('%s characters max', 1500), 100);


helper_slider_by_list('workexperience', __('Work experience'), __('Please select'), 1, 13, __('%s years'), array(
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
	),__('none'), _t('%s years and more', 6));



helper_textarea('profexp', __('Professional experience'), __('Please enter the professional experience.'), _t('%s characters max', 1500), 100);




helper_textarea('personalhobb', __('Personal qualities / Hobbies / Interests'), __('Please tell about yourself.'), _t('%s characters max', 1500), 100);



helper_group('prefjobdescription', __('Preferred job description'));


helper_location('item_location', __('Preferred job location'), USER_LOCATION);


		
helper_check('lookingfor', __('Looking for'),  array( 
	array('job', __('Job')),
	array('training', __('Courses, trainings')),
	) );




helper_group_sub('preferredarea', __('Preferred area(s)') . '<span style="color: red;">*</span>');

if(WPLANG == 'en_EN')
	helper_check('spherelist', '',  array( 
		array('accounting', __('Accounting / Finance ')),
		array('humanresources', __('Human resources / Staff management')),
		array('administrativ', __('Administrative / Clerical')),
		array('insurance', __('Insurance')),
		array('architectureco', __('Architecture / Construction')),
		array('itcomputerequ', __('IT / Computer equipment / Internet')),
		array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
		array('legalservices', __('Legal services')),
		array('bankingaudit', __('Banking / Audit')),
		array('mediajournalism', __('Media / Journalism')),
		array('beautysalonssaunas', __('Beauty Salons / Saunas')),
		array('personalcareservice', __('Personal care and service')),
		array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
		array('photovideodesign', __('Photo / Video / Design')),
		array('carservicingrepair', __('Car servicing and repair')),
		array('production', __('Production / Agriculture')),
		array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
		array('programming', __('Programming')),
		array('certificationinspection', __('Certification / Inspection')),
		array('repairsupportofel', __('Repair and support of electrical equipments')),
		array('cooking', __('Cooking')),
		array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
		array('customerser', __('Customer service / Call center')),
		array('salesmarketing', __('Sales / Marketing / Dealer')),
		array('drivermechanic', __('Driver / Mechanic')),
		array('scienceeducati', __('Science / Education / Teaching')),
		array('energyutilityservices', __('Energy / Utility services')),
		array('securitybodyguard', __('Security / Bodyguard')),
		array('furniturewoodworking', __('Furniture / Woodworking')),
		array('sportfitnessclubs', __('Sport / Fitness clubs')),
		array('healthmedicine', __('Health / Medicine')),
		array('telecommunications', __('Telecommunications / Post')),
		array('houseworks', __('House works')),
		array('other', __('other'))
		),2, 4 );





if(WPLANG == 'ru_RU')
	helper_check('spherelist', '',  array( 
		array('architectureco', __('Architecture / Construction')),
		array('programming', __('Programming')),
		array('bankingaudit', __('Banking / Audit')),
		array('salesmarketing', __('Sales / Marketing / Dealer')),
		array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
		array('production', __('Production / Agriculture')),
		array('accounting', __('Accounting / Finance ')),
		array('houseworks', __('House works')),
		array('drivermechanic', __('Driver / Mechanic')),
		array('repairsupportofel', __('Repair and support of electrical equipments')),
		array('healthmedicine', __('Health / Medicine')),
		array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
		array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
		array('beautysalonssaunas', __('Beauty Salons / Saunas')),
		array('itcomputerequ', __('IT / Computer equipment / Internet')),
		array('administrativ', __('Administrative / Clerical')),
		array('cooking', __('Cooking')),
		array('certificationinspection', __('Certification / Inspection')),
		array('furniturewoodworking', __('Furniture / Woodworking')),
		array('sportfitnessclubs', __('Sport / Fitness clubs')),
		array('mediajournalism', __('Media / Journalism')),
		array('insurance', __('Insurance')),
		array('scienceeducati', __('Science / Education / Teaching')),
		array('telecommunications', __('Telecommunications / Post')),
		array('carservicingrepair', __('Car servicing and repair')),
		array('photovideodesign', __('Photo / Video / Design')),
		array('customerser', __('Customer service / Call center')),
		array('humanresources', __('Human resources / Staff management')),
		array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
		array('energyutilityservices', __('Energy / Utility services')),
		array('securitybodyguard', __('Security / Bodyguard')),
		array('legalservices', __('Legal services')),
		array('personalcareservice', __('Personal care and service')),

		array('other', __('other'))
		),2, 4 );




if(WPLANG == 'am_HY')
	helper_check('spherelist', '',  array( 
		array('personalcareservice', __('Personal care and service')),
		array('biotechnologyp', __('Biotechnology / Pharmaceutics')),
		array('insurance', __('Insurance')),
		array('customerser', __('Customer service / Call center')),
		array('salesmarketing', __('Sales / Marketing / Dealer')),
		array('accounting', __('Accounting / Finance ')),
		array('healthmedicine', __('Health / Medicine')),
		array('telecommunications', __('Telecommunications / Post')),
		array('carservicingrepair', __('Car servicing and repair')),
		array('architectureco', __('Architecture / Construction')),
		array('artstheatercin', __('Arts / Theater / Cinema / Culture')),
		array('humanresources', __('Human resources / Staff management')),
		array('production', __('Production / Agriculture')),
		array('ceremoniesstansd', __('Ceremonies / Stand-up meal organizing')),
		array('bankingaudit', __('Banking / Audit')),
		array('securitybodyguard', __('Security / Bodyguard')),
		array('beautysalonssaunas', __('Beauty Salons / Saunas')),
		array('restaurantcafecasino', __('Restaurant / Cafe / Casino')),
		array('scienceeducati', __('Science / Education / Teaching')),
		array('certificationinspection', __('Certification / Inspection')),
		array('mediajournalism', __('Media / Journalism')),
		array('sportfitnessclubs', __('Sport / Fitness clubs')),
		array('repairsupportofel', __('Repair and support of electrical equipments')),
		array('drivermechanic', __('Driver / Mechanic')),
		array('energyutilityservices', __('Energy / Utility services')),
		array('houseworks', __('House works')),
		array('legalservices', __('Legal services')),
		array('itcomputerequ', __('IT / Computer equipment / Internet')),
		array('cooking', __('Cooking')),
		array('administrativ', __('Administrative / Clerical')),
		array('programming', __('Programming')),
		array('photovideodesign', __('Photo / Video / Design')),
		array('furniturewoodworking', __('Furniture / Woodworking')),
		array('other', __('other'))
		), 2, 4 );																


helper_check('prefworktype', __('Preferred work type'),  array( 
	array('fulltime', __('Full time')),
	array('parttime', __('Part time')),
	array('nightshift', __('Night shift')),
	array('shiftwork', __('Shift work')),
	array('24hours', __('24 hours')),
	array('flexible', __('Flexible')),
	array('jobfromhome', __('Job from home')),
	array('other', __('other')),
	) );




helper_textarea('prefposition', __('Preferred position'), __('Please enter preferred position.'), _t('%s characters max', 1500), 100);




?>