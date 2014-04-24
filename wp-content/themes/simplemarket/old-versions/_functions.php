<?php
/**
 * Functions and definitions for SimpleMarket
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
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
	add_theme_support('post-thumbnails'); 
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'video', 'image', 'quote', 'status', 'chat' ) );
	set_post_thumbnail_size( 400,300, true ); 
	add_image_size( 'single-post-thumbnail', 999, 9999 );
	add_custom_background();	
	
	// set up the custom header support and sizes - this does resize
	add_custom_image_header( 'simplemarket_header_style', 'simplemarket_admin_header_style' );
	define( 'HEADER_TEXTCOLOR', '' ); 
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'simplemarket_header_image_width', 1102 ) ); 
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'simplemarket_header_image_height', 350 ) ); 
	define( 'NO_HEADER_TEXT', true );
}
endif;

// Menus used in theme
if ( ! function_exists( 'simplemarket_register_menus' ) ) :
function simplemarket_register_menus() {
	register_nav_menu('top_menu', __('Top Menu', TEMPLATE_DOMAIN));
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
		wp_enqueue_script("jquery");
		//wp_enqueue_script('modernizr', get_template_directory_uri() . '/scripts/modernizr.js', array("jquery"), '2.0');
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
	?>
	<a href="<?php echo home_url(); ?>"><?php _e( 'Copyright', TEMPLATE_DOMAIN ) ?> &copy;<?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?></a><a href="#site-wrapper"><?php _e('Go back to top &uarr;', TEMPLATE_DOMAIN); ?></a>
	<?php
}
endif;

// Theme pagination
if ( ! function_exists( 'simplemarket_pagination' ) ) :
function simplemarket_pagination($pages = '', $range = 4)
{
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="pagination">
			<div class="pagination-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', TEMPLATE_DOMAIN) ); ?></div>
			<div class="pagination-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', TEMPLATE_DOMAIN) ); ?></div>
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
?>