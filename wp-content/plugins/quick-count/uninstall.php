<?php
if (!defined('WP_UNINSTALL_PLUGIN'))
    exit;

global $wpdb;
$quick_count_users_table_name = $wpdb->prefix . 'quick_count_users';

if(get_option('quick_count_options'))
    delete_option('quick_count_options');

if(get_option('quick_count_db_version'))
    delete_option('quick_count_db_version');

if(get_option('quick_count_user_stats'))
    delete_option('quick_count_user_stats');

if(get_option('widget_quick-count-widget'))
    delete_option('widget_quick-count-widget');

$wpdb->query('DROP TABLE IF EXISTS '.$quick_count_users_table_name.';');
?>
