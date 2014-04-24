<?php
/**
 * @package firmasite
 */
 
 
// You can translate theme description with this
__("Free responsive WordPress theme with Buddypress and bbPress supports. Have 4 different layout: content-sidebar,sidebar-content, full content (long), full content(short). 13 different theme styles, Google Fonts, logo upload abilities. Unique 2 feature builtin: Promotion Bar and ShowCase. All options are using WordPress Theme Customizer feature so you can watch changes live! Designers: This theme built on Twitter Bootstrap, have 0 custom css code and using template_part system so you can easily use it as parent theme! You can find detailed information, showcase, live demo, tips and tricks about theme in: http://theme.firmasite.com/", "firmasite");

// This is not using but need for theme review
if ( ! isset( $content_width ) ) $content_width = 900;


add_action('after_setup_theme', "firmasite_setup" );
function firmasite_setup() {

  // Make theme available for translation
  load_theme_textdomain( 'firmasite', get_template_directory() . '/languages');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'main_menu' => esc_attr__('Main Menu', 'firmasite'),
  ));

  register_nav_menus(array(
    'footer_menu' => esc_attr__('Footer Menu', 'firmasite'),
  ));
  
  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  
  // Enable Bootstrap
  add_theme_support('firmasite-bootstrap');  
  
  // Enable Bootstrap's fixed navbar
  add_theme_support('firmasite-bootstrap-top-navbar'); 
  
  // Feed Links
  add_theme_support( 'automatic-feed-links' );

  // Custom Background
  add_theme_support( 'custom-background' );

  // Post Format
  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'status', 'image', 'quote', 'video', 'audio', 'chat' ) );
}

// Sidebars
add_action( 'widgets_init', "firmasite_init" );
function firmasite_init(){
		register_sidebar( array(
			'id' => 'site-sidebar',
			'name' => esc_attr__( 'Sidebar', 'firmasite' ),
			'description' => esc_attr__( 'Widgets that shows in sidebar', 'firmasite' ),
			'before_widget' => '<article id="%1$s" class="widget %2$s">',
			'after_widget' => '</article>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		));
		register_sidebar( array(
			'id' => 'footer-middle',
			'name' => esc_attr__( 'Footer', 'firmasite' ),
			'description' => esc_attr__( 'Widgets that shows in footer', 'firmasite' ),
			'before_widget' => '<article id="%1$s" class="widget span4 %2$s">',
			'after_widget' => '</article>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		));
}


add_action('wp_enqueue_scripts', "firmasite_enqueue_script" );
function firmasite_enqueue_script() {
	
	global $firmasite_settings;
	
	// Comment
	if(!isset($firmasite_settings["comments"]) || $firmasite_settings["comments"] != true )
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Google Font
	if (isset($firmasite_settings["font"]) && !empty($firmasite_settings["font"])){
		//if(!empty(FIRMASITE_SUBSETS)) $firmasite_data_subsets = "," . FIRMASITE_SUBSETS;
		$firmasite_data_subsets = FIRMASITE_SUBSETS;
		if (!empty($firmasite_data_subsets)) $firmasite_data_subsets = "," . $firmasite_data_subsets;
		wp_enqueue_style( 'google-webfonts', '//fonts.googleapis.com/css?family=' . $firmasite_settings["font"] . '&amp;subset=latin'. $firmasite_data_subsets );
		add_action ("wp_head", "firmasite_customcss_googlefont");
		function firmasite_customcss_googlefont() {
			global $firmasite_settings;
			?>
			<style type="text/css" media="screen">
				body { font-family: <?php echo $firmasite_settings["font"]; ?>,sans-serif !important;}
			</style>
			<?php
		}
	}

	// Make menus clickable
	if(!isset($firmasite_settings["hover-nav"]) || $firmasite_settings["hover-nav"] != true )
		add_action("wp_head", "firmasite_hover_nav");
		function firmasite_hover_nav() {
		?>
			<style type="text/css">
			/* hover dropdown possible for large screens */
			@media (min-width: 980px) {
				ul.nav li.dropdown:hover > ul.dropdown-menu{ display: block; }
				.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu { margin-top: 0; margin-bottom: 0; }
			}
			@media (max-width: 979px) {
				ul.nav li.dropdown > ul.dropdown-menu{ display: block; }
			}
			<?php global $is_IE; if ($is_IE) { ?>
				.browser_ie ul.nav li.dropdown:hover > ul.dropdown-menu{ display: block; }
				.browser_ie .nav-tabs .dropdown-menu, .browser_ie .nav-pills .dropdown-menu, .browser_ie .navbar .dropdown-menu { margin-top: 0; margin-bottom: 0; }				
			<?php } ?>
			</style>
			<script type="text/javascript">
			jQuery(document).ready(function($){
				jQuery("a.dropdown-toggle").removeAttr('data-toggle');
			});
			</script>
		<?php
		}
	
	// add ie conditional html5 shim to header
	global $is_IE;
	if ($is_IE) {
		wp_register_script ('html5shim', "//html5shiv.googlecode.com/svn/trunk/html5.js");
		wp_enqueue_script ('html5shim');
		$firmasite_settings["layout_page_class"] = $firmasite_settings["layout_page_class"]. " browser_ie";
	}

	// bootstrap
	wp_register_style( 'bootstrap', $firmasite_settings["styles_url"][$firmasite_settings["style"]] . '/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap' );

 	if (isset($firmasite_settings["no-responsive"]) && !empty($firmasite_settings["no-responsive"])) {
	} else {
		// bootstrap-responsive-css
		wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-responsive.min.css' );
		wp_enqueue_style( 'bootstrap-responsive' );
	}
	// style
	wp_register_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'style' );
	
	// bootstrap-js
	wp_register_script(
		'bootstrap',
		get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
		array('jquery'),
		false, // $ver
		true // $in_footer
	);
	wp_enqueue_script( 'bootstrap' );
 
	// Deregister WordPress comment-reply script
    wp_deregister_script('comment-reply');
 
    // Register our own comment-reply script for wysiwyg support
    wp_register_script('comment-reply', get_template_directory_uri() .'/assets/js/comment-reply.min.js');

}


/**
 * Functions
 * @package firmasite
 */

require_once ( get_template_directory() . '/functions/nav.php');					// Custom nav modifications
require_once ( get_template_directory() . '/functions/customizer.php');			// Customizer
require_once ( get_template_directory() . '/functions/template-tags.php');			// Customizer

/**
 * Custom Functions
 *
 */
require_once ( get_template_directory() . '/functions/fix.php');			// Little fix Functions
require_once ( get_template_directory() . '/functions/showcase.php');				// showcase
require_once ( get_template_directory() . '/functions/promotionbar.php');			// Tanıtım Barı


// Sadly we cant include csstidy. WordPress Theme Directory's automatic code checking system is not accepting it.
// You have 2 option for including css checker:
// 1: install jetpack and activate custom css or
// 2: install firmasite theme enhancer plugin
// You should remove "if ( class_exists('safecss') )" from file below when you copy files
require_once ( get_template_directory() . '/functions/custom-custom-css.php');	// Custom Css.		
require_once ( get_template_directory() . '/functions/shortcodes.php');			// Shortcodes
require_once ( get_template_directory() . '/functions/plugins.php');			// Buddypress + bbPress


