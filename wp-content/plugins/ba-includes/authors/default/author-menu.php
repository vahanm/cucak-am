<?php

class AuthorMenu {
    
    function AuthorMenu()
    {
        add_action('admin_bar_menu', array($this, "author_links"));
    }

    /**
     * Add's new global menu, if $href is false menu is added but registred as submenuable
     *
     * $name String
     * $id String
     * $href Bool/String
     *
     * @return void
     * @author Janez Troha
     **/

    function add_root_menu($name, $id, $href = FALSE, $as_icon = false)
    {
        if ($as_icon) return $this->add_root_menu_as_icon($name, $id, $href);
        
        global $wp_admin_bar;

        $wp_admin_bar->add_menu( array(
            'id' => $id,
            'title' => $name,
            'href' => $href ) );
    }

    function add_root_menu_as_icon($title, $id, $href = FALSE)
    {
        global $wp_admin_bar;
        $icon = site_url("/wp-includes/images/special-icons/admin-bar/$id.png");
        
        $wp_admin_bar->add_menu( array(
            'id' => $id,
            'title' => "<img class=\"admin-bar-icon admin-bar-icon-$id\" src=\"$icon\" />",
            'href' => $href,
            'meta' => array('title' => $title) ) );
    }

    function add_sub_menu($name, $id, $link, $root_menu, $meta = FALSE)
    {
        global $wp_admin_bar;
        
        $wp_admin_bar->add_menu( array(
            'id' => $id,
            'parent' => $root_menu,
            'title' => $name,
            'href' => $link,
            'meta' => $meta) );
        
    }

    function author_links() {
        if ( /*!is_super_admin() ||*/ !is_admin_bar_showing() )
            return;

        
        $authorId = get_current_user_id();
        
        if ($authorId != 0) 
        {
            global $registredSubdomains;

            $prefix = '//cucak.am/' . $authorId;
            $hasAddress = false;

            foreach($registredSubdomains as $key => $value)
                if($value == $authorId)
                {
                    $hasAddress = true;
                    $prefix = '//' . $key;
                    break;
                }
            
            global $wp_admin_bar;
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-home',
                'title' => admin_icon('ba-home'),
                'href' => '//cucak.am',
                'meta' => array('title' => __('Home'))
            ));
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-mypage',
                'title' => admin_icon('ba-mypage'),
                'href' => $prefix,
                'meta' => array('title' => __('My Page'))
            ));

            $wp_admin_bar->add_menu(array(
                'id' => 'ba-photos',
                'title' => admin_icon('ba-photos'),
                'href' => $prefix . ($hasAddress ? '?' : '&') . 'page=photos',
                'meta' => array('title' => __('My Gallery'))
            ));
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-settings',
                'title' => admin_icon('dual-settings', true), //admin_icon('ba-settings'),
                'href' => '//cucak.am/account',
                'meta' => array('title' => __('Settings')),
                'parent' => 'top-secondary'
            ));
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-settings-contact-info',
                'title' => admin_icon('contact_card') . ' ' . __('Contact information'),
                'href' => '//cucak.am/account',
                'meta' => array(),
                'parent' => 'ba-settings'
            ));
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-settings-gallery',
                'title' => admin_icon('picture') . ' ' . __('Manage Gallery'),
                'href' => '//cucak.am/account/?page=photos',
                'meta' => array(),
                'parent' => 'ba-settings'
            ));
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-settings-page',
                'title' => admin_icon('cog') . ' ' . __('Page settings'),
                'href' => '//cucak.am/account/?page=page',
                'meta' => array(),
                'parent' => 'ba-settings'
            ));
            
            
            $wp_admin_bar->add_menu(array(
                'id' => 'ba-addnew',
                'title' => admin_icon('add') . ' ' . __('Add an announcement'),
                'href' => '//cucak.am/addnew/',
                'meta' => array()
            ));
            
            
            global $additionalData;
            $ud = $additionalData;
            $scores = 0;
            $place = 0;
            
            if (isset($ud[$authorId]) && isset($ud[$authorId]['points'])) {
                $scores = $ud[$authorId]['points'];
                $place = $ud[$authorId]['place'];
            }
            
            if ($place == 1) {
                $this->add_root_menu('<img src="' . site_url('/wp-includes/images/special-icons/1368185524_bestseller.png') . '" />', 'ba-place', '//cucak.am/top-partners');
            }
            
            
            /* ADDING SCORES BUTTON - BEGIN */
            
            $scores = number_format($scores, 1, '.', ' ');
            $ison = admin_icon('ba-star');
            
            $wp_admin_bar->add_menu( array(
                'id' => 'ba-scores',
                'title' => "$ison $scores",
                'href' => '//cucak.am/partners',
                'meta' => array('title' => __('Index:') . " {$scores}") ) );
                
            /* ADDING SCORES BUTTON -  END  */
        }
    }
}
