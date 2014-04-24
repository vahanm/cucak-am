<?php
require_once(dirname(__FILE__) . '/../wp-config.php');

global $wpdb, $userDataKeys;

$userDataKeys = array(
                      'post_date'
                    , 'post_userid'
                    , 'post_location'
                    , 'post_aname'
                    , 'post_phone'
                    , 'post_aemail'
                    , 'post_contacttimes_begin'
                    , 'post_contacttimes_end'
                    , 'post_remote_ip'
                    , 'post_remote_user'
                    , 'post_remote_user_red'
                    );

function _pe($id, $default = '', $empty = '') {
    echo _p($id, $default, $empty);
}

function _p($id, $default = '', $empty = '') {
    if (isset($_POST["post_$id"])) {
        $value = $_POST["post_$id"];
        if ($value == null || $value == '') {
            return $default;
        } else {
            return $value;
        }
    } else {
        if (isset($_GET[$id]) && !isset($_POST['submitButton'])) {
            $value = $_GET[$id];
            if ($value == null || $value == '') {
                return $default;
            } else {
                return $value;
            }
        } else {
            return $default;
        }
    }
}

function _p_isset($id) {
    return isset($_POST["post_$id"]);
}

function _pu($id, $key) {
    global $editMode, $submited;
    
    if ($editMode)
        $user_id = _p('userid');
    else
        $user_id = get_current_user_id();
    
    if ($user_id == 0 || $user_id == 2) {
        return _p($id);
    } else {
        if ($submited) {
            update_user_meta($user_id, $key, _p($id));
        }
        
        return get_user_meta($user_id, $key, true);
    }
}

function _pu_v3($id, $key) {
    global $editMode, $submited;
    
    if ($editMode)
        $user_id = _p('userid');
    else
        $user_id = get_current_user_id();
    
    if ($user_id == 0 || $user_id == 2) {
        $user_id = 2;
        $result = _p($id);
    } else {
        if ($submited) {
            $result = _p($id);
            update_user_meta($user_id, $key, $result);
        } else {
            $result = get_user_meta($user_id, $key, true);
        }
    }
    return $result;
}

function _pu_v2($id, $key) {
    global $editMode, $submited;
    
    if ($editMode)
        $user_id = _p('userid');
    else
        $user_id = get_current_user_id();
    
    if ($user_id == 0 || $user_id == 2) {
        $user_id = 2;
        $result = _p($id);
    } else {
        $user_data = get_user_meta($user_id, $key);    
        
        if (is_array($user_data) && count($user_data) == 1) {
            $user_data = $user_data[0];
        } else {
            $user_data = null;
        }
        
        $post_data = _p($id);
        
        if ($submited) {
            $result = $post_data;
        } else {
            $result = ($user_data == null) ? $post_data : $user_data;
        }
        
        if ($user_data != $result || !$user_data)
            update_user_meta($user_id, $key, $result);
    }
    return $result;
}

function _pu_v1($id, $key) {
    global $editMode;
    
    if ($editMode)
        $user_id = _p('userid');
    else
        $user_id = get_current_user_id();
    
    if ($user_id == 0 || $user_id == 2) 
    {
        $user_id = 2;
        $result = _p($id);
    }
    else
    {
        $user_data = get_user_meta($user_id, $key);    
        
        if (is_array($user_data) && count($user_data) == 1) {
            $user_data = $user_data[0];
        } else {
            $user_data = null;
        }
        
        $post_data = _p($id);
        
        //$result = $post_data || $user_data; //($user_data != '' && $post_data == '') ? $user_data : $post_data;
        //$result = ($user_data != '' && $post_data == '') ? $user_data : $post_data;
        $result = (_p_isset($id)) ? $post_data : $user_data;

        if ($user_data != $result || !$user_data)
            update_user_meta($user_id, $key, $result);
    }
    return $result;
}

