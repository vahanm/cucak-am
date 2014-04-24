<script>
    $(document).ready(function() {
        if($('a[rel^=lightbox], area[rel^=lightbox]').length > 0) {
            $('#mainimage').css('cursor', 'pointer');
        }
    });

    function openImages() {
        //$('a[rel^=lightbox], area[rel^=lightbox]').find(':last').trigger('click');
        $('a[rel^=lightbox]:first, area[rel^=lightbox]:first').trigger('click');
    }
</script>


<?php
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

$authorId = _v('userid');
$catfile = _v('thumbnail');

if(!$catfile) {
    $catfile = '/wp-includes/images/categories/' . _v('cat') . '.png';
    
    if(!file_exists('.' . $catfile)) {
        $catfile = '/wp-includes/images/categories/default.png';
    }
}

//echo '<div id="mainimage" style="background-image: url(\'' . $catfile . '\');" onclick="scrollTo(\'#filebox\')"></div>';
echo '<div id="mainimage" style="background-image: url(\'' . $catfile . '\');" onclick="openImages()"></div>';

$pcont = '<table id="contacsandsummary">';

$val_userid = _v('userid');
$val_Location = _v('location');
$val_aname = _v('aname');
$val_phone = _v('phone');

$val_aemail_show = _v('email_show') ? true : ((isset($val_phone) && strlen($val_phone) > 3) ? false : true);
$val_aemail = $val_aemail_show ? _v('aemail') : '';

$val_contactperson = _v('contactperson');
$val_contacttimes_begin = _v('contacttimes_begin');
$val_contacttimes_end = _v('contacttimes_end');

if ($val_userid > 0 && $val_userid != 2) {
    $val_Location = get_user_meta($val_userid, 'location', true);
    $val_aname = get_user_meta($val_userid, 'display_name', true);
    $val_phone = get_user_meta($val_userid, 'phone', true);
    $val_aemail = get_user_meta($val_userid, 'email', true);
    $val_contactperson = get_user_meta($val_userid, 'contactperson', true);
    $val_contacttimes_begin = get_user_meta($val_userid, 'contacttimes_begin', true);
    $val_contacttimes_end = get_user_meta($val_userid, 'contacttimes_end', true);
    $val_user_url = get_user_meta($authorId, 'user_url', true);
}

$contactpersons = array( 
    1 => __('private'),  
    2 => __('company'),  
    3 => __('intermediary')
    );
    
if ($val_contactperson)
    $pcont .= '<tr><td>' . __('Contact person') . '</td><td><strong>' . $contactpersons[$val_contactperson] . '</strong></td></tr>';

if ($val_Location && $val_Location > 0)
    $pcont .= '<tr><td>' . __('Location') . '</td><td><strong>' . getRegionString($val_Location) . '</strong></td></tr>';

if ($val_aname) {
    $pcont .= '<tr><td>' . __('Name') . '</td>';
    
    if($val_userid == 2) {
        $pcont .= '<td><strong>' . $val_aname . '</strong></td></tr>';
    } else {
        $pcont .= '<td><strong>' . $val_aname . '</strong>';
        
        if(!is_author_page())
            $pcont .= '&nbsp;&nbsp;&nbsp; <a href="' . author_url($val_userid) . '">(' . __('view all posts by this user') . ')</a>';
        
        $pcont .= '</td></tr>';
    }
} else {
    if($val_userid != 2 && !is_author_page()) {
        $pcont .= '<tr><td>' . __('Name') . '</td>';
        $pcont .= '<td><a href="' . author_url($val_userid) . '">' . __('view all posts by this user') . '</a></td>';
        $pcont .= '</tr>';
    }
}

if ($val_phone) {
    $pcont .= '<tr><td>' . __('Phone') . '</td><td><strong><a href="callto:' . $val_phone . '">' . $val_phone . '</a></strong></td></tr>';
}

if ($val_contacttimes_begin)
    $pcont .= '<tr><td>' . __('Desirable contact time') . '</td><td><strong>' . ($val_contacttimes_begin - 1) . ':00<span> - </span>' . ($val_contacttimes_end - 1) . ':00</strong></td></tr>';
else
    $pcont .= '<tr><td>' . __('Desirable contact time') . '</td><td><strong>' . __('any time') . '</strong></td></tr>';

if(isset($val_aemail) && strlen($val_aemail) > 3)
    $pcont .= '<tr><td>' . __('E-Mail') . '</td><td><strong><a href="mailto:' . $val_aemail . '">' .  $val_aemail. '</a></strong></td></tr>';
    
if(isset($val_user_url) && strlen($val_user_url) > 3) {
    $link = $val_user_url;
    if( ! ( preg_match("/\bhttp\b/i", $link) || preg_match("/\bhttps\b/i", $link) ) )
    {
        $link = 'http://' . $link;
    }
    
    $linkName = parse_url($val_user_url, PHP_URL_HOST);
    if(!$linkName)
        $linkName = $val_user_url;
    
    $pcont .= '<tr><td>' . __('Web page') . '</td><td><strong><a target="_blank" href="' . $link . '">' . $val_user_url . '</a></strong></td></tr>';
}

