<?php
global $reports;
$reports[] = array(BA_REPORTS_HOME, 'Reports - Referer', 'Referer', 2, BA_REPORTS_PREF . 'referer', 'render' => 'renderReportReferer');


function renderReportReferer() {
    echo '<script src="' . site_url('/wp-includes/js-plugins/jquery.dataTables.min.js') . '"></script>';
    echo '<h1>Report - Referer</h1>';
    
    
    global $wpdb;

    //{$wpdb->prefix}
        
    $filters = array(
                        'All' => " `referer` IS NOT NULL AND `referer` != '' ",
                        //'All Externals' => "`referer` NOT LIKE '%cucak.am%' AND `referer` IS NOT NULL AND `referer` != ''",
                        'Facebook' => "`referer` LIKE '%facebook.%'",
                        'Google' => "`referer` LIKE '%google.%'",
                        'Yandex' => "`referer` LIKE '%yandex.%'",
                        'Bing' => "`referer` LIKE '%bing.%'",
                        //'List.am <span style="font-size: 18pt;">☺</span>' => "`referer` LIKE '%list.am/%'",
                        //'armzoog.ru' => "`referer` LIKE '%armzoog.ru%'",
                        'armspy.ru' => "`referer` LIKE '%armspy.ru%'",
                        '1intv.com' => "`referer` LIKE '%1intv.com%'",
                        //
                        'To "haytararutyun.am"' => "`host` LIKE '%haytararutyun.am'",
                        'To "notebookcentre.am" or "notebookcentre.cucak.am"' => "`host` LIKE '%notebookcentre%'",
                    );
    $period = arg($_REQUEST, 'period', 30);
    ?>
    <div class="referer">
        <form method="post">
            <span>Show for </span><input type="number" value="<?php echo $period ?>" name="period" /><span> days</span>
            <input type="submit" value="Go" />
        </form>
        <table class="wp-list-table widefat fixed data-table-basic">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Key</th>
                    <th>Unique Visitors</th>
                    <th>Visits</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($filters as $key => $filter) {
                $wp_query	= " SELECT COUNT(DISTINCT ip) visitors, COUNT(ip) visits
                                FROM `{$wpdb->prefix}clients`
                                WHERE $filter" . ($period > 0 ? " AND (`date` > NOW() - INTERVAL $period DAY)" : '');

                $list = $wpdb->get_results($wp_query);

                foreach($list as $item) {
                    $row++;
                    echo "<tr> <td>{$row}</td> <td>$key</td> <td>{$item->visitors}</td> <td>{$item->visits}</td> </tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}