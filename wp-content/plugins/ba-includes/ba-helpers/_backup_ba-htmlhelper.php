<?php
/* Plugin Name: BA HTML Helper
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: HTML helper
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/

include 'ba-helpers/ba-helper-filters.php';
include 'ba-helpers/ba-helper-filter-renderers.php';
include 'ba-helpers/ba-helper-price.php';
include 'ba-helpers/ba-helper-mobile.php';
include 'ba-helpers/ba-helper-cars.php';
include 'ba-helpers/ba-helper-salary.php';
include 'ba-helpers/ba-helper-color.php';
include 'ba-helpers/ba-helper-home.php';

//////////////////////////////////////////////////////////////////

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-htmlhelper', $plugindir . '/ba-htmlhelper.js');


function helper_group($id, $title)
{
?>
<div class="addpostinnerdiv addpostgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_group

function helper_group_required($id, $title)
{
?>
<div class="addpostinnerdiv addpostrequiredgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_subgroup_required

function helper_group_sub($id, $title)
{
?>
<div class="addpostinnerdiv addpostsubgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_group_sub

function helper_group_optional($id, $title)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_group_optional

function helper_group_optional_begin($id, $title)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_group_optional_begin

function helper_group_optional_end($id)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //helper_group_optional_end

if (!function_exists('replace_quotes'))
{
	function replace_quotes($text) {
		$healthy = array('\\\'', '\"', '\\\\');
		$yummy   = array('\'', '"', '\\');
		
		$tmp = $text;
		
		$tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
		$tmp = str_replace($healthy, $yummy, $tmp);
		$tmp = htmlspecialchars($tmp, ENT_QUOTES);
		
		return $tmp;
	}
}

if (!function_exists('replace_quotes_decode'))
{
	function replace_quotes_decode($text) {
		$healthy = array('\\\'', '\"', '\\\\');
		$yummy   = array('\'', '"', '\\');
		
		$tmp = $text;
		
		$tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
		$tmp = str_replace($healthy, $yummy, $tmp);
		//$tmp = htmlspecialchars($tmp, ENT_QUOTES);
		
		return $tmp;
	}
}
function helper_upload()
{
?>
			<div class="addpostinnerdiv">
			<div class="addpostlbl">
				<p>
					<?php _e('Article Content') ?>:</p>
					</div>
					<div class="addpostctrl">
					
					<?php	include 'ba-upload/upload.php'; ?>

				</p>
			</div>
		</div>
		<?php
	}

function helper_upload_old()
	{
		/*
		?>
			<script>
			function OnChangeThumbnail(e) {
				$(#att).find('label').fadeIn();
				
				$(e.srcElement).parent().find('label').fadeOut();
			}
			
		//		$('#att input:radio[name="post_thumbnail"]').live("change", function(e){
		//			$(#att).find('label').fadeIn();
		//			
		//			$(e.srcElement).parent().find('label').fadeOut();
		//			
		//			alert('OK');
		//		});
			
			</script>
								<?php */ ?>
