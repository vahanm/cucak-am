<?php
echo CRON_BR, 'Updating Search Indexes';

global $wpdb;

$wp_query	=	" SET SQL_BIG_SELECTS = 1; ";

$wpdb->query($wp_query);
    
if (isset($wpdb->last_error) && $wpdb->last_error != '') {
    echo CRON_BR, "ERROR: {$wpdb->last_error}";
} else {
    $wp_query	=	" CALL `update_search_indexes`; ";

    $wpdb->query($wp_query);
    
    if (isset($wpdb->last_error) && $wpdb->last_error != '') {
        echo CRON_BR, "ERROR: {$wpdb->last_error}";
    } else {
        echo CRON_BR, "Rows affected: {$wpdb->rows_affected}";
    }
}

