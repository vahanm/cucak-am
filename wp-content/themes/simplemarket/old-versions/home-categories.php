<?php

/*
$authorId = get_current_user_id();
    
if ($authorId != 0 && $authorId != 2) 
{
    global $registredSubdomains;

    $prefix = 'http://cucak.am/?author=' . $authorId;
    $hasAddress = false;

    foreach($registredSubdomains as $key => $value)
        if($value == $authorId)
        {
            $hasAddress = true;
            $prefix = 'http://' . $key . '.cucak.am/';
            break;
        }
    
    helper_cat_group_mypage();
    helper_cat_comp('mypage_home2', __('My home page'), $hasAddress ? $key . '.cucak.am' : __('.'), $prefix, '#009f6a', 'white', $authorId);
    helper_cat_comp('mypage_photos', __('My Gallery'), $hasAddress ? $key . '.cucak.am' : __('.'), $prefix . ($hasAddress ? '?' : '&') . 'page=photos', '#0060AA', 'white', $authorId);
}
*/

helper_cat_group_partners();
?>
<style>
.comp-container {
    width: 700px;
    height: 170px;
    overflow: hidden;
    display: inline-block;
}
</style>
<div style="text-align: center;">
    <div class="comp-container">
<?php



global $wpdb;

//{$wpdb->prefix}
$wp_query_string = "SELECT
                      u.ID AS `id`,
                      p.post_count AS `count`,
                      um.meta_value AS displayName
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
                        LEFT JOIN (SELECT um.user_id, um.meta_value AS hide_from_home FROM {$wpdb->prefix}usermeta um WHERE um.meta_key = 'hide_from_home') s ON s.user_id = u.ID
                    WHERE um.meta_key = 'display_name' AND (s.hide_from_home IS NULL OR s.hide_from_home != '1')
                        AND u.ID != 2 AND p.post_count > 2
                        ORDER BY post_count * RAND() DESC, p.post_count DESC
                    LIMIT 9 ; ";

$list = $wpdb->get_results($wp_query_string);


global $additionalData;
$ud = $additionalData;

$tilesCount = 0;

foreach($list as $item) {
    if (!isset($ud[$item->id])) continue;
    
    $tilesCount++;
    if ($tilesCount == 4) echo '<div style="display: none;">';
    
    //Data from array
    helper_cat_comp($ud[$item->id][0], $ud[$item->id][1], __($ud[$item->id][2]), $ud[$item->id][3], $ud[$item->id][4], $ud[$item->id][5], $item->id);
    
    //Data from DB
    //helper_cat_comp($item->id, __($item->name), __($item->description), $item->fullPath, $item->backcolor, 'white', $item->userId);
}
if ($tilesCount > 3) echo '</div>';

/*
//helper_cat_sub('Notebook2', '<font style="font-size: 120%;">Laptop LLC</font> -- ' . __('Notebooks'), 'http://laptop.cucak.am/', '#5a9f38', 'white');
// #DE00FF
helper_cat_comp('camera', 'Andranik Hambardzumyan', __('Photo / Video cameras'), 'http://andranik.cucak.am/', '#654987', 'white', 37);

helper_cat_comp('notebook2', 'Laptop Shop LLC', __('Notebooks / Netbooks'), 'http://laptopshop.cucak.am/', '#009f6a', 'white', 58);

helper_cat_comp('electronics4', 'Jin.am', __('Electronics'), 'http://cucak.am/?author=118', '#bd0611', 'white', 118);

echo '<div style="display: none;">';

helper_cat_comp('tablet', 'Proline Computers', __('Tablets / PCs'), 'http://cucak.proline.am/', '#0060AA', 'white', 106);

helper_cat_comp('clothing3', 'Nelly', __('Clothing / Accessories'), 'http://cucak.am/?author=101', '#d2006a', 'white', 101);

helper_cat_comp('lendarea', 'Complex Service', __('Land areas'), 'http://cucak.am/?author=92', '#932907', 'white', 92);

helper_cat_comp('realestate2', 'Ապրանքային Բորսա', __('Real estate'), 'http://cucak.am/?author=116', '#ec500a', 'white', 116);

helper_cat_comp('electronics4', 'Gor', __('Electronics'), 'http://cucak.am/?author=111', '#658415', 'white', 111);

helper_cat_comp('car3', 'Artur Manucharyan', __('Cars'), 'http://artur.cucak.am/', '#25a6b7', 'white', 22);

echo '</div>';
*/
?>
    <div id="showMorePartnersButton" class="show-more-button"><?php _e('Show more partners') ?></div>
    </div>
</div>
<?php

//helper_cat_group('categories', __('Categories'));
helper_cat_group_categories();

?>
<div class="main-cats">
<?php

helper_cat_big('job2', __('Vacancies'), 127, '#0A83BD', 'white');

helper_cat_small('resume', __('Resumes'), 362, '#7801b2', 'white');

helper_cat_big('service3', __('Services'), 321, '#bd0611', 'white');

helper_cat_small('event', __('Events'), 374, '#AA8800', 'white'); 

helper_cat_big('realestate2', __('Real estate'), '286,303', '#ec500a', 'white');


helper_cat_big('electronics4', __('Computers / Phones'), 322, '#287900', 'white');

helper_cat_big('photo_video_audio', __('Electronics'), '377,384,288,184,393,386,287,15', '#1D613A', 'white');

helper_cat_big('car2', __('Vehicles'), 39, '#062678', 'white');

helper_cat_big('construction_technics', __('Machinery / Devices'), '317,313', '#571622', 'white');

helper_cat_big('household6', __('Household products'), 346, '#707070', 'white');

helper_cat_small('furniture', __('Furniture'), 338, '#ae0079', 'white');

helper_cat_big('school', __('Office and School Supplies'), 324, '#E49810', 'white');


helper_cat_big('clothing3', __('Clothing / Accessories'), 340, '#D63604', 'white');

helper_cat_small('sport', __('Sport'), 343, '#358cf9', 'white');

helper_cat_small('creative', __('Creative items'), 347, '#bd0611', 'white');


helper_cat_small('souvinire3', __('Souvenirs'), 361, '#E2433D', 'white');


//helper_cat_small('Products', __('Production'), 308, '#0060AA', 'white');		

helper_cat_big('musical', __('Musical Instruments'), 341, '#935B04', 'white');

helper_cat_big('art6', __('Arts'), 342, '#941C8A', 'white');

helper_cat_big('agriculture', __('Agriculture'), '312,301', '#119C43', 'white');

helper_cat_big('manufacturing', __('Business / Production / Materials'), '337,314', '#932907', 'white');
                    //308,314

helper_cat_big('pets', __('Animals / Plants'), 339, '#065528', 'white');


helper_cat_big('child3', __('Kid products'), 379, '#25a6b7', 'white');

helper_cat_small('found', __('Found items'), 363, '#926687', 'white');

helper_cat_big('book2', __('Discs / Books'), 345, '#A5AC0F', 'white');

helper_cat_small('humor2', __('Humor'), 348, '#d2005b', 'white');

?>
</div>

<script>
<?php include 'home.js'; ?>
</script>