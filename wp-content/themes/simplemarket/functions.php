<?php
/**
 * Functions and definitions for SimpleMarket
 *
 * @package Cucak.am
 * @subpackage Template
 * @since Cucak.am 1.0
 */


add_action( 'after_setup_theme', 'simplemarket_start' );
if ( ! function_exists( 'simplemarket_start' ) ) :
function simplemarket_start() {
    // Language set up
    define('TEMPLATE_DOMAIN', 'simplemarket');
    load_theme_textdomain(TEMPLATE_DOMAIN, TEMPLATEPATH . '/languages/');
    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );
    
    // Default content-width
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 740;
    }
    
    // Set up the various actions and theme support used in this theme
    add_action( 'wp_enqueue_scripts', 'simplemarket_load_scripts' );
    add_action( 'widgets_init', 'simplemarket_widgets_init' );
    add_action( 'init', 'simplemarket_register_menus' );
    add_editor_style();
    add_theme_support('automatic-feed-links');
    //add_theme_support('post-thumbnails'); 
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'video', 'image', 'quote', 'status', 'chat' ) );
    //set_post_thumbnail_size( 400,300, true ); 
    //add_image_size( 'single-post-thumbnail', 999, 9999 );
    add_custom_background();	
    
    // set up the custom header support and sizes - this does resize
    add_custom_image_header( 'simplemarket_header_style', 'simplemarket_admin_header_style' );
    define( 'HEADER_TEXTCOLOR', '' ); 
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'simplemarket_header_image_width', 970 ) ); 
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'simplemarket_header_image_height', 150 ) ); 
    define( 'NO_HEADER_TEXT', true );
}
endif;

// Menus used in theme
if ( ! function_exists( 'simplemarket_register_menus' ) ) :
function simplemarket_register_menus() {
    register_nav_menu('top_menu', __('Top Menu', TEMPLATE_DOMAIN));
    register_nav_menu('login_menu', __('Login/Logout Menu', TEMPLATE_DOMAIN));
    register_nav_menu('left_menu', __('Left Menu', TEMPLATE_DOMAIN));
    
    register_nav_menu('addnew_menu', 'Add new');
    
    
    register_nav_menu('cat_menu_127', 'Jobs Menu');
    register_nav_menu('cat_menu_321', 'Services');
}
endif;

// Header set up
if ( ! function_exists( 'simplemarket_header_setup' ) ) :
function simplemarket_header_style(){
    ?>
    <style type="text/css">
       #header-image{
                margin:0 0 1em 0;
            }
    </style>
    <?php
}
endif;

// Header admin set up
if ( ! function_exists( 'simplemarket_admin_header_style' ) ) :
    function simplemarket_admin_header_style(){
?>
    <style type="text/css">
        #headimg {
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
    </style>
    <?php
}
endif;

// Set up the other bits of the scripts - includes modernizr custom build for respond.js and also html5 shim along with some over fall back scripts.
// Also loads the google fonts we use which are Droid Sans and Nunito
if ( ! function_exists( 'simplemarket_load_scripts' ) ) :
    function simplemarket_load_scripts() {
    if ( !is_admin() ) { 
        //wp_enqueue_script("jquery");
        //wp_enqueue_script('modernizr', get_template_directory_uri() . '/scripts/modernizr.js', array("jquery"), '2.0');
        
        //wp_enqueue_script('jquery-new', '/wp-includes/js/jquery.1.8.21/jquery-1.7.2.min.js', '1.7.2');
        //wp_enqueue_script('jquery-ui', '/wp-includes/js/jquery.1.8.21/jquery-ui-1.8.21.custom.min.js', '1.8.21');
        //wp_enqueue_script('jquery.ui.selectmenu', '/wp-includes/js/jquery.1.8.21/ui/jquery.ui.selectmenu.js', '1.0');
        //wp_enqueue_script('jquery.scrollto', '/wp-includes/js/jquery.1.8.21/ui/minified/jquery.scrollto.min.js', '1.0');
        
        wp_enqueue_style('simplemarket_droidsans', 'http://fonts.googleapis.com/css?family=Droid+Sans');
        wp_enqueue_style('simplemarket_nunito', 'http://fonts.googleapis.com/css?family=Nunito&v1');
        
?>
        <?php	
        if ( is_singular() && get_option( 'thread_comments' ) && comments_open() )
            wp_enqueue_script( 'comment-reply' );
    }
}
endif;

