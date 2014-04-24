<?php
global $quick_flag;

global $quick_flag_version;
$quick_flag_version = Quick_Flag::version;

global $quick_flag_url;
$quick_flag_url = $quick_flag->url . '/img/';

function quick_flag_get_info($ip){
    global $quick_flag;

    _deprecated_function(__FUNCTION__, '2.00', '$quick_flag->get_info()');

    return $quick_flag->get_info($ip);
}

function quick_flag_get_flag($info, $css_class = 'quick-flag'){
    global $quick_flag;

    _deprecated_function(__FUNCTION__, '2.00', '$quick_flag->get_flag()');

    return $quick_flag->get_flag($info, $css_class);
}
?>
