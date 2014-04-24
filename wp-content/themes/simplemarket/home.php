<?php
/**
 * Index main page
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */
?>
<?php get_header() ?>
<?php helper_filters(); ?>
<section class="cat-section">
<?php
if (isset($_REQUEST['pagecode'])) {
    $code = $_REQUEST['pagecode'];
    
    switch ($code) {
        case 'partners': case 'partners/':
            require_once('home-partners.php');
            break;
        case 'categories': case 'categories/':
            require_once('home-categories.php');
            break;
        default:
            require_once('home-main.php');
            break;
    }
} else {
    require_once('home-main.php');
}
?>
</section>

<?php get_footer() ?>