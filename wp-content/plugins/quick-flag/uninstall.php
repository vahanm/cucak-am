<?php
if (!defined('WP_UNINSTALL_PLUGIN'))
    exit;

global $wpdb;
$ip_ranges_table_name = $wpdb->prefix . 'quick_flag_ip_ranges';
$countries_table_name = $wpdb->prefix . 'quick_flag_countries';

$wpdb->query('DROP TABLE IF EXISTS '.$ip_ranges_table_name.';');
$wpdb->query('DROP TABLE IF EXISTS '.$countries_table_name.';');
if(get_option('quick_flag_db_version'))
    delete_option('quick_flag_db_version');
if(get_option('quick_flag_options'))
    delete_option('quick_flag_options');
?>
