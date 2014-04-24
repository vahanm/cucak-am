<?php
/*
Plugin Name: BAW Like - Unlike
Plugin URI: http://www.BoiteaWeb.fr/2886
Description: Add boutons for "Like" or "Unlike" (can be set up) our posts and pages.
Version: 1.2
Author: Juliobox
Author URI: http://www.BoiteaWeb.fr
*/

DEFINE( 'BAWLU_VERSION', '1.2' );
DEFINE( 'BAWLU_LIKE', 'like' );
DEFINE( 'BAWLU_UNLIKE', 'unlike' );
DEFINE( 'BAWLU_FULLNAME', 'BAW Like - Unlike' );
DEFINE( 'BAWLU_PLUGIN_URL', trailingslashit( WP_PLUGIN_URL ) . basename( dirname( __FILE__ ) ) );
DEFINE( 'BAWLU_IMAGES_URL', trailingslashit( WP_PLUGIN_URL ) . basename( dirname( __FILE__ ) ) . '/images/' );

function bawlu_l10n_init()
{
  load_plugin_textdomain( 'baw_lu', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );
}
add_action( 'init','bawlu_l10n_init' );

function bawlu_register_plugin_js_css()
{
  wp_enqueue_script( 'jquery' );

  wp_register_style( 'bawlu-css', plugins_url( '/css/baw_lu.css', __FILE__ ) );
  wp_enqueue_style( 'bawlu-css' );
  wp_register_style( 'bawlu-tabs-css', plugins_url( '/css/baw_tabs.css', __FILE__ ) );
  wp_enqueue_style( 'bawlu-tabs-css' );

  wp_register_script( 'bawlu-tabs-js', plugins_url( '/js/baw_tabs.js', __FILE__ ) );
  wp_enqueue_script( 'bawlu-tabs-js' );
  wp_register_script( 'bawlu-js', plugins_url( '/js/baw_lu.js', __FILE__ ) );
  wp_enqueue_script( 'bawlu-js' );
  $protocol = isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
  wp_localize_script('bawlu-js', 'bawlu_l10n', array(
            			'ajaxurl' => admin_url( 'admin-ajax.php', $protocol ),
            			'BAWLU_IMAGES_URL' => BAWLU_IMAGES_URL
	                ) );

}
add_action( 'init', 'bawlu_register_plugin_js_css' );

