<?php
global $colorsliast;

$colorsliast = array( 
	array(4,  'Black', '#ffffff', '#000'),
	array(2,  'White', '#000', '#ffffff'),
	array(6,  'Silver', '#000', '#f0f0f0'),
	array(8,  'Gray', '#000', '#bdbdbd'),
	array(30, 'Beige', '#000', '#eee4d3'),
	array(20, 'Yellow', '#000', '#f8f191'),
	array(22, 'Gold', '#000', '#ead18b'),
	array(28, 'Orange', '#000', '#FF7F00'),
	array(10, 'Red', '#000', '#FF0000'),
	array(34, 'Cherry', '#fff', '#cc1539'),
	array(24, 'Brown', '#fff', '#681a00'),
	array(32, 'Aubergine', '#fff', '#7b425a'),
	array(16, 'Light blue', '#000', '#bcdbf1'),
	array(18, 'Lilac', '#000', '#d1b6e8'),
	array(26, 'Purple', '#fff', '#d14db6'),
	array(14, 'Blue', '#fff', '#0000dd'),
	array(12, 'Green', '#000', '#98e058'),
	array(other, 'other', '#000', '#ffffff')
	);

function helper_colors($id, $title)
{
	global $colorsliast;
	$values = $colorsliast;
	
	helper_begin($id, $title);
?>
	<select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
		<option value="" <?php if($_POST['post_' . $id] == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
		
		<?php foreach ( $values as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" style="<?php if(isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if(isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if($_POST['post_' . $id] == $v[0]) { ?> selected="selected" <?php } ?> ><?php _e($v[1]); ?></option>
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
} //helper_price


function render_color($id, $title)
{
	?>
	<tr class="render_postinnerdiv">
		<td class="render_postlbl"><?php echo $title ?>:</td>
		<td class="render_postctrl">
	<?php
	
	global $colorsliast;
	
	$val = get_post_meta(get_the_ID(), 'post_' . $id);
	$val = $val[0];
	
	if($val)
	{
		foreach($colorsliast as $item)
		{
			if($val == $item[0])
			{
				$val = $item;
				break;
			}
		}
		
		?>
		<div style="width: 150px; height: 22px; margin: 2px; padding-left: 10px; border: 1px solid #777; -background-color: <?php echo $val[3]; ?>; -color: <?php echo $val[2]; ?>;">
            <?php _e($val[1]); ?>
		    <div style="width: 20px; height: 20px; margin: 2px; border: 1px solid #777; background-color: <?php echo $val[3]; ?>;">
            </div>
        </div>
		<?php
	} else {
		echo __('not selected');
	}
	
	?>
		</td>
	</tr>	
	<?php
}

function filter_colors($id, $title)
{
	global $colorsliast;
	$values = $colorsliast;
	
	helper_begin($id, $title);
?>
	<select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
		<option value="" <?php if($_POST['post_' . $id] == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
		
		<?php foreach ( $values as $v ) { ?>
			<option value="<?php echo $v[0]; ?>" style="<?php if(isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if(isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if($_POST['post_' . $id] == $v[0]) { ?> selected="selected" <?php } ?> ><?php _e($v[1]); ?></option>
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
} //helper_price

?>