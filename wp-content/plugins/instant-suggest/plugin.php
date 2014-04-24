<?php
/*
Plugin Name: Instant Suggest
Plugin URI: http://www.instantsuggest.com/plugins/wordpress-plugin
Description: Suggests SEO content and keywords for your blog instantly: suggest keywords, check spell and autocomplete as you type.
Version: 2.0.1
Author: fuvidu
Author URI: http://www.instantsuggest.com/
License: GPLv2 or later
*/

if(!defined('INSTANTSUGGEST_VERSION')) {
    define('INSTANTSUGGEST_VERSION', '2.0.1');
}

class InstantSuggest {
    public function InstantSuggest() {
        register_activation_hook( __FILE__, array($this, 'upgrade'));
        add_action('admin_print_footer_scripts', array($this, 'loadScripts'), 9999);
        add_action('wp_ajax_instantsuggest_load_options', array($this, 'loadOptions'));
        add_action('wp_ajax_instantsuggest_save_options', array($this, 'saveOptions'));
    }
    
    public function upgrade() {
        $is_options = new stdClass();
        $is_options->version = INSTANTSUGGEST_VERSION;
        update_option('InstantSuggest', $is_options);
    }
    
    public function loadScripts() {
        global $pagenow, $wp_version;
    
        // Only load this for add new or edit post
        if($pagenow != 'post-new.php' && $pagenow != 'post.php') {
            return;
        }

        // Only load if user can edit with rich text editor
        if(!get_user_option('rich_editing')) {
            return;
        }

        $plugin_url = plugins_url('js/' , __FILE__ );
        $ver = urlencode(INSTANTSUGGEST_VERSION);

        echo "<script type='text/javascript' src='{$plugin_url}instantsuggest.js?ver={$ver}'></script>\r\n";
        ?>

        <script type='text/javascript'>
            InstantSuggest.Event.domReady(function() {
                InstantSuggest.Env.platform = '<?php echo "WordPress $wp_version"?>';

                InstantSuggest.Ajax.jsonp({
                    url: ajaxurl,
                    data: {
                        action: 'instantsuggest_load_options',
                        security: '<?php echo wp_create_nonce("instantsuggest-load-options");?>'
                    },
                    success: function(jsonData) {
                        if(typeof jsonData === 'object') {
                            InstantSuggest.PreferenceManager.setAllOptionValues(jsonData);
                        }
                    }
                });

                InstantSuggest.Event.on('saveOptions', function(allOptions) {
                    InstantSuggest.Ajax.jsonp({
                        url: ajaxurl,
                        data: {
                            action: 'instantsuggest_save_options',
                            security: '<?php echo wp_create_nonce("instantsuggest-save-options");?>',
                            options: allOptions
                        }
                    });
                });
            });
        </script>
<?php
    }
    
    public function loadOptions() {
        check_ajax_referer('instantsuggest-load-options', 'security', true);
        $cb = $_GET['callback'];
        $options = get_user_option('instantsuggest_options');
        header('Content-Type: text/javascript; charset=UTF-8');
        if($options) {
            echo "$cb&&$cb(".json_encode($options).");";
        }
        die;
    }

    function saveOptions() {
        check_ajax_referer('instantsuggest-save-options', 'security', true);
        $options = $_REQUEST['options'];
        update_user_option(get_current_user_id(), 'instantsuggest_options', $options);
        header('Content-Type: text/javascript; charset=UTF-8');
        die;
    }
}

new InstantSuggest();
?>