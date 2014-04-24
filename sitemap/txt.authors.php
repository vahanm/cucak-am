<?php
require_once(dirname(__FILE__) . '/../wp-config.php');

$host = $_SERVER['HTTP_HOST'];

global $wpdb;

echo "http://{$host}/\n";
echo "http://www.{$host}/\n";
echo "http://am.{$host}/\n";
echo "http://en.{$host}/\n";
echo "http://ru.{$host}/\n";
// Registred Subdomains -- BEGIN

global $registredSubdomains;

foreach($registredSubdomains as $key => $value) {
    echo "http://$key/\n";
} // Registred Subdomains -- End


// All Users -- BEGIN
$args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => '',
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'login',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => ''
 );
 
$users_array = get_users( $args );

foreach($users_array as $user) {
    switch($user->ID) {
        case 1:
        case 12:
        default:
            echo "http://{$host}/{$user->ID}\n";
            echo "http://am.{$host}/{$user->ID}\n";
            echo "http://ru.{$host}/{$user->ID}\n";
            echo "http://en.{$host}/{$user->ID}\n";
            
            echo "http://{$host}/{$user->ID}?page=contacts\n";
            echo "http://am.{$host}/{$user->ID}?page=contacts\n";
            echo "http://ru.{$host}/{$user->ID}?page=contacts\n";
            echo "http://en.{$host}/{$user->ID}?page=contacts\n";
    }
} // All Users -- End