// Widgets - there is only one area currently
if ( ! function_exists( 'simplemarket_widgets_init' ) ) :
    function simplemarket_widgets_init() {
    register_sidebar(
        array(
                'name'          => __( 'Sidebar', TEMPLATE_DOMAIN ),
                'id'            => 'sidebar',
                'description'   => 'Sidebar',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">', 	  
                'after_widget' => '</aside>',
                'before_title' => '<h3 class="widgettitle">',
                'after_title' => '</h3>'
                )
            );
}
endif;

// Show home in menu
function simplemarket_home_menu($args) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'simplemarket_home_menu' );

// Custom comment format
if ( ! function_exists( 'simplemarket_comment' ) ) :
    function simplemarket_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
    case 'pingback'  :
    case 'trackback' :
?>
    <li class="comment-pingback">
        <p><?php _e( 'Pingback:', TEMPLATE_DOMAIN); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', TEMPLATE_DOMAIN), ' ' ); ?></p>
        <?php break; default:
        ?>
    
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>">
            <header class="comment-header">
                <div class="comment-author vcard">
                    <?php echo get_avatar( $comment, 40 ); ?>
                </div>
                        <div class="comment-reply">
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div>
                        <div class="comment-edit">
                            <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                        </div>
        <div class="comment-meta">
                <?php printf( __( '%s ', TEMPLATE_DOMAIN), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>

                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                printf( __( '%1$s at %2$s', TEMPLATE_DOMAIN ), get_comment_date(),  get_comment_time() ); ?></a>
            
        </div>
        </header>	
        <div class="comment-body">
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', TEMPLATE_DOMAIN); ?></em>
                <?php endif; ?>
            <?php comment_text(); ?>
        </div>
            <div class="clear"></div>
    </article>

    <?php break;
endswitch;
}
endif;

// Footer links
if ( ! function_exists( 'simplemarket_footerlinks' ) ) :
    function simplemarket_footerlinks(){
    if(is_author()) {
    ?>
    <a href="http://cucak.am/"><?php _e( 'Powered by', TEMPLATE_DOMAIN ) ?> <?php bloginfo('name'); ?></a>
    <?php
    } else {
    ?>
    <a href="http://cucak.am/"><?php _e( 'Copyright', TEMPLATE_DOMAIN ) ?> &copy; 2012-<?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?></a>
    <?php
    }
    /*
    ?>
    <a href="#site-wrapper"><?php _e('Go back to top &uarr;', TEMPLATE_DOMAIN); ?></a>
    <?php
    */
}
endif;

// Theme pagination
if ( ! function_exists( 'simplemarket_pagination' ) ) :
    function simplemarket_pagination($pages = '', $range = 4)
{
    global $wp_query;
    
    if ( isset($_GET['paged']) )
        $current = $_GET['paged'];
    else
        $current = 1;
    
    $format = '';
    
    foreach($_GET as $key => $value)
    {
        if($format)
            $format .= '&';
        else
            $format .= '?';
        
        if($key != 'paged')
        {
            $format .= $key;
            
            if(strlen($value))
                $format .= '=' . $value;
        }
    }
    
    $base = '/' . $format . '%_%';
    
    if($format)
        $format .= '&';
    else
        $format .= '?';
    $format .= 'paged=%#%';
    
    if($format)
        $format = '&paged=%#%';
    else
        $format = '?paged=%#%';
    
    $args = array(
        //'base'         => '/%_%',
        //'format'       => '?paged=%#%',
        'base'         => $base,
        'format'       => $format,
        'total'        => $wp_query->max_num_pages,
        'current'      => $current,
        'show_all'     => False,
        'end_size'     => 1,
        'mid_size'     => 2,
        'prev_next'    => false,
        'prev_text'    => __('&laquo; Previous'),
        'next_text'    => __('Next &raquo;'),
        'type'         => 'plain',
        'add_args'     => False,
        'add_fragment' =>  ''
        );
    /*
                <div class="pagination-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', TEMPLATE_DOMAIN) ); ?></div>
                <div class="pagination-previous"><?php echo paginate_links( $args ); ?></div>
                <div class="pagination-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN) ); ?></div>
    */
    
if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav class="pagination">
            <div class="pagination-next"><?php previous_posts_link( __( 'Next Page', TEMPLATE_DOMAIN) ); ?></div>
            <div class="pagination-numbers"><?php echo paginate_links( $args ); ?></div>
            <div class="pagination-previous"><?php next_posts_link( __( 'Previous Page', TEMPLATE_DOMAIN) ); ?></div>
        </nav>
    <?php endif;
    }
    endif;

// If using MarketPress plugin then remove the default style as built in styling
if ( class_exists( 'MarketPress' ) ) {
    global $mp;
    remove_action( 'template_redirect', array(&$mp, 'load_store_theme') );
}

