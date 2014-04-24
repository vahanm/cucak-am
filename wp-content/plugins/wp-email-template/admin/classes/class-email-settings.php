<?php
/**
 * WP Email Template Settings
 *
 * Table Of Contents
 *
 * get_settings_default()
 * set_settings_default()
 * display()
 */
class WP_Email_Template_Settings {
	
	public static $fonts = array( 
					'Arial, sans-serif' => 'Arial',
					'Verdana, Geneva, sans-serif'		=> 'Verdana',
					'Trebuchet MS, Tahoma, sans-serif'		=> 'Trebuchet',
					'Georgia, serif'		=> 'Georgia',
					'Times New Roman, serif'		=> 'Times New Roman',
					'Tahoma, Geneva, Verdana, sans-serif'		=> 'Tahoma',
					'Palatino, Palatino Linotype, serif'		=> 'Palatino',
					'Helvetica Neue, Helvetica, sans-serif'		=> 'Helvetica*',
					'Calibri, Candara, Segoe, Optima, sans-serif'		=> 'Calibri*',
					'Myriad Pro, Myriad, sans-serif'		=> 'Myriad Pro*',
					'Lucida Grande, Lucida Sans Unicode, Lucida Sans, sans-serif'		=> 'Lucida',
					'Arial Black, sans-serif'		=> 'Arial Black',
					'Gill Sans, Gill Sans MT, Calibri, sans-serif'		=> 'Gill Sans*',
					'Geneva, Tahoma, Verdana, sans-serif'		=> 'Geneva*',
					'Impact, Charcoal, sans-serif'		=> 'Impact',
					'Courier, Courier New, monospace'		=> 'Courier',
					'Century Gothic, sans-serif'		=> 'Century Gothic'
					);
	
	function get_settings_default() {
		$wp_email_template_default_settings = array(
			'apply_for_woo_emails'		=> '',
			'email_footer' 				=> get_bloginfo('name').' Email Template powered by <a style="color:#1686e0" href="http://www.a3rev.com/" target="_blank" title="A3 Revolution">A3 Revolution</a> software team.',
			'email_facebook'			=> '',
			'email_twitter'				=> '',
			'email_linkedIn'			=> '',
			'email_pinterest'			=> '',
			'email_googleplus'			=> '',
			
			'base_colour'				=> '#1686E0',
			'header_font'				=> 'Helvetica Neue, Helvetica, sans-serif',
			'header_text_size'			=> '34px',
			'header_text_style'			=> 'italic',
			'header_text_colour'		=> '#FFFFFF',
			
			'background_colour'			=> '#D7D8B0',
			
			'content_background_colour'	=> '#FFFFFF',
			'content_font'				=> 'Century Gothic, sans-serif',
			'content_text_size'			=> '13px',
			'content_text_style'		=> 'italic',
			'content_text_colour'		=> '#0A0A0A',
			'content_link_colour'		=> '#1155CC',
			
			'show_plugin_url'			=> 'yes',
			'plugin_url'				=> 'http://wordpress.org/extend/plugins/wp-email-template/',
		);
		
		return $wp_email_template_default_settings;
	}
	
	function set_settings_default($reset=false) {
		$wp_email_template_settings = get_option('wp_email_template_settings');
		if ( !is_array($wp_email_template_settings) ) $wp_email_template_settings = array();
		
		$wp_email_template_default_settings = WP_Email_Template_Settings::get_settings_default();
		
		$wp_email_template_settings_new = array_merge($wp_email_template_default_settings, $wp_email_template_settings);
		
		if ($reset) {
			update_option('wp_email_template_settings', $wp_email_template_default_settings);
		} else {
			update_option('wp_email_template_settings', $wp_email_template_settings_new);
		}
				
	}
	
