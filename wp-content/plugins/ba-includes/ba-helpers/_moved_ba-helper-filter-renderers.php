<?php


function filter_group($id, $title)
{
?>
<div class="addpostinnerdiv_filters addpostgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_group

function filter_group_required($id, $title)
{
?>
<div class="addpostinnerdiv_filters addpostrequiredgroup">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_subgroup_required

function filter_group_sub($id, $title)
{
?>
<div class="addpostinnerdiv_filters addpostsubgroup_filters">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_group_sub

function filter_group_optional($id, $title)
{
?>
<div class="addpostinnerdiv_filters addpostoptionalgroup_filters">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_group_optional

function filter_group_optional_begin($id, $title)
{
?>
<div class="addpostinnerdiv_filters addpostoptionalgroup_filters">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_group_optional_begin

function filter_group_optional_end($id)
{
?>
<div class="addpostinnerdiv_filters addpostoptionalgroup_filters">
	<p> <?php echo $title ?> </p>
	</div>
	<?php

} //filter_group_optional_end

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

function filter_radio($id, $title, $values, $cols = 4)
{
	filter_begin($id, $title);
?>
		<table class="checkgrid_filters">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
			
			echo '<td>';
		?>
			<input type="radio" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if($_GET['q' . $id] == $v[0]) { ?> checked="checked" <?php } ?> />
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
filter_end($id, $title);
} //filter_radio

function filter_select($id, $title, $values)
{
	filter_begin($id, $title);
?>
	<select id="<?php echo $id; ?>" class="select_filters">
		<option value="" <?php if($_GET['q' . $id . 'oeq'] == '') { ?> selected="selected" <?php } ?> ><?php _e('Does not matter') ?></option>
		
		<?php foreach ( $values as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" style="<?php if(isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if(isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if($_GET['q' . $id . 'oeq'] == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
		<?php } ?>
	</select>
	<br />
	<br />
	<script>
	$(document).ready(function() {
		$('#<?php echo $id; ?>').change(function() {
			var value = $(this).find('option:checked').val();
			
			if(value == '') {
				advancedFilters['<?php echo $id ?>'] = [{ include: false }];
			} else {
				advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: value, include: true }];
			}
		});
	});
	</script>
	<?php
	filter_end($id, $title);
} //filter_select

function filter_yearselector($id, $title, $beginvalue, $endvalue)
{
	filter_begin($id, $title);
?>
		<select id="<?php echo $id; ?>"  name="post_<?php echo $id; ?>" class="txtareabgcurrency">
				<option value="0" selected="selected">
				<?php _e('Select year') ?>
				</option>
				<option value="<?php echo $beginvalue ?>" <?php if($_GET['q' . $id] == $beginvalue) { echo 'selected="selected"'; } ?>><?php echo sprintf(__('%s and older'), $beginvalue); ?></option>
				<?php for($i = $beginvalue + 1; $i <= $endvalue; $i++) { ?>
				<option value="<?php echo $i; ?>" <?php if($_GET['q' . $id] == $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
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
filter_end($id, $title);
} //filter_yearselector

function filter_check_key($id, $title, $key, $values, $cols = 4, $maxcount = 0)
{
	filter_begin($id, $title);
?>
	<input type="checkbox" id="<?php echo $id; ?>_key_<?php echo $key[0]; ?>" class="checkareabgsum" value="1" <?php if($_GET['q' . $id . '_' . $key[0] . 'oeq'] == 1) { ?> checked="checked" <?php } ?> />
	<label for="<?php echo $id; ?>_key_<?php echo $key[0]; ?>"> <?php echo $key[1]; ?> </label>
	<br />
	<div id="<?php echo $id; ?>_subs" style="border-top: 1px solid #eee;">
		<table class="checkgrid_filters">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
		?>
			<td>
				<input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum switch_<?php echo $id; ?>" value="1" <?php if($_GET['q' . $id . '_' . $v[0] . 'oeq'] == 1) { ?> checked="checked" <?php } ?> />
				<label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
			</td>
		<?php
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

	$(document).ready(function() {
		$("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").change(function(){
			if ($("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").is(':checked')) 
			{
				$('input.switch_<?php echo $id; ?>').each(function() {
					$(this).removeAttr('checked');
					advancedFilters[$(this).attr('name')] = [{ include: false }];
				});
				
				advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{type: 'oeq', value: 1, include: true }];
			} else {
				advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{ include: false }];
			}
		});
		$('input.switch_<?php echo $id; ?>').change(function(){
			$("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").removeAttr('checked');
			advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{ include: false }];
			
			if($(this).is(':checked')) {
				advancedFilters[$(this).attr('name')] = [{type: 'oeq', value: 1, include: true }];
			} else {
				advancedFilters[$(this).attr('name')] = [{ include: false }];
			}
		});
	});

	</script>
	<?php
	filter_end($id, $title);
} //filter_check

function filter_check($id, $title, $values, $cols = 4, $maxcount = 0)
{
	filter_begin($id, $title);
?>
	<table class="checkgrid_filters">
	<?php
	$i = 0;
	foreach ( $values as $v ) {
		if($i % $cols == 0)
			echo '<tr>';
	?>
		<td>
			<input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum switch_<?php echo $id; ?>" value="1" <?php if($_GET['q' . $id . '_' . $v[0] . 'oeq'] == 1) { ?> checked="checked" <?php } ?> />
			<label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
		</td>
	<?php
		if($i % $cols == $cols - 1)
			echo '</tr>';
			
		$i++;
	}
	if($i % $cols != 0)
		echo '</tr>';
	?>
	</table>
	<script type="text/javascript">

	$(document).ready(function() {
		$('input.switch_<?php echo $id; ?>').change(function(){
			advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{ include: false }];
			
			if($(this).is(':checked')) {
				advancedFilters[$(this).attr('name')] = [{type: 'oeq', value: 1, include: true }];
			} else {
				advancedFilters[$(this).attr('name')] = [{ include: false }];
			}
		});
	});

	</script>
	<?php
	filter_end($id, $title);
} //filter_check

function filter_check_v1($id, $title, $values, $cols = 4, $maxcount = 0)
{
	filter_begin($id, $title);
?>
		<table class="checkgrid_filters">
		<?php
		$i = 0;
		foreach ( $values as $v ) {
			if($i % $cols == 0)
				echo '<tr>';
			
			echo '<td>';
		?>
			<input type="checkbox" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum" value="1" <?php if($_GET['q' . $id . '_' . $v[0]] == 1) { ?> checked="checked" <?php } ?> />
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
filter_end($id, $title);
} //filter_check

function filter_yes_no($id, $title, $half = false)
{
	filter_begin($id, $title, $half);
?>
		<div id="<?php echo $id; ?>_img_yes" class="check-span check-yes"></div>
		<div id="<?php echo $id; ?>_img_no" class="check-span check-no"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#<?php echo $id; ?>_img_no').click(statechanged_<?php echo $id; ?>_no);
		$('#<?php echo $id; ?>_img_yes').click(statechanged_<?php echo $id; ?>_yes);
		
		var val = '<?php echo $_GET['q' . $id . 'oeq']; ?>';
		
		if(val == '1') {
			$('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
		} else if(val == '2') {
			$('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
		}
	});
	
	function statechanged_<?php echo $id; ?>_no()
	{
		$('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
		$('#<?php echo $id; ?>_img_yes').addClass('check-yes');
		$('#<?php echo $id; ?>_img_yes').removeClass('check-yes-checked');
		
		if($('#<?php echo $id; ?>_img_no').hasClass('check-no-checked')) {
				advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: 1, include: true }];
		} else {
				advancedFilters['<?php echo $id ?>'] = [{ include: false }];
		}
	}
	
	function statechanged_<?php echo $id; ?>_yes()
	{
		$('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
		$('#<?php echo $id; ?>_img_no').addClass('check-no');
		$('#<?php echo $id; ?>_img_no').removeClass('check-no-checked');
		
		if($('#<?php echo $id; ?>_img_yes').hasClass('check-yes-checked')) {
				advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: 2, include: true }];
		} else {
				advancedFilters['<?php echo $id ?>'] = [{ include: false }];
		}
	}
</script>
<?php

filter_end($id, $title);
} //filter_yes_no

function filter_slider($id, $title, $rate = 1, $min, $max, $text, $begin = '', $end = '')
{
	$value = __('Does not matter');
	$minVal = ($_GET['q' . $id . 'omn'] != '') ? ($_GET['q' . $id . 'omn'] / $rate) : $min;
	$maxVal = ($_GET['q' . $id . 'omx'] != '') ? ($_GET['q' . $id . 'omx'] / $rate) : $max;
	
	filter_begin($id, $title);
?>
		<input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php echo $_GET['q' . $id]; ?>" size="30" name="post_<?php echo $id; ?>" />
		<div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo $value ?></div>
		
		<br />
		<!-- Begin - Slite for total_area -->
		<div style="padding-left: 10px; padding-right: 10px;">
		<div id="slider_<?php echo $id ?>"></div>
		</div>
		<div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if($begin == '') echo _f($text, $min * $rate); else echo _f($begin, $min * $rate); ?></div>
		<div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max * $rate); else echo _f($end, $max * $rate); ?></div>

		<script type="text/javascript">
		$(document).ready(function() {
			$('#slider_<?php echo $id; ?>').slider({
				range: true,
				values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
				
				min: <?php echo $min ?>,
				max: <?php echo $max ?>,
				slide: function( event, ui ) {
				
				var str_<?php echo $id ?> = '<?php echo $text ?>';
				
				$( '#<?php echo $id ?>_view' ).text(
														str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000 )
														+ ' - ' +
														str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000 )
													);
				var minValue = Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000;
				var maxValue = Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000;
				
				advancedFilters['<?php echo $id ?>'] = [
				{type: 'omn', value: minValue, include: (ui.values[0] != <?php echo $min ?>)},
				{type: 'omx', value: maxValue, include: (ui.values[1] != <?php echo $max ?>)}
													];
													
			} // slide: function
		}) // $slider
		
		var str_<?php echo $id ?> = '<?php echo $text ?>';
				$( '#<?php echo $id ?>_view' ).text(
														str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'values', 0 ) * <?php echo $rate ?>)) / 1000 )
														+ ' - ' +
														str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'values', 1 ) * <?php echo $rate ?>)) / 1000 )
													);
				
	}); // $(document).ready

	</script> 
	<!-- End --- Slite for total_area -->
				
	<?php

	filter_end($id, $title);
} //filter_slider