function simplemarket_fallback_menu() {
    echo '<ul class="topmenu">';
    wp_list_pages('sort_column=menu_order&title_li=');
    echo '</ul>';
};

function addpostsuccess()
{
?>
<div class='addpostsuccess'>
    <p><?php _e('Your advertisement has posted successfully.') ?></p>
    <div>
        <a href="<?php echo getEditLink($_POST['success'], $_POST['post'], $_POST['key']) ?>"><?php _e('Edit the announcement') ?></a>
    </div>
</div>
<?php
}

function getEditLink($cat, $post, $key) {
    return BA_HOME . "/addnew/?type=$cat&editpost=$post&editkey=$key"; //site_url("/addnew/?type=$cat&editpost=$post&editkey=$key");
}

function getModifyLink($cat, $post, $key) {
    return BA_HOME . "/addnew/?type=$cat&modifypost=$post&editkey=$key"; //site_url("/addnew/?type=$cat&editpost=$post&editkey=$key");
}

function getCopyLink($cat, $post) {
    return BA_HOME . "/addnew/?type=$cat&copypost=$post"; //site_url("/addnew/?type=$cat&copypost=$post");
}

function simplemarket_viewmodes_test() { ?>
<div style="width: 100%; float: right; text-align: right;">
    <table id="viewmode-controls" style="width: auto; float: right; border: 1px solid #ddd; margin-bottom: 10px;">
        <tr>
            <td style="text-align: center; background-color: #f4f9ff; border-bottom: 1px solid #eee;">
                <?php _e('View mode') ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px 3px 2px 6px;">
                <div id="viewmode-list" class="content-silver content-filter"><?php _e('List') ?></div>
                <div id="viewmode-tiles" class="content-orange content-filter"><?php _e('Tiles') ?></div>
                <div id="viewmode-thumbnails" class="content-silver content-filter"><?php _e('Thumbnails') ?></div>
            </td>
        </tr>
    </table>
    <table id="currency-controls" style="width: auto; float: left; border: 1px solid #ddd; margin-bottom: 10px; margin-left: 5px;">
        <tr>
            <td style="text-align: center; background-color: #f4f9ff; border-bottom: 1px solid #eee;">
                <?php _e('Currency') ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px 3px 2px 6px;">
                <div id="currency-original" class="content-orange content-filter"><?php _e('currency_Original') ?></div>
                <div id="currency-amd" class="content-silver content-filter"><?php _e('currency_AMD') ?></div>
                <div id="currency-usd" class="content-silver content-filter"><?php _e('currency_USD') ?></div>
                <div id="currency-eur" class="content-silver content-filter"><?php _e('currency_EUR') ?></div>
                <div id="currency-rur" class="content-silver content-filter"><?php _e('currency_RUR') ?></div>
            </td>
        </tr>
    </table>
</div>
<script>
function SetCurrintCurrency(e) {
    $('#currency-controls div.content-filter')
        .addClass('content-silver')
        .removeClass('content-orange');
    
    $(e)
        .toggleClass('content-silver content-orange');
        
    $.cookie('currency', $(e).attr('id'), { expires: 1000, path: '/', domain: 'cucak.am' });
}

function SetCurrintViewMode(e) {
    $('#viewmode-controls div.content-filter')
        .addClass('content-silver')
        .removeClass('content-orange');
    
    $(e)
        .toggleClass('content-silver content-orange');
        
    $.cookie('viewmode', $(e).attr('id'), { expires: 1000, path: '/', domain: 'cucak.am' });
}

$(document).ready(function() {
    $('#content article').css('float', 'left');
    
    $('#viewmode-list').click(changeviewmodeList);
    $('#viewmode-tiles').click(changeviewmodeTiles);
    $('#viewmode-thumbnails').click(changeviewmodeThumbnails);
    
    $('#currency-original').click(changeCurrencyToOriginal);
    $('#currency-amd').click(changeCurrencyToAMD);
    $('#currency-usd').click(changeCurrencyToUSD);
    $('#currency-rur').click(changeCurrencyToRUR);
    $('#currency-eur').click(changeCurrencyToEUR);
    
    var id = $.cookie('viewmode');
    if (id)
        if (id.length > 0 && id != 'viewmode-tiles')
            $('#' + id).trigger('click');
    
    var id = $.cookie('currency');
    if (id)
        if (id.length > 0 && id != 'currency-original')
            $('#' + id).trigger('click');
});

function changeCurrencyToAMD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-AMD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToUSD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-USD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToRUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-RUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToEUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-EUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToOriginal() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').show();

    SetCurrintCurrency(this);
}

