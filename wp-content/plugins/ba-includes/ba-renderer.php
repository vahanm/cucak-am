<?php
/* Plugin Name: BA HTML renderer
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: HTML renderer
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

function _val($id, $default = '') {
    $val = get_post_meta(get_the_ID(), "post_{$id}");
    if(isset($val[0])) {
        return $val[0];
    } else {
        return $default;
    }
}

function render_table_begin() { ?>
    <table style="width: 99%; float: left; margin-left: 5px;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
    <colgroup>
        <col width="25%"/>
        <col width="75%"/>
    </colgroup>
    <tbody>
    <?php
}

function render_table_begin_Left() { ?>
    <table style="width: 49%; float: left; margin-left: 5px;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
    <colgroup>
        <col width="50%"/>
        <col width="50%"/>
    </colgroup>
    <tbody>
    <?php
}

function render_table_begin_right() { ?>
    <table style="width: 49%; float: right; margin-left: 5px;border-left: 1px solid #ccc;border-right: 1px solid #ccc;">
    <colgroup>
        <col width="50%"/>
        <col width="50%"/>
    </colgroup>
    <tbody>
    <?php
}

function render_table_end() { ?>
        </tbody>
    </table>
<?php
}

function render_group($title) { ?>
<tr class="render_postgroup">
    <td colspan="2"> <?php echo $title ?> </td>
    </tr>
    <?php

} //render_group

function render_group_required($title) { ?>
<tr class="render_postrequiredgroup">
    <td colspan="2"> <?php echo $title ?> </td>
    </tr>
    <?php

} //render_subgroup_required

function render_group_sub($title) { ?>
<tr class="render_postsubgroup">
    <td colspan="2"> <?php echo $title ?> </td>
    </tr>
<?php
} //render_group_sub

function render_group_optional($title) { ?>
<tr class="render_postoptionalgroup">
    <td colspan="2"> <?php echo $title ?> </td>
    </tr>
    <?php

} //render_group_optional

if (!function_exists('replace_quotes')) {
    function replace_quotes($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        $tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

if (!function_exists('replace_quotes_decode')) {
    function replace_quotes_decode($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        //$tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

function render_number_v1($id, $title, $units) {
    $val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = arg($val, 0, '');
    
    $un = get_post_meta(get_the_ID(), 'post_' . $id . '_unit');
    $un = arg($un, 0, '');
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
<?php
    if(strlen($val)) {
        $dec = (int) $val == $val ? 0 : 3;
        echo '<strong>' . number_format($val, $dec, '.', ' ') . ' ' . $units[$un] . '</strong>';
    } else {
        echo __('not selected');
    }
?>
    </td>
</tr>
<?php

}

function render_number($id, $title, $units) {
    $val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = arg($val, 0, '');
    
    $un = get_post_meta(get_the_ID(), 'post_' . $id . '_unit');
    $un = arg($un, 0, '');
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
<?php
    if(strlen($val)) {
        $sep = explode('.', (string)((double)$val), 2);
        
        $sup = $sep[0];
        
        if (isset($sep[1])) {
            $sub = $sep[1];
        } else {
            $sub = false;
        }
    
        echo '<strong>' . number_format($sup, 0, '.', ' ') . ($sub ? '<span style="font-size:80%">.' . $sub . '</span>' : '') . ' ' . $units[$un] . '</strong>';
    } else {
        echo __('not selected');
    }
?>
    </td>
</tr>
<?php

}

function render_check_key($id, $title, $key, $list) {
    $val = 0;
    if (isset($key) && isset($key[0])) {
        $val = get_post_meta(get_the_ID(), 'post_' . $id . '_' . $key[0]);
        if(isset($val[0]))
            $val = $val[0];
        else
            $val = 0;
    }
    
    $result = '';
    
    if ($val == 1)
    {
        $result =  $key[1];
    } else {
        $first = true;
        foreach ( $list as $v ) {
            $val = get_post_meta(get_the_ID(), 'post_' . $id . '_' . $v[0]);
            if(isset($val[0]))
                $val = $val[0];
            else
                $val = 0;
            
            if ($val == 1)
            {
                if ($first) {
                    $result = $v[1];
                } else {
                    $result .= ',<br />' . $v[1];
                }
                $first = false;
            }
        }
    }
    if ($first)
    {
        global $hide_empty_values;
        if($hide_empty_values)
            return;
    }
?>
    <tr class="render_postinnerdiv">
        <td class="render_postlbl"><?php echo $title ?>:</td>
        <td class="render_postctrl">
        <?php
        switch ($result)
        {
            case 'image:no':
                echo '<img src="/wp-includes/images/no24.png" style="margin: 0px; margin-top: 5px; width: 18px;" />';
                break;
            case 'image:yes':
                echo '<img src="/wp-includes/images/yes24.png" style="margin: 0px; margin-top: 5px; width: 18px;" />';
                break;
            default:
                if ($first)
                {
                    echo __('not selected');
                } else {
                    echo '<strong>' . $result . '</strong>'; 
                }
                break;
        }
?>
        </td>
    </tr>
<?php
} //render_check_key

function render_check($id, $title, $list) {
    render_check_key($id, $title, 0, $list);
} //render_check

function render_value($id, $title = '', $text = '%s', $list = Array(), $searchIcon = false) {
    if(is_array($id)) {
        $args = $id;
        
        $id         = arg($args, 'id', '');
        $title      = arg($args, 'title', '');
        $text       = arg($args, 'text', '%s');
        $list       = arg($args, 'list', array());
        $searchIcon = arg($args, 'searchIcon', false);
    }
    
    $val = _val($id);
    
    global $hide_empty_values;
    if($hide_empty_values && strlen($val) == 0)
        return;
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
    <?php
    
    if(strlen($val)) {
        if(isset($list[$val])) {
            $temp = $list[$val];
            
            switch ($temp) {
                case 'image:no':
                    echo '<img src="/wp-includes/images/no24.png" style="margin: 0px; margin-top: 4px; width: 18px;" />';
                    break;
                case 'image:yes':
                    echo '<img src="/wp-includes/images/yes24.png" style="margin: 0px; margin-top: 4px; width: 18px;" />';
                    break;
                default:
                    echo '<strong>' . sprintf($list[$val], $val) . '</strong>';
                    //echo '<p style="' . (isset($v[2]) ? 'color: ' . $v[2] . '; ' : '') . (isset($v[3]) ? 'background-color: ' . $v[3] . '; ' : '') . '">' . sprintf($list[$val], $val) . '</p>';
                    break;
            }
        } else {
            echo '<strong>' . sprintf($text, $val) . '</strong>';
            if(WP_TEST && isset($searchIcon) && (is_bool($searchIcon) && $searchIcon || is_array($searchIcon))) {
                render_search_buttons(sprintf($text, $val), $searchIcon);
            }
        }
    } else {
        echo __('not selected');
    }
    ?>
    </td>
</tr>
<?php
}

function render_search_buttons($text, $providers) {
    $text = trim($text);
    
    if(strlen($text) < 2)
        return;

    echo '<a class="social-search-button" href="http://www.google.com/search?q=' . urlencode($text) . '" target="_blank"><img src="' . site_url('/wp-includes/images/social_google_box_white.png') . '" title="' . __('Google search') . '" /></a>';
    echo '<a class="social-search-button" href="http://www.ebay.com/sch/i.html?_nkw=' . urlencode($text) . '" target="_blank"><img src="' . site_url('/wp-includes/images/ebay.ico') . '" title="' . __('eBay search') . '" /></a>';
    echo '<a class="social-search-button" href="http://cucak.am/?s=' . urlencode($text) . '" target="_blank"><img src="' . site_url('/wp-includes/images/cucak_16.ico') . '" title="' . __('Cucak.am search') . '" /></a>';
    echo '<a class="social-search-button" href="http://www.gsmarena.com/results.php3?sQuickSearch=yes&sName=' . urlencode($text) . '" target="_blank"><img src="' . site_url('/wp-includes/images/gsm_logo.png') . '" title="' . __('gsmarena.com search') . '" /></a>';
}

function render_text($id, $title) {
    $val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = $val[0];
    
    global $hide_empty_values;
    if($hide_empty_values && strlen($val) == 0)
        return;
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
    <?php
    
    if(strlen($val))
    {
        echo '<p>' . $val . '</p>';
    } else {
        echo __('not selected');
    }

    ?>
    
    </td>
</tr>
<?php
}

function render_yes_no($id, $title = '') {
    if(is_array($id)) {
        $args = $id;
        
        $id         = arg($args, 'id', '');
        $title      = arg($args, 'title', '');
    }
    render_value(array(
        'id' => $id
        , 'title' => $title
        , 'text' => 'Error'
        , 'list' => array(1 => 'image:no', 2 => 'image:yes')
    ));
}

function render_color_old_old($id, $title) {
$val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = $val[0];
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"> <?php echo $title ?> : </td>
    <td class="render_postctrl">
    <div style="width: 200px; height: 16px; border: 1px solid #777; background-color: <?php echo $val ?>;"></div>
    </td>
</tr>	
    <?php
}

function render_color_old($id, $title) {
$val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = $val[0];
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    <div style="width: 120px; height: 16px; border: 1px solid #777; background-color: #<?php echo $val ?>;"><?php _e('RGB ' . $val) ?></div>
    </td>
</tr>	
    <?php
}

function render_files() {
    echo '<div id="filebox" style="width: 99%; float: left;">';
    
    $format = get_post_meta(get_the_ID(), 'post_files');
    $format = $format[0];
    
    $list = split('[{]json[}]', $format);
    
    $id = 1;
    
    //$list = array_reverse( $list );
    
    foreach ($list as $item) {
        $showinfo = true;
        
        if (strlen($item) > 3) {
            $id += 1;
            
            $info = json_decode(replace_quotes_decode($item));
            
            $name = _v('file_' . MD5($info->name));
            
            switch($info->type) {
                case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                    echo '<div id="att_'. $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; margin-right: 2px; margin-left: 2px; vertical-align:top; text-align:center; display: inline-block;">';					
                    if(isset($info->big_url)) {
                        echo '<a href="' . $info->big_url . '" target="_new" rel="lightbox[roadtrip]" image-title="' . str_replace('"', '&quot;', $name) . '"><img style="" alt="' . $info->name . '" src="' . $info->standards_url . '" /></a>';
                    } else {
                        echo '<a href="' . $info->url . '" target="_new" rel="lightbox[roadtrip]" image-title="' . str_replace('"', '&quot;', $name) . '"><img style="" alt="' . $name . '" src="' . $info->standards_url . '" /></a>';
                    }
                    
                    $showinfo = false;
                    break;
                case 'application/msword': case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/doc.png"/></a>';
                    break;
                case 'text/plain':
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/text.png"/></a>';
                    break;
                case 'application/vnd.ms-excel': case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/excel.png"/></a>';
                    break;
                case 'application/x-zip-compressed':
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/archive.png"/></a>';
                    break;
                case 'application/pdf':
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/pdf.png"/></a>';
                    break;
                default:
                    echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $name . '" src="/wp-includes/images/icons/unknown.png"/></a>';
            }
            
            echo '<br/>';
            echo '<a style="font-size: 115%;" title="' . __('View original') . '" href="' . $info->url . '" target="_new">' . $name . '</a><br />';
                
            if($showinfo) {
                echo 'Size: ' . formatSizeUnits($info->size) . '<br />';
            }
            echo '</div>';
        }
    }
    echo '</div>';
}

function render_post_meta_for_facebook() {
    //echo '<meta property="og:updated_time" content="', ' ', '" />', "\n";
    
    {
        $my_content = get_content_plain(_v('cat'));
        
        if (!$my_content) {
            $my_content = get_the_content();
        }
        
        if (($my_content = trim($my_content)) != '') {
            echo '<meta property="og:description" content="', as_attribute($my_content), '" />', "\n";
        }
    }
    
    {
        $format = get_post_meta(get_the_ID(), 'post_files');
        $format = $format[0];
    
        $list = split('[{]json[}]', $format);
    
        foreach ($list as $item) {
            $showinfo = true;
        
            if (strlen($item) > 3) {
                $info = json_decode(replace_quotes_decode($item));
            
                $name = _v('file_' . MD5($info->name));
            
                switch ($info->type) {
                    case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                        if (isset($info->big_url)) {
                            echo '<meta property="og:image" content="http:' . BA_HOME . $info->big_url . '" />';
                        } else {
                            echo '<meta property="og:image" content="http:' . BA_HOME . $info->url . '" />';
                        }
                    
                        $showinfo = false;
                        break;
                }
            }
        }
    }
}

function render_pictures() {
    $postId = get_the_ID();
    
    $format = get_post_meta($postId, 'post_files');
    $format = $format[0];
    
    /*
            <figure class="gallery-thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
            </figure>
            
            <p class="post-pictures">
                <?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>', $total_images, TEMPLATE_DOMAIN ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', TEMPLATE_DOMAIN ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images )); ?>
            </p>
    */
    $list = split('[{]json[}]', $format);
    
    $id = 0;
    
    $list = array_reverse( $list );
    $count = 0;
    
    foreach ($list as $item) {
        $showinfo = true;
        
        if (strlen($item) > 3) {
            $id += 1;
            
            $info = json_decode(replace_quotes_decode($item));
            
            //var_dump(replace_quotes_decode($item));
            //var_dump($info);
            
            $name = _v('file_' . MD5($info->name));
            
            //if(!$name)
            //	$name = $info->name;
            
            switch($info->type) {
                case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                    if(isset($info->big_url)) {
                        $url = $info->big_url;
                        $alt = $info->name;
                    } else {
                        $url = $info->url;
                        $alt = $name;
                    }
                    
                    if (($count++) > 2) {
                        echo '<a class="ui-helper-hidden" href="' . $url . '" target="_new" rel="lightbox[gallery_'. $postId . ']" imagetitle="' . $name . '"></a>';
                    } else {
                        //echo '<div id="att_'. $postId . '_'. $id . '" class="post-gallery-pictures">';
                        //echo '<a href="' . $url . '" target="_new" rel="lightbox[gallery_'. $postId . ']" imagetitle="' . $name . '"><img style="" alt="' . $alt . '" src="' . $info->thumbnail_230x120_url . '" /></a>';
                        //
                        //echo '<br/>';
                        //echo '<a style="font-size: 115%;" title="' . __('View original') . '" href="' . $info->url . '" target="_new">' . $name . '</a><br />';
                        //echo '</div>';
                        
                        echo '<a class="thumbnail" href="' . $url . '" target="_new" rel="lightbox[gallery_'. $postId . ']" imagetitle="' . $name . '" style="background-image: url(\'' . $info->thumbnail_230x120_url . '\')" /></a>';
                    }
                    break;
            }
        }
    }
    
    for ($i = $count; $i < 3; $i++) {
        //$url = site_url('/wp-includes/images/no_image_230x120.png');
        //echo '<div id="att_'. $postId . '_'. $id . '" class="post-gallery-pictures">';
        ////echo '<div style="">' . __('No image') . '</div>';
        //echo'<img style="" alt="' . $alt . '" src="' . $url . '" /></a>';
        //echo '<br/>';
        //echo '<span style="font-size: 115%;">' . __('No image') . '</span><br />';
        //echo '</div>';
        
        echo '<div class="thumbnail no-image-230x120" /></div>';
    }
    
    return (object)array(count => $count);
}

