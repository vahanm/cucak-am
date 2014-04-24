<?php
// Create XML output
header("content-type:text/xml;charset=utf-8");

// look up for the path
if(file_exists(dirname(dirname(dirname(__FILE__))) . "/flash-album-gallery/flag-config.php")) {
	require_once( str_replace("\\","/", dirname(dirname(dirname(__FILE__))) . "/flash-album-gallery/flag-config.php") );
} else if(file_exists(dirname(dirname(dirname(__FILE__))) . "/flag-config.php")) {
	require_once( str_replace("\\","/", dirname(dirname(dirname(__FILE__))) . "/flag-config.php") );
}

global $wpdb;

$flag_options = get_option ('flag_options');
$siteurl = get_option ('siteurl');
$url_plug = plugins_url() . '/' . FLAGFOLDER . '/';

// get the gallery id
$gID = explode( '_', $_GET['gid'] );

if ( is_user_logged_in() )
	$exclude_clause = '';
else
	$exclude_clause = ' AND exclude<>1 ';

require_once( str_replace("\\","/", dirname(__FILE__).'/settings.php') );
$file_settings = str_replace("\\","/", dirname(dirname(__FILE__)).'/'.basename( dirname(__FILE__) ).'_settings.php');
if ( file_exists( $file_settings ) ) {
	include_once( $file_settings );
}
$background = $flashBacktransparent ? '' : "0x{$flashBackcolor}";
echo "<xml>\n"; ?>
<color>
	<!--graphic elements-->
	<background color="<?php echo $background; ?>"/>
	<buttons_bg color="0x<?php echo $buttonsBG; ?>"/>
	<buttons mouseOver="0x<?php echo $buttonsMouseOver; ?>" mouseOut="0x<?php echo $buttonsMouseOut; ?>"/>
	<categoryButtons mouseOver="0x<?php echo $catButtonsMouseOver; ?>" mouseOut="0x<?php echo $catButtonsMouseOut; ?>"/>
	<categoryButtonsText mouseOver="0x<?php echo $catButtonsTextMouseOver; ?>" mouseOut="0x<?php echo $catButtonsTextMouseOut; ?>"/>
	<thumbnail mouseOver="0x<?php echo $thumbMouseOver; ?>" mouseOut="0x<?php echo $thumbMouseOut; ?>"/>
	<!--text elements-->
	<mainTitle textColor="0x<?php echo $mainTitle; ?>"/>
	<categoryTitle textColor="0x<?php echo $categoryTitle; ?>"/>
	<item_bg color="0x<?php echo $itemBG; ?>"/>
	<itemTitle textColor="0x<?php echo $itemTitle; ?>"/>
	<itemDescription textColor="0x<?php echo $itemDescription; ?>"/>
	<autoSlideShow data="<?php echo $autoSlideShow; ?>"/>
	<slDelay data="<?php echo $slDelay; ?>"/>
	<plug data="<?php echo $url_plug; ?>"/>
</color>
<?php
echo "<gallery title='".attribute_escape(stripslashes($_GET['albumname']))."'>\n";
// get the pictures
foreach ( $gID as $galleryID ) {
	$galleryID = (int) $galleryID;
	if ( $galleryID == 0) {
		$thepictures = $wpdb->get_results("SELECT t.*, tt.* FROM $wpdb->flaggallery AS t INNER JOIN $wpdb->flagpictures AS tt ON t.gid = tt.galleryid WHERE 1=1 {$exclude_clause} ORDER BY tt.{$flag_options['galSort']} {$flag_options['galSortDir']} ");
	} else {
		$thepictures = $wpdb->get_results("SELECT t.*, tt.* FROM $wpdb->flaggallery AS t INNER JOIN $wpdb->flagpictures AS tt ON t.gid = tt.galleryid WHERE t.gid = '$galleryID' {$exclude_clause} ORDER BY tt.{$flag_options['galSort']} {$flag_options['galSortDir']} ");
	}

	echo "  <category id='".$galleryID."' title='".attribute_escape(flagGallery::i18n(strip_tags(stripslashes($thepictures[0]->title))))."'>\n";
	echo "    <items>\n";

	if (is_array ($thepictures)){
		foreach ($thepictures as $picture) {
			echo "      <item id='".$picture->pid."' image_icon='".$siteurl."/".$picture->path."/thumbs/thumbs_".$picture->filename."' pic='".$siteurl."/".$picture->path."/".$picture->filename."' title ='".attribute_escape(flagGallery::i18n(strip_tags(stripslashes($picture->alttext))))."'><![CDATA[".html_entity_decode(attribute_escape(flagGallery::i18n(stripslashes($picture->description))))."]]></item>\n";
		}
	}

	echo "    </items>\n";
	echo "  </category>\n";
}
echo "</gallery>\n";
echo "</xml>"; ?>