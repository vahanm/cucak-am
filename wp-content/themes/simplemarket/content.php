<?php
/**
 * Content display for posts - default template
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
 
if (!function_exists('pricetype_tooltip_final')) {
    function pricetype_tooltip_final() {
        return '<div class="pricetype_tooltip pricetype_final">' . __('final') . '</div>';
    }
}
if (!function_exists('pricetype_tooltip_approximate')) {
    function pricetype_tooltip_approximate() {
        return '<div class="pricetype_tooltip pricetype_approximate">' . __('approximate') . '</div>';
    }
}
if (!function_exists('pricetype_tooltip_negotiation')) {
    function pricetype_tooltip_negotiation() {
        return '<div class="pricetype_tooltip pricetype_negotiation" style="width: 160px; margin: 0;">' . __('by negotiation') . '</div>';
    }
}

$user_id = get_current_user_id();
$post_id = get_the_ID();
$post = & get_post($post_id);

$post_type = $post->post_type;
$post_type_object = get_post_type_object( $post_type );

$showprice = '';
$pricetext = '';
$icon = '';

if(_v('allow_donation')) {
    $icon = 'donation.png';
    $showprice = __('It\'s donation');
} elseif(FALSE && _v('allow_sale') && (_v('sale_contract') == 0 || _v('sale_contract') == 1)) {
    $icon = 'sale.png';
} elseif(_v('allow_rent') && (_v('rent_contract') == 0 || _v('rent_contract') == 1)) {
    $icon = 'rent.png';
} elseif(_v('allow_exchange')) {
    $icon = 'exchange.png';
} elseif(FALSE && _v('allow_sale')) {
    $icon = 'sale.png';
} elseif(_v('allow_rent')) {
    $icon = 'rent.png';
} elseif(_v('allow_salary')) {
    $icon = 'job.png';
} elseif(_v('allow_payment')) {
    $icon = 'service.png';
}

if(_v('allow_donation')) {
    $showprice = __('It\'s donation');
} elseif(_v('allow_sale') && (_v('sale_contract') == 0 || _v('sale_contract') == 1)) {
    $showprice = '';
            
    if(_v('sale_contract') == 1)
        $showprice .= '<span class="approximate-value">~</span> '; 
            
    $showprice .= str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('sale_price'), _v('sale_currency')));
    //$showprice .= cur_Format(_v('sale_price') . ' ' . _v('sale_currency'));
    ?>
    <div id="tip-<?php the_ID(); ?>" class="abs">
    <?PHP 
    if(_v('sale_contract') == 0)
        echo pricetype_tooltip_final();
            
    if(_v('sale_contract') == 1)
        echo pricetype_tooltip_approximate();
            
    echo str_replace('\r', '', cur_ConvertedStringVal(_v('sale_price'), _v('sale_currency')));
    ?>
    </div>
    <?php
} elseif(_v('allow_rent') && (_v('rent_contract') == 0 || _v('rent_contract') == 1)) {
    $showprice = '';
            
    if(_v('rent_contract') == 1)
        $showprice .= '<span class="approximate-value">~</span> '; 
            
    $showprice .= __(_v('rent_frequency')) . ' ' . str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('rent_price'), _v('rent_currency')));
    ?>
    <div id="tip-<?php the_ID(); ?>" class="abs">
    <?PHP echo str_replace('\r', '', cur_ConvertedStringVal(_v('rent_price'), _v('rent_currency'))) ?>
    </div>
    <?php
} elseif(_v('allow_exchange')) {
    $showprice = __('exchange with') . ' ' . _v('exchange_with');
} elseif(_v('allow_sale')) {
    $showprice = pricetype_negotiation();
    ?>
    <div id="tip-<?php the_ID(); ?>" class="abs">
        <?php echo pricetype_tooltip_negotiation(); ?>
    </div>
    <?php
} elseif(_v('allow_rent')) {
    $showprice = pricetype_negotiation();
    ?>
    <div id="tip-<?php the_ID(); ?>" class="abs">
        <?PHP echo pricetype_tooltip_negotiation(); ?>
    </div>
    <?php
} elseif(_v('allow_salary')) {
    if(_v('salary') > 0) {
        $showprice = __(_v('payment_frequency')) . ' ';
                
        if(_v('salary_type') > 0) {
            $showprice .= '<span class="approximate-value">~</span> '; 
        }
        
        $showprice .= str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('salary'), _v('payment_currency')));
    ?>
        <div id="tip-<?php the_ID(); ?>" class="abs">
            <?PHP echo str_replace('\r', '', cur_ConvertedStringVal(_v('salary'), _v('payment_currency'))) ?>
        </div>
    <?php
    } else {
        $showprice = pricetype_negotiation();
    }
} elseif(_v('allow_payment')) {
    if(_v('payment') > 0) {
        $showprice = __(_v('payment_frequency')) . ' ';
                
        if(_v('payment_type') > 0)
            $showprice .= '<span class="approximate-value">~</span> '; 
                
        $showprice .= str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('payment'), _v('payment_currency')));
        //$showprice = __(_v('payment_frequency')) . ' ' . cur_Format(_v('payment') . ' ' . _v('payment_currency'));
        ?>
        <div id="tip-<?php the_ID(); ?>" class="abs">
        <?PHP echo str_replace('\r', '', cur_ConvertedStringVal(_v('payment'), _v('payment_currency'))) ?>
        </div>
        <?php
    } else {
        $showprice = pricetype_negotiation();
    }
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array(simplemarket_viewmodes_class(), (''))); ?>>
    <div class="transaction-icon" style="background-image: url('/wp-includes/images/transaction/<?php echo $icon ?>'); z-index: 10;">
    </div>
    <div class="thumbnails-container">
        <?php
        $catfile = _v('thumbnail');
    
        if (!$catfile) {
            $catfile = site_url('/wp-includes/images/categories/' . _v('cat') . '.png');
        
            if (!file_exists('.' . $catfile)) {
                $catfile = site_url('/wp-includes/images/categories/default.png');
            }
        }

        echo '<div class="thumbnail thumbnail-size t55x55  " style="background-image: url(\'' . str_replace('thumbnails', 'thumbnails.55x55', str_replace('categories', 'categories/55', $catfile)) . '\');   "></div>';
        echo '<div class="thumbnail thumbnail-size t120x120 thumbnail-active" style="background-image: url(\'' . str_replace('thumbnails', 'thumbnails.120x120', str_replace('categories', 'categories/120', $catfile)) . '\');"></div>';
        echo '<div class="thumbnail thumbnail-size t230x120" style="background-image: url(\'' . str_replace('thumbnails', 'thumbnails.230x120', str_replace('categories', 'categories/120', $catfile)) . '\');"></div>';
        echo '<div class="thumbnail thumbnail-main"></div>'; 
        echo '<div class="thumbnail magnifier-icon"></div>'; 
    
        ?>
    </div>
    <div class="post-titles">
        <span class="post-title post-title-list entry-title" title="<?php attr(get_the_title()) ?>" rel="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title() ?>
            </a>
        </span>
        <span class="post-price" onmouseover="tooltip_m(this,'tip-<?php the_ID(); ?>')" onmouseout="hide_info_m(this,'tip-<?php the_ID(); ?>')">
            <?php echo $pricetext, ' ', $showprice ?>
        </span>
        <footer class="post-meta">
            <?php
            $authorId = arg($_GET, 'author', 0);

            if ($authorId == 0) {
                $contactpersons = array( 
                    1 => __('private'),  
                    2 => __('company'),  
                    3 => __('intermediary')
                    );
                
                if(_v('contactperson'))
                    echo '<span title="' . __('Contact person') . '"><strong>' . $contactpersons[_v('contactperson')] . '</strong> &#183; </span>';
            }
            
            echo '<span class="updated" rel="updated">', get_the_date(), '</span>';
            ?>
            <span class="cat-links">&#183; <?php the_category( ' ' ); ?></span>
            <?php
            
            if (BA_EXPERIMENTAL_POST_ACTIONS_STYLE) {
                
                echo '<div style="display: none;">';
                render_files_link();
                echo '</div>';

                $actions = available_post_actions();
                
                foreach ($actions as $key => $action) {
                    echo "<a class='{$action->class}' href='{$action->href}' title='{$action->text}'>{$action->icon_16_url}</a>" ;
                }

                if ( $post->post_author == $user_id || current_user_can($post_type_object->cap->delete_post, $post_id) ) {
                    $views_count_all = get_views_count_all();
                    if(!$views_count_all)
                        $views_count_all = 0;
                    
                    //echo ' &#183; ' . _t('Views count: %s', $views_count_all);
                    echo ' &#183; <div class="views-count-all" title="', _t('Views count: %s', $views_count_all), '"><img src="/wp-includes/images/eye_inv.png" />', $views_count_all, '</div>';
                }
            } else {
                edit_post_link( 'WP Edit', ' &#183; <span class="edit-link">', '</span>' );
                
                echo '<div style="display: none;">';
                render_files_link();
                echo '</div>';


                if ( $post->post_author == $user_id || current_user_can($post_type_object->cap->delete_post, $post_id) ) {
                    echo ' &#183; ' . '<a href="' . getEditLink(_v('cat'), $post_id, getEditKey($post_id)) . '" title="' . __('Edit') . '">' . __( 'Edit' ) . '</a>' ;
                    echo ' &#183; ' . post_delete_link($post);
                    
                    $views_count_all = get_views_count_all();
                    if(!$views_count_all)
                        $views_count_all = 0;
                    
                    //echo ' &#183; ' . _t('Views count: %s', $views_count_all);
                    echo ' &#183; <div class="views-count-all" title="', _t('Views count: %s', $views_count_all), '"><img src="/wp-includes/images/eye_inv.png" />', $views_count_all, '</div>';
                }
            } //IF NOT BA_EXPERIMENTAL_POST_ACTIONS_STYLE
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

<?php
global $inline_ad_added, $inline_ad_post_number;

if (!isset($inline_ad_added)) {
    $inline_ad_added = false;
}

if (!isset($inline_ad_post_number)) {
    $inline_ad_post_number = 0;
}

$inline_ad_post_number++;

if ((WP_TEST || BA_IS_MAIN_SITE) && ($inline_ad_added !== true) && (($inline_ad_post_number % 3 == 0) && rand(0, 5) == 0)) { ?>
<article class="<?php echo simplemarket_viewmodes_class() ?> format-ad-google">
    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-4388753313853541" data-ad-slot="9842989113"></ins>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
    
    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-4388753313853541" data-ad-slot="9842989113"></ins>
    <script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>
</article>
<?php
    $inline_ad_added = true;
}
