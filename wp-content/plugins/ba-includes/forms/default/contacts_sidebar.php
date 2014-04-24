<?php
$authorId = _v('userid');

$pcont = '<div class="actions-title">' . __('Contact information') . '</div>';
    
$pcont .= '<table id="sidebar_contacts">';

$val_userid = _v('userid');
$val_location = _v('location');
$val_address = _v('address');
$val_aname = _v('aname');
$val_phone = _v('phone');

$val_aemail_show = _v('email_show') ? true : ((isset($val_phone) && strlen($val_phone) > 3) ? false : true);
$val_aemail = $val_aemail_show ? _v('aemail') : '';

$val_contactperson = _v('contactperson');
$val_contacttimes_begin = _v('contacttimes_begin');
$val_contacttimes_end = _v('contacttimes_end');

if ($val_userid > 0 && $val_userid != 2) {
    $val_location = get_user_meta($val_userid, 'location', true);
    $val_address = get_user_meta($val_userid, 'address', true);
    $val_aname = get_user_meta($val_userid, 'display_name', true);
    $val_phone = get_user_meta($val_userid, 'phone', true);
    $val_aemail = get_user_meta($val_userid, 'email', true);
    $val_contactperson = get_user_meta($val_userid, 'contactperson', true);
    $val_contacttimes_begin = get_user_meta($val_userid, 'contacttimes_begin', true);
    $val_contacttimes_end = get_user_meta($val_userid, 'contacttimes_end', true);
    $val_user_url = get_user_meta($authorId, 'user_url', true);
}

$contactpersons = array( 
    1 => __('private'),  
    2 => __('company'),  
    3 => __('intermediary')
    );

$iconName = '1362617181_user.png';
if ($val_contactperson == 2)
    $iconName = '1362617186_users.png';

if ($val_contactperson)
    $pcont .= '<tr><td title="' . __('Contact person') . '">' . contact_icon($iconName) . '</td><td><strong>' . $contactpersons[$val_contactperson] . '</strong></td></tr>';

if ($val_location && $val_location > 0)
    $pcont .= '<tr><td title="' . __('Location') . '">' . contact_icon('1362617120_globe_2.png') . '</td><td><strong title="' . getRegionString($val_location) . '">' . getRegionString($val_location, 2) . '</strong></td></tr>';

if ($val_address)
    if ($val_location && $val_location > 0)
        $pcont .= '<tr><td></td><td>' . $val_address . '</td></tr>';
    else
        $pcont .= '<tr><td title="' . __('Address') . '">' . contact_icon('1362617120_globe_2.png') . '</td><td><strong>' . $val_address . '</strong></td></tr>';


if ($val_aname) {
    $pcont .= '<tr><td title="' . __('Name') . '">' . contact_icon('1362623532_contact_card.png') . '</td>';

    if ($val_userid == 2)
        $pcont .= '<td><strong>' . $val_aname . '</strong></td></tr>';
    else
        $pcont .= '<td><strong><a href="' . author_url($val_userid) . '" title="' . __('view all posts by this user') . '">' . $val_aname . '</a></strong></td></tr>';
}

if ($val_phone) {
    $pcont .= '<tr><td title="' . __('Phone') . '">' . contact_icon('1362617259_phone_1.png') . '</td><td><strong><a href="callto:' . $val_phone . '">' . $val_phone . '</a></strong></td></tr>';
}


$pcont .= '<tr><td title="' . __('Desirable contact time') . '">' . contact_icon('1362618285_clock.png') . '</td>';
if ($val_contacttimes_begin)
    $pcont .= '<td><strong>' . ($val_contacttimes_begin - 1) . ':00<span> - </span>' . ($val_contacttimes_end - 1) . ':00</strong></td></tr>';
else
    $pcont .= '<td><strong>' . __('any time') . '</strong></td></tr>';

    
    
if (isset($val_aemail) && strlen($val_aemail) > 3)
    $pcont .= '<tr><td title="' . __('E-Mail') . '">' . contact_icon('1362617172_mail_2.png') . '</td><td><strong><a href="mailto:' . $val_aemail . '">' .  $val_aemail. '</a></strong></td></tr>';


if (isset($val_user_url) && strlen($val_user_url) > 3) {
    $link = $val_user_url;
    if (!(preg_match("/\bhttp\b/i", $link) || preg_match("/\bhttps\b/i", $link))) {
        $link = 'http://' . $link;
    }
    
    $linkName = parse_url($val_user_url, PHP_URL_HOST);
    if (!$linkName)
        $linkName = $val_user_url;
    
    $iconName = '1362617253_link.png';
    if (strpos($linkName, 'facebook.com') !== false || strpos($linkName, 'fb.com') !== false || strpos($linkName, 'fb.me') !== false)
        $iconName = '1362620513_facebook.png';
    
    $pcont .= '<tr><td title="' . __('Web page') . '">' . contact_icon($iconName) . '</td><td><strong><a target="_blank" href="' . $link . '">' . $linkName . '</a></strong></td></tr>';
}

$pcont .= '</table>';

echo $pcont;


function contact_icon($name) {
    return '<img class="sidebar-contacts-icon" alt="" src="' . site_url('/wp-includes/images/sidebar-contacts/' . $name) . '" />';
}