function changeviewmodeList() {
    $('#content article').animate({
                                    width: '100%',
                                    height: '57',
                                    margin: 0,
                                    'border-bottom-width': 0
                                    }, 500, function() {
                                        // Animation complete.
                                        $('#content article').css('height', 'auto');
                                    });
    $('#content article .post-summary').slideUp();
    $('#content article .transaction-icon').fadeOut();
    $('#content article .post-meta').slideDown();
    
    //thumbnail   /////
    $('#content article .thumbnail').animate({
                                    //opacity: 0.25,
                                    //left: '+=50',
                                    height: 55,
                                    width: 55
                                    }, 500, function() {
                                    // Animation complete.
                                    });
                                    
    $('#content article .thumbnail.t120x120')
                                .fadeOut('slow');
    $('#content article .thumbnail.t230x120')
                                .fadeOut('slow');
    $('#content article .thumbnail.t55x55')
                                .fadeIn('slow');
    ///////////////////
    
    $('#content article .post-titles').animate({
                                    width: 630 //672
                                    }, 500, function() {
                                    // Animation complete.
                                    });
    
    $('#content article .post-title').animate({
                                    'font-size': '140%'
                                    }, 500, function() {
                                    // Animation complete.
                                    });

    SetCurrintViewMode(this);
}



function changeviewmodeTiles() {
    $('#content article').animate({
                                    width: '100%',
                                    height: '142',
                                    margin: 0,
                                    'border-bottom-width': 0
                                    }, 500, function() {
                                        // Animation complete.
                                        $('#content article').css('height', 'auto');
                                    });
    $('#content article .post-summary').slideDown();
    $('#content article .transaction-icon').fadeIn();
    $('#content article .post-meta').slideDown();
    
    //thumbnail   /////
    $('#content article .thumbnail').animate({
                                    //opacity: 0.25,
                                    //left: '+=50',
                                    height: 120,
                                    width: 120
                                    }, 500, function() {
                                    // Animation complete.
                                    });
                                    
    $('#content article .thumbnail.t55x55')
                                .fadeOut('slow');
    $('#content article .thumbnail.t230x120')
                                .fadeOut('slow');
    $('#content article .thumbnail.t120x120')
                                .fadeIn('slow');
    ///////////////////
    
    $('#content article .post-titles').animate({
                                    width: 565 //606
                                    }, 500, function() {
                                    // Animation complete.
                                    });
    $('#content article .post-title').animate({
                                    'font-size': '140%'
                                    }, 500, function() {
                                    // Animation complete.
                                    });
    
    SetCurrintViewMode(this);
}




function changeviewmodeThumbnails() {
    $('#content article').animate({
                                    width: 217, //'31%'
                                    height: 200,
                                    margin: 4,
                                    'border-bottom-width': 1
                                    }, 500, function() {
                                    // Animation complete.
                                    });
    $('#content article .post-summary').slideUp();
    $('#content article .transaction-icon').fadeIn();
    $('#content article .post-meta').slideUp();
    
    //thumbnail   /////
    $('#content article .thumbnail').animate({
                                    //opacity: 0.25,
                                    //left: '+=50',
                                    height: 120,
                                    width: 215 //230
                                    }, 500, function() {
                                    // Animation complete.
                                    });
                                    
    $('#content article .thumbnail.t55x55')
                                .fadeOut('slow');
    $('#content article .thumbnail.t120x120')
                                .fadeOut('slow');
    $('#content article .thumbnail.t230x120')
                                .fadeIn('slow');
    ///////////////////
    
    $('#content article .post-titles').animate({
                                    width: 217 //234
                                    }, 500, function() {
                                    // Animation complete.
                                    });
    
    $('#content article .post-title').animate({
                                    'font-size': '100%'
                                    }, 500, function() {
                                    // Animation complete.
                                    });
                                    
    SetCurrintViewMode(this);
}
</script>
<?php
}

function simplemarket_viewmodes_class() {
    $viewmode = arg($_COOKIE, 'viewmode', 'viewmode-tiles');
    
    switch($viewmode) {
        case 'viewmode-list':
            return 'view-mode-list';
        case 'viewmode-thumbnails':
            return 'view-mode-thumbnails';
        case 'viewmode-tiles': default:
            return 'view-mode-tiles';
    }
}

