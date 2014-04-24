<?php
/*
Plugin Name: BA Reports
Plugin URI: http://cucak.am
Description: 
Version: 1.0
Author: Vahan Mkhitaryan
Author URI: http://www.facebook.com/vahan.mkhitaryan
*/

$dir = dirname(__FILE__);

//require_once("$dir/../../../wp-config.php");

$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

//wp_enqueue_script('ba-reports', $plugindir . '/ba-reports.js', array('jQuery', 'jQuery UI'), '1.0');

register_activation_hook(__FILE__, 'barep_install');
register_deactivation_hook(__FILE__, 'barep_uninstall');

function barep_install() {
    
}

function barep_uninstall() {

}

define('BA_REPORTS_PREF', 'ba-reports/');
define('BA_REPORTS_HOME', BA_REPORTS_PREF . 'home');

global $reports;

$reports = array();

if ($handle = opendir("$dir/reports/")) {
    while (false !== ($file = readdir($handle)))
    {
        if (($file != ".") && ($file != ".."))
        {
            require_once("$dir/reports/$file");
        }
    }

    closedir($handle);
}

add_action('admin_menu', 'barep_admin_menus');

function barep_admin_menus() {
    add_menu_page('Reports', 'Reports', 1, BA_REPORTS_HOME, 'renderReports');
    //add_submenu_page('ba-reports/home', 'Reports - Referer', 'Referer', 2, 'ba-reports/referer', 'renderReportReferer');

    global $reports;

    foreach($reports as $report) {
        call_user_func_array('add_submenu_page', $report);
    }
}


function renderReports() {
    echo '<h1>Reports</h1>';
    
    global $reports;

    foreach($reports as $report) {
        echo '<h2><a href="', site_url("/wp-admin/admin.php?page={$report[4]}"), '">', $report[2], '</a></h2>';
        //echo '<br/><hr/><br/>';
        //call_user_func($report['render']);
    }
}
