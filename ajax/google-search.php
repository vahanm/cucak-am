<?php

require_once(dirname(__FILE__) . '/../wp-config.php');

function get_results_from_google($term) {
    $query = urlencode("$term");
    $url = "https://clients1.google.ru/complete/search?client=hp&hl=en&gs_rn=32&gs_ri=hp&cp=1&gs_id=6&gs_gbg=wsVz53915UWWqW9a17lVqq&q={$query}";
    $json = file_get_contents($url);
    $obj = json_decode(str_replace(array('\u003cb\u003e', '\u003c\/b\u003e'), '', substr($json, 19, -1)));
        
    $result = array();
    
    foreach ($obj[1] as $item) {
        global $wpdb;

        $wp_query = "   SELECT s.key
                        FROM
                            (SELECT 
                                s.`rate`, CONCAT(' ', LOWER(s.`key`)) AS `key` 
                            FROM
                                wp_search_keys s) s 
                        WHERE s.key LIKE '% {$item[0]}%'
                        LIMIT 1 ;
                    ";

        $list = $wpdb->get_results($wp_query);
        
        if (count($list) > 0) {
            $result[] = (object)array(
                'source'    => 'google',
                'label'     => "{$item[0]}",
                'value'     => "{$item[0]}",
                );
        }
    }
    
    return $result;
}