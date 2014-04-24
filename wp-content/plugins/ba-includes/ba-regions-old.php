<?php

/* Plugin Name: BA Regions list
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin gets a list of regions
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/


function getRegions($ln)
{
	switch($ln)
	{
		case 'am_HY':
			$regions = array(
				1 => "Երևան", 
					2 => "&nbsp; &nbsp;  Աջափնյակ", 
					3 => "&nbsp; &nbsp;  Արաբկիր", 
					4 => "&nbsp; &nbsp;  Ավան", 
					5 => "&nbsp; &nbsp;  Դավիթաշեն", 
					6 => "&nbsp; &nbsp;  Էրեբունի", 
					7 => "&nbsp; &nbsp;  Քանաքեռ Զեյթուն", 
					8 => "&nbsp; &nbsp;  Կենտրոն", 
					9 => "&nbsp; &nbsp;  Մալաթիա Սեբաստիա", 
					10 => "&nbsp; &nbsp;  Նոր Նորք", 
					11 => "&nbsp; &nbsp;  Նորք Մարաշ", 
					12 => "&nbsp; &nbsp;  Նուբարաշեն", 
					13 => "&nbsp; &nbsp;  Շենգավիթ", 
				
				100 => "Արագածոտն", 
					115 => "&nbsp; &nbsp;  Ապարան", 
					116 => "&nbsp; &nbsp;  Արագած", 
					117 => "&nbsp; &nbsp;  Աշտարակ", 
					118 => "&nbsp; &nbsp;  Թալին", 
				
				200 => "Արարատ", 
					220 => "&nbsp; &nbsp;  Արարատ", 
					221 => "&nbsp; &nbsp;  Արտաշատ", 
					222 => "&nbsp; &nbsp;  Մասիս", 
				
				300 => "Արմավիր", 
					324 => "&nbsp; &nbsp;  Արմավիր", 
					325 => "&nbsp; &nbsp;  Էջմիածին", 
					326 => "&nbsp; &nbsp;  Մեծամոր", 
				
				400 => "Արցախ", 
					428 => "&nbsp; &nbsp;  Ասկերան", 
					429 => "&nbsp; &nbsp;  Հադրութ", 
					430 => "&nbsp; &nbsp;  Լաչին", 
					431 => "&nbsp; &nbsp;  Մարտակերտ", 
					432 => "&nbsp; &nbsp;  Մարտունի", 
					433 => "&nbsp; &nbsp;  Շուշի", 
					434 => "&nbsp; &nbsp;  Ստեփանակերտ", 
				
				500 => "Գեղարքունիք", 
					536 => "&nbsp; &nbsp;  Գավառ", 
					537 => "&nbsp; &nbsp;  Մարտունի ", 
					538 => "&nbsp; &nbsp;  Սևան", 
					539 => "&nbsp; &nbsp;  Վարդենիս", 
				
				600 => "Կոտայք", 
					641 => "&nbsp; &nbsp;  Աբովյան", 
					642 => "&nbsp; &nbsp;  Հրազդան", 
					643 => "&nbsp; &nbsp;  Ծաղկաձոր", 
				
				700 => "Լոռի", 
					745 => "&nbsp; &nbsp;  Ալավերդի", 
					746 => "&nbsp; &nbsp;  Սպիտակ", 
					747 => "&nbsp; &nbsp;  Վանաձոր", 
					748 => "&nbsp; &nbsp;  Ստեփանավան", 
				
				900 => "Շիրակ", 
					950 => "&nbsp; &nbsp;  Արթիկ", 
					951 => "&nbsp; &nbsp;  Գյումրի", 
				
				1000 => "Սյունիք", 
					1053 => "&nbsp; &nbsp;  Գորիս", 
					1054 => "&nbsp; &nbsp;  Կապան", 
					1055 => "&nbsp; &nbsp;  Մեղրի", 
					1056 => "&nbsp; &nbsp;  Սիսիան", 
				
				1157 => "Տավուշ", 
					1158 => "&nbsp; &nbsp;  Բերդ", 
					1159 => "&nbsp; &nbsp;  Դիլիջան", 
					1160 => "&nbsp; &nbsp;  Իջևան", 
				
				1261 => "Վայոց Ձոր", 
					1262 => "&nbsp; &nbsp;  Վայք", 
					1263 => "&nbsp; &nbsp;  Եղեգնաձոր", 
				
				9999 => "Այլ երկիր"
			);
			break;
			
		case 'ru_RU':
			$regions = array(
				1 => "Ереван",
				2 => "&nbsp; &nbsp;  Ачапняк",
				3 => "&nbsp; &nbsp;  Арабкир",
				4 => "&nbsp; &nbsp;  Аван",
				5 => "&nbsp; &nbsp;  Давидашен",
				6 => "&nbsp; &nbsp;  Эребуни",
				7 => "&nbsp; &nbsp;  Зейтун Канакер",
				8 => "&nbsp; &nbsp;  Кентрон",
				9 => "&nbsp; &nbsp;  Малатия Себастия",
				10 => "&nbsp; &nbsp;  Нор Норк",
				11 => "&nbsp; &nbsp;  Нор Мараш",
				12 => "&nbsp; &nbsp;  Нубарашен",
				13 => "&nbsp; &nbsp;  Шенгавит",
				14 => "Арагацотн",
				15 => "&nbsp; &nbsp;  Апаран",
				16 => "&nbsp; &nbsp;  Арагац",
				17 => "&nbsp; &nbsp;  Аштарак",
				18 => "&nbsp; &nbsp;  Талин",
				19 => "Арарат",
				20 => "&nbsp; &nbsp;  Арарат",
				21 => "&nbsp; &nbsp;  Арташат",
				22 => "&nbsp; &nbsp;  Масис",
				23 => "Армавир",
				24 => "&nbsp; &nbsp;  Армавир",
				25 => "&nbsp; &nbsp;  Эчмиадзин",
				26 => "&nbsp; &nbsp;  Мецамор",
				27 => "Арцах",
				28 => "&nbsp; &nbsp;  Степанакерт",
				29 => "&nbsp; &nbsp;  Аскеран",
				30 => "&nbsp; &nbsp;  Хадрут",
				31 => "&nbsp; &nbsp;  Лачин",
				32 => "&nbsp; &nbsp;  Мартакерт",
				33 => "&nbsp; &nbsp;  Мартуни",
				34 => "&nbsp; &nbsp;  Шуши",
				35 => "Гехаркуник",
				36 => "&nbsp; &nbsp;  Гавар",
				37 => "&nbsp; &nbsp;  Мартуни ",
				38 => "&nbsp; &nbsp;  Севан",
				39 => "&nbsp; &nbsp;  Варденис",
				40 => "Котайк",
				41 => "&nbsp; &nbsp;  Абовян",
				42 => "&nbsp; &nbsp;  Раздан",
				43 => "&nbsp; &nbsp;  Цахкадзор",
				44 => "Лорри",
				45 => "&nbsp; &nbsp;  Алаверди",
				46 => "&nbsp; &nbsp;  Спитак",
				47 => "&nbsp; &nbsp;  Ванадзор",
				48 => "Степанаван",
				49 => "Ширак",
				50 => "&nbsp; &nbsp;  Артик",
				51 => "&nbsp; &nbsp;  Гюмри",
				52 => "Сюник",
				53 => "&nbsp; &nbsp;  Горис",
				54 => "&nbsp; &nbsp;  Капан",
				55 => "&nbsp; &nbsp;  Мегри",
				56 => "&nbsp; &nbsp;  Сисиан",
				57 => "Тавуш",
				58 => "&nbsp; &nbsp;  Дилижан",
				59 => "&nbsp; &nbsp;  Берд",
				60 => "&nbsp; &nbsp;  Иджеван",
				61 => "Вайоц Дзор",
				62 => "&nbsp; &nbsp;  Вайк",
				63 => "&nbsp; &nbsp;  Егегнадзор",
				64 => "Вне Армении",
			);
		
			break;
		default:
			$regions = array(
				1 =>  __('Yerevan'),
					2 => '&nbsp; &nbsp;' . __('Ajapnyak'),
					3 => '&nbsp; &nbsp;' . __('Arabkir'),
					4 => '&nbsp; &nbsp;' . __('Avan'),
					5 => '&nbsp; &nbsp;' . __('Davitashen'),
					6 => '&nbsp; &nbsp;' . __('Erebuni'),
					7 => '&nbsp; &nbsp;' . __('Kanaker-Zeytun'),
					8 => '&nbsp; &nbsp;' . __('Kentron'),
					9 => '&nbsp; &nbsp;' . __('Malatia-Sebastia'),
					10 => '&nbsp; &nbsp;' . __('Nor Nork'),
					11 => '&nbsp; &nbsp;' . __('Nork-Marash'),
					12 => '&nbsp; &nbsp;' . __('Nubarashen'),
					13 => '&nbsp; &nbsp;' . __('Shengavit'),
				100 =>  __('Aragatsotn'),
					115 => '&nbsp; &nbsp;' . __('Aparan'),
					116 => '&nbsp; &nbsp;' . __('Aragats'),
					117 => '&nbsp; &nbsp;' . __('Ashtarak'),
					118 => '&nbsp; &nbsp;' . __('Talin'),
				200 =>  __('Ararat'),
					220 => '&nbsp; &nbsp;' . __('Ararat'),
					221 => '&nbsp; &nbsp;' . __('Artashat'),
					222 => '&nbsp; &nbsp;' . __('Masis'),
				300 =>  __('Armavir'),
					324 => '&nbsp; &nbsp;' . __('Armavir'),
					325 => '&nbsp; &nbsp;' . __('Echmiadzin'),
					326 => '&nbsp; &nbsp;' . __('Metsamor'),
				400 =>  __('Artsakh'),
					428 => '&nbsp; &nbsp;' . __('Stepanakert'),
					429 => '&nbsp; &nbsp;' . __('Askeran'),
					430 => '&nbsp; &nbsp;' . __('Hadrut'),
					431 => '&nbsp; &nbsp;' . __('Lachin'),
					432 => '&nbsp; &nbsp;' . __('Martakert'),
					433 => '&nbsp; &nbsp;' . __('Martuni'),
					434 => '&nbsp; &nbsp;' . __('Shushi'),
				500 =>  __('Gegharkunik'),
					536 => '&nbsp; &nbsp;' . __('Gavar'),
					537 => '&nbsp; &nbsp;' . __('Martuni '),
					538 => '&nbsp; &nbsp;' . __('Sevan'),
					539 => '&nbsp; &nbsp;' . __('Vardenis'),
				600 =>  __('Kotayk'),
					641 => '&nbsp; &nbsp;' . __('Abovian'),
					642 => '&nbsp; &nbsp;' . __('Hrazdan'),
					643 => '&nbsp; &nbsp;' . __('Tsakhkadzor'),
				700 =>  __('Lorri'),
					745 => '&nbsp; &nbsp;' . __('Alaverdi'),
					746 => '&nbsp; &nbsp;' . __('Spitak'),
					747 => '&nbsp; &nbsp;' . __('Vanadzor'),
					748 => '&nbsp; &nbsp;' . __('Stepanavan'),
				800 =>  __('Shirak'),
					850 => '&nbsp; &nbsp;' . __('Artik'),
					851 => '&nbsp; &nbsp;' . __('Gyumri'),
				900 =>  __('Syunik'),
					953 => '&nbsp; &nbsp;' . __('Goris'),
					954 => '&nbsp; &nbsp;' . __('Kapan'),
					955 => '&nbsp; &nbsp;' . __('Meghri'),
					956 => '&nbsp; &nbsp;' . __('Sisian'),
				1000 =>  __('Tavush'),
					1058 => '&nbsp; &nbsp;' . __('Dilijan'),
					1059 => '&nbsp; &nbsp;' . __('Berd'),
					1060 => '&nbsp; &nbsp;' . __('Ijevan'),
				1100 =>  __('Vayots Dzor'),
					1162 => '&nbsp; &nbsp;' . __('Vayk'),
					1163 => '&nbsp; &nbsp;' . __('Yeghegnadzor'),
					
				100000 =>  __('Other country'),
			);
	}
	
	return $regions;
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