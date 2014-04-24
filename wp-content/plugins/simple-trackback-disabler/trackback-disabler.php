<?php
/*
Plugin Name: Simple Trackback Disabler
Plugin URI: http://alleghenycreative.com/projects/simple-trackback-disabler
Description: This is a utility plugin that runs database operations on your WordPress database to change settings and clean up unwanted trackbacks, pingbacks, and comments. Without this plugin you would have to change settings in WordPress and go through all your existing pages and posts and update those as well or have to manually execute SQL commands on your database. Simple Trackback Disabler does this for you…Automagically!
Author: Allegheny Creative, LLC
Version: 1.2
Author URI: http://www.alleghenycreative.com
License: GPLv3
*/

/*
================================================================================ 

  Copyright 2013  Aaron Crawford / Allegheny Creative, LLC.

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

================================================================================
*/



// CREATE PLUGIN MENU
add_action('admin_menu', 'trackback_menu');

function trackback_menu() {
//	add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	add_submenu_page('tools.php', 'Trackback Disabler', 'Trackback Disabler', 'manage_options', 'tb_disabler', 'tb_disabler_page');
}



//****** PAGE OUTPUT ******

function tb_disabler_page() {

	global $wpdb;

    if($_POST['tbd_action_type']) {

		$tbd_action = $_POST['tbd_action_type'];
		switch ($tbd_action) {
		case "delete_comments":
			$results = $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_type = 'comment'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully deleted ".$results." <strong>Comment</strong> from the comments section."; // singular
			} else {
				$message_text = "You have successfully deleted ".$results." <strong>Comments</strong> from the comments section."; // plural
			}
			break;
		case "delete_trackbacks":
			$results = $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_type = 'trackback'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully deleted ".$results." <strong>Trackback</strong> from the comments section."; // singular
			} else {
				$message_text = "You have successfully deleted ".$results." <strong>Trackbacks</strong> from the comments section."; // plural
			}
			break;
		case "delete_pingbacks":
			$results = $wpdb->query( "DELETE FROM $wpdb->comments WHERE comment_type = 'pingback'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully deleted ".$results." <strong>Pingback</strong> from the comments section."; // singular
			} else {
				$message_text = "You have successfully deleted ".$results." <strong>Pingbacks</strong> from the comments section."; // plural
			}
			break;
		case "disable_post_comments":
			$results = $wpdb->query( "UPDATE $wpdb->posts SET comment_status = 'closed' WHERE post_type = 'post' AND comment_status = 'open'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully disabled <strong>Comments</strong> on ".$results." existing <strong>post</strong>."; // singular
			} else {
				$message_text = "You have successfully disabled <strong>Comments</strong> on ".$results." existing <strong>posts</strong>."; // plural
			}
			break;
		case "disable_page_comments":
			$results = $wpdb->query( "UPDATE $wpdb->posts SET comment_status = 'closed' WHERE post_type = 'page' AND comment_status = 'open'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully disabled <strong>Comments</strong> on ".$results." existing <strong>page</strong>."; // singular
			} else {
				$message_text = "You have successfully disabled <strong>Comments</strong> on ".$results." existing <strong>pages</strong>."; // plural
			}
			break;
		case "disable_post_pings":
			$results = $wpdb->query( "UPDATE $wpdb->posts SET ping_status = 'closed' WHERE post_type = 'post' AND ping_status = 'open'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully disabled <strong>Trackbacks & Pingbacks</strong> on ".$results." existing <strong>post</strong>."; // singular
			} else {
				$message_text = "You have successfully disabled <strong>Trackbacks & Pingbacks</strong> on ".$results." existing <strong>posts</strong>."; // plural
			}
			break;
		case "disable_page_pings":
			$results = $wpdb->query( "UPDATE $wpdb->posts SET ping_status = 'closed' WHERE post_type = 'page' AND ping_status = 'open'" );
			$message_type = "updated";
			if ($results == 1) { 
				$message_text = "You have successfully disabled <strong>Trackbacks & Pingbacks</strong> on ".$results." existing <strong>page</strong>."; // singular
			} else {
				$message_text = "You have successfully disabled <strong>Trackbacks & Pingbacks</strong> on ".$results." existing <strong>pages</strong>."; // plural
			}
			break;

		case "disable_default_comments":
			update_option( 'default_comment_status', 'closed' );
			$message_type = "updated";
			$message_text = "You have successfully disabled <strong>Comments</strong> in the wordpress default settings.";
			break;
		case "disable_default_pings":
			update_option( 'default_ping_status', 'closed' );
			$message_type = "updated";
			$message_text = "You have successfully disabled <strong>Trackbacks/Pingbacks</strong> in the wordpress default settings.";
			break;
		case "disable_default_notify":
			update_option( 'default_pingback_flag', NULL );
			$message_type = "updated";
			$message_text = "You have successfully disabled <strong>Pingback Notifications</strong> in the wordpress default settings.";
			break;

		default:
			$message_type = "error";
			$message_text = "OOPS! Something went wrong. The action you requested is not defined.";
		}

        echo '	<div class="' . $message_type . '"><p>' . $message_text . '</p></div>';

    } else {  
        // Normal page display  
    }  ?>


	<div class="wrap">
		<div id="icon-options-general" class="icon32"></div>
		<h2>Simple Trackback Disabler</h2>
		<p>Follow the steps below to disable trackbacks, pingbacks and comments on your site. If you find this plugin helpful, consider helping us out by rating the plugin or making a donation to support it's continued development.</p>
		<p><strong>WARNING: When clicking on any buttons below that function will be executed immediately with no confirmation. These operations cannot be undone. It is recommended you make a database backup prior to proceeding.</strong></p>