if (_v('allow_donation')) {
    $pcont .= '<tr><td colspan="2">' . __('This is a donation..!!!') . '';
    $pcont .= '</td><strong></strong></tr>';
} else {
    if(_v('allow_sale')) {
        $pcont .= '<tr><td>';
        $pcont .= __('Sale price') . '</td><td>';
        $pcont .= '<span onmouseover="tooltip_m(this,\'tip-sale\')" onmouseout="hide_info_m(this,\'tip-sale\')">';
        
        switch(_v('sale_contract'))
        {
            case 0: case 1:
                $pcont .= '<strong>' . cur_Format(_v('sale_price') . ' ' . _v('sale_currency')) . '</strong> ';
                break;
        }
        
        switch(_v('sale_contract'))
        {
            case 0:
                $pcont .= pricetype_final();
                break;
            case 1:
                $pcont .= pricetype_approximate();
                break;
            case 2:
                $pcont .= pricetype_negotiation();
                break;
        }
        
        $pcont .= '</span>';
                
        switch(_v('sale_contract'))
        {
            case 0: case 1:
                $pcont .= '<div id="tip-sale" class="abs">';
                if(_v('sale_contract') == 0)
                    $pcont .= pricetype_tooltip_final();
                if(_v('sale_contract') == 1)
                    $pcont .= pricetype_tooltip_approximate();
                $pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('sale_price'), _v('sale_currency')));
                $pcont .= '</div>';
                break;
        }
        $pcont .= '</td>';
    }
    
    if(_v('allow_rent')) {
        $pcont .= '<tr><td>';
        $pcont .= __('Rent price') . '</td><td>';
        $pcont .= '<span onmouseover="tooltip_m(this,\'tip-rent\')" onmouseout="hide_info_m(this,\'tip-rent\')">';
        
        switch(_v('rent_contract'))
        {
            case 0: case 1:
                $pcont .= '<strong>' . __(_v('rent_frequency')) . ' ' . cur_Format(_v('rent_price') . ' ' . _v('rent_currency')) . ' ' . ( _v('rent_minleaseterm') > 0 ? __('minimal') . ' ' . _v('rent_minleaseterm') . ' ' . _a('[rent_measure]') : '') . '</strong>';
                break;
        }
        
        switch(_v('rent_contract'))
        {
            case 0:
                $pcont .= pricetype_final();
                break;
            case 1:
                $pcont .= pricetype_approximate();
                break;
            case 2:
                $pcont .= pricetype_negotiation();
                break;
        }
        
        $pcont .= '</span>';
        
        switch(_v('rent_contract'))
        {
            case 0: case 1:
                $pcont .= '<div id="tip-rent" class="abs">';
                if(_v('rent_contract') == 0)
                    $pcont .= pricetype_tooltip_final();
                if(_v('rent_contract') == 1)
                    $pcont .= pricetype_tooltip_approximate();
                $pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('rent_price'), _v('rent_currency')));
                $pcont .= '</div>';
                break;
        }
        $pcont .= '</td>';
    }
    
    if(_v('allow_exchange')) {
        if(_v('exchange_with')) {
            $pcont .= '<tr><td>' . __('Exchange with') . '</td><td><strong>' . _v('exchange_with') . '</strong></td>';
        } else {
            $pcont .= '<tr><td>' . __('Possibility for exchange') . '</td><td><strong></strong></td>';
        }
    }
    
    if(_v('allow_payment')) {
        $pcont .= '<tr><td>' . __('Payment') . '</td><td>';

        $pcont .= '<span onmouseover="tooltip_m(this,\'tip-payment\')" onmouseout="hide_info_m(this,\'tip-payment\')">';
        
        if( ! (_v('payment_type') == 2 && _v('payment') == '') ) {
            $pcont .= '<strong>' . __(_v('payment_frequency')) . ' ' . cur_Format(_v('payment') . ' ' . _v('payment_currency')) . '</strong>';
        }

        switch(_v('payment_type')) {
            case 0:
                $pcont .= paymenttype_final();
                break;
            case 1:
                $pcont .= paymenttype_piecework();
                break;
            case 2:
                $pcont .= paymenttype_negotiation();
                break;
        }
        
        $pcont .= '</span>';
        
        if (_v('payment')) {
            $pcont .= '<div id="tip-payment" class="abs">';
            $pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('payment'), _v('payment_currency')));
            $pcont .= '</div>';
        }
        $pcont .= '</td>';
    }
    
    if(_v('allow_salary')) {
        $pcont .= '<tr><td>' . __('Salary') . '</td><td>';

        $pcont .= '<span onmouseover="tooltip_m(this,\'tip-salary\')" onmouseout="hide_info_m(this,\'tip-salary\')">';

        if( ! (_v('salary_type') == 2 && _v('salary') == '') ) {
            $pcont .= '<strong>' . __(_v('payment_frequency')) . ' ' . cur_Format(_v('salary') . ' ' . _v('payment_currency')) . '</strong>';
        }
        
        switch(_v('salary_type')) {
            case 0:
                $pcont .= paymenttype_final();
                break;
            case 1:
                $pcont .= paymenttype_piecework();
                break;
            case 2:
                $pcont .= paymenttype_negotiation();
                break;
        }
        
        $pcont .= '</span>';
        
        if (_v('salary')) {
            $pcont .= '<div id="tip-salary" class="abs">';
            $pcont .= str_replace('\r', '', cur_ConvertedStringVal(_v('salary'), _v('payment_currency')));
            $pcont .= '</div>';
        }
        
        $pcont .= '</td>';
    }
}







$pcont .= '</table>';

echo $pcont;
