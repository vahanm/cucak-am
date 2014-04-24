<?php
//$_GET['d'] = true;

require_once(dirname(__FILE__) . '/../wp-config.php');

function get_results_from_cucak($term) {
    global $wpdb;

    $wp_query = "   SELECT DISTINCT 
                        s.key
                    FROM
                        (SELECT 
                            SUBSTRING_INDEX(
                                LTRIM(
                                    SUBSTRING_INDEX(s.key, ' {$term}', - 1)
                                ), ' ', 1
                            ) AS `key`, s.`rate`, s.`key` AS `original` 
                        FROM
                            (SELECT 
                                s.`rate`, CONCAT(' ', LOWER(s.`key`)) AS `key` 
                            FROM
                                wp_search_keys s) s 
                        WHERE s.key LIKE '% {$term}%') s 
                    ORDER BY s.rate DESC 
                    LIMIT 10 ;
                    ";
    
    //$wp_query = "SELECT DISTINCT
    //                 s.key AS label, s.key AS value
    //             FROM {$wpdb->prefix}search_keys s
    //             WHERE s.key LIKE '{$word}%'
    //             ORDER BY s.rate DESC
    //             LIMIT 10;";

    $list = $wpdb->get_results($wp_query);
    $result = array();

    foreach ($list as $item) {
        $result[] = (object)array(
        	'source'    => 'cucak',
            'label'     => "$term{$item->key}",
            'value'     => "$term{$item->key}",
            );
    }
    
    return $result;
}

$word = str_replace('\'', '\\\'', str_replace('\\', '\\\\', $_GET['term']));

$cucak = get_results_from_cucak($word);

include 'google-search.php';
$google = get_results_from_google($word);


echo json_encode(array_merge($cucak, $google));

add_client_to_db('Ajax/Search');