function wppostreviewbyadmin_reviewposts($postarr, $editMode, $cat, $id) {
    global $wpdb, $wp_rewrite;
    
    $newpost = array();
    
    if ($editMode) {
        $newpost['ID'] = $id;
        
        $meta = get_post_meta($id);
    
        foreach($meta as $meta_key => $meta_value) {
            if (strpos($meta_key, '_count-views_') === false
                && (!isset($_POST[$meta_key]) || !($_POST[$meta_key]))) {
                delete_post_meta($id, $meta_key);
            }
        }
    }
    
    $newpost["post_author"] = _p('userid');
    
    $cats = array($cat);
    
    $newpost["post_category"] = $cats;
    $newpost["post_date"] = date_normal();
    
    $title = htmlspecialchars(_p('title'), ENT_QUOTES);
    if (!$title)
        $title = 'No title';
    $newpost["post_title"] = $title;
    $newpost["post_content"] = _p('content');
    $newpost["post_status"] = 'publish';
    $newpost["post_type"] = 'post';
    $newpost["tags_input"] = $_POST["tags"];
    
    $wp_error = '';
    
    if ($editMode)
        $pid = wp_update_post( $newpost );
    else
        $pid = wp_insert_post( $newpost, $wp_error );
    
    if ($pid != '') {
        switch ($cat) {
            case 404:
                set_post_format($pid, 'gallery' );
        }
        
        if ($_POST) {
            _pu('aname', 'display_name');
            _pu('aemail', 'email');
            _pu('phone', 'phone');
            _pu('skype', 'skype');
            _pu('location', 'location');
            _pu('contactperson', 'contactperson');
            _pu('contacttimes_begin', 'contacttimes_begin');
            _pu('contacttimes_end', 'contacttimes_end');
            
            //global $userDataKeys;
            
            //Default image issue fix
            if ((!isset($_POST['post_thumbnail']) || !$_POST['post_thumbnail']) && isset($_POST['post_files']) && $_POST['post_files']) {
                $list = split('[{]json[}]', $_POST['post_files']);
    
                foreach ($list as $item) {
                    if (strlen($item) > 3) {
                        $info = json_decode(replace_quotes_decode($item));
            
                        switch ($info->type) {
                            case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                                $_POST['post_thumbnail'] = $info->url;
                                break;
                        }
                    }
                    
                    if (isset($_POST['post_thumbnail'])) {
                        break;
                    }
                }
            }
            
            foreach ($_POST as $meta_key => $meta_value) {
                if ($meta_value) {
                    update_post_meta($pid, $meta_key, $meta_value);
                }
            }
        }
        
        if (_p('allow_sale') && _p('sale_contract') < 2 && _p('sale_price'))
            update_post_meta($pid, 'post_sale_realprice', cur_GetReal(_p('sale_currency'), _p('sale_price')));
        
        if (_p('allow_rent') && _p('rent_contract') < 2 && _p('rent_price'))
            update_post_meta($pid, 'post_rent_realprice', cur_GetReal(_p('rent_currency'), _p('rent_price'), _p('rent_frequency')));
        
        if (_p('allow_salary') && _p('salary_type') < 2 && _p('salary'))
            update_post_meta($pid, 'post_salary_realprice', cur_GetReal(_p('payment_currency'), _p('salary'), _p('payment_frequency')));
        
        if (_p('allow_payment') && _p('payment_type') < 2 && _p('payment'))
            update_post_meta($pid, 'post_payment_realprice', cur_GetReal(_p('payment_currency'), _p('payment'), _p('payment_frequency')));
    }
    
    if ($pid != "" && false)    {
        //Moderators
        sendPostData('vahan.mkhitaryan@facebook.com', 'Vahan Mkhitaryan', $pid);
        sendPostData('sargis.grigoryan@facebook.com', 'Sargis Grigoryan', $pid);
        
        sendPostData(_p('aemail'), _p('aname'), $pid);
    }
    
    if ($pid != '' && true) {        
        $StrMailcontent1 = '
                <html>
                    <head>
                        <title>' . __("You have added an announcement to cucak.am") . '</title>
                    </head>
                    <body>
                        <div style="border: 10px solid #3AABE3; float:left; width:610px;">
                            <table align="center" width="610px" border="0" cellpadding="4" cellspacing="4">
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td style="color: #4E6E8E;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;"><strong>' . __('Hello') .' ' . _p('aname') . '</strong></font></td>
                                </tr>
                                <tr>
                                    <td style="color: #4E6E8E;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;">'. __("Thank you for adding your announcement on cucak.am") . '</font></td>
                                </tr>
                                <tr>
                                    <td width="130" valign="top" style="color: #4E6E8E;">
                                        <a href="http://cucak.am/?p=' . $pid . '"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;"><strong>' . get_title_formated($cat, $pid) . '</strong></font></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="130" valign="top" style="color: #4E6E8E;">
                                        <a href="http://cucak.am/?p=' . $pid . '"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;">' . __('To View the announcement click here.') . '</font></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="130" valign="top" style="color: #4E6E8E;">
                                        <a href="http:' . getEditLink($cat, $pid, getEditKey($pid)) . '"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;">' . __('To Edit the announcement click here.') . '</font></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="color:#4E6E8E;">
                                        <font size="2" face="Verdana, Arial, Helvetica, sans-serif;">' . __('With best regards <br/>Cucak.am Support team') . '</font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-bottom:1px dotted #cccccc;"></td>
                                </tr>
                            </table>
                        </div>
                    </body>
                </html>';
        $subject_base64 = '=?UTF-8?B?' . base64_encode(__("You have added an announcement to cucak.am")) . '?=';
        $subject1 = 'You have added an announcement to cucak.am';
        $headers1  = 'MIME-Version: 1.0' . "\r\n";
        $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers1 .= 'From: Admin Sample Website<' . get_option('wppostreviewbyadmin_adminmailid') . '>' . '' . "\r\n";
        //$headers1 .= "Subject: $subject_base64\r\n";
        $ToEmail1 = _p('aemail');
        
        if (!$editMode) {
            //if (_p('userid') == 1) sendPostData(_p('aemail'), _p('aname'), $pid);
            if (_p('userid') == 2) {
                wp_mail($ToEmail1, $subject_base64, $StrMailcontent1, $headers1);
            }
            /* ****************** For Moderators ******* BEGIN ******* */
            global $moderators_emails;
            
            wp_mail($moderators_emails, $subject_base64, $StrMailcontent1, $headers1);
            
            //sendPostDataAdmin('vahan.mkhitaryan@gmail.com', 'Vahan Mkhitaryan', $pid);
            //sendPostDataAdmin('sagrigoryan@mts.am', 'Sargis Grigoryan', $pid);
            /* ****************** For Moderators *******  END  ******* */
            
            //wp_mail('vahan.mkhitaryan@gmail.com', 'New post', $StrMailcontent1, $headers1);
            //wp_mail('sagrigoryan@mts.am', 'New post', $StrMailcontent1, $headers1);

            //$appmsg = "The selected post has been approve successfully";
            //echo "<div id=\"message\" class=\"updated fade\"><p>$appmsg</p></div>";
        }
    }
    //}

    return $pid;
}

