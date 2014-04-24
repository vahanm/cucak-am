<?php
/* Plugin Name: BA Search tools
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Replacing tooltips with animated.
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/


$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-search', $plugindir . '/ba-search.js', array('jQuery', 'jQuery UI'), '1.1');


add_filter('posts_join', 'ba_search_join' );
//add_filter('posts_where', 'geotag_search_where' );
//add_filter('posts_groupby', 'geotag_search_groupby' );

function get_condition_from_operator($operator, $field, $value) {
    switch ($operator) {
        case 'omn';
            return "$field >= $value ";
        case 'omx';
            return "$field <= $value ";
        case 'olk';
            return "$field LIKE '%$value%' ";
        case 'ono':
            return "$field != '$value' ";
        case 'opn':
            return "is_same_phone('$value', $field)";
        case 'oeq':
        default:
            return "$field = '$value' ";
    }
}

function set_specfilters() {
    global $wpdb, $specfilters;

    $specfilters = array();
    
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 1) == 'q') {
            $key = substr($key, 1);
            
            $operator = substr($key, -3);
            
            $key = substr($key, 0, strlen($key) - 3);
            
            if (!isset($specfilters[$key]))
                $specfilters[$key] = array();
            
            if (!isset($specfilters[$key][$operator]))
                $specfilters[$key][$operator] = $value;
            
        }
    }
}

function getSpecfilterSelectQuery($forId = array()) {
    return get_specfilter_select_query($forId);
}

function get_specfilter_select_query($forId = array()) {
    global $wpdb, $specfilters;
    
    if (!isset($specfilters))
        set_specfilters();
    
    $sql  = "   SELECT post_id
                FROM (
                    SELECT post_id, COUNT(*) AS cnt
                    FROM `{$wpdb->prefix}postmeta`
                    WHERE 1=0 ";
    
    $includeFilters = $forId !== false;
    
    if (!is_array($forId))
        $forId = array($forId);
    
    $count = 0;
    
    if ($includeFilters) {
        foreach ($specfilters as $key => $filters) {
            if (in_array($key, $forId)) continue;
            
            $count += 1;
            
            $sql .= " OR (meta_key = 'post_$key' AND (";
            
            $filcount = 0;
            
            foreach ($filters as $operator => $value) {
                if ($value == '')
                    break;
                
                if ($filcount > 0)
                    $sql .= ' AND ';

                $filcount += 1;
                $sql .= get_condition_from_operator($operator, 'meta_value', $value);
            }
            
            $sql .= ' )) ';
        }
    }
    
    if (isset($_GET['cat'])) {
        $cat = "'{$_GET['cat']}'";
        
        $args = array(
            'type'                     => 'post',
            'child_of'                 => intval($_GET['cat']),
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'hierarchical'             => 1,
            'taxonomy'                 => 'category',
            'pad_counts'               => false );
        $posts_array = get_categories( $args );

        foreach($posts_array as $category) {
            $cat .= ",'{$category->cat_ID}'";
        }
        
        $sql .= " OR (meta_key = 'post_cat' AND meta_value IN ({$cat}))";
        $count += 1;
    }
    
    if (isset($_GET['author'])) {
        $sql .= " OR (meta_key = 'post_userid' AND meta_value = '{$_GET['author']}')";
        $count += 1;
    }
    
    if ($count == 0)
        return false;
    
    return $sql . " GROUP BY post_id ) t
                    WHERE t.cnt = $count ";
}

function ba_search_join($join) {
    global $wpdb, $specfilters;
    
    if (!isset($specfilters))
        set_specfilters();
        
    $where = '';
    $count = 0;
    
    foreach ($specfilters as $key => $filters) {
        if($count > 0)
            $where .= ' OR ';
        
        $count += 1;
        $condition = '';
        $filcount = 0;
        
        foreach ($filters as $operator => $value) {
            if ($value == '')
                break;
            
            if ($filcount > 0)
                $condition .= ' AND ';

            $filcount += 1;
            
            $condition .= get_condition_from_operator($operator, 'meta_value', $value);
        }
        
        $where .= " (meta_key = 'post_$key' AND ($condition)) ";
    }
    
    if ($count > 0) {
        $join .= "
        JOIN ( SELECT post_id
            FROM (  SELECT post_id, COUNT(*) AS cnt
                    FROM wp_postmeta
                    WHERE $where
                    GROUP BY post_id ) t
            WHERE t.cnt = $count) f ON {$wpdb->posts}.ID = f.post_id
        ";
    }

    return $join;
}
