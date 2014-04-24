<?php

echo '<table id="generalinfo">';


/* ------------------------------------------------------------------------------------- */


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


/* ------------------------------------------------------------------------------------- */
echo '</table>';

?>