<div class="addpostinnerdiv" id="container_filebox" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p>
			<?php _e('Files / Images') ?>:</p>
			</div>
			<input id="attfiles" name="attfiles" type="hidden" value="<?php 
			if($_POST['attfiles'])
			{
				echo replace_quotes($_POST['attfiles']);
			}
			else
			{
				echo '';
			}
			?>" />
	<div class="addpostctrl" id="att">
		<div class="addpostctrl">
			<p>
				<iframe src="upload.php" class="upframe" scrolling="no"> </iframe>
			</p>
		</div>
	<?php 
	//echo str_replace('', '', replace_quotes_decode($_POST['attfiles']));
	
	$format = $_POST['attfiles'];
	
	$list = split('[{]json[}]', $format);
	
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
					echo '<div id="att_'. $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; display: inline-block;">';
					//echo '<label id="thumbnail_button_'. $id . '" for="thumbnail_'. $id . '">' . ('Set as thumbnail') . '</label>';
					//echo '<input onChange="OnChangeThumbnail(this)" type="radio" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '" />';
					//echo '<input style="display: none;" type="radio" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '" />';
					echo '<div style="position: absolute; width: 20px; height: 20px; background-color: white; border-bottom-right-radius: 7px;"></div>';
					
					if($_POST['post_thumbnail'] == $info->thumbnail_url)
						echo '<input type="radio" style="position: absolute;" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '" checked="checked" />';
					else
						echo '<input type="radio" style="position: absolute;" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '"  />';
					
					
					echo '<a href="' . $info->url . '" target="_new"><img style="" alt="' . $info->name . '" src="' . $info->standards_url . '"/></a>' . '<br />';
					break;
				case 'application/msword': case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/doc.png"/></a>';
					break;
				case 'text/plain':
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/text.png"/></a>';
					break;
				case 'application/vnd.ms-excel': case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/excel.png"/></a>';
					break;
				case 'application/x-zip-compressed':
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/archive.png"/></a>';
					break;
				case 'application/pdf':
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/pdf.png"/></a>';
					break;
				default:
					echo '<div id="att_' . $id . '" style="border: solid 1px #DDDDDD; padding: 4px; margin-top: 3px; vertical-align:top; text-align:center; width: 150px; display: inline-block;">';
					echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/unknown.png"/></a>';
			}
			
			echo '<br/>';
			
			//echo '<a href="' . $info->url . '" target="_new">' . $info->name . '</a><br />';
			echo '<input type="text" name="post_file_' . MD5($info->name) . '" id="file_' . MD5($info->name) . '" style="width: 90%" defaultvalue="' . __('') . '" value="' . _p('file_' . MD5($info->name)) . '" />';
			echo '<br/>';
			echo 'Size: ' . formatSizeUnits($info->size);
			echo '<a class="button-remove-file" style="color: #f31;">' . __('Remove') . '<div class="file-json" style="display: none;">{json}' . replace_quotes_decode($item) . '</div></a>';
			echo '</div>';
		}
	}
	?>
	</div>	
	<br />
</div>

<script>
	
	$(document).ready(function(){
		$('#container_filebox .button-remove-file').live('click', function(){
			$(this).parent().remove();
					
			if ($(parent.document).find('#att input:radio:checked').length == 0) {
				$(parent.document).find('#att input:radio:first').attr('checked', 'checked');
			}

			var val = '';
			
			$('#container_filebox .file-json').each(function() {
				val += $(this).text().trim();
			});
			
			$('#container_filebox #attfiles').val(val);
		});
	});

</script>
<?php
}

function helper_radio($id, $title, $values, $cols = 4)
{
	helper_begin($id, $title);
?>
		<table class="checkgrid">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
			
			echo '<td>';
		?>
			<input type="radio" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if($_POST['post_' . $id] == $v[0]) { ?> checked="checked" <?php } ?> />
			<label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
			<?php
			
			echo '</td>';
			
			if($i % $cols == $cols - 1)
				echo '</tr>';
			
			$i++;
		}
		if($i % $cols != 0)
			echo '</tr>';
		?>
		</table>
<?php
	helper_end($id, $title);
} //helper_radio

