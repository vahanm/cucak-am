<?php
global $reports;
$reports[] = array(BA_REPORTS_HOME, 'Reports - Top Users', 'Top Users', 2, BA_REPORTS_PREF . 'top-users', 'render' => 'renderReportTopUsers');


function renderReportTopUsers() {
    echo '<script src="' . site_url('/wp-includes/js-plugins/jquery.dataTables.min.js') . '"></script>';
    echo '<h1>Report - Top Users</h1>';
    
    
    global $wpdb;

    //{$wpdb->prefix}
    ?>
    <div class="top-users">
        <table class="wp-list-table widefat fixed data-table-basic">
            <thead>
                <tr>
                    <th>N</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Posts count</th>
                    <th>Email</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $wp_query	= " SELECT DISTINCT
                              u.ID,
                              p.post_count,
                              um.meta_value AS `name`,
                              u.`user_email`,
                              u.`user_registered`
                            FROM {$wpdb->prefix}users u
                              JOIN {$wpdb->prefix}usermeta um
                                ON um.user_id = u.ID
                              JOIN (SELECT
                                      p.post_author,
                                      COUNT(p.ID)       post_count
                                    FROM {$wpdb->prefix}posts p
                                    WHERE p.post_status = 'publish'
                                        AND p.post_type = 'post'
                                    GROUP BY p.post_author) p
                                ON p.post_author = u.ID
                                JOIN (SELECT um.user_id FROM {$wpdb->prefix}usermeta um/* WHERE um.meta_key = 'show_on_home' AND um.meta_value = '1'*/) s ON s.user_id = u.ID
                            WHERE um.meta_key = 'display_name'
                                AND u.ID != 2 AND p.post_count > 2
                                ORDER BY p.post_count DESC
                                ";
            
            $list = $wpdb->get_results($wp_query);

            foreach($list as $item) {
                $row++;
                echo "<tr> <td>{$row}</td> <td>[{$item->ID}]</td> <td><a href=\"//cucak.am/{$item->ID}\">{$item->name}</a></td> <td>{$item->post_count}</td> <td>{$item->user_email}</td> <td>{$item->user_registered}</td> </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}
