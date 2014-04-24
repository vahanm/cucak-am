<?php
/* Plugin Name: BA API
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: 
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

if (WP_TEST) {
    require_once('facebook-php-sdk-master/src/facebook.php');
}

function infoFromFacebook($params = array()) {
    $config = array();
    $config['appId'] = '282556291854852';
    $config['secret'] = 'd2e1892ad5013ed620cd77f899dbb064';
    $config['fileUpload'] = false; // optional

    $facebook = new Facebook($config);
    
    
}

function get_language_code()
{
    return (WPLANG == 'am_HY') ? 'hy_AM' : ( (WPLANG == 'en_EN') ? 'en_US' : 'ru_RU' );
}
    
function arg($args, $name, $default = null)
{
    return (isset($args) && is_array($args) && isset($args[$name])) ? $args[$name] : $default;
}

function ifset($value, $default) {
    return isset($value) ? $value : $default;
}

function is_author_page() {
    return arg($_GET, 'author', 0) > 0;
}

function lang_prefix() {
    switch (WPLANG)
    {
        case 'am_HY':
            return 'am';
        case 'ru_RU':
            return 'ru';
        case 'en_EN':
        default:
            return 'en';
    }
}

$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-api', $plugindir . '/ba-api.js', array('jQuery', 'jQuery UI'), '1.2');

function post_delete_link($post)
{
    //return '<a class="delete-post" href="' . wp_nonce_url( get_bloginfo('url') . '/wp-admin/post.php?action=delete&amp;post=' . $post->ID, 'delete-post_' . $post->ID) . '">' . __('Delete announcement') . '</a>';
    return '<a class="delete-post" title="' . __('Delete announcement') . '" href="' . wp_nonce_url( get_bloginfo('url') . '/wp-admin/post.php?action=trash&amp;post=' . $post->ID, 'trash-post_' . $post->ID) . '">' . __('Delete') . '</a>';
}

function _t($format, $values)
{
    return _f(__($format), $values);
}

function _f($format, $values)
{
    return sprintf($format, $values);
}

function _v($id, $postId = false)
{
    return get_meta_value($id, $postId);
}

function pricetype_final()
{
    return '<span class="pricetype pricetype_final">' . __('final') . '</span>';
}

function pricetype_approximate()
{
    return '<span class="pricetype pricetype_approximate">' . __('approximate') . '</span>';
}

function pricetype_negotiation()
{
    return '<span class="pricetype pricetype_negotiation">' . __('by negotiation') . '</span>';
}

function paymenttype_final() {
    return '<span class="pricetype pricetype_final">' . __('fixed payment') . '</span>';
}

function paymenttype_piecework() {
    return '<span class="pricetype pricetype_approximate">' . __('piecework payment') . '</span>';
}

function paymenttype_negotiation() {
    return '<span class="pricetype pricetype_negotiation">' . __('by negotiation') . '</span>';
}

if (!function_exists('is_category_or_sub')) {
    function is_category_or_sub($cat_id = 0) {
        $categories = get_categories('hierarchical=0&hide_empty=0');
        foreach($categories as $category)	{
            if (cat_is_ancestor_of($cat_id, $category->cat_ID)) return true;
        }
        
        return false;
    }
}

function get_meta_value($id, $postId = false) {
    if(!$postId)
        $postId = get_the_ID();
    $val = '';
    
    $val = get_post_meta($postId, 'post_' . $id);
    if($val)
        return $val[0];
    else
        return '';
}

function get_views_count_all() {
    $val = '';
    $post = get_the_ID();
    
    $val = get_post_meta($post, '_count-views_all');
    if($val) {
        $countReal = intval($val[0]);
        if ($countReal > 3) {
            $count = floor(pow($countReal * 3, 0.8 + ($post%10)/100));
        } else {
            $count = $countReal;
        }
        
        if ($countReal > $count)
            $count = $countReal;
        
        //if (isset($_GET['t']))
        //    $count = $countReal . '->' . $count;
                
        return $count;
    } else {
        return '';
    }
}

function get_title_formated_by_post($post) {
    $format = get_title_formated(_v('cat', $post->ID), $post->ID);
    
    if($format != '') {
        return $format;
    } else {
        return $post->post_title;
    }
}

function get_title_formated($cat, $postId = false) {
    $fname = "value_titleformat_{$cat}";
    $format = __($fname, 'FORMAT');

    if($fname == $format)
        return false;
    
    $format = apply_format($format, 'title', $postId);
    
    $format = trim($format);
    $format = rtrim($format, ",");
    
    return $format;
}

function get_content_formated($cat, $postId = false) {
    $fname = "value_contentformat_{$cat}";
    $format = __($fname, 'FORMAT');

    if($fname == $format)
        return false;

    $format = apply_format($format, 'content_html', $postId);
    
    return $format;
}

function get_content_plain($cat, $postId = false) {
    $fname = "value_contentformat_{$cat}";
    $format = __($fname, 'FORMAT');

    if($fname == $format)
        return false;

    $format = apply_format(str_replace(array('<br/>', '  ', ' '), array('', ' ', ', '), trim($format)), 'content', $postId);
    
    $format = str_replace(array(', , , , ', ', , , ', ', , ', ', , '), ', ', $format);
    
    $needle = ', ';
    if (substr($format, -strlen($needle)) === $needle) {
        $format = substr($format, 0, strlen($format) - strlen($needle));
    }
    
    return $format;
}

function _a($format, $postId = false) {
    return apply_format($format, '', $postId);
}

function apply_format($format, $prefix = '', $postId = false) {
    $pre = $prefix;
    
    if(strlen($prefix) > 0)
        $prefix .= '_';
    
    $list = split('[[]', $format);
    $test = '';
    foreach($list as $item) {
        if(strpos($item, ']') !== false) {
            $item = split('[]]', $item);
            $item = $item[0];
            
            $mode = 'D'; //D - Default
            $name = $item;
            
            if(strpos($item, ',') !== false) {
                $tmp = split('[,]', $item);
                
                $mode = $tmp[1];
                $name = $tmp[0];
            }
            
            switch($name) {
                case 'transactiontype':
                    $trans = '';
                    if(_v('allow_donation')) {
                        $trans='d';
                    } else {
                        if(_v('allow_sale')) {
                            $trans .= 's';
                        }
                        if(_v('allow_rent')) {
                            $trans .= 'r';
                        }
                        if(_v('allow_exchange')) {
                            $trans .= 'd';
                        }
                    }
                    $txt = __('value_transactiontype__' . $trans, 'FORMAT');
                    $val = '';
                    break;
                
                case 'title':
                    $txt = '';
                    $val = '';
                    break;
                
                case 'location': case 'item_location': case 'user_location':
                    $regions = getRegions(WPLANG);
                    $val = _v($item, $postId);
                    $txt = trim(str_replace('&nbsp;', '', $regions[$val]));
                    break;
                
                default: // --------------------------------------------
                    $val = _v($name, $postId);
                    
                    if(strpos($mode, 'V') !== false) { // V - Value only
                        $txt = '%s';
                    } else {
                        if($val == '') {
                            //$txt = '';
                            ///////////////////////////////////
                            
                            if(strpos($mode, 'N') !== false) { // N - Is Null
                                $fname = "value_{$prefix}{$name}";
                                $txt = __($fname, 'FORMAT');
                                
                                if($fname == $txt)
                                {
                                    $txt = '';
                                }
                            } else {
                                $txt = '';
                            }

                            ///////////////////////////////////
                        } else {
                            $fname = 'value_' . $prefix . $name . '__' . $val;
                            $txt = __($fname, 'FORMAT');
                            if($fname == $txt) {
                                $fname = "value_{$prefix}{$name}";
                                $txt = __($fname, 'FORMAT');
                                
                                if($fname == $txt) {
                                    if(strpos($mode, 'F') !== false) // F = Formatted
                                        $txt = '';
                                    else
                                        $txt = '%s';
                                }
                            }
                        }
                    }
                    
                    break;
            }
            
            if(strpos($txt, ']') !== false && strpos($txt, '[') !== false)
                $txt = apply_format($txt, $pre);
            
            $format = str_replace('[' . $item . ']', _f($txt, $val), $format);
        }
    }
    
    return $format;
}

function GetFilterItem($format, $val, $prefix = '')
{
    $pre = $prefix;
    
    if(strlen($prefix) > 0)
        $prefix .= '_';
    
    $list = split('[[]', $format);
    $test = '';
    foreach($list as $item)
    {
        if(strpos($item, ']') !== false)
        {
            $item = split('[]]', $item);
            $item = $item[0];
            
            $mode = 'D'; //D - Default
            $name = $item;
            
            if(strpos($item, ',') !== false)
            {
                $tmp = split('[,]', $item);
                
                $mode = $tmp[1];
                $name = $tmp[0];
            }
            
            switch($name)
            {
                case 'transactiontype':
                    $trans = '';
                    if(_v('allow_donation'))
                    {
                        $trans='d';
                    } else {
                        if(_v('allow_sale'))
                        {
                            $trans .= 's';
                        }
                        if(_v('allow_rent'))
                        {
                            $trans .= 'r';
                        }
                        if(_v('allow_exchange'))
                        {
                            $trans .= 'd';
                        }
                    }
                    $txt = __('value_transactiontype__' . $trans, 'FORMAT');
                    $val = '';
                    break;
                
                case 'title':
                    $txt = '';
                    $val = '';
                    break;
                
                case 'location':
                    $regions = getRegions(WPLANG);
                    $val = _v($item);
                    $txt = trim(str_replace('&nbsp;', '', $regions[$val]));
                    break;
                
                default: // --------------------------------------------
                    if($val == '')
                    {
                        //$txt = '';
                        ///////////////////////////////////
                        
                        if(strpos($mode, 'N') !== false) // N - Is Null
                        {
                            $fname = 'value_' . $prefix . $name;
                            $txt = __($fname, 'FORMAT');
                            
                            if($fname == $txt)
                            {
                                $txt = '';
                            }
                        }
                        else
                        {
                            $txt = '';
                        }

                        ///////////////////////////////////
                    } else {
                        $fname = 'value_' . $prefix . $name . '__' . $val;
                        $txt = __($fname, 'FORMAT');
                        if($fname == $txt)
                        {
                            $fname = 'value_' . $prefix . $name;
                            $txt = __($fname, 'FORMAT');
                            
                            if($fname == $txt)
                            {
                                if(strpos($mode, 'F') !== false) // F = Formatted
                                    $txt = '';
                                else
                                    $txt = '%s';
                            }
                        }
                    }
                    
                    break;
            }
            
            if(strpos($txt, ']') !== false && strpos($txt, '[') !== false)
                $txt = apply_format($txt, $pre);
            
            $format = str_replace('[' . $item . ']', _f($txt, $val), $format);
        }
    }
    
    return $format;
}


function formatSizeUnits($bytes) 
{ 
    if ($bytes >= 1073741824) 
    { 
        $bytes = number_format($bytes / 1073741824, 2) . ' GB'; 
    } 
    elseif ($bytes >= 1048576) 
    { 
        $bytes = number_format($bytes / 1048576, 2) . ' MB'; 
    } 
    elseif ($bytes >= 1024) 
    { 
        $bytes = number_format($bytes / 1024, 2) . ' KB'; 
    } 
    elseif ($bytes > 1) 
    { 
        $bytes = $bytes . ' bytes'; 
    } 
    elseif ($bytes == 1) 
    { 
        $bytes = $bytes . ' byte'; 
    } 
    else 
    { 
        $bytes = '0 bytes'; 
    } 

    return $bytes; 
}


getAuthorsData();

global $wpdb;


$wp_query	=	'SELECT 
                    post_author AS author,
                    COUNT(Id) AS `count` 
                FROM
                    wp_posts 
                WHERE post_type = "post" AND post_status = "publish"
                GROUP BY post_author,
                    post_type';


global $postsCountsByAuthor;

$postsCountsByAuthorData = $wpdb->get_results($wp_query);

$postsCountsByAuthor = array();

if(!empty($postsCountsByAuthorData)) {
    foreach($postsCountsByAuthorData as $hh) {
        $postsCountsByAuthor[$hh->author] = $hh->count;
    }
}

global $postsCountsByCategory;

$postsCountsByCategory = array();
/*
$args = array(
    'type'                     => 'post',
    'child_of'                 => 0,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => true );

$postsCountsByCategoryData = get_categories( $args );

if(!empty($postsCountsByCategoryData)) {
    foreach($postsCountsByCategoryData as $category) {
        $postsCountsByCategory[$category->cat_ID] = $category->category_count;
    }
}
*/
function getEditKey($id) {
    return MD5(MD5($id) . $id);
}



