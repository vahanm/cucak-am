<?php


require_once(dirname(__FILE__).'/../wp-config.php');

print_r ( sendPostData('vahan.mkhitaryan@gmail.com', 'Vahan Mkhtiaryan', 5466) );

print_r ( sendPostData('vahan.mkhitaryan@cucak.am', 'Vahan Mkhtiaryan', 5466) );

//echo preg_replace('/^post_/', '', 'post_post_userid');