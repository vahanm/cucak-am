<?php
require_once(dirname(__FILE__) . '/../wp-config.php');

$host = $_SERVER['HTTP_HOST'];

global $wpdb;

echo "http://{$host}/\n";
echo "http://www.{$host}/\n";
echo "http://am.{$host}/\n";
echo "http://en.{$host}/\n";
echo "http://ru.{$host}/\n";

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
    echo "http://{$host}/?cat={$category->cat_ID}\n";
    echo "http://am.{$host}/?cat={$category->cat_ID}\n";
    echo "http://ru.{$host}/?cat={$category->cat_ID}\n";
    echo "http://en.{$host}/?cat={$category->cat_ID}\n";
} // All Categories -- End


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
   echo "http://{$host}/?p={$post->ID}\n";
   echo "http://am.{$host}/?p={$post->ID}\n";
   echo "http://en.{$host}/?p={$post->ID}\n";
   echo "http://ru.{$host}/?p={$post->ID}\n";
}

// All Posts -- End
