<?php
/**
 * Category page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<section id="content" role="main">
<?php

$cat = isset($_GET['cat']) ? $_GET['cat'] : 0;

if((!is_author()) && $cat) {
    $name = 'value_addto_' . $cat;
    $label = __($name);

    if($label == $name)
        $label = __('Add advertisement');
    
    if (!is_category_or_sub($cat)) {
        $path = site_url("/addnew/?type=$cat");
    } else {
        $path = site_url("/addnew/?cats=$cat");
    }
    
    ?>
    <a href="<?php echo $path ?>">
        <div class="addtocategorybutton">
            <?php echo $label ?>
        </div>
    </a>
    <?php
}

helper_filters();
?>
    <header class="post-header">
        <div class="post-title">
            <?php
            //echo '<p>' . _e('Show categories') . '</p>';

            echo '<span style="font-size: 140%">';
            echo '<p style="padding-bottom: 8px;" freez="fixed-post-title">' . single_cat_title( '', false ) . '</p>';
            echo '</span>';

            if(strpos($_GET['cat'], ',') !== false) {
                echo '<span style="font-size: 80%">';
                $args = array(  'show_option_all'    => '',    
                    'orderby'            => 'name',    
                    'order'              => 'ASC',    
                    'style'              => 'none',    
                    'show_count'         => 0,
                    'hide_empty'         => 0,
                    'use_desc_for_title' => 1,
                    'child_of'           => 0,
                    'feed'               => '',
                    'feed_type'          => '',
                    'feed_image'         => '',
                    'exclude'            => '',
                    'exclude_tree'       => '',
                    'include'            => $_GET['cat'],    
                    'hierarchical'       => false,
                    'title_li'           => __( 'Categories' ),    
                    'show_option_none'   => __('No categories'),    
                    'number'             => NULL,
                    'echo'               => 0,
                    'depth'              => -1,    
                    'current_category'   => 0,    
                    'pad_counts'         => 1,    
                    'taxonomy'           => 'category',    
                    'walker'             => 'Walker_Category' );
                $res = wp_list_categories( $args );

                $res = str_replace('<br />', ', ', $res);

                echo substr($res, 0, -3);
                
                echo '</span>';
                echo '<br />';
            }
            echo '<br />';
            
            
            
            /*
            $cat = isset($_GET['cat']) ? $_GET['cat'] : 0;

            if((!is_author()) && $cat > 0 && !is_category_or_sub($cat))
            {
            ?><a href="/addnew/?type=<?php echo $cat ?>">
                <div class="addtocategorybutton">
            <?php

            $name = 'value_addto_' . $cat;
            $label = __($name);

            if($label == $name)
                _e('Add advertisement');
            else
                echo $label;

            ?>
                </div></a>
                <?php 
            }
            */
            ?>
        </div>
    </header>
<?php 

$categorydesc = category_description(); 

if(!empty($categorydesc)) 
    echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' );

simplemarket_viewmodes();

while ( have_posts() ) : the_post(); 
    get_template_part( 'content', get_post_format() );
endwhile;

simplemarket_pagination(); 
        
?>
</section>
<?php get_footer() ?>
