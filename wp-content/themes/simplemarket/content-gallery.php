<?php
/**
 * Port format display for posts - gallery
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(simplemarket_viewmodes_class()); ?>>
    <div class="thumbnails-container">
        <?php $gallery = render_pictures() ?>
    </div>
    <div class="post-titles">
        <span class="post-title post-title-list" title="<?php the_title() ?>">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title() ?>
            </a>
        </span>
        <p class="post-gallery-info post-pictures"><?php printf( _n( 'This album contains <a %1$s>%2$s photo</a>', 'This album contains <a %1$s>%2$s photos</a>', $gallery->count, TEMPLATE_DOMAIN ), 'href="' . get_permalink() . '" rel="bookmark"', number_format_i18n( $gallery->count )); ?></p>
        <footer class="post-meta">
            <?php
            $contactpersons = array( 
                1 => __('private'),  
                2 => __('company'),  
                3 => __('intermediary')
                );
    
            if(_v('contactperson'))
                echo '<span title="' . __('Contact person') . '"><strong>' . arg($contactpersons, _v('contactperson')) . '</strong> &#183; </span>';
            
            echo get_the_date();
            ?>
                <span class="cat-links">&#183; <?php the_category( ' ' ); ?></span>
            <?php
            
            edit_post_link( 'WP Edit', ' &#183; <span class="edit-link">', '</span>' );

            $user_id = get_current_user_id();
            $post_id = get_the_ID();
            $post = & get_post($post_id);

            $post_type = $post->post_type;
            $post_type_object = get_post_type_object( $post_type );

            if ( $post->post_author == $user_id || current_user_can($post_type_object->cap->delete_post, $post_id) )
            {
                echo ' &#183; ' . '<a href="' . getEditLink(_v('cat'), $post_id, getEditKey($post_id)) . '">' . __( 'Edit' ) . '</a>' ;
                echo ' &#183; ' . post_delete_link($post);
            
                $views_count_all = get_views_count_all();
                if(!$views_count_all)
                    $views_count_all = 0;
            
                //echo ' &#183; ' . _t('Views count: %s', $views_count_all);
                echo ' &#183; <div style="display: inline-block;" title="', _t('Views count: %s', $views_count_all), '"><img src="/wp-includes/images/eye_inv.png" style="top: 4px; position: relative; margin-right: 4px;" />', $views_count_all, '</div>';
            }
            ?>
        </footer>
        <div id="post-content-<?php the_ID(); ?>" class="post-summary post-content-container">
            <div class="post-summary post-content">
                <?php
                    $my_content = get_content_formated(_v('cat'));
            
                    if($my_content) {
                        echo $my_content;
                    } else {
                        $my_content = get_the_content();
                
                        if(mb_strlen($my_content) < 150) {
                            echo $my_content;
                        } else {
                            ?>
                            <span id="seemore-<?php the_ID(); ?>">
                                <?php echo mb_substr($my_content, 0, 150); ?>
                                    <span class="seemore">... <a onclick="javascript:$('#seemore-<?php the_ID(); ?>').hide(); $('#morecontent-<?php the_ID(); ?>').show('slow');" href="javascript:;"><?php _e('Read more') ?></a></span>
                            </span>
                            <span id="morecontent-<?php the_ID(); ?>" style="display: none;" >
                                <?php echo $my_content; ?>
                            </span>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</article>