<?php
/**
 * Header
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]--><head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php  global $page, $paged;
			wp_title( '|', true, 'right' );
			bloginfo( 'name' );
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', TEMPLATE_DOMAIN), max( $paged, $page ) );
		?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url') ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	
<!--<link rel="stylesheet" type="text/css" href="/wp-includes/js/jquery.1.8.21/development-bundle/themes/base/jquery.ui.all.css" />-->
    
    <link rel="stylesheet" type="text/css" href="/wp-includes/css/themes/ui-lightness/jquery.ui.all.css" />
    
    <script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js"> </script>

	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.effects.core.js" > </script>
    
    <script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.core.js" > </script>
	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.widget.js" > </script>
	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.mouse.js" > </script>

	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.slider.js" > </script>
	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.button.js" > </script>
	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/ui/jquery.ui.selectmenu.js"></script>
	
	
	
	
	<script type="text/javascript" src="/wp-includes/js/jquery.1.8.21/plugins/plugins.js"></script>
	
	
	
	<?php wp_head(); ?>
</head>

<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


//include 'ba-includes/ba-convertor.php';

?>


<body <?php body_class() ?>>
	<!-- Tooltip-->
<!--
    <div style="float: right">
        <a href="http://bache.sytes.net/setlng.php?ln=am_HY&to=<?php echo curPageURL(); ?>">HY</a>
        *
        <a href="http://bache.sytes.net/setlng.php?ln=ru_RU&to=<?php echo curPageURL(); ?>">RU</a>
        *
        <a href="http://bache.sytes.net/setlng.php?ln=&to=<?php echo curPageURL(); ?>">EN</a>
    </div>
-->    
	<div id="site-wrapper">
		<div id="site-outer">
			<nav id="top-nav" role="navigation">
				<div id="nav-inner">		
							<?php wp_nav_menu( array(
								'theme_location' => 'top_menu', 
								'menu_class' => 'topmenu', 
								'container' => '', 
								'fallback_cb' => 'simplemarket_fallback_menu'
							)); ?>
                            
                            
                        <ul id="menu-main" class="topmenu" style="float: right">
							<li class="menu-item">
								<?php if(!(WPLANG == 'am_HY')) { ?>
								<a title="Armenian" href="/setlng.php?ln=am_HY&to=<?php echo curPageURL(); ?>">
								<?php } else { ?>
								<a title="Armenian (current)" href="javascript: ;">
								<?php } ?>
									<img src="/wp-includes/images/flags/am.png">
								</a>
							</li>
							<li class="menu-item">
								<?php if(!(WPLANG == 'ru_RU')) { ?>
								<a title="Russian" href="/setlng.php?ln=ru_RU&to=<?php echo curPageURL(); ?>">
								<?php } else { ?>
								<a title="Russian (current)" href="javascript: ;">
								<?php } ?>
									<img src="/wp-includes/images/flags/ru.png">
								</a>
							</li>
							<li class="menu-item">
								<?php if(!(WPLANG == 'en_EN')) { ?>
								<a title="English" href="/setlng.php?ln=en_EN&to=<?php echo curPageURL(); ?>">
								<?php } else { ?>
								<a title="English (current)" href="javascript: ;">
								<?php } ?>
									<img src="/wp-includes/images/flags/gb.png">
								</a>
							</li>
                        </ul>
					<div class="clear"></div>
				</div>
			</nav>
			<div id="site-inner">
				<header id="branding" role="banner">
					<div id="branding-inner">
						<div id="site-logo">
							<h1 onmouseover="tooltip(this,'Go to Home page.<br/>Անցնել գլխավոր էջ:')" onmouseout="hide_info(this)"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
						</div>
						<div id="site-actions" hint="Ankap HINT">
							<div id="site-description"><?php bloginfo('description'); ?> </div>
							<div id="search-box">		<?php get_search_form(); ?></div>
						</div>
					</div>
					<?php
					$simpleheader = get_header_image();
					if ($simpleheader != ""){
					?>
						<div id="header-image">
							<img src="<?php echo $simpleheader; ?>" class="header-image" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
						</div>
					<?php } ?>
				</header>
				<div id="main">
				<div id="main-inner">
