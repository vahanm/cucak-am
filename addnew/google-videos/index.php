<?php
require_once(dirname(__FILE__) . '/../../wp-config.php');

global $wpdb;

//$word = str_replace('\'', '\\\'', str_replace('\\', '\\\\', arg($_GET, 'brand', '')));

//$wp_query	= " SELECT
//                  pm.`meta_value` AS model,
//                  COUNT(pm.`post_id`) AS `count`
//                FROM `{$wpdb->prefix}postmeta` pm
//                WHERE pm.meta_key = 'post_carmodelname'
//                    AND pm.post_id IN(SELECT DISTINCT
//                                        pm.`post_id`
//                                      FROM `{$wpdb->prefix}postmeta` pm
//                                      WHERE pm.meta_key = 'post_carbrand'
//                                          AND pm.`meta_value` = '{$word}')
//                GROUP BY pm.`meta_value`
//                ORDER BY pm.`meta_value` ASC; ";

////echo json_encode($wpdb->get_results($wp_query));

//$list = $wpdb->get_results($wp_query);

//foreach($list as $item) {
//    echo '<option value="' . $item->model . '">' . $item->model . '  (' . $item->count . ' ' . __('cars') . ')</option>';
//}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Google Videos</title>
    
    <link rel="alternate" type="application/rss+xml" title="Cucak.am &raquo; Feed" href="http://test.cucak.am/?feed=rss2" />
    <link rel="alternate" type="application/rss+xml" title="Cucak.am &raquo; Comments Feed" href="http://test.cucak.am/?feed=comments-rss2" />
    <!-- Google Analytics tracking code not shown because users over level 8 are ignored -->
    <link rel='stylesheet' id='wpfp-css' href='http://cucak.am/wp-content/plugins/wp-favorite-posts/wpfp.css' type='text/css' />
    <link rel="stylesheet" id="admin-bar-css"  href="http://cucak.am/wp-includes/css/admin-bar.css?ver=20111209" type="text/css" media="all" />
    <link rel="stylesheet" id="bp-admin-bar-css"  href="http://cucak.am/wp-content/plugins/buddypress/bp-core/css/admin-bar.css?ver=1.6.5" type="text/css" media="all" />
    <link rel="stylesheet" id="main-jquery-css"  href="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/ui-lightness/jquery-ui-1.9.1.full.min.css?ver=1.1" type="text/css" media="all" />
    <link rel="stylesheet" id="lightbox-css"  href="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/css/lightbox.css?ver=1.0" type="text/css" media="all" />
    <link rel="stylesheet" id="jquery-tooltip-css"  href="http://cucak.am/wp-includes/js-plugins/tooltip/themes/1/tooltip.css?ver=1.0" type="text/css" media="all" />
    <link rel="stylesheet" id="simplemarket_droidsans-css"  href="http://fonts.googleapis.com/css?family=Droid+Sans&#038;ver=3.3.2" type="text/css" media="all" />
    <link rel="stylesheet" id="simplemarket_nunito-css"  href="http://fonts.googleapis.com/css?family=Nunito&#038;v1&#038;ver=3.3.2" type="text/css" media="all" />
    
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/jquery-1.8.2.min.js?ver=1.8.2"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery-ui.1.9.1/jquery-ui-1.9.1.full.min.js?ver=1.9.1"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-api.js?ver=1.0"></script>
    <!--<script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-apply-jquery-ui.js?ver=1.0"></script>-->
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-htmlhelper.js?ver=3.3.2"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-search.js?ver=1.1"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-tooltip.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/ba-translation.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-content/plugins/ba-includes/inputdefaultvaluesupport.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery/jquery.js?ver=1.7.1"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/i18n/jquery-ui-i18n.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/jquery.ui.selectmenu.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/jquery.cookie.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/ui/minified/jquery.scrollto.min.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/jquery.smooth-scroll.min.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/lightbox.js?ver=1.0"></script>
    <script type="text/javascript" src="http://cucak.am/wp-includes/js-plugins/tooltip/themes/1/tooltip.js?ver=1.0"></script>
    
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://cucak.am/xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://cucak.am/wp-includes/wlwmanifest.xml" /> 
    <meta name="generator" content="WordPress 3.3.2" />
    <script type="text/javascript">var ajaxurl = 'http://cucak.am/wp-admin/admin-ajax.php';</script>
    <script type="text/javascript"> jQuery(document).ready( function() { jQuery("a.confirm").click( function() { if ( confirm( 'Are you sure?' ) ) return true; else return false; }); });</script>
    
    <link rel="stylesheet" id="google-images-style-css"  href="http://test.cucak.am/addnew/google-videos/style.css?ver=1.0" type="text/css" media="all" />
    <script type="text/javascript" src="http://cucak.am/addnew/google-videos/script.js?ver=1.0"></script>
</head>
<body>
    <h1 class="google-images-label">Youtube</h1>
    <form>
        <input type="text" name="q" value="<?php echo $_GET['q'] ?>"/>
        <input type="submit" value="<?php _e('Search') ?>" />
    </form>
    <div id="content" class="content">
        
    </div>
    
    <?php
        $path = 'https://www.googleapis.com/customsearch/v1?key=AIzaSyCDV_RJj-O8BSh72CIxSfPWq2k3Oh2mJuM';
        
        
        //$path .= '&cx=017235215045067018033:yvdi7g3hx48'; //Cucak.am
        //$path .= '&cx=000455696194071821846:reviews';
        //$path .= '&cx=017576662512468239146:omuauf_lfve';
        $path .= '&cx=017235215045067018033:ajpyinhpoek';
        
        
        //$path .= '&cref=' . urlencode('http://www.google.com/cse');
        
        $path .= '&callback=hndlr';
        //$path .= '&searchType=image';
        //$path .= '&imgSize=large';
        $path .= '';
        $path .= '';
        $path .= '';
        
        $path .= '&q=' . urlencode(arg($_GET, 'q', '') . ' type:video');
        
        if (isset($_GET['q'])) {
            echo "\n<script src=\"{$path}\"></script>";
        }
    ?>
    
    <?php /* if (isset($_GET['q'])) : ?>
    <script src="//www.googleapis.com/customsearch/v1?key=AIzaSyCDV_RJj-O8BSh72CIxSfPWq2k3Oh2mJuM&cx=017576662512468239146:omuauf_lfve&callback=hndlr&searchType=image&q=<?php echo urlencode($_GET['q']) ?>"></script>
    <?php endif; */ ?>
    <div id="mess" class="abs">N/A</div>
</body>
</html>
