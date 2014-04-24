<?php
//header('Content-type: application/xhtml+xml');
header ("content-type: text/xml");

echo '<?xml version="1.0" encoding="ISO-8859-1"?>', "\n";

ob_start();
require_once(dirname(__FILE__) . '/../wp-config.php');
ob_end_clean();

global $wpdb;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', "\n";

$date = date('Y-m-d');
$host = $_SERVER['HTTP_HOST'];

$urls = array();
	
foreach(array('', 'am.', 'ru.', 'en.') as $lng) {
	$urls[] = "{$lng}{$host}/";
	
	$urls[] = "{$lng}{$host}/partners/";
	$urls[] = "{$lng}{$host}/about/";
	$urls[] = "{$lng}{$host}/info/";
	$urls[] = "{$lng}{$host}/contacts/";
	$urls[] = "{$lng}{$host}/terms/";
};

foreach ($urls as $url) {
	echo "<url><loc>http://{$url}</loc><lastmod>{$date}</lastmod><changefreq>always</changefreq><priority>0.1</priority></url>\n";
}

// Registered Sub domains -- BEGIN
global $registredSubdomains;
foreach($registredSubdomains as $key => $value) {
	echo "<url><loc>http://{$key}/</loc><lastmod>{$date}</lastmod><changefreq>always</changefreq><priority>0.2</priority></url>\n";
}
// Registered Sub domains -- End 

// All Categories -- BEGIN

$args = array(
    'type'                     => 'post',
    'child_of'                 => 0,
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 0,
    'hierarchical'             => 1,
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
$posts_array = get_categories( $args );

foreach($posts_array as $category) {
 	foreach(array('', 'am.', 'ru.', 'en.') as $lng) {
		echo "<url><loc>http://{$lng}{$host}/?cat={$category->cat_ID}</loc><lastmod>{$date}</lastmod><changefreq>daily</changefreq><priority>0.4</priority></url>\n";
	}
}
// All Categories -- End

// All posts -- BEGIN
$query  = "SELECT 
				  p.`ID`,
  				  p.`post_modified` 
				FROM
				  $wpdb->posts p
				WHERE p.`post_type` = 'post'
				  AND p.`post_status` = 'publish'
				ORDER BY p.`ID` ASC";
				
$posts_array = $wpdb->get_results($query);

foreach($posts_array as $post) {
 	$lastmod = explode(' ', $post->post_modified);
 	foreach(array('', 'am.', 'ru.', 'en.') as $lng) {
		echo "<url><loc>http://{$lng}{$host}/?p={$post->ID}</loc><lastmod>{$lastmod[0]}</lastmod><changefreq>monthly</changefreq><priority>0.9</priority></url>\n";
	}
}
// All Posts -- End

echo '</urlset>';






