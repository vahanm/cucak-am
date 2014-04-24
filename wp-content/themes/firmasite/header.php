<?php
/**
 * @package firmasite
 */

global $firmasite_settings;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title>
	<?php
    if ( defined( 'WPSEO_VERSION' ) ) {
        // WordPress SEO is activated
            wp_title();  
    } else {       
        // WordPress SEO is not activated
        wp_title( '&#124;', true, 'right' );
    } ?>
    </title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
 
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site <?php echo $firmasite_settings["layout_page_class"]; ?> <?php echo $firmasite_settings["style"].'-theme'; ?>">

	<?php do_action( 'before_header' ); ?>
    
	<header id="masthead" class="site-header" role="banner">
	   	<div id="logo" class="<?php echo $firmasite_settings["layout_container_class"]; ?>">        
            <div class="page-header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="logo-link" class="logo" data-section="body">
            	<?php if (isset($firmasite_settings["logo"]) && !empty($firmasite_settings["logo"])) {?>
                <img src="<?php echo $firmasite_settings["logo"];?>" alt="<?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?>" id="logo-img" />
                 <?php } else {?>
                <span class="badge badge-info logo-text pull-left"><?php bloginfo( 'name' ); ?></span>
                <?php }?>
            </a>
           <?php if (get_bloginfo( 'description' )) {?>
           <span class="muted well well-small pull-right"><?php bloginfo( 'description' ); ?></span>
           <?php } ?>
           </div>
        </div>
	 <?php if (has_nav_menu('main_menu')) : ?>
        <div id="mainmenu" class="site-navigation main-navigation navbar <?php echo $firmasite_settings["layout_container_class"]; if (isset($firmasite_settings["alternative"]) && !empty($firmasite_settings["alternative"])){ echo " navbar-inverse";} ?>">
          <div class="navbar-inner">
            <div class="container">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>                 
              <nav id="nav-main" class="nav-collapse" role="navigation">
                <?php  wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'nav')); ?>
              </nav>
            </div>
          </div>
        </div>    <!-- .site-navigation .main-navigation --> 
	<?php endif; ?>
        <?php do_action( 'close_header' ); ?>
	</header><!-- #masthead .site-header -->
    
	<?php do_action( 'after_header' ); ?>
    
	<div id="main" class="site-main <?php echo $firmasite_settings["layout_container_class"]; ?>">
        	<?php do_action( 'before_content' ); ?>    
        <div class="row-fluid">
