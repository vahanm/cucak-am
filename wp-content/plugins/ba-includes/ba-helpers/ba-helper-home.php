<?php

function helper_cat_group($id, $title) {
?>
<div class="cat-group">
    <div class="cat-group-header"><?php echo $title ?></div>
    <div class="cat-group-link">
        <a href="/account">
    <?php _e('Settings') ?>
        </a>
    </div>
</div>
<?php
} //helper_group

function helper_cat_group_mypage() {
    ?>
<div class="cat-group">
    <div class="cat-group-header"><?php _e('My pages') ?></div>
    <div class="cat-group-link">
        <a href="//cucak.am/account">
            <?php _e('Settings') ?>
        </a>
    </div>
</div>
<?php
} //helper_group

function helper_cat_group_partners() {
    ?>
<div class="cat-group">
    <div class="cat-group-header">
        <a href="<?php echo site_url('/partners/') ?>"><?php _e('Partners') ?></a>
    </div>
    <div class="cat-group-link">
        <a href="/private">
    <?php _e('Become a partner (free)') ?>
        </a>
    </div>
</div>
<?php
} //helper_group

function helper_cat_group_partners_top() {
    ?>
<div class="cat-group-sub">
    <div class="cat-group-header-sub"><?php _e('Top 10 Partners') ?></div>
    <div class="cat-group-link-sub">
        <a href="/top-partners">
    <?php _e('Join TOP 10') ?>
        </a>
    </div>
</div>
<?php
} //helper_group

function helper_cat_group_partners_others() {
    ?>
<div class="cat-group-sub">
    <div class="cat-group-header-sub"><?php _e('Other Partners') ?></div>
</div>
<?php
} //helper_group

function helper_cat_group_categories() {
    ?>
<div class="cat-group">
    <div class="cat-group-header">
        <a href="<?php echo site_url('/categories/') ?>"><?php _e('Categories') ?></a>
    </div>
    <div class="cat-group-link">
        <a href="/addnew">
    <?php _e('Add an announcement') ?>
        </a>
    </div>
</div>
<?php
} //helper_group

function helper_cat_group_socials() {
?>
    <div class="cat-group">
        <div class="cat-group-header"><?php _e('We are in social networks') ?></div>
    </div>
    <div>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fcucak.am&amp;width=450&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=false&amp;appId=282556291854852" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:258px;" allowTransparency="true"></iframe>
        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FBa.chimacaq&amp;width=450&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=false&amp;appId=282556291854852" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:258px;" allowTransparency="true"></iframe>
    </div>
<?php
} //helper_group

function helper_cat_big($id, $title, $url, $back, $text) {
    helper_cat_item($id, $title, $url, 'big', $back, $text);
}

function helper_cat_small($id, $title, $url, $back, $text) {
    helper_cat_item($id, $title, $url, 'small', $back, $text);
}

function helper_cat_sub($id, $title, $catId, $back, $text, $postsCount) {
    helper_cat_item($id, $title, $catId, 'sub', $back, $text, $postsCount);
}

