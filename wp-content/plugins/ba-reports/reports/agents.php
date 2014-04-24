<?php
global $reports;
$reports[] = array(BA_REPORTS_HOME, 'Reports - Agents', 'Agents', 2, BA_REPORTS_PREF . 'agents', 'render' => 'renderReportAgents');


function renderReportAgents() {
    echo '<h1>Report - Agents</h1>';
    
    
    global $wpdb;

    //{$wpdb->prefix}
        
    global $registredAgentsData;
    
    $period = arg($_REQUEST, 'period', 30);
    ?>
    <div class="referer">
        <form method="post">
            <span>Show for </span><input type="number" value="<?php echo $period ?>" name="period" /><span> days</span>
            <input type="submit" value="Go" />
        </form>
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr>
                    <th style="width: 50px;">N</th>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th style="width: 50px;">Posts</th>
                    <th style="width: 320px;"></th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($registredAgentsData as $key => $agent) {
                //$wp_query	= " SELECT pm.`meta_value` AS agent, COUNT(pm.`post_id`) AS posts FROM `{$wpdb->prefix}postmeta` pm
                //                JOIN `{$wpdb->prefix}posts` p ON p.`post_type` = 'post' AND p.`post_status` = 'publish' AND p.`ID` = pm.`post_id`
                //                WHERE `meta_key` = 'post_agent' AND `meta_value` = '$key';";// . ($period > 0 ? " AND (`post_date` > NOW() - INTERVAL $period DAY)" : '');

                //$list = $wpdb->get_results($wp_query);

                //foreach($list as $item) {
                //    $row++;
                //    echo "<tr> <td>{$row}</td> <td>$key</td> <td>{$agent->name}</td> <td>{$item->posts}</td> <td>{$agent->registered}</td> </tr>";
                //}
                
                $wp_query	= " SELECT pm.`post_id` AS id, p.`post_date` AS date FROM `{$wpdb->prefix}postmeta` pm
                                JOIN `{$wpdb->prefix}posts` p ON p.`post_type` = 'post' AND p.`post_status` = 'publish' AND p.`ID` = pm.`post_id`
                                WHERE `meta_key` = 'post_agent' AND `meta_value` = '$key'" . ($period > 0 ? " AND (p.`post_date` > NOW() - INTERVAL $period DAY)" : '');

                $list = $wpdb->get_results($wp_query);
                $count = count($list);
                $rows = '';
                foreach($list as $post) {
                    $path = site_url("?p={$post->id}");
                    $rows .= "<li><a href=\"$path\">p{$post->id}</a> <span style=\"font-size: 80%;\">({$post->date})</span></li>";
                }
               
                $row++;
                echo "<tr> <td>{$row}</td> <td>$key</td> <td>{$agent->name}</td> <td><div style=\"border: 1px solid #999; background-color: #fff; padding: 2px;\">$key.agent.cucak.am</div></td> <td>$count</td> <td><div style=\"max-height: 200px; overflow-y: scroll;\"><ol style=\"margin: 3px; margin-left: 24px;\">$rows</ol></div></td> <td>{$agent->registered}</td> </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}