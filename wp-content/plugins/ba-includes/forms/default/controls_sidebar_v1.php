<?php

$actions = available_post_actions();

//function control_icon($name) {
//    return '<img class="sidebar-contacts-icon" alt="" src="' . site_url('/wp-includes/images/sidebar-controls/' . $name) . '" />';
//}

$user_id = get_current_user_id();

if ($user_id > 0) {
    //Collecting data
    $post_id = get_the_ID();
    $post = & get_post($post_id);

    $post_type = $post->post_type;
    $post_type_object = get_post_type_object( $post_type );
    
    $isOwner = $post->post_author == $user_id;
    $canEdit = $isOwner || current_user_can($post_type_object->cap->delete_post, $post_id);
    $edit_key = getEditKey($post_id);
    
    //Genereting view
    $pcont = '<div class="actions-title">' . __('Actions') . '</div>';
    
    $pcont .= '<table id="sidebar_controls">';
    
    $pcont .= '<tr><td>' . control_icon('1364237070_Copy.png') . '</td><td><strong><a href="' . getCopyLink(_v('cat'), $post_id) . '">' . __( 'Copy' ) . '</a></strong></td></tr>' ;
    
    if ( $canEdit ) {
        if (BA_EXPERIMENTAL_POST_MODIFICATION)
            $pcont .= '<tr><td>' . control_icon('1397770560_share.png') . '</td><td><strong><a href="' . getModifyLink(_v('cat'), $post_id, $edit_key) . '">' . __( 'Add modifiacation' ) . '</a></strong></td></tr>' ;
    
        $pcont .= '<tr><td>' . control_icon('1364240528_arrow_top.png') . '</td><td><strong><a href="' . "javascript:updatePost($post_id, '$edit_key')" . '">' . __( 'Update' ) . '</a></strong></td></tr>' ;
        
        if (BA_EXPERIMENTAL_POST_VISIBILITY)
            switch ($post->post_status) {
                case 'publish':
                    $pcont .= '<tr><td>' . control_icon('1396977320_padlock_closed.png') . '</td><td><strong><a href="' . "javascript:privatePost($post_id, '$edit_key', 'private')" . '">' . __( 'Make Private' ) . '</a></strong></td></tr>' ;
                    break;
                case 'private':
                    $pcont .= '<tr><td>' . control_icon('1396986541_padlock_open.png') . '</td><td><strong><a href="' . "javascript:privatePost($post_id, '$edit_key', 'publish')" . '">' . __( 'Make Public' ) . '</a></strong></td></tr>' ;
                    break;
            }
        
        $wp_edit_link = get_edit_post_link();
        if (strlen($wp_edit_link) > 0) {
            $pcont .= '<tr><td>' . control_icon('1364240521_pencil.png') . '</td><td><strong><a href="' . $wp_edit_link . '">WP Edit</a></strong></td></tr>';
        }
        
        $pcont .= '<tr><td>' . control_icon('1364240521_pencil.png') . '</td><td><strong><a href="' . getEditLink(_v('cat'), $post_id, $edit_key) . '">' . __( 'Edit' ) . '</a></strong></td></tr>' ;
        
        $pcont .= '<tr><td>' . control_icon('1364240539_doc_delete.png') . '</td><td><strong>' . post_delete_link($post) . '</strong></td></tr>';
    }
    
    $pcont .= '</table>';

    echo $pcont;
}

