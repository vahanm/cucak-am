<?php
//$_GET['d'] = 1;
require_once(dirname(__FILE__) . '/../../wp-config.php');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Bing Search - Images</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    
    <link rel="stylesheet" id="main-jquery-css"  href="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/ui-lightness/jquery-ui-1.9.1.full.min.css?ver=1.1" type="text/css" media="all" />
    <link rel="stylesheet" id="lightbox-css"  href="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/css/lightbox.css?ver=1.0" type="text/css" media="all" />
    
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/jquery-1.8.2.min.js?ver=1.8.2"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/jquery-ui-1.9.1.full.min.js?ver=1.9.1"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-api.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/inputdefaultvaluesupport.js?ver=1.0"></script>

    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/i18n/jquery-ui-i18n.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/jquery.ui.selectmenu.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/jquery.cookie.js?ver=1.0"></script>
    
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/minified/jquery.scrollto.min.js?ver=1.0"></script>
    
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/jquery.smooth-scroll.min.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/lightbox.js?ver=1.0"></script>
    
    <link rel="stylesheet" id="bing-search-style-css"  href="http://cucak.am/addnew/bing-search/style.css?ver=1.0" type="text/css" media="all" />
    <script type="text/javascript" src="http://cucak.am/addnew/bing-search/script.js?ver=1.0"></script>
</head>
<body>
    <h1 class="bing-search-label">Bing Search</h1>
    <form method="post">
        <input name="query" type="text" size="50" maxlength="60" value="<?php if (isset($_POST['query'])) echo $_POST['query'] ?>" /><br />
        <input name="bt_search" type="submit" value="<?php _e('Search') ?>" />
    </form>
    <div id="content" class="content">
<?php        
        $acctKey = 'jM4rG1w7Go9+OHWI/mkxX+xFfMWi65R/5r+/5cdrTT8=';
        $acctKey = 'f08THwecj4rfL0yoLWhmeHu6Y6A/1lFTP+7BRTPp+3I=';

        $rootUri = 'https://api.datamarket.azure.com/Bing/Search/';

        // Read the contents of the .html file into a string.

        if (isset($_POST['query']) && $_POST['query']) {
            // Encode the query and the single quotes that must surround it.
            $query = urlencode("'{$_POST['query']}'");

            // Get the selected service operation (Web or Image).
            $serviceOp = 'Image'; //$_POST['service_op'];

            // Construct the full URI for the query.
            $requestUri = "$rootUri/$serviceOp?\$format=json&Adult=%27Moderate%27&ImageFilters=%27Size%3ALarge%27&Query=$query";
      
            $process = curl_init($requestUri);
            curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($process, CURLOPT_USERPWD,  $acctKey . ":" . $acctKey);
            curl_setopt($process, CURLOPT_TIMEOUT, 30);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($process);
    
            // Decode the response. 
            $jsonObj = json_decode($response);
    
            // Parse each result according to its metadata type.
            foreach($jsonObj->d->results as $value) {
                switch ($value->__metadata->type)
                { 
                    case 'ImageResult': 
                        echo '<div class="result-link">'
                           , '<a href="', $value->MediaUrl, '" title="', $value->Title, '" target="_blank" rel="--lightbox[bing-images]" imagetitle="', $value->Title, '">'
                           , '<img class="result-image" src="', $value->Thumbnail->MediaUrl, '">'
                           , '<div class="result-size" >', $value->Width, 'x', $value->Height, ', ',  formatSizeUnits($value->FileSize), '</div>'
                           , '</a>'
                           , '<div class="result-add" >', __('Add'), '</div>'
                           , '</div>'
                           ;
                           
                        break; 
                } 
            }
        }
?>
    </div>
</body>
</html>
