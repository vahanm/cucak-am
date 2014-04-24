<?php
// File called by class?

if ( isset( $this ) == false || get_class( $this ) != 'plugin_remove_my_account' ) {
	
	exit;
	
}

// Does user have the capability for this menu page?

if ( current_user_can( 'delete_users' ) == false ) {
	
	return; // stop executing file
	
}

// Page URI

$page_uri = $_SERVER['PHP_SELF'] . '?page=' . $this->GET['page'];

// Form nonce

$form_nonce_action = $this->GET['page'] . '_nonce_action';
$form_nonce_name = $this->GET['page'] . '_nonce_name';

$users = get_users();

// Save changes

if ( isset( $this->POST[$form_nonce_name] ) && wp_verify_nonce( $this->POST[$form_nonce_name], $form_nonce_action ) == true ) {
	
	// Roles
	
	settype( $this->POST['roles'], 'array' );
	
	foreach ( $this->wp_roles->role_objects as $role ) {
		
		$checked = ( isset( $this->POST['roles'][$role->name] ) ) ? true : false;
		$has_cap = ( $role->has_cap( $this->info['cap'] ) ) ? true : false;
		
		if ( $checked == true && $has_cap == false ) {
			
			$role->add_cap( $this->info['cap'] );
			
		} elseif ( $checked == false && $has_cap == true ) {
			
			$role->remove_cap( $this->info['cap'] );
			
		}
		
	}
	
	// Users -> Your Profile
	
	settype( $this->POST['your_profile_class'], 'string' );
	settype( $this->POST['your_profile_style'], 'string' );
	settype( $this->POST['your_profile_anchor'], 'string' );
	settype( $this->POST['your_profile_landing_url'], 'string' );
	$this->option['settings']['your_profile_class'] = ( empty( $this->POST['your_profile_class'] ) ) ? NULL : $this->POST['your_profile_class'];
	$this->option['settings']['your_profile_style'] = ( empty( $this->POST['your_profile_style'] ) ) ? NULL : $this->POST['your_profile_style'];
	$this->option['settings']['your_profile_anchor'] = ( empty( $this->POST['your_profile_anchor'] ) ) ? $this->default_option['settings']['your_profile_anchor'] : $this->POST['your_profile_anchor'];
	$this->option['settings']['your_profile_landing_url'] = ( empty( $this->POST['your_profile_landing_url'] ) ) ? $this->default_option['settings']['your_profile_landing_url'] : $this->POST['your_profile_landing_url'];
	
	// Shortcode
	
	settype( $this->POST['shortcode_class'], 'string' );
	settype( $this->POST['shortcode_style'], 'string' );
	settype( $this->POST['shortcode_anchor'], 'string' );
	settype( $this->POST['shortcode_landing_url'], 'string' );
	$this->option['settings']['shortcode_class'] = ( empty( $this->POST['shortcode_class'] ) ) ? NULL : $this->POST['shortcode_class'];
	$this->option['settings']['shortcode_style'] = ( empty( $this->POST['shortcode_style'] ) ) ? NULL : $this->POST['shortcode_style'];
	$this->option['settings']['shortcode_anchor'] = ( empty( $this->POST['shortcode_anchor'] ) ) ? $this->default_option['settings']['shortcode_anchor'] : $this->POST['shortcode_anchor'];
	$this->option['settings']['shortcode_landing_url'] = ( empty( $this->POST['shortcode_landing_url'] ) ) ? $this->default_option['settings']['shortcode_landing_url'] : $this->POST['shortcode_landing_url'];
	
	// E-mail notification
	
	settype( $this->POST['email_notification'], 'bool' );
	$this->option['settings']['email_notification'] = $this->POST['email_notification'];
	
	// Uninstall on deactivate
	
	settype( $this->POST['uninstall_on_deactivate'], 'bool' );
	$this->option['settings']['uninstall_on_deactivate'] = $this->POST['uninstall_on_deactivate'];

        // Show on Profile page

	settype( $this->POST['show_on_profile_page'], 'bool' );
	$this->option['settings']['show_on_profile_page'] = $this->POST['show_on_profile_page'];

        // Assign content to a user

        settype( $this->POST['assign_to_user'], 'integer' );
	$this->option['settings']['assign_to_user'] = $this->POST['assign_to_user'];
	
	// Save Option
	
	$this->save_option();
	$this->admin_message( 'updated', 'Changes Saved' );

}
?>
<div class="wrap">
	
	<div class="icon32" id="icon-options-general"><br/></div>
	
	<h2><?php echo $this->info['name']; ?> Settings</h2>
	
	<form action="" method="post">
		
		<h3>Roles</h3>
		
		<table class="form-table">
			
			<tr>
				<th scope="row">Which roles can delete themselves?</th>
				<td>
				<?php
				
				foreach ( $this->wp_roles->role_objects as $role ) {
					
					$disabled = ( $role->name == 'administrator' ) ? ' disabled="disabled"' : '';
					
					?>
					
					<label>
						<input type="checkbox" name="roles[<?php echo $role->name; ?>]" value="1"<?php echo ( $role->has_cap( $this->info['cap'] ) == true ) ? ' checked="checked"' : ''; echo $disabled; ?> />
						<?php echo esc_html( $this->wp_roles->roles[$role->name]['name'] ); ?>
					</label>
					<br />
					
					<?php
					
				}
				
				?>
				
				<br />
				
				<div>
					Administrators are disabled because they can already delete users in WordPress, no need to complicate that.
					<br />
					For testing purposes you'll want to use a separate WordPress login with a role other than administrator so the delete links you configure are visible to you.
				</div>
				</td>
			</tr>
			
		</table>
		
		<h3>Users &rarr; Your Profile</h3>
		
		<table class="form-table">
		
			<tr>
				<th scope="row"><label for="your_profile_anchor">Link</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Class &amp; Style are optional. The last box is the clickable content of the link in raw HTML ( e.g. Delete User, Posts &amp;amp; Pages --- or --- &lt;img alt=&quot;&quot; src=&quot;http://www.example.com/image.png&quot; width=&quot;100&quot; height=&quot;20&quot; /&gt; )">[?]</a></th>
				<td>
					<code>
						&lt;a
						class="<input type="text" name="your_profile_class" class="code" value="<?php echo esc_html( $this->option['settings']['your_profile_class'] ); ?>" />"
						style="<input type="text" name="your_profile_style" class="code" value="<?php echo esc_html( $this->option['settings']['your_profile_style'] ); ?>" />"
						&gt;
						<input type="text" id="your_profile_anchor" name="your_profile_anchor" class="code" value="<?php echo esc_html( $this->option['settings']['your_profile_anchor'] ); ?>" />
						&lt;/a&gt;
					</code>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="your_profile_landing_url">Landing URL</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Redirect user here after deletion.">[?]</a></th>
				<td>
					<input type="text" id="your_profile_landing_url" name="your_profile_landing_url" class="code regular-text" value="<?php echo esc_url( $this->option['settings']['your_profile_landing_url'] ); ?>" />
				</td>
			</tr>
			
		</table>
		
		<h3>Shortcode</h3>
		
		<table class="form-table">
			
			<tr>
				<th scope="row"><label for="shortcode_anchor">Link</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Class &amp; Style are optional. The last box is the clickable content of the link in raw HTML ( e.g. Delete User, Posts &amp;amp; Pages --- or --- &lt;img alt=&quot;&quot; src=&quot;http://www.example.com/image.png&quot; width=&quot;100&quot; height=&quot;20&quot; /&gt; )">[?]</a></th>
				<td>
					<code>
						&lt;a
						class="<input type="text" name="shortcode_class" class="code" value="<?php echo esc_html( $this->option['settings']['shortcode_class'] ); ?>" />"
						style="<input type="text" name="shortcode_style" class="code" value="<?php echo esc_html( $this->option['settings']['shortcode_style'] ); ?>" />"
						&gt;
						<input type="text" id="shortcode_anchor" name="shortcode_anchor" class="code" value="<?php echo esc_html( $this->option['settings']['shortcode_anchor'] ); ?>" />
						&lt;/a&gt;
					</code>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="shortcode_landing_url">Landing URL</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Redirect user here after deletion.">[?]</a></th>
				<td>
					<input type="text" id="shortcode_landing_url" name="shortcode_landing_url" class="code regular-text" value="<?php echo esc_url( $this->option['settings']['shortcode_landing_url'] ); ?>" />
				</td>
			</tr>
			
			<tr>
				<th scope="row">Shortcode <a href="#" onclick="return false;" style="text-decoration: none;" title="Copy and paste this Shortcode into any Post or Page to show the delete link configured above to users with roles as configured above.">[?]</a></th>
				<td>
					<code>[<?php echo $this->info['shortcode']; ?> /]</code>
					<br />
					or
					<br />
					<code>[<?php echo $this->info['shortcode']; ?>]</code>Instead of a delete link, this content is shown to anyone unable to delete themselves.<code>[/<?php echo $this->info['shortcode']; ?>]</code>
				</td>
			</tr>
			
		</table>
		
		<h3>Misc</h3>
		
		<table class="form-table">
			
			<tr>
				<th scope="row"><label for="email_notification">E-mail Notification</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Send a text email with deletion details each time a user deletes themselves using <?php echo $this->info['name']; ?>. This will go to the site administrator email ( i.e. <?php echo get_option( 'admin_email' ); ?> ), the same email address used for new user notification.">[?]</a></th>
				<td>
					<input type="checkbox" id="email_notification" name="email_notification" value="1"<?php echo ( $this->option['settings']['email_notification'] == true ) ? ' checked="checked"' : ''; ?> />
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="uninstall_on_deactivate">Uninstall on Deactivate?</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Remove all settings and capabilities created by this plugin on 'Deactivate'?">[?]</a></th>
				<td>
					<input type="checkbox" id="uninstall_on_deactivate" name="uninstall_on_deactivate" value="1"<?php echo ( $this->option['settings']['uninstall_on_deactivate'] == true ) ? ' checked="checked"' : ''; ?> />
				</td>
			</tr>

                        <tr>
				<th scope="row"><label for="show_on_profile_page">Show on My Profile page?</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Show on wordpress default 'My Profile' page?">[?]</a></th>
				<td>
					<input type="checkbox" id="show_on_profile_page" name="show_on_profile_page" value="1"<?php echo ( $this->option['settings']['show_on_profile_page'] == true ) ? ' checked="checked"' : ''; ?> />
				</td>
			</tr>

                        <tr>
				<th scope="row"><label for="assign_to_user">Assign content to user</label> <a href="#" onclick="return false;" style="text-decoration: none;" title="Assign deleted user's all content to this user">[?]</a></th>
				<td>
                                    <select id="assign_to_user" name="assign_to_user" style="width: 25em;">
                                        <option value="0">None</option>
                                    <?php
                                        for ($ctr = 0;$ctr < count($users);$ctr++) {
                                            if ($users[$ctr]->ID == $this->option['settings']['assign_to_user']) {
                                                $selected = 'selected="selected"';
                                            }
                                            else {
                                                $selected = '';
                                            }

                                    ?>
                                        <option value="<?php echo $users[$ctr]->ID?>" <?php echo $selected?> ><?php echo $users[$ctr]->user_login?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
				</td>
			</tr>
			
		</table>
		
		<p class="submit">
			<?php wp_nonce_field( $form_nonce_action, $form_nonce_name ); ?>
			<input type="submit" class="button-primary" value="Save Changes" />
		</p>
		
	</form>
	
</div>