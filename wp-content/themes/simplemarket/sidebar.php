<?php
/**
 * Sidebar
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */

function render_left_menu($cat) {
    return getBaForm($cat, 'left-menu');
}

function categories_fallback_menu() {
    echo '<ul class="leftmenu">';
    wp_list_pages('sort_column=menu_order&title_li=');
    echo '</ul>';
};

echo '<section id="sidebar" role="main">';

$cat = arg($_GET, 'cat', 0);

if (is_single() && isset($_GET['p'])) {
    echo '<div class="sidebar-post-info" freez="fixed-sidebar-post-info">';
    getBaForm($cat, 'price');
    getBaForm($cat, 'contacts_sidebar');
    getBaForm($cat, 'controls_sidebar');
    echo '</div>';
} elseif ($cat > 0 && is_category()) {
    echo '<nav id="left-nav" role="navigation">';
    echo '<div id="left-nav-inner">';
    
    if (!getBaForm($cat, 'thumbs', '<div id="subCategories" style="text-align: center;">', '</div>')) {
        if (getBaForm($cat, 'filters', '<div id="categoryFilters" style="text-align: left;">', '</div>')) {
            helper_filters_left_footer();
        } else {
            if (!getBaForm($cat, 'thumbs', '<div id="subCategories" style="text-align: center;">', '</div>')) {
                render_left_menu($cat);
            }
        }
    }
    
    echo '</div>';
    echo '</nav>';

} else if(is_author()) {
    if (!getBaForm(arg($_GET, 'author', 0), 'sidebar', '<div id="subCategories" style="text-align: center;">', '</div>', 'authors')) {
        render_left_menu($cat);
    }
} else if (false && is_single() && isset($_GET['p'])) {
    echo '<div class="sidebar-post-info">';
    getBaForm($cat, 'price');
    getBaForm($cat, 'contacts_sidebar');
    echo '</div>';
} else {
    render_left_menu($cat);
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------------------------------------------------

if ( is_active_sidebar( 'sidebar' ) ) {
    dynamic_sidebar( 'sidebar' );
}

echo '</section>';
