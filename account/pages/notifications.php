<?php global $wpdb; ?>

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
