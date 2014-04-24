<?php
/**
 * Header
 *
 * @package Cucak.am
 * @subpackage Template
 * @since Cucak.am 1.0
 */


/* Disable WordPress Admin Bar for all users but admins. */
//if (!current_user_can('administrator'))
//    show_admin_bar(false);





$authorId = arg($_GET, 'author', 0);

if ($authorId > 0) {
    $blogName = get_user_meta($authorId, 'page_header', true);
    $name = get_user_meta($authorId, 'display_name', true);
    
    //$blogName = (strlen($blogName) > 0) ? $blogName . ' - Cucak.am' : ( (strlen($name) > 0) ? $name . ' - Cucak.am' : __(get_bloginfo('name')));
    $blogName = (strlen($blogName) > 0) ? $blogName : ( (strlen($name) > 0) ? $name : __(get_bloginfo('name')));
    $name = (strlen($name) > 0) ? $name : __('Home');
    
    $user_header_image = get_user_meta($authorId, 'header_image', true);

    if ($user_header_image)
        $user_header_image = json_decode(replace_quotes_decode($user_header_image));

    if ($user_header_image)
        $user_header_image = $user_header_image->standards_url;
    
    $authorPage = arg($_GET, 'page', '');

    switch ($authorPage) {
        case 'photos': case 'about': case 'info': case 'contacts':
            break;
        default:
            $authorPage = 'home';
    }

    $authorKey = getAuthorKey($authorId);
    if ($authorKey) {
        $prefix ="//$authorKey";
    } else {
        $prefix = site_url("/$authorId");
    }
} else {
    $prefix = home_url();
    $blogName = __(get_bloginfo('name'));
}

global $page, $paged, $isSocial;

//$title = '';
//$title = join_title($title, wp_title( $separator = ' $ ', false, 'right' ), $separator);
//
//if ( $paged >= 2 || $page >= 2 ) {
//    $title = join_title($title, sprintf( __( 'Page %s', TEMPLATE_DOMAIN), max( $paged, $page ) ), $separator);
//}
//
//if (strpos(HTTP_HOST, 'cucak.am') !== false) {
//    $title = join_title($title, get_bloginfo('name'), $separator);
//    
//    $site_description = get_bloginfo( 'description', 'display' );
//    if ( !( $paged >= 2 || $page >= 2 ) && $site_description && ( is_home() || is_front_page() ) ) {
//        $title = join_title($title, __($site_description), $separator);
//    }
//}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"> <!--<![endif]--><head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application-name" content="Cucak.am"/> 
    <meta name="msapplication-TileColor" content="#ffffff"/> 
    <meta name="msapplication-TileImage" content="<?php echo site_url('/wp-admin/images/logo-login.png'); ?>"/>

    <?php print_social_details() ?>
        
    <title><?php wp_title( ' - ', true, 'right' ); /*echo $title*/ ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
    <link rel="search" type="application/opensearchdescription+xml" title="Cucak.am" href="http://cucak.am/opensearch.xml" />