function helper_cat_comp($id, $name, $title, $url, $backColor, $text, $authorId = 0) {
    global $postsCountsByAuthor, $additionalData;

    $logo = realpath("./wp-content/plugins/ba-includes/authors/$authorId/resources/tile/logo.png");
    if(file_exists($logo))
        $logo = site_url("/wp-content/plugins/ba-includes/authors/$authorId/resources/tile/logo.png");
    else
        $logo = site_url("/wp-includes/images/home/thumbs/$id.png");

    $back = realpath("./wp-content/plugins/ba-includes/authors/$authorId/resources/tile/back.png");
    if(file_exists($back))
        $back = site_url("/wp-content/plugins/ba-includes/authors/$authorId/resources/tile/back.png");
    else
        $back = false;
        
    
    ?>
    <a class="cat-link cat-item cat-item-comp" href="<?php echo $url ?>" style="<?php if ($back !== false) echo "background: url('$back'); "; ?>background-color: <?php echo $backColor ?>; color: <?php echo $text ?>; overflow: hidden;">
        <div class="tile-slide tile-slide-main">
            <img class="cat-img alignnone cat-img-comp-<?php echo $id ?>" src="<?php echo $logo ?>" alt="" width="100" height="100" />
            <div class="cat-count"><?php /*var_dump($additionalData[$authorId]);*/ if(isset($additionalData[$authorId]) && isset($additionalData[$authorId]['points'])) { echo number_format($additionalData[$authorId]['points'], 1, '.', ' '); } /*if(isset($postsCountsByAuthor[$authorId])) { echo $postsCountsByAuthor[$authorId]; }*/ ?></div>
            <div class="cat-title"><?php echo $title ?></div>
            <div class="cat-name"><?php echo $name ?></div>
        </div>
        <?php
        //if (WP_TEST) :
            //The Query
            query_posts("author=$authorId");

            //The Loop
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $catfile = _v('thumbnail');
    
                    if(!$catfile)
                        continue;
                    
                    //$catfile = site_url(str_replace('thumbnails', 'thumbnails.120x120', $catfile));
                    $catfile = site_url(str_replace('thumbnails', 'thumbnails.55x55', $catfile));
                    
                    echo '<div class="tile-slide tile-slide-post" style="display: block; position: relative; background-color: ', $back, ';">';
                        //echo '<div style="width: 100px; height:100px; position: relative; left: 5px; top: 5px; border: 1px solid #e59;">';
                        //    echo '<img class="" src="', site_url($catfile), '" alt="" style="max-width: 100px; max-height:100px; width: auto; height: auto; display: block; margin: auto;" />';
                        //echo '</div>';
                        
                        echo '<div style="background-image: url(\'', $catfile, '\');" class="t55x55 tile-slide-thumbnail"></div>';

                        echo '<div class="tile-slide-title">';
                        the_title();
                        echo '</div>';
                        
                        echo '<div class="tile-slide-name">', $name, '</div>';
                    echo '</div>';
                endwhile;
            endif;

            //Reset Query
            wp_reset_query();
        //endif;
        
        ?>
    </a>
    <?php
}