function render_files_link() {
    $format = get_post_meta(get_the_ID(), 'post_files');
    $format = $format[0];
    
    $list = split('[{]json[}]', $format);
    
    $id = 1;
    
    //$list = array_reverse( $list );
    
    foreach ($list as $item) {
        if (strlen($item) > 3) {
            $info = json_decode(replace_quotes_decode($item));
            
            $name = _v('file_' . MD5($info->name));
            
            //if(!$name)
            //	$name = $info->name;
            
            switch ($info->type) {
                case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                    echo '<span style="'; //float: left; 
                    
                    if($id == 1)
                        echo '';
                    else
                        echo 'display: none;';
                    
                    echo '"> &#183; <a style="color: #933;" href="';
                    
                    if(isset($info->big_url))
                        echo $info->big_url;
                    else
                        echo $info->url;
                    
                    echo '" target="_new" lightbox rel="lightbox[album_' . get_the_ID() . ']" imagetitle="' . $name . '">' . __('Images') . '</a></span> ';
                    
                    $id += 1;
                    break;
            }
        }
    }
}

function render_files_link_hidden() {
    $format = get_post_meta(get_the_ID(), 'post_files');
    $format = $format[0];
    
    $list = split('[{]json[}]', $format);
    
    $id = 1;
    
    $list = array_reverse( $list );
    
    foreach($list as $item)
    {
        $showinfo = true;
        
        if(strlen($item) > 3)
        {
            
            $info = json_decode(replace_quotes_decode($item));
            
            $name = _v('file_' . MD5($info->name));
            
            if(!$name)
                $name = $info->name;
            
            switch($info->type)
            {
                case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                    echo '<a style="display: none;" href="';
                    
                    if(isset($info->big_url))
                        echo $info->big_url;
                    else
                        echo $info->url;
                    
                    echo '" target="_new" rel="lightbox[album_' . get_the_ID() . ']" imagetitle="' . $name . '">' . __('Images') . '</a>';
                    
                    $id += 1;
                    break;
            }
        }
    }
}

