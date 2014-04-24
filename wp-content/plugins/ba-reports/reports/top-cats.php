<?php
global $reports;
$reports[] = array(BA_REPORTS_HOME, 'Reports - Top Cats', 'Top Cats', 2, BA_REPORTS_PREF . 'top-cats', 'render' => 'renderReportTopCategories');


function renderReportTopCategories() {
    echo '<script src="' . site_url('/wp-includes/js-plugins/jquery.dataTables.min.js') . '"></script>';
    echo '<h1>Report - Top Categories</h1>';
    
    
    global $wpdb;

    //{$wpdb->prefix}
    ?>
    <div class="top-users">
        <table class="wp-list-table widefat fixed data-table-basic" style="text-align: right;">
            <colgroup>
                <col width="40" />
                <col width="60" />
                <col />
                <col width="130" />
                <col width="130" />
                <col width="130"/>
            </colgroup>
            
            <thead>
                <tr>
                    <th style="text-align: right;">N</th>
                    <th style="text-align: right;">ID</th>
                    <th style="text-align: left;">Name</th>
                    <th style="text-align: right;">Posts count</th>
                    <th style="text-align: right;">Views</th>
                    <th style="text-align: right;">Views per Post</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $wp_query	= " # TOTAL Views by categories
                            SELECT v.cat, t.`name`, r.`am_HY`, v.posts, v.views, FORMAT(v.views / v.posts, 2) AS `views_per_post` FROM
                            (
                                SELECT pc.cat, COUNT(`meta_value`) AS `posts`, SUM(`meta_value`) AS `views`
                                FROM wp_postmeta pm
                                JOIN wp_posts p ON p.`ID` = pm.`post_id`
                                JOIN (SELECT pm.`post_id`, pm.`meta_value` AS cat FROM wp_postmeta pm WHERE pm.`meta_key` = 'post_cat') pc ON p.`ID` = pc.post_id
                                WHERE p.`post_status` = 'publish' AND p.`post_type` = 'post' AND pm.`meta_key` = '_count-views_all'
                                GROUP BY pc.cat
                                #ORDER BY `views` DESC
                            ) v
                            JOIN wp_terms t ON v.cat = t.`term_id`
                            JOIN `wp_translations` r ON t.`name` = r.`key`"
                            . 'ORDER BY (v.views / v.posts) DESC';
            
            $list = $wpdb->get_results($wp_query);

            foreach($list as $item) {
                $row++;
                echo "<tr> <td>{$row}</td> <td>[{$item->cat}]</td> <td style=\"text-align: left;\"><a href=\"//cucak.am/?cat={$item->cat}\" title=\"{$item->name}\">{$item->am_HY}</a></td> <td>{$item->posts}</td> <td>{$item->views}</td> <td>{$item->views_per_post}</td> </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}
