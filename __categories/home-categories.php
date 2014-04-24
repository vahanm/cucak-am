<?php
/*
$authorId = get_current_user_id();
	
if ($authorId != 0 && $authorId != 2) 
{
	global $registredSubdomains;

	$prefix = 'http://cucak.am/?author=' . $authorId;
	$hasAddress = false;

	foreach($registredSubdomains as $key => $value)
		if($value == $authorId)
		{
			$hasAddress = true;
			$prefix = 'http://' . $key . '.cucak.am/';
			break;
		}
	
	helper_cat_group_mypage();
	helper_cat_comp('mypage_home2', __('My home page'), $hasAddress ? $key . '.cucak.am' : __('.'), $prefix, '#009f6a', 'white', $authorId);
	helper_cat_comp('mypage_photos', __('My Gallery'), $hasAddress ? $key . '.cucak.am' : __('.'), $prefix . ($hasAddress ? '?' : '&') . 'page=photos', '#0060AA', 'white', $authorId);
}
*/

helper_cat_group_partners();

//helper_cat_sub('Notebook2', '<font style="font-size: 120%;">Laptop LLC</font> -- ' . __('Notebooks'), 'http://laptop.cucak.am/', '#5a9f38', 'white');
// #DE00FF
helper_cat_comp('Notebook2', 'Laptop Shop LLC', __('Notebooks / Netbooks'), 'http://laptopshop.cucak.am/', '#009f6a', 'white', 58);

helper_cat_comp('camera', 'Andranik Hambardzumyan', __('Photo / Video cameras'), 'http://andranik.cucak.am/', '#d2006a', 'white', 37);

helper_cat_comp('car3', 'Artur Manucharyan', __('Cars'), 'http://artur.cucak.am/', '#25a6b7', 'white', 22);




//helper_cat_group('categories', __('Categories'));
helper_cat_group_categories();

helper_cat_big('job2', __('Vacancies'), 127, '#0060AA', 'white');

helper_cat_small('resume', __('Resumes'), 362, '#7801b2', 'white');

helper_cat_small('service3', __('Services'), 321, '#bd0611', 'white');

helper_cat_small('event', __('Events'), 374, '#ec500a', 'white');

helper_cat_big('realestate2', __('Real estate'), 286, '#ec500a', 'white');

helper_cat_big('household6', __('Household products'), 346, '#006d7b', 'white');

helper_cat_small('electronics4', __('Electronics'), 322, '#5a9f38', 'white');

helper_cat_big('car3', __('Vehicles'), 39, '#298000', 'white');

helper_cat_small('agriculture', __('Agriculture'), 312, '#66534d', 'white');

helper_cat_big('construction_technics', __('Machinery / Devices'), 317, '#783027', 'white');

helper_cat_big('furniture', __('Furniture'), 338, '#ae0079', 'white');

helper_cat_big('clothing3', __('Clothing / Accessories'), 340, '#d25a00', 'white');

helper_cat_small('sport', __('Sport'), 343, '#358cf9', 'white');

helper_cat_big('manufacturing', __('Business / Manufacturing'), 337, '#932907', 'white');

helper_cat_small('Products', __('Production'), 308, '#0060AA', 'white');							//308,314

helper_cat_small('creative', __('Creative items'), 347, '#bd0611', 'white');

helper_cat_small('gifts', __('Gifts'), 407, '#7801b2', 'white');

//helper_cat_small('souvinire3', __('Souvenirs'), 361, '#7801b2', 'white');

helper_cat_big('pets', __('House pets / Plants'), 339, '#27784a', 'white');

helper_cat_big('musical', __('Musical Instruments'), 341, '#000000', 'white');

helper_cat_small('art6', __('Arts'), 342, '#932907', 'white');

helper_cat_big('child3', __('Kid products'), 379, '#25a6b7', 'white');

helper_cat_small('book2', __('Books / Films'), 345, '#298000', 'white');

helper_cat_small('found', __('Found items'), 363, '#ec500a', 'white');

helper_cat_small('humor2', __('Humor'), 348, '#d2005b', 'white');

?>