function simplemarket_viewmodes() {
    $viewmode_class = simplemarket_viewmodes_class();
?>
<div class="view-modes">
    <div class="viewmode-controls">
        <div id="viewmode-list" class="viewmode-button viewmode-button-list <?php if ($viewmode_class == 'view-mode-list') echo 'viewmode-button-active'?>" title="<?php _e('List') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/list.png') ?>" />
        </div>
        <div id="viewmode-tiles" class="viewmode-button viewmode-button-tiles <?php if ($viewmode_class == 'view-mode-tiles') echo 'viewmode-button-active'?>" title="<?php _e('Tiles') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/tiles.png') ?>" />
        </div>
        <div id="viewmode-thumbnails" class="viewmode-button viewmode-button-thumbnails <?php if ($viewmode_class == 'view-mode-thumbnails') echo 'viewmode-button-active'?>" title="<?php _e('Thumbnails') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/thumbs.png') ?>" />
        </div>
    </div>
    <div class="currency-controls">
        <div id="currency-original" class="viewmode-button viewmode-button-active" title="<?php _e('currency_Original') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-source.png') ?>" />
        </div>
        <div id="currency-amd" class="viewmode-button" title="<?php _e('currency_AMD') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-amd.png') ?>" />
        </div>
        <div id="currency-usd" class="viewmode-button" title="<?php _e('currency_USD') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-usd.png') ?>" />
        </div>
        <div id="currency-eur" class="viewmode-button" title="<?php _e('currency_EUR') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-eur.png') ?>" />
        </div>
        <div id="currency-rur" class="viewmode-button" title="<?php _e('currency_RUR') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-rur.png') ?>" />
        </div>
    </div>
</div>
<script>
function SetCurrintCurrency(e) {
    $('.currency-controls .viewmode-button').removeClass('viewmode-button-active');
    $(e).addClass('viewmode-button-active');
    $.cookie('currency', $(e).attr('id'), { expires: 1000, path: '/', domain: getHost() });
}

function SetCurrintViewMode(e) {
    $('.viewmode-controls .viewmode-button').removeClass('viewmode-button-active');
    $(e).addClass('viewmode-button-active');
    $.cookie('viewmode', $(e).attr('id'), { expires: 1000, path: '/', domain: getHost() });
}

$(document).ready(function() {
    $('#viewmode-list').click(changeviewmodeList);
    $('#viewmode-tiles').click(changeviewmodeTiles);
    $('#viewmode-thumbnails').click(changeviewmodeThumbnails);
    
    $('#currency-original').click(changeCurrencyToOriginal);
    $('#currency-amd').click(changeCurrencyToAMD);
    $('#currency-usd').click(changeCurrencyToUSD);
    $('#currency-rur').click(changeCurrencyToRUR);
    $('#currency-eur').click(changeCurrencyToEUR);
    
    //var id = $.cookie('viewmode');
    //if (id)
    //    if (id.length > 0 && id != 'viewmode-tiles')
    //        $('#' + id).trigger('click');
    
    var id = $.cookie('currency');
    if (id)
        if (id.length > 0 && id != 'currency-original')
            $('#' + id).trigger('click');
});

function changeCurrencyToAMD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-AMD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToUSD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-USD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToRUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-RUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToEUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-EUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToOriginal() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').show();

    SetCurrintCurrency(this);
}

function changeviewmodeList() {
    $('#content article').removeClass('view-mode-thumbnails view-mode-tiles').addClass('view-mode-list');    

    SetCurrintViewMode(this);
}

function changeviewmodeTiles() {
    $('#content article').removeClass('view-mode-list view-mode-thumbnails').addClass('view-mode-tiles');
    
    SetCurrintViewMode(this);
}

function changeviewmodeThumbnails() {
    $('#content article').removeClass('view-mode-list view-mode-tiles').addClass('view-mode-thumbnails');

    SetCurrintViewMode(this);
}
</script>
<?php
}

