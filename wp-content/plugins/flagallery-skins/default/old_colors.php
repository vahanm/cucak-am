<?php header("content-type:text/xml;charset=utf-8"); ?>
<!--<?php 
// look up for the path
if(file_exists(dirname(dirname(dirname(__FILE__))) . "/flash-album-gallery/flag-config.php")) {
	require_once( str_replace("\\","/", dirname(dirname(dirname(__FILE__))) . "/flash-album-gallery/flag-config.php") );
} else if(file_exists(dirname(dirname(dirname(__FILE__))) . "/flag-config.php")) {
	require_once( str_replace("\\","/", dirname(dirname(dirname(__FILE__))) . "/flag-config.php") );
}
?>-->
<?php
$flag_options = get_option('flag_options');

$background = $flag_options['flashBacktransparent'] ? '' : '0x'.str_replace('#','',$flag_options['flashBackcolor']);
$buttonsBG = str_replace('#','',$flag_options['buttonsBG']);
$buttonsOver = str_replace('#','',$flag_options['buttonsMouseOver']);
$buttonsOut = str_replace('#','',$flag_options['buttonsMouseOut']);
$catButtonsOver = str_replace('#','',$flag_options['catButtonsMouseOver']);
$catButtonsOut = str_replace('#','',$flag_options['catButtonsMouseOut']);
$catButtonsTextOver = str_replace('#','',$flag_options['catButtonsTextMouseOver']);
$catButtonsTextOut = str_replace('#','',$flag_options['catButtonsTextMouseOut']);
$thumbOver = str_replace('#','',$flag_options['thumbMouseOver']);
$thumbOut = str_replace('#','',$flag_options['thumbMouseOut']);
$mainTitle = str_replace('#','',$flag_options['mainTitle']);
$categoryTitle = str_replace('#','',$flag_options['categoryTitle']);
$itemBG = str_replace('#','',$flag_options['itemBG']);
$itemTitle = str_replace('#','',$flag_options['itemTitle']);
$itemDescription = str_replace('#','',$flag_options['itemDescription']);
?>
<color>
	<!--graphic elements-->
	<background color="<?php echo $background; ?>"/>
	<buttons_bg color="0x<?php echo $buttonsBG; ?>"/>
	<buttons mouseOver="0x<?php echo $buttonsOver; ?>" mouseOut="0x<?php echo $buttonsOut; ?>"/>
	<categoryButtons mouseOver="0x<?php echo $catButtonsOver; ?>" mouseOut="0x<?php echo $catButtonsOut; ?>"/>
	<categoryButtonsText mouseOver="0x<?php echo $catButtonsTextOver; ?>" mouseOut="0x<?php echo $catButtonsTextOut; ?>"/>
	<thumbnail mouseOver="0x<?php echo $thumbOver; ?>" mouseOut="0x<?php echo $thumbOut; ?>"/>
	<!--text elements-->
	<mainTitle textColor="0x<?php echo $mainTitle; ?>"/>
	<categoryTitle textColor="0x<?php echo $categoryTitle; ?>"/>
	<item_bg color="0x<?php echo $itemBG; ?>"/>
	<itemTitle textColor="0x<?php echo $itemTitle; ?>"/>
	<itemDescription textColor="0x<?php echo $itemDescription; ?>"/>
</color>
