<?php
echo CRON_BR, 'Updating user rates';

global $wpdb;
               
$wp_query	=	" CALL `update_user_rates`; ";

$wpdb->query($wp_query);
    
if (isset($wpdb->last_error) && $wpdb->last_error != '') {
    echo CRON_BR, "ERROR: {$wpdb->last_error}";
} else {
    echo CRON_BR, "Rows affected: {$wpdb->rows_affected}";
}
