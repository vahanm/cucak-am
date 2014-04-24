<div class="wrap" style="width: 1000px">
    <h2>WP Meta Sort Posts Configuration</h2>
    <?php
    /* Supported Theme Check */
    $msp_theme_support = get_option('msp_theme_support');
    if ($msp_theme_support == 'yes') {
        $options_message = 'The best settings for ' . get_current_theme() . ' theme have been detected.';
        $alert_class = 'updated';
    } else {
        $options_message = '<p>The best options for <strong>' . get_current_theme() . '</strong> theme could not be detected. If you have trouble configuring WP Meta Sort Posts to work with your theme, please leave a comment <a href="http://jasonpitts.com/wp-meta-sort-posts/">here</a>. Please include the theme you are using and settings you have tried in addition to any problems you are having.</p><p>The themes loop file is the ".php" file used by your theme to request and format posts. Not all themes have their loop broken out into an individual file. In these cases, you will need to use the loop included with the plugin by specifying “<em>MSP</em>” in the options below. If you would like help identifying your  themes loop file, leave a comment <a href=”http://jasonpitts.com/wp-meta-sort-posts/”>here</a>.</p><p>Additionally, you can choose a known compatible theme like <a href="http://www.heatmaptheme.com/amember/go.php?r=434&i=l2">HeatMap Theme Pro V5</a>. For a full list of preconfigured themes, visit the <a href="http://jasonpitts.com/wp-meta-sort-posts/">plugin page.</a></p>';
        //$alert_class = 'error';
        $alert_class = 'updated';

        }
    ?>
    <div class="<?php echo _e($alert_class); ?>" style="width: inherit;"><?php echo $options_message; ?></div>
    <?php
    if ($_POST['msp_hidden'] == 'Y') {
        //Form Data Sent
        $msp_error = '';
        if (strpos($_POST['msp_loop_file'], '.php') > 0) {
            $MspLoopFile = implode('.', explode('.', $_POST['msp_loop_file'], -1));
            $msp_error .= '<li>' . 'file extension <em>".php"</em> removed from loop filename. ' . '</li>';
        } else {
            $MspLoopFile = $_POST['msp_loop_file'];
        }
        update_option('msp_loop_file', $MspLoopFile);

        $MspNavLocation = $_POST['msp_nav_location'];
        update_option('msp_nav_location', $MspNavLocation);
        ?>

        <div class="updated" style="width: inherit;"><p><strong><?php _e('Options saved.'); ?></strong></p><ul><?php echo _e($msp_error); ?></ul></div>        
    <?php
} else {
    //Normal Page Display
    $MspLoopFile = get_option('msp_loop_file');

    $MspNavLocation = get_option('msp_nav_location');
}
?>

    <div id="msp-options-form" style="float: left; width: 650px;">  

        <form name="msp_form" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
            <input type="hidden" name="msp_hidden" value="Y">  
            <h3><?php echo _e('Options'); ?></h3>

            <p><?php _e("Theme's loop file (<em>don't include \".php\"</em>): "); ?><input type="text" name="msp_loop_file" value="<?php echo $MspLoopFile; ?>" size="20"><?php _e(".php"); ?></p>  
            <p><?php _e("Page navigation location: "); ?><input type="radio" name="msp_nav_location" value="top" size="20" <?php if ($MspNavLocation == 'top') echo 'checked="checked"'; ?>><?php _e(" Top "); ?><input type="radio" name="msp_nav_location" value="bottom" size="20" <?php if ($MspNavLocation == 'bottom') echo 'checked="checked"'; ?>><?php _e(" Bottom "); ?><input type="radio" name="msp_nav_location" value="both" size="20" <?php if ($MspNavLocation == 'both') echo 'checked="checked"'; ?>><?php _e(" Both "); ?><input type="radio" name="msp_nav_location" value="none" size="20" <?php if ($MspNavLocation == 'none') echo 'checked="checked"'; ?>><?php _e(" None (use when theme's loop file contains navigation) "); ?></p>   
            <p class="submit">  
                <input class="button-primary" type="submit" name="Submit" value="<?php _e('Update Options') ?>" />  
            </p>  
        </form>

        <!-- MSP Usage Instructions -->
        <hr /> 
        <h3><?php echo _e('Shortcode Usage'); ?> </h3>
        <strong>        
            <code>
                [msp query_string="QUERY"]
            </code>
        </strong>
        <br />
        <br />
<?php echo _e('“<strong>QUERY</strong>” in the above example refers to a complete query in URL Query String format. Both Public and Private <a href="http://codex.wordpress.org/WordPress_Query_Vars">WordPress query variables</a> can be passed as long as it is formatted appropriately. e.g.'); ?>
        <br />
        <br/>
        <strong>
            <code>
                [msp query_string="meta_key=shortcode_test&meta_value=Arizona&orderby=meta_value&order=asc"]
            </code>
        </strong>    
        <br />
        <br />
<?php echo _e('<em>Notes:</em> Do not URL encode special characters like spaces to %20. Do not use query variables “paged” and “offset” in your shortcode because they are automatically calculated and added to the query string.'); ?>
        <br />
        <br />
        If you prefer, you can also pass each argument separately.
        <br />
        <br />
<strong>
<code>
[msp Argument1=”Value1” Argument2=”Value2” Argument3=”Value3”]
</code>
</strong>
        <br />
        <br />
The same query will be performed as in the original example if the arguments are passed like the example below.
        <br />
        <br />