function helper_select($id, $title, $values)
{
	helper_begin($id, $title);
?>
	<select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
		<option value="" <?php if($_POST['post_' . $id] == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
			
		<?php foreach ( $values as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" style="<?php if(isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if(isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if($_POST['post_' . $id] == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
		<?php } ?>
		</select>
		<br/>
			
		<?php if(WP_TRANS) { ?>
			<ui id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">				
			<?php foreach ( $values as $v ) { ?>
				<li ><?php echo $v[1]; ?></li>
			<?php } ?>
			</ui>
		<?php } ?>
<?php
	helper_end($id, $title);
} //helper_select

function helper_yearselector($id, $title, $beginvalue, $endvalue)
{
	helper_begin($id, $title);
?>
		<select id="<?php echo $id; ?>"  name="post_<?php echo $id; ?>" class="txtareabgcurrency">
				<option value="0" selected="selected">
				<?php _e('Select year') ?>
				</option>
				<option value="<?php echo $beginvalue ?>" <?php if($_POST['post_' . $id] == $beginvalue) { echo 'selected="selected"'; } ?>><?php echo sprintf(__('%s and older'), $beginvalue); ?></option>
				<?php for($i = $beginvalue + 1; $i <= $endvalue; $i++) { ?>
				<option value="<?php echo $i; ?>" <?php if($_POST['post_' . $id] == $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
		<script type="text/javascript">
		$(function() {
			var select_<?php echo $id; ?> = $( "#<?php echo $id; ?>" );
			var slider_<?php echo $id; ?> = $( "<div id='slider_<?php echo $id; ?>'></div>" ).insertAfter( select_<?php echo $id; ?> ).slider({
				min: 1,
				max: <?php echo 2 + $endvalue - $beginvalue ?>,
				range: "min",
				value: select_<?php echo $id; ?>[ 0 ].selectedIndex + 1,
				slide: function( event, ui ) {
					select_<?php echo $id; ?>[ 0 ].selectedIndex = ui.value - 1;
				}
			});
			
			$("<br /><br />").insertAfter( select_<?php echo $id; ?> );
			
			$( "#<?php echo $id; ?>" ).change(function() {
				slider_<?php echo $id; ?>.slider( "value", this.selectedIndex + 1 );
			});
		});
		</script> 
<?php
	helper_end($id, $title);
} //helper_yearselector

function helper_check_key($id, $title, $key, $values, $cols = 4, $maxcount = 0)
{
	helper_begin($id, $title);
?>
		<input type="checkbox" id="<?php echo $id; ?>_key_<?php echo $key[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $key[0]; ?>" class="checkareabgsum" value="1" <?php if($_POST['post_' . $id . '_' . $key[0]] == 1) { ?> checked="checked" <?php } ?> />
			<label for="<?php echo $id; ?>_key_<?php echo $key[0]; ?>"> <?php echo $key[1]; ?> </label>
					<br />
					
			<div id="<?php echo $id; ?>_subs" style="border-top: 1px solid #eee; <?php if($_POST['post_' . $id . '_' . $key[0]] == 1) { ?> display:none; <?php } ?>">
		<table class="checkgrid">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
			
			echo '<td>';
		?>
				<?php //foreach ( $values as $v ) { ?>
					<input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum switch_<?php echo $id; ?>" value="1" <?php if($_POST['post_' . $id . '_' . $v[0]] == 1) { ?> checked="checked" <?php } ?> />
					<label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
				<?php //} ?>
			<?php
			
			echo '</td>';
			
			if($i % $cols == $cols - 1)
				echo '</tr>';
			
			$i++;
		}
		if($i % $cols != 0)
			echo '</tr>';
		?>
		</table>
			</div>
<script type="text/javascript">

$("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").change(function(){
	if ($("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").is(':checked')) 
	{
		$("#<?php echo $id; ?>_subs").slideUp("fast");
		
		$('input.switch_<?php echo $id; ?>').attr('checked', false);
	}
	else
	{
		$("#<?php echo $id; ?>_subs").slideDown("fast");
	}
});

</script>
<?php
	helper_end($id, $title);
} //helper_check

function helper_check($id, $title, $values, $cols = 4, $maxcount = 0)
{
	helper_begin($id, $title);
?>
		<table class="checkgrid">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
			
			echo '<td>';
		?>
			<input type="checkbox" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum" value="1" <?php if($_POST['post_' . $id . '_' . $v[0]] == 1) { ?> checked="checked" <?php } ?> />
			<label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
			</span>
			<?php
			
			echo '</td>';
			
			if($i % $cols == $cols - 1)
				echo '</tr>';
			
			$i++;
		}
		if($i % $cols != 0)
			echo '</tr>';
		?>
		</table>
<script type="text/javascript">

$("#<?php echo $id; ?>_<?php echo $key[0]; ?>").change(function(){
	if ($("#<?php echo $id; ?>_<?php echo $key[0]; ?>").is(':checked')) 
	{
		$("#<?php echo $id; ?>_subs").fadeOut("slow");
	}
	else
	{
		$("#<?php echo $id; ?>_subs").fadeIn("slow");
	}
});

</script>
<?php
	helper_end($id, $title);
} //helper_check

function helper_yes_no($id, $title, $half = false)
{
helper_begin($id, $title, $half);
?>
		<input type="hidden" id="<?php echo $id; ?>" name="post_<?php echo $id; ?>" value="<?php echo $_POST['post_' . $id]; ?>" />
		
		<div id="<?php echo $id; ?>_img_yes" class="check-span check-yes"></div>
		<div id="<?php echo $id; ?>_img_no" class="check-span check-no"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#<?php echo $id; ?>_img_no').click(statechanged_<?php echo $id; ?>_no);
		$('#<?php echo $id; ?>_img_yes').click(statechanged_<?php echo $id; ?>_yes);
		
		var val = $('#<?php echo $id; ?>').val();
		
		if(val == 1) {
			$('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
		} else if(val == 2) {
			$('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
		}
	});
	
	function statechanged_<?php echo $id; ?>_no()
	{
		$('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
		$('#<?php echo $id; ?>_img_yes').addClass('check-yes');
		$('#<?php echo $id; ?>_img_yes').removeClass('check-yes-checked');
		
		if($('#<?php echo $id; ?>_img_no').hasClass('check-no-checked')) {
			$('#<?php echo $id; ?>').val('1');
		} else {
			$('#<?php echo $id; ?>').val('');
		}
	}
	
	function statechanged_<?php echo $id; ?>_yes()
	{
		$('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
		$('#<?php echo $id; ?>_img_no').addClass('check-no');
		$('#<?php echo $id; ?>_img_no').removeClass('check-no-checked');
		
		if($('#<?php echo $id; ?>_img_yes').hasClass('check-yes-checked')) {
			$('#<?php echo $id; ?>').val('2');
		} else {
			$('#<?php echo $id; ?>').val('');
		}
	}
</script>
<?php

helper_end($id, $title);
} //helper_yes_no

function helper_slider($id, $title, $value, $rate = 1, $min, $max, $text, $begin = '', $end = '')
{
	helper_begin($id, $title);
?>
			<input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php echo $_POST['post_' . $id]; ?>" size="30" name="post_<?php echo $id; ?>" />
		
		<?php
		
		$per = 100 / ($max - $min + 1);
		
		if($per < 4) $per = 4;
		if($per > 30) $per = 30;
		
		?>
		<!--	
		<div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
		<div style="width:20%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php echo $min * $rate ?></div>
		<div id="<?php echo $id; ?>_view" style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; font-weight:bold; font-size: 120%"><?php echo $value ?></div>
		<div style="width:20%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php echo $max * $rate ?></div>
				
		<br />
		<div id="slider_<?php echo $id ?>"></div>
		-->
		
		<div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; font-weight:bold; font-size: 120%"><?php echo $value ?></div>
		
		<br />
		<!-- Begin - Slite for total_area -->
		<div id="slider_<?php echo $id ?>"></div>
		
		<div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
		<div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if($begin == '') echo _f($text, $min * $rate); else echo _f($begin, $min * $rate); ?></div>
		<div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max * $rate); else echo _f($end, $max * $rate); ?></div>
		
		<!-- 
		<div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php echo $min * $rate ?></div>
		<div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php echo $max * $rate ?></div>
		-->
		<script type="text/javascript">
		$(document).ready(function() {
		$('#slider_<?php echo $id; ?>').slider({
				range: 'min',
				value: <?php if($_POST['post_' . $id] != '') { echo ($_POST['post_' . $id] / $rate); } else { echo $min - 1; }; ?>,
				min: <?php echo $min - 1 ?>,
				max: <?php echo $max ?>,
				slide: function( event, ui ) {
				
				if(ui.value > <?php echo $min - 1 ?>) {
				
				$( '#<?php echo $id ?>' ).val(Math.round(1000 * (  ui.value * <?php echo $rate ?> )) / 1000);
				
				var str_<?php echo $id ?> = '<?php echo $text ?>';
				
				$( '#<?php echo $id ?>_view' ).text( str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.value * <?php echo $rate ?>)) / 1000) );
				
				} else {
				
				$( '#<?php echo $id ?>' ).val( '' );
				$( '#<?php echo $id ?>_view' ).text('<?php echo $value ?>');
				
				} // if
				} // slide: function
				}) // $slider

				if($( '#slider_<?php echo $id ?>' ).slider( 'value' ) > <?php echo $min - 1 ?>) {
				var str_<?php echo $id ?> = '<?php echo $text ?>';
				$( '#<?php echo $id ?>_view' ).text( str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'value' ) * <?php echo $rate ?>)) / 1000 ));
				} else {
				$( '#<?php echo $id ?>' ).val( '' );
				$( '#<?php echo $id ?>_view' ).text('<?php echo $value ?>');
				} // if
				
				
				}); // $(document).ready

				</script> 
				<!-- End --- Slite for total_area -->
				
				<?php

				helper_end($id, $title);
			} //helper_slider

