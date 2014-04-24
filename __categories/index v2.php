<?php

/////////////////////////////////////////////////////////////

helper_cat_begin('job', __('Vacancies'), 'big', '?cat=127');

helper_cat_list_begin();

if(WPLANG == 'en_EN')
{
helper_cat_list_item('accounting', __('Accounting / Finance '), '?cat=127&qspherelist_accountingoeq=1');
helper_cat_list_item('administrativ', __('Administrative / Clerical'), '?cat=127&qspherelist_administrativoeq=1');
helper_cat_list_item('architectureco', __('Architecture / Construction'), '?cat=127&qspherelist_architecturecooeq=1');
helper_cat_list_item('bankingaudit', __('Banking / Audit'), '?cat=127&qspherelist_bankingauditoeq=1');
helper_cat_list_item('beautysalonssaunas', __('Beauty Salons / Saunas'), '?cat=127&qspherelist_beautysalonssaunasoeq=1');
helper_cat_list_item('drivermechanic', __('Driver / Mechanic'), '?cat=127&qspherelist_drivermechanicoeq=1');

}

if(WPLANG == 'ru_RU')

{
	helper_cat_list_item('architectureco', __('Architecture / Construction'), '?cat=127&qspherelist_architecturecooeq=1');
	helper_cat_list_item('bankingaudit', __('Banking / Audit'), '?cat=127&qspherelist_bankingauditoeq=1');
	helper_cat_list_item('accounting', __('Accounting / Finance '), '?cat=127&qspherelist_accountingoeq=1');
	helper_cat_list_item('drivermechanic', __('Driver / Mechanic'), '?cat=127&qspherelist_drivermechanicoeq=1');
	helper_cat_list_item('itcomputerequ', __('IT / Computer equipment / Internet'), '?cat=127&qspherelist_itcomputerequoeq=1');
	helper_cat_list_item('programming', __('Programming'), '?cat=127&qspherelist_programmingoeq=1');
}

if(WPLANG == 'am_HY')

{	
	helper_cat_list_item('insurance', __('Insurance'), '?cat=127&qspherelist_insuranceoeq=1');
	helper_cat_list_item('salesmarketing', __('Sales / Marketing / Dealer'), '?cat=127&qspherelist_salesmarketingoeq=1');
	helper_cat_list_item('production', __('Production / Agriculture'), '?cat=127&qspherelist_productionoeq=1');
	helper_cat_list_item('bankingaudit', __('Banking / Audit'), '?cat=127&qspherelist_bankingauditoeq=1');
	helper_cat_list_item('beautysalonssaunas', __('Beauty Salons / Saunas'), '?cat=127&qspherelist_beautysalonssaunasoeq=1');
	helper_cat_list_item('programming', __('Programming'), '?cat=127&qspherelist_programmingoeq=1');
}


helper_cat_list_end();
















helper_cat_list_begin();

if(WPLANG == 'en_EN')
{
helper_cat_list_item('insurance', __('Insurance'), '?cat=127&qspherelist_insuranceoeq=1');
helper_cat_list_item('itcomputerequ', __('IT / Computer equipment / Internet'), '?cat=127&qspherelist_itcomputerequoeq=1');
helper_cat_list_item('production', __('Production / Agriculture'), '?cat=127&qspherelist_productionoeq=1');
helper_cat_list_item('programming', __('Programming'), '?cat=127&qspherelist_programmingoeq=1');
helper_cat_list_item('restaurantcafecasino', __('Restaurant / Cafe / Casino'), '?cat=127&qspherelist_restaurantcafecasinooeq=1');
helper_cat_list_item('salesmarketing', __('Sales / Marketing / Dealer'), '?cat=127&qspherelist_salesmarketingoeq=1');

}

if(WPLANG == 'ru_RU')

