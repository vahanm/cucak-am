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
		$user_photos = _pu('photos');
	}
?>

<?php /////////////////////////////////////////////////////////////////////////////////////////////////////// ?>

<form id="form_save_photos" name="form_save_photos" method="post" enctype="multipart/form-data">
	<input type="hidden" name="post_photos" value="<?php 
	if($user_photos)
		echo replace_quotes($user_photos);
	else
		echo '';
	?>" id="photos" />
	
	<input type="hidden" name="submitButton" value="submit" />
</form>

<div id="photos-page-container">
	<div id="photos-upload-frame">
		<iframe src="photos-upload.php" id="photos-upframe" scrolling="off"></iframe>
	</div>
	<div id="photos-container">
	<?php
	$list = split('[{]json[}]', $user_photos);
	
	$id = 1;
	
	foreach($list as $item)
	{
		if(strlen($item) > 3)
		{
			$info = json_decode(replace_quotes_decode($item));
			
			$id = MD5($info->name);
			
			switch($info->type)
			{
				case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
					echo '<div id="att_'. $id . '"  class="photo-container">';
					echo '<a rel="lightbox[roadtrip]" href="' . $info->big_url . '" target="_new"><img style="" alt="' . $info->name . '" src="' . $info->standards_url . '"/></a>';
					echo '<a class="photos-button-remove">' . __('Remove') . '<div class="file-json" style="display: none;">{json}' . replace_quotes_decode($item) . '</div></a>';
					echo '</div>';
					
					
					break;
			}
		}
	}
	?>
	</div>	

	<div class="account-controls">
		<input type="button" value="<?php _e('Save') ?>" id="submitButton" name="submitButton" style="cursor:pointer; width:150px; height:35px;" onclick="submitForm()">
	</div>
</div>

<script>

$(document).ready(function(){
	$('#photos-container .photos-button-remove').live('click', function(){
		$(this).parents('.photo-container').remove();

		var val = '';

		$('#photos-container .file-json').each(function() {
			val += $(this).text().trim();
		});

		$('#form_save_photos #photos').val(val);
	});
});

function submitForm() {
	$('#form_save_photos').submit();
}
</script>