<?php
if (!$isSocial) {
    if (WP_TEST) {
        wp_enqueue_style('main-style', get_bloginfo('template_directory') . '/test.style.min.css', array(), '1.4.0', 'all');
    } else {
        wp_enqueue_style('main-style', get_bloginfo( 'stylesheet_url'), array(), '1.3.13', 'all');
    }
    
    wp_enqueue_style('main-jquery', '/wp-includes/js/jquery-ui.1.9.1/ui-lightness/jquery-ui-1.9.1.full.min.css', array(), '1.1', 'all');
    
    wp_enqueue_script('jQuery', '/wp-includes/js/jquery-ui.1.9.1/jquery-1.8.2.min.js', array(), '1.8.2');
    
    wp_enqueue_script('jQuery UI', '/wp-includes/js/jquery-ui.1.9.1/jquery-ui-1.9.1.full.min.js', array('jQuery'), '1.9.1');
    wp_enqueue_script('jQuery UI i18n', '/wp-includes/js/jquery.1.8.21/ui/i18n/jquery-ui-i18n.js', array('jQuery', 'jQuery UI'), '1.0');
    wp_enqueue_script('jQuery UI Selectmenu', '/wp-includes/js/jquery.1.8.21/ui/jquery.ui.selectmenu.js', array('jQuery', 'jQuery UI'), '1.0');
    wp_enqueue_script('jQuery Cookie', '/wp-includes/js/jquery.1.8.21/plugins/jquery.cookie.js', array('jQuery'), '1.0');
    wp_enqueue_script('jQuery Scrollto', '/wp-includes/js/jquery.1.8.21/ui/minified/jquery.scrollto.min.js', array('jQuery'), '1.0');
    wp_enqueue_script('jQuery Viewport', '/wp-includes/js-plugins/jquery.viewport.js', array('jQuery'), '1.0');
    
    // lightbox - BEGIN
    wp_enqueue_script('jQuery Smooth Scroll', '/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/jquery.smooth-scroll.min.js', array('jQuery', 'jQuery UI'), '1.0');
    wp_enqueue_script('jQuery Lightbox', '/wp-includes/js/jquery.1.8.21/plugins/lightbox/js/lightbox.js', array('jQuery', 'jQuery UI', 'jQuery Smooth Scroll'), '1.0');
    wp_enqueue_style('lightbox', '/wp-includes/js/jquery.1.8.21/plugins/lightbox/css/lightbox.css', array(), '1.0');
    // lightbox - END
    
    // tooltip - BEGIN
    wp_enqueue_script('jQuery Tooltip', '/wp-includes/js-plugins/tooltip/themes/1/tooltip.js', array('jQuery', 'jQuery UI'), '1.0');
    wp_enqueue_style('jquery-tooltip', '/wp-includes/js-plugins/tooltip/themes/1/tooltip.css', array(), '1.0');
    // tooltip - END
    
    getBaStyleLink($authorId);
    
    if (!BA_IS_MAIN_DOMAIN) {
        add_filter('show_admin_bar', '__return_false');
    }
    wp_head();
    
    //getBaStyle($authorId);
    
    //include 'ie9_jump_list.php'; // TODO: Temporary
?>
<script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() > 100) {
                //$('#toTop').fadeIn();	
                $('#toTop').effect('drop', { direction: 'down', mode: 'show', easing: 'easeOutExpo' }, 400);
            } else {
                //$('#toTop').fadeOut();
                $('#toTop').effect('drop', { direction: 'down', mode: 'hide', easing: 'easeOutExpo' }, 400);
            }
        });

        $('#toTop').click(function() {
            $('body,html').animate({ scrollTop: 0 }, 400);
        });

        $('.topmenu li').each(function () {
            var li = $(this);
            if ($(this).find('ul.sub-menu').length > 0) {
                $(li).find('a[href="#"]').css('background-image', 'url("<?php echo site_url('/wp-admin/images/sub-menu.png') ?>")')
                                         .css('background-position', 'right')
                                         .css('background-repeat', 'no-repeat')
                                         .css('background-attachment', 'scroll')
                                         .css('padding-right', '25px');
            }
        });
                                            
        $expandables = $('.expandable');
        $expandables.each(function() {
            $(this).find('a:first')
            .css('background-image', 'url("<?php echo site_url('/wp-admin/images/sub-menu.png') ?>")')
            .css('background-position', 'right')
        .css('background-repeat', 'no-repeat')
        .css('background-attachment', 'scroll')
        .css('padding-right', '25px');
        });
                                            
        //$('.menu-login-logout').appendTo('#menu-main-right');
                                            
        $('.delete-post').click(function(e) {
            if (!confirm('<?php _e('Are you sure you want to delete?') ?>')) {
                e.preventDefault();
            }
        });
    });
</script>
<?php
} //End IF Is Social ?>
</head>
<?php

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

