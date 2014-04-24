<?php
/*
Plugin Name: BA Translation
Plugin URI: http://cucak.am
Description: 
Version: 1.0
Author: Vahan Mkhitaryan
Author URI: http://www.facebook.com/vahan.mkhitaryan
*/

if (isset($_POST['insert']) && isset($_POST['input_key']))
{
    batrans_insert($_POST['input_key'], $_POST['input_en_EN'], $_POST['input_ru_RU'], $_POST['input_am_HY']);
}
else if (isset($_POST['update']) && isset($_POST['input_key']))
{
    batrans_update($_POST['input_id'], $_POST['input_key'], $_POST['input_en_EN'], $_POST['input_ru_RU'], $_POST['input_am_HY']);
}
else if (isset($_POST['delete']))
{
    batrans_delete($_POST['input_id']);
}
else if (isset($_POST['updateById']) && isset($_POST['text']))
{
    batrans_updateById($_POST['updateById'], $_POST['text']);
}
else if (isset($_POST['exit']))
{
    exit;
}

$plugindir = get_option('home') . '/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-translation', $plugindir . '/ba-translation.js', array('jQuery', 'jQuery UI'), '1.0');

register_activation_hook(__FILE__, 'batrans_install');

add_action('admin_menu', 'batrans_admin_menus');

register_deactivation_hook(__FILE__, 'batrans_uninstall');

add_action( 'widgets_init', create_function( '', 'register_widget( "Translations_widget" );' ) );


global $trans_cache;

add_filter( 'gettext', 'db_translate', 20, 3 );
function db_translate( $translation, $text, $domain ) {
    if(!trim($text))
        return $text;
    
    global $trans_cache;
    
    if(!isset($trans_cache))
        $trans_cache = get_translations();
    
    $key = md5($text);
    
    $val = null;
    
    if(isset($trans_cache[$key]))
        $val = $trans_cache[$key];
    
    if ($val != null) {
        return $val;
    }
    
    return $text;
}

add_filter( 'ngettext', 'db_translate_numbers', 20, 3 );
function db_translate_numbers( $translation, $single, $plural, $number, $domain ) {
    return db_translate( $translation, $translation, $domain );
}

