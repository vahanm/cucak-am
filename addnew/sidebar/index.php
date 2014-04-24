<?php

//echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<section id="sidebar" role="main" freez="fixed-sidebar-post-info">';

require_once(dirname(__FILE__) . '/../../wp-config.php');

$user_id = get_current_user_id();

/* for guests */
if ($user_id == 0) {
    include lang_prefix() . '.guest.php.htm';
}

/* for registred users */
if ($user_id != 0) {
    include lang_prefix() . '.user.php.htm';
}

/* for everyone */
include lang_prefix() . '.forall.php.htm';

echo '</section>';