function simplemarket_viewmodes_test2()
{
    if (WP_TEST) return simplemarket_viewmodes_test2();
?>
<div style="width: 100%; float: right; text-align: right;">
    <div class="viewmode-controls">
        <div id="viewmode-list" class="viewmode-button viewmode-button-list" title="<?php _e('List') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/list.png') ?>" />
        </div>
        <div id="viewmode-tiles" class="viewmode-button viewmode-button-active viewmode-button-tiles" title="<?php _e('Tiles') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/tiles.png') ?>" />
        </div>
        <div id="viewmode-thumbnails" class="viewmode-button viewmode-button-thumbnails" title="<?php _e('Thumbnails') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/thumbs.png') ?>" />
        </div>
    </div>
    <div class="currency-controls">
        <div id="currency-original" class="viewmode-button viewmode-button-active" title="<?php _e('currency_Original') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-source.png') ?>" />
        </div>
        <div id="currency-amd" class="viewmode-button" title="<?php _e('currency_AMD') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-amd.png') ?>" />
        </div>
        <div id="currency-usd" class="viewmode-button" title="<?php _e('currency_USD') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-usd.png') ?>" />
        </div>
        <div id="currency-eur" class="viewmode-button" title="<?php _e('currency_EUR') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-eur.png') ?>" />
        </div>
        <div id="currency-rur" class="viewmode-button" title="<?php _e('currency_RUR') ?>">
            <img src="<?php echo site_url('/wp-includes/images/special-icons/view-modes/currency-rur.png') ?>" />
        </div>
    </div>
</div>
<script>
function SetCurrintCurrency(e) {
    $('.currency-controls .viewmode-button').removeClass('viewmode-button-active');
    $(e).addClass('viewmode-button-active');
    $.cookie('currency', $(e).attr('id'), { expires: 1000, path: '/', domain: 'cucak.am' });
}

function SetCurrintViewMode(e) {
    $('.viewmode-controls .viewmode-button').removeClass('viewmode-button-active');
    $(e).addClass('viewmode-button-active');
    $.cookie('viewmode', $(e).attr('id'), { expires: 1000, path: '/', domain: 'cucak.am' });
}

$(document).ready(function() {
    $('#content article').css('float', 'left');
    
    $('#viewmode-list').click(changeviewmodeList);
    $('#viewmode-tiles').click(changeviewmodeTiles);
    $('#viewmode-thumbnails').click(changeviewmodeThumbnails);
    
    $('#currency-original').click(changeCurrencyToOriginal);
    $('#currency-amd').click(changeCurrencyToAMD);
    $('#currency-usd').click(changeCurrencyToUSD);
    $('#currency-rur').click(changeCurrencyToRUR);
    $('#currency-eur').click(changeCurrencyToEUR);
    
    var id = $.cookie('viewmode');
    if (id)
        if (id.length > 0 && id != 'viewmode-tiles')
            $('#' + id).trigger('click');
    
    var id = $.cookie('currency');
    if (id)
        if (id.length > 0 && id != 'currency-original')
            $('#' + id).trigger('click');
});

function changeCurrencyToAMD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-AMD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToUSD() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-USD').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToRUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-RUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToEUR() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').hide();
    
    $('span.conversions span.cur-EUR').show();

    SetCurrintCurrency(this);
}

function changeCurrencyToOriginal() {
    $('span.conversions span.conversion').hide();
    $('span.conversions span.original').show();

    SetCurrintCurrency(this);
}

function changeviewmodeList() {
    $('#content article').css({ width: '100%', height: 'auto', margin: 0, 'border-bottom-width': 0 });
    $('#content article .post-summary').hide();
    $('#content article .transaction-icon').hide();
    $('#content article .post-meta').show();
    
    //thumbnail   /////
    $('#content article .thumbnail').css({ height: 55, width: 55 });
    $('#content article .thumbnail.t120x120').hide();
    $('#content article .thumbnail.t230x120').hide();
    $('#content article .thumbnail.t55x55').show();
    ///////////////////
    
    $('#content article.format-standard .post-titles').css({ width: 630 });
    $('#content article.format-gallery .post-titles').css({ width: 700 });
    
    $('#content article .post-title').css({ 'font-size': '140%' }).addClass('post-title-list');

    SetCurrintViewMode(this);
}

function changeviewmodeTiles() {
    $('#content article').css({ width: '100%', height: 'auto', margin: 0, 'border-bottom-width': 0,  });
    $('#content article .post-summary').show();
    $('#content article .transaction-icon').show();
    $('#content article .post-meta').show();
    
    //thumbnail   /////
    $('#content article .thumbnail').css({ height: 120, width: 120 });
    $('#content article .thumbnail.t55x55').hide();
    $('#content article .thumbnail.t230x120').hide();
    $('#content article .thumbnail.t120x120').show();
    ///////////////////
    
    $('#content article .post-titles').css({ width: 565 });
    $('#content article.format-gallery .post-titles').css({ width: 700 });
    
    $('#content article .post-title').css({ 'font-size': '140%' }).addClass('post-title-list');
    
    SetCurrintViewMode(this);
}

function changeviewmodeThumbnails() {
    $('#content article').css({ width: 217, height: 200, margin: 4, 'border-bottom-width': 1 });
    $('#content article .post-summary').hide();
    $('#content article .transaction-icon').hide();
    $('#content article .post-meta').hide();
    
    //thumbnail   /////
    $('#content article .thumbnail').css({ height: 120, width: 215 });
    $('#content article .thumbnail.t55x55').hide();
    $('#content article .thumbnail.t120x120').hide();
    $('#content article .thumbnail.t230x120').show();
    ///////////////////
    
    $('#content article .post-titles').css({ width: 217 });
    $('#content article .post-title').css({ 'font-size': '100%' }).removeClass('post-title-list');

    SetCurrintViewMode(this);
}
</script>
<?php
}