	function display() {
		$message = '';
		if (isset($_REQUEST['bt_save_settings'])) {
			update_option('wp_email_template_header_image', $_REQUEST['wp_email_template_header_image']);
			$wp_email_template_default_settings = WP_Email_Template_Settings::get_settings_default();
			
			$wp_email_template_settings = $_REQUEST['wp_email_template_settings'];
			
			$wp_email_template_settings = array_merge($wp_email_template_settings, $wp_email_template_default_settings);
			
			if (!isset($_REQUEST['wp_email_template_settings']['show_plugin_url'])) $wp_email_template_settings['show_plugin_url'] = 'no';
			
			$wp_email_template_settings['apply_for_woo_emails'] = $_REQUEST['wp_email_template_settings']['apply_for_woo_emails'];
			$wp_email_template_settings['email_footer'] = $_REQUEST['wp_email_template_settings']['email_footer'];
			$wp_email_template_settings['email_facebook'] = $_REQUEST['wp_email_template_settings']['email_facebook'];
			$wp_email_template_settings['email_twitter'] = $_REQUEST['wp_email_template_settings']['email_twitter'];
			$wp_email_template_settings['email_linkedIn'] = $_REQUEST['wp_email_template_settings']['email_linkedIn'];
			$wp_email_template_settings['email_pinterest'] = $_REQUEST['wp_email_template_settings']['email_pinterest'];
			$wp_email_template_settings['email_googleplus'] = $_REQUEST['wp_email_template_settings']['email_googleplus'];
			$wp_email_template_settings['background_colour'] = $_REQUEST['wp_email_template_settings']['background_colour'];
			
			
			update_option('wp_email_template_settings', $wp_email_template_settings);
			
			$message = '<div class="updated" id=""><p>'.__('Email Template Settings Successfully saved.', 'wp_email_template').'</p></div>';
		}elseif (isset($_REQUEST['bt_reset_settings'])) {
			WP_Email_Template_Settings::set_settings_default(true);
			$message = '<div class="updated" id=""><p>'.__('Email Template Settings Successfully reseted.', 'wp_email_template').'</p></div>';
		}
		
		$wp_email_template_settings = get_option('wp_email_template_settings');
		$wp_email_template_default_settings = WP_Email_Template_Settings::get_settings_default();
		if ( !is_array($wp_email_template_settings) ) $wp_email_template_settings = $wp_email_template_default_settings;
		?>
        <style type="text/css">
		.form-table { margin:0; }
		input.colorpick{text-transform:uppercase;}
		.icon32-wp-email-template {
			background:url(<?php echo WP_EMAIL_TEMPLATE_IMAGES_URL; ?>/a3-plugins.png) no-repeat left top !important;
		}
		#email_template_upgrade_area { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; padding:0 0; position:relative; float:left; display:block; margin-bottom:10px; }
	   	#email_template_upgrade_inner { background:#FFF; -webkit-border-radius:10px 0 0 10px;-moz-border-radius:10px 0 0 10px;-o-border-radius:10px 0 0 10px; border-radius: 10px 0 0 10px; float:left; width:58%;}
		#email_template_upgrade_inner h3{ margin-left:10px;}
	   	#email_template_upgrade_notice { background:#FFFBCC; -webkit-border-radius:0 10px 10px 0;-moz-border-radius:0 10px 10px 0;-o-border-radius:0 10px 10px 0; border-radius: 0 10px 10px 0; color: #555555; float: right; margin: 0px; padding: 5px 5px 5px 2%; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8); width: 38%; right:0; top:0px;}
        </style>
        <?php 
		
		// Include script admin plugin
		//add_action('admin_footer', array('WP_Email_Template_Hook_Filter', 'admin_plugin_scripts') );
		
		if(trim(get_option("a3rev_wp_email_template_message")) != '') { 
			echo '<div id="" class="updated"><p>'.get_option("a3rev_wp_email_template_message").'</p></div>'; 
			update_option('a3rev_wp_email_template_message', '');
		}
		$preview_wp_email_template = wp_create_nonce("preview_wp_email_template");
		?>
<div class="wrap">
	<div class="icon32 icon32-wp-email-template" id="icon32-wp-email-template"><br></div>
    <h2><?php _e('Email Template Settings', 'wp_email_template'); ?></h2>
	<?php echo $message; ?>
	<form action="options-general.php?page=email_template" method="post" name="email_template_form" id="email_template_form">
		<h3><?php _e('Live Preview', 'wp_email_template'); ?></h3>
        <p><?php _e('For a live preview of changes save them and then', 'wp_email_template'); ?> <a href="<?php echo ( ( is_ssl() || force_ssl_admin() || force_ssl_login() ) ? str_replace( 'http:', 'https:', admin_url( 'admin-ajax.php' ) ) : str_replace( 'https:', 'http:', admin_url( 'admin-ajax.php' ) ) ); ?>?action=preview_wp_email_template&security=<?php echo $preview_wp_email_template; ?>" target="_blank"><?php _e('Click here to preview your email template.', 'wp_email_template'); ?></a></p>
        <h3><?php _e('Template Header', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="wp_email_template_header_image"><?php _e('Header image','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    <?php echo WP_Email_Template_Uploader::upload_input('wp_email_template_header_image', __('Header Image', 'wp_email_template'), '', '<span class="description">'.__("The image you want to show in the email's header", 'wp_email_template').'</span>' ); ?>
                    </td>
               	</tr>
			</tbody>
		</table>
        <h3><?php _e('Template Background', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="background_colour"><?php _e('Background colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[background_colour]" id="background_colour" value="<?php if(isset($wp_email_template_settings['background_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['background_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('Email template background colour. Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['background_colour']; ?></code></span>
            			<div id="colorPickerDiv_background_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
			</tbody>
		</table>
        <div id="email_template_upgrade_area"><?php echo WP_Email_Template_Settings::email_template_upgrade_notice(); ?><div id="email_template_upgrade_inner">
        <table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="deactivate_pattern_background"><?php _e('Deactivate background Pattern','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input disabled="disabled" type="checkbox" name="wp_email_template_settings[deactivate_pattern_background]" id="deactivate_pattern_background" value="yes" /> 
                    <span class="description"><?php _e("Check to deactivate template background pattern", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
			</tbody>
		</table>
        <h3 style=""><?php _e('Email Header', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
				<tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="base_colour"><?php _e('Header background colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[base_colour]" id="base_colour" value="<?php if(isset($wp_email_template_settings['base_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['base_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['base_colour']; ?></code></span>
            			<div id="colorPickerDiv_base_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
                <tr>
                    <th class="titledesc" scope="row"><label for="header_font"><?php _e('Header title font','wp_email_template'); ?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="header_font" name="wp_email_template_settings[header_font]">
                        <?php
                        foreach(WP_Email_Template_Settings::$fonts as $key=>$value){
                            if( isset($wp_email_template_settings['header_font']) && htmlspecialchars( $wp_email_template_settings['header_font'] ) ==  htmlspecialchars($key) ){ ?>
                            	<option value='<?php echo htmlspecialchars($key); ?>' selected='selected'><?php echo $value; ?></option>
						<?php }else{ ?>
                              	<option value='<?php echo htmlspecialchars($key); ?>'><?php echo $value; ?></option>
                        <?php }
                        }
                        ?>                                  
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo WP_Email_Template_Settings::$fonts[$wp_email_template_default_settings['header_font']]; ?></code></span>
                    </td>
				</tr>
				<tr>
                    <th class="titledesc" scope="row"><label for="header_text_size"><?php _e('Font size', 'wp_email_template');?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="header_text_size" name="wp_email_template_settings[header_text_size]">
                        <?php
                        for( $i = 9 ; $i <= 40 ; $i++ ){
                            if( isset($wp_email_template_settings['header_text_size']) && $wp_email_template_settings['header_text_size'] ==  $i.'px' ){
                            ?>
                                <option value='<?php echo ($i); ?>px' selected='selected'><?php echo $i; ?>px</option>
                            <?php }else{ ?>
                                <option value='<?php echo ($i); ?>px'><?php echo $i; ?>px</option>
                            <?php
                            }
                        }
                        ?>                                  
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['header_text_size']; ?></code></span>
                    </td>
		  		</tr>
          		<tr>
                    <th class="titledesc" scope="row"><label for="header_text_style"><?php _e('Font style', 'wp_email_template');?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="header_text_style" name="wp_email_template_settings[header_text_style]">
                          <option <?php if( isset($wp_email_template_settings['header_text_style']) && $wp_email_template_settings['header_text_style'] == 'normal'){ echo 'selected="selected" ';} ?>value="normal"><?php _e('Normal', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['header_text_style']) && $wp_email_template_settings['header_text_style'] == 'italic'){ echo 'selected="selected" ';} ?>value="italic"><?php _e('Italic', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['header_text_style']) && $wp_email_template_settings['header_text_style'] == 'bold'){ echo 'selected="selected" ';} ?>value="bold"><?php _e('Bold', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['header_text_style']) && $wp_email_template_settings['header_text_style'] == 'bold_italic'){ echo 'selected="selected" ';} ?>value="bold_italic"><?php _e('Bold/Italic', 'wp_email_template');?></option>
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php _e('Italic', 'wp_email_template');?></code></span>
                    </td>
				</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="header_text_colour"><?php _e('Colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[header_text_colour]" id="header_text_colour" value="<?php if(isset($wp_email_template_settings['header_text_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['header_text_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['header_text_colour'] ?></code></span>
            			<div id="colorPickerDiv_header_text_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
			</tbody>
		</table>
        <h3><?php _e('Email Body', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="content_background_colour"><?php _e('Email body background colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[content_background_colour]" id="content_background_colour" value="<?php if(isset($wp_email_template_settings['content_background_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['content_background_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('The main body background colour. Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['content_background_colour'] ?></code></span>
            			<div id="colorPickerDiv_content_background_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
            	<tr>
                    <th class="titledesc" scope="row"><label for="content_font"><?php _e('Font','wp_email_template'); ?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="content_font" name="wp_email_template_settings[content_font]">
                        <?php
                        foreach(WP_Email_Template_Settings::$fonts as $key=>$value){
                            if( isset($wp_email_template_settings['content_font']) && htmlspecialchars( $wp_email_template_settings['content_font'] ) ==  htmlspecialchars($key) ){ ?>
                            	<option value='<?php echo htmlspecialchars($key); ?>' selected='selected'><?php echo $value; ?></option>
						<?php }else{ ?>
                              	<option value='<?php echo htmlspecialchars($key); ?>'><?php echo $value; ?></option>
                        <?php }
                        }
                        ?>                                  
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo WP_Email_Template_Settings::$fonts[$wp_email_template_default_settings['content_font']]; ?></code></span>
                    </td>
				</tr>
                <tr>
                    <th class="titledesc" scope="row"><label for="content_text_size"><?php _e('Font size', 'wp_email_template');?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="content_text_size" name="wp_email_template_settings[content_text_size]">
                        <?php
                        for( $i = 9 ; $i <= 29 ; $i++ ){
                            if( isset($wp_email_template_settings['content_text_size']) && $wp_email_template_settings['content_text_size'] ==  $i.'px' ){
                            ?>
                                <option value='<?php echo ($i); ?>px' selected='selected'><?php echo $i; ?>px</option>
                            <?php }else{ ?>
                                <option value='<?php echo ($i); ?>px'><?php echo $i; ?>px</option>
                            <?php
                            }
                        }
                        ?>                                  
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['content_text_size']; ?></code></span>
                    </td>
		  		</tr>
                <tr>
                    <th class="titledesc" scope="row"><label for="content_text_style"><?php _e('Font style', 'wp_email_template');?></label></th>
                    <td class="forminp">
                        <select class="chzn-select" style="width:120px;" id="content_text_style" name="wp_email_template_settings[content_text_style]">
                          <option <?php if( isset($wp_email_template_settings['content_text_style']) && $wp_email_template_settings['content_text_style'] == 'normal'){ echo 'selected="selected" ';} ?>value="normal"><?php _e('Normal', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['content_text_style']) && $wp_email_template_settings['content_text_style'] == 'italic'){ echo 'selected="selected" ';} ?>value="italic"><?php _e('Italic', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['content_text_style']) && $wp_email_template_settings['content_text_style'] == 'bold'){ echo 'selected="selected" ';} ?>value="bold"><?php _e('Bold', 'wp_email_template');?></option>
                          <option <?php if( isset($wp_email_template_settings['content_text_style']) && $wp_email_template_settings['content_text_style'] == 'bold_italic'){ echo 'selected="selected" ';} ?>value="bold_italic"><?php _e('Bold/Italic', 'wp_email_template');?></option>
                        </select> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php _e('Italic', 'wp_email_template');?></code></span>
                    </td>
				</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="content_text_colour"><?php _e('Email body text colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[content_text_colour]" id="content_text_colour" value="<?php if(isset($wp_email_template_settings['content_text_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['content_text_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['content_text_colour'] ?></code></span>
            			<div id="colorPickerDiv_content_text_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="content_link_colour"><?php _e('Email body link text colour','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="text" class="colorpick" name="wp_email_template_settings[content_link_colour]" id="content_link_colour" value="<?php if(isset($wp_email_template_settings['content_link_colour'])) esc_attr_e( stripslashes($wp_email_template_settings['content_link_colour']) );?>" style="width:120px;" /> <span class="description"><?php _e('Default', 'wp_email_template');?> <code><?php echo $wp_email_template_default_settings['content_link_colour'] ?></code></span>
            			<div id="colorPickerDiv_content_link_colour" class="colorpickdiv" style="z-index: 100;background:#eee;border:1px solid #ccc;position:absolute;display:none;"></div>
                    </td>
               	</tr>
			</tbody>
		</table>
        </div>
        </div>
        <h3><?php _e('Follow Us On', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_facebook"><?php _e('Facebook URI','wp_email_template'); ?></label></th>
                    <td class="forminp"><input type="text" name="wp_email_template_settings[email_facebook]" id="email_facebook" value="<?php if(isset($wp_email_template_settings['email_facebook'])) esc_attr_e( stripslashes($wp_email_template_settings['email_facebook']) );?>" style="min-width:300px" /> <span class="description"><?php _e("Enter your facebook URL to show that linked icon in footer.", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_twitter"><?php _e('Twitter URI','wp_email_template'); ?></label></th>
                    <td class="forminp"><input type="text" name="wp_email_template_settings[email_twitter]" id="email_twitter" value="<?php if(isset($wp_email_template_settings['email_twitter'])) esc_attr_e( stripslashes($wp_email_template_settings['email_twitter']) );?>" style="min-width:300px" /> <span class="description"><?php _e("Enter your Twitter URL to show that linked icon in footer.", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_linkedIn"><?php _e('LinkedIn URI','wp_email_template'); ?></label></th>
                    <td class="forminp"><input type="text" name="wp_email_template_settings[email_linkedIn]" id="email_linkedIn" value="<?php if(isset($wp_email_template_settings['email_linkedIn'])) esc_attr_e( stripslashes($wp_email_template_settings['email_linkedIn']) );?>" style="min-width:300px" /> <span class="description"><?php _e("Enter your Linkedin URL to show that linked icon in footer.", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_pinterest"><?php _e('Pinterest URI','wp_email_template'); ?></label></th>
                    <td class="forminp"><input type="text" name="wp_email_template_settings[email_pinterest]" id="email_pinterest" value="<?php if(isset($wp_email_template_settings['email_pinterest'])) esc_attr_e( stripslashes($wp_email_template_settings['email_pinterest']) );?>" style="min-width:300px" /> <span class="description"><?php _e("Enter your Pinterest URL to show that linked icon in footer.", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_googleplus"><?php _e('Google+1 URI','wp_email_template'); ?></label></th>
                    <td class="forminp"><input type="text" name="wp_email_template_settings[email_googleplus]" id="email_googleplus" value="<?php if(isset($wp_email_template_settings['email_googleplus'])) esc_attr_e( stripslashes($wp_email_template_settings['email_googleplus']) );?>" style="min-width:300px" /> <span class="description"><?php _e("Enter your Google+1 URL to show that linked icon in footer.", 'wp_email_template'); ?></span>
                    </td>
               	</tr>
			</tbody>
		</table>
        <h3><?php _e('Email Footer Content', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="email_footer"><?php _e('Email footer text','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    <textarea style="width:100%;height:200px" name="wp_email_template_settings[email_footer]" id="email_footer"><?php if(isset($wp_email_template_settings['email_footer'])) esc_attr_e( stripslashes(strip_tags($wp_email_template_settings['email_footer'], '<p><strong><i><u>') ) );?></textarea>
                    <p class="description"><?php echo htmlspecialchars( __('The text to appear in the footer of the email template. Allowed HTML tags <p> <strong> <i> <u>', 'wp_email_template') ); ?></p>
                    </td>
               	</tr>
        	</tbody>
		</table>
		<h3><?php _e('WooCommerce Configuration', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for=""><?php _e('Apply to WooCommerce emails','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    	<input type="radio" name="wp_email_template_settings[apply_for_woo_emails]" id="apply_for_woo_emails_yes" value="yes" <?php if(isset($wp_email_template_settings['apply_for_woo_emails']) && esc_attr($wp_email_template_settings['apply_for_woo_emails']) == 'yes') echo 'checked="checked"';?> /> <label for="apply_for_woo_emails_yes"><?php _e('Yes','wp_email_template'); ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <input type="radio" name="wp_email_template_settings[apply_for_woo_emails]" id="apply_for_woo_emails_no" value="" <?php if(!isset($wp_email_template_settings['apply_for_woo_emails']) || esc_attr($wp_email_template_settings['apply_for_woo_emails']) != 'yes' ) echo 'checked="checked"';?> /> <label for="apply_for_woo_emails_no"><?php _e('No','wp_email_template'); ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <span class="description"><?php _e('If WooCommerce is installed, select YES to apply this template to all WooCommerce emails.', 'wp_email_template');?></span>
                    </td>
               	</tr>
			</tbody>
		</table>
		<h3><?php _e('Help Promote This Plugin', 'wp_email_template'); ?></h3>
		<table cellspacing="0" class="form-table">
			<tbody>
                <tr valign="top">
                    <th class="titledesc" scope="rpw"><label for="show_plugin_url"><?php _e('WP Email Template','wp_email_template'); ?></label></th>
                    <td class="forminp">
                    <input type="checkbox" name="wp_email_template_settings[show_plugin_url]" id="show_plugin_url" value="yes" <?php if(!isset($wp_email_template_settings['show_plugin_url']) || $wp_email_template_settings['show_plugin_url'] != 'no' ) echo 'checked="checked"'; ?>  /> 
                    <span><?php _e('Help spread the word by showing this at the bottom of your emails. The text is linked to the plugins WordPress.org page.', 'wp_email_template'); ?></span>
                    </td>
               	</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" value="<?php _e('Save Changes', 'wp_email_template'); ?>" class="button-primary" name="bt_save_settings" id="bt_save_settings"> 
			<input type="submit" name="bt_reset_settings" id="bt_reset_settings" class="button" value="<?php _e('Reset Settings', 'wp_email_template'); ?>"  />
		</p>
	</form>
</div>
		<?php
	}
	
	function email_template_upgrade_notice() {
		$html = '';
		$html .= '<div id="email_template_upgrade_notice">';
		$html .= '<a href="http://a3rev.com/shop/" target="_blank" style="float:right;margin-top:5px; margin-left:10px;" ><img src="'.WP_EMAIL_TEMPLATE_IMAGES_URL.'/a3logo.png" /></a>';
		$html .= '<h3>'.__('Upgrade to WP Email Template Pro', 'wp_email_template').'</h3>';
		$html .= '<p>'.__("Visit the", 'wp_email_template').' <a href="'.WP_EMAIL_TEMPLATE_AUTHOR_URI.'" target="_blank">'.__("a3rev website", 'wp_email_template').'</a> '.__("to see all the extra features the Pro version of this plugin offers inside this yellow box.", 'wp_email_template').'</p>';
		$html .= '<h3>'.__('Plugin Documentation', 'wp_email_template').'</h3>';
		$html .= '<p>'.__('All of our plugins have comprehensive online documentation. Please refer to the plugins docs before raising a support request', 'wp_email_template').'. <a href="http://docs.a3rev.com/user-guides/wordpress/wp-email-template/" target="_blank">'.__('Visit the a3rev wiki.', 'wp_email_template').'</a></p>';
		$html .= '<h3>'.__('More a3rev Quality Plugins', 'wp_email_template').'</h3>';
		$html .= '<p>'.__('Below is a list of the a3rev plugins that are available for free download from wordpress.org', 'wp_email_template').'</p>';
		$html .= '<h3>'.__('WordPress Plugins', 'wp_email_template').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/page-views-count/" target="_blank">'.__('Page View Count', 'wp_email_template').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		
		$html .= '<h3>'.__('WooCommerce Plugins', 'wp_email_template').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/woocommerce-dynamic-gallery/" target="_blank">'.__('WooCommerce Dynamic Products Gallery', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/woocommerce-predictive-search/" target="_blank">'.__('WooCommerce Predictive Search', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/woocommerce-compare-products/" target="_blank">'.__('WooCommerce Compare Products', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/woo-widget-product-slideshow/" target="_blank">'.__('WooCommerce Widget Product Slideshow', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/woocommerce-email-inquiry-cart-options/" target="_blank">'.__('WooCommerce Email Inquiry & Cart Options', 'wp_email_template').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		
		$html .= '<h3>'.__('WP e-Commerce Plugins', 'wp_email_template').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/wp-e-commerce-dynamic-gallery/" target="_blank">'.__('WP e-Commerce Dynamic Gallery', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/wp-e-commerce-predictive-search/" target="_blank">'.__('WP e-Commerce Predictive Search', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/wp-ecommerce-compare-products/" target="_blank">'.__('WP e-Commerce Compare Products', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/wp-e-commerce-catalog-visibility-and-email-inquiry/" target="_blank">'.__('WP e-Commerce Catalog Visibility & Email Inquiry', 'wp_email_template').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/extend/plugins/wp-e-commerce-grid-view/" target="_blank">'.__('WP e-Commerce Grid View', 'wp_email_template').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '</div>';
		return $html;
	}
}
?>