<?php
/**
 * Single post view
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */


if(arg($_POST, 'success', 0) > 0)
    addpostsuccess();

$cat = _v('cat');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
    <header class="post-header" freez="fixed-post-title">
        <h1 class="post-title"><?php
        $format = get_title_formated($cat);
        
        if($format != '') {
            echo $format;
        } else {
            the_title();
        }
        ?></h1>
    </header>
    <footer class="post-meta">
        <?php
        echo get_the_date();
        
        echo ' &#183; ';
        the_category( ' ' );
        
        
        if (function_exists('wpfp_link')) {
            echo ' &#183; '; wpfp_link();
            //if (WP_TEST) echo get_wpfp_link();
        }
        ?>
    </footer>
    <div class="post-body">
        <?php
        $cat = get_post_meta(get_the_ID(), 'post_cat');	$cat = $cat[0];
        
        $cats = get_the_category( get_the_ID() );

        if (function_exists('getBaForm')) {
            if (BA_IS_MAIN_DOMAIN) {
                getBaForm($cat, 'contacts');
        	}
            
            getBaForm($cat, 'general');
            
            //if(WP_TEST) getBaForm($cat, 'price');
            
            echo '<div class="splitter">';
            echo '</div>';
            
            getBaForm($cat, 'view');
        }

        echo '<div class="details">';
        the_content();
        echo '</div>';
        
        render_files();
        ?>
    </div>
</article>