<strong>
<code>
[msp meta_key="msp_test" meta_value="Arizona" orderby="meta_value" order="asc"]
</code>
</strong>
        <br />
        <br />

    </div>

    <!-- MSP Admin sidebar -->


    <div id="msp-side-bar" style="width: 300px; height: inherit; float: right;">
<!--Dontate-->
        <div  style="border-style: solid; border-radius: 3px; border-width: 1px; padding: 0 .6em; margin: 5px 0 15px; align: middle; text-align: center; width: inherit; height: 120px; background-color: #FFEBE8; border-color: #C00;"><h4>Help me continue to develop this plugin:</h4>

            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="ZRUDSPGE6TBSJ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>

        <!--Fork Me-->

        <div  style="align: middle; border-style: solid; border-radius: 3px; border-width: 1px; padding: 0 .6em; margin: 5px 0 15px; text-align: left; width: inherit; background-color: lightYellow; border-color: #E6DB55;">
            <a href="https://github.com/jasonpitts/WP-Meta-Sort-Posts">
                <table style="width: 100%">
                    <tr>
                        <td><h2>  Fork me on Github</h2></td>
                        <td style="text-align: right;"><img src="<?php echo plugin_dir_url(__FILE__); ?>/images/github_logo.png"></td>

                    </tr>
                </table>
            </a>
        </div>


        <!--plugin comments feed -->  


        <div  style="text-align: center; border-style: solid; border-radius: 3px; border-width: 1px; padding: 0 .6em; margin: 5px 0 15px; align: middle; width: inherit; background-color: lightgray; border-color: darkgray;">       
            <strong><?php _e('WP Meta Sort Posts Plugin Discussion'); ?></strong>
        </div>        
<?php
// Get RSS Feed(s)
include_once(ABSPATH . WPINC . '/feed.php');

$rss = fetch_feed('http://jasonpitts.com/wp-meta-sort-posts-wordpress-plugin/feed/');
if (!is_wp_error($rss)) : // Checks that the object is created correctly 

    $maxitems = $rss->get_item_quantity(5); // Figure out how many total items there are, but limit it to 5. 


    $rss_items = $rss->get_items(0, $maxitems); // Build an array of all the items, starting with element 0 (first element).
endif;
?>

        <ul>
        <?php
        if ($maxitems == 0)
            echo '<li>No items.</li>';
        else
        // Loop through each feed item and display each item as a hyperlink.
            foreach ($rss_items as $item) :
                ?>
                    <li>
                        <a href='<?php echo esc_url($item->get_permalink()); ?>'
                           title='<?php echo 'Posted ' . $item->get_date('j F Y | g:i a'); ?>'>
                            <?php echo preg_replace('/((\w+\W*){14}(\w+))(.*)/', '${1}', esc_html($item->get_description())); ?></a>
                    </li>
                <?php endforeach; ?>
        </ul>

        <!--Other Related Wordpress feed -->  

        <div  style="text-align: center; border-style: solid; border-radius: 3px; border-width: 1px; padding: 0 .6em; margin: 5px 0 15px; align: middle; width: inherit; background-color: lightgray; border-color: darkgray;">       
            <strong><?php _e('My Wordpress Plugins, Themes, etc.'); ?></strong>
        </div>        
        <?php
        // Get RSS Feed(s)
        include_once(ABSPATH . WPINC . '/feed.php');

        $rss = fetch_feed('http://jasonpitts.com/category/wordpress/feed/');
        if (!is_wp_error($rss)) : // Checks that the object is created correctly 

            $maxitems = $rss->get_item_quantity(15); // Figure out how many total items there are, but limit it to 15. 


            $rss_items = $rss->get_items(0, $maxitems); // Build an array of all the items, starting with element 0 (first element).
        endif;
        ?>

        <ul>
            <?php
            if ($maxitems == 0)
                echo '<li>No items.</li>';
            else
            // Loop through each feed item and display each item as a hyperlink.
                foreach ($rss_items as $item) :
                    ?>
                    <li>
                        <a href='<?php echo esc_url($item->get_permalink()); ?>'
                           title='<?php echo 'Posted ' . $item->get_date('j F Y | g:i a'); ?>'>
        <?php echo esc_html($item->get_title()); ?></a>
                    </li>
    <?php endforeach; ?>
        </ul>

        <!--jasonpitts.com Feed -->
        <div  style="text-align: center; border-style: solid; border-radius: 3px; border-width: 1px; padding: 0 .6em; margin: 5px 0 15px; align: middle; width: inherit; background-color: lightgray; border-color: darkgray;">       
            <strong><?php _e('JasonPitts.com Recent Posts'); ?></strong>
        </div>        
        <?php
        // Get RSS Feed(s)
        include_once(ABSPATH . WPINC . '/feed.php');

        $rss = fetch_feed('http://jasonpitts.com/feed');
        if (!is_wp_error($rss)) : // Checks that the object is created correctly 

            $maxitems = $rss->get_item_quantity(5); // Figure out how many total items there are, but limit it to 5. 


            $rss_items = $rss->get_items(0, $maxitems); // Build an array of all the items, starting with element 0 (first element).
        endif;
        ?>

        <ul>
<?php
if ($maxitems == 0)
    echo '<li>No items.</li>';
else
// Loop through each feed item and display each item as a hyperlink.
    foreach ($rss_items as $item) :
        ?>
                    <li>
                        <a href='<?php echo esc_url($item->get_permalink()); ?>'
                           title='<?php echo 'Posted ' . $item->get_date('j F Y | g:i a'); ?>'>
        <?php echo esc_html($item->get_title()); ?></a>
                    </li>
    <?php endforeach; ?>
        </ul>

    </div>

</div>