function helper_slider_by_list($id, $title, $value, $min, $max, $text, $list, $begin = '', $end = '')
{
	helper_begin($id, $title);
?>
			<input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php echo $_POST['post_' . $id]; ?>" size="30" name="post_<?php echo $id; ?>" />
			
<?php
		
$per = 100 / ($max - $min + 1);
		
if($per < 4) $per = 4;
if($per > 30) $per = 30;
		
?>
		
<div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; font-weight:bold; font-size: 120%"><?php echo $value ?></div>

<br />
<!-- Begin - Slite for total_area -->
<div id="slider_<?php echo $id ?>"></div>
<div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
		
<div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if($begin == '') echo  _f($text, $min); else echo _f($begin, $min); ?></div>
<div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
<br />
<br />

<script type="text/javascript">
		
var fulllist_<?php echo $id; ?> = [
'<?php echo $value ?>',
		
<?php
for($i = $min; $i <= $max; $i += 1)
{
	echo '\'';
			
	if($list[$i])
	{
		echo sprintf($list[$i], $i);
	}
	else
	{
		echo sprintf($text, $i);
	}
			
	echo '\'';
			
	if($i < $max)
	{
		echo ', ';
	}
}
?>
];
		
$(function() {
	$( '#slider_<?php echo $id; ?>' ).slider({
		range: 'min',
		value: <?php if($_POST['post_' . $id]) { echo ($_POST['post_' . $id]); } else { echo $min - 1; }; ?>,
		min: <?php echo $min - 1 ?>,
		max: <?php echo $max ?>,
		slide: function( event, ui ) {
		if(ui.value > <?php echo $min - 1 ?>) {
		$( '#<?php echo $id ?>' ).val( ui.value );
		} else {
		$( '#<?php echo $id ?>' ).val( '' );
		}
		$( '#<?php echo $id ?>_view' ).text(fulllist_<?php echo $id; ?>[ui.value - <?php echo $min - 1 ?>]);
				
		}
		})
				
				
		if($( '#slider_<?php echo $id ?>' ).slider( 'value' ) > <?php echo $min - 1 ?>) {
		var str_<?php echo $id ?> = '<?php echo $text ?>';
		$( '#<?php echo $id ?>_view' ).text(fulllist_<?php echo $id; ?>[$( '#slider_<?php echo $id ?>' ).slider( 'value' ) - <?php echo $min - 1 ?> ]);
		} else {
		$( '#<?php echo $id ?>' ).val( '' );
		$( '#<?php echo $id ?>_view' ).text('<?php echo $value ?>');
		} // if
		});

		</script> 
		<!-- End --- Slite for total_area -->
				
	<?php
	helper_end($id, $title);

} //helper_slider

