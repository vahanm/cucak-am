<?php
/*
Plugin Name: Quick Flag
Plugin URI: http://www.techytalk.info/wordpress-plugins/quick-flag/
Description: Resolves IP address to ISO 3166-1 alpha-2 two-letter country code and name and displays country flag image if required.
Author: Marko Martinović
Version: 2.11
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

class Quick_Flag{
    const version = '2.10';
    const name = 'Quick Flag';
    const slug = 'quick-flag';
    const safe_slug = 'quick_flag';
    const link = 'http://www.techytalk.info/wordpress-plugins/quick-flag/';
    const donate_link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZQW2VZNHMGGN';
    const faq_link = 'http://wordpress.org/extend/plugins/quick-flag/faq/';
    const support_link = 'http://www.techytalk.info/wordpress-plugins/quick-flag/';
    const changelog_link = 'http://wordpress.org/extend/plugins/quick-flag/changelog/';
    const default_db_version = '6';
    const log_filename = 'quick-flag.log';
    const db_filename = 'ip2country.db';
    const db_dirname = 'database';
    const ip_ranges_table_suffix = 'quick_flag_ip_ranges';
    const countries_table_suffix = 'quick_flag_countries';
    const db_zip_filename = 'ip2country.zip';
    const db_version_filename = 'ip2country.version';
    const http_timeout = 60;
    const remote_offset = 2;

    public $url;
    public $flag_url;
    public $remote_db_url = 'https://github.com/Marko-M/ip-countryside-db/raw/master/ip2country.zip';
    public $remote_ts_url = 'https://raw.github.com/Marko-M/ip-countryside-db/master/ip2country.version';

    protected $path;
    protected $db_version;
    protected $options;
    protected $db_zip_file;
    protected $db_version_file;
    protected $db_file;
    protected $log_file;

    public function __construct() {
        $this->url = WP_PLUGIN_URL . '/' . self::slug;
        $this->flag_url = $this->url . '/img/flags';
        $this->path =  WP_PLUGIN_DIR . '/' . self::slug;
        $this->db_version = get_option(self::safe_slug.'_db_version');
        $this->options = get_option(self::safe_slug.'_options');

        $this->db_zip_file = $this->path . '/' . self::db_dirname . '/' . self::db_zip_filename;
        $this->db_version_file = $this->path . '/' . self::db_dirname . '/' . self::db_version_filename;
        $this->db_file = $this->path . '/' . self::db_dirname . '/' . self::db_filename;
        $this->log_file = $this->path . '/' . self::log_filename;

        add_action('plugins_loaded', array($this, 'update_db_check'));
        add_filter('plugin_row_meta', array($this, 'plugin_meta'), 10, 2);
        add_action('init', array($this, 'text_domain'));

        add_action('admin_init', array($this, 'settings_init'));
        add_action('admin_menu', array($this, 'add_options_page'));

        add_shortcode('quick-flag', array($this, 'shortcode'));

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

    public function custom_schedule($schedules){
        /* Please do not configure cron to interval
         * less than 604800 (7 days) because GitHub might
         * disable our db update repository due to server load
         */
        $schedules[self::safe_slug.'_weekly'] = array(
            'interval'=> 604800,
            'display'=>  __('every week', self::slug)
        );

        return $schedules;
    }

    public function get_info($ip = null){
        global $wpdb;
        $ip_ranges_table_name = $wpdb->prefix . self::ip_ranges_table_suffix;
        $countries_table_name = $wpdb->prefix . self::countries_table_suffix;

        if($ip === null){
            if(isset($_SERVER['HTTP_X_FORWARD_FOR']))
                $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
            else
                $ip = $_SERVER['REMOTE_ADDR'];
        }

        /* ip2long could return signed integer on 32-bit systems.
         * We use sprintf to make sure it is unsigned.
         */
        $sql=   'SELECT
                    "'.self::version.'" as version,
                    "'.$ip.'" as ip,
                    code,
                    name,
                    latitude,
                    longitude
                FROM '.$countries_table_name.'
                INNER JOIN '.$ip_ranges_table_name.'
                    USING(cid)
                WHERE '.sprintf("%u", ip2long($ip)).'
                    BETWEEN fromip AND toip';

        $info = $wpdb->get_row($sql);

        if($info === null)
            return false;

        return $info;
    }

    public function get_flag($info, $css_class = 'quick-flag'){
        $flag = '';
        if($info != null)
            $flag = '<img class="'.$css_class.'" title="'.$info->name.'" src="'.$this->flag_url.'/'.$info->code.'.gif" />';

        return $flag;
    }

    function shortcode($atts, $content = null, $code = '') {
        extract(shortcode_atts(array('ip' => null), $atts ));

        if(($info = $this->get_info($ip)) != false)
            $flag = $info->name.' ('.$this->get_flag($info).')';
        else
            $flag = __('IP address not found inside database.', self::slug);

        return $flag;
    }

    public function options_validate($input) {
        if(isset($input['db_update'])){
            $this->log('Manual update started');

            try{
                $this->update_db_file();
                $this->update_db();
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
            add_settings_error(self::safe_slug.'_db_update', self::safe_slug.'_db_updated', __('Quick Flag database updated.', self::slug), 'updated');
            return $this->options;
        }

        return $input;
    }

    public function do_auto_update(){
        $this->log('Auto update started');

        try{
            $this->update_db_file();
            $this->update_db();
        }catch(Exception $e){
            $this->log('Auto update failed', $e->getCode(), $e->getMessage());
        }

        $this->log('Auto update successful');
    }

    public function install(){
        if(self::safe_slug.'_db_version' < 2){
			global $wpdb;
            $old_table_name = $wpdb->prefix . 'quick_flag';

            $wpdb->query('DROP TABLE IF EXISTS '.$old_table_name.';');
        }

        if(self::safe_slug.'_db_version' < 5){
            $this->options['auto_update'] = '1';
        }

        $this->log('Database installation started');

        try{
            $this->update_db();
        }catch(Exception $e){
            $this->log('Database installation failed', $e->getCode(), $e->getMessage());
        }

        $this->log('Database installation successful');

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
        add_settings_section('database_section', __('Quick Flag database options', self::slug), array($this, 'settings_section_database'), __FILE__);

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
        echo __('Here you can control all Quick Flag database options:', self::slug);
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
        $local_timestamp =  $this->local_timestamp();
        if($local_timestamp !== 0){
            $gmt_offset = get_option('gmt_offset');
            $date_format = get_option('date_format');
            $time_format = get_option('time_format');

            $h_time = date_i18n($date_format.' @ '.$time_format, $local_timestamp + ($gmt_offset  * 3600));

            echo $h_time;
        }else{
            echo  __('Database missing or corrupted, please update', self::slug);
        }
    }

    public function settings_field_db_update(){
        echo '<input id="'.self::safe_slug.'_db_update" name="'.self::safe_slug.'_options[db_update]" class="button-secondary" type="submit" value="'.__('Update', self::slug).'" />';
    }

    public function update_db_file(){
        $remote_timestamp = $this->remote_timestamp();
        $local_timestamp = $this->local_timestamp();

        if($remote_timestamp <= $local_timestamp){
            throw new Exception(__('Quick Flag database already up to date.', self::slug), 1);
        }else{
            $response = wp_remote_get($this->remote_db_url, array('timeout' => self::http_timeout));
            if(is_wp_error($response) || !isset($response['body']) || $response['body'] === ''){
                throw new Exception(__('Couldn\'t fetch Quick Flag database zip file. Fetching remote content not supported or remote server is down.', self::slug), 2);
            } else {
                $new_db_zip = $response['body'];

                require_once(ABSPATH . 'wp-admin/includes/file.php');
                WP_Filesystem();
                global $wp_filesystem;

                if (!$wp_filesystem->put_contents($this->db_zip_file, $new_db_zip, FS_CHMOD_FILE)) {
                    throw new Exception(__('Couldn\'t write Quick Flag database zip file to local file system. Please check permissions.', self::slug), 3);
                }

                if (!unzip_file($this->db_zip_file, dirname($this->db_zip_file))) {
                    throw new Exception(__('Couldn\'t unzip Quick Flag database zip file to local file system. Please check permissions and your server unzip capabilities.', self::slug), 4);
                }

                unlink($this->db_zip_file);

                if (!$wp_filesystem->put_contents($this->db_version_file, $this->parse_timestamp($remote_timestamp), FS_CHMOD_FILE)) {
                    throw new Exception(__('Couldn\'t write Quick Flag database version file to local file system. Please check permissions.', self::slug), 5);
                }
            }
        }
    }

    protected function update_db(){
        if(!file_exists($this->db_file)){
            try{
                $this->update_db_file();
            }catch(Exception $e){}
        }

        /* To protect update server deschedule all cron jobs on plugin update
         * to make sure that everyone's cron job is at the default db update
         * interval (in case someone has modified cron job interval manually)
         */
        $this->deschedule_update();

        global $wpdb;
        $ip_ranges_table_name = $wpdb->prefix . self::ip_ranges_table_suffix;
        $countries_table_name = $wpdb->prefix . self::countries_table_suffix;
        $wpdb->query('DROP TABLE IF EXISTS '.$ip_ranges_table_name.';');
        $wpdb->query('DROP TABLE IF EXISTS '.$countries_table_name.';');

        $sql_countries = 'CREATE TABLE '.$countries_table_name.' (
        cid INT(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        code CHAR(2) NOT NULL,
        name VARCHAR(150) NOT NULL,
        latitude FLOAT NOT NULL,
        longitude FLOAT NOT NULL) ENGINE=MyISAM DEFAULT CHARACTER SET utf8, COLLATE utf8_general_ci;';

        $sql_ip_ranges = 'CREATE TABLE '.$ip_ranges_table_name.' (
        id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        fromip INT(10) UNSIGNED NOT NULL,
        toip INT(10) UNSIGNED NOT NULL,
        cid INT(4) UNSIGNED NOT NULL,
        INDEX (fromip ASC, toip ASC, cid ASC)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8, COLLATE utf8_general_ci;';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_countries);
        dbDelta($sql_ip_ranges);

        require_once(dirname(__FILE__) . '/iso-3166-2.php');

        $sql = '';
        foreach($country_data as $code => $code_data){
            $sql .= '('.$code_data['cid'].', "'.$code.'", "'.$code_data['name'].'", '.$code_data['latitude'].', '.$code_data['longitude'].'), ';
        }
        $wpdb->query('INSERT INTO '.$countries_table_name.' (cid, code, name, latitude, longitude) VALUES '.substr($sql, 0, -2));

        $limit_no_insert = 1000;
        $counter = 0;
        $sql = '';
        if (($input = fopen($this->db_file, 'r')) !== false) {
            while (($file_data = fgetcsv($input, 1000, ' ')) !== false) {
                if(isset($country_data[$file_data[2]])){
                    $counter++;
                    $sql .= '('.$file_data[0].', '.$file_data[1].', '.$country_data[$file_data[2]]['cid'].'), ';

                    if($counter == $limit_no_insert){
                        $wpdb->query('INSERT INTO '.$ip_ranges_table_name.' (fromip, toip, cid) VALUES '.substr($sql,0,-2));
                        $counter = 0;
                        $sql = '';
                    }
                }
            }
            $wpdb->query('INSERT INTO '.$ip_ranges_table_name.' (fromip, toip, cid) VALUES '.substr($sql,0,-2));
            fclose($input);
        }else{
            throw new Exception(__('Couldn\'t read Quick Flag database file from local file system. Please check permissions.', self::slug), 6);
        }
    }

    protected function remote_timestamp(){
        $response = wp_remote_get($this->remote_ts_url, array('timeout' => self::http_timeout));
        if(!is_wp_error($response) || isset($response['body']) || $response['body'] !== '0000-00-00-00-00-00'){
            $timestamp = $this->parse_time($response['body']);
            if(is_integer($timestamp)){
                return $timestamp;
            }
        }
        throw new Exception(__('Remote Quick Flag database version not readable.', self::slug), 7);
    }

    protected function local_timestamp(){
        $local_timestamp = 0;
        if(is_file($this->db_version_file) && is_readable($this->db_version_file)){
            $time_string = file_get_contents($this->db_version_file);
            if($time_string !== false){
                $local_timestamp = $this->parse_time($time_string);
                if(is_integer($local_timestamp)){
                    $local_timestamp = $this->parse_time($time_string);
                }
            }
        }

        return $local_timestamp;
    }

    protected function parse_time($time_string){
        $explode = explode('-', $time_string);
        $timestamp_gmt =
        gmmktime(
            intval($explode[3]) - self::remote_offset,
            intval($explode[4]),
            intval($explode[5]),
            intval($explode[1]),
            intval($explode[2]),
            intval($explode[0])
        );

        return $timestamp_gmt;
    }

    protected function parse_timestamp($timestamp){
        // Remote is in CEST(GMT/UTC+2)
        $date_gmt = date('Y-m-d-H-i-s', $timestamp + (self::remote_offset * 3600));
        return $date_gmt;
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
global $quick_flag;
$quick_flag = new Quick_Flag();

require_once(dirname(__FILE__) . '/deprecated.php');
?>
