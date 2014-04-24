<?php
global $reports;
$reports[] = array(BA_REPORTS_HOME, 'Reports - Posts by IP', 'Posts by IP', 2, BA_REPORTS_PREF . 'posts-by-ip', 'render' => 'renderReportPostsByIP');


function renderReportPostsByIP() {
    echo '<script src="' . site_url('/wp-includes/js-plugins/jquery.dataTables.min.js') . '"></script>';
    echo '<h1>Report - Posts by IP</h1>';
        
    global $wpdb;

    //{$wpdb->prefix}
    ?>
    <div class="referer">
        <table class="wp-list-table widefat fixed data-table-basic">
            <thead>
                <tr>
                    <th style="width: 50px;">N</th>
                    <th style="width: 150px;">IP</th>
                    <th style="width: 50px;">Posts count</th>
                    <th style="width: 320px;">Users</th>
                    <th style="width: 320px;">Posts</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $wp_query	= " SELECT 
                                    p.`meta_value` AS IP,
                                    COUNT(p.`post_id`) AS posts_count,
                                    GROUP_CONCAT(
                                    DISTINCT u.`user_id` 
                                    ORDER BY u.`user_id` + 0
                                    ) AS users,
                                    GROUP_CONCAT(
                                    DISTINCT p.`post_id` 
                                    ORDER BY p.`post_id` + 0
                                    ) AS posts 
                                FROM
                                    `{$wpdb->prefix}postmeta` p 
                                    JOIN 
                                    (SELECT 
                                        `post_id`,
                                        `meta_value` AS user_id
                                    FROM
                                        `{$wpdb->prefix}postmeta` 
                                    WHERE `meta_key` = 'post_userid') u 
                                    ON u.`post_id` = p.`post_id` 
                                WHERE `meta_key` = 'post_remote_ip' 
                                GROUP BY `meta_value` 
                                HAVING posts_count > 1 
                                ORDER BY posts_count DESC ;";

                $list = $wpdb->get_results($wp_query);
                $count = count($list);

                foreach($list as $post) {
                    $users = '';
                    
                    //$users .= "<li>{$post->users}</li>";
                    //var_dump(preg_split("/[,]/", $post->users));
                    
                    $users_list = preg_split("/[,]/", $post->users);
                    
                    foreach($users_list as $user) {
                        $path = site_url("/{$user}");
                        //$users .= "<li><a href=\"$path\">{$user}</a></li>";
                        $users .= "<a href=\"$path\">{$user}</a>, ";
                    }
                    
                    $posts = '';
                    //$posts .= "<li>{$post->posts}</li>";
                    
                    $posts_list = preg_split("/[,]/", $post->posts);
                    
                    foreach($posts_list as $item) {
                        $path = site_url("?p={$item}");
                        //$posts .= "<li><a href=\"$path\">p{$post->id}</a> <span style=\"font-size: 80%;\">({$post->date})</span></li>";
                        $posts .= "<a href=\"$path\">{$item}</a>, ";
                    }
               
                    $path = site_url("/?qremote_ipoeq={$post->IP}");
                        
                    $row++;
                    //echo "<tr> <td>{$row}</td> <td>{$post->IP}</td> <td>{$post->posts_count}</td> <td><div style=\"max-height: 200px; overflow-y: scroll;\"><ol style=\"margin: 3px; margin-left: 24px;\">{$users}</ol></div></td> <td><div style=\"max-height: 200px; overflow-y: scroll;\"><ol style=\"margin: 3px; margin-left: 24px;\">{$posts}</ol></div></td> </tr>";
                    echo "<tr> <td>{$row}</td> <td><a href=\"{$path}\">{$post->IP}</a></td> <td>{$post->posts_count}</td> <td>{$users}</td> <td>{$posts}</td> </tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}