add_filter('wp_title', 'generate_wp_title', 100, 2);
function generate_wp_title($original, $sep, $seplocation) {
    global $wpdb, $wp_locale;

    $m = get_query_var('m');
    $year = get_query_var('year');
    $monthnum = get_query_var('monthnum');
    $day = get_query_var('day');
    $search = get_query_var('s');
    $title = '';

    $t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

    // If there is a post
    if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
        $title = single_post_title( '', false );
    }

    // If there's a category or tag
    if ( is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    }

    // If there's a taxonomy
    if ( is_tax() ) {
        $term = get_queried_object();
        $tax = get_taxonomy( $term->taxonomy );
        $title = single_term_title( $tax->labels->name . $t_sep, false );
    }

    // If there's an author
    //if ( is_author() ) {
    //	$author = get_queried_object();
    //	$title = $author->display_name;
    //}

    // If there's a post type archive
    if ( is_post_type_archive() )
        $title = post_type_archive_title( '', false );

    // If there's a month
    if ( is_archive() && !empty($m) ) {
        $my_year = substr($m, 0, 4);
        $my_month = $wp_locale->get_month(substr($m, 4, 2));
        $my_day = intval(substr($m, 6, 2));
        $title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
    }

    // If there's a year
    if ( is_archive() && !empty($year) ) {
        $title = $year;
        if ( !empty($monthnum) )
            $title .= $t_sep . $wp_locale->get_month($monthnum);
        if ( !empty($day) )
            $title .= $t_sep . zeroise($day, 2);
    }

    // If it's a search
    if ( is_search() ) {
        /* translators: 1: separator, 2: search phrase */
        $title = sprintf(__('Search Results %1$s %2$s'), $t_sep, strip_tags($search));
    }

    // If it's a 404 page
    if ( is_404() ) {
        if( ( (isset($_GET['trashed']) && $_GET['trashed'] == '1') || (isset($_GET['trashed']) && $_GET['trashed'] == '1') ) && (isset($_GET['p']) && $_GET['p'] != '')) {
            $title = __( 'Announcement is deleted');
        } else {
            $title = __('Page not found');
        }
    }
    
    

    ################################################################################
    
    
    
    
    
    
    //echo '<DUMP>', $a, "\n", $b, "\n", $c, "\n", '</DUMP>';
    //return $a;
    $is_post = isset($_GET['p']);
    $is_cat  = isset($_GET['cat']);
    $is_author = isset($_GET['author']);
    $is_paged = isset($_GET['paged']);
    $is_page = isset($_GET['page']);
    
    
    //if (!$is_post && $is_cat) {
    //    if ($is_author) {
    //        $cat = get_the_category(); //get_category($_GET['cat']);
    //        if (is_array($cat) && count($cat) > 0) {
    //            $cat = $cat[0];
    //        }
    //        $title = join_title($title, $cat->name, $t_sep);
    //    }
    //}
    
    //if ($is_paged) {
    //    $page = $GET_['paged'];
    //    if (is_numeric($page) && ($page = intvel($page)) > 1) {
    //        $page = _f('page %s', $page);
    //        $title .= "($page) $t_sep ";
    //    }
    //}
    if ($is_author) {
        $authorId = arg($_GET, 'author', 0);
        if($authorId > 0) {
            $name = get_user_meta($authorId, 'display_name', true);
            if (strlen($name) > 0) {
                $title = join_title($title, $name, $t_sep);
            }
        }
    }

    ################################################################################

    global $page, $paged, $isSocial;

    if ( $paged >= 2 || $page >= 2 ) {
        $title = join_title($title, sprintf( __( 'Page %s', TEMPLATE_DOMAIN), max( $paged, $page ) ), $t_sep);
    }

    if (BA_IS_MAIN_DOMAIN) {
        $title = join_title($title, get_bloginfo('name'), $t_sep);
    
        $site_description = get_bloginfo( 'description', 'display' );
        if ( !( $paged >= 2 || $page >= 2 ) && $site_description && ( is_home() /*|| is_front_page()*/ ) ) {
            $title = join_title($title, __($site_description), $t_sep);
        }
    }

    ################################################################################

    //$prefix = '';
    //if ( !empty($title) )
    //	$prefix = " $sep ";

    // Determines position of the separator and direction of the breadcrumb
    if ( 'right' == $seplocation ) { // sep on right, so reverse the order
        $title_array = explode( $t_sep, $title );
        $title_array = array_reverse( $title_array );
        $title = implode( " $sep ", $title_array ) . $prefix;
    } else {
        $title_array = explode( $t_sep, $title );
        $title = $prefix . implode( " $sep ", $title_array );
    }
    
    return $title;
}

