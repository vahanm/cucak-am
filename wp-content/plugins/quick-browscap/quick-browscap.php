<?php
/*
Plugin Name: Quick Browscap
Plugin URI: http://www.techytalk.info/wordpress-plugins/quick-browscap/
Description: Quickly get browser capabilities from built in browser capabilities database
Author: Marko Martinović
Version: 1.03
Author URI: http://www.techytalk.info
License: GPL2

Copyright 2012.  Marko Martinović  (email : marko AT techytalk.info)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Quick_Browscap{
    const version = '1.02';
    const name = 'Quick Browscap';
    const slug = 'quick-browscap';
    const safe_slug = 'quick_browscap';
    const link = 'http://www.techytalk.info/wordpress-plugins/quick-browscap/';
    const donate_link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZQW2VZNHMGGN';
    const faq_link = 'http://wordpress.org/extend/plugins/quick-browscap/faq/';
    const support_link = 'http://www.techytalk.info/wordpress-plugins/quick-browscap/';
    const changelog_link = 'http://wordpress.org/extend/plugins/quick-browscap/changelog/';
    const log_filename = 'debug.log';
    const default_db_version = '2';
    const regex_delimiter = '@';
    const regex_modifiers = 'i';
    const values_to_quote = 'Browser|Parent';
    const order_func_args = '$a, $b';
    const order_func_logic = '$a=strlen($a);$b=strlen($b);return$a==$b?0:($a<$b?1:-1);';
    const http_timeout = 60;
    const cache_filename = 'cache.php';
    const ini_filename = 'php_browscap.ini';
    const cache_dirname = 'database';
    const ini_dirname = 'database';

    public $remote_ini_url = 'http://browsers.garykeith.com/stream.asp?BrowsCapINI';
    public $remote_ver_url = 'http://browsers.garykeith.com/versions/version-number.asp';

    protected $url;
    protected $path;
    protected $db_version;
    protected $options;
    protected $log_file;
    protected $ini_file;
    protected $cache_file;
    protected $cache_loaded = false;
    protected $user_agents = array();
    protected $browsers = array();
    protected $patterns = array();
    protected $properties = array();

    public function __construct() {
        $this->url = WP_PLUGIN_URL . '/' . self::slug;
        $this->path =  WP_PLUGIN_DIR . '/' . self::slug;
        $this->db_version = get_option(self::safe_slug.'_db_version');
        $this->options = get_option(self::safe_slug.'_options');

        $this->cache_file = $this->path . '/' . self::cache_dirname . '/' . self::cache_filename;
        $this->ini_file = $this->path . '/' . self::ini_dirname . '/' . self::ini_filename;
        $this->log_file = $this->path . '/' . self::log_filename;

        add_action('plugins_loaded', array($this, 'update_db_check'));
        add_filter('plugin_row_meta', array($this, 'plugin_meta'), 10, 2);
        add_action('init', array($this, 'text_domain'));

        add_action('admin_init', array($this, 'settings_init'));
        add_action('admin_menu', array($this, 'add_options_page'));

        if(isset($this->options['auto_update'])){
            add_action(self::safe_slug.'_update', array($this, 'do_auto_update'));
            add_filter('cron_schedules', array($this, 'custom_schedule'));
            register_deactivation_hook(__FILE__, array($this, 'deschedule_update'));

            $this->schedule_update();
        }else{
            $this->deschedule_update();
        }
    }

    public function schedule_update(){
        if(!wp_next_scheduled(self::safe_slug.'_update')){
            wp_schedule_event(time(), self::safe_slug.'_weekly', self::safe_slug.'_update');

            $this->log('Auto update scheduled');
        }
    }

    public function deschedule_update(){
        if(wp_next_scheduled(self::safe_slug.'_update')){
            wp_clear_scheduled_hook(self::safe_slug.'_update');

            $this->log('Auto update descheduled');
        }
    }

    function custom_schedule($schedules){
        $schedules[self::safe_slug.'_weekly'] = array(
            'interval'=> 604800,
            'display'=>  __('every week', self::slug)
        );

        return $schedules;
    }

    public function getBrowser($user_agent = null, $return_array = false){
        _deprecated_function(__FUNCTION__, '1.02', '$quick_browscap->get_browser()');

        return $this->get_browser($user_agent, $return_array);
    }

    public function get_browser($user_agent = null, $return_array = false){
        if (!$this->cache_loaded) {

            if (!file_exists($this->cache_file)){
                try{
                    $this->update_cache();
                }catch(Exception $e){
                    return array();
                }
            }

            $this->load_cache();
        }

        if (!isset($user_agent)) {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $user_agent = '';
            }
        }

        $browser = array();
        foreach ($this->patterns as $key => $pattern) {
            if (preg_match($pattern . 'i', $user_agent)) {
                $browser = array(
                    $user_agent,
                    trim(strtolower($pattern), self::regex_delimiter),
                    $this->user_agents[$key]
                );

                $browser = $value = $browser + $this->browsers[$key];

                while (array_key_exists(3, $value) && $value[3]) {
                    $value = $this->browsers[$value[3]];
                    $browser += $value;
                }

                if (!empty($browser[3])) {
                    $browser[3] = $this->user_agents[$browser[3]];
                }

                break;
            }
        }

        $array = array();
        foreach ($browser as $key => $value) {
            if ($value === 'true') {
                $value = true;
            } elseif ($value === 'false') {
                $value = false;
            }
            $array[$this->properties[$key]] = $value;
        }

        return $return_array ? $array : (object) $array;
    }

    public function options_validate($input) {
        if(isset($input['db_update'])){
            $this->log('Manual update started');

            try{
                $this->update_ini();
                $this->update_cache();
            }catch(Exception $e){
                if($e->getCode() === 1){
                    add_settings_error(self::safe_slug.'_db_update', self::safe_slug.'_db_updated', $e->getMessage(), 'updated');
                }else{
                    add_settings_error(self::safe_slug.'_db_update', self::safe_slug.'_db_update_failed', $e->getMessage());
                }

                $this->log('Manual update failed', $e->getCode(), $e->getMessage());
                return $this->options;
            }

            $this->log('Manual update successful');
            add_settings_error(self::safe_slug.'_db_update', self::safe_slug.'_db_updated', __('Browser capabilities database updated.', self::slug), 'updated');
            return $this->options;
        }

        return $input;
    }

    public function do_auto_update(){
        $this->log('Auto update started');

        try{
            $this->update_ini();
            $this->update_cache();
        }catch(Exception $e){
            $this->log('Auto update failed', $e->getCode(), $e->getMessage());
        }

        $this->log('Auto update successful');
    }

    public function install(){
        if(self::safe_slug.'_db_version' < 2){
            $this->options['auto_update'] = '1';
        }

        update_option(self::safe_slug.'_options', $this->options);
        update_option(self::safe_slug.'_db_version', self::default_db_version);
    }

    public function update_db_check() {
        if ($this->db_version != self::default_db_version) {
            $this->install();
        }
    }

    public function text_domain(){
        load_plugin_textdomain(self::slug, false, dirname(plugin_basename( __FILE__ )) . '/languages/');
    }

    public function plugin_meta($links, $file) {
        $plugin = plugin_basename(__FILE__);
        if ($file == $plugin) {
            return array_merge(
                $links,
                array( '<a href="'.self::donate_link.'">'.__('Donate', self::slug).'</a>' )
            );
        }
        return $links;
    }

    public function add_options_page(){
        add_options_page(self::name, self::name, 'manage_options', __FILE__, array($this, 'options_page'));
        add_filter('plugin_action_links', array($this, 'action_links'), 10, 2);
    }

    public function action_links($links, $file){
        if ($file == plugin_basename(__FILE__)) {
            $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/admin.php?page='.self::slug.'/'.self::slug.'.php">'.__('Settings', self::slug).'</a>';
            $links[] = $settings_link;
        }

        return $links;
    }

    public function options_page(){
    ?>
        <div class="wrap">
            <div class="icon32" id="icon-options-general"><br></div>
            <h2><?php echo self::name ?></h2>
            <form action="options.php" method="post">
            <?php settings_fields(self::safe_slug.'_options'); ?>
            <?php do_settings_sections(__FILE__); ?>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
            </p>
            </form>
        </div>
    <?php
    }

    public function settings_init(){
        register_setting(self::safe_slug.'_options', self::safe_slug.'_options', array($this, 'options_validate'));

        add_settings_section('donate_section', __('Donating or getting help', self::slug), array($this, 'settings_section_donate'), __FILE__);
        add_settings_section('general_section', __('General options', self::slug), array($this, 'settings_section_general'), __FILE__);
        add_settings_section('database_section', __('Browser capabilities database options', self::slug), array($this, 'settings_section_database'), __FILE__);

        add_settings_field(self::safe_slug.'_debug_mode', __('Debug mode (enable only when debugging):', self::slug), array($this, 'settings_field_debug_mode'), __FILE__, 'general_section');
        add_settings_field(self::safe_slug.'_auto_update', __('Enable automatic weekly database update check:', self::slug), array($this, 'settings_field_auto_update'), __FILE__, 'database_section');

        add_settings_field(self::safe_slug.'_db_status', __('Current database status:', self::slug), array($this, 'settings_field_db_status'), __FILE__, 'database_section');
        add_settings_field(self::safe_slug.'_db_update', '', array($this, 'settings_field_db_update'), __FILE__, 'database_section');

        add_settings_field(self::safe_slug.'_paypal', __('Donate using PayPal (sincere thank you for your help):', self::slug), array($this, 'settings_field_paypal'), __FILE__, 'donate_section');
        add_settings_field(self::safe_slug.'_version', sprintf(__('%s version:', self::slug), self::name), array($this, 'settings_field_version'), __FILE__, 'donate_section');
        add_settings_field(self::safe_slug.'_faq', sprintf(__('%s FAQ:', self::slug), self::name), array($this, 'settings_field_faq'), __FILE__, 'donate_section');
        add_settings_field(self::safe_slug.'_changelog', sprintf(__('%s changelog:', self::slug), self::name), array($this, 'settings_field_changelog'), __FILE__, 'donate_section');
        add_settings_field(self::safe_slug.'_support_page', sprintf(__('%s support page:', self::slug), self::name), array($this, 'settings_field_support_page'), __FILE__, 'donate_section');
    }

    public function settings_section_donate(){
        echo '<p>';
        echo sprintf(__('If you find %s useful you can donate to help it\'s development. Also you can get help with %s:', self::slug), self::name, self::name);
        echo '</p>';
    }

    public function settings_section_general(){
        echo '<p>';
        echo __('Here you can control all general options:', self::slug);
        echo '</p>';
    }

    public function settings_section_database(){
        echo '<p>';
        echo __('Here you can control all browser capabilities database options:', self::slug);
        echo '</p>';
    }

    public function settings_field_faq(){
        echo '<a href="'.self::faq_link.'" target="_blank">'.__('FAQ', self::slug).'</a>';
    }

    public function settings_field_version(){
        echo self::version;
    }

    public function settings_field_changelog(){
        echo '<a href="'.self::changelog_link.'" target="_blank">'.__('Changelog', self::slug).'</a>';
    }

    public function settings_field_support_page(){
        echo '<a href="'.self::support_link.'" target="_blank">'.sprintf(__('%s at TechyTalk.info', self::slug), self::name).'</a>';
    }

    public function settings_field_paypal(){
        echo '<a href="'.self::donate_link.'" target="_blank"><img src="'.$this->url.'/img/paypal.gif" /></a>';
    }

    public function settings_field_debug_mode(){
        echo '<input id="'.self::safe_slug.'_debug_mode" name="'.self::safe_slug.'_options[debug_mode]" type="checkbox" value="1" ';
        if(isset($this->options['debug_mode'])) echo 'checked="checked"';
        echo '/>';
    }

    public function settings_field_auto_update(){
        echo '<input id="'.self::safe_slug.'_auto_update" name="'.self::safe_slug.'_options[auto_update]" type="checkbox" value="1" ';
        if(isset($this->options['auto_update'])) echo 'checked="checked"';
        echo '/>';
    }

    public function settings_field_db_status(){
        if(file_exists($this->ini_file)){
            $gmt_offset = get_option('gmt_offset');
            $date_format = get_option('date_format');
            $time_format = get_option('time_format');

            $local_version = $this->local_version();
            $local_timestamp =  $this->local_timestamp() + ($gmt_offset  * 3600);

            $h_time = date_i18n($date_format.' @ '.$time_format, $local_timestamp);

            echo sprintf(__('Version %s (%s)', self::slug), $local_version, $h_time);
        }else{
            echo  __('Database missing, please update', self::slug);
        }
    }

    public function settings_field_db_update(){
        echo '<input id="'.self::safe_slug.'_db_update" name="'.self::safe_slug.'_options[db_update]" class="button-secondary" type="submit" value="'.__('Update', self::slug).'" />';
    }

    public function update_ini(){
        $remote_version = $this->remote_version();
        $local_version = $this->local_version();

        if($remote_version <= $local_version){
            throw new Exception(__('Browser capabilities database already up to date.', self::slug), 1);
        }else{
            $response = wp_remote_get($this->remote_ini_url, array('timeout' => self::http_timeout));
            if(is_wp_error($response) || !isset($response['body']) || $response['body'] === ''){
                throw new Exception(__('Couldn\'t fetch browser capabilities database. Fetching remote content not supported or remote server is down.', self::slug), 2);
            } else {
                // Fix Windows new lines to Unix new lines
                $response['body'] = str_replace("\r\n", "\n", $response['body']);

                // Loose the heading with database version info
                $response['body'] = explode("\n\n", $response['body']);
                array_shift($response['body']);
                $response['body'] = implode("\n\n", $response['body']);

                // Quote self::values_to_quote
                $response['body'] = explode("\n", $response['body']);

                $pattern = self::regex_delimiter
                         . '('
                         . self::values_to_quote
                         . ')="?([^"]*)"?$'
                         . self::regex_delimiter;

                $new_ini_file = '';
                foreach ($response['body'] as $subject) {
                    $subject = trim($subject);
                    $new_ini_file .= preg_replace($pattern, '$1="$2"', $subject) . "\n";
                }

                // Write file
                require_once(ABSPATH . 'wp-admin/includes/file.php');

                WP_Filesystem();
                global $wp_filesystem;
                if (!$wp_filesystem->put_contents($this->ini_file, $new_ini_file, FS_CHMOD_FILE) ) {
                    throw new Exception(__('Couldn\'t update local browser capabilities database. Please check permissions.', self::slug), 3);
                }
            }
        }
    }

    protected function update_cache(){
        if(!file_exists($this->ini_file)){
            try{
                $this->update_ini();
            }catch(Exception $e){}
        }

        $browsers = $this->parse_ini();

        array_shift($browsers);

        $this->properties = array_keys($browsers['DefaultProperties']);
        array_unshift(
            $this->properties,
            'browser_name',
            'browser_name_regex',
            'browser_name_pattern',
            'Parent'
        );

        $this->user_agents = array_keys($browsers);
        usort(
            $this->user_agents,
            create_function(self::order_func_args, self::order_func_logic)
        );

        $user_agents_keys = array_flip($this->user_agents);
        $properties_keys = array_flip($this->properties);

        $search = array('\*', '\?');
        $replace = array('.*', '.');

        foreach ($this->user_agents as $user_agent) {
            $pattern = preg_quote($user_agent, self::regex_delimiter);
            $this->patterns[] = self::regex_delimiter
                            . '^'
                            . str_replace($search, $replace, $pattern)
                            . '$'
                            . self::regex_delimiter;

            if (!empty($browsers[$user_agent]['Parent'])) {
                $parent = $browsers[$user_agent]['Parent'];
                $browsers[$user_agent]['Parent'] = $user_agents_keys[$parent];
            }

            foreach ($browsers[$user_agent] as $key => $value) {
                $key = $properties_keys[$key] . ".0";
                $browser[$key] = $value;
            }

            $this->browsers[] = $browser;
            unset($browser);
        }
        unset($user_agents_keys, $properties_keys, $browsers);

        $cache = $this->build_cache();

        require_once(ABSPATH . 'wp-admin/includes/file.php');

        WP_Filesystem();
        global $wp_filesystem;

        if (!$wp_filesystem->put_contents($this->cache_file, $cache, FS_CHMOD_FILE) ) {
            throw new Exception(__('Couldn\'t update local browser capabilities database cache file. Please check permissions.', self::slug), 4);
        }
    }

    protected function remote_version(){
        $response = wp_remote_get($this->remote_ver_url, array('timeout' => self::http_timeout));
        if(is_wp_error($response) || !isset($response['body']) || $response['body'] === ''){
            throw new Exception(__('Remote browser capabilities database version not readable.', self::slug), 5);
        } else {
            $remote_version = intval($response['body']);
        }

        return $remote_version;
    }

    protected function local_timestamp(){
        $browsers = $this->parse_ini();

        if(empty($browsers)){
            $local_timestamp = 0;
        }else{
            $local_timestamp = strtotime($browsers['GJK_Browscap_Version']['Released']);
        }

        return $local_timestamp;
    }

    protected function local_version(){
        $browsers = $this->parse_ini();

        if(empty($browsers)){
            $local_version = 0;
        }else{
            $local_version = intval($browsers['GJK_Browscap_Version']['Version']);
        }

        return $local_version;
    }

    protected function parse_ini(){
        $browsers = array();

        if(file_exists($this->ini_file)){
            if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
                $browsers = parse_ini_file($this->ini_file, true, INI_SCANNER_RAW);
            } else {
                $browsers = parse_ini_file($this->ini_file, true);
            }
        }

        return $browsers;
    }

    protected function load_cache(){
        require $this->cache_file;

        $this->browsers = $browsers;
        $this->user_agents = $userAgents;
        $this->patterns = $patterns;
        $this->properties = $properties;

        $this->cache_loaded = true;
    }

    protected function build_cache(){
        $cacheTpl = "<?php\n\$properties=%s;\n\$browsers=%s;\n\$userAgents=%s;\n\$patterns=%s;\n";

        $propertiesArray = $this->array_to_string($this->properties);
        $patternsArray = $this->array_to_string($this->patterns);
        $userAgentsArray = $this->array_to_string($this->user_agents);
        $browsersArray = $this->array_to_string($this->browsers);

        return sprintf(
            $cacheTpl,
            $propertiesArray,
            $browsersArray,
            $userAgentsArray,
            $patternsArray
        );
    }

    protected function array_to_string($array){
        $strings = array();

        foreach ($array as $key => $value) {
            if (is_int($key)) {
                $key = '';
            } elseif (ctype_digit((string) $key) || strpos($key, '.0')) {
                $key = intval($key) . '=>' ;
            } else {
                $key = "'" . str_replace("'", "\'", $key) . "'=>" ;
            }

            if (is_array($value)) {
                $value = $this->array_to_string($value);
            } elseif (ctype_digit((string) $value)) {
                $value = intval($value);
            } else {
                $value = "'" . str_replace("'", "\'", $value) . "'";
            }

            $strings[] = $key . $value;
        }

        return 'array(' . implode(',', $strings) . ')';
    }

    protected function log($title, $code = null, $message = null){
        if(isset($this->options['debug_mode']) || (defined('WP_DEBUG') && WP_DEBUG)){
            $log_file_append = '['.gmdate('D, d M Y H:i:s \G\M\T').'] ' . $title;

            if($code !== null){
               $log_file_append .= ', code: ' . $code;
            }

            if($message !== null){
               $log_file_append .= ', message: ' . $message;
            }
            file_put_contents($this->log_file, $log_file_append . "\n", FILE_APPEND);
        }
    }
}
global $quick_browscap;
$quick_browscap = new Quick_Browscap();
?>
