<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;
get_header();

?>
<script type="text/javascript">

var registredSubdomains = [
    //Registred names
    <?php
        global $registredSubdomains;
        foreach ($registredSubdomains as $key => $value)
            echo '\'' . $key . '\', ';
    ?>
    //System reserved names
    'admin', 'test', 'debug', 'help', 'faq', 'support', 'info', 'administrator' 
];

$(document).ready(function () {
    $('#contactAddress').keyup(validateAddress);
    $('#contactAddress').change(validateAddress);
});

function validateAddress() {
    $('#address-available').removeClass('unavailable available');
    var name = $(this).val().trim();
    if (name.length == 0) {
        $('#address-available').text('<?php _e('Please enter') ?>');
    } else {
        if (name.length < 3 || name.length > 16 || $.inArray(name, registredSubdomains) > -1 || !validAddress.test(name)) {
            $('#address-available').text('<?php _e('Unavailable') ?>');
            $('#address-available').addClass('unavailable');
        } else {
            $('#address-available').text('<?php _e('Available') ?>');
            $('#address-available').addClass('available');
        }
    }
}
</script>
<script type="text/javascript" src="script.js?1.1" ></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<section id="content" role="main">
    <?php 
    
    switch (WPLANG)
    {
        case 'am_HY':
            include 'am.php.htm';
            break;
            
        case 'ru_RU':
            include 'ru.php.htm';
            break;
            
        case 'en_EN':
        default:
            include 'en.php.htm';
    }
    
    $user_id = get_current_user_id();
    if ($user_id == 0) 
    {
        $user_id = 2;
    }
    else
    {
        $user_info = get_userdata($user_id);
        
        $user_display_name = $user_info->display_name;
        $user_first_name = $user_info->first_name;
        $user_last_name = $user_info->last_name;
        $user_nickname = $user_info->nickname;
        
        $user_email = $user_info->user_email;
    }
    ?>
    
    <div class="sendMailForm">
        <input type="hidden" id="contactId" value="<?php echo $user_id ?>" />
        <div>
            <div class="label"><?php _e('Name') . _e('<span style="color: red;">*</span>') ?></div>
            <input class="input defaultText" type="text" id="contactName" defalutvalue="<?php _e('Please enter your name.') ?>" <?php if ($user_display_name != '' && $user_id != 2) { echo 'readonly="readonly"'; } ?> value="<?php if($user_display_name != '' && $user_id != 2) { echo $user_display_name; } ?>">
            <div class="errorHint" id="errorName"><?php _e('Please enter your name.') ?></div>
        </div>
        <div>
            <div class="label"><?php _e('E-Mail') . _e('<span style="color: red;">*</span>') ?></div>
            <input class="input defaultText" type="text" id="contactEmail" defalutvalue="<?php _e('Please enter your E-Mail address.') ?>" <?php if ($user_email != '' && $user_id != 2) { echo 'readonly="readonly"'; } ?> value="<?php if($user_email != '' && $user_id != 2) { echo $user_email; } ?>" />
            <div class="errorHint" id="errorEmail"><?php _e('Please enter your E-Mail address.') ?></div>
        </div>
        <div>
            <div class="label"><?php _e('Desired address') . _e('<span style="color: red;">*</span>') ?></div>
            <input class="input defaultText" type="text" id="contactAddress" defalutvalue="<?php _e('Enter your desired address.') ?>" />
            <div id="address-part">.cucak.am</div>
            <div id="address-available"><?php _e('Please enter') ?></div>
            <div class="errorHint" id="errorAddress"><?php _e('Please enter your desired address.') ?></div>
        </div>
        <div>
            <div class="label"><?php _e('Message')  ?></div>
            <textarea class="input defaultText" id="contactText" rows="15" defalutvalue="<?php _e('Please enter Your message.') ?>"></textarea>
            <div class="errorHint" id="errorText"><?php _e('Please enter Your message.') ?></div>
        </div>
        <div class="controls">
            <div class="errorHint" id="errorSent"><?php _e('Your request was successfully sent.') ?></div>
            <div class="errorHint" id="errorNotSent"><?php _e('Sorry, Your request was not sent, please try later.') ?></div>
            <div class="errorHint" id="errorServer"><?php _e('Sorry, server is not responding. Your request might be sent, please try later.') ?></div>
            <input type="button" value="<?php _e('Send request') ?>" id="sendButton" />
        </div>
    </div>
    
    <?php comments_template( '', true ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php add_client_to_db('Private'); ?>