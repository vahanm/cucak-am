<?php

$authorId = $_GET['author'];
$name = get_user_meta($authorId, 'display_name', true);
$name = (strlen($name) > 0) ? $name : __('Unknown author');
$page = 'home';

$val_Location = get_user_meta($val_userid, 'location', true);
$val_aname = get_user_meta($val_userid, 'display_name', true);
$val_phone = get_user_meta($val_userid, 'phone', true);
$val_aemail = get_user_meta($val_userid, 'email', true);
$val_contactperson = get_user_meta($val_userid, 'contactperson', true);
$val_contacttimes_begin = get_user_meta($val_userid, 'contacttimes_begin', true);
$val_contacttimes_end = get_user_meta($val_userid, 'contacttimes_end', true);
$val_user_url = get_user_meta($authorId, 'user_url', true);

if(isset($val_user_url) && strlen($val_user_url) > 3) {
    $link = $val_user_url;
    if( ! ( preg_match("/\bhttp\b/i", $link) || preg_match("/\bhttps\b/i", $link) ) )
    {
        $link = 'http://' . $link;
    }
    
    $linkName = parse_url($val_user_url, PHP_URL_HOST);
    if(!$linkName)
        $linkName = $val_user_url;
}
?>

<div class="post-header-author">
    <?php /*
    <div style="-float: right; display: inline-block;">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'market_author_bio_avatar_size', 50 ) ); ?>
    </div>
    */ ?>
    <span class="post-title-author"><?php echo $name ?></span>
    <hr />
    <table>
    <?php if(get_user_meta($authorId, 'location', true)) { ?>
        <tr>
            <td><?php _e('Location') ?></td>
            <td><?php echo getRegionString(get_user_meta($authorId, 'location', true)); ?></td>
        </tr>
    <?php } ?>
    <?php if(get_user_meta($authorId, 'phone', true)) { ?>
        <tr>
            <td><?php _e('Phone') ?></td>
            <td><a href="callto:<?php echo get_user_meta($authorId, 'phone', true); ?>"><?php echo get_user_meta($authorId, 'phone', true); ?></a></td>
        </tr>
    <?php } ?>
    <?php if(get_user_meta($authorId, 'skype', true)) { ?>
        <tr>
            <td><?php _e('Skype') ?></td>
            <td><a href="skype:<?php echo get_user_meta($authorId, 'skype', true); ?>?call"><?php echo get_user_meta($authorId, 'skype', true); ?></a></td>
        </tr>
    <?php } ?>
    <?php if(get_user_meta($authorId, 'email', true)) { ?>
        <tr>
            <td><?php _e('E-Mail') ?></td>
            <td><a href="mailto:<?php echo get_user_meta($authorId, 'email', true); ?>"><?php echo get_user_meta($authorId, 'email', true); ?></a></td>
        </tr>
    <?php } ?>
    <?php if(get_user_meta($authorId, 'contacttimes_begin', true)) { ?>
        <tr>
            <td><?php _e('Desirable contact time') ?></td>
            <td><?php echo (get_user_meta($authorId, 'contacttimes_begin', true) - 1) . ':00<span> - </span>' . (get_user_meta($authorId, 'contacttimes_end', true) - 1) . ':00' ?></a></td>
        </tr>
    <?php } ?>
    <?php if(isset($val_user_url) && strlen($val_user_url) > 3) { ?>
        <tr>
            <td><?php _e('Web page') ?></td>
            <td><a target="_new" href="<?php echo $link ?>"><?php echo $val_user_url ?></a></td>
        </tr>
    <?php } ?>
    <?php if(get_user_meta($authorId, 'description', true)) { ?>
        <tr>
            <td><?php _e('Description') ?></td>
            <td>
                <div id="author-details">
                    <?php echo str_replace(array("\r\n", '  ', " \n", "\n ", "\n\n\n", "\n"), array("\n", ' ', "\n", "\n", "\n\n", "<br/>"), get_user_meta($authorId, 'description', true)); ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>
