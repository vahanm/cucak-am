<?php

function helper_select_mobile()
{
    include_once '/db/mobile.json.php';

	$jsonstr = get_json_mobile();
	$json = json_decode($jsonstr, true);
?>

<div class="addpostinnerdiv" id="container_producer" <?php the_hint('producer'); ?>>
	<div class="addpostlbl">
		<p> <?php _e('Producer') ?> : </p>
		</div>
		<div class="addpostctrl">
		<p>
		<select id="producer" name="post_producer">
			<option value="" <?php if($_POST['post_producer'] == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>

			<?php foreach ( $json as $key => $value ) { ?>
				<option value="<?php echo $key; ?>" <?php if($_POST['post_producer'] == $key) { ?> selected="selected" <?php } ?> ><?php echo $key; ?></option>
			<?php } ?>
			</select>
		</p>
	</div>
</div>

<div class="addpostinnerdiv" id="container_model" <?php the_hint('model'); ?>>
	<div class="addpostlbl">
		<p> <?php _e('Model') ?> : </p>
		</div>
		<div class="addpostctrl">
		<p>
		<select id="model" name="post_model">
			<option value="" <?php if($_POST['post_model'] == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>

			<?php
				if($_POST['post_producer'] != '')
				foreach ( $json as $key => $value ) { 
					if($key == $_POST['post_producer']) {
						foreach ( $value as $key => $value ) { ?>
							<option value="<?php echo $value['value']; ?>" <?php if($_POST['post_model'] == $value['value']) { ?> selected="selected" <?php } ?> ><?php echo $value['label']; ?></option>
			<?php } } } ?>
		</select>
		</p>
	</div>
</div>

<script type="text/javascript">
	var models = '';
	
	$(document).ready(function(){
		$('#producer').change(function(){
			$('#model option[value!=""]').remove();
			
			var selectedProducer = $('#producer').val();
			
			if(selectedProducer != '') {
				$.getJSON('http://ads.parap.am/wp-content/plugins/ba-includes/ba-helpers/db/mobile.json', function(data) {
					$.each(data, function(producer, models) {
						if(producer == selectedProducer) {
							$.each(models, function(key, val) {
								$('<option value="' + val['value'] + '">' + val['label'] + '</option>').appendTo('#model');
							});
						}
					});
				});
			}
		});	
	});
</script>
<?php
}