function filter_slider_by_list($id, $title, $value, $min, $max, $text, $list, $begin = '', $end = '')
{
	$minVal = ($_GET['q' . $id . 'omn'] != '') ? $_GET['q' . $id . 'omn'] : $min;
	$maxVal = ($_GET['q' . $id . 'omx'] != '') ? $_GET['q' . $id . 'omx'] : $max;
	
	filter_begin($id, $title);
	?>
	<div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo __('Does not matter'); ?></div>

	<br />
	<!-- Begin - Slite for total_area -->
	<div style="padding-left: 10px; padding-right: 10px;">
		<div id="slider_<?php echo $id ?>"></div>
	</div>

	<div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if($begin == '') echo _f($text, $min); else echo _f($begin, $min); ?></div>
	<div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
	<br />
	<br />

	<script type="text/javascript">
		$(document).ready(function() {
		
			var fulllist_<?php echo $id; ?> = [
			'<?php echo $value ?>',

			<?php
			for($i = $min; $i <= $max; $i += 1)
			{
				echo '\'';
	
				if($list[$i])
					echo sprintf($list[$i], $i);
				else
					echo sprintf($text, $i);
	
				echo '\'';
	
				if($i < $max)
					echo ', ';
			}
			?>
			];
		
			$('#slider_<?php echo $id; ?>').slider({
				range: true,
				values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
				
				min: <?php echo $min ?>,
				max: <?php echo $max ?>,
				slide: function( event, ui ) {
				
				var str_<?php echo $id ?> = '<?php echo $text ?>';
				
				$( '#<?php echo $id ?>_view' ).text(
														str_<?php echo $id ?>.replace('%s', ui.values[0])
														+ ' - ' +
														str_<?php echo $id ?>.replace('%s', ui.values[1])
													);
				var minValue = ui.values[0];
				var maxValue = ui.values[1];
				
				advancedFilters['<?php echo $id ?>'] = [
							{type: 'omn', value: minValue, include: (ui.values[0] != <?php echo $min ?>)},
							{type: 'omx', value: maxValue, include: (ui.values[1] != <?php echo $max ?>)}
													];
													
			} // slide: function
		}) // $slider
		
		var str_<?php echo $id ?> = '<?php echo $text ?>';
				$( '#<?php echo $id ?>_view' ).text(
														str_<?php echo $id ?>.replace('%s', $( '#slider_<?php echo $id ?>' ).slider( 'values', 0 ) )
														+ ' - ' +
														str_<?php echo $id ?>.replace('%s', $( '#slider_<?php echo $id ?>' ).slider( 'values', 1 ) )
													);
				
	}); // $(document).ready

		</script> 
		<!-- End --- Slite for total_area -->
		
	<?php
	filter_end($id, $title);

} //filter_slider

