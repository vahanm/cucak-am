<?php

$actions = available_post_actions();

$pcont = '<div class="actions-title">' . __('Actions') . '</div>';
    
$pcont .= '<table id="sidebar_controls">';

foreach ($actions as $key => $action) {
    $class = isset($action->class) ? $action->class : '';
    $pcont .= '<tr><td>' . $action->icon_16_url . '</td><td><strong><a class="' . $class . '" href="' . $action->href . '">' . $action->text . '</a></strong></td></tr>' ;
}

$pcont .= '</table>';

echo $pcont;