{
	helper_cat_list_item('salesmarketing', __('Sales / Marketing / Dealer'), '?cat=127&qspherelist_salesmarketingoeq=1');
	helper_cat_list_item('production', __('Production / Agriculture'), '?cat=127&qspherelist_productionoeq=1');
	helper_cat_list_item('restaurantcafecasino', __('Restaurant / Cafe / Casino'), '?cat=127&qspherelist_restaurantcafecasinooeq=1');
	helper_cat_list_item('beautysalonssaunas', __('Beauty Salons / Saunas'), '?cat=127&qspherelist_beautysalonssaunasoeq=1');
	helper_cat_list_item('administrativ', __('Administrative / Clerical'), '?cat=127&qspherelist_administrativoeq=1');
	helper_cat_list_item('insurance', __('Insurance'), '?cat=127&qspherelist_insuranceoeq=1');
}

if(WPLANG == 'am_HY')

{	
	helper_cat_list_item('accounting', __('Accounting / Finance '), '?cat=127&qspherelist_accountingoeq=1');
	helper_cat_list_item('architectureco', __('Architecture / Construction'), '?cat=127&qspherelist_architecturecooeq=1');
	helper_cat_list_item('restaurantcafecasino', __('Restaurant / Cafe / Casino'), '?cat=127&qspherelist_restaurantcafecasinooeq=1');
	helper_cat_list_item('drivermechanic', __('Driver / Mechanic'), '?cat=127&qspherelist_drivermechanicoeq=1');
	helper_cat_list_item('itcomputerequ', __('IT / Computer equipment / Internet'), '?cat=127&qspherelist_itcomputerequoeq=1');
	helper_cat_list_item('administrativ', __('Administrative / Clerical'), '?cat=127&qspherelist_administrativoeq=1');
}


helper_cat_list_end();

helper_cat_end('job');


/////////////////////////////////////////////////////////////

helper_cat_begin('realestate', __('Real estate'), 'big', '?cat=286');

helper_cat_image('flat', __('Flats'), '?cat=233');
helper_cat_image('house', __('Houses'), '?cat=267');
helper_cat_image('commer', __('Commercial areas'), '?cat=302');
helper_cat_image('lendarea', __('Land areas'), '?cat=301');

helper_cat_end('realestate');



/////////////////////////////////////////////////////////////


helper_cat_begin('transport', __('Vehicles'), 'big', '?cat=39');

helper_cat_image('car', __('Cars'), '?cat=295');
helper_cat_image('minibus', __('Minibuses'), '?cat=349');
helper_cat_image('bus', __('Buses'), '?cat=297');
helper_cat_image('truck', __('Trucks'), '?cat=298');


helper_cat_end('transport');


/////////////////////////////////////////////////////////////

helper_cat_begin('electronics', __('Electronics'), 'big', '?cat=322');

helper_cat_image('tv', __('TV / Home theatres'), '?cat=323');
helper_cat_image('comp', __('Computers'), '?cat=169');
helper_cat_image('tablet', __('Tablets'), '?cat=174');
helper_cat_image('phone', __('Phones'), '?cat=3');

helper_cat_end('electronics');

/*
/////////////////////////////////////////////////////////////

helper_cat_begin('vacancies', __('Vacancies'), 'middle', '?cat=127');

helper_cat_image('all_types', __('All types'), '?cat=127');

helper_cat_end('vacancies');

/////////////////////////////////////////////////////////////

helper_cat_begin('vacancies', __('Vacancies'), 'middle', '?cat=127');

helper_cat_image('all_types', __('All types'), '?cat=127');

helper_cat_end('vacancies');

/////////////////////////////////////////////////////////////

helper_cat_begin('vacancies', __('Vacancies'), 'small', '?cat=127');

helper_cat_image('all_types', __('All types'), '?cat=127');

helper_cat_end('vacancies');

/////////////////////////////////////////////////////////////

helper_cat_begin('vacancies', __('Vacancies'), 'small', '?cat=127');

helper_cat_image('all_types', __('All types'), '?cat=127');

helper_cat_end('vacancies');


/////////////////////////////////////////////////////////////

helper_cat_begin('vacancies', __('Vacancies'), 'small', '?cat=127');

helper_cat_image('all_types', __('All types'), '?cat=127');

helper_cat_end('vacancies');


/////////////////////////////////////////////////////////////
*/
?>
