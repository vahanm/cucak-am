<?php
/* Plugin Name: BA forms
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin getting forms
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

function set_require_star($id)
{
    
}

function getBaForm($id = 'default', $type = 'add', $before = '', $after = '', $base = 'forms')
{
    $formdir = dirname(__FILE__) . '/'. $base .'/' . $id . '/';
    $formfile = $formdir . $type . '.php';

    if (file_exists($formfile))
    {
        echo $before;
        require($formfile);
        echo $after;
        
        return true;
    } else {
        $formdir = dirname(__FILE__) . '/'. $base .'/default/';
        $formfile = $formdir . $type . '.php';
        
        if (file_exists($formfile))
        {
            echo $before;
            require($formfile);
            echo $after;
            
            return true;
        }
    }
    return false;
}


function _lm($catName, $cat, $sub) {
    $menuClasses = 'menu-item menu-item-type-custom menu-item-object-custom';

    $subCatsHTML = '';
    if (is_array($sub)) {
        $subCatsHTML .= '<ul class="sub-menu">' . implode($sub) . '</ul>';
    }
    
    $caturl = site_url('?cat=' . $cat);
    return '<li class="' . $menuClasses . '"><a href="' . $caturl . '">' . __($catName) . '</a>' . $subCatsHTML . '</li>';
}

function getBaStyle($id = 'default', $type = 'style', $before = '<style>', $after = '</style>', $base = 'authors') {
    $formdir = dirname(__FILE__) . "/$base/$id/resources/";
    $formfile = $formdir . (WP_TEST ? 'test.' : '') . $type . '.css';
    $url = site_url("/wp-content/plugins/ba-includes/$base/$id/resources/" . (WP_TEST ? 'test.' : '') . $type . '.css');

    if (file_exists($formfile)) {
        echo $before;
        include($formfile);
        echo $after;
        
        return true;
    } /*else {
        $formdir = dirname(__FILE__) . '/'. $base .'/default/resources/';
        $formfile = $formdir . $type . '.css';
        
        if (file_exists($formfile)) {
            echo $before;
            include($formfile);
            echo $after;
            
            return true;
        }
    }*/
    return false;
}

function getBaStyleLink($id = 'default', $type = 'style', $base = 'authors') {
    $formdir = dirname(__FILE__) . "/$base/$id/resources/";
    $formfile = $formdir . (WP_TEST ? 'test.' : '') . $type . '.css';

    if (file_exists($formfile)) {
        wp_enqueue_style("$base-$id-$type", "/wp-content/plugins/ba-includes/$base/$id/resources/" . (WP_TEST ? 'test.' : '') . $type . '.css', array(), '1.' . filemtime($formfile));
        return true;
    }
    return false;
}

function make_requirestyle($id) {
        return '
            <style>
            #container_' . $id . '
            {
                background-color: #fed;
            }
            </style>
                ';
}

function make_error_message($id, $message) {
    return '
            <style>
            #container_' . $id . '
            {
                background-color: #fee;
            }
            </style>
            
            <a style="color: #f00;" onclick="scrollTo(\'#container_' . $id . '\')" href="javascript:;">' . $message . '</a>
            <br/>
            ';
            
    return '
            <style>
            #container_' . $id . '
            {
                background-color: #fee;
            }
            </style>
            
            <a style="color: #f00;" onclick="scrollTo(\'#container_' . $id . '\')" href="#container_' . $id . '">' . $message . '</a>
            <br/>
            ';
}

function require_price() {
    global $requireds;
    $requireds[$id] = $message;
    
    if((_p('allow_donation') + _p('allow_sale') + _p('allow_rent') + _p('allow_exchange')) == 0)	{
        return make_error_message('price',  __('Please select a transaction type.'));
    }
    
    $error = '';
    
    if(_p('allow_sale')) {
        //if(_p('sale_contract') < 2)
        //	$error .= require_oneof(
        //		require_selection('sale_price', __('Please enter the price.')),
        //		require_numeric('sale_price', __('Price must be numeric.')),
        //		require_numbercomparison('sale_price', '>', 0, __('Price must be positive, and can\'t be zero.')),
        //		require_numbercomparison('sale_price', '<', 100000000000, __('Price is too big.')),
        //		(_p('sale_price') != round(_p('sale_price')) ? make_error_message('rent_price', 'Price must be integer.') : '')
        //);
    
        $error .= require_oneof(
            require_selection('sale_contract', __('Please select price type for sale.')),
            (_p('sale_contract') < 2) ? require_oneof(
                    require_selection('sale_price', __('Please enter the price.')),
                    require_numeric('sale_price', __('Sale price should only contain numbers.')),
                    require_numbercomparison('sale_price', '>', 0, __('Sale price must be positive, and can\'t be zero.')),
                    require_numbercomparison('sale_price', '<', 100000000000, __('Sale price is too high.')),
                    (_p('sale_price') != round(_p('sale_price')) ? make_error_message('rent_price', 'Sale price must be integer.') : '')
                    ) : '');
    }
    
    if(_p('allow_rent')) {
        //if(_p('rent_contract') < 2)
        //	$error .= require_oneof(
        //		require_selection('rent_price', __('Please enter the rent price.')),
        //		require_numeric('rent_price', __('Rent price must be numeric.')),
        //		require_numbercomparison('rent_price', '>', 0, __('Rent price must be positive, and can\'t be zero.')),
        //		require_numbercomparison('rent_price', '<', 100000000000, __('Rent price is too big.')),
        //		(_p('rent_price') != round(_p('rent_price')) ? make_error_message('rent_price', 'Rent price must be integer.') : '')
        //);
    
        $error .= require_oneof(
            require_selection('rent_contract', __('Please select price type for rent.')),
            (_p('rent_contract') < 2) ? require_oneof(
                    require_selection('rent_price', __('Please enter the rent price.')),
                    require_numeric('rent_price', __('Rent price should only contain numbers.')),
                    require_numbercomparison('rent_price', '>', 0, __('Rent price must be positive, and can\'t be zero.')),
                    require_numbercomparison('rent_price', '<', 100000000000, __('Rent price is too high.')),
                    (_p('rent_price') != round(_p('rent_price')) ? make_error_message('rent_price', 'Rent price must be integer.') : '')
                    ) : '');
    }
    
    return $error;
}

