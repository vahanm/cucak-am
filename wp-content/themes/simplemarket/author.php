<?php
/**
 * Author page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */

get_header();

if ( have_posts() ) the_post();

$authorId = arg($_GET, 'author', 0);
$name = get_user_meta($authorId, 'display_name', true);
$name = (strlen($name) > 0) ? $name : __('Unknown author');

$user_header_image = get_user_meta($authorId, 'header_image', true);

if($user_header_image)
    $user_header_image = json_decode(replace_quotes_decode($user_header_image));

if($user_header_image)
    $user_header_image = $user_header_image->standards_url;

$page = arg($_GET, 'page', 0);

//switch ($page)
//{
//    case 'photos': case 'about': case 'info': case 'contacts':
//        break;
//    default:
//        $page = 'home';
//}

global $registredSubdomains;

$prefix = site_url('/?author=' . $authorId);
$hasAddress = false;

foreach($registredSubdomains as $key => $value) {
    if($value == $authorId) {
        $hasAddress = true;
        $prefix = 'http://' . $key; // . '.cucak.am/';
    }
}

echo '<section id="content" role="main">';

if($page == 'home' || !getBaForm($authorId, $page, '', '', 'authors')) {
    helper_filters();

    simplemarket_viewmodes();

    rewind_posts();
        
    while ( have_posts() ) {
        the_post();
        get_template_part( 'content', get_post_format() );
    }
        
    simplemarket_pagination();
}

echo '</section>';

get_sidebar();
get_footer();