function helper_slider_double($id, $title, $value)
{
	helper_begin($id, $title);

?>
			<input readonly="readonly" type="text" id="total_area" class="txtbg" value="<?php echo replace_quotes($_POST['post_total_area']); ?>" size="30" name="post_total_area" />
			<br />
			
			<!-- Begin - Slite for total_area -->
			<div id="slider_total_area"></div>
			<script type="text/javascript">
				$(document).ready(function() {
					$( "#slider_total_area" ).slider({
						range: true,
						values: [10, 20],
						min: 4,
						max: 100,
						slide: function( event, ui ) {
							$( "#total_area" ).val( ui.values[ 0 ] * 5 + " <?php _e("m") ?>² from " + ui.values[ 1 ] * 5 + " <?php _e("m") ?>² total");
						}
					});
					
					$( "#total_area" ).val( $( "#slider_total_area" ).slider( "values", 0 ) * 5 + " <?php _e("m") ?>² from " + $( "#slider_total_area" ).slider( "values", 1 ) * 5 + " <?php _e("m") ?>² total");
				});

			</script> 
			<!-- End --- Slite for total_area -->
					
<?php
	helper_end($id, $title);

} //helper_slider_double

function helper_text($id, $title, $default, $hint)
{
	helper_begin($id, $title);
?>
	<input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" defalutvalue="<?php echo $default; ?>" value="<?php echo replace_quotes($_POST['post_' . $id]); ?>" size="30" name="post_<?php echo $id; ?>">
	<?php
	
	if($hint)
	{
		echo '<br /><span class="hint">' . $hint . '</span>';
	}
			
	helper_end($id, $title);
} //helper_text