function addpostbyuser_func($cat) {
    $editPost = arg($_GET, 'editpost', false);
    $editKey = arg($_GET, 'editkey', false);
    
    $modifyPost = arg($_GET, 'modifypost', false);
    $copyPost = arg($_GET, 'copypost', $modifyPost);
    
    global $editMode, $copyMode, $submited;
    $editMode = false;
    $copyMode = false;
    $submited = isset($_POST['submitButton']);
    
    if ($editPost && $editKey && getEditKey($editPost) == $editKey) {
        if (!isset($_POST['submitButton'])) {
            $meta = get_post_meta($editPost);
    
            //var_dump($meta);
            foreach($meta as $key => $value) {
                switch($key) {
                    case 'submitButton':
                        break;
                    default:
                        $_POST[$key] = $value[0];
                }
            }
        }
        $editMode = true;
    } elseif ($copyPost) {
        if (!isset($_POST['submitButton'])) {
            global $userDataKeys;
            
            $meta = get_post_meta($copyPost);
            
            foreach($meta as $key => $value) {
                switch($key) {
                    case 'submitButton':
                        break;
                    default:
                        if (!in_array($key, $userDataKeys)) {
                            $_POST[$key] = $value[0];
                        }
                }
            }
        }
        $copyMode = true;
    }


    echo '<h2 not-freez="fixed-post-title">', _t('Adding to category: %s', __(get_cat_name( $cat ))), '</h2>';

    $error = '';

    //if (_p('location') < 0)    {
    //    $error .= make_error_message('location', __('Please select the location.'));
    //}
    //$error .= require_selection('location', __('Please select the location.'));
    //$error .= require_numbercomparison('location', '>', 0, __('Please select the location.'));

    if (mb_strlen(_p('aname')) > 60)    {
        $error .= make_error_message('aname',  _t('Name must be contents %s chars maximum.', 60));
    }
    if (mb_strlen(_p('phone')) > 0 && mb_strlen(_p('phone')) < 6)    {
        $error .= make_error_message('phone',  __('Please enter a valid phone number(s).'));
    }
    if (mb_strlen(_p('phone')) > 60)    {
        $error .= make_error_message('phone',  _t('Phone number must be contents %s chars maximum.', 60));
    }
    if (mb_strlen(_p('aemail')) > 0 && !is_email(_p('aemail'), true))    {
        $error .= make_error_message('aemail',  __('Please enter a valid email address.'));
    }

    $error .= require_selection('contactperson', __('Please select the contact person.'));


    $fname = 'value_titleformat_' . $cat;
    $format = __($fname, 'FORMAT');
    $showTitle = $fname == $format;
    if ($showTitle)
        $error .= require_selection('title', __('Please enter the title of the article.'));

    if (mb_strlen(_p('title')) > 80)    {
        $error .= make_error_message('title',  _t('Title of the article must be contents %s chars maximum.', 80));
    }
    //if (!_p('aname'))    {
    //    $error .= make_error_message('aname',  __('Please enter a name.'));
    //}


    //------------------------------------------------------------------------------------------------------------------------------------------------------------------

    if (function_exists('getBaForm')) {
        getBaForm(arg($_GET, 'type', 0), 'req');
        if (function_exists('get_form_errors')) {
            $error .= get_form_errors();
        }
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------

    if (isset($_POST['submitButton'])) {
        if (mb_strlen($error)) {
            $spl_id = 0;
        } else {
            $spl_id = wppostreviewbyadmin_reviewposts($_POST, $editMode, $cat, $editPost);
        }
    } else {
        $error = '';
    }

    if ($spl_id) {
        addpostsuccess();
        
        echo '
                <form id="redirecttopost" action="/?p=' . $spl_id . '" style="display: none;" method="post">
                    <input type="hidden" name="success" value="' . $cat . '">
                    <input type="hidden" name="post" value="' . $spl_id . '">
                    <input type="hidden" name="key" value="' . getEditKey($spl_id) . '">
                </form>
                
                <script type="text/javascript">
                    $(\'#redirecttopost\').submit();
                </script>';
    } else {

    if ($editMode)
        $user_id = _p('userid');
    else
        $user_id = get_current_user_id();
    
    if ($user_id == 0) {
        $user_id = 2;
    }
    
    //User meta
    $user_display_name =        _pu('aname', 'display_name');
    $user_email =               _pu('aemail', 'email');
    $user_phone =               _pu('phone', 'phone');
    $user_skype =               _pu('skype', 'skype');
    $user_location =            _pu('location', 'location');
    $user_contactperson =       _pu('contactperson', 'contactperson');
    $user_contacttimes_begin =  _pu('contacttimes_begin', 'contacttimes_begin');
    $user_contacttimes_end =    _pu('contacttimes_end', 'contacttimes_end');
?>

<form id="frmaddpost" name="frmaddpost" method="post" enctype="multipart/form-data">
    <div class="addpostmaindiv">

    <!-- -------------------- Hidden input controls ------------------------------------ -->
    <input type="hidden" id="userid" name="post_userid" value="<?php echo $user_id; ?>" />
    
    <input type="hidden" id="remote_ip" name="post_remote_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
    <input type="hidden" id="remote_user" name="post_remote_user" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
    <input type="hidden" id="remote_user_red" name="post_remote_user" value="<?php echo $_SERVER['REDIRECT_REMOTE_USER']; ?>" />
    
    <input type="hidden" id="cat" name="post_cat" value="<?php if (_p('cat')) { echo _p('cat'); } else { echo arg($_GET, 'type', 0); } ?>" />
    
    <input type="hidden" id="agent" name="post_agent" value="<?php echo arg($_GET, 'agent', '') ?>" />
    
    
    <!-- -------------END----------- Hidden input controls -----------------END---------------- -->
    <?php
        helper_group('name_and_transaction_information', __('Title of the article and transaction conditions'));
                
        if ($showTitle) {
            helper_begin('title', __('Title of the article'));
    ?>
                    <input type="text" id="title" class="txtbg defaultText" defalutvalue="<?php _e('Please enter the title of the article.') ?>" value="<?php echo replace_quotes(_p('title')); ?>" size="30" name="post_title" />
                    <br />
                    <span class="hint"><?php echo sprintf(__('%s characters max'), 80); ?></span> </p>        
    <?php
            helper_end('title', __('Title of the article'));
        }
    ?>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
        <?php /*
        <div class="addpostinnerdiv" id="container_expirydate" <?php the_hint('expirydate'); ?>>
            <div class="addpostlbl">
                <p>
                    <?php _e('Expiry date'); ?>:</p>
            </div>
            <div class="addpostctrl">
                <input type="hidden" id="expirydate" class="txtbg" value="30" size="30" name="post_expirydate" />

                <div id="expirydate_view" style="width:100%; float:left; text-align:center; font-weight:bold; font-size: 120%"></div>
                
                <br />
                
                <div id="slider_expirydate"></div>
                
                <div style="width:49%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php echo _t('%s days', 3) ?></div>
                <div style="width:49%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php echo _t('%s days', 90) ?></div>
                
                </div>
                </div>
                
                <script type="text/javascript">
                $(document).ready(function() {
                $('#slider_expirydate').slider({
                range: "min",
                value: <?php if (_p('expirydate')) { echo (_p('expirydate')); } else { echo 30; }; ?>,
            min: 3,
            max: 90,
            slide: function( event, ui ) {
                $( "#expirydate" ).val( ui.value );
                
            var str_expirydate = "<?php _e('%s days') ?>";
            
            $( "#expirydate_view" ).text( str_expirydate.replace("%s", ui.value) );
            } // slide: function
            }) // $slider

            var str_expirydate = "<?php _e('%s days') ?>";
            $( "#expirydate_view" ).text( str_expirydate.replace("%s", $( "#slider_expirydate" ).slider( "value" ) ));
            
            
            }); // $(document).ready
            </script>    
              */ ?>
            <?php
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        if (function_exists('getBaForm')) {
            getBaForm(arg($_GET, 'type', 0), 'add');
        }
        
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------
        
        //helper_text('link', __('Web link'), __('Please enter a web link for more information.'));
        
        helper_links_from_net();
        ?>
        <div class="addpostinnerdiv">
            <div class="addpostlbl">
                <p>
                    <?php _e('Article content / More information') ?>:</p>
                    </div>
                    <div class="addpostctrl">
                    <p>
                    <textarea id="post_content" name="post_content" class="txtareabgcont" cols="40" rows="20" style="width: 90%" ><?php echo _p('content'); ?></textarea>
                </p>
            </div>
        </div>
        <?php
        //helper_upload();
        helper_upload_old();
        ?>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
        
        
    <?php
        
    helper_group('contact', __('Contact information'));
        
    helper_user_location($user_location);
        
    helper_begin('aname', __('Your name'));                    
        ?>
        <input type="text" id="aname" name="post_aname" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your name.') ?>" value="<?php echo replace_quotes($user_display_name); ?>">
        <?php
        helper_end('aname', __('Your name'));
        
        helper_begin('phone', __('Phone'));
        ?>
        <input type="text" id="phone" name="post_phone" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your phone number(s).') ?>" value="<?php echo replace_quotes($user_phone); ?>" />
        <?php
        helper_end('phone', __('Phone'));
        
        helper_begin('contacttimes' ,__('Desirable contact time'));
                ?>
                        <select  id="contacttimes_begin" name="post_contacttimes_begin" style="width: 40%">
                <?php
        
        echo '<option value="">' . __('any time') . '</option>';
        
        for($i = 1; $i <= 24; $i++)
        {
            echo '<option value="' . $i . '" ' . ($user_contacttimes_begin == $i ? 'selected="selected"' : '') . '>' . ($i - 1) . ':00</option>';
        }
        ?>
        </select>
        <span id="contacttimes_cont"  style="<?php if ($user_contacttimes_begin == '') { ?> display: none; <?php } ?>">
            <span> - </span>
            <select  id="contacttimes_end" name="post_contacttimes_end" style="width: 40%">
            <?php
            for($i = 1; $i <= 24; $i++)
            {
                echo '<option value="' . $i . '" ' . ($user_contacttimes_end == $i ? 'selected="selected"' : '') . '>' . ($i - 1) . ':00</option>';
            }
            ?>
            </select>
        </span>
        <script>
        
        $(document).ready(function() {
            $('#contacttimes_begin').change(function(){
                if ($(this).find('option:selected').val().length > 0) {
                    $('#contacttimes_cont').fadeIn();
                } else {
                    $('#contacttimes_cont').fadeOut();
                }
            });
        });
        
        </script>
        <?php
        helper_end('contacttimes', __('Contact times'));
        
        helper_begin('aemail' ,__('E-Mail'));
        /*
        ?>
        <input type="text" id="" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your E-Mail address.') ?>" value="<?php 
        
        if ($user_id == 0) 
        {    
        echo replace_quotes(_p('aemail')); 
        }
        else
        {
        echo $user_email;
        echo '"';
        echo ' readonly="readonly" ';
        }
        
        ?>" name="post_aemail">
        <br />
        <span class="hint"><?php _e('To manage your announcements and receive notifications. Invisible to other visitors.'); ?></span> </p>
        <?php
         */
                ?>
                <input type="text" id="" class="txtbg defaultText" defalutvalue="<?php _e('Please enter your E-Mail address.') ?>" value="<?php echo $user_email; ?>"  name="post_aemail" />
                <br />
                <?php
        if ($user_id == 2) 
        {
                    ?><span class="hint"><?php _e('To manage your announcements and receive notifications. Invisible to other visitors.'); ?></span><?php
        }
        else
        {
                    ?><span class="hint"><?php _e('Visible to other visitors.'); ?></span><?php
        }
                ?>
                </p>
    <?php
        helper_end('aemail' ,__('E-Mail'));
        
        
        //helper_radio('contactperson', __('Contact person'), array( 
        //    array(1, __('private')),  
        //    array(2, __('company')),  
        //    array(3, __('intermediary'))
        //    ) );

        helper_begin('contactperson', __('Contact person'));
        
        $values = array( 
            array(1, __('private')),  
            array(2, __('company')),  
            array(3, __('intermediary'))
            );
    ?>
        <table class="checkgrid">
        <?php
        $i = 0;
        foreach ( $values as $v ) {
            echo '<td>';
        ?>
            <input type="radio" id="contactperson_<?php echo $v[0]; ?>" name="post_contactperson" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if ($user_contactperson == $v[0]) { ?> checked="checked" <?php } ?> />
            <label for="contactperson_<?php echo $v[0]; ?>"><?php echo $v[1]; ?></label>
            <?php
            
            echo '</td>';
            
            $i++;
        }
        ?>
        </table>
    <?php
        helper_end('contactperson', __('Contact person'));
    ?>
        
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
        
        <div class="addpostinnerdiv">
            <div style="float:left; width:620px; padding: 0px 30px 0px 30px;">
                <p id="message_terms"><?php _e('message_terms') ?></p>
            </div>
        </div>
        <?php if (mb_strlen($error)) { ?>
            <div class="hint-arrow hint-arrow-error">
                <div class="hint-arrow-error-message">
                    <?php _e('hint_press_to_navigate') ?>
                </div>
            </div>
            <div class="error fixed fixed-qer-list">
                <?php echo $error; ?>
                <input type="button" value="<?php _e('Submit Article') ?>" id="submitButtonSecondary" name="submitButton" onclick="submitForm()">
            </div>
        <?php } else { ?>
            <div class="addpostinnerdiv">
                <div class="addpostctrl">
                    <input type="button" value="<?php _e('Submit Article') ?>" id="submitButton" name="submitButton" onclick="submitForm()">
                </div>
            </div>
        <?php } ?>
        <input type="hidden" value="submit" name="submitButton" />
    </div>
</form>
<?php
    }    
}

$cat = arg($_GET, 'type', false);

if ($cat !== false && is_category_or_sub($cat))
    exit;

get_header();
?>
<script>
    function submitForm() {
        $('#frmaddpost').submit();
    }
</script>
<section id="content" role="main">
    <?php 
    
    if ($cat !== false) {
        addpostbyuser_func($cat);
    } else {
        echo '<h2>' . __('Please choose the category') . '</h2>';
        
        switch (arg($_GET, 'typeslist', '')) {
            case 'test':
                include 'types/main-v4.php';
                break;
            case 'test3':
                include 'types/main-v3.php';
                break;
            default:
                include 'types/main-v4.php';
                //include 'types/main.php';
        }
    }
    
    ?>
</section>
<?php

require_once(dirname(__FILE__) . '/sidebar/index.php');

get_footer();
add_client_to_db('AddNew');
