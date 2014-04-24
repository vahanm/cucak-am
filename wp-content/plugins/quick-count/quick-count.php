<?php
/*
Plugin Name: Quick Count
Plugin URI: http://www.techytalk.info/wordpress-plugins/quick-count/
Description: Ajax WordPress plugin that informs you and your users about how many people is currently browsing your site.
Author: Marko Martinović
Version: 3.00
Author URI: http://www.techytalk.info
License: GPL2

Copyright 2012  Marko Martinović  (email : marko AT techytalk.info)

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

class Quick_Count{
    const version = '3.00';
    const jqvmap_version = '1.0';
    const jquery_ui_version = '1.9.2';
    const jquery_ui_timepicker_version = '1.1.1';
    const link = 'http://www.techytalk.info/wordpress-plugins/quick-count/';
    const donate_link = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CZQW2VZNHMGGN';
    const support_link = 'http://www.techytalk.info/wordpress-plugins/quick-count/';
    const faq_link = 'http://wordpress.org/extend/plugins/quick-count/faq/';
    const changelog_link = 'http://wordpress.org/extend/plugins/quick-count/changelog/';
    const quick_flag_link = 'http://www.techytalk.info/wordpress-plugins/quick-flag/';
    const quick_browscap_link = 'http://www.techytalk.info/wordpress-plugins/quick-browscap/';

    const quick_flag_version_minimum = '2.00';
    const quick_browscap_version_minimum = '1.00';
    const default_timeout_refresh_users = '180';
    const default_db_version = '9';

    protected $url;
    protected $path;
    protected $basename;
    protected $db_version;
    protected $options;
    protected $log_file;

    public function __construct() {
        $this->url = plugin_dir_url(__FILE__);
        $this->path =  plugin_dir_path(__FILE__);
        $this->basename = plugin_basename(__FILE__);
        $this->log_file = $this->path . '/' . 'quick-count' . '.log';
        $this->db_version = get_option('quick_count_db_version');
        $this->options = get_option('quick_count_options');

        add_action('init', array($this, 'text_domain'));
        add_action('plugins_loaded', array($this, 'update_db_check'));
        add_filter('plugin_row_meta', array($this, 'plugin_meta'), 10, 2);

        add_action('admin_init', array($this, 'settings_init'));
        add_action('admin_menu', array($this, 'add_options_page'));

        add_action('wp_print_styles', array($this, 'styles'));
        add_action('admin_print_styles', array($this, 'admin_styles'));

        add_action('wp_enqueue_scripts',  array($this, 'frontend_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'backend_scripts'));

        add_action('admin_notices', array($this, 'quick_flag_version_notice'));
        add_action('admin_init', array($this, 'quick_flag_version_notice_dismiss'));

        add_action('admin_notices', array($this, 'quick_browscap_version_notice'));
        add_action('admin_init', array($this, 'quick_browscap_version_notice_dismiss'));

        add_shortcode('quick-count', array($this, 'shortcode'));

        add_action('widgets_init', array($this, 'load_widgets'));

        add_action('admin_menu', array($this, 'add_admin_menu'));

        add_action('wp_dashboard_setup', array($this, 'dashboard_widgets'));

        add_action('wp_ajax_nopriv_quick-count-keepalive', array($this, 'report_ajax'));
        add_action('wp_ajax_quick-count-keepalive', array($this, 'report_ajax'));

        add_action('wp_ajax_nopriv_quick-count-frontend', array($this, 'report_get_ajax'));
        add_action('wp_ajax_quick-count-frontend', array($this, 'report_get_ajax'));

        add_action('wp_ajax_nopriv_quick-count-backend', array($this, 'get_ajax'));
        add_action('wp_ajax_quick-count-backend', array($this, 'get_ajax'));

        register_activation_hook(__FILE__, array($this, 'clear_cache'));
        register_deactivation_hook(__FILE__, array($this, 'clear_cache'));
    }

    public function add_admin_menu () {
        add_menu_page('Quick Count', 'Quick Count', 'manage_options', 'quick-count', array($this, 'right_now_html'));
        add_submenu_page('quick-count', __('Right Now', 'quick-count'), __('Right Now', 'quick-count'), 'manage_options', 'quick-count', array($this, 'right_now_html'));
        add_submenu_page('quick-count', __('Visitors Log', 'quick-count'), __('Visitors Log', 'quick-count'), 'manage_options', 'quick-count-visitors-log', array($this, 'visitors_log_html'));

        if($this->quick_flag_capable() != false){
            add_submenu_page('quick-count', __('Visitors Country', 'quick-count'), __('Visitors Country', 'quick-count'), 'manage_options', 'quick-count-visitors-country', array($this, 'visitors_country_html'));
        }

//        if($this->quick_browscap_capable() != false){
//            add_submenu_page('quick-count', __('Visitors System', 'quick-count'), __('Visitors System', 'quick-count'), 'manage_options', 'quick-count-visitors-system', array($this, 'visitors_system_html'));
//            add_submenu_page('quick-count', __('Visitors Browser', 'quick-count'), __('Vosistors Browser', 'quick-count'), 'manage_options', 'quick-count-visitors-browser', array($this, 'visitors_browser_html'));
//        }
    }

    public function quick_count_filter_html($start_timestamp, $end_timestamp, $gmt_offset){
        ?>
        <form method="get" action="">
            <?php
            // If they are set, preserve 'page' $_GET variable after form submision
            if(isset($_GET['page'])): ?>
                <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>" />
            <?php endif; ?>
            <table id="quick-count-filter">
                <tr>
                    <td class="quick-count-filter-label">
                        <label for="quick-count-filter-start"><?php _e('Start:', 'quick-count') ?></label>
                    </td>
                    <td class="quick-count-filter-input">
                        <input style="width: 13em;" type="text" id="quick-count-filter-start" name="quick-count-filter-start" value="<?php echo date('Y/m/d H:i:s', $start_timestamp + $gmt_offset ) ?>" readonly="readonly" />
                    </td>
                    <td class="quick-count-filter-label">
                        <label for="quick-count-filter-end"><?php _e('End:', 'quick-count') ?></label>
                    </td>
                    <td class="quick-count-filter-input">
                        <input style="width: 13em;" type="text" id="quick-count-filter-end" name="quick-count-filter-end" value="<?php echo date('Y/m/d H:i:s', $end_timestamp + $gmt_offset ) ?>" readonly="readonly" />
                    </td>
                    <td class="quick-count-filter-input">
                        <input type="submit" value="<?php _e('Filter', 'quick-count'); ?>" class="button-secondary" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }

    public function right_now_html() {
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-users"><br></div>
        <h2><?php echo __('Right Now', 'quick-count'); ?></h2>
        <?php echo $this->show(1,0,1,1,0,1,'quick-count-shortcode',1); ?>
    </div>
    <?php
    }

    public function visitors_log_html() {
        $gmt_offset_h = get_option('gmt_offset');
        $start_timestamp = gmmktime(-$gmt_offset_h, 0, 0, gmdate('m'), 1, gmdate('Y'));
        $end_timestamp = time();

        $gmt_offset = $gmt_offset_h * 3600;

        if(isset($_GET['quick-count-filter-start'])){
            $maybe_start_timestamp = strtotime(trim($_GET['quick-count-filter-start']));
            if($maybe_start_timestamp !== false){
                $start_timestamp = $maybe_start_timestamp - $gmt_offset;
            }
        }

        if(isset($_GET['quick-count-filter-end'])){
            $maybe_end_timestamp = strtotime(trim($_GET['quick-count-filter-end']));
            if($maybe_end_timestamp !== false){
                $end_timestamp = $maybe_end_timestamp - $gmt_offset;
            }
        }

        $list_table = new Quick_Count_List_Table();
        $list_table->prepare_items($start_timestamp, $end_timestamp);

        ?>
        <div class="wrap">
            <div class="icon32" id="icon-users"><br></div>
            <h2><?php echo __('Visitors Log', 'quick-count'); ?></h2>
            <?php $this->quick_count_filter_html($start_timestamp, $end_timestamp, $gmt_offset) ?>

            <form id="quick-count-visitors-log" method="get">
                <?php if(isset($_GET['page'])): ?>
                    <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>" />
                <?php endif; ?>
                <?php $list_table->display() ?>
            </form>
        </div>
        <?php
    }

    public function visitors_country_html() {
        $gmt_offset_h = get_option('gmt_offset');
        $start_timestamp = gmmktime(-$gmt_offset_h, 0, 0, gmdate('m'), 1, gmdate('Y'));
        $end_timestamp = time();

        $gmt_offset = $gmt_offset_h * 3600;

        if(isset($_GET['quick-count-filter-start'])){
            $maybe_start_timestamp = strtotime(trim($_GET['quick-count-filter-start']));
            if($maybe_start_timestamp !== false){
                $start_timestamp = $maybe_start_timestamp - $gmt_offset;
            }
        }

        if(isset($_GET['quick-count-filter-end'])){
            $maybe_end_timestamp = strtotime(trim($_GET['quick-count-filter-end']));
            if($maybe_end_timestamp !== false){
                $end_timestamp = $maybe_end_timestamp - $gmt_offset;
            }
        }

        $visitors_cc = $this->get_visitors_cc($start_timestamp, $end_timestamp);
        $cdata = array();
        $num_users = 0;
        foreach ($visitors_cc as $cc){
            $cdata[$cc['ccode']] = $cc['ccode_count'];
            $num_users = $num_users + $cc['ccode_count'];
        }

        $num_countries = count($cdata);
        ?>
        <div class="wrap">
            <div class="icon32" id="icon-users"><br></div>
            <h2><?php echo __('Visitors Country', 'quick-count'); ?></h2>
            <?php $this->quick_count_filter_html($start_timestamp, $end_timestamp, $gmt_offset) ?>

            <div class="quick-count quick-count-shortcode">
                <div class="quick-count-visitors-country">
                    <?php
                        printf(_n('%d user', '%d users', $num_users, 'quick-count'), $num_users);
                        printf(' %s ', __('from', 'quick-count'));
                        printf(_n('%d country', '%d countries', $num_countries, 'quick-count'), $num_countries);
                        ?>
                        <div class="quick-count-visitors-map"></div>
                        <?php
                    ?>
                </div>
            </div>
        </div>
        <?php

        global $quick_flag;
        $script_suffix = (isset($this->options['debug_mode']) || (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)) ? '.dev' : '';
        $script_vars = array(
            'cdata' => $cdata,
            'qfc' => 1,
            'quick_flag_url' => $quick_flag->flag_url
        );

        wp_enqueue_script('jquery');
        wp_enqueue_script('quick-count-jquery-vmap', ($this->url.'js/jquery.vmap'.$script_suffix.'.js'), array('jquery'), self::jqvmap_version, true);
        wp_enqueue_script('quick-count-jquery-vmap-map', ($this->url.'js/jquery.vmap.world.js'), array('jquery', 'quick-count-jquery-vmap'), false, true);
        wp_enqueue_script('quick-count-quick-flag', ($this->url.'js/quick-count-quick-flag'.$script_suffix.'.js'), array('jquery', 'quick-count-jquery-vmap', 'quick-count-jquery-vmap-map'), self::version, true);
        wp_enqueue_script('quick-count-visitors-country', ($this->url.'js/quick-count-visitors-country'.$script_suffix.'.js'), array('jquery', 'quick-count-jquery-vmap', 'quick-count-jquery-vmap-map', 'quick-count-quick-flag'), self::version, true);
        wp_localize_script('quick-count-visitors-country', 'quick_count_visitors_country', $script_vars);
    }

    public function get_visitors($start_timestamp = 0, $end_timestamp = 2147483647, $orderby = 'joined', $order = 'DESC', $start = 0, $offset = '18446744073709551615'){
        global $wpdb;

        $wpdb->flush();

        $select = array(
            'id',
            'status',
            'polled',
            'joined',
            'ip',
            'name',
            'agent',
            'title',
            'url',
            'referer',
            'online'
        );

        if($this->quick_flag_capable()){
            $select[] = 'ccode as cc';
            $select[] = 'cname as cn';
        }else{
            $select[] = 'NULL as cc';
            $select[] = 'NULL as cn';
        }

        if($this->quick_browscap_capable()){
            $select[] = 'bname';
            $select[] = 'bversion';
            $select[] = 'pname';
            $select[] = 'pversion';
        }else{
            $select[] = 'NULL as bname';
            $select[] = 'NULL as bversion';
            $select[] = 'NULL as pname';
            $select[] = 'NULL as pversion';
        }

        $sql_select = implode(', ', $select);

        $sql_from = $wpdb->prefix . 'quick_count_users';

        $sql_where = 'joined >= "'.gmdate('Y-m-d H:i:s', $start_timestamp).'" AND joined <= "'.gmdate('Y-m-d H:i:s', $end_timestamp).'"';

        $sql_end = 'ORDER BY '.$orderby.' '.$order.' LIMIT '.$start.', '.$offset.';';

        $query = array(
            'SELECT',
            $sql_select,
            'FROM',
            $sql_from);


        $query[] = 'WHERE';
        $query[] = $sql_where;

        $query[] = $sql_end;
        $sql = implode(' ', $query);

        $data = $wpdb->get_results($sql, ARRAY_A);

        $wpdb->flush();

        return $data;
    }

    public function get_visitors_count($start_timestamp = 0, $end_timestamp = 2147483647){
        global $wpdb;

        $wpdb->flush();

        $sql_select = 'COUNT(*)';

        $sql_from = $wpdb->prefix . 'quick_count_users';

        $sql_where = 'joined >= "'.gmdate('Y-m-d H:i:s', $start_timestamp).'" AND joined <= "'.gmdate('Y-m-d H:i:s', $end_timestamp).'"';

        $query = array(
            'SELECT',
            $sql_select,
            'FROM',
            $sql_from);

        $query[] = 'WHERE';
        $query[] = $sql_where;

        $sql = implode(' ', $query);

        $count = $wpdb->get_var($sql);

        $wpdb->flush();

        return $count;
    }

    public function get_visitors_cc($start_timestamp = 0, $end_timestamp = 2147483647){
        global $wpdb;

        $wpdb->flush();

        $select = array('ccode', 'COUNT(ccode) AS ccode_count');

        $sql_select = implode(', ', $select);

        $sql_from = $wpdb->prefix . 'quick_count_users';

        $sql_where = 'joined >= "'.gmdate('Y-m-d H:i:s', $start_timestamp).'" AND joined <= "'.gmdate('Y-m-d H:i:s', $end_timestamp).'"';

        $query = array(
            'SELECT',
            $sql_select,
            'FROM',
            $sql_from);

        $query[] = 'WHERE';
        $query[] = $sql_where;

        // Group by ccode and since ccode can be NULL avoid grouping with NULL using HAVING
        $query[] = 'GROUP BY ccode HAVING ccode_count > 0';

        $sql = implode(' ', $query);

        $data = $wpdb->get_results($sql, ARRAY_A);

        $wpdb->flush();

        return $data;
    }

    public function del_stats($ids){
        global $wpdb;
        $table_name = $wpdb->prefix . 'quick_count_users';

        if(is_array($ids))
            $ids = implode(',', $ids);

        if (!empty($ids)){
            $wpdb->query('DELETE FROM '.$table_name.' WHERE id IN('.$ids.')');
        }
    }

    public function show($online_count = 1, $count_each = 1, $most_count = 1, $user_list = 1, $by_country = 1, $visitors_map = 1, $css_class = null, $hide_link_home = 0){
        ob_start();

        if($css_class == null)
           $css_class = 'quick-count-shortcode';

        echo '<div class="quick-count '.$css_class.'">';
            echo '<div class="quick-count-loading">'.__('LOADING...', 'quick-count').'</div>';

            if($online_count == 1)
                echo '<div class="quick-count-online-count"></div>';

            if($count_each == 1)
                echo '<div class="quick-count-online-count-each"></div>';

            if($most_count == 1)
                echo '<div class="quick-count-most-online"></div>';

            if($visitors_map ==1)
                echo '<div class="quick-count-visitors-map"></div>';

            if($by_country == 1){
                echo '<div class="quick-count-by-country"></div>';
            }

            if($user_list == 1)
                echo '<div class="quick-count-list"></div>';

        echo '</div>';

        if(!isset($this->options['hide_linkhome']) && $hide_link_home == 0){
            echo '<a class="quick-count-linkhome" href="'.self::link.'" target="_blank">'.  sprintf(__('Powered by %s', 'quick-count'), 'Quick Count').'</a>';
        }

        $content =  ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function report_ajax(){
        $response = $this->report();

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit;
    }

    public function get_ajax(){
        $response = $this->get();

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit;
    }

    public function report_get_ajax(){
        $this->report();

        $response = $this->get();

        header( "Content-Type: application/json" );
        echo json_encode($response);
        exit;
    }

    public function frontend_scripts(){
        $script_suffix = (isset($this->options['debug_mode']) || (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)) ? '.dev' : '';

        wp_enqueue_script('jquery');
        wp_enqueue_script('quick-count-load-frontend', ($this->url.'js/quick-count-load-frontend'.$script_suffix.'.js'), array('jquery'), self::version, true);
        wp_localize_script('quick-count-load-frontend', 'quick_count', $this->script_vars($script_suffix));
    }

    function backend_scripts($hook) {
        if($hook == 'index.php' ||
            $hook == 'toplevel_page_quick-count' ||
            $hook == 'quick-count_page_quick-count-visitors-log' ||
            $hook == 'quick-count_page_quick-count-visitors-country'){

            $script_suffix = (isset($this->options['debug_mode']) || (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)) ? '.dev' : '';
            wp_enqueue_script('jquery');

            if($hook == 'index.php' || $hook == 'toplevel_page_quick-count'){
                wp_enqueue_script('quick-count-load-backend', ($this->url.'js/quick-count-load-backend'.$script_suffix.'.js'), array('jquery'), self::version, true);
                wp_localize_script('quick-count-load-backend', 'quick_count', $this->script_vars($script_suffix));
            }else if (
                // Timepicker filter
                $hook == 'quick-count_page_quick-count-visitors-log'
                    ||
                $hook == 'quick-count_page_quick-count-visitors-country'
            ) {
                // jQuery UI script
                if (file_exists($this->path . 'js/jquery-ui/jquery-ui'.$script_suffix.'.js')) {
                    wp_enqueue_script('quick_count_jquery_ui', $this->url. 'js/jquery-ui/jquery-ui'.$script_suffix.'.js', array('jquery'), self::jquery_ui_version, true);
                }

                // jQuery UI timepicker script
                if (file_exists($this->path . 'js/jquery-ui/jquery-ui-timepicker'.$script_suffix.'.js')) {
                    wp_enqueue_script('quick_count_jquery_ui_timepicker', $this->url. 'js/jquery-ui/jquery-ui-timepicker'.$script_suffix.'.js', array('jquery', 'quick_count_jquery_ui'), self::jquery_ui_timepicker_version, true);
                }

                // Timepicker script
                if (file_exists($this->path . 'js/quick-count-timepicker'.$script_suffix.'.js')) {
                    wp_enqueue_script('quick_count_timepicker', $this->url. 'js/quick-count-timepicker'.$script_suffix.'.js', array('jquery', 'quick_count_jquery_ui', 'quick_count_jquery_ui_timepicker'), self::version, true);
                    wp_localize_script('quick_count_timepicker', 'quick_count', array(
                        'i18n' => array(
                            // Datepicker
                            'closeText' => __('Done', 'quick-count'),
                            'prevText' => __('Prev', 'quick-count'),
                            'nextText' => __('Next', 'quick-count'),
                            'currentText' => __('Today', 'quick-count'),
                            'monthNames' =>
                                array(
                                    __('January', 'quick-count'),
                                    __('February', 'quick-count'),
                                    __('March', 'quick-count'),
                                    __('April', 'quick-count'),
                                    __('May', 'quick-count'),
                                    __('June', 'quick-count'),
                                    __('July', 'quick-count'),
                                    __('August', 'quick-count'),
                                    __('September', 'quick-count'),
                                    __('October', 'quick-count'),
                                    __('November', 'quick-count'),
                                    __('December', 'quick-count'),
                                ),
                            'monthNamesShort' =>
                                array(
                                    __('Jan', 'quick-count'),
                                    __('Feb', 'quick-count'),
                                    __('Mar', 'quick-count'),
                                    __('Apr', 'quick-count'),
                                    __('May', 'quick-count'),
                                    __('Jun', 'quick-count'),
                                    __('Jul', 'quick-count'),
                                    __('Aug', 'quick-count'),
                                    __('Sep', 'quick-count'),
                                    __('Oct', 'quick-count'),
                                    __('Nov', 'quick-count'),
                                    __('Dec', 'quick-count'),
                                ),
                            'dayNames' =>
                            array(
                                __('Sunday', 'quick-count'),
                                __('Monday', 'quick-count'),
                                __('Tuesday', 'quick-count'),
                                __('Wednesday', 'quick-count'),
                                __('Thursday', 'quick-count'),
                                __('Friday', 'quick-count'),
                                __('Saturday', 'quick-count'),
                            ),
                            'dayNamesShort' =>
                                array(
                                    __('Sun', 'quick-count'),
                                    __('Mon', 'quick-count'),
                                    __('Tue', 'quick-count'),
                                    __('Wed', 'quick-count'),
                                    __('Thu', 'quick-count'),
                                    __('Fri', 'quick-count'),
                                    __('Sat', 'quick-count'),
                                ),
                            'dayNamesMin' =>
                                array(
                                    __('Su', 'quick-count'),
                                    __('Mo', 'quick-count'),
                                    __('Tu', 'quick-count'),
                                    __('We', 'quick-count'),
                                    __('Th', 'quick-count'),
                                    __('Fr', 'quick-count'),
                                    __('Sa', 'quick-count'),
                                ),
                            'weekHeader' => __('Wk', 'quick-count'),
                            'dateFormat' => __('mm/dd/yy', 'quick-count'),

                            // Timepicker
                            'currentText' => __('Now', 'quick-count'),
                            'closeText' => __('Done', 'quick-count'),
                            'amNames' =>
                                array(
                                    __('AM', 'quick-count'),
                                    __('A', 'quick-count')
                                ),
                            'pmNames' =>
                                array(
                                    __('PM', 'quick-count'),
                                    __('P', 'quick-count')
                                ),
                            'timeFormat' => __('HH:mm', 'quick-count'),
                            'timeOnlyTitle' => __('Choose Time', 'quick-count'),
                            'timeText' => __('Time', 'quick-count'),
                            'hourText' => __('Hour', 'quick-count'),
                            'minuteText' => __('Minute', 'quick-count'),
                            'secondText' => __('Second', 'quick-count'),
                            'millisecText' => __('Millisecond', 'quick-count'),
                            'timezoneText' => __('Time Zone', 'quick-count'),
                        )
                    ));
                }
            }
        }
    }

    public function styles($dep = array()) {
        global $wp_styles;

        if (file_exists($this->path . 'css/quick-count.css')){
            wp_enqueue_style('quick_count_style', $this->url.'css/quick-count.css', $dep);
        }

        if (file_exists($this->path . 'css/quick-count-ie7.css')) {
            wp_enqueue_style('quick_count_ie7_style_sheet', $this->url.'css/quick-count-ie7.css', array('quick_count_style'));
            $wp_styles->add_data('quick_count_ie7_style_sheet', 'conditional', 'lt IE 8');
        }

        if (file_exists($this->path . 'css/quick-count-ie8.css')) {
            wp_enqueue_style('quick_count_ie8_style_sheet', $this->url.'css/quick-count-ie8.css', array('quick_count_style'));
            $wp_styles->add_data('quick_count_ie8_style_sheet', 'conditional', 'lt IE 9');
        }

        if (file_exists(get_stylesheet_directory_uri().'/quick-count.css')){
            wp_enqueue_style('quick_count_style_theme_style', get_stylesheet_directory() . '/quick-count.css', array('quick_count_style', 'quick_count_ie7_style_sheet', 'quick_count_ie8_style_sheet'));
        }
    }

    public function admin_styles() {
        global $current_screen;

        $jquery_ui_dep = array();

        if(
            $current_screen->base == 'quick-count_page_quick-count-visitors-log'
                ||
            $current_screen->base == 'quick-count_page_quick-count-visitors-country'
        ){
            // jQuery UI style
            if (file_exists($this->path . 'css/jquery-ui/smoothness/jquery-ui.css')) {
                wp_enqueue_style('quick_count_jquery_ui', $this->url .'css/jquery-ui/smoothness/jquery-ui.css', $jquery_ui_dep, self::jquery_ui_version);
                $jquery_ui_dep[] = 'quick_count_jquery_ui';
            }

            // jQuery UI timepicker style
            if (file_exists($this->path . 'css/jquery-ui/jquery-ui-timepicker.css')) {
                wp_enqueue_style('quick_count_jquery_ui_timepicker', $this->url .'css/jquery-ui/jquery-ui-timepicker.css', $jquery_ui_dep, self::jquery_ui_timepicker_version);
                $jquery_ui_dep[] = 'quick_count_jquery_ui_timepicker';
            }
        }

        $this->styles($jquery_ui_dep);
    }

    public function options_validate($input){
        global $wp_version;
        $validation_errors = array();

        if(!is_numeric($input['timeout_refresh_users']) || ($input['timeout_refresh_users'] < 1)){
            $input['timeout_refresh_users'] = $this->options['timeout_refresh_users'];
            $validation_errors[] =
                array(  'setting' => 'quick_count_timeout_refresh_users',
                        'code' => 'quick_count_timeout_refresh_users_error',
                        'title' => __('Interval for refreshing list of online users (seconds):', 'quick-count'),
                        'message' => __('Must be positive integer.', 'quick-count'));
        } else{
            $input['timeout_refresh_users'] = floor($input['timeout_refresh_users']);
        }

        if(!empty($validation_errors) && version_compare($wp_version, '3.0', '>=')){
            foreach ($validation_errors as $error) {
                add_settings_error($error['setting'], $error['code'], $error['title'].' '.$error['message']);
            }
        }

        $this->clear_cache();

        return $input;
    }


    public function install(){
        global $wpdb;

        $user_stats = get_option('quick_count_user_stats');
        $users_table_name = $wpdb->prefix . 'quick_count_users';

        if($this->db_version < 9){
            // Nuke the old database for 3.00 version
            $wpdb->query('DROP TABLE IF EXISTS '.$users_table_name.';');
        }

        $users_table_exists = ($wpdb->get_var('SHOW TABLES LIKE \''.$users_table_name.'\';') == $users_table_name) ? 1: 0;

        if($users_table_exists == 0) {
            $sql_users = 'CREATE TABLE '.$users_table_name.' (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            status TINYINT(1) NOT NULL,
            polled DATETIME NOT NULL,
            joined DATETIME NOT NULL,
            ip VARCHAR(39) NOT NULL,
            name VARCHAR(60) NOT NULL,
            agent TEXT NOT NULL,
            title TEXT NOT NULL,
            url TEXT NOT NULL,
            referer TEXT NOT NULL,
            ccode CHAR(2) NULL,
            cname VARCHAR(150) NULL,
            bname VARCHAR(250) NULL,
            bversion VARCHAR(150) NULL,
            pname VARCHAR(250) NULL,
            pversion VARCHAR(150) NULL,
            online TINYINT(1) NOT NULL,
            INDEX (polled ASC),
            UNIQUE KEY roomname (ip, name)) ENGINE=MyISAM DEFAULT CHARACTER SET utf8, COLLATE utf8_general_ci;';

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql_users);

        } else{
            // Future updates
        }

        if($this->db_version < 1){
            if(!isset($this->options['timeout_refresh_users'])){
                $this->options['timeout_refresh_users'] = self::default_timeout_refresh_users;
            }
        }

        if($this->db_version < 2){
            if($user_stats != false) {
                $user_stats = array('n' => $user_stats['number'], 't' => $user_stats['timestamp']);
            }
        }

        if($this->db_version < 5){
            $widget_options = get_option('widget_quick-count-widget');
            if(isset($widget_options) && is_array($widget_options)){
                foreach($widget_options as &$option){
                    if (is_array($option) && !empty($option)){
                        $option['visitors_map'] = NULL;
                    }
                }
                update_option('widget_quick-count-widget', $widget_options);
            }
        }

        if($user_stats == false){
            $user_stats = array('n' => 0, 't' => time());
        }

        update_option('quick_count_user_stats', $user_stats);
        update_option('quick_count_options', $this->options);
        update_option('quick_count_db_version', self::default_db_version);
    }

    public function update_db_check() {
        if ($this->db_version != self::default_db_version) {
            $this->install();
        }
    }

    public function text_domain(){
        load_plugin_textdomain('quick-count', false, dirname($this->basename) . '/languages/');
    }

    public function plugin_meta($links, $file) {
        if ($file == $this->basename) {
            return array_merge(
                $links,
                array( '<a href="'.self::donate_link.'">'.__('Donate', 'quick-count').'</a>' )
            );
        }
        return $links;
    }

    public function add_options_page(){
        add_options_page('Quick Count', 'Quick Count', 'manage_options', __FILE__, array($this, 'options_page'));
        add_filter('plugin_action_links', array($this, 'action_links'), 10, 2);
    }

    public function action_links($links, $file){
        if ($file == $this->basename) {
            $settings_link = '<a href="' . get_admin_url(null, 'admin.php?page='.$this->basename) . '">'.__('Settings', 'quick-count').'</a>';
            $links[] = $settings_link;
        }

        return $links;
    }

    public function options_page(){
    ?>
        <div class="wrap">
            <div class="icon32" id="icon-options-general"><br></div>
            <h2><?php echo 'Quick Count' ?></h2>
            <form action="options.php" method="post">
            <?php settings_fields('quick_count_options'); ?>
            <?php do_settings_sections(__FILE__); ?>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
            </p>
            </form>
        </div>
    <?php
    }

    public function settings_init(){
        register_setting('quick_count_options', 'quick_count_options', array($this, 'options_validate'));

        add_settings_section('donate_section', __('Donating or getting help', 'quick-count'), array($this, 'settings_section_donate'), __FILE__);
        add_settings_section('general_section', __('General options', 'quick-count'), array($this, 'settings_section_general'), __FILE__);
        add_settings_section('appearance_section', __('Appearance options','quick-count'), array($this, 'settings_section_appearance'), __FILE__);

        add_settings_field('quick_count_debug_mode', __('Debug mode (enable only when debugging):', 'quick-count'), array($this, 'settings_field_debug_mode'), __FILE__, 'general_section');
        add_settings_field('quick_count_timeout_refresh_users', __('Timeout for refreshing list of online users (seconds):', 'quick-count'),  array($this, 'settings_field_timeout_refresh_users'), __FILE__, 'general_section');

        add_settings_field('quick_count_paypal', __('Donate using PayPal (sincere thank you for your help):', 'quick-count'), array($this, 'settings_field_paypal'), __FILE__, 'donate_section');
        add_settings_field('quick_count_version', sprintf(__('%s version:', 'quick-count'), 'Quick Count'), array($this, 'settings_field_version'), __FILE__, 'donate_section');
        add_settings_field('quick_count_faq', sprintf(__('%s FAQ:', 'quick-count'), 'Quick Count'), array($this, 'settings_field_faq'), __FILE__, 'donate_section');
        add_settings_field('quick_count_changelog', sprintf(__('%s changelog:', 'quick-count'), 'Quick Count'), array($this, 'settings_field_changelog'), __FILE__, 'donate_section');
        add_settings_field('quick_count_support_page', sprintf(__('%s support page:', 'quick-count'), 'Quick Count'), array($this, 'settings_field_support_page'), __FILE__, 'donate_section');

        add_settings_field('quick_count_disable_quick_flag', sprintf(__('Disable Quick Flag integration (to hide country flags on visitors list) | %s:', 'quick-count'), '<a href="'.self::quick_flag_link.'" target="_blank">'.__('More', 'quick-count').'</a>'), array($this, 'settings_field_disable_quick_flag'), __FILE__, 'appearance_section');
        add_settings_field('quick_count_disable_quick_browscap', sprintf(__('Disable Quick Browscap integration (to hide user friendly browser and operating system details on visitors list) | %s:', 'quick-count'), '<a href="'.self::quick_browscap_link.'" target="_blank">'.__('More', 'quick-count').'</a>'), array($this, 'settings_field_disable_quick_browscap'), __FILE__, 'appearance_section');
        add_settings_field('quick_count_hide_linkhome', sprintf(__('Hide "Powered by %s" link:', 'quick-count'), 'Quick Count'), array($this, 'settings_field_hide_linkhome'), __FILE__, 'appearance_section');
    }

    public function settings_section_donate(){
        echo '<p>';
        echo sprintf(__('If you find %s useful you can donate to help it\'s development. Also you can get help with %s:', 'quick-count'), 'Quick Count', 'Quick Count');
        echo '</p>';
    }

    public function settings_section_general(){
        echo '<p>';
        echo __('Here you can control all general options:', 'quick-count');
        echo '</p>';
    }

    public function settings_section_appearance() {
        echo '<p>';
        echo __('Here you can control all appearance options:','quick-count');
        echo '</p>';
    }

    public function settings_field_faq(){
        echo '<a href="'.self::faq_link.'" target="_blank">'.__('FAQ', 'quick-count').'</a>';
    }

    public function settings_field_version(){
        echo self::version;
    }

    public function settings_field_changelog(){
        echo '<a href="'.self::changelog_link.'" target="_blank">'.__('Changelog', 'quick-count').'</a>';
    }

    public function settings_field_support_page(){
        echo '<a href="'.self::support_link.'" target="_blank">'.sprintf(__('%s at TechyTalk.info', 'quick-count'), 'Quick Count').'</a>';
    }

    public function settings_field_paypal(){
        echo '<a href="'.self::donate_link.'" target="_blank"><img src="'.$this->url.'img/paypal.gif" /></a>';
    }

    public function settings_field_debug_mode(){
        echo '<input id="quick_count_debug_mode" name="quick_count_options[debug_mode]" type="checkbox" value="1" ';
        if(isset($this->options['debug_mode'])) echo 'checked="checked"';
        echo '/>';
    }

    public function settings_field_disable_quick_flag() {
        echo '<input id="quick_count_disable_quick_flag" name="quick_count_options[disable_quick_flag]" type="checkbox" value="1" ';
        if(isset($this->options['disable_quick_flag'])) echo 'checked="checked"';
        echo '/>';
    }

    public function settings_field_disable_quick_browscap() {
        echo '<input id="quick_count_disable_quick_browscap" name="quick_count_options[disable_quick_browscap]" type="checkbox" value="1" ';
        if(isset($this->options['disable_quick_browscap'])) echo 'checked="checked"';
        echo '/>';
    }

    public function settings_field_hide_linkhome() {
        echo '<input id="quick_count_hide_linkhome" name="quick_count_options[hide_linkhome]" type="checkbox" value="1" ';
        if(isset($this->options['hide_linkhome'])) echo 'checked="checked"';
        echo '/>';
    }

    function settings_field_timeout_refresh_users() {
        echo '<input id="quick_count_timeout_refresh_users" name="quick_count_options[timeout_refresh_users]" size="10" type="text" value="'.  $this->options['timeout_refresh_users'].'" />';
    }

    public function quick_flag_version_notice() {
        global $current_screen;

        if (    $this->quick_flag_capable() == false
                    &&
                current_user_can('manage_options')
                    &&
                (
                    $current_screen->base == 'settings_page_quick-count/quick-count'
                        ||
                    $current_screen->base == 'toplevel_page_quick-count'
                        ||
                    $current_screen->base == 'quick-count_page_quick-count-visitors-log'
                        ||
                    $current_screen->base == 'quick-count_page_quick-count-visitors-country'
                )
            ) {
            global $current_user ;
            $user_id = $current_user->ID;

            if (!get_user_meta($user_id, 'quick_count_quick_flag_notice_dismiss')){
                echo '<div class="updated"><p>';
                printf(__('For many features like visitors map and country flags on visitors list %s requires free WordPress plugin Quick Flag version %s or later installed, activated and Quick Flag support in Quick Count settings not disabled | %s | %s', 'quick-count'),
                        'Quick Count',
                        self::quick_flag_version_minimum,
                        '<a href="'.self::quick_flag_link.'" target="_blank">'.__('More', 'quick-count').'</a>',
                        '<a href="'.esc_url(add_query_arg('quick_count_quick_flag_notice_dismiss', '0', $this->current_admin_url())).'">'.__('Dismiss', 'quick-count').'</a>');
                echo "</p></div>";
            }
        }
    }

    public function quick_browscap_version_notice() {
        global $current_screen;

        if (    $this->quick_browscap_capable() == false
                    &&
                current_user_can('manage_options')
                    &&
                (
                    $current_screen->base == 'settings_page_quick-count/quick-count'
                        ||
                    $current_screen->base == 'toplevel_page_quick-count'
                        ||
                    $current_screen->base == 'quick-count_page_quick-count-visitors-log'
                        ||
                    $current_screen->base == 'quick-count_page_quick-count-visitors-country'
                )
            ) {
            global $current_user ;
            $user_id = $current_user->ID;

            if (!get_user_meta($user_id, 'quick_count_quick_browscap_notice_dismiss')){
                echo '<div class="updated"><p>';
                printf(__('For displaying browser and operating system details on visitors list %s requires free WordPress plugin Quick Browscap version %s or later installed, activated and Quick Browscap support in Quick Count settings not disabled | %s | %s', 'quick-count'),
                        'Quick Count',
                        self::quick_browscap_version_minimum,
                        '<a href="'.self::quick_browscap_link.'" target="_blank">'.__('More', 'quick-count').'</a>',
                        '<a href="'.esc_url(add_query_arg('quick_count_quick_browscap_notice_dismiss', '0', $this->current_admin_url())).'">'.__('Dismiss', 'quick-count').'</a>');
                echo "</p></div>";
            }
        }
    }

    public function country_info($ip){
        if(isset($_COOKIE['quick_flag_info'])){
            $info = unserialize(stripslashes($_COOKIE['quick_flag_info']));
            if($info == FALSE || $info->ip == $ip)
                return $info;
        }

        global $quick_flag;
        $info = $quick_flag->get_info($ip);
        setcookie('quick_flag_info', serialize($info), 0, COOKIEPATH, COOKIE_DOMAIN, false, true);

        return $info;
    }

    public function browser_info($agent){
        if(isset($_COOKIE['quick_browscap_info'])){
            $info = unserialize(stripslashes($_COOKIE['quick_browscap_info']));
            if($info == array() || $info->browser_name != $agent)
                return $info;
        }

        global $quick_browscap;
        $info = $quick_browscap->get_browser($agent);
        setcookie('quick_browscap_info', serialize($info), 0, COOKIEPATH, COOKIE_DOMAIN, false, true);

        return $info;
    }

    public function quick_flag_capable(){
        global $quick_flag;

        if(!isset($quick_flag) || !is_object($quick_flag) || (Quick_Flag::version < self::quick_flag_version_minimum) || isset($this->options['disable_quick_flag']))
            return false;

        return true;
    }

    public function quick_browscap_capable(){
        global $quick_browscap;

        if(!isset($quick_browscap) || !is_object($quick_browscap) || (Quick_Browscap::version < self::quick_browscap_version_minimum) || isset($this->options['disable_quick_browscap']))
            return false;

        return true;
    }

    public function quick_flag_version_notice_dismiss() {
        if(current_user_can('manage_options')){
            global $current_user;
            $user_id = $current_user->ID;

            if (isset($_GET['quick_count_quick_flag_notice_dismiss']) && '0' == $_GET['quick_count_quick_flag_notice_dismiss'] ) {
                add_user_meta($user_id, 'quick_count_quick_flag_notice_dismiss', 'true', true);
            }
        }
    }

    public function quick_browscap_version_notice_dismiss() {
        if(current_user_can('manage_options')){
            global $current_user;
            $user_id = $current_user->ID;

            if (isset($_GET['quick_count_quick_browscap_notice_dismiss']) && '0' == $_GET['quick_count_quick_browscap_notice_dismiss'] ) {
                add_user_meta($user_id, 'quick_count_quick_browscap_notice_dismiss', 'true', true);
            }
        }
    }

    public function clear_cache(){
        if (function_exists('wp_cache_clear_cache')){
            $GLOBALS["super_cache_enabled"]=1;
            wp_cache_clear_cache();
        }else if(function_exists('simple_cache_clear')){
            simple_cache_clear();
        }else{
            if (function_exists('w3tc_pgcache_flush'))
                w3tc_pgcache_flush();

            if (function_exists('w3tc_dbcache_flush'))
                w3tc_dbcache_flush();

            if (function_exists('w3tc_minify_flush'))
                w3tc_minify_flush();

            if (function_exists('w3tc_objectcache_flush'))
                w3tc_objectcache_flush();

            if (function_exists('wp_cache_clear_cache'))
                wp_cache_clear_cache();
        }
    }

    public function shortcode( $atts, $content=null, $code=''){
        extract(shortcode_atts(array('online_count' => 1, 'count_each' => 0, 'most_count' => 1, 'user_list' => 1,  'by_country' => 0, 'visitors_map' => 1), $atts ));

        $content = $this->show($online_count, $count_each, $most_count, $user_list, $by_country, $visitors_map, 'quick-count-shortcode', 0);

        return $content;
    }

    public function load_widgets() {
        register_widget('Quick_Count_Widget');
    }

    public function dashboard_widget() {
        echo $this->show(1,1,1,0,1,1,'quick-count-widget',0);
    }

    public function dashboard_widgets() {
        if(current_user_can('manage_options'))
            wp_add_dashboard_widget( 'quick_count_dashboard_widget', 'Quick Count',  array($this, 'dashboard_widget'));
    }

    protected function script_vars($script_suffix){
        $vars = array(
            'url' => $this->url,
            'version' => self::version,
            'jqvmap_version' => self::jqvmap_version,
            'ajaxurl' => admin_url('admin-ajax.php'),
            'script_suffix' => $script_suffix,
            'timeout_refresh_users' => $this->options['timeout_refresh_users'] * 1000,
            'i18n' => array(
                'one_admin_s'=> __('<strong>1 Administrator</strong>', 'quick-count'),
                'one_subscriber_s'=> __('<strong>1 Subscriber</strong>', 'quick-count'),
                'one_visitor_s'=> __('<strong>1 Visitor</strong>', 'quick-count'),
                'one_bot_s'=> __('<strong>1 Bot</strong>', 'quick-count'),
                'multiple_admins_s'=> __('<strong>%number Administrators</strong>', 'quick-count'),
                'multiple_subscribers_s'=> __('<strong>%number Subscribers</strong>', 'quick-count'),
                'multiple_visitors_s'=> __('<strong>%number Visitors</strong>', 'quick-count'),
                'multiple_bots_s'=> __('<strong>%number Bots</strong>', 'quick-count'),
                'zero_s' => __('There are no users', 'quick-count'),
                'one_s' => __('There is <strong>1</strong> user', 'quick-count'),
                'multiple_s' => __('There are <strong>%number</strong> users', 'quick-count'),
                'one_country_s'=> __('from <strong>1</strong> country</strong>', 'quick-count'),
                'multiple_countries_s'=> __('from <strong>%number</strong> countries</strong>', 'quick-count'),
                'one_admin_online_s' => __('<strong>1 administrator</strong> online:', 'quick-count'),
                'one_subscriber_online_s' => __('<strong>1 subscriber</strong> online:', 'quick-count'),
                'one_visitor_online_s' => __('<strong>1 visitor</strong> online:', 'quick-count'),
                'one_bot_online_s' => __('<strong>1 bot</strong> online:', 'quick-count'),
                'multiple_admins_online_s' => __('<strong>%number administrators</strong> online:', 'quick-count'),
                'multiple_subscribers_online_s' => __('<strong>%number subscribers</strong> online:', 'quick-count'),
                'multiple_visitors_online_s' => __('<strong>%number visitors</strong> online:', 'quick-count'),
                'multiple_bots_online_s' => __('<strong>%number bots</strong> online:', 'quick-count'),
                'most_online_s' => __('Most users online were <strong>%number</strong>, on <strong>%time</strong>', 'quick-count'),
                'count_s' => __('<strong>#%count - %name</strong>', 'quick-count'),
                'ip_s' => __('[%ip]', 'quick-count'),
                'country_s' => __('from %cname %cflag', 'quick-count'),
                'joined_s' => __('first joined on %joined, last seen on %polled while browsing <a href="%url" title="%url" target="_blank">%title</a>', 'quick-count'),
                'browser_s' => __('using %bname %bversion browser on %pname %pversion platform', 'quick-count'),
                'agent_s' => __('using %agent', 'quick-count'),
                'referrer_s' => __('[<a href="%referrer" title="%referrer" target="_blank">referrer</a>]', 'quick-count')
            )
        );

        if($this->quick_flag_capable() != false){
            global $quick_flag;
            $vars['qfc'] = 1;
            $vars['quick_flag_url'] = $quick_flag->flag_url;
        }

        return $vars;
    }

    protected function report(){
        global $wpdb;

        $user_data = array( 'agent' => '', 'title' => '',
                            'url' => '', 'referer' => '');

        $quick_flag_capable = $this->quick_flag_capable();
        $quick_browscap_capable = $this->quick_browscap_capable();

        $users_table_name = $wpdb->prefix . 'quick_count_users';

        $bot_array = array('google');

        $bot_found = false;
        foreach ($bot_array as $bot){
            if (stristr($_SERVER['HTTP_USER_AGENT'], $bot) !== false ) {
                $bot_found = true;
                $user_data['status'] = 3;
                $user_data['name'] = ucfirst($bot);
            }
        }

        if($bot_found == false){
            if(is_user_logged_in()){
                global $current_user;
                get_currentuserinfo();

                if(current_user_can('manage_options')){
                    $user_data['status'] = 0;
                }else{
                    $user_data['status'] = 1;
                }
                $user_data['name'] = $current_user->user_login;
            } else{
                $user_data['status'] = 2;

                if(!empty( $_COOKIE['comment_author_'.COOKIEHASH] )){
                    $user_data['name'] =  trim(strip_tags($_COOKIE['comment_author_'.COOKIEHASH]));
                }else{
                    $user_data['name'] = 'Visitor';
                }
            }
        }

        $user_data['agent'] = $_SERVER['HTTP_USER_AGENT'];
        $user_data['ip'] = (isset($_SERVER['HTTP_X_FORWARD_FOR'])) ? $_SERVER['HTTP_X_FORWARD_FOR'] : $_SERVER['REMOTE_ADDR'];

        if(isset($_POST['u']))
            $user_data['url'] = strip_tags($_POST['u']);

        if(isset($_POST['r']))
                $user_data['referer'] = strip_tags($_POST['r']);

        if(isset($_POST['t']))
            $user_data['title'] = strip_tags($_POST['t']);

        $sql_update_country = 'ccode = NULL, cname = NULL';
        if($quick_flag_capable){
            if(($country_info = $this->country_info($user_data['ip'])) != false)
                $sql_update_country = 'ccode = "'.$wpdb->escape($country_info->code).'", cname = "'.$wpdb->escape($country_info->name).'"';
        }

        $sql_update_browser = 'bname = NULL, bversion = NULL, pname = NULL, pversion = NULL';
        if($quick_browscap_capable){
            $browser_info = $this->browser_info($user_data['agent']);

            if(!isset($browser_info->Browser) || $browser_info->Browser == 'Default Browser')
                $browser_info->Browser = __('unknown', 'quick-count');

            if(!isset($browser_info->MajorVer) || $browser_info->MajorVer == '0')
                $browser_info->MajorVer = '';

            if(!isset($browser_info->Platform) || $browser_info->Platform == 'unknown')
                $browser_info->Platform = __('unknown', 'quick-count');

            if(!isset($browser_info->Platform_Version) || $browser_info->Platform_Version == 'unknown')
                $browser_info->Platform_Version = '';

            $sql_update_browser = 'bname = "'.$wpdb->escape($browser_info->Browser).'", bversion = "'.$wpdb->escape($browser_info->MajorVer).'", pname = "'.$wpdb->escape($browser_info->Platform).'", pversion = "'.$wpdb->escape($browser_info->Platform_Version).'"';
        }

        $wpdb->query('INSERT INTO '.$users_table_name.' SET status = '.$user_data['status'].', polled = UTC_TIMESTAMP(), joined = UTC_TIMESTAMP(), ip = "'.$user_data['ip'].'", name = "'.$wpdb->escape($user_data['name']).'", agent = "'.$wpdb->escape($user_data['agent']).'", title = "'.$wpdb->escape($user_data['title']).'", url = "'.$wpdb->escape($user_data['url']).'", referer = "'.$wpdb->escape($user_data['referer']).'", '.$sql_update_country.', '.$sql_update_browser.', online = 1 ON DUPLICATE KEY UPDATE polled = UTC_TIMESTAMP(), title = "'.$wpdb->escape($user_data['title']).'", url = "'.$wpdb->escape($user_data['url']).'", referer = "'.$wpdb->escape($user_data['referer']).'", '.$sql_update_country.', '.$sql_update_browser.', online = 1;');

        return array();
    }

    protected function get(){
        global $wpdb;

        $user_stats = get_option('quick_count_user_stats');
        $date_format = get_option('date_format');
        $time_format = get_option('time_format');
        $gmt_offset = get_option('gmt_offset') * 3600;

        $quick_flag_capable = $this->quick_flag_capable();
        $quick_browscap_capable = $this->quick_browscap_capable();

        $users_table_name = $wpdb->prefix . 'quick_count_users';

        $wpdb->get_results('UPDATE '.$users_table_name.' SET online = 0 WHERE polled < TIMESTAMPADD(SECOND,-'.($this->options['timeout_refresh_users']*2).',UTC_TIMESTAMP());');

        $sql_fetch_country = 'NULL as cc, NULL as cn, NULL as la, NULL as lo';
        if($quick_flag_capable){
            $sql_fetch_country = 'ccode as cc, cname as cn';
        }

        $sql_fetch_browser = 'NULL as bn, NULL as bv, NULL as pn, NULL as pv';
        if($quick_browscap_capable){
            $sql_fetch_browser = 'bname as bn, bversion as bv, pname as pn, pversion as pv';
        }

        $user_list = $wpdb->get_results('SELECT status AS s, polled AS p, joined AS j, ip AS i, name AS n, agent AS a, title AS t, url AS u, referer AS r, '.$sql_fetch_country.', '.$sql_fetch_browser.' FROM '.$users_table_name.' WHERE online = 1 ORDER BY joined ASC');

        foreach($user_list as $u){
            $u->p = date_i18n($date_format.' @ '.$time_format, strtotime($u->p.' UTC') + $gmt_offset);
            $u->j = date_i18n($date_format.' @ '.$time_format, strtotime($u->j.' UTC') + $gmt_offset);
        }

        if($wpdb->num_rows > $user_stats['n']){
            $user_stats = array('n' => $wpdb->num_rows,
                                't' => time());
            update_option('quick_count_user_stats', $user_stats);
        }

        $response = array(
                        'ul' => $user_list,
                        'sn' => $user_stats['n'],
                        'st' => date_i18n($date_format.' @ '.$time_format, $user_stats['t'] + $gmt_offset)
                    );

        return $response;
    }

    protected function current_admin_url(){
        $url = get_admin_url() . basename($_SERVER['SCRIPT_FILENAME']);

        if(!empty($_SERVER['QUERY_STRING'])){
            $url .= '?'.$_SERVER['QUERY_STRING'];
        }

        return $url;
    }

    function log($title, $code = null, $message = null){
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
global $quick_count;
$quick_count = new Quick_Count();

require_once(dirname(__FILE__) . '/class-quick-count-list-table.php');
require_once(dirname(__FILE__) . '/widgets.php');
?>