function render_location($id, $title = '', $namesCount = 2) {
    if(is_array($id)) {
        $args = $id;
        
        $id			= arg($args, 'id', '');
        $title		= arg($args, 'title', '');
        $namesCount	= arg($args, 'namesCount', 2);
    }
    
    $val = get_post_meta(get_the_ID(), 'post_' . $id);
    $val = $val[0];
    
    global $hide_empty_values;
    if($hide_empty_values && strlen($val) == 0)
        return;
        
    $valShort = getRegionString($val, $namesCount);
    $valFull = getRegionString($val);
        
    if($hide_empty_values && strlen($val) == 0)
        return;
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
    <?php
    
    if ($val > 0) {
        echo '<strong title="' . $valFull . '">' . $valShort . '</strong>';
    } else {
        echo __('not selected');
    }

    ?>
    </td>
</tr>
<?php
}

function render_format($id, $title = '', $searchIcon = false) {
    if(is_array($id)) {
        $args = $id;
        
        $id         = arg($args, 'id', '');
        $title      = arg($args, 'title', '');
        $searchIcon = arg($args, 'searchIcon', false);
    }
        
    $fname = "value_view_$id";
    $format = __($fname, 'FORMAT');

    if($fname == $format)
        return false;
    
    $format = apply_format($format, 'view', get_the_ID());
    
    $format = trim($format);
    $format = rtrim($format, ",");
    
    global $hide_empty_values;
    if($hide_empty_values && strlen($val) == 0)
        return false;
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
<?php
    if(strlen($format)) {
        switch ($format) {
            case 'image:no':
                echo '<img src="/wp-includes/images/no24.png" style="margin: 0px; margin-top: 4px; width: 18px;" />';
                break;
            case 'image:yes':
                echo '<img src="/wp-includes/images/yes24.png" style="margin: 0px; margin-top: 4px; width: 18px;" />';
                break;
            default:
                echo '<strong>' . $format . '</strong>';
                if(WP_TEST && isset($searchIcon) && (is_bool($searchIcon) && $searchIcon || is_array($searchIcon))) {
                    render_search_buttons($format, $searchIcon);
                }
                break;
        }
    } else {
        echo __('not selected');
    }
?>
    </td>
</tr>
<?php
}

function render_date($id, $title = '') {
    if(is_array($id)) {
        $args = $id;
        
        $id         = arg($args, 'id', '');
        $title      = arg($args, 'title', '');
    }
    
   
    $selected = _val("{$id}_selected", 0);
    
    if ($selected == 1) {    
        $months = array(
            1 => __('January'),
            2 => __('February'),
            3 => __('March'),
            4 => __('April'),
            5 => __('May'),
            6 => __('June'),
            7 => __('July'),
            8 => __('August'),
            9 => __('September'),
            10 => __('October'),
            11 => __('November'),
            12 => __('December'),
        );

        $day = _val("{$id}_day");
        $month = $months[_val("{$id}_month")];
        $year = _val("{$id}_year");
    }
    
    global $hide_empty_values;
    if($hide_empty_values && strlen($val) == 0)
        return;
    
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
    
    <?php
    
    if ($selected == 1) {
        echo "<strong>$day $month $year", __('y'), "</strong>";
    } else {
        echo __('not selected');
    }
    ?>
    </td>
</tr>
<?php
}
