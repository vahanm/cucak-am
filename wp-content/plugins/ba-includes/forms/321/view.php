<?php

//$my_excerpt = json_decode(get_the_excerpt(), True);
//
//$pcont = '';

//$pcont .= '<div style="float:right;">' . cur_ConvertedString($my_excerpt['post_price_sale'] . ' ' . $my_excerpt['post_currency']) . '</div>';

//$pcont .= '<div style="width: 60%; float: left; margin: 5px; margin-bottom: 30px; padding: 5px;">';
//
//$pcont .= 'Name: <a href="?author=' . $my_excerpt["post_userid"] . '">' . $my_excerpt["post_aname"] . '</a><br/>';
//$pcont .= 'Phone: <a href="callto:' . $my_excerpt["post_phone"] . '">' . $my_excerpt["post_phone"] . '</a><br/>';
//$pcont .= 'E-Mail: <a href="mailto:' . $my_excerpt["post_aemail"] . '">' . $my_excerpt["post_aemail"] . '</a><br/>';
//
//$pcont .= 'Price: ' . cur_Format($my_excerpt['post_price_sale'] . ' ' . $my_excerpt['post_currency']);
//
//$pcont .= '</div>';

//echo $pcont;

render_table_begin();

render_group_sub(__('General'));

render_location('item_location', __('Service location'));




render_value('address', __('Address'), '%s ' );

render_value('servicesphere', __('Sphere'), 'Error', array(
	'autoservice' => __('Car service'),
    'art' => __('Arts'),
	'carechildren' => __('Care for children, elderly, sick'),
	'ceremonies' => __('Ceremonies organizing'),
	'computereqt' => __('Computer equipment / Internet'),
	'cooking' => __('Cooking'),
    'designserv' => __('Design'),
	'education' => __('Education / Teaching'),
	'financedit' => __('Accounting / Finance / Audit'),
    'fur_producing' => __('Furniture producing'),
    'health' => __('Health / Medicine'),
	'houseworks' => __('House works'),
	'legalserv' => __('Legal services'),
	'mediaphoto' => __('Photo shooting / Filming'),
	'hairdressing' => __('Hairdressing, facial and body care'),
	'mobilehome' => __('Mobile / Home phone'),
    'packaging' => __('Packaging'),
	'passengercargo' => __('Passenger and cargo transportation / Taxi'),
	'repairelectrical' => __('Repair of electrical equipments'),
	'repairworks' => __('Repair works'),
	'salesmarketing' => __('Sales / Marketing'),
	'securitybodyguard' => __('Security / Bodyguard'),
    'standupmeal' => __('Buffet table decoration'),
	'travelexcursions' => __('Travel / Excursions / Guides'),
	'other' => __('other')
	));



render_table_end();

?>