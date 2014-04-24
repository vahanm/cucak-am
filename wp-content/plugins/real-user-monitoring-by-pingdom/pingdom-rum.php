<?php
/*
Plugin Name: Pingdom Real User Monitoring
Plugin URI: https://www.pingdom.com/rum
Description: A very simple and easy plugin that adds your Pingdom Real User Monitoring JavaScript code to the <head> tag of your WordPress blog. When activated you must <a href="plugins.php?page=pingdom-rum-config">enter your Pingdom Real User Monitoring site ID</a> under the Plugins menu for it to work. If you don’t already have an account, get one at <a href="https://www.pingdom.com/rum">pingdom.com</a>.
Author: Pingdom AB
Version: 1.0
Author URI: https://www.pingdom.com/
*/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
    exit;
}

// For backwards compatibility, esc_attr_e was added in 2.8 and attribute_escape is from 2.8 marked as deprecated.
if (!function_exists('esc_attr_e')) {
    function esc_attr_e( $text ) {
        return attribute_escape( $text );
    }
}

// The html code that goes in to the header
function add_PingdomRUM_header() {
    $code = get_option('pingdom_rum_code');
    
    if(!is_admin() && strlen($code) > 0) {
?>

<script>
var _prum = [['id', '<?php echo $code; ?>'],
             ['mark', 'firstbyte', (new Date()).getTime()]];
(function() {
    var s = document.getElementsByTagName('script')[0]
      , p = document.createElement('script');
    p.async = 'async';
    p.src = '//rum-static.pingdom.net/prum.min.js';
    s.parentNode.insertBefore(p, s);
})();
</script>

<?php
    }
}

// Prints the admin menu where it is possible to add the tracking code
function print_PingdomRUM_management() {
    if (isset($_POST['submit'])) {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to manage options for this blog.'));
        }

        $code = trim($_POST['pingdom_rum_code']);
        $cache = get_option('pingdom_rum_code');
    
        if (empty($code)) {
            delete_option('pingdom_rum_code');
        } else {
            if ($cache != $code) {
                update_option('pingdom_rum_code', $code);
            }
        }

        // Clear WP-Super Cache on POST
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }

?>
<div id="message" class="updated fade"><p><strong><?php esc_attr_e('Options saved.'); ?></strong></p></div>
<?php
    }
wp_enqueue_style("pingdom-rum", plugin_dir_url("/", __FILE__) . trim(dirname(plugin_basename(__FILE__)), '/') . "/pingdom.css");
?>
<div class="wrap">
    <img src="<?php echo plugin_dir_url("/", __FILE__) . trim(dirname(plugin_basename(__FILE__)), '/'); ?>/img-pingdom-logo.png" alt="Pingdom logo" />
    <h2><?php esc_attr_e('Real User Monitoring', 'pingdom-rum'); ?></h2>
    <p><?php _e('Please enter your Pingdom Real User Monitoring Site ID. If you do not yet have an account, go get one at <a href="https://www.pingdom.com/signup/">Pingdom.com</a>!', 'pingdom-rum'); ?></p>
    <p><?php _e('To get your ID, login at <a href="https://my.pingdom.com/">My Pingdom</a>, go to "RUM" and edit or create your check. In the JavaScript code, look for something like this:', 'pingdom-rum'); ?></p>
    <p><code>var _prum = [['id', '1a2b3c4e5f6a7b8c9d0e1f2a'],</code></p>
    <p><?php _e('In this example the <strong>Site ID</strong> is:', 'pingdom-rum'); ?></p>
    <p><code>1a2b3c4e5f6a7b8c9d0e1f2a</code></p>

    <form method="post" action="" class="pingdom-form">
        <h3><?php esc_attr_e('Your Real User Monitoring Site ID', 'pingdom-rum'); ?></h3>
        <input name="pingdom_rum_code" type="text" id="pingdom_rum_code" value="<?php echo get_option('pingdom_rum_code'); ?>" class="pingdom-input" maxlength="24" placeholder="e.g. 1a2b3c4e5f6a7b8c9d0e1f2a" />
        <input type="submit" name="submit" class="pingdom-button" value="<?php esc_attr_e('Save Changes') ?>" />
        <p class="pingdom-description"><?php esc_attr_e('Leave empty to remove', 'pingdom-rum'); ?></span>
    </form>

</div>
<?php
}

function add_PingdomRUM_admin_page() 
{
    if ( function_exists('add_submenu_page') ) {
        add_submenu_page('plugins.php', __('Pingdom Real User Monitoring', 'pingdom-rum'), __('Pingdom Real User Monitoring'), 'manage_options', 'pingdom-rum-config', 'print_PingdomRUM_management');
    }
}

function add_PingdomRUM_action_links( $links ) 
{
    return array_merge(array('settings' => '<a href="' . get_bloginfo( 'wpurl') . '/wp-admin/plugins.php?page=pingdom-rum-config">Settings</a>'), $links);
}

add_action('wp_head', 'add_PingdomRUM_header');

if(is_admin()) {
    load_plugin_textdomain('pingdom-rum', 'wp-content/plugins/' . dirname(plugin_basename(__FILE__)) . '/i18n');
    add_action('admin_menu', 'add_PingdomRUM_admin_page');
    add_filter('plugin_action_links_' . plugin_basename( __FILE__ ), 'add_PingdomRUM_action_links');
}
?>