function helper_datepicker($id, $title, $minDate = 0, $hint)
{
	helper_begin($id, $title);
	?>
	<input type="text" id="alternate_<?php echo $id; ?>" class="txtbg" style="width: 45%; text-align: center;" value="<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>" disabled="disabled">
	<input type="hidden" id="<?php echo $id; ?>" name="post_alternate_<?php echo $id; ?>" value="<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>">
	
	<div id="datepicker_<?php echo $id; ?>" style="line-height: 1;"></div>
	
	<script type="">
		$(document).ready(function() {
			<?php if(WPLANG == 'en_EN') echo '
				var loc = "en-GB";
				var format = "DD, d MM, yy";
				var formatalt = "dd.mm.yy";
			'; ?>
			<?php if(WPLANG == 'ru_RU') echo '
				var loc = "ru";
				var format = "DD, d MM, yy";
				var formatalt = "dd.mm.yy";
			'; ?>
			<?php if(WPLANG == 'am_HY') echo '
				var loc = "hy";
				var format = "DD, d MM, yy";
				var formatalt = "dd.mm.yy";
			'; ?>
			
			$('#datepicker_<?php echo $id; ?>')
				.datepicker({ 
					minDate: '<?php echo $minDate; ?>',
					altField: "#alternate_<?php echo $id; ?>",
					altFormat: formatalt,
					onSelect: function(dateText, inst) {
						$('#<?php echo $id; ?>').val(dateText);
					}/*,
					defaultDate: '<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>'*/
				});
				
			$('#datepicker_<?php echo $id; ?>').datepicker( "option", $.datepicker.regional[ loc ] );
		});
	</script>
	<?php
	
	if($hint)
	{
		echo '<br /><span class="hint">' . $hint . '</span>';
	}
			
	helper_end($id, $title);
} //helper_text