function get_translations()
{
    global $wpdb;
    
    $lng = WPLANG;
    
    //$wp_query	=	'SELECT `key`, `' . WPLANG . '` FROM `' . $table_name . '` WHERE 1;';
    //$wp_query	=	'SELECT `key`, `' . WPLANG . '` AS val FROM `' . $table_name . '` WHERE 1;';
    
    
    //SELECT * FROM (SELECT `key`, `en_EN` AS val FROM `wp_translations`) t WHERE t.val != "";
    
    //$wp_query	=	"SELECT *
    //                    FROM (SELECT
    //                            `key`,
    //                            IFNULL(
    //                                IF(
    //                                LENGTH(IFNULL(`tag`, '')) > 0,
    //                                CONCAT(
    //                                    '<',
    //                                    `tag`,
    //                                    IFNULL(CONCAT(' class=\"', `classes`, '\"'), ''),
    //                                    IFNULL(CONCAT(' filtername=\"', `filtername`, '\"'), ''),
    //                                    IFNULL(CONCAT(' filtertypes=\"', `filtertypes`, '\"'), ''),
    //                                    IFNULL(CONCAT(' filtervalue=\"', `filtervalue`, '\"'), ''),
    //                                    IFNULL(`attributes`, ''),
    //                                    CONCAT(' key=\"', `key`, '\"'),
    //                                    '>',
    //                                    `$lng`,
    //                                    '</',
    //                                    `tag`,
    //                                    '>'
    //                                ),
    //                                NULL
    //                                ),
    //                                `$lng`
    //                            ) AS val 
    //                            FROM `{$wpdb->prefix}translations`) t
    //                    WHERE t.val != ''";
                        
    $wp_query	=	"SELECT *
                     FROM (SELECT
                             IF(m.asHTML = 1, REPLACE(`key`, 'value_content_', 'value_content_html_'), `key`) AS `key`,
                             IFNULL(
                                 IF(
                                 m.asHTML = 1,
                                 CONCAT(
                                     '<',
                                     `tag`,
                                     IFNULL(CONCAT(' class=\"', `classes`, '\"'), ''),
                                     IFNULL(CONCAT(' filtername=\"', `filtername`, '\"'), ''),
                                     IFNULL(CONCAT(' filtertypes=\"', `filtertypes`, '\"'), ''),
                                     IFNULL(CONCAT(' filtervalue=\"', `filtervalue`, '\"'), ''),
                                     IFNULL(`attributes`, ''),
                                     CONCAT(' key=\"', `key`, '\"'),
                                     '>',
                                     `$lng`,
                                     '</',
                                     `tag`,
                                     '>'
                                 ),
                                 NULL
                                 ),
                                 `$lng`
                             ) AS val
                             FROM `{$wpdb->prefix}translations`
                             JOIN (SELECT 0 AS asHTML
                                   UNION
                                   SELECT 1) m ON m.asHTML = 0 OR LENGTH(IFNULL(`tag`, '')) > 0
                     ) t
                     WHERE t.val != ''";

    //$wp_query	=	'SELECT * FROM (SELECT `key`, `' . WPLANG . '` AS val FROM `' . $table_name . '`) t WHERE t.val != "";';
    
    
    
    $transList	=	$wpdb->get_results($wp_query);
    
    $tmp = array();
    
    if(empty($transList))
        return $tmp;
    
    foreach($transList as $hh)	{
        $key = md5($hh->key);
        $tmp[$key] = $hh->val;
        
        //switch(WPLANG)
        //{
        //	case 'en_EN':
        //		$tmp[$key] = $hh->en_EN;
        //		break;
        //	case 'ru_RU':
        //		$tmp[$key] = $hh->ru_RU;
        //		break;
        //	case 'am_HY':
        //		$tmp[$key] = $hh->am_HY;
        //		break;
        //	default:
        //		$tmp[$key] = $hh->key;
        //		break;
        //}
    }
    
    return $tmp;
}

function theme_change_comment_field_names_old( $translated_text, $text, $domain ) {
    if(!trim($text))
        return $text;
    
    if(!$trans_cache)
        $trans_cache = get_translations();
    
    if(batrans_keyexists($text))
    {
        $txt = batrans_text($text);
        if($txt != '')
        {
            return $txt;
        }
    }
    //else
    //{
    //	if($domain != 'FORMAT')
    //		batrans_insert($text);
    //}
    
    $id = batrans_id($text);
    $link = '';
    if ( WP_TRANS && WPLANG == 'am_HY' && $domain != 'FORMAT')
        $link = '<a href="javascript:;" onclick="tranpopup(' . $id . ', this);" style="display:inline;">(T : ' . $text . ')</a> ';

    return $link . $text;
}

