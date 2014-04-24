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

if (isset($val_user_url) && strlen($val_user_url) > 3) {
    $link = $val_user_url;
    if (!( preg_match("/\bhttp\b/i", $link) || preg_match("/\bhttps\b/i", $link))) {
        $link = 'http://' . $link;
    }
    
    $linkName = parse_url($val_user_url, PHP_URL_HOST);
    if (!$linkName)
        $linkName = $val_user_url;
}
?>
<div class="sector-author-contacts">

    <div class="cat-group">
        <div class="cat-group-header cat-group-header-helf"><?php _e('Contact information') ?></div>
        <?php if ($authorId > 0 && $authorId == get_current_user_id()) { ?>
            <div class="cat-group-link">
                <a href="<?php echo BA_HOME . '/account/?page=contacts' ?>" title="<?php _e('Edit contact information') ?>">
                    <?php _e('edit') ?>
                </a>
            </div>
        <?php } ?>
    </div>
    
    <div class="v-card author main">
        <span class="post-title-author"><?php echo $name ?></span>
        <hr />
        <table>
        <?php if(get_user_meta($authorId, 'location', true)) { ?>
            <tr>
                <td><?php _e('Location') ?></td>
                <td><?php echo getRegionString(get_user_meta($authorId, 'location', true)); ?></td>
            </tr>
        <?php } ?>
        <?php if(get_user_meta($authorId, 'address', true)) { ?>
            <tr>
                <td><?php _e('Address') ?></td>
                <td><?php echo get_user_meta($authorId, 'address', true); ?></td>
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
    
    <?php
    $branches_json = get_user_meta($authorId, 'branches', true);
    
    if ($branches_json) {
        $branches = json_decode($branches_json);
    }
    
    if (!isset($branches) || !is_array($branches)) {
        $branches = array();
    }
    
    if (count($branches) > 0) {
    ?>
    <div class="cat-group">
        <div class="cat-group-header cat-group-header-helf"><?php _e('Branches') ?></div>
        <?php if ($authorId > 0 && $authorId == get_current_user_id()) { ?>
            <div class="cat-group-link">
                <a href="<?php echo BA_HOME . '/account/?page=branches' ?>" class="coming-soon" title="<?php _e('Add branch') ?>">
                    <?php _e('add') ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php
    }
    
    foreach($branches as $branch) { ?>
    
    <div class="v-card author main">
        <?php if ($branch->name) { ?>
        <span class="post-title-author"><?php echo $branch->name ?></span>
        <hr />
        <?php } ?>
        
        <table>
        <?php if($branch->location) { ?>
            <tr>
                <td><?php _e('Location') ?></td>
                <td><?php echo getRegionString($branch->location); ?></td>
            </tr>
        <?php } ?>
        <?php if($branch->address) { ?>
            <tr>
                <td><?php _e('Address') ?></td>
                <td><?php echo $branch->address; ?></td>
            </tr>
        <?php } ?>
        <?php if($branch->phone) { ?>
            <tr>
                <td><?php _e('Phone') ?></td>
                <td><a href="callto:<?php echo $branch->phone; ?>"><?php echo $branch->phone; ?></a></td>
            </tr>
        <?php } ?>
        <?php if($branch->contacttimes_begin) { ?>
            <tr>
                <td><?php _e('Desirable contact time') ?></td>
                <td><?php echo ($branch->contacttimes_begin - 1) . ':00<span> - </span>' . ($branch->contacttimes_end - 1) . ':00' ?></a></td>
            </tr>
        <?php } ?>
        <?php if($branch->description) { ?>
            <tr>
                <td><?php _e('Description') ?></td>
                <td>
                    <div id="author-details">
                        <?php echo str_replace(array("\r\n", '  ', " \n", "\n ", "\n\n\n", "\n"), array("\n", ' ', "\n", "\n", "\n\n", "<br/>"), $branch->description); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </table>
    </div>

    <?php } ?>
</div>
