<?php
/**
 * @package firmasite
 */
global $firmasite_settings;
?>
		</div><!--  .row -->
        <?php do_action( 'after_content' ); ?>    
	</div><!-- #main .site-main -->

	<footer id="footer" class="site-footer clearfix" role="contentinfo">
		<div class="site-info <?php echo $firmasite_settings["layout_container_class"]; ?>">
			<?php do_action( 'open_footer' ); ?>
				<div class="row-fluid">
				 <?php if ( ! dynamic_sidebar( 'footer-middle' ) ) : ?>
				 <?php endif; // end sidebar widget area ?>
				 </div>
				 <?php
					  if (has_nav_menu('footer_menu')) :			 
				 ?>
				<div id="footer-menu" class="site-navigation footer-navigation navbar navbar-static-bottom dropup <?php echo $firmasite_settings["layout_container_class"]; if (isset($firmasite_settings["alternative"]) && !empty($firmasite_settings["alternative"])){ echo " navbar-inverse";} ?>">
				  <div class="navbar-inner">
					<div class="container">
					  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </a>                 
					  <nav id="nav-main-bottom" class="nav-collapse" role="navigation">
						<?php
							wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'nav'));
						?>
					  </nav>
					</div>
				  </div>
				</div>    <!-- .site-navigation .main-navigation --> 
			<?php endif; ?>
			<?php do_action( 'close_footer' ); ?>
             <?php if(FIRMASITE_POWEREDBY) { ?>
			 <small class="muted generator"><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'firmasite' ) ); ?>" title="<?php printf( esc_attr__( 'Proudly powered by %s', 'firmasite' ), 'WordPress' ); ?>"><div id="wplogo"></div></a></small>
             <?php } ?>
			 <small class="muted designer"><?php _e("Theme:","firmasite"); ?> <a href="//firmasite.com/" rel="designer">FirmaSite</a></small>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>