if (!function_exists('batrans_replace_quotes'))
{
    function batrans_replace_quotes($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        $tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

if (!function_exists('batrans_replace_quotes_decode'))
{
    function batrans_replace_quotes_decode($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        $tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

class Translations_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'Translations_widget', // Base ID
            'Translations_Widget', // Name
            array( 'description' => __( 'A Translations Widget', 'text_domain' ), ) // Args
        );
    }

    public function widget( $args, $instance ) {
        if ( !current_user_can('manage_options') )
            return;
        
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
            
        //global $wpdb;
        //
        //$table_name = $wpdb->prefix . "translations";
    
    //	$wp_query	=	"SELECT * FROM $table_name ORDER BY transKey ASC;"; // LIMIT $limit, $paginno";
    //	$transList	=	$wpdb->get_results($wp_query);

////
    //	echo '<ul class="Translationswidget">';
    //	
    //	foreach($transList as $hh)	{
    //		echo "<li id=\"search-{$hh->transKey}\" title=\"$hh->mail\">";
    //			echo $hh->name;
    //		echo "</li>";
    //	}

//
        //echo '</ul>';
        
        echo "<form taget\"_self\" method=\"post\" style=\"text-align: right;\" >";

        echo "<label>Key</label>\n";						
        echo "<input type=\"text\" name=\"input_key\" value=\"\" class=\"editvalue\" />\n";
        echo "</br>\n";
        
        echo "<label>en_EN</label>\n";						
        echo "<input type=\"text\" name=\"input_en_EN\" value=\"\" class=\"editvalue\" />\n";
        echo "</br>\n";
        
        echo "<label>ru_RU</label>\n";						
        echo "<input type=\"text\" name=\"input_ru_RU\" value=\"\" class=\"editvalue\" />\n";
        echo "</br>\n";
        
        echo "<label>am_HY</label>\n";						
        echo "<input type=\"text\" name=\"input_am_HY\" value=\"\" class=\"editvalue\" />\n";
        echo "</br>\n";
        echo "</br>\n";

        echo "<input type=\"submit\" name=\"insert\" value=\"Insert\" />\n" ; //Actions
        echo "<input type=\"reset\" name=\"clear\" value=\"Clear\" />\n" ; //Actions

        echo "</form>";

        
        echo $after_widget;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'text_domain' );
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }

} // class Translations_Widget

define('BA_RES_PREF', 'ba-resources');

function batrans_admin_menus()	{
    add_menu_page('Resources', 'Resources', 1, BA_RES_PREF, 'renderTranslations');
    add_submenu_page(BA_RES_PREF, 'Resources - EN', 'Trans - EN', 2, BA_RES_PREF . '/en', 'renderTranslations');
    add_submenu_page(BA_RES_PREF, 'Resources - RU', 'Trans - RU', 2, BA_RES_PREF . '/ru', 'renderTranslations');
    add_submenu_page(BA_RES_PREF, 'Resources - AM', 'Trans - AM', 2, BA_RES_PREF . '/am', 'renderTranslations');
    add_submenu_page(BA_RES_PREF, 'Resources - Formats', 'Formats', 2, BA_RES_PREF . '/spec', 'renderTranslations');
    add_submenu_page(BA_RES_PREF, 'Resources - jqGrid', 'jqGrid', 3, BA_RES_PREF . '/jqg', 'renderTranslations');
}

