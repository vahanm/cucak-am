<?php

//define('CRON_BR', "\n\r -> ");

//echo CRON_BR, 'Cron Job', CRON_BR, CRON_BR, 'BEGIN', CRON_BR;

//require_once(dirname(__FILE__) . '/../wp-config.php');

echo CRON_BR, 'Updating Search Autocomplete';

global $wpdb;

$wp_query = "TRUNCATE TABLE `{$wpdb->prefix}search_keys`";
$wpdb->query($wp_query);


$wp_query = "   SELECT `ID` AS `id`, `post_excerpt` AS `post`
                FROM `{$wpdb->prefix}posts`
                WHERE `post_status` = 'publish' AND `post_type` = 'post'
                #LIMIT 20";
                
$posts = $wpdb->get_results($wp_query);
    
foreach ($posts as $post) {
    $source = "Auto | Post {$post->id}";
    $text = $post->post;
    
    $groups = explode('|', $text);
    $group_number = 1;

    foreach ($groups as $group) {
        $group = trim($group);
        
        if (mb_strlen($group) < 3 || preg_match('/^(AMD|RUR|RUB|USD|EUR|[{]json[}].*|No Title|([0-9]|[.])*)+$/', $group) > 0) {
            continue;
        }
        
        $key = str_replace('\'', '\\\'', str_replace('\\', '\\\\', $group));
        
        //echo "$source : $group_number : $key\n";
        //echo $key;
        $wp_query = "   INSERT INTO `{$wpdb->prefix}search_keys`
                                (`source`, `group`, `key`)
                        VALUES ('$source', $group_number, '$key');";
        
        $wpdb->query($wp_query);
        
        $group_number++;
    }
}

