<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;


$postId = arg($_REQUEST, 'postId', false);
$editKey = arg($_REQUEST, 'editKey', false);


if ($postId === false || $editKey === false || getEditKey($postId) != $editKey) {
    echo json_encode((object) array( error => __('Invalid request. Access is denied.')));
} else {
    $post_date = date('Y-m-d H:i:s');
    $post_date_gmt = gmdate('Y-m-d H:i:s');
    
    $wp_query	=	"   UPDATE `{$wpdb->prefix}posts`
                        SET  	`post_date` = '$post_date',
                                `post_date_gmt` = '$post_date_gmt',
                                `post_modified` = '$post_date',
                                `post_modified_gmt` = '$post_date_gmt'
                        WHERE `ID` = $postId;";
    
    $wpdb->query($wp_query);
    
    if (isset($wpdb->last_error) && $wpdb->last_error == '') {
        echo json_encode((object) array( error => false, info => __('Announcement has been successfully updated.')));
    } else {
        echo json_encode((object) array( error => __('Internal error.')));
    }
}


add_client_to_db('Ajax/Update');