function renderTranslations()
{
    $page = arg($_GET, 'page', '');
    
    if($page == BA_RES_PREF . '/jqg')
    {
        renderGrid();
        return;
    }

/*
        ?>
<textarea cols="100" rows="10">
value_title_<CategoryID>
value_content_<CategoryID>
value_<ID>__<Value>
value_<ID>
classes: content-item content-
tag: div, operators: '=' -> 'oeq', '<=' or '>=' -> 'omnomx', 'LIKE' -> 'olk'
</textarea>
        
        <br>
        <br>
        <?php
*/

    global $wpdb;
    
    $wp_query	=	'
    SELECT t.val AS total, e.val AS en, r.val AS ru, a.val AS am
    FROM
    (SELECT COUNT(*) AS val FROM `wp_translations`) t
    ,
    (SELECT COUNT(*) AS val FROM `wp_translations` WHERE (`en_EN` = "" OR `en_EN` IS NULL) AND `key` LIKE "%value_%") e
    ,
    (SELECT COUNT(*) AS val FROM `wp_translations` WHERE `ru_RU` = "" OR `ru_RU` IS NULL) r
    ,
    (SELECT COUNT(*) AS val FROM `wp_translations` WHERE `am_HY` = "" OR `am_HY` IS NULL) a
    
    ';
    $counts	=	$wpdb->get_results($wp_query);
    $counts = $counts[0];
    
    $table_name = $wpdb->prefix . "translations";
    
    $paginno = 15;
    $limit = $_POST['input_page'] * $paginno;
    
        if($_GET['spec'])
            $like = 'value_%' . $_POST['input_filter'] . '%';
        else
            $like = '%' . $_POST['input_filter'] . '%';
        
        
    if($page == BA_RES_PREF . '/en')
        $wp_query	=	'SELECT * FROM ' . $table_name . ' t WHERE (`en_EN` = "" OR `en_EN` IS NULL) AND `key` LIKE "%value_%" AND t.key LIKE "' . $like . '" ORDER BY t.id DESC LIMIT ' . $limit . ', ' . $paginno . ';';
    else
    if($page == BA_RES_PREF . '/ru')
        $wp_query	=	'SELECT * FROM ' . $table_name . ' t WHERE t.ru_RU = "" OR `ru_RU` IS NULL AND t.key LIKE "' . $like . '" ORDER BY t.id DESC LIMIT ' . $limit . ', ' . $paginno . ';';
    else
    if($page == BA_RES_PREF . '/am')
        $wp_query	=	'SELECT * FROM ' . $table_name . ' t WHERE t.am_HY = "" OR `am_HY` IS NULL AND t.key LIKE "' . $like . '" ORDER BY t.id DESC LIMIT ' . $limit . ', ' . $paginno . ';';
    else
        $wp_query	=	'SELECT * FROM ' . $table_name . ' t WHERE t.key LIKE "' . $like . '" ORDER BY t.id DESC LIMIT ' . $limit . ', ' . $paginno . ';';
    
    $transList	=	$wpdb->get_results($wp_query);


        ?>
        <div class="wrap">
        <h2>Translations list</h2>
        <h3><?php echo 'Total: ' . $counts->total . ' (not translated: EN - ' . $counts->en . ', RU - ' . $counts->ru . ', AM - ' . $counts->am . ')'; ?></h3>
    
        <form target="_self" method="post">
            <label>Search text:</label>
            <input type="text" name="input_filter" value="<?php echo batrans_replace_quotes($_POST['input_filter']) ?>">
            
            <label>Page:</label>
            <input type="text" name="input_page" value="<?php echo $_POST['input_page'] ?>">
            
            <input type="submit" value="Go">
        </form>

        <table class="widefat">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Key</th>
                    <th style="width: 60%;">en_EN \ ru_RU \ am_HY</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($transList))	{ ?>
                <tr>
                    <td colspan="7">No translations</td>
                </tr>
            <?php
        }
        else	{ ?>
<?php 			
    $class = "";
    $homesss = get_settings('home');
    $i=1;
    
    echo "<tr>";

    echo "<form taget\"_self\" method=\"post\" >";

    echo "<td><b>New</b></td>\n";						
    echo "<td><input type=\"text\" name=\"input_key\" value=\"\" class=\"editvalue\" /></td>\n";


    echo "<td><input type=\"text\" name=\"input_en_EN\" value=\"\" class=\"editvalue\" />\n";
    echo "<br /><input type=\"text\" name=\"input_ru_RU\" value=\"\" class=\"editvalue\" />\n";
    echo "<br /><input type=\"text\" name=\"input_am_HY\" value=\"\" class=\"editvalue\" /></td>\n";


    echo "<td>\n";
    echo "<input type=\"submit\" name=\"insert\" value=\"Insert\" />\n" ; //Actions
    echo "<br />";
    echo "<input type=\"reset\" name=\"clear\" value=\"Clear\" />\n" ; //Actions
    echo "</td>\n";


    echo "</form>";

    echo "</tr>";
    
    foreach($transList as $hh)	{
        echo "<tr class=\"$class\">";
        
        
        echo "<form id=\"form_" . $hh->id . "\" taget\"_self\" method=\"post\" >";
        echo "<input type=\"hidden\" name=\"input_id\" value=\"" . $hh->id . "\" class=\"editvalue\" />\n";
        
        echo "<td>" . $hh->id . "</td>\n";						
        echo "<td><input type=\"text\" name=\"input_key\" value=\"" . batrans_replace_quotes($hh->key) . "\" class=\"editvalue\" />\n";
        echo "<br /><input style=\"width: 19%;\" type=\"text\" name=\"input_tag\" value=\"" . batrans_replace_quotes($hh->tag) . "\" class=\"editvalue\" />\n";
        echo "<input style=\"width: 39%;\" type=\"text\" name=\"input_attributes\" value=\"" . batrans_replace_quotes($hh->attributes) . "\" class=\"editvalue\" />\n";
        echo "<input style=\"width: 39%;\" type=\"text\" name=\"input_classes\" value=\"" . batrans_replace_quotes($hh->classes) . "\" class=\"editvalue\" />\n";
        echo "<br /><input style=\"width: 32%;\" type=\"text\" name=\"input_filtername\" value=\"" . batrans_replace_quotes($hh->filtername) . "\" class=\"editvalue\" />\n";
        echo "<input style=\"width: 32%;\" type=\"text\" name=\"input_filtertypes\" value=\"" . batrans_replace_quotes($hh->filtertypes) . "\" class=\"editvalue\" />\n";
        echo "<input style=\"width: 32%;\" type=\"text\" name=\"input_filtervalue\" value=\"" . batrans_replace_quotes($hh->filtervalue) . "\" class=\"editvalue\" /></td>\n";
        
        echo "<td><input type=\"text\" name=\"input_en_EN\" value=\"" . batrans_replace_quotes($hh->en_EN) . "\" class=\"editvalue\" />\n";
        echo "<br /><input type=\"text\" name=\"input_ru_RU\" value=\"" . batrans_replace_quotes($hh->ru_RU) . "\" class=\"editvalue\" />\n";
        echo "<br /><input type=\"text\" name=\"input_am_HY\" value=\"" . batrans_replace_quotes($hh->am_HY) . "\" class=\"editvalue\" /></td>\n";
        
        echo "<td>\n";
        echo "<input disabled=\"disabled\" type=\"button\" name=\"send\" value=\"Send\" onclick=\"SubmitInIFrame('form_" . $hh->id . "')\" />\n" ; //Actions
        echo "<br />";
        echo "<input type=\"submit\" name=\"update\" value=\"Update\" />\n" ; //Actions
        echo "<br />";
        echo "<input type=\"submit\" name=\"delete\" value=\"Delete\" />\n" ; //Actions
        echo "</td>\n";
        
        echo "</form>";
        
        echo "</tr>";
        
        $i++;
    }
    echo "<tr>";


    echo "<form taget\"_self\" method=\"post\" >";


    echo "<td><b>New</b></td>\n";						
    echo "<td><input type=\"text\" name=\"input_key\" value=\"\" class=\"editvalue\" /></td>\n";


    echo "<td><input type=\"text\" name=\"input_en_EN\" value=\"\" class=\"editvalue\" />\n";
    echo "<br /><input type=\"text\" name=\"input_ru_RU\" value=\"\" class=\"editvalue\" />\n";
    echo "<br /><input type=\"text\" name=\"input_am_HY\" value=\"\" class=\"editvalue\" /></td>\n";


    echo "<td>\n";
    echo "<input type=\"submit\" name=\"insert\" value=\"Insert\" />\n" ; //Actions
    echo "<br />";
    echo "<input type=\"reset\" name=\"clear\" value=\"Clear\" />\n" ; //Actions
    echo "</td>\n";

    echo "</form>";

    echo "</tr>";
}
?>
            </tbody>
        </table>
        <?php //echo wppostreviewbyadmin_perpagefun($totalselpostdetails,25,$pno,$getcatlist); ?>
        <?php //echo wppostreviewbyadmin_perpagefun($totalselpostdetails,$paginno,$pno,$getcatlist); ?>		
    </div>
    
    <style>
    .editvalue
        {
            width: 100%;
        }
    input[type=text]
        {
            height: 23px;
        }
    </style>
    