function post_price_for_tile() {
    $showprice = '';
    $pricetext = '';
    $icon = '';

    if(_v('allow_donation'))
    {
        $icon = 'donation.png';
        $showprice = __('It\'s donation');
    }
    //elseif(_v('allow_sale') && (_v('sale_contract') == 0 || _v('sale_contract') == 1))
    //{
    //	$icon = 'sale.png';
    //}
    elseif(_v('allow_rent') && (_v('rent_contract') == 0 || _v('rent_contract') == 1))
    {
        $icon = 'rent.png';
    }
    elseif(_v('allow_exchange'))
    {
        $icon = 'exchange.png';
    }
    //elseif(_v('allow_sale'))
    //{
    //	$icon = 'sale.png';
    //}
    elseif(_v('allow_rent')) {
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
            $showprice .= '<strong style="color: #090;">~</strong> '; 
            
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
            $showprice .= '<strong style="color: #090;">~</strong> '; 
            
        $showprice .= __(_v('rent_frequency')) . ' ' . str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('rent_price'), _v('rent_currency')));
        //$showprice = __(_v('rent_frequency')) . ' ' . cur_Format(_v('rent_price') . ' ' . _v('rent_currency'));
        ?>
        <div id="tip-<?php the_ID(); ?>" class="abs">
        <?PHP echo str_replace('\r', '', cur_ConvertedStringVal(_v('rent_price'), _v('rent_currency'))) ?>
        </div>
        <?php
    } elseif(_v('allow_exchange')) {
        $showprice = __('exchange with') . ' ' . _v('exchange_with');
    } elseif(_v('allow_sale')) {
        //$showprice = __('for sale') . ' ' . pricetype_negotiation();
        $showprice = pricetype_negotiation();
        ?>
        <div id="tip-<?php the_ID(); ?>" class="abs">
            <?php echo pricetype_tooltip_negotiation(); ?>
        </div>
        <?php
    } elseif(_v('allow_rent')) {
        //$showprice = __('for rent') . ' ' . pricetype_negotiation();
        $showprice = pricetype_negotiation();
        ?>
            
        <div id="tip-<?php the_ID(); ?>" class="abs">
            
        <?PHP echo pricetype_tooltip_negotiation(); ?>

        </div>
            
        <?php
    } elseif(_v('allow_salary')) {
        if(_v('salary') > 0) {
            $showprice = __(_v('payment_frequency')) . ' ';
                
            if(_v('salary_type') > 0)
                $showprice .= '<strong style="color: #090;">~</strong> '; 
                
            $showprice .= str_replace('\r', '', cur_ConvertedStringValuesSPAN(_v('salary'), _v('payment_currency')));
            //$showprice = __(_v('payment_frequency')) . ' ' . cur_Format(_v('salary') . ' ' . _v('payment_currency'));
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
                $showprice .= '<strong style="color: #090;">~</strong> '; 
                
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
}


function helper_cat_item($id, $title, $catId, $type, $back, $text, $postsCount = false) {
    if(strpos($catId, '=') !== false) {
        $catId = split('=', $catId);
        $catId = $catId[1];
    }
    
    global $postsCountsByCategory;
    
    if(strpos($catId, ',') !== false) {
        $catIds = split(',', $catId);
        $count = 0;
        foreach($catIds as $i) {
            if(isset($postsCountsByCategory[$i])) {
                $count += $postsCountsByCategory[$i];
            }
        }
    } else if($catId > 0) {
        if(isset($postsCountsByCategory[$catId]))
            $count = $postsCountsByCategory[$catId];
    }
    
    if((!isset($count)) || $count == 0)
        $count = '';
    
    if(isset($postsCount) && $postsCount !== false)
        $count = $postsCount;
        
    $iconPath = site_url("/wp-includes/images/home/cat-icons/$catId-metro-100x100.png");
    
    $authorId = arg($_GET, 'author', 0);

    if(getAuthorKey() || $authorId == 0) {
        $url = site_url("?cat=$catId");
    } else {
        $url = site_url("/$authorId?cat=$catId");
    }
    
   /*
    if(isset($_GET['abrakadabra'])) {
        $file = "./wp-includes/images/home/thumbs/$id.png";
        $newfile = "./wp-includes/images/home/cat-icons/$catId-metro-100x100.png";

        if (!copy($file, $newfile)) {
            echo "can't copy file: $file...\n";
            exit;
        }
    }
    */
    /*if(isset($_GET['abrakadabra'])) {
        echo '<h1>Writing file - STARTED</h1>';
        $newfile = "./wp-content/themes/simplemarket/home-categories-metro-params.php";
        
        $data = '$categoriesMetroParams[\'' . $catId . '\'] = array( id => \'' . $id . '\', title => \'' . $title . '\', type => \'' . $type . '\', backcolor => \'' . $back . '\', text => \'' . $text . '\' )' . ";\n";
        
        if (($bytes = file_put_contents($newfile , $data, FILE_APPEND)) == false) {
            echo "can't copy file: $newfile...\n";
            exit;
        }
        echo "<h1>$bytes</h1>";
        echo '<h1>Writing file - COMPLETED</h1>';
    }*/
    
    $hasChild = false;
    
    ?>
    <div class="cat-item-container">
        <?php
        if(false && WP_TEST && getBaForm($catId, 'thumbs', '<div style="display: none;"><div id="sub-categories-popup-' . $catId . '" class="-sub-categories-popup">', '</div></div>')) {
            $hasChild = true;
            //echo '<div class="sub-arrow"></div>';
        }
        ?>
        <a class="cat-link cat-item cat-item-<?php echo $type; ?>" href="<?php echo $url ?>" <?php if($hasChild) { ?> onmouseover="jTooltip.pop(this, '#<?php echo "sub-categories-popup-$catId" ?>')" <?php } ?> style="background-color: <?php echo $back; ?>; color: <?php echo $text; ?>;">
            <img class="cat-img alignnone cat-img-<?php echo $id ?>" src="<?php echo $iconPath ?>" alt="" width="100" height="100" />
            <div class="cat-count"><?php echo $count ?></div>
            <div class="cat-title"><?php echo $title ?></div>
        </a>
        <?php if(isset($_GET['abrakadabra']) && getBaForm($catId, 'thumbs', '<div class="sub-categories-popup">', '</div>')) { ?>
                <div class="sub-arrow"></div>
        <?php } ?>
    </div>
<?php
}


function helper_cat_with_subs($id, $title, $catId, $back, $text) {
    $postsCount = false;
    
    if(strpos($catId, '=') !== false) {
        $catId = split('=', $catId);
        $catId = $catId[1];
    }
    
    global $postsCountsByCategory;
    
    if(strpos($catId, ',') !== false) {
        $catIds = split(',', $catId);
        $count = 0;
        foreach($catIds as $i) {
            if(isset($postsCountsByCategory[$i])) {
                $count += $postsCountsByCategory[$i];
            }
        }
    } else if($catId > 0) {
        if(isset($postsCountsByCategory[$catId]))
            $count = $postsCountsByCategory[$catId];
    }
    
    if((!isset($count)) || $count == 0)
        $count = '';
    
    if(isset($postsCount) && $postsCount !== false)
        $count = $postsCount;
        
    $iconPath = site_url("/wp-includes/images/home/cat-icons/$catId-metro-100x100.png");
    
    $authorId = arg($_GET, 'author', 0);

    if(getAuthorKey() || $authorId == 0) {
        $url = site_url("?cat=$catId");
    } else {
        $url = site_url("/$authorId?cat=$catId");
    }
    
    $hasChild = false;
    
    ?>
    <div class="cat-item-container" style="color: <?php echo $back ?>;">
        <a class="cat-link cat-item cat-item-with-subs" href="<?php echo $url ?>" style="background-color: <?php echo $back; ?>; color: <?php echo $text; ?>;">
            <img class="cat-img alignnone cat-img-<?php echo $id ?>" src="<?php echo $iconPath ?>" alt="" width="100" height="100" />
            <div class="cat-count"><?php echo $count ?></div>
            <div class="cat-title"><?php echo $title ?></div>
        </a>
        <?php
        if(getBaForm($catId, 'thumbs', '<div class="cat-item-subitems-container">', '</div>')) {
            $hasChild = true;
            //echo '<div class="sub-arrow"></div>';
        }
        ?>
    </div>
<?php
}



function helper_cat_list_begin()
{
    echo '<ul class="cat-ul">';
}

function helper_cat_list_end()
{
    echo '</ul>';
}

function helper_cat_list_item($id, $title, $url)
{
    ?>
    <li class="cat-li">
        <a class="cat-li-link" href="/<?php echo $url ?>"><?php echo $title ?></a>
    </li>
<?php
}


function helper_cat_begin($id, $title, $type = 'middle', $url = '')
{
    switch($type)
    {
        case 'small':
    ?>
    
    
    <div class="cat-cont cat-small">
        <div class="cat-back-img cat-small" style="background-image: url('/wp-includes/images/home/<?php echo $id ?>.png')">
            <div class="cat-title"><?php echo $title ?></div>
        </div>
    
        <div class="cat-icons cat-small">
            <div class="cat-title"><a class="" href="/<?php echo $url ?>"><?php echo $title ?></a></div>
    
    <?php
            break;
        case 'middle':
    ?>
    
    
    <div class="cat-cont cat-middle">
        <div class="cat-back-img cat-middle" style="background-image: url('/wp-includes/images/home/<?php echo $id ?>.png')">
            <div class="cat-title"><?php echo $title ?></div>
        </div>
    
        <div class="cat-icons cat-middle">
            <div class="cat-title"><a class="" href="/<?php echo $url ?>"><?php echo $title ?></a></div>
    
    <?php
            break;
        case 'big':
        ?>
    
    <div class="cat-cont cat-big">
        <div class="cat-back-img cat-big" style="background-image: url('/wp-includes/images/home/<?php echo $id ?>.png');">
            <div class="cat-title"><?php echo $title ?></div>
        </div>
    
        <div class="cat-icons cat-big">
            <div class="cat-title"><a class="" href="/<?php echo $url ?>"><?php echo $title ?></a></div>

    
    <?php
            break;
    }
}

function helper_cat_end($id)
{
    ?>
    
            </div>
    </div>

    
    <?php
}

function helper_cat_image($id, $title, $url)
{
    ?>
    <a class="cat-img-link" href="/<?php echo $url ?>" title="<?php echo $title ?>"><img class="cat-img alignnone wp-image-<?php echo $id ?>" src="/wp-includes/images/home/icons/<?php echo $id ?>.png" alt="" min-width="60" min-height="45" /></a>
<?php
}

function helper_cat_link($id, $title, $url)
{
    ?>
    <a class="cat-link" href="/<?php echo $url ?>"><?php echo $title ?></a>
<?php
}