function filter_slider_double($id, $title, $value)
	{
		filter_begin($id, $title);

	?>
			<input readonly="readonly" type="text" id="total_area" class="txtbg" value="<?php echo replace_quotes($_GET['qtotal_area']); ?>" size="30" name="post_total_area" />
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
	filter_end($id, $title);

} //filter_slider_double

function filter_text($id, $title, $default, $hint)
{
	$value = replace_quotes($_GET['q' . $id . 'olk']);
	
	filter_begin($id, $title);
							?>
	<input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" style="width: 220px;" defalutvalue="<?php echo $default; ?>" value="<?php echo $value; ?>" size="30" />
	<?php
	
	if($hint)
	{
		echo '<br /><span class="hint">' . $hint . '</span>';
	}
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#<?php echo $id; ?>').change(function() {
				advancedFilters['<?php echo $id ?>'] = [ {type: 'olk', value: $('#<?php echo $id ?>').val(), include: ($('#<?php echo $id ?>').val().trim().length > 0)} ];
			});
		}); // $(document).ready
	</script>
	<?php
	filter_end($id, $title);
} //filter_text

function filter_datepicker($id, $title, $minDate = 0, $hint)
{
	filter_begin($id, $title);
?>
	<input type="text" id="alternate_<?php echo $id; ?>" class="txtbg" style="width: 45%; text-align: center;" value="<?php echo replace_quotes($_GET['qalternate_' . $id]); ?>" disabled="disabled">
	<input type="hidden" id="<?php echo $id; ?>" name="post_alternate_<?php echo $id; ?>" value="<?php echo replace_quotes($_GET['qalternate_' . $id]); ?>">
	
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
					}
				});
				
			$('#datepicker_<?php echo $id; ?>').datepicker( "option", $.datepicker.regional[ loc ] );
		});
	</script>
	<?php
	
	if($hint)
	{
		echo '<br /><span class="hint">' . $hint . '</span>';
	}
	
	filter_end($id, $title);
} //filter_text