function getUserTopCategories($userId) {
    global $wpdb;	
    
    $wp_query	=	'   SELECT
                          pm.meta_value AS catId, COUNT(pm.meta_id) AS postsCount
                        FROM ' . $wpdb->prefix . 'postmeta pm
                        JOIN ' . $wpdb->prefix . 'posts p ON p.id = pm.post_id
                        JOIN ' . $wpdb->prefix . 'users u ON u.id = p.post_author
                        WHERE meta_key = \'post_cat\' AND u.id = ' . $userId . ' AND p.post_type = \'post\' AND p.post_status = \'publish\'
                        GROUP BY pm.meta_value
                        ORDER BY postsCount DESC
                        ';

    return $wpdb->get_results($wp_query);
}



function attr($text) {
    echo str_replace('"', '&quot;', $text);
}

function as_attribute($text) {
    return str_replace('"', '&quot;', $text);
}

function date_normal($format = 'Y-m-d H:i:s') {
    $tz = get_option('timezone_string');
    
    if ($tz) {
        $old_tz = date_default_timezone_get();
        date_default_timezone_set($tz);
    }
    
    $result = date($format);
    
    if ($old_tz) {
        date_default_timezone_set($old_tz);
    }
    
    return $result;
}

function control_icon($name) {
    return '<img class="sidebar-contacts-icon" alt="" src="' . site_url('/wp-includes/images/sidebar-controls/' . $name) . '" />';
}

