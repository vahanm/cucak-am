<?php

add_action( 'add_admin_bar_menus', 'wpfp_add_admin_bar_menus', 100 );

function wpfp_add_admin_bar_menus() {
    add_action( 'admin_bar_menu', 'wpfp_admin_bar_favorites', 60 );
}

function wpfp_admin_bar_favorites( $wp_admin_bar ) {
    $favorite_post_ids = wpfp_get_users_favorites();

    if ($favorite_post_ids) {
        $wp_admin_bar->add_menu( array(
            'id'        => 'wpfp-favorites',
            'parent'    => 'top-secondary',
            'title'     => __('Favorites'),
            'href'      => '#',
            'meta'      => array(
                //'class'     => $class,
                //'title'     => __('My Account'),
            ),
        ) );

        $c = 0;
        $favorite_post_ids = array_reverse($favorite_post_ids);
        foreach ($favorite_post_ids as $post_id) {
            if ($c++ == 30) break;
            
            $p = get_post($post_id);
            
            $wp_admin_bar->add_menu( array(
                'id'        => "wpfp-favorites-{$post_id}",
                'parent'    => 'wpfp-favorites',
                'title'     => get_title_formated_by_post($p),
                'href'      => BA_HOME . "/?p=$post_id", //get_permalink($post_id),
                'meta'      => array(
                    //'class'     => $class,
                    //'title'     => $p->post_title,
                ),
            ) );
        }
    }
}

function wpfp_admin_bar_most_populares( $wp_admin_bar ) {
    global $wpdb;
    $query = "  SELECT post_id, meta_value, post_status FROM $wpdb->postmeta
                LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID
                WHERE post_status='publish' AND meta_key='".WPFP_META_KEY."' AND meta_value > 0 ORDER BY ROUND(meta_value) DESC LIMIT 0, 30";
    //var_dump($query);
    $results = $wpdb->get_results($query);
    
    if ($results) {
        $wp_admin_bar->add_menu( array(
            'id'        => 'wpfp-favorites',
            'parent'    => 'top-secondary',
            'title'     => __('Favorites'),
            'href'      => '#',
            'meta'      => array(
                //'class'     => $class,
                //'title'     => __('My Account'),
            ),
        ) );

        foreach ($results as $o) {
            $p = get_post($o->post_id);
            
            $wp_admin_bar->add_menu( array(
                'id'        => "wpfp-favorites-{$o->post_id}",
                'parent'    => 'wpfp-favorites',
                'title'     => $p->post_title,
                'href'      => get_permalink($o->post_id),
                'meta'      => array(
                    //'class'     => $class,
                    'title'     => $o->meta_value //$p->post_title,
                ),
            ) );
        }
    }
}
