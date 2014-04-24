<?php

echo '<ul class="topmenu">';
    
add_top_menu_item('home');
add_top_menu_item('contacts', __('Contact us'));
add_top_menu_item('photos', __('Gallery'));
    
//add_top_menu_item('about', __('About as'));
    
add_top_menu_item('settings', __('Settings'), '//cucak.am/account/');

echo '</ul>';
    
