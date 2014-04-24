<?PHP

require_once(dirname(__FILE__).'/../wp-config.php');


$max_upload = (int)(ini_get('upload_max_filesize'));
$max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <!--
    <link rel="Stylesheet" type="text/css" media="all" href="/wp-content/themes/simplemarket/style.css" />
    -->
    
    <link rel="stylesheet" type="text/css" href="/wp-includes/css/themes/ui-lightness/jquery.ui.all.css" />
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }
        .u-button-add {
            width: 280px;
            height: 32px;
            border: 1px solid #0148A3;
            background: #C4E8F8;
            padding: 10px;
            text-align: left;
            position: relative;
            top: 0px;
            left: 0px;
            cursor: pointer;
            display: block;
        }
        .u-button-add:hover {
            background: #C4E8F8;
        }
        .u-button-add > * {
            position: absolute;
        }
        .u-button-add-image {
            width: 32px;
            height: 32px;
        }
        .u-button-add-label {
            font-size: 10pt;
            font-weight: bold;
            left: 50px;
        }
        .u-button-add-hint {
            left: 50px;
            top: 31px;
            font-size: 8pt;
        }
        .u-input-file {
            width: 300px;
            border: 1px solid;
            margin: 0px;
            padding: 0px;
            position: absolute;
            top: 0px;
            left: 0px;
            height: 52px;
            opacity: 0;
            filter: alpha(opacity=0);
            cursor: pointer;
        }
        .u-uploading-message {
            font-size: 10pt;
        }
    </style>
    
    <!--[if lt IE 7 ]>	<style>.u-input-file { display: none; }</style> <![endif]-->
    <!--[if IE 7 ]>		<style>.u-input-file { display: none; }</style> <![endif]-->
    <!--[if IE 8 ]>		<style>.u-input-file { display: none; }</style> <![endif]-->
    <!--[if IE 9 ]>		<style>.u-input-file { display: none; }</style> <![endif]-->
    
    <script src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"></script>
    <script src="/wp-includes/js/jquery.1.8.21/jquery-ui-1.8.21.custom.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.asButton').button();
        });
        
        function sendfile() {
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
            
            $('.u-button-add').hide();
            $('#uploading-message').show();
            
            $('#fileupload').submit();
        }
        
        function onlabelclick() {
            $('#fileinput').trigger('click');
        }
    </script>
</head>

<body>
    <form id="fileupload" action="up.php" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
        <label class="u-button-add" for="fileinput">
            <img class="u-button-add-image" src="<?php echo site_url('/wp-includes/images/1375712537_plus_32.png') ?>" />
            <div class="u-button-add-label"><?php _e('Add image or any file') ?></div>
            <div class="u-button-add-hint">(<?php echo _t('Maximum: %s MB', $upload_mb) ?>)</div>
            <input type="file" name="file" id="fileinput" class="txtbg u-input-file" onChange = "sendfile()" />
        </label>
        <span id="uploading-message" class="u-uploading-message" style="display: none; font-size: 130%; color: #500;"><?php _e('Uploading... Please wait.') ?></span>
    </form>
</body>
</html>