function require_salary() {
    global $requireds;
    $requireds[$id] = $message;
    
    $type = _p('salary_type');
    $val = _p('salary');
    
    if($type != '2' || strlen($val) > 0) {
        if(!$val)
            return make_error_message('salary',  __('Please enter the payment amount.'));
        
        if(!is_numeric($val))
            return make_error_message('salary',  __('Payment field should only contain numbers.'));
            
        if($val <= 0)
            return make_error_message('salary',  __('Payment amount can\'t be negative.'));
            
        if($val > 10000000)
            return make_error_message('salary',  __('Payment amount is too high.'));
    }
}

function require_oneof($req1, $req2, $req3 = '', $req4 = '', $req5 = '') {
    if(strlen($req1))
        return $req1;
    
    if(strlen($req2))
        return $req2;
    
    if(strlen($req3))
        return $req3;
    
    if(strlen($req4))
        return $req4;
    
    if(strlen($req5))
        return $req5;
}

// Requireds /////////////////////////////////////////
function require_selection($id, $message) {
    global $requireds;
    $requireds[$id] = $message;
    
    if(_p($id) == '') {
        return make_error_message($id, $message);
    }
}

function require_selection_of_one($id, $values, $message) {
    global $requireds;
    $requireds[$id] = $message;
    
    $selected = 0;
    
    foreach($values as $val)
    {
        if(_p($id . '_' . $val)) {
            $selected ++;
        }
    }
    
    if($selected == 0)
        return make_error_message($id, $message);
}
// Requireds //////// END /////////////////////////////

function require_numeric($id, $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    if(!is_numeric(_p($id))) {
        return make_error_message($id, $message);
    }
}

function require_comparison($id1, $operator, $id2 , $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    if(_p($id1) == '' || _p($id2) == '')
        return '';
    
    switch($operator)
    {
        case '>':
            if(!(_p($id1) > _p($id2))) {
                return make_error_message($id1, $message);
            }
            break;
        case '<':
            if(!(_p($id1) < _p($id2))) {
                return make_error_message($id1, $message);
            }
            break;
        case '>=':
            if(!(_p($id1) >= _p($id2))) {
                return make_error_message($id1, $message);
            }
            break;
        case '<=':
            if(!(_p($id1) <= _p($id2))) {
                return make_error_message($id1, $message);
            }
            break;
    }
}

function require_numbercomparison($id, $operator, $value , $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    if(_p($id) == '')
        return '';
    
    switch($operator)
    {
        case '>':
            if(!(_p($id) > $value)) {
                return make_error_message($id, $message);
            }
            break;
        case '<':
            if(!(_p($id) < $value)) {
                return make_error_message($id, $message);
            }
            break;
        case '>=':
            if(!(_p($id) >= $value)) {
                return make_error_message($id, $message);
            }
            break;
        case '<=':
            if(!(_p($id) <= $value)) {
                return make_error_message($id, $message);
            }
            break;
        case '=':
        case '==':
            if(!(_p($id) == $value)) {
                return make_error_message($id, $message);
            }
            break;
        case '!=':
        case '<>':
            if(!(_p($id) != $value)) {
                return make_error_message($id, $message);
            }
            break;
    }
}

function require_length_min($id, $min, $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    if(_p($id))
        if(mb_strlen(_p($id)) < $min) {
            return make_error_message($id, $message);
        }
}

function require_length_max($id, $max, $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    if(mb_strlen(_p($id)) > $max) {
        return make_error_message($id, $message);
    }
}

function require_selection_of($id, $count, $values, $message) {
    //global $requireds;
    //$requireds[$id] = $message;
    
    $selected = 0;
    
    foreach($values as $val)
    {
        if(_p($id . '_' . $val)) {
            $selected ++;
        }
    }
    
    if($selected > $count)
        return make_error_message($id, $message);
}

function helper_creative_design() {
    helper_yes_no(array(
        'id'		=>	'creativedesign'
        ,'title'	=>	__('Creative design')
        ,'hideNo'	=> true
        ));
} 

function render_creative_design() {
    render_yes_no("creativedesign", __('Creative design'));
}

function filter_creative_design() {
    filter_yes_no("creativedesign", __('Creative design'));
} 

function helper_item_status() {
}
    
function render_item_status() {
}
    
function filter_item_status() {
}