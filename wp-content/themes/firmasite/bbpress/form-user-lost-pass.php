<?php

/**
 * User Lost Password Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form method="post" action="<?php bbp_wp_login_action( array( 'action' => 'lostpassword', 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<fieldset class="bbp-form">
		<legend><?php _e( 'Lost Password', 'firmasite' ); ?></legend>

		<div class="bbp-username">
			<p>
				<label for="user_login" class="hide"><?php _e( 'Username or Email', 'firmasite' ); ?>: </label>
				<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
			</p>
		</div>

		<div class="bbp-submit-wrapper">

			<?php do_action( 'login_form', 'resetpass' ); ?>

			<button type="submit" class="btn btn-primary" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><?php _e( 'Reset My Password', 'firmasite' ); ?></button>

			<?php bbp_user_lost_pass_fields(); ?>

		</div>
	</fieldset>
</form>