<?php

echo '<br/><br/><br/><br/>';
echo $wp_query;

}

function renderGrid()
{
?>
    <link rel="stylesheet" type="text/css" media="screen" href="/wp-content/plugins/ba-includes/jqGrid/themes/basic/grid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="/wp-content/plugins/ba-includes/jqGrid/themes/jqModal.css" />
    
    <table id="rowed3"></table>
    <div id="prowed3"></div>
    <br />

    <script src="rowedex3.js" type="text/javascript">	</script>
    
    <script>
        jQuery("#43rowed3").jqGrid({
            url:'/wp-content/plugins/ba-includes/jqGrid/getdata.php?q=2',
            datatype: "json",
            colNames:['Id', 'Key', 'en_EN','ru_RU','am_HY'],
            colModel:[
                {name:'id',index:'id', width:55},
                {name:'key',index:'key', width:90, editable:true},
                {name:'en_EN',index:'en_EN', width:100,editable:true},
                {name:'ru_RU',index:'ru_RU', width:80, align:"right",editable:true},
                {name:'am_HY',index:'am_HY', width:80, align:"right",editable:true},		
            ],
            rowNum:30,
            rowList:[30,50,100],
            pager: '#p43rowed3',
            sortname: 'id',
            viewrecords: true,
            sortorder: "desc",
            editurl: "/wp-content/plugins/ba-includes/jqGrid/getdata.php",
            caption: "Using navigator"
        });
        jQuery("#43rowed3").jqGrid('navGrid',"#p43rowed3",{edit:false,add:false,del:false});
        jQuery("#43rowed3").jqGrid('inlineNav',"#p43rowed3");
    </script>


<?php

}

