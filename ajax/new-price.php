<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;


$postId = arg($_REQUEST, 'postId', false);
$editKey = arg($_REQUEST, 'editKey', false);
$newPrice = arg($_REQUEST, 'newPrice', false);
$priceType = arg($_REQUEST, 'priceType', false);

if ($postId === false || $editKey === false || $priceType === false || $newPrice === false || abs(floatval($newPrice)) <= 0 || getEditKey($postId) != $editKey) {
    echo json_encode((object) array( error => __('Invalid request. Access is denied.')));
} else {
    $newPrice = abs(floatval($newPrice));
    
    $post_date = date('Y-m-d H:i:s');
    $post_date_gmt = gmdate('Y-m-d H:i:s');
    
    $wp_query	=	"   UPDATE `{$wpdb->prefix}postmeta`
                        SET  	`meta_key` = 'post_{$priceType}_previous'
                        WHERE `post_id` = $postId AND `meta_key` = 'post_$priceType';";
    
    $wpdb->query($wp_query);
    
    if (!(isset($wpdb->last_error) && $wpdb->last_error == '')) {
        echo json_encode((object) array( error => __('Internal error.'))); exit;
    }
    
    $wp_query	=	"   INSERT INTO `{$wpdb->prefix}postmeta`
                                    (`post_id`, `meta_key`, `meta_value`)
                        VALUES      ($postId , 'post_$priceType', '$newPrice');";
    
    $wpdb->query($wp_query);
    
    if (isset($wpdb->last_error) && $wpdb->last_error == '') {
        echo json_encode((object) array( error => false, info => __('Price has been successfully changed.')));
    } else {
        echo json_encode((object) array( error => __('Internal error.'))); exit;
    }
}


add_client_to_db('Ajax/NewPrice');