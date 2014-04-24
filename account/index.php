<?php
require_once(dirname(__FILE__).'/../wp-config.php');

global $wpdb;

function _pu($key, $default = '', $empty = '')
{
    $user_id = get_current_user_id();
    
    if ($user_id == 0 || $user_id == 2) {
        exit;
    } else {
        if (isset($_POST['submitButton'])) {
            update_user_meta($user_id, $key, _p($key, $default, $empty));
        }
        
        $result = get_user_meta($user_id, $key, true);
    }
    return $result;
}

function _pe($id, $default = '', $empty = '')
{
    echo _p($id, $default, $empty);
}

function _p($id, $default = '', $empty = '')
{
    if(isset($_POST["post_$id"])) {
        $value = $_POST["post_$id"];
        if($value == null || $value == '') {
            return $default;
        } else {
            return $value;
        }
    } else {
        return $default;
    }
}

function _p_isset($id)
{
    return isset($_POST["post_$id"]);
}

get_header();
?>

<link rel="stylesheet" type="text/css" href="styles/style.css" />

<section id="content-fullwidth" role="main">

<?php /* <h2><?php _e('Account settings') ?></h2> */ ?>
<?php
    $user_id = get_current_user_id();
    
    if($user_id == 0) { ?>
        <h3><?php _e('Please, login first.') ?></h3>
        <!--<a class="account-login-button account-login-button-login"><?php _e('Log In') ?></a>
        <a class="account-login-button account-login-button-register"><?php _e('Register') ?></a>-->
        <?php
    } else {
        $page = arg($_GET, 'page', 'contacts');
        
        $pages = array(
            'contacts' => __('Contact information'),
            'photos' => __('Gallery'),
            'page' => __('Page settings'),
            'notifications' => __('Notifications'),
        );
        
        echo '<div id="account-tabs">';
        foreach($pages as $name => $title) {
            $active = $name == $page ? 'account-tabs-active' : '';
                
            echo "<a id=\"account-tabs-$name\" class=\"$active\" href=\"?page=$name\">$title</a>";
        }
        echo '</div>';
        
        switch ($page) {
            case 'photos':
                include 'pages/photos.php';
                break;
            
            case 'page':
                include 'pages/page.php';
                break;
            
            case 'notifications':
                include 'pages/notifications.php';
                break;
            
            default: //or case 'contacts'
                include 'pages/contacts.php';
        }
    }
    ?>
</section>
<?php get_footer(); ?>

<?php add_client_to_db('Account'); ?>