<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;


$word = str_replace('\'', '\\\'', str_replace('\\', '\\\\', arg($_GET, 'brand', '')));


$wp_query	= " SELECT
                  pm.`meta_value` AS model,
                  COUNT(pm.`post_id`) AS `count`
                FROM `{$wpdb->prefix}postmeta` pm
                WHERE pm.meta_key = 'post_carmodelname'
                    AND pm.post_id IN(SELECT DISTINCT
                                        pm.`post_id`
                                      FROM `{$wpdb->prefix}postmeta` pm
                                      WHERE pm.meta_key = 'post_carbrand'
                                          AND pm.`meta_value` = '{$word}')
                GROUP BY pm.`meta_value`
                ORDER BY pm.`meta_value` ASC; ";
                          
                    
//echo json_encode($wpdb->get_results($wp_query));

$list = $wpdb->get_results($wp_query);

foreach($list as $item) {
    echo '<option value="' . $item->model . '">' . $item->model . '  (' . $item->count . ' ' . __('cars') . ')</option>';
}


add_client_to_db('Ajax/CarModels');