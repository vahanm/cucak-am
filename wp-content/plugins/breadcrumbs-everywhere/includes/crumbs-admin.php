<?php

/***
 * This file is used to add site administration menus to the WordPress backend.
 *
 * If you need to provide configuration options for your component that can only
 * be modified by a site administrator, this is the best place to do it.
 *
 * However, if your component has settings that need to be configured on a user
 * by user basis - it's best to hook into the front end "Settings" menu.
 */

/**
 * bp_example_add_admin_menu()
 *
 * This function will add a WordPress wp-admin admin menu for your component under the
 * "BuddyPress" menu.
 */
function crumbs_add_admin_menu() {
	global $bp;

	if ( !is_super_admin() ) { // returns true if the current user is a site admin, false if not		
		}

	add_submenu_page( 'bp-general-settings', __( 'Breadcrumbs Everywhere', 'crumbs' ), __( 'Breadcrumbs Everywhere', 'crumbs' ), 'manage_options', 'crumbs-settings', 'crumbs_admin' );
}
// The bp_core_admin_hook() function returns the correct hook (admin_menu or network_admin_menu),
// depending on how WordPress and BuddyPress are configured
add_action( bp_core_admin_hook(), 'crumbs_add_admin_menu' );
//add_action('network_admin_menu', 'crumbs_add_admin_menu');
//add_action('admin_menu', 'crumbs_add_admin_menu');



/**
 * bp_example_admin()
 *
 * Checks for form submission, saves component settings and outputs admin screen HTML.
 */
function crumbs_admin() {
	global $bp;

	/* If the form has been submitted and the admin referrer checks out, save the settings */
	if ( isset( $_POST['submit'] ) && check_admin_referer('crumbs-settings') ) {
		update_option( 'crumbs-setting-one', $_POST['crumbs-setting-one'] );
		update_option( 'crumbs-setting-two', $_POST['crumbs-setting-two'] );
		update_option( 'crumbs-setting-three', $_POST['crumbs-setting-three'] );

		$updated = true;
	}

	
	$setting_one =  get_option( 'crumbs-setting-one');
	if ('' == $setting_one && option_value!= null) { //true
					$setting_one = "Home" ;					
					}
					
					
	$setting_two =  get_option( 'crumbs-setting-two');				
	if ('' == $setting_two && option_value!= null) { //true				
					$setting_two = "Blog" ;					
					}		
					
	$setting_three =  get_option( 'crumbs-setting-three');				
	if ('' == $setting_three && option_value!= null) { //true				
					$setting_three = "&raquo;" ;					
					}						

	
?>
<div class="wrap">
  <h2><?php _e( 'Breadcrumbs Everywhere', 'crumbs' ) ?></h2>

  <?php if ( isset($updated) ) : ?><?php echo '<div id="message" class="updated fade"><p>' . __( 'Settings Updated.', 'crumbs' ) . '</p></div>' ?><?php endif; ?>

  <?php if ( is_multisite() ) : // Since 1.1 multisite compatibility  -------------------------- ?>

  <?php echo '<form action="' . network_admin_url('admin.php?page=crumbs-settings') . '" name="crumbs-settings-form" id="crumbs-settings-form" method="post">' ?>

  <?php else : ?>

  <?php echo '<form action="' . admin_url('admin.php?page=crumbs-settings') . '" name="crumbs-settings-form" id="crumbs-settings-form" method="post">' ?>

  <?php endif; // -------------------------- ?>
		
  <table class="form-table">
    <tr valign="top">
      <th scope="row"><label for="target_uri"><?php _e( 'Text for the Home link:', 'crumbs' ) ?></label></th>
        <td><input name="crumbs-setting-one" type="text" id="crumbs-setting-one" value="<?php echo esc_attr( $setting_one ); ?>" size="60" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="target_uri"><?php _e( 'Text for the Blog link:', 'crumbs' ) ?></label></th>
        <td><input name="crumbs-setting-two" type="text" id="crumbs-setting-two" value="<?php echo esc_attr( $setting_two ); ?>" size="60" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="target_uri"><?php _e( 'Breadcrumb divider:', 'crumbs' ) ?></label></th>
        <td><input name="crumbs-setting-three" type="text" id="crumbs-setting-three" value="<?php echo htmlentities( $setting_three ); ?>" size="60" /></td>
    </tr>
  </table>

  <p class="submit">
  <input type="submit" name="submit" value="<?php _e( 'Save Settings', 'crumbs' ) ?>"/>
  </p>
  <span><em>That's it!</em></span>

			<?php
			/* This is very important, don't leave it out. */
			wp_nonce_field( 'crumbs-settings' );
			?>
		</form>
</div>
<?php
}

/**
 * Test to see if the necessary database tables are installed, and if not, install them
 *
 * You will only need a function like this if you need to install database tables. It is not
 * recommended that you do so if you can help it; it clutters up users' databases, and it creates
 * problems when attempting to interact with the rest of WordPress. You are highly encouraged
 * to use WordPress custom post types instead.
 *
 * Doing this check in the admin, instead of at activation time, adds a bit of overhead. But the
 * WordPress core developers have expressed a dislike for activation functions, so we do it this
 * way instead. Don't worry - dbDelta() is quite smart about not overwriting anything.
 *
 * @package BuddyPress_Skeleton_Component
 * @since 1.6
 */
 
function crumbs_install_tables() {
	global $wpdb;

	if ( !is_super_admin() )
		return;

	if ( !empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if (!empty ($wpdb->collate))
		$charset_collate .= " COLLATE {$wpdb->collate}";	

	/**
	 * If you want to create new tables you'll need to install them on
	 * activation.
	 *
	 * You should try your best to use existing tables if you can. The
	 * activity stream and meta tables are very flexible.
	 *
	 * Write your table definition below, you can define multiple
	 * tables by adding SQL to the $sql array.
	 */
	$sql = array();
	$sql[] = "CREATE TABLE IF NOT EXISTS {$wpdb->base_prefix}crumbs (
		  		id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  		high_fiver_id bigint(20) NOT NULL,
		  		recipient_id bigint(20) NOT NULL,
		  		date_notified datetime NOT NULL,
			    KEY high_fiver_id (high_fiver_id),
			    KEY recipient_id (recipient_id)
		 	   ) {$charset_collate};";

	//require_once( ABSPATH . 'wp-admin/upgrade.php' );

	/**
	 * The dbDelta call is commented out so the example table is not installed.
	 * Once you define the SQL for your new table, uncomment this line to install
	 * the table. (Make sure you increment the BP_EXAMPLE_DB_VERSION constant though).
	 */
	dbDelta($sql);

	update_site_option( 'crumbs-db-version', CRUMBS_DB_VERSION );
}
//add_action( 'admin_init', 'bp_example_install_tables' );
?>