<?php
/* Plugin Name: BA Search tools v1
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: Replacing tooltips with animated.
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/


$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-search', $plugindir . '/ba-search.js', array('jQuery', 'jQuery UI'), '1.1');


add_filter('posts_join', 'geotag_search_join' );
//add_filter('posts_where', 'geotag_search_where' );
//add_filter('posts_groupby', 'geotag_search_groupby' );
function setSpecfilters() {
    global $wpdb, $specfilters;

    $specfilters = array();
    
    foreach($_GET as $key => $value) {
        if(substr($key, 0, 1) == 'q')
        {
            $key = substr($key, 1);
            
            $operator = substr($key, -3);
            
            $key = substr($key, 0, strlen($key) - 3);
            
            if(!isset($specfilters[$key]))
                $specfilters[$key] = array();
            
            if(!isset($specfilters[$key][$operator]))
                $specfilters[$key][$operator] = $value;
            
        }
    }
}

function getSpecfilterSelectQuery($forId = array()) {
    global $wpdb, $specfilters;
    
    if(!isset($specfilters))
        setSpecfilters();
    
    $sql  = ' SELECT post_id FROM
                (
                    SELECT post_id, COUNT(*) AS cnt
                    FROM wp_postmeta   WHERE 1=0 ';
    
    $includeFilters = $forId !== false;
    
    if (!is_array($forId))
        $forId = array($forId);
    
    $count = 0;
    
    if ($includeFilters) {
        foreach($specfilters as $key => $filters)
        {
            if (in_array($key, $forId)) continue;
            
            $count += 1;
            
            $sql .= " OR (meta_key = 'post_$key' AND (";
            
            $filcount = 0;
            
            foreach($filters as $operator => $value)
            {
                if($value == '')
                    break;
                
                if($filcount > 0)
                    $sql .= ' AND ';

                $filcount += 1;
                
                switch($operator)
                {
                    case 'omn';
                        $sql .= "meta_value >= $value ";
                        break;
                    case 'omx';
                        $sql .= "meta_value <= $value ";
                        break;
                    case 'olk';
                        $sql .= "meta_value LIKE '%$value%' ";
                        break;
                    case 'ono':
                        $sql .= "meta_value != '$value' ";
                        break;
                    case 'oeq':
                    default:
                        $sql .= "meta_value = '$value' ";
                        break;
                }
            }
            
            $sql .= ' )) ';
        }
    }
    
    if(isset($_GET['cat'])) {
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
    
    if(isset($_GET['author'])) {
        $sql .= " OR (meta_key = 'post_userid' AND meta_value = '{$_GET['author']}')";
        $count += 1;
    }
    
    if($count == 0)
        return false;
    
    return $sql . " GROUP BY post_id ) t
                    WHERE t.cnt = $count ";
}

function geotag_search_join( $join ) {
    global $wpdb, $specfilters;
    
    if(!isset($specfilters))
        setSpecfilters();
    
    
    //var_dump($specfilters);
    
    $sql  = ' (SELECT post_id FROM' 
          . ' (' 
          . '    SELECT post_id, COUNT(*) AS cnt' 
          . ' FROM wp_postmeta   WHERE';
    
    $count = 0;
    foreach($specfilters as $key => $filters) {
        if($count > 0)
            $sql .= ' OR ';
        
        $sql .= " (meta_key = 'post_$key' AND (";
        
        $count += 1;
        
        $filcount = 0;
        
        foreach($filters as $operator => $value) {
            if($value == '')
                break;
            
            if($filcount > 0)
                $sql .= ' AND ';

            $filcount += 1;
            
            switch($operator) {
                case 'omn';
                    $sql .= "meta_value >= $value ";
                    break;
                case 'omx';
                    $sql .= "meta_value <= $value ";
                    break;
                case 'olk';
                    $sql .= "meta_value LIKE '%$value%' ";
                    break;
                case 'ono':
                    $sql .= "meta_value != '$value' ";
                    break;
                case 'opn':
                    $sql .= "is_same_phone('$value', meta_value)";
                    break;
                case 'oeq':
                default:
                    $sql .= "meta_value = '$value' ";
                    break;
            }
        }
        
        $sql .= ' )) ';
    }
    
    $sql .= '   GROUP BY post_id' 
          . '   ) t'
          . " WHERE t.cnt = $count ) f";

    if($count > 0)
        $join .= " JOIN $sql ON {$wpdb->posts}.ID = f.post_id";
        
    //var_dump($join);
    
    return $join;
}
/*
function geotag_search_join( $join )
{
  global $geotag_table, $wpdb;

  if( is_search() ) {
    $join .= " LEFT JOIN $geotag_table ON " . 
       $wpdb->posts . ".ID = " . $geotag_table . 
       ".geotag_post_id ";
  }

  return $join;
}

function geotag_search_where( $where )
{
  if( is_search() ) {
    $where = preg_replace(
       "/\(\s*post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
       "(post_title LIKE $1) OR (geotag_city LIKE $1) OR (geotag_state LIKE $1) OR (geotag_country LIKE $1)", $where );
   }

  return $where;
}

function geotag_search_groupby( $groupby )
{
  global $wpdb;

  if( !is_search() ) {
    return $groupby;
  }

  // we need to group on post ID

  $mygroupby = "{$wpdb->posts}.ID";

  if( preg_match( "/$mygroupby/", $groupby )) {
    // grouping we need is already there
    return $groupby;
  }

  if( !strlen(trim($groupby))) {
    // groupby was empty, use ours
    return $mygroupby;
  }

  // wasn't empty, append ours
  return $groupby . ", " . $mygroupby;
}

*/
