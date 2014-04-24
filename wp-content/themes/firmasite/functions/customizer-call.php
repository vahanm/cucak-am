<?php
/*
I was calling theme settings in functions.php and was calling settings as global variable in theme files. 
This was working properly except temporary changes was disappearing in theme customizer"s live edit when you change page with clicking links.
This file fixes that.
Read if you want more details: http://wordpress.stackexchange.com/questions/82723/theme-customizer-changes-are-dissappearing-when-change-page
*/

global $firmasite_settings;
$firmasite_settings = get_option( "firmasite_settings" ); // site options

do_action("firmasite_settings_open");

if(!isset($firmasite_settings["style"]) || empty($firmasite_settings["style"]))	$firmasite_settings["style"] = "united";
if(!isset($firmasite_settings["layout"]) || empty($firmasite_settings["layout"])) $firmasite_settings["layout"] = "content-sidebar";

switch ($firmasite_settings["layout"]) {
    case "sidebar-content":
		$firmasite_settings["layout_primary_class"] = "span8 pull-right";
 		$firmasite_settings["layout_primary_fullwidth_class"] = "span12";
		$firmasite_settings["layout_secondary_class"] = "span4";		
		$firmasite_settings["layout_container_class"] = "container";		
 		$firmasite_settings["layout_page_class"] = "";		
      break;
    case "only-content":
 		$firmasite_settings["layout_primary_class"] = "span12";
 		$firmasite_settings["layout_primary_fullwidth_class"] = "span12";
		$firmasite_settings["layout_secondary_class"] = "hide";		
		$firmasite_settings["layout_container_class"] = "container";		
 		$firmasite_settings["layout_page_class"] = "site-only-content";		
      break;
    case "only-content-long":
 		$firmasite_settings["layout_primary_class"] = "span12";
 		$firmasite_settings["layout_primary_fullwidth_class"] = "span12";
		$firmasite_settings["layout_secondary_class"] = "hide";		
		$firmasite_settings["layout_container_class"] = "container";		
 		$firmasite_settings["layout_page_class"] = "site-only-content-long";		
      break;
	default:
    case "content-sidebar":
 		$firmasite_settings["layout_primary_class"] = "span8";
 		$firmasite_settings["layout_primary_fullwidth_class"] = "span12";
		$firmasite_settings["layout_secondary_class"] = "span4";		
		$firmasite_settings["layout_container_class"] = "container";		
 		$firmasite_settings["layout_page_class"] = "";		
       break;	
}

$firmasite_settings["styles"] = apply_filters( 'firmasite_theme_styles', array(
			"default" => esc_attr__( 'Default', 'firmasite' ),	//0
			"amelia" => esc_attr__( 'Amelia', 'firmasite' ),	//1
			"cerulean" => esc_attr__( 'Cerulean', 'firmasite' ),	//2
			"cosmo" => esc_attr__( 'Cosmo', 'firmasite' ),	//3
			"cyborg" => esc_attr__( 'Cyborg', 'firmasite' ),	//4
			"journal" => esc_attr__( 'Journal', 'firmasite' ),	//5
			"readable" => esc_attr__( 'Readable', 'firmasite' ),	//6
			"simplex" => esc_attr__( 'Simplex', 'firmasite' ),	//7
			"slate" => esc_attr__( 'Slate', 'firmasite' ),	//8
			"spacelab" => esc_attr__( 'Spacelab', 'firmasite' ),	//9
			"spruce" => esc_attr__( 'Spruce', 'firmasite' ),	//10
			"superhero" => esc_attr__( 'Superhero', 'firmasite' ),//11
			"united" => esc_attr__( 'United', 'firmasite' ),	//12
		));
		
$firmasite_styles_url_default = get_template_directory_uri() . '/assets/themes/';
$firmasite_settings["styles_url"] = apply_filters( 'firmasite_theme_styles_url', array(		
			"default" => $firmasite_styles_url_default. "default",	//0
			"amelia" => $firmasite_styles_url_default. "amelia",	//1
			"cerulean" => $firmasite_styles_url_default. "cerulean",	//2
			"cosmo" => $firmasite_styles_url_default. "cosmo",	//3
			"cyborg" => $firmasite_styles_url_default. "cyborg",	//4
			"journal" => $firmasite_styles_url_default. "journal",	//5
			"readable" => $firmasite_styles_url_default. "readable",	//6
			"simplex" => $firmasite_styles_url_default. "simplex",	//7
			"slate" => $firmasite_styles_url_default. "slate",	//8
			"spacelab" => $firmasite_styles_url_default. "spacelab",	//9
			"spruce" => $firmasite_styles_url_default. "spruce",	//10
			"superhero" => $firmasite_styles_url_default. "superhero",//11
			"united" => $firmasite_styles_url_default. "united",	//12
		));


do_action("firmasite_settings_close");

apply_filters( 'firmasite_settings_filter', $firmasite_settings );