function join_title($title, $value, $separator) {
    $result = trim($title /*, array(" ", "\t", "\n", "\r", "\0", "\x0B", $separator) */);
    $value = trim($value);
    
    if ($value != '') {
        if ($result != '') {
            $result .= $separator;
        }
        
        $result .= $value;
    }
    
    return str_replace($separator . $separator, $separator, $result);
}

add_filter('the_title', 'generate_title', 100, 2);
function generate_title($title, $id) {
    if(get_post_type( $id ) == 'post') {
        $format =  get_title_formated(_v('cat'), $id);
    
        if ($format) {
            return $format;
        } else {
            return $title;
        }
    } else {
        return $title;
    }
}


add_filter('single_post_title', 'generate_single_title', 100, 2);
function generate_single_title($title, $post) {
    if($post->post_type == 'post') {
        $format =  get_title_formated(_v('cat'), $post->ID);
    
        if ($format) {
            return $format;
        } else {
            return $title;
        }
    } else {
        return $title;
    }
}



add_filter('single_cat_title', 'generate_single_cat_title', 100, 1);
function generate_single_cat_title($name) {
    return __($name);
}

/*
add_filter('wp_head', 'redirect_admin');
function redirect_admin(){
    //if (is_admin() && !current_user_can('level_10')) {
        wp_redirect(WP_HOME . '/');
        die; // You have to die here
    //}
}

*/

add_filter('wp_mail_charset', 'set_mail_charset');
function set_mail_charset() {
    return 'UTF-8';
}

add_filter('wp_mail_content_type', 'set_mail_content_type');
function set_mail_content_type() {
    return 'text/html';
}



add_filter('wp_mail_from', 'set_mail_from');
function set_mail_from() {
    return 'support@cucak.am';
}

add_filter('wp_mail_from_name', 'set_mail_from_name');
function set_mail_from_name() {
    return __('cucak.am Support team');
}

add_action( 'phpmailer_init', 'edit_phpmailer', 10, 1 );
function edit_phpmailer($phpmailer){
    $phpmailer->IsSMTP();
    $phpmailer->Host = 'mail.cucak.am';
    
    $phpmailer->LE = "\r\n";
    
    $phpmailer->Username = 'support@cucak.am';
    $phpmailer->Password = 'Chimacaq.00';
    $phpmailer->SMTPAuth = true;
    $phpmailer->ContentType = 'text/html';
}

add_filter('option_home', 'get_option_home');
function get_option_home($original) {
    $key = getAuthorKey();
    
    if($key)
        return 'http://' . $key; // . '.cucak.am';
    else
        return 'http://' . $_SERVER['HTTP_HOST'];
        
    return $original;
    //$key = author_url();
    
    //if($key)
    //    return $key;
    //else
    //    return 'http://' . $_SERVER['HTTP_HOST'];
}


add_filter('option_siteurl', 'get_option_siteurl');
function get_option_siteurl($original) {
    $key = getAuthorKey();
    
    if($key)
        return 'http://' . $key; // . '.cucak.am';
    else
        return 'http://' . $_SERVER['HTTP_HOST'];
        
    return $original;
    //$key = author_url();
    
    //if($key)
    //    return $key;
    //else
    //    return 'http://' . $_SERVER['HTTP_HOST'];
}

function usage() {
    printf(('%d / %s'), get_num_queries(), timer_stop(0, 3));
                if ( function_exists('memory_get_usage') )
                    echo ' / ' . round(memory_get_usage()/1024/1024, 2) . 'mb';
}
add_action('admin_footer_text', 'usage');







function print_social_details() {
    echo '<meta property="og:url" content="', curPageURL(), '" />', "\n";
    echo '<meta property="og:title" content="', wp_title( ' - ', false, 'right' ), '" />', "\n";
    
    
    if (is_single()) {
        render_post_meta_for_facebook();
    } else {
        echo '<meta property="og:description" content="', ' ', '" />', "\n";
        //echo '<meta property="og:updated_time" content="', ' ', '" />', "\n";
    }
    
    echo '<meta property="og:image" content="', site_url('/wp-admin/images/logo-share-big.png'), '" />', "\n";    
}

