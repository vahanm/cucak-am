<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

//ob_start();

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);//analitics_begin('Total');/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');//analitics_end('Total');
 
switch(get_current_user_id())
{
	case 1: case 12:
		//analitics_print();
        //break;
    
    default:
        if(isset($_GET['a']))
            analitics_print();
}

//$myStr = ob_get_contents();//ob_end_clean();//echo str_replace(array("\n", "\n", "\t", '  '), array('', '', '', ' '), $myStr);

add_client_to_db('Index');