function helper_textarea($id, $title, $default, $hint, $height = 400)
{
	helper_begin($id, $title);
	/*
	?>
	<textarea id="<?php echo $id; ?>" class="txtareabgcont defaultText" cols="40" rows="<?php echo $rows; ?>" defalutvalue="<?php echo $default; ?>" name="post_<?php echo $id; ?>"><?php echo replace_quotes($_POST['post_' . $id]); ?></textarea>
	<?php
	*/
	?>
	<textarea id="<?php echo $id; ?>" class="txtareabgcont defaultText" style="height: <?php echo $height; ?>px;" defalutvalue="<?php echo $default; ?>" name="post_<?php echo $id; ?>"><?php echo replace_quotes($_POST['post_' . $id]); ?></textarea>
	<?php
	
	if($hint)
	{
		echo '<br /><span class="hint">' . $hint . '</span>';
	}
			
	helper_end($id, $title);
} //helper_text

function helper_hidden($id)
{
	?>
	<input type="hidden" id="<?php echo $id; ?>" name="post_<?php echo $id; ?>" value="<?php echo replace_quotes($_POST['post_' . $id]); ?>">
	<?php
} //helper_hidden

function helper_number($id, $title, $default, $units, $hint)
{
	helper_begin($id, $title);
?>
		<input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" style="width: 280px;" defalutvalue="<?php echo $default; ?>" value="<?php echo replace_quotes($_POST['post_' . $id]); ?>" size="30" name="post_<?php echo $id; ?>" onkeypress="return isNumberKey(event)">
		<?php
		
		if($hint)
		{
			echo '<br /><span class="hint">' . $hint . '</span>';
		}
		
		?>
		<select id="<?php echo $id; ?>_unit" name="post_<?php echo $id; ?>_unit" style="width: 180px;">
		<?php foreach ( $units as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" <?php if($_POST['post_' . $id . '_unit'] == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
		<?php } ?>
		</select>
<?php
	helper_end($id, $title);
} //helper_text

function helper_location($default = '')
{
	$selected = $_POST['post_location'];
	
	if(!$selected)
		$selected = $default;
	
	helper_begin('location', __('Location'));
?>
			<select id="location" name="post_location">
			<option value="-1">
			<?php _e('Select location'); ?>
				</option>
				<?php
				//include '../wp-content/plugins/ba-includes/ba-regions.php';
				
				$regions = getRegions();
				
				foreach ($regions as $key => $value) {
				?>
				<option value="<?php echo $key; ?>" <?php if($selected == $key) { echo 'selected="selected"'; } ?>>
				<?php echo $value ?>
				</option>
				<?php
			}
			
				?>
			</select>
			<br /><span class="hint"><?php _e('Please select your region') ?></span>
<?php
	helper_end('location', __('Location'));
}

function helper_location_combo($id, $default)
{
?>
<select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
	<option value="-1"> <?php echo $default; ?> </option>
	<?php
	
				$regions = getRegions();
				
	foreach ($regions as $key => $value) {
	?>
		<option value="<?php echo $key; ?>" <?php if($_POST['post_location'] == $key) { echo 'selected="selected"'; } ?>>
		<?php echo $value ?>
		</option>
		<?php
	}

?>
</select>
<?php
}

function helper_hint($id)
{
?>
<span class="helper-hint" title="<?php global $helper_hints; echo $helper_hints[$id]; ?>">?</span>
<?php
}

if (!function_exists('the_hint'))
{
	function the_hint($id)
	{
		
	}
}

function helper_begin($id, $title, $half = false)
{
	global $requireds;
?>
<div class="addpostinnerdiv<?php if($half) echo '-half'; ?>" id="container_<?php echo $id; ?>" <?php the_hint($id); ?>>
<?php if($title) { ?>
	<div class="addpostlbl<?php if($half) echo '-half'; ?>">
		<p><?php echo $title; if(isset($requireds[$id])) { echo '<span style="color: red;">*</span>'; } //font-size: 120%; font-weight: bold; ?>:</p>
	</div>
	<div class="addpostctrl<?php if($half) echo '-half'; ?> radio">
<?php } else { ?>
	<div class="addpostctrl-full radio">
<?php } ?>
	<p>
	<?php
}

function helper_end($id = '', $title = '')
{
	?>
		</p>
	</div>
</div>
<?php
}








?>
