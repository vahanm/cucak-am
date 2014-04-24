<?php

/**
 * User Registration Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<fieldset class="bbp-form">
		<legend><?php _e( 'Create an Account', 'firmasite' ); ?></legend>

		<div class="bbp-template-notice alert alert-block alert-info">
			<p><?php _e( 'Your username must be unique, and cannot be changed later.', 'firmasite' ) ?></p>
			<p><?php _e( 'We use your email address to email you a secure password and verify your account.', 'firmasite' ) ?></p>

		</div>

		<div class="bbp-username">
			<label for="user_login"><?php _e( 'Username', 'firmasite' ); ?>: </label>
			<input type="text" name="user_login" value="<?php bbp_sanitize_val( 'user_login' ); ?>" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<div class="bbp-email">
			<label for="user_email"><?php _e( 'Email', 'firmasite' ); ?>: </label>
			<input type="text" name="user_email" value="<?php bbp_sanitize_val( 'user_email' ); ?>" size="20" id="user_email" tabindex="<?php bbp_tab_index(); ?>" />
		</div>

		<?php do_action( 'register_form' ); ?>

		<div class="bbp-submit-wrapper">

			<button type="submit" class="btn btn-primary" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Register', 'firmasite' ); ?></button>

			<?php bbp_user_register_fields(); ?>

		</div>
	</fieldset>
</form>
