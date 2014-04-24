<?PHP
/*
ini_set('upload_max_filesize', '32M');
ini_set('post_max_size', '32M');
*/

require_once(dirname(__FILE__).'/../wp-config.php');


$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
    <!--
	<link rel="Stylesheet" type="text/css" media="all" href="/wp-content/themes/simplemarket/style.css" />
	-->
	
	<link rel="stylesheet" type="text/css" href="/wp-includes/css/themes/ui-lightness/jquery.ui.all.css" />
	<style>
		body
		{
			font-size: 12px;
		}
	</style>
	<script src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"></script>
	<script src="/wp-includes/js/jquery.1.8.21/jquery-ui-1.8.21.custom.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.asButton').button();
		});
		
		function sendfile()
		{
			var isTooLarge = false;
			
			$('#fileinput').each(function(){
				$(this.files).each(function(key, value){
					if(this.size > <?php echo $upload_mb * 1024 * 1024 - 1 ?>) {
						isTooLarge = true;
					}
				});
			});
			
			if(isTooLarge) {
				alert('<?php _e('One of selected files is too large.') ?>');
				return;
			}
			
			$('#fileinput').hide();
			$('#uploading-message').show();
			
			$('#fileupload').submit();
		}
		
		function onlabelclick() {
			$('#fileinput').trigger('click');
		}
	</script>
</head>

<body>
    <div class="addpostctrl">
        <form id="fileupload" action="photos-up.php" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
		<!--	<label class="asButton" for="fileinput_" class="asButton" onclick="onlabelclick()"><?php _e('Add image or any file') ?></label>
			<input type="file" name="file" id="fileinput" class="txtbg" style="display: none;" onChange = "sendfile()" /> -->
			<input type="file" name="file" id="fileinput" class="txtbg" onChange = "sendfile()" />
			<span id="uploading-message" style="display: none; font-size: 130%; color: #500;"><?php _e('Uploading... Please wait.') ?></span>
			<br />
			<span class="hint">(<?php echo _t('Maximum: %s MB', $upload_mb); /*echo $max_upload, '-', $max_post;*/ ?>)</span>
        </form>
    </div>
</body>
</html>
