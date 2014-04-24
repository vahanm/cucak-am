<?php

helper_cat_group_partners();

global $wpdb;

//{$wpdb->prefix}
$wp_query_string = "SELECT
                      u.ID AS `id`,
                      p.post_count AS `count`,
                      um.meta_value AS displayName
                    FROM {$wpdb->prefix}users u
                      JOIN {$wpdb->prefix}usermeta um
                        ON um.user_id = u.ID
                      JOIN (SELECT
                              p.post_author,
                              COUNT(p.ID)       post_count
                            FROM {$wpdb->prefix}posts p
                            WHERE p.post_status = 'publish'
                                AND p.post_type = 'post'
                            GROUP BY p.post_author) p
                        ON p.post_author = u.ID
                        LEFT JOIN (SELECT um.user_id, um.meta_value AS hide_from_home FROM {$wpdb->prefix}usermeta um WHERE um.meta_key = 'hide_from_home') s ON s.user_id = u.ID
                    WHERE um.meta_key = 'display_name' AND (s.hide_from_home IS NULL OR s.hide_from_home != '1')
                        AND u.ID != 2 AND p.post_count > 2
                        ORDER BY p.post_count DESC
                    LIMIT 99 ; ";

$list = $wpdb->get_results($wp_query_string);


global $additionalData;
$ud = $additionalData;

$tilesCount = 0;

echo '<div style="text-align: center;">';

foreach($list as $item) {
    if (!isset($ud[$item->id])) continue;
    
    $tilesCount++;
    
    //Data from array
    helper_cat_comp($ud[$item->id][0], $ud[$item->id][1], __($ud[$item->id][2]), $ud[$item->id][3], $ud[$item->id][4], $ud[$item->id][5], $item->id);
    
    if ($tilesCount == 1 || $tilesCount == 3 || ($tilesCount > 4 && $tilesCount % 4 == 2)) {
        echo '<br/>';
    }
    
    //Data from DB
    //helper_cat_comp($item->id, __($item->name), __($item->description), $item->fullPath, $item->backcolor, 'white', $item->userId);
}

echo '</div>';
