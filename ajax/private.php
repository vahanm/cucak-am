<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;


$postId = arg($_REQUEST, 'postId', false);
$editKey = arg($_REQUEST, 'editKey', false);
$visibility = arg($_REQUEST, 'visibility', false);


if ($postId === false || $editKey === false || getEditKey($postId) != $editKey || $visibility === false || !in_array($visibility, array('publish', 'private'))) {
    echo json_encode((object) array( error => __('Invalid request. Access is denied.')));
} else {
    $post_date = date('Y-m-d H:i:s');
    $post_date_gmt = gmdate('Y-m-d H:i:s');
    
    $wp_query	=	"   UPDATE `{$wpdb->prefix}posts`
                        SET  	`post_status` = '$visibility'
                        WHERE `ID` = $postId;";
    
    $wpdb->query($wp_query);
    
    if (isset($wpdb->last_error) && $wpdb->last_error == '') {
        switch ($visibility) {
            case 'private': $info = __('post_visibility_private'); break;
            case 'publish': $info = __('post_visibility_publish'); break;
        }
        
        echo json_encode((object) array( error => false, info => $info ));
    } else {
        echo json_encode((object) array( error => __('Internal error.')));
    }
}


add_client_to_db('Ajax/Visibility');