function batrans_install() {
    //   global $wpdb;
    //
    //   $table_name = $wpdb->prefix . "translations"; 
    //   
    //   $sql = "CREATE TABLE $table_name (
    //			  transKey mediumint(9) NOT NULL AUTO_INCREMENT,
    //			  name  varchar(30) NOT NULL,
    //			  mail varchar(128) NOT NULL,
    //			  UNIQUE KEY (transKey)
    //			);";
    //	
    //	$wpdb->query($sql);
    //
    //	add_option( 'batrans_db_version', '1.0');
    
}

function batrans_uninstall() {
    //global $wpdb;
    //
    //$table_name = $wpdb->prefix . "translations"; 
    //
    //$sql = "DROP TABLE $table_name;";
    //	
    //$wpdb->query($sql);
    //
    //delete_option( 'batrans_db_version', '1.0');
}

function batrans_insert($key, $en = '', $ru = '', $hy = '') {
    if (!batrans_keyexists($key)) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . "translations";
        $rows_affected = $wpdb->insert( $table_name, array( 'key' => $key, 'en_EN' => $en, 'ru_RU' => $ru , 'am_HY' => $hy) );
    }
}

function batrans_update($id, $key, $en = '', $ru = '', $hy = '') {
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";
    
    $rows_affected = $wpdb->update(	
        $table_name, 
        array(
                'key' => $key,
                'en_EN' => $en,
                'ru_RU' => $ru,
                'am_HY' => $hy
                ),
            array( 'id' => $id )
            );
}

function batrans_updateById($id, $text) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";
    
    $rows_affected = $wpdb->update(	
        $table_name, 
        array(
            'am_HY' => $text
                ),
            array( 'id' => $id )
            );
}

function batrans_delete($id) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";

    $wpdb->query("DELETE FROM $table_name WHERE id = $id");
}

function batrans_keyexists($key)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";

return $wpdb->get_var($wpdb->prepare("SELECT COUNT(t.key) FROM $table_name t WHERE BINARY t.key = \"%s\";", $key)) == '1';
}

function batrans_text($key)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";

    return $wpdb->get_var($wpdb->prepare("SELECT " . WPLANG . " FROM $table_name t WHERE BINARY t.key = \"%s\";", $key));
}

function batrans_id($key)
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "translations";

return $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_name t WHERE BINARY t.key = \"%s\";", $key));
}


