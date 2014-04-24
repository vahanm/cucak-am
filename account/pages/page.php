<?php
global $wpdb;

?>

<script type="text/javascript">
function scrollTo(el) {
	$(el).ScrollTo({
			duration: 500,
			easing: 'linear'
		});
}
</script>

<?php
	if(isset($_POST['submitButton']))	{
        echo '<div class="saved" freez>' , __('Saved'), '</div>';
	} else {
		$error = '';
	}
	
	$user_id = get_current_user_id();
	if ($user_id == 0) {
		$user_id = 2;
	} else {
		//User meta
		$user_header_image = _pu('header_image');
	}
?>

<?php /////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<form id="form_save_page_settings" name="form_save_settings" method="post" enctype="multipart/form-data">
	<div class="addpostmaindiv">
	<?php
	
	helper_begin('main_category', __('Main category'));
	
	$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'ID', 
		'order'              => 'ASC',
		'show_count'         => 0,
		'hide_empty'         => 0, 
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 1,
		'selected'           => _pu('main_category'),
		'hierarchical'       => 1, 
		'name'               => 'post_main_category',
		'id'                 => 'main_category',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false
		);
	
	wp_dropdown_categories( $args );
	
	helper_end('main_category', __('Main category'));
	
	
	helper_begin('header_image', __('Header image'));
	?>
	<input type="hidden" name="post_header_image" value="<?php 
	if($user_header_image)
		echo replace_quotes($user_header_image);
	else
		echo '';
	?>" id="photos" />
	<iframe src="header-upload.php" id="header-upframe" scrolling="off" style="height: 80px;"></iframe>

	<div id="photos-container">
	<?php
		$info = json_decode(replace_quotes_decode($user_header_image));
			
		$id = MD5($info->name);
		
		switch($info->type)
		{
			case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
				echo '<div id="att_'. $id . '"  class="photo-container">';
				echo '<img style="width: 468px;" alt="' . $info->name . '" src="' . $info->standards_url . '"/>';
				echo '<a class="photos-button-remove">' . __('Remove') . '</a>';
				echo '</div>';
				
				break;
		}
	?>
	</div>	
	<?php
	helper_end('header_image', __('Header image'));
	?>
	</div>
	
	<input type="hidden" name="submitButton" value="submit" />

	<div class="account-controls" style="float: left;">
		<input type="button" value="<?php _e('Save') ?>" id="submitButton" name="submitButton" style="cursor:pointer; width:150px; height:35px;" onclick="submitForm()">
	</div>
</form>

<script>

$(document).ready(function(){
	$('#photos-container .photos-button-remove').live('click', function(){
		$(this).parents('.photo-container').remove();
		$('#form_save_page_settings #photos').val('');
	});
});

function submitForm() {
	$('#form_save_page_settings').submit();
}
</script>
		
