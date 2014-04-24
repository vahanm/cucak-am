<?php
/**
 * @package firmasite
 */
global $firmasite_settings;
?>
<div id="secondary" class="widget-area clearfix <?php echo $firmasite_settings["layout_secondary_class"]; ?>" role="complementary">
    <?php do_action( 'open_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'site-sidebar' ) ) : ?>

        <aside id="archives" class="widget">
            <h1 class="widget-title"><?php _e( 'Archives', 'firmasite' ); ?></h1>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>

        <aside id="meta" class="widget">
            <h1 class="widget-title"><?php _e( 'Meta', 'firmasite' ); ?></h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>

    <?php endif; // end sidebar widget area ?>
    <?php do_action( 'close_sidebar' ); ?>
</div><!-- #secondary .widget-area -->
