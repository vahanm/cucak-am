<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums well">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'firmasite' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>