function bawlu_get_userID()
{
  global $current_user;
  $current_userIP = dechex( sanitize_key( $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'] ) );
  $current_userID = ( is_user_logged_in() && get_option( 'bawlu_logbyip' ) == '' ) ? $current_user->ID : $current_userIP;
  return $current_userID;
}

function bawlu_ajax_php()
{
  global $post;
  $current_userID = bawlu_get_userID();

  if ( !isset( $_POST['lu'] ) || !isset( $_POST['nonce'] ) || !isset( $_POST['postID'] ) ) {
    die( '-1' );
  }
  $_CLEAN = array();
  $_CLEAN['action'] = $_POST['lu'];
  if ( $_CLEAN['action'] != BAWLU_LIKE && $_CLEAN['action'] != BAWLU_UNLIKE ) {
    $_CLEAN['postID'] = 0;
  }else{
    $_CLEAN['postID'] = (int)$_POST['postID'];
    $_CLEAN['nonce'] = wp_verify_nonce( $_POST['nonce'], 'bawlu-like-unlike_' . $_CLEAN['postID'] );
  }
  if ( $_CLEAN['postID'] > 0 && $_CLEAN['nonce'] ) {
    $userslike = get_post_meta( $_CLEAN['postID'], '_bawlu-userslikeit', true );
    $usersunlike = get_post_meta( $_CLEAN['postID'], '_bawlu-usersunlikeit', true );
    if ( get_option( 'bawlu_memberaccess' ) == 'on' && !is_user_logged_in() ) {
      $textneedlogin = esc_attr( get_option( 'bawlu_textneedlogin' ) );
      $textneedlogin = str_replace( '{connection}', '<a href="' . wp_login_url( get_permalink( $_CLEAN['postID'] ) ) . '">' . __( 'Connection', 'baw_lu' ) . '</a>', $textneedlogin );
      $textneedlogin = str_replace( '{registration}', wp_register( '', '', false ), $textneedlogin );
      $response = json_encode( array( 'error' => '1', 'msg' => '<p style="clear: both;">' . $textneedlogin . '</p>' ) );
    }else{
      $postslike = get_user_meta( $current_userID, '_bawlu-postslikeit', true );
      $postsunlike = get_user_meta( $current_userID, '_bawlu-postsunlikeit', true );
      if ( $_CLEAN['action'] == BAWLU_UNLIKE ) {
        if ( strstr( ',' . $userslike . ',', ',' . $current_userID . ',' ) != '' ) {
          $newuserslike = str_replace( ',' . $current_userID . ',', ',', ',' . $userslike );
          update_post_meta( $_CLEAN['postID'], '_bawlu-userslikeit', substr( $newuserslike, 1 ), $userslike );
          $newpostslike = str_replace( ',' . $_CLEAN['postID'] . ',', ',', ',' . $postslike );
          update_user_meta( $current_userID, '_bawlu-postslikeit', substr( $newpostslike, 1 ), $postslike );
        }
        if ( strstr( ',' . $usersunlike . ',', ',' . $current_userID . ',' ) != '' ) {
          $newusersunlike = str_replace( ',' . $current_userID . ',', ',', ',' . $usersunlike );
          update_post_meta( $_CLEAN['postID'], '_bawlu-usersunlikeit', substr( $newusersunlike, 1 ), $usersunlike );
          $newpostsunlike = str_replace( ',' . $_CLEAN['postID'] . ',', ',', ',' . $postsunlike );
          update_user_meta( $current_userID, '_bawlu-postsunlikeit', substr( $newpostsunlike, 1 ), $postsunlike );
        }else{
          update_post_meta( $_CLEAN['postID'], '_bawlu-usersunlikeit', $usersunlike . $current_userID . ',' );
          update_user_meta( $current_userID, '_bawlu-postsunlikeit', $postsunlike . $_CLEAN['postID'] . ',' );
        }
      }else
      if ( $_CLEAN['action'] == BAWLU_LIKE ) {
        if ( strstr( ',' . $usersunlike . ',', ',' . $current_userID . ',' ) != '' ) {
          $newusersunlike = str_replace( ',' . $current_userID . ',', ',', ',' . $usersunlike );
          update_post_meta( $_CLEAN['postID'], '_bawlu-usersunlikeit', substr( $newusersunlike, 1 ), $usersunlike );
          $newpostsunlike = str_replace( ',' . $_CLEAN['postID'] . ',', ',', ',' . $postsunlike );
          update_user_meta( $current_userID, '_bawlu-postsunlikeit', substr( $newpostsunlike, 1 ), $postsunlike );
        }
        if ( strstr( ',' . $userslike . ',', ',' . $current_userID . ',' ) != '' ) {
          $newuserslike = str_replace( ',' . $current_userID . ',', ',', ',' . $userslike );
          update_post_meta( $_CLEAN['postID'], '_bawlu-userslikeit', substr( $newuserslike, 1 ), $userslike );
          $newpostslike = str_replace( ',' . $_CLEAN['postID'] . ',', ',', ',' . $postslike );
          update_user_meta( $current_userID, '_bawlu-postslikeit', substr( $newpostslike, 1 ), $postslike );
        }else{
          update_post_meta( $_CLEAN['postID'], '_bawlu-userslikeit', $userslike . $current_userID . ',' );
          update_user_meta( $current_userID, '_bawlu-postslikeit', $postslike . $_CLEAN['postID'] . ',' );
        }
      }
      $response = json_encode( array( 'error' => '0', 'res' => bawlu_addbuttons( $_CLEAN['postID'] ) . '<span id="bawlu_content">&nbsp;</span>' ) );
    }
  }else{
    $response = json_encode( array( 'error' => '1', 'msg' => '<p style="clear: both;">' . esc_attr( get_option( 'bawlu_texterror' ) ) . '</p>' ) ) ;
  }
  header( "Content-Type: application/json" );
  echo $response;
  die();
}
add_action( 'wp_ajax_bawlu_ajax_php', 'bawlu_ajax_php' );
add_action( 'wp_ajax_nopriv_bawlu_ajax_php', 'bawlu_ajax_php' );

function bawlu_addbuttons( $postID = 0 ) {
  global $post;
  
  $res = array( 'l' => '', 'u' => '' );
  $current_userID = bawlu_get_userID();

  $postID = $postID > 0 ? $postID : $post->ID;
  $userslike = get_post_meta( $postID, '_bawlu-userslikeit', true );
  $usersunlike = get_post_meta( $postID, '_bawlu-usersunlikeit', true );
  $nb_like = substr_count( $userslike, ',' );
  $nb_unlike = substr_count( $usersunlike, ',' );
  if( strstr( ',' . $userslike . ',', ',' . $current_userID . ',' ) != '' ){ 
    $lclass = ' bawlu_focus'; 
    $uclass = ' bawlu_fade'; 
  }else
  if( strstr( ',' . $usersunlike . ',', ',' . $current_userID . ',' ) != '' ){ 
    $lclass = ' bawlu_fade'; 
    $uclass = ' bawlu_focus'; 
  }else{
    $lclass = ''; 
    $uclass = ''; 
  }
  $res['l'] = bawlu_createbutton( esc_attr( get_option( 'bawlu_textlike' ) ), $nb_like, $lclass, BAWLU_LIKE, $postID );
  if ( get_option( 'bawlu_onebutton' ) != 'on' ) {
    $res['u'] = bawlu_createbutton( esc_attr( get_option( 'bawlu_textunlike' ) ), $nb_unlike, $uclass, BAWLU_UNLIKE, $postID );
  }

  if ( get_option( 'bawlu_alignment' ) != 'right' ) {
    $res = $res['l'] . $res['u'];
  }else{
    $res = $res['u'] . $res['l'];
  }
  return $res;
}

function bawlu_createbutton( $title, $value, $class, $like, $postID ) {
  $nonce = wp_create_nonce( 'bawlu-like-unlike_'.$postID );
  $class = get_option( 'bawlu_fontuline' ) == '' ? $class : $class . ' bawlu_underline';
  $css_float = get_option( 'bawlu_alignment' ) == 'left' ? 'left' : 'right';
  $css_style = '';
  $span_style = '';
  $css_style .= 'color: #' . esc_attr( get_option( 'bawlu_coltext' ) ) . ';';
  $height = 24;
  $lineheight = 20;
  $image = '&nbsp;';
  $bg_file = get_option( 'bawlu_bgset' ) == '' ? '' : BAWLU_IMAGES_URL . 'bg/' . esc_attr( get_option( 'bawlu_bgset' ) ) . '.png';
  if ( $bg_file != '' ) {
    list($dummy, $bg_height, $dummy, $dummy) = @getimagesize( $bg_file );
    if ( $bg_height > 0 ) {
      $height = $bg_height / 3;
      $lineheight = $height - 4;
      $css_style .= 'line-height: ' . $lineheight . 'px;';
      $span_style = 'background-image: url(' . $bg_file . '); background-repeat: no-repeat; background-attachment: scroll;background-color: #' . esc_attr( get_option( 'bawlu_colbg' ) ) . ';';
    }
  }
  $css_style .= 'float: ' . $css_float . ';';
  $css_style .= 'font-size: ' . (int)get_option( 'bawlu_fontsize' ) . 'px;';
  $css_style .= get_option( 'bawlu_fontbold' ) == 'on' ? 'font-weight: bold;' : '';
  $css_style .= get_option( 'bawlu_fontital' ) == 'on' ? 'font-style: italic;' : '';
  $css_style .= get_option( 'bawlu_fontname' ) != '' ? 'font-family: ' . esc_attr( get_option( 'bawlu_fontname' ) ) . ';' : '';
  $info_title = $class == ' bawlu_focus' ? ' (' . esc_attr( get_option( 'bawlu_textcancel' ) ) . ')' : '';
  $ico_file = get_option( 'bawlu_iconset' ) == '' ? '' : BAWLU_IMAGES_URL . 'ico/' . esc_attr( get_option( 'bawlu_iconset' ) ) . '.png';
  if ( $ico_file != '' ) {
    list($ico_width, $ico_height, $dummy, $dummy) = @getimagesize( $ico_file );
    if ( get_option( 'bawlu_iconset' ) != '' && $ico_height > 0 ) {
      $bg_align = $like == BAWLU_LIKE ? 'center' : 'right';
      if ( $class == ' bawlu_focus' ) {
        $bg_align = 'left';
      }
      $ico_width = $ico_width / 3;
      $image = '<span style="padding: 0px; float: left; top: 3px; height: ' . $ico_height . 'px; position: relative; width: ' . $ico_width . 'px; margin-right: 5px; background: url(' . $ico_file . ') no-repeat scroll ' . $bg_align .' center transparent;"></span>';
    }
  }
  $height = $ico_height > $height ? $ico_height : $height;
  $css_style .= 'height: ' . $height . 'px; ';
  $valeur = get_option( 'bawlu_showvalue' ) != 'on' ? '' : ' (' . $value . ')';
  $res  = '<a class="bawlu_btn' . $class . '" style="' . $css_style . '" title="' . $title . $info_title . '" href="#' . $nonce . ',' . $postID . ',' . $like . '">';
  $tempcss = 'float: left;';
  $span  = '<span class="bawlu_left" style="background-image: url(' . $bg_file . '); padding-left: 8px; display: inline-block; height: 100%;background-repeat: no-repeat; background-attachment: scroll; ' . $tempcss . ' ">';
  $res .= $span . $image;
  $res .= '</span>';
  $tempcss = 'background-position: right top; background-attachment: scroll; background-color: #' . esc_attr( get_option( 'bawlu_colbg' ) );
  $span  = '<span class="bawlu_right" style="background-image: url(' . $bg_file . '); padding-right: 8px; display: inline-block; height: 100%;background-repeat: no-repeat; background-attachment: scroll; ' . $tempcss . ' ">';
  $res  .= $span;
  $res .= $title . $valeur;
  $res .= '</span>';
  $res .= '</a>';
  return $res;
}

if ( get_option( 'bawlu_showwhere' ) != 'manuel' ) {
  function bawlu_modif_content( $content )
  {
    if ( is_single() || ( is_page() && get_option( 'bawlu_alsopage' ) == 'on' ) ) {
      $res = '<div id="bawlu_content">' . bawlu_addbuttons() . ' <span id="bawlu_content">&nbsp;</span></div>';
    }
    if ( get_option( 'bawlu_showwhere' ) == 'dessous' ) {
      return $content . $res;
    }else
    if ( get_option( 'bawlu_showwhere' ) == 'dessus' ) {
      return $res. '<p style="clear: both;"></p>' . $content;
    }
  }
  add_action( 'the_content', 'bawlu_modif_content' );
}

function bawlu_buttons( $atts, $content = null )
{
  if ( get_option( 'bawlu_showwhere' ) == 'manuel' ) {
    return '<div id="bawlu_content">' . bawlu_addbuttons( 0 ) . '<span id="bawlu_content">&nbsp;</span></div>';
  }else{
    return '';
  }
}
add_shortcode( 'bawlu_buttons', 'bawlu_buttons' );

function bawlu_counter( $atts, $content = null )
{
  global $post;
  extract(shortcode_atts(array(
    "ID" => '0',
    "type" => 'post',
    "likeorunlike" => BAWLU_LIKE
  ), $atts));
  $likeorunlike = $likeorunlike != BAWLU_UNLIKE ? BAWLU_LIKE : BAWLU_UNLIKE;
  $ID = $ID > 0 ? $ID : ( $type == 'post' ? $post->ID : bawlu_get_userID() );
  $type = $type == 'user' ? 'post' : 'user';
  if ( $type == 'user' ) {
    $commas = count( explode( ',', get_post_meta( $ID, '_bawlu-' . $type . 's' . $likeorunlike . 'it', true ) ) ) - 1;
  }else{
    $commas = count( explode( ',', get_user_meta( $ID, '_bawlu-' . $type . 's' . $likeorunlike . 'it', true ) ) ) - 1;
  }
  return $commas;
}
add_shortcode( 'bawlu_counter', 'bawlu_counter' );

function bawlu_dashboard_widget()
{
  $current_userID = bawlu_get_userID();

  $userlikeit = get_user_meta( $current_userID, '_bawlu-postslikeit', true );
  $postslike = explode( ',', $userlikeit );
  if ( $postslike[count( $postslike ) - 1] == '' ) {
    unset( $postslike[count( $postslike ) - 1] );
  }
  foreach( $postslike as $apost ) {
    $test_post = get_post( $apost );
    if ( $test_post->post_status != 'publish' ) {
      $user_likeit = str_replace( ',' . $apost . ',', ',', ',' . $userlikeit );
      update_user_meta( $current_userID, '_bawlu-postslikeit', substr( $user_likeit, 1 ), $userlikeit );
    }
  }

  $userunlikeit = get_user_meta( $current_userID, '_bawlu-postsunlikeit', true );
  $postsunlike = explode( ',', $userunlikeit );
  if ( $postsunlike[count( $postsunlike ) - 1] == '' ) {
    unset( $postsunlike[count( $postsunlike ) - 1] );
  }
  foreach( $postsunlike as $apost ) {
    $test_post = get_post( $apost );
    if ( $test_post->post_status != 'publish' ) {
      $userunlikeit = str_replace( ',' . $apost . ',', ',', ',' . $userunlikeit );
      update_user_meta( $current_userID, '_bawlu-postsunlikeit', substr( $userunlikeit, 1 ), $userunlikeit );
    }
  }

  $icon = esc_attr( get_option( 'bawlu_iconset' ) );

  $userlikeit = get_user_meta( $current_userID, '_bawlu-postslikeit', true );
  if ( count( $postslike ) > 0 ) {
    echo '<h3>' . count( $postslike ) . ' "' . get_option( 'bawlu_textlike' ) . '" : </h3>';
    foreach( $postslike as $like ) {
      echo '<span style="background-image: url(' . BAWLU_IMAGES_URL . 'ico/' . $icon . '.png); background-repeat: no-repeat; background-attachment: scroll; background-position: center top; background-color: transparent; background-size: auto 16px; -moz-background-size: auto 16px; -o-background-size: auto 16px; -webkit-background-size: auto 16px; width: 16px; height: 16px; display: inline-block; top: 3px; position: relative;" alt="' . $icon . '"></span>';
      echo ' <a href="' . get_permalink( $like ) . '">' . get_the_title($like) . '</a><br />';
    }
    echo '<br />';
  }else{
    echo '<p>Aucun "' . esc_attr( get_option( 'bawlu_textlike' ) ) . '" pour le moment.</p>';
  }

  $userunlikeit = get_user_meta( $current_userID, '_bawlu-postsunlikeit', true );
  if ( count( $postsunlike ) > 0 ) {
    echo '<h3>' . count( $postsunlike ) . ' "' . esc_attr( get_option( 'bawlu_textunlike' ) ) . '" : </h3>';
    foreach( $postsunlike as $unlike ) {
      echo '<span style="background-image: url(' . BAWLU_IMAGES_URL . 'ico/' . $icon . '.png); background-repeat: no-repeat; background-attachment: scroll; background-position: right top; background-color: transparent; background-size: auto 16px; -moz-background-size: auto 16px; -o-background-size: auto 16px; -webkit-background-size: auto 16px; width: 16px; height: 16px; display: inline-block; top: 3px; position: relative;" alt="' . $icon . '"></span>';
      echo ' <a href="' . get_permalink( $unlike ) . '">' . get_the_title($unlike) . '</a><br />';
    }
    echo '<br />';
  }else{
    echo '<p>' . __( 'No', 'baw_lu') . ' "' . esc_attr( get_option( 'bawlu_textunlike' ) ) . '" ' . __( 'for now', 'baw_lu' ) . '</p>';
  }

  echo '<em>' . __( 'You are using', 'baw_lu' ) . '<nobr>' . BAWLU_FULLNAME . '</nobr> v ' . BAWLU_VERSION . '</em>';
}

function bawlu_dashboard_widget_setup()
{
  wp_add_dashboard_widget( 'bawlu_dashboard_widget', BAWLU_FULLNAME, 'bawlu_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'bawlu_dashboard_widget_setup' );

function bawlu_create_menu()
{
if ( !defined( 'BAW_MENU' ) ) {
  define( 'BAW_MENU', true );
  add_menu_page( 'BoiteAWeb.fr', 'BoiteAWeb', 'manage_options', 'baw_menu', 'baw_about', plugins_url('/images/icon.png', __FILE__) );
}
  add_submenu_page( 'baw_menu', 'Like - Unlike', 'Like - Unlike', 'install_plugins', 'baw_lu_config', 'bawlu_page' );
}
add_action( 'admin_menu', 'bawlu_create_menu' );

if( !function_exists( 'baw_about' ) ) {
  function baw_about() {
    include( 'about.php' );
  }
}

function bawlu_page() {
  global $wpdb;
?>
<div class="wrap">
<div class="icon32" id="icon-tools"><br></div>
<h2><?php echo BAWLU_FULLNAME; ?></h2>

<form method="post" action="options.php" id="bawlu_form">

<div class="bawtab">

	<ul class="bawtabs">
 	  <li class="bawtab01"><a class="bawtab01 bawtabcurrent" value="icon-tools" href="#tab01" rel="1"><h2><?php _e('General', 'baw_lu'); ?></h2></a></li>
 	  <li class="bawtab02"><a class="bawtab02" value="icon-themes" href="#tab02" rel="2"><h2><?php _e('Texts', 'baw_lu'); ?></h2></a></li>
 	  <li class="bawtab03"><a class="bawtab03" value="icon-index" href="#tab03" rel="3"><h2><?php _e('Pictures', 'baw_lu'); ?></h2></a></li>
 	  <li class="bawtab04"><a class="bawtab04" value="icon-options-general" href="#tab04" rel="4"><h2><?php _e('CSS', 'baw_lu'); ?></h2></a></li>
	</ul>

	<div class="bawtab01">
		<?php include('includes/general.inc.php'); ?>
	</div>

	<div class="bawtab02">
		<?php include('includes/texts.inc.php'); ?>
	</div>

	<div class="bawtab03">
		<?php include('includes/pics.inc.php'); ?>
	</div>

	<div class="bawtab04">
		<?php include('includes/css.inc.php'); ?>
	</div>

    <?php settings_fields( 'bawlu-settings-group' ); ?>

    <p class="submit" style="float:left">
    <input type="submit" tabindex="32767" class="button-primary" value="<?php _e( 'Save settings', 'baw_lu' ); ?>" />
    </p>

</form>
</div>
<?php
}

function bawlu_add_custom_box()
{
    add_meta_box(
        'baw_lu_meta_box_reset',
        'Like - Unlike',
        'bawlu_meta_box',
        'post'
    );
    if ( get_option( 'bawlu_alsopage' ) == 'on' ) {
      add_meta_box(
          'baw_lu_meta_box_reset',
          'Like - Unlike',
          'bawlu_meta_box',
          'page'
      );
    }
}
add_action( 'add_meta_boxes', 'bawlu_add_custom_box' );

function bawlu_meta_box()
{
  echo '<h4>' . __('Reset Like/Unlike counter', 'baw_lu' ) . '</h4>';
  echo '<p><strong>' . do_shortcode( '[bawlu_counter likeorunlike="like"]' ) . '</strong> "<em>' . esc_attr( get_option( 'bawlu_textlike' ) ) . '</em>"</p>';
  echo '<p><strong>' . do_shortcode( '[bawlu_counter likeorunlike="unlike"]' ) . '</strong> "<em>' . esc_attr( get_option( 'bawlu_textunlike' ) ) . '</em>"</p>';
  echo '<label><input type="checkbox" name="bawlu_reset" value="on" />&nbsp;';
  wp_nonce_field( 'bawlu_reset_from_meta_box', 'bawlu_reset_none', true, true );
  _e( 'Check this to reset Like/Unlike counter on update.', 'baw_lu' );
  echo '</label>';
}

function bawlu_reset_from_meta_box()
{
  if ( check_admin_referer( 'bawlu_reset_from_meta_box', 'bawlu_reset_none' ) && wp_verify_nonce( $_POST['bawlu_reset_none'], 'bawlu_reset_from_meta_box' ) && $_POST['bawlu_reset'] == 'on' && intval( $_POST['post_ID'] ) > 0 ) {
    $postID = intval( $_POST['post_ID'] );

    $postslike = get_post_meta( $postID, '_bawlu-userslikeit', 'true' );
    $allusers_likeit = explode( ',', $postslike );
    delete_post_meta( $postID, '_bawlu-userslikeit' );
    foreach( $allusers_likeit as $userID ) {
      $posts_user = get_user_meta( $userID, '_bawlu-postslikeit', true );
      if ( strstr( ',' . $posts_user . ',', ',' . $postID . ',' ) != '' ) {
        $newpostslike = str_replace( ',' . $postID . ',', ',', ',' . $posts_user );
        update_user_meta( $userID, '_bawlu-postslikeit', substr( $newpostslike, 1 ), $posts_user );
      }
    }
    $postsunlike = get_post_meta( $postID, '_bawlu-usersunlikeit', 'true' );
    $allusers_unlikeit = explode( ',', $postsunlike );
    delete_post_meta( $postID, '_bawlu-usersunlikeit' );
    foreach( $allusers_unlikeit as $userID ) {
      $posts_user = get_user_meta( $userID, '_bawlu-postsunlikeit', true );
      if ( strstr( ',' . $posts_user . ',', ',' . $postID . ',' ) != '' ) {
        $newpostsunlike = str_replace( ',' . $postID . ',', ',', ',' . $posts_user );
        update_user_meta( $userID, '_bawlu-postsunlikeit', substr( $newpostsunlike, 1 ), $posts_user );
      }
    }
  }
}
add_action( 'publish_post', 'bawlu_reset_from_meta_box' );

function bawlu_esc_hexa( $str )
{
  return preg_replace( '/[^0-9A-F]/', '', strtoupper( $str ) );
}

function bawlu_settings_action_links( $links, $file )
{
  if ( strstr( __FILE__, $file ) != '' ) {
   $title_link = __( 'Settings', 'baw_lu' );
   $settings_link = '<a href="' . admin_url( 'admin.php?page=baw_lu_config' ) . '">' . $title_link . '</a>';
   array_unshift( $links, $settings_link );
  }
  return $links;
}
add_filter( 'plugin_action_links', 'bawlu_settings_action_links', 10, 2 );

function bawlu_register_settings()
{
  register_setting( 'bawlu-settings-group', 'bawlu_memberaccess' );
  register_setting( 'bawlu-settings-group', 'bawlu_logbyip' );
  register_setting( 'bawlu-settings-group', 'bawlu_onebutton' );
  register_setting( 'bawlu-settings-group', 'bawlu_showvalue' );
  register_setting( 'bawlu-settings-group', 'bawlu_alsopage' );
  register_setting( 'bawlu-settings-group', 'bawlu_showwhere' );

  register_setting( 'bawlu-settings-group', 'bawlu_textlike', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_textunlike', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_texterror', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_textcancel', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_textneedlogin', 'esc_attr' );

  register_setting( 'bawlu-settings-group', 'bawlu_iconset', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_bgset', 'esc_attr' );

  register_setting( 'bawlu-settings-group', 'bawlu_alignment' );
  register_setting( 'bawlu-settings-group', 'bawlu_colbg', 'bawlu_esc_hexa' );
  register_setting( 'bawlu-settings-group', 'bawlu_coltext', 'bawlu_esc_hexa' );
  register_setting( 'bawlu-settings-group', 'bawlu_fontbold' );
  register_setting( 'bawlu-settings-group', 'bawlu_fontital' );
  register_setting( 'bawlu-settings-group', 'bawlu_fontsize', 'intval' );
  register_setting( 'bawlu-settings-group', 'bawlu_fontname', 'esc_attr' );
  register_setting( 'bawlu-settings-group', 'bawlu_fontuline' );
}
add_action( 'admin_init', 'bawlu_register_settings' );

function bawlu_default_values()
{
  load_plugin_textdomain( 'baw_lu', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );

  add_option( 'bawlu_memberaccess', 'on' );
  add_option( 'bawlu_logbyip', '' );
  add_option( 'bawlu_onebutton', '' );
  add_option( 'bawlu_showvalue', 'on' );
  add_option( 'bawlu_alsopage', '' );
  add_option( 'bawlu_showwhere', 'dessous' );

  add_option( 'bawlu_textlike', __( 'I like', 'baw_lu' ) );
  add_option( 'bawlu_textunlike', __( 'I don\'t like', 'baw_lu' ) );
  add_option( 'bawlu_texterror', __( 'Error', 'baw_lu' ) );
  add_option( 'bawlu_textcancel', __( 'Clic again to cancel vote.', 'baw_lu' ) );
  add_option( 'bawlu_textneedlogin', __( 'A connection or registration is mandatory to vote.', 'baw_lu' ) );

  add_option( 'bawlu_iconset', 'Greenny' );
  add_option( 'bawlu_bgset', 'GreenDay' );

  add_option( 'bawlu_alignment', 'left' );
  add_option( 'bawlu_colbg', '' );
  add_option( 'bawlu_fontsize', '11' );
  add_option( 'bawlu_fontname', 'Verdana' );
  add_option( 'bawlu_fontbold', '' );
  add_option( 'bawlu_fontital', '' );
  add_option( 'bawlu_coltext', '9999CC' );
  add_option( 'bawlu_fontuline', '' );
}
register_activation_hook( __FILE__, 'bawlu_default_values' );

function bawlu_check_versions() {
  global $wp_version;
	if ( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die( __( 'This plugin requires PHP 5.0 or more', 'baw_lu' ) );
	}
	if ( version_compare( $wp_version, '3.1', '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die( __( 'This plugin requires WordPress 3.1 or more. Your version : ' . $wp_version, 'baw_lu' ) );
	}
}
register_activation_hook( __FILE__, 'bawlu_check_versions' );

function bawlu_uninstaller(){
  global $wpdb;
  $wpdb->query( 'DELETE FROM ' . $wpdb->options . ' WHERE option_name LIKE "bawlu%"' );
  $wpdb->query( 'DELETE FROM ' . $wpdb->postmeta . ' WHERE meta_key LIKE "_bawlu%"' );
}
register_uninstall_hook( __FILE__, 'bawlu_uninstaller' );

?>