?>
<body <?php body_class(array('body-special', (BA_IS_MAIN_DOMAIN ? "is-main-domain" : "is-other-domain"))) ?>>				
    <?php getBaForm(get_current_user_id(), 'message', '<div class="user-message">', '</div>', 'authors') ?>
    
    <a id="left-logo" href="http://cucak.am/"></a>

    <div id="site-wrapper">
        <div id="site-outer">
        <?php if (!$isSocial) { ?>
            <nav id="top-nav" role="navigation">
                <div id="nav-inner">
                        <?php
                        if( $authorId == 0 || !getBaForm($authorId, 'top-menu', '', '', 'authors') ) {
                            wp_nav_menu( array(
                                'theme_location' => 'top_menu',
                                'menu_class' => 'topmenu',
                                'container' => '',
                                'fallback_cb' => 'simplemarket_fallback_menu'
                                ));
                        }
                        
                        if (BA_IS_MAIN_DOMAIN) {
                            wp_nav_menu( array(
                                'theme_location' => 'login_menu', 
                                'menu_class' => 'topmenu float-right', 
                                'container' => '',
                                'fallback_cb' => 'simplemarket_fallback_menu'
                                ));
                        }
                        ?>
                        <ul id="menu-main-right" class="topmenu float-right">
                            <li class="menu-item">
                                <?php if(!(WPLANG == 'am_HY')) { ?>
                                <a title="Armenian" href="<?php echo site_url('/setlng.php?ln=am_HY&to=' . urlencode(curPageURL())); ?>">
                                <?php } else { ?>
                                <a title="Armenian (current)" href="javascript:;" class="currentlanguage">
                                <?php } ?>
                                    <img src="<?php echo site_url('/wp-includes/images/flags/am.png') ?>">
                                </a>
                            </li>
                            <li class="menu-item">
                                <?php if(!(WPLANG == 'ru_RU')) { ?>
                                <a title="Russian" href="<?php echo site_url('/setlng.php?ln=ru_RU&to=' . urlencode(curPageURL())); ?>">
                                <?php } else { ?>
                                <a title="Russian (current)" href="javascript:;" class="currentlanguage">
                                <?php } ?>
                                    <img src="<?php echo site_url('/wp-includes/images/flags/ru.png') ?>">
                                </a>
                            </li>
                            <li class="menu-item">
                                <?php if(!(WPLANG == 'en_EN')) { ?>
                                <a title="English" href="<?php echo site_url('/setlng.php?ln=en_EN&to=' . urlencode(curPageURL())); ?>">
                                <?php } else { ?>
                                <a title="English (current)" href="javascript:;" class="currentlanguage">
                                <?php } ?>
                                    <img src="<?php echo site_url('/wp-includes/images/flags/gb.png') ?>">
                                </a>
                            </li>
                        </ul>
                    <div class="clear"></div>
                </div>
            </nav>
        <?php } //if (!$isSocial) ?>
            <div id="site-inner">
                <header id="branding" role="banner">
                    <div id="branding-inner">
                        <?php if (WP_TEST && ((!is_author_page()) || (!getBaForm($authorId, 'header', '', '', 'authors')))) { 
                            require_once('header-title.php');
                        } ?>
                        <?php if( (!WP_TEST) ) { ?>
                        <div id="site-logo">
                            <h1><a href="<?php echo $prefix; //home_url(); ?>" onmouseover="tooltip(this, '<?php _e('Go to Home page') ?>')" onmouseout="hide_info(this)"><?php echo $blogName; ?></a></h1>
                        </div>
                        <?php } ?>
                        <?php if ( (!WP_TEST) && ((!is_author_page()) || (!getBaForm($authorId, 'header', '', '', 'authors'))) ) { ?>
                        <div id="site-actions">
                            <div id="site-description"><?php _e(get_bloginfo('description')); ?> </div>
                                <div id="search-box">
                                    <?php //get_search_form(); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </header>
                <div id="main">
                <div id="main-inner">
                <?php if ((!is_home()) && (!is_author() || isset($_GET['cat'])) && function_exists('breadcrumbs_everywhere')) { ?>
                <div style="padding: 4px; border: 1px dashed #ddd; border-radius: 6px; margin-bottom: 8px;">
                     <?php breadcrumbs_everywhere(); ?>
                </div>
                <?php } ?>
