<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', 'min', 'message')
	//require_length_max('id', 'max', 'message')

	$error .= require_selection('sex', __('Please select the sex.'));	
	
	$error .= require_selection('educationdegree', __('Please select the education degree.'));		
	
	$error .= require_length_max('educfree', 1500, _t('Education must be contents %s chars maximum.',1500));

	$error .= require_selection_of_one('language', array('armenian', 'russian', 'english', 'german', 'french', 'spanish', 'turkish', 'persian', 'other'), __('Please select the language(s).'));
	
	
	$error .= require_length_max('qualifications', 1500, _t('Qualifications must be contents %s chars maximum.',1500));

	$error .= require_length_max('profexp', 1500, _t('Professional experience must be contents %s chars maximum.',1500));
	
	$error .= require_length_max('personalhobb', 1500, _t('Personal qualities must be contents %s chars maximum.',1500));
	
	$error .= require_selection_of_one('lookingfor', array('job', 'training', 'other'), __('Please select what are you looking for.'));
	
	
	
	
	$error .= require_selection('item_location', __('Please select the preferred job location.'));
	
	

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
					), __('Please select the preferred area(s).')),
		
			
			require_selection_of('spherelist', 8,  array(
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
					), _t('Max %s areas should be selected.', 8))
		);
	
	
	
	
	$error .= require_selection_of_one('prefworktype', array('fulltime', 'parttime', 'nightshift', 'shiftwork','24hours', 'flexible', 'jobfromhome','other'), __('Please select the work type.'));



	

	$error .= require_length_max('prefposition', 1500, _t('Preferred position must be contents %s chars maximum.',1500));


	
	
	
	
	
	


	
	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