function available_post_actions() {
    $actions = array();
    
    //Collecting data
    $user_id = get_current_user_id();

    $post_id = get_the_ID();
    $post = & get_post($post_id);

    $post_type = $post->post_type;
    $post_type_object = get_post_type_object( $post_type );
    
    if ($user_id > 0) {
        $isOwner = $post->post_author == $user_id;
        $canEdit = $isOwner || current_user_can($post_type_object->cap->delete_post, $post_id);
        $edit_key = getEditKey($post_id);
    
        //Genereting view
        $actions['copy'] = (object)array(
            'icon_16_name' => ($icon_name = '1364237070_Copy.png'),
            'icon_16_url' => control_icon($icon_name),
            'href' => getCopyLink(_v('cat'), $post_id),
            'text' => __( 'Copy' ),
        );
    
        if ( $canEdit ) {
            if (BA_EXPERIMENTAL_POST_MODIFICATION)
                $actions['add-modifiacation'] = (object)array(
                    'icon_16_name' => ($icon_name = '1397770560_share.png'),
                    'icon_16_url' => control_icon($icon_name),
                    'href' => getModifyLink(_v('cat'), $post_id, $edit_key),
                    'text' => __( 'Add modifiacation' ),
                );
    
            $actions['update'] = (object)array(
                'icon_16_name' => ($icon_name = '1364240528_arrow_top.png'),
                'icon_16_url' => control_icon($icon_name),
                'href' => "javascript:updatePost($post_id, '$edit_key')",
                'text' => __( 'Update' ),
            );
        
            if (BA_EXPERIMENTAL_POST_VISIBILITY)
                switch ($post->post_status) {
                    case 'publish':
                        $actions['make-private'] = (object)array(
                            'icon_16_name' => ($icon_name = '1396977320_padlock_closed.png'),
                            'icon_16_url' => control_icon($icon_name),
                            'href' => "javascript:privatePost($post_id, '$edit_key', 'private')",
                            'text' => __( 'Make Private' ),
                        );
                        break;
                    case 'private':
                        $actions['make-public'] = (object)array(
                            'icon_16_name' => ($icon_name = '1396986541_padlock_open.png'),
                            'icon_16_url' => control_icon($icon_name),
                            'href' => "javascript:privatePost($post_id, '$edit_key', 'publish')",
                            'text' => __( 'Make Public' ),
                        );
                        break;
                }
        
            if (strlen($wp_edit_link = get_edit_post_link()) > 0) {
                $actions['wp-edit'] = (object)array(
                    'icon_16_name' => ($icon_name = '1364240521_pencil.png'),
                    'icon_16_url' => control_icon($icon_name),
                    'href' => $wp_edit_link,
                    'text' => 'WP Edit',
                );
            }
        
            $actions['edit'] = (object)array(
                'icon_16_name' => ($icon_name = '1364240521_pencil.png'),
                'icon_16_url' => control_icon($icon_name),
                'href' => getEditLink(_v('cat'), $post_id, $edit_key),
                'text' => __( 'Edit' ),
            );
        
            $actions['wp-delete'] = (object)array(
                'icon_16_name' => ($icon_name = '1364240539_doc_delete.png'),
                'icon_16_url' => control_icon($icon_name),
                'href' => get_delete_post_link($post_id),
                'text' => __( 'Delete' ),
                'class' => "delete-post",
            );
        }
    }
    
    return (object)$actions;
}