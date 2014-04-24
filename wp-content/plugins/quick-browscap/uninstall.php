<?php
if (!defined('WP_UNINSTALL_PLUGIN'))
    exit;

if(get_option('quick_browscap_options'))
    delete_option('quick_browscap_options');

if(get_option('quick_browscap_db_version'))
    delete_option('quick_browscap_db_version');
?>