function filter_number($id, $title, $default, $units, $hint)
{
	filter_begin($id, $title);
	?>
		<input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" style="width: 150px;" defalutvalue="<?php echo $default; ?>" value="<?php echo replace_quotes($_GET['q' . $id]); ?>" size="30" name="post_<?php echo $id; ?>" onkeypress="return isNumberKey(event)">
		<?php
		
		if($hint)
		{
			echo '<br /><span class="hint">' . $hint . '</span>';
		}
		
		?>
		<select id="<?php echo $id; ?>_unit" name="post_<?php echo $id; ?>_unit" style="width: 70px;">
		<?php foreach ( $units as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" <?php if($_GET['q' . $id . '_unit'] == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
		<?php } ?>
		</select>
<?php
filter_end($id, $title);
} //filter_text

function filter_begin($id, $title, $half = false)
{
?>
<div class="addpostinnerdiv_filters<?php if($half) echo '-half'; ?>" id="filtercontainer_<?php echo $id; ?>" <?php the_hint($id); ?>>
<?php if($title) { ?>
	<div class="addpostlbl_filters<?php if($half) echo '-half'; ?>">
		<?php echo $title; ?>
	</div>
	<div class="addpostctrl_filters<?php if($half) echo '-half'; ?> radio">
<?php } else { ?>
	<div class="addpostctrl_filters-full radio">
<?php } ?>
	<?php
}

function filter_end($id = '', $title = '')
{
?>
	</div>
</div>
<?php
}



function filter_slider_by_list2($id, $title, $min, $max, $format, $text, $list, $begin = '', $end = '')
{
	$textAll = __('Does not matter');
	$textMore = __('%s or more');
	$textUpTo = __('up to %s');

	$minVal = ($_GET['q' . $id . 'omn'] != '') ? $_GET['q' . $id . 'omn'] : $min;
	$maxVal = ($_GET['q' . $id . 'omx'] != '') ? $_GET['q' . $id . 'omx'] : $max;
	
	filter_begin($id, $title);
?>
	<div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo $textAll ?></div>

	<br />
	<!-- Begin - Slite for total_area -->
	<div style="padding-left: 10px; padding-right: 10px;">
		<div id="slider_<?php echo $id ?>"></div>
	</div>

	<div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if($begin == '') echo _f($text, $min); else echo _f($begin, $min); ?></div>
	<div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;"><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
	<br />
	<br />
	<d filterSliderList>
		<d name><?php echo $id ?></d>
		<d text><?php echo $text ?></d>
		<d format><?php echo $format ?></d>
		<d min><?php echo $min ?></d>
		<d max><?php echo $max ?></d>
		<d textAll><?php echo $textAll ?></d>
		<d textMore><?php echo $textMore ?></d>
		<d textUpTo><?php echo $textUpTo ?></d>
		<d minVal><?php echo $minVal ?></d>
		<d maxVal><?php echo $maxVal ?></d>
		<d fulllist>
		<?php
		foreach($list as $key => $value)
		{
			echo '<d key="' . $key . '">' . $value . '</d>';
		}
		?>
		</d>
	</d>
<?php
	filter_end($id, $title);

} //filter_slider

?>