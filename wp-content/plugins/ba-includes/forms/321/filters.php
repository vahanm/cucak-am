<?php


filter_location(array(
      'id'			=>	'item_location'
    , 'title' 		=>	__('Service location')
    , 'priority'	=> PRIMARY_FILTER
));



if(WPLANG == 'en_EN')
    filter_select(array(
      'id'		=>		'servicesphere'
    , 'title'	=>		__('Sphere')
    , 'values'	=>	array( 
                    array('financedit', __('Accounting / Finance / Audit')),
                    array('art', __('Arts')),
                    array('standupmeal', __('Buffet table decoration')),
                    array('autoservice', __('Car service')),
                    array('carechildren', __('Care for children, elderly, sick')),
                    array('ceremonies', __('Ceremonies organizing')),
                    array('computereqt', __('Computer equipment / Internet')),
                    array('cooking', __('Cooking')),
                    array('designserv', __('Design')),
                    array('education', __('Education / Teaching')),
                    array('fur_producing', __('Furniture producing')),
                    array('health', __('Health / Medicine')),
                    array('hairdressing', __('Hairdressing, facial and body care')),
                    array('houseworks', __('House works')),
                    array('legalserv', __('Legal services')),
                    array('mobilehome', __('Mobile / Home phone')),
                    array('packaging', __('Packaging')),
                    array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                    array('mediaphoto', __('Photo shooting / Filming')),
                    array('repairelectrical', __('Repair of electrical equipments')),
                    array('repairworks', __('Repair works')),
                    array('salesmarketing', __('Sales / Marketing')),
                    array('securitybodyguard', __('Security / Bodyguard')),
                    array('travelexcursions', __('Travel / Excursions / Guides')),
                    array('other', __('other')))
    , 'priority'=> PRIMARY_FILTER
));


if(WPLANG == 'ru_RU')
    filter_select(array(
      'id'		=>'servicesphere'
    , 'title'	=>__('Sphere')
        , 'values'	=>array( 
                    array('autoservice', __('Car service')),
                    array('financedit', __('Accounting / Finance / Audit')),
                    array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                    array('designserv', __('Design')),
                    array('health', __('Health / Medicine')),
                    array('art', __('Arts')),
                    array('computereqt', __('Computer equipment / Internet')),
                    array('cooking', __('Cooking')),
                    array('fur_producing', __('Furniture producing')),
                    array('mobilehome', __('Mobile / Home phone')),
                    array('education', __('Education / Teaching')),
                    array('ceremonies', __('Ceremonies organizing')),
                    array('securitybodyguard', __('Security / Bodyguard')),
                    array('hairdressing', __('Hairdressing, facial and body care')),
                    array('salesmarketing', __('Sales / Marketing')),
                    array('houseworks', __('House works')),
                    array('repairelectrical', __('Repair of electrical equipments')),
                    array('repairworks', __('Repair works')),
                    array('travelexcursions', __('Travel / Excursions / Guides')),
                    array('standupmeal', __('Buffet table decoration')),
                    array('packaging', __('Packaging')),
                    array('carechildren', __('Care for children, elderly, sick')),
                    array('mediaphoto', __('Photo shooting / Filming')),
                    array('legalserv', __('Legal services')),
                    array('other', __('other')))
    , 'priority'=> PRIMARY_FILTER
));


if(WPLANG == 'am_HY')
    filter_select(array(
      'id'		=>'servicesphere'
    , 'title'	=>__('Sphere')
        , 'values'	=>array( 
                    array('health', __('Health / Medicine')),
                    array('autoservice', __('Car service')),
                    array('art', __('Arts')),
                    array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                    array('mobilehome', __('Mobile / Home phone')),
                    array('designserv', __('Design')),
                    array('carechildren', __('Care for children, elderly, sick')),
                    array('repairelectrical', __('Repair of electrical equipments')),
                    array('legalserv', __('Legal services')),
                    array('cooking', __('Cooking')),
                    array('fur_producing', __('Furniture producing')),
                    array('education', __('Education / Teaching')),
                    array('computereqt', __('Computer equipment / Internet')),
                    array('financedit', __('Accounting / Finance / Audit')),
                    array('ceremonies', __('Ceremonies organizing')),
                    array('securitybodyguard', __('Security / Bodyguard')),
                    array('hairdressing', __('Hairdressing, facial and body care')),
                    array('repairworks', __('Repair works')),
                    array('houseworks', __('House works')),
                    array('travelexcursions', __('Travel / Excursions / Guides')),
                    array('packaging', __('Packaging')),
                    array('mediaphoto', __('Photo shooting / Filming')),
                    array('standupmeal', __('Buffet table decoration')),
                    array('other', __('other')))
    , 'priority'=> PRIMARY_FILTER
));

