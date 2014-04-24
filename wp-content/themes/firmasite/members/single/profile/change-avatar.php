<h4 class="page-header"><?php _e( 'Change Avatar', 'firmasite' ); ?></h4>

<?php do_action( 'bp_before_profile_avatar_upload_content' ); ?>

<?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

	<p><?php _e( 'Your avatar will be used on your profile and throughout the site. If there is a <a href="http://gravatar.com">Gravatar</a> associated with your account email we will use that, or you can upload an image from your computer.', 'firmasite' ); ?></p>

	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">

		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
			<p><?php _e( 'Click below to select a JPG, GIF or PNG format photo from your computer and then click \'Upload Image\' to proceed.', 'firmasite' ); ?></p>

			<p id="avatar-upload">
				<input type="file" name="file" id="file" />
				<input type="submit" class="btn  btn-primary" name="upload" id="upload" value="<?php _e( 'Upload Image', 'firmasite' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_user_has_avatar() ) : ?>
				<p><?php _e( "If you'd like to delete your current avatar but not upload a new one, please use the delete avatar button.", 'firmasite' ); ?></p>
				<p><a class="button btn  edit" href="<?php bp_avatar_delete_link(); ?>" title="<?php _e( 'Delete Avatar', 'firmasite' ); ?>"><?php _e( 'Delete My Avatar', 'firmasite' ); ?></a></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

			<h5><?php _e( 'Crop Your New Avatar', 'firmasite' ); ?></h5>

			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="" alt="<?php _e( 'Avatar to crop', 'firmasite' ); ?>" />

			<div id="avatar-crop-pane">
				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="" alt="<?php _e( 'Avatar preview', 'firmasite' ); ?>" />
			</div>

			<input type="submit" class="btn  btn-primary" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'firmasite' ); ?>" />

			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

		<?php endif; ?>

	</form>

<?php else : ?>

	<p><?php _e( 'Your avatar will be used on your profile and throughout the site. To change your avatar, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'firmasite' ); ?></p>

<?php endif; ?>

<?php do_action( 'bp_after_profile_avatar_upload_content' ); ?>