<div class="postbox-container" style="width:65%;">
	<div class="metabox-holder">	

		<div id="wp_settings" class="postbox">
			<h3><strong>STEP 1:</strong> WordPress Default Settings</h3>
			<div class="inside">
				<p>This section allows you check Wordpress settings and disable the settings that allow Trackbacks/Pingbacks, Comments, and related settings. These are the settings that can be found under <em>Settings > Discussion</em>. Note that these settings only affect new pages and posts, and not existing posts.</p>

				<?php
				if (get_option( "default_comment_status" ) == "open") { echo "<span style='color:red;'>Wordpress Default Setting for Comments is <em>enabled</em>. Disable by clicking the button below.</span><br>"; }
				if (get_option( "default_ping_status" ) == "open") { echo "<span style='color:red;'>Wordpress Default Setting for Trackbacks/Pingbacks is <em>enabled</em>. Disable by clicking the button below.</span><br>"; }
				if (get_option( "default_pingback_flag" ) == 1) { echo "<span style='color:red;'>Wordpress Default Setting for Pingback Notifications is <em>enabled</em>. Disable by clicking the button below.</span><br>"; }
				?>

				<table border="0" width="100%" cellpadding="3" cellspacing="3">
					<tr>
						<td>
							<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
								<input type="hidden" name="tbd_action_type" value="disable_default_comments">  
								<input class="button-primary" type="submit" name="Submit" value="Disable Comments" <?php if (get_option( "default_comment_status" ) == "closed") { echo "disabled"; } ?>/>  
							</form> 
						</td>
						
						<td>
							<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
								<input type="hidden" name="tbd_action_type" value="disable_default_pings">  
								<input class="button-primary" type="submit" name="Submit" value="Disable Trackbacks/Pingbacks" <?php if (get_option( "default_ping_status" ) == "closed") { echo "disabled"; } ?>/>  
							</form> 
						</td>
						
						<td>
							<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
								<input type="hidden" name="tbd_action_type" value="disable_default_notify">  
								<input class="button-primary" type="submit" name="Submit" value="Disable Pingback Notifications" <?php if (get_option( "default_pingback_flag" ) != 1) { echo "disabled"; } ?>/>  
							</form> 
						</td>
					</tr>
				</table>


			</div>
		</div>


		<div id="existing_posts" class="postbox">
			<h3><strong>STEP 2:</strong> Existing Page/Post Settings</h3>
			<div class="inside">
				<p>This section allows you to disable the settings that allow Trackbacks/Pingbacks/Comments on existing pages and posts. It is broken up into four options so if you desire, you may selectively disable certain types.</p>

				<?php
					$posts_open_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND comment_status = 'open'" );
					$pages_open_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'page' AND comment_status = 'open'" );
					$posts_open_pings = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'post' AND ping_status = 'open'" );
					$pages_open_pings = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'page' AND ping_status = 'open'" );
				?>
				<table border="0" width="100%" cellpadding="3" cellspacing="3">
					<tr>
						<td>
							<p>Posts with comments enabled: <?php echo $posts_open_comments; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="disable_post_comments">  
									<input class="button-primary" type="submit" name="Submit" value="Disable POST Comments" <?php if ($posts_open_comments == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
		
						<td>
							<p>Pages with comments enabled: <?php echo $pages_open_comments; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="disable_page_comments">  
									<input class="button-primary" type="submit" name="Submit" value="Disable PAGE Comments" <?php if ($pages_open_comments == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
					</tr>
					<tr>
						<td>
							<p>Posts with pings/trackbacks enabled: <?php echo $posts_open_pings; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="disable_post_pings">  
									<input class="button-primary" type="submit" name="Submit" value="Disable POST Pings/Trackbacks" <?php if ($posts_open_pings == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>

						<td>
							<p>Pages with pings/trackbacks enabled: <?php echo $pages_open_pings; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="disable_page_pings">  
									<input class="button-primary" type="submit" name="Submit" value="Disable PAGE Pings/Trackbacks" <?php if ($pages_open_pings == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
					</tr>
				</table>

			</div>
		</div>


		<div id="existing_comments" class="postbox">
			<h3><strong>STEP 3:</strong> Delete Existing Comments/Trackbacks/Pingbacks</h3>
			<div class="inside">
				<p>This section allows you to delete existing Trackbacks, Pingbacks, and Comments. It is broken up into three options so if you desire, you may selectively delete certain types.</p>
				<?php
					$comment_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = 'comment'" );
					$trackback_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = 'trackback'" );
					$pingback_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = 'pingback'" );
				?>

				<table border="0" width="100%" cellpadding="3" cellspacing="3">
					<tr>
						<td>
							<p>Comments: <?php echo $comment_count; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="delete_comments">  
									<input class="button-primary" type="submit" name="Submit" value="Delete Comments" <?php if ($comment_count == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
						
						<td>
							<p>Trackbacks: <?php echo $trackback_count; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="delete_trackbacks">  
									<input class="button-primary" type="submit" name="Submit" value="Delete Trackbacks" <?php if ($trackback_count == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
						
						<td>
							<p>Pingbacks: <?php echo $pingback_count; ?></p>
								<form name="tbd_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
									<input type="hidden" name="tbd_action_type" value="delete_pingbacks">  
									<input class="button-primary" type="submit" name="Submit" value="Delete Pingbacks" <?php if ($pingback_count == 0) { echo "disabled"; } ?>/>  
								</form> 
						</td>
					</tr>
				</table>

			</div>
		</div>


	</div>
</div>



<div class="postbox-container side" style="width:25%;margin-left:20px;">
	<div class="metabox-holder">	

		<div id="donate" class="postbox">
		<h3>Support This Plugin</h3>
		<div class="inside">
		<p>If you found the plugin helpful and appreciate how much time it saved you…consider making a donation via PayPal to support it’s development.</p>
		
		<center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="V58WBGFZW5HT8"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form></center>

		<hr>
		<h4>Other Ways to Help</h4>
		<ul>
			<li>Rate this plugin ★★★★★ on <a href="http://wordpress.org/plugins/simple-trackback-disabler/" target="_blank">WordPress.org</a></li>
			<li>Talk about it on your site and link back to the <a href="http://alleghenycreative.com/projects/simple-trackback-disabler" target="_blank">plugin page.</a></li>
			<a href="https://twitter.com/share" class="twitter-share-button" data-text="I use Simple Trackback Disabler for WordPress and it's awesome for cleaning up trackbacks &amp; pingbacks. http://bit.ly/1grrIxQ" data-via="allegheny" data-count="none">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</ul>
		</div>
		</div>


		<div id="bit51social" class="postbox">
		<h3>Follow Allegheny Creative</h3>
		<div class="inside">
		<ul>
			<li class="facebook">Like us on <a href="http://www.facebook.com/alleghenycreative" target="_blank">Facebook</a></li>
			<li class="twitter">Follow us on <a href="http://twitter.com/#!/allegheny" target="_blank">Twitter</a></li>
			<li class="google">Add us to your Circle on <a href="https://plus.google.com/112567286395191655106/" target="_blank">Google+</a></li>
		</ul>
		</div>
		</div>

	</div>
</div>


<div style="clear:both;"></div>



	</div>
<?php } ?>