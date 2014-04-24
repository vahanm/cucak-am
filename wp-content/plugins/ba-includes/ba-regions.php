<?php

/* Plugin Name: BA Regions list
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin gets a list of regions
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/
function getRegionString($id, $count = 4)
{
	$loc = getRegionSplitted($id);
	
	while(count($loc) > $count)
		array_shift($loc);
	
	$locStr = array_shift($loc);

	foreach($loc as $item)
		$locStr .= ', ' . $item;
	
	return $locStr;
}

function getRegionSplitted($id)
{
	$list = getRegions();
	
	$result = array();
	
	$start;
	
	for($start = 1; $start <= 4; $start++)
	{
		if($id % (pow(100, $start)) > 0)
			break;
	}
	
	for($i = $start; $i <= 4; $i++)
	{
		if(isset($list[$id]))
			array_push($result, trim(str_replace('&nbsp;', '', $list[$id])));
		
		$id = $id - ($id % pow(100, $i));
	}
	
	//return $result;
	return array_reverse($result);
}

function getRegions()
{
	return array(
//      ..||..||
		10000000 =>  __('Armenia'),
		
		10010000 => '&nbsp; &nbsp;' . __('Yerevan'),
		
		10010100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Ajapnyak'),
		10010200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Arabkir'),
		10010300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Avan'),
		10010400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Davitashen'),
		10010500 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Erebuni'),
		10010600 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Kanaker-Zeytun'),
		10010700 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Kentron'),
		10010800 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Malatia-Sebastia'),
		10011000 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Nor Nork'),
		10011100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Nork-Marash'),
		10011200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Nubarashen'),
		10011300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Shengavit'),
		
		10020000 => '&nbsp; &nbsp;' .  __('Aragatsotn'),
		10020100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Aparan'),
		10020200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Aragats'),
		10020300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Ashtarak'),
		10020400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Talin'),
		
		10030000 => '&nbsp; &nbsp;' .  __('Ararat'),
		10030100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Ararat'),
		10030200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Artashat'),
		10030300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Masis'),
		
		10040000 => '&nbsp; &nbsp;' .  __('Armavir'),
		10040100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Armavir'),
		10040200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Echmiadzin'),
		10040300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Metsamor'),
		
		10050000 => '&nbsp; &nbsp;' .  __('Artsakh'),
		10050100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Stepanakert'),
		10050200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Askeran'),
		10050300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Hadrut'),
		10050400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Lachin'),
		10050500 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Martakert'),
		10050600 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Martuni'),
		10050700 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Shushi'),
		
		10060000 => '&nbsp; &nbsp;' .  __('Gegharkunik'),
		10060100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Gavar'),
		10060200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Martuni '),
		10060300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Sevan'),
		10060400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Vardenis'),
		
		10070000 => '&nbsp; &nbsp;' .  __('Kotayk'),
		10070100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Abovian'),
		10070200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Hrazdan'),
		10070300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Tsakhkadzor'),
			 
		10080000 => '&nbsp; &nbsp;' .  __('Lorri'),
		10080100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Alaverdi'),
		10080200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Spitak'),
		10080300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Vanadzor'),
		10080400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Stepanavan'),
		
		10090000 => '&nbsp; &nbsp;' .  __('Shirak'),
		10090100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Artik'),
		10090200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Gyumri'),
		
		10100000 => '&nbsp; &nbsp;' .  __('Syunik'),
		10100100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Goris'),
		10100200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Kapan'),
		10100300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Meghri'),
		10100400 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Sisian'),
		
		10110000 => '&nbsp; &nbsp;' .  __('Tavush'),
		10110200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Berd'),
		10110100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Dilijan'),
		10110300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Ijevan'),
		
		10120000 => '&nbsp; &nbsp;' .  __('Vayots Dzor'),
        10120300 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Jermuk'),
		10120200 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Yeghegnadzor'),
		10120100 => '&nbsp; &nbsp;' . '&nbsp; &nbsp;' . __('Vayk'),
		
		11000000 => __('USA'),
		12000000 => __('UAE'),
		13000000 => __('Belarus'),
		14000000 => __('Belgium'),
		15000000 => __('Bulgaria'),
		16000000 => __('Germany'),
		17000000 => __('Egypt'),
		18000000 => __('Estonia'),
		19000000 => __('Turkey'),
		20000000 => __('Italy'),
		21000000 => __('Spain'),
		22000000 => __('Iran'),
		23000000 => __('Latvia'),
		24000000 => __('Poland'),
		25000000 => __('Lithuania'),
		26000000 => __('South Korea'),
		27000000 => __('Hungary'),
		28000000 => __('Japan'),
		29000000 => __('Malaysia'),
		30000000 => __('United Kingdom'),
		31000000 => __('Netherlands'),
		32000000 => __('Czech'),
		33000000 => __('China'),
		34000000 => __('Romania'),
		35000000 => __('Russia'),
		36000000 => __('Georgia'),
		37000000 => __('Finland'),
		38000000 => __('France'),
		
		
		99000000 =>  __('Other country'),
		);
}

/*
?>







(USD) US Dollar
(CAD) Canadian Dollar
(EUR) Euro
(GBP) British Pound
(AUD) Australian Dollar
(JPY) Japanese Yen
(TRY) Turkish Lira
(VEF) Venezuelan Bolivar
(COP) Colombian Peso
(NOK) Norwegian Krone
(SEK) Swedish Krona
(DKK) Danish Krone
(CLP) Chilean Peso
(HKD) Hong Kong Dollar
(CHF) Swiss Franc
(NZD) New Zealand Dollar
(MXN) Mexican Peso
(ZAR) South African Rand
(ILS) Israeli New Shekel
(ARS) Argentine Peso
(BOB) Bolivian Boliviano
(BRL) Brazilian Real
(CNY) Chinese Yuan
(CRC) Costa Rican Colon
(CZK) Czech Koruna
(GTQ) Guatemalan Quetza
(HNL) Honduran Lempira
(HUF) Hungarian Forint
(ISK) Iceland Krona
(INR) Indian Rupee
(MOP) Macau Patacas
(MYR) Malaysian Ringgit
(NIO) Nicaraguan Cordoba
(PYG) Paraguayan Guarani
(PEN) Peruvian Nuevo Sol
(PLN) Polish Zloty
(PHP) Philippine Peso
(QAR) Qatari Rials
(RON) Romanian Leu
(RUB) Russian Ruble
(SAR) Saudi Arabian Riyal
(SGD) Singapore Dollar
(KRW) Korean Won
(TWD) Taiwan Dollar
(THB) Thai Baht
(AED) UAE Dirham
(UYU) Uruguay Peso
(VND) Vietnamese Dong
(IDR) Indonesian Rupiah


*/