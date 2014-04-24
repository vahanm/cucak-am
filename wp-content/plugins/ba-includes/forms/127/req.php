<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')
	
	$error .= require_salary();

	
	$error .= require_selection('item_location', __('Please select the job location.'));
	
	$error .= require_selection_of_one('offered', array('job', 'training'), __('Please select the offer type.'));

	$error .= require_selection('worktype', __('Please select the work type.'));



	$error .= require_oneof(
		require_selection_of_one('spherelist', array(
		'personalcareservice', 
		'biotechnologyp', 
		'insurance', 
		'customerser', 
		'salesmarketing', 
		'accounting', 
		'healthmedicine', 
		'telecommunications', 
		'carservicingrepair', 
		'architectureco', 
		'artstheatercin', 
		'humanresources', 
		'production', 
		'ceremoniesstansd', 
		'bankingaudit', 
		'securitybodyguard', 
		'beautysalonssaunas', 
		'restaurantcafecasino', 
		'scienceeducati', 
		'certificationinspection', 
		'mediajournalism', 
		'sportfitnessclubs', 
		'repairsupportofel', 
		'drivermechanic', 
		'energyutilityservices', 
		'houseworks', 
		'legalservices', 
		'itcomputerequ', 
		'cooking', 
		'administrativ', 
		'programming', 
		'photovideodesign', 
		'furniturewoodworking', 
		'other'
		), __('Please select the corresponding sphere(s).')),
		
			
			require_selection_of('spherelist', 4,  array(
					'personalcareservice', 
					'biotechnologyp', 
					'insurance', 
					'customerser', 
					'salesmarketing', 
					'accounting', 
					'healthmedicine', 
					'telecommunications', 
					'carservicingrepair', 
					'architectureco', 
					'artstheatercin', 
					'humanresources', 
					'production', 
					'ceremoniesstansd', 
					'bankingaudit', 
					'securitybodyguard', 
					'beautysalonssaunas', 
					'restaurantcafecasino', 
					'scienceeducati', 
					'certificationinspection', 
					'mediajournalism', 
					'sportfitnessclubs', 
					'repairsupportofel', 
					'drivermechanic', 
					'energyutilityservices', 
					'houseworks', 
					'legalservices', 
					'itcomputerequ', 
					'cooking', 
					'administrativ', 
					'programming', 
					'photovideodesign', 
					'furniturewoodworking',
					'other'
					), _t('Max %s areas should be selected.', 4))
		);
	
    $error .= require_length_max('vacantposition', 200, _t('Vacant position name must be contents %s chars maximum.',200));
	
	$error .= require_length_max('jobresponsibilities', 1500, _t('Job responsibilities must be contents %s chars maximum.',1500));
	
	$error .= require_length_max('jobdescription', 1500, _t('Job description must be contents %s chars maximum.',1500));
	
	
	
	
	$error .= require_selection('educationdegree', __('Please select the required education.'));


	//$error .= require_selection_of_one('language', array('armenian', 'russian', 'english', 'german', 'french', 'spanish', 'turkish', 'persian', 'other'), __('Please select the required language(s).'));
	
	$error .= require_length_max('qualifications', 1500, _t('Required qualifications must be contents %s chars maximum.',1500));
	
	$error .= require_length_max('personalqualities', 1500, _t('Required personal qualities must be contents %s chars maximum.',1500));



	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
