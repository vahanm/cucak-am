<?php


function helper_colors($id, $title)
{
	helper_begin($id, $title);
?>
<input type="hidden" id="<?php echo $id ?>" name="post_<?php echo $id ?>" value="<?php echo $_POST['post_' . $id] ?>" />

<div id="colors-selected-<?php echo $id ?>" class="colors-selected" style="background-color: #<?php echo $_POST['post_' . $id] ?>;">
<?php if($_POST['post_' . $id]) { _e('RGB ' . $_POST['post_' . $id]); } else { _e('Not selected'); } ?>
</div>
<div id="colors-container-<?php echo $id ?>" class="colors-container">
	<div style="background-color: #fff; margin-bottom: 5px;" value=""><?php _e('Not selected') ?></div>
	
	<div style="background-color: #000000" value="000000"><?php _e('RGB 000000') ?></div>
	<div style="background-color: #000033" value="000033"><?php _e('RGB 000033') ?></div>
	<div style="background-color: #000066" value="000066"><?php _e('RGB 000066') ?></div>
	<div style="background-color: #000099" value="000099"><?php _e('RGB 000099') ?></div>
	<div style="background-color: #003300" value="003300"><?php _e('RGB 003300') ?></div>
	<div style="background-color: #003333" value="003333"><?php _e('RGB 003333') ?></div>
	<div style="background-color: #003366" value="003366"><?php _e('RGB 003366') ?></div>
	<div style="background-color: #003399" value="003399"><?php _e('RGB 003399') ?></div>
	<div style="background-color: #006600" value="006600"><?php _e('RGB 006600') ?></div>
	<div style="background-color: #006633" value="006633"><?php _e('RGB 006633') ?></div>
	<div style="background-color: #006666" value="006666"><?php _e('RGB 006666') ?></div>
	<div style="background-color: #006699" value="006699"><?php _e('RGB 006699') ?></div>
	<div style="background-color: #009900" value="009900"><?php _e('RGB 009900') ?></div>
	<div style="background-color: #009933" value="009933"><?php _e('RGB 009933') ?></div>
	<div style="background-color: #009966" value="009966"><?php _e('RGB 009966') ?></div>
	<div style="background-color: #009999" value="009999"><?php _e('RGB 009999') ?></div>
	<div style="background-color: #330000" value="330000"><?php _e('RGB 330000') ?></div>
	<div style="background-color: #330033" value="330033"><?php _e('RGB 330033') ?></div>
	<div style="background-color: #330066" value="330066"><?php _e('RGB 330066') ?></div>
	<div style="background-color: #330099" value="330099"><?php _e('RGB 330099') ?></div>
	<div style="background-color: #333300" value="333300"><?php _e('RGB 333300') ?></div>
	<div style="background-color: #333333" value="333333"><?php _e('RGB 333333') ?></div>
	<div style="background-color: #333366" value="333366"><?php _e('RGB 333366') ?></div>
	<div style="background-color: #333399" value="333399"><?php _e('RGB 333399') ?></div>
	<div style="background-color: #336600" value="336600"><?php _e('RGB 336600') ?></div>
	<div style="background-color: #336633" value="336633"><?php _e('RGB 336633') ?></div>
	<div style="background-color: #336666" value="336666"><?php _e('RGB 336666') ?></div>
	<div style="background-color: #336699" value="336699"><?php _e('RGB 336699') ?></div>
	<div style="background-color: #339900" value="339900"><?php _e('RGB 339900') ?></div>
	<div style="background-color: #339933" value="339933"><?php _e('RGB 339933') ?></div>
	<div style="background-color: #339966" value="339966"><?php _e('RGB 339966') ?></div>
	<div style="background-color: #339999" value="339999"><?php _e('RGB 339999') ?></div>
	<div style="background-color: #660000" value="660000"><?php _e('RGB 660000') ?></div>
	<div style="background-color: #660033" value="660033"><?php _e('RGB 660033') ?></div>
	<div style="background-color: #660066" value="660066"><?php _e('RGB 660066') ?></div>
	<div style="background-color: #660099" value="660099"><?php _e('RGB 660099') ?></div>
	<div style="background-color: #663300" value="663300"><?php _e('RGB 663300') ?></div>
	<div style="background-color: #663333" value="663333"><?php _e('RGB 663333') ?></div>
	<div style="background-color: #663366" value="663366"><?php _e('RGB 663366') ?></div>
	<div style="background-color: #663399" value="663399"><?php _e('RGB 663399') ?></div>
	<div style="background-color: #666600" value="666600"><?php _e('RGB 666600') ?></div>
	<div style="background-color: #666633" value="666633"><?php _e('RGB 666633') ?></div>
	<div style="background-color: #666666" value="666666"><?php _e('RGB 666666') ?></div>
	<div style="background-color: #666699" value="666699"><?php _e('RGB 666699') ?></div>
	<div style="background-color: #669900" value="669900"><?php _e('RGB 669900') ?></div>
	<div style="background-color: #669933" value="669933"><?php _e('RGB 669933') ?></div>
	<div style="background-color: #669966" value="669966"><?php _e('RGB 669966') ?></div>
	<div style="background-color: #669999" value="669999"><?php _e('RGB 669999') ?></div>
	<div style="background-color: #990000" value="990000"><?php _e('RGB 990000') ?></div>
	<div style="background-color: #990033" value="990033"><?php _e('RGB 990033') ?></div>
	<div style="background-color: #990066" value="990066"><?php _e('RGB 990066') ?></div>
	<div style="background-color: #990099" value="990099"><?php _e('RGB 990099') ?></div>
	<div style="background-color: #993300" value="993300"><?php _e('RGB 993300') ?></div>
	<div style="background-color: #993333" value="993333"><?php _e('RGB 993333') ?></div>
	<div style="background-color: #993366" value="993366"><?php _e('RGB 993366') ?></div>
	<div style="background-color: #993399" value="993399"><?php _e('RGB 993399') ?></div>
	<div style="background-color: #996600" value="996600"><?php _e('RGB 996600') ?></div>
	<div style="background-color: #996633" value="996633"><?php _e('RGB 996633') ?></div>
	<div style="background-color: #996666" value="996666"><?php _e('RGB 996666') ?></div>
	<div style="background-color: #996699" value="996699"><?php _e('RGB 996699') ?></div>
	<div style="background-color: #999900" value="999900"><?php _e('RGB 999900') ?></div>
	<div style="background-color: #999933" value="999933"><?php _e('RGB 999933') ?></div>
	<div style="background-color: #999966" value="999966"><?php _e('RGB 999966') ?></div>
	<div style="background-color: #999999" value="999999"><?php _e('RGB 999999') ?></div>
	<div style="background-color: #0000CC" value="0000CC"><?php _e('RGB 0000CC') ?></div>
	<div style="background-color: #0000FF" value="0000FF"><?php _e('RGB 0000FF') ?></div>
	<div style="background-color: #0033CC" value="0033CC"><?php _e('RGB 0033CC') ?></div>
	<div style="background-color: #0033FF" value="0033FF"><?php _e('RGB 0033FF') ?></div>
	<div style="background-color: #0066CC" value="0066CC"><?php _e('RGB 0066CC') ?></div>
	<div style="background-color: #0066FF" value="0066FF"><?php _e('RGB 0066FF') ?></div>
	<div style="background-color: #0099CC" value="0099CC"><?php _e('RGB 0099CC') ?></div>
	<div style="background-color: #0099FF" value="0099FF"><?php _e('RGB 0099FF') ?></div>
	<div style="background-color: #00CC00" value="00CC00"><?php _e('RGB 00CC00') ?></div>
	<div style="background-color: #00CC33" value="00CC33"><?php _e('RGB 00CC33') ?></div>
	<div style="background-color: #00CC66" value="00CC66"><?php _e('RGB 00CC66') ?></div>
	<div style="background-color: #00CC99" value="00CC99"><?php _e('RGB 00CC99') ?></div>
	<div style="background-color: #00CCCC" value="00CCCC"><?php _e('RGB 00CCCC') ?></div>
	<div style="background-color: #00CCFF" value="00CCFF"><?php _e('RGB 00CCFF') ?></div>
	<div style="background-color: #00FF00" value="00FF00"><?php _e('RGB 00FF00') ?></div>
	<div style="background-color: #00FF33" value="00FF33"><?php _e('RGB 00FF33') ?></div>
	<div style="background-color: #00FF66" value="00FF66"><?php _e('RGB 00FF66') ?></div>
	<div style="background-color: #00FF99" value="00FF99"><?php _e('RGB 00FF99') ?></div>
	<div style="background-color: #00FFCC" value="00FFCC"><?php _e('RGB 00FFCC') ?></div>
	<div style="background-color: #00FFFF" value="00FFFF"><?php _e('RGB 00FFFF') ?></div>
	<div style="background-color: #3300CC" value="3300CC"><?php _e('RGB 3300CC') ?></div>
	<div style="background-color: #3300FF" value="3300FF"><?php _e('RGB 3300FF') ?></div>
	<div style="background-color: #3333CC" value="3333CC"><?php _e('RGB 3333CC') ?></div>
	<div style="background-color: #3333FF" value="3333FF"><?php _e('RGB 3333FF') ?></div>
	<div style="background-color: #3366CC" value="3366CC"><?php _e('RGB 3366CC') ?></div>
	<div style="background-color: #3366FF" value="3366FF"><?php _e('RGB 3366FF') ?></div>
	<div style="background-color: #3399CC" value="3399CC"><?php _e('RGB 3399CC') ?></div>
	<div style="background-color: #3399FF" value="3399FF"><?php _e('RGB 3399FF') ?></div>
	<div style="background-color: #33CC00" value="33CC00"><?php _e('RGB 33CC00') ?></div>
	<div style="background-color: #33CC33" value="33CC33"><?php _e('RGB 33CC33') ?></div>
	<div style="background-color: #33CC66" value="33CC66"><?php _e('RGB 33CC66') ?></div>
	<div style="background-color: #33CC99" value="33CC99"><?php _e('RGB 33CC99') ?></div>
	<div style="background-color: #33CCCC" value="33CCCC"><?php _e('RGB 33CCCC') ?></div>
	<div style="background-color: #33CCFF" value="33CCFF"><?php _e('RGB 33CCFF') ?></div>
	<div style="background-color: #33FF00" value="33FF00"><?php _e('RGB 33FF00') ?></div>
	<div style="background-color: #33FF33" value="33FF33"><?php _e('RGB 33FF33') ?></div>
	<div style="background-color: #33FF66" value="33FF66"><?php _e('RGB 33FF66') ?></div>
	<div style="background-color: #33FF99" value="33FF99"><?php _e('RGB 33FF99') ?></div>
	<div style="background-color: #33FFCC" value="33FFCC"><?php _e('RGB 33FFCC') ?></div>
	<div style="background-color: #33FFFF" value="33FFFF"><?php _e('RGB 33FFFF') ?></div>
	<div style="background-color: #6600CC" value="6600CC"><?php _e('RGB 6600CC') ?></div>
	<div style="background-color: #6600FF" value="6600FF"><?php _e('RGB 6600FF') ?></div>
	<div style="background-color: #6633CC" value="6633CC"><?php _e('RGB 6633CC') ?></div>
	<div style="background-color: #6633FF" value="6633FF"><?php _e('RGB 6633FF') ?></div>
	<div style="background-color: #6666CC" value="6666CC"><?php _e('RGB 6666CC') ?></div>
	<div style="background-color: #6666FF" value="6666FF"><?php _e('RGB 6666FF') ?></div>
	<div style="background-color: #6699CC" value="6699CC"><?php _e('RGB 6699CC') ?></div>
	<div style="background-color: #6699FF" value="6699FF"><?php _e('RGB 6699FF') ?></div>
	<div style="background-color: #66CC00" value="66CC00"><?php _e('RGB 66CC00') ?></div>
	<div style="background-color: #66CC33" value="66CC33"><?php _e('RGB 66CC33') ?></div>
	<div style="background-color: #66CC66" value="66CC66"><?php _e('RGB 66CC66') ?></div>
	<div style="background-color: #66CC99" value="66CC99"><?php _e('RGB 66CC99') ?></div>
	<div style="background-color: #66CCCC" value="66CCCC"><?php _e('RGB 66CCCC') ?></div>
	<div style="background-color: #66CCFF" value="66CCFF"><?php _e('RGB 66CCFF') ?></div>
	<div style="background-color: #66FF00" value="66FF00"><?php _e('RGB 66FF00') ?></div>
	<div style="background-color: #66FF33" value="66FF33"><?php _e('RGB 66FF33') ?></div>
	<div style="background-color: #66FF66" value="66FF66"><?php _e('RGB 66FF66') ?></div>
	<div style="background-color: #66FF99" value="66FF99"><?php _e('RGB 66FF99') ?></div>
	<div style="background-color: #66FFCC" value="66FFCC"><?php _e('RGB 66FFCC') ?></div>
	<div style="background-color: #66FFFF" value="66FFFF"><?php _e('RGB 66FFFF') ?></div>
	<div style="background-color: #9900CC" value="9900CC"><?php _e('RGB 9900CC') ?></div>
	<div style="background-color: #9900FF" value="9900FF"><?php _e('RGB 9900FF') ?></div>
	<div style="background-color: #9933CC" value="9933CC"><?php _e('RGB 9933CC') ?></div>
	<div style="background-color: #9933FF" value="9933FF"><?php _e('RGB 9933FF') ?></div>
	<div style="background-color: #9966CC" value="9966CC"><?php _e('RGB 9966CC') ?></div>
	<div style="background-color: #9966FF" value="9966FF"><?php _e('RGB 9966FF') ?></div>
	<div style="background-color: #9999CC" value="9999CC"><?php _e('RGB 9999CC') ?></div>
	<div style="background-color: #9999FF" value="9999FF"><?php _e('RGB 9999FF') ?></div>
	<div style="background-color: #99CC00" value="99CC00"><?php _e('RGB 99CC00') ?></div>
	<div style="background-color: #99CC33" value="99CC33"><?php _e('RGB 99CC33') ?></div>
	<div style="background-color: #99CC66" value="99CC66"><?php _e('RGB 99CC66') ?></div>
	<div style="background-color: #99CC99" value="99CC99"><?php _e('RGB 99CC99') ?></div>
	<div style="background-color: #99CCCC" value="99CCCC"><?php _e('RGB 99CCCC') ?></div>
	<div style="background-color: #99CCFF" value="99CCFF"><?php _e('RGB 99CCFF') ?></div>
	<div style="background-color: #99FF00" value="99FF00"><?php _e('RGB 99FF00') ?></div>
	<div style="background-color: #99FF33" value="99FF33"><?php _e('RGB 99FF33') ?></div>
	<div style="background-color: #99FF66" value="99FF66"><?php _e('RGB 99FF66') ?></div>
	<div style="background-color: #99FF99" value="99FF99"><?php _e('RGB 99FF99') ?></div>
	<div style="background-color: #99FFCC" value="99FFCC"><?php _e('RGB 99FFCC') ?></div>
	<div style="background-color: #99FFFF" value="99FFFF"><?php _e('RGB 99FFFF') ?></div>
	<div style="background-color: #CC0000" value="CC0000"><?php _e('RGB CC0000') ?></div>
	<div style="background-color: #CC0033" value="CC0033"><?php _e('RGB CC0033') ?></div>
	<div style="background-color: #CC0066" value="CC0066"><?php _e('RGB CC0066') ?></div>
	<div style="background-color: #CC0099" value="CC0099"><?php _e('RGB CC0099') ?></div>
	<div style="background-color: #CC00CC" value="CC00CC"><?php _e('RGB CC00CC') ?></div>
	<div style="background-color: #CC00FF" value="CC00FF"><?php _e('RGB CC00FF') ?></div>
	<div style="background-color: #CC3300" value="CC3300"><?php _e('RGB CC3300') ?></div>
	<div style="background-color: #CC3333" value="CC3333"><?php _e('RGB CC3333') ?></div>
	<div style="background-color: #CC3366" value="CC3366"><?php _e('RGB CC3366') ?></div>
	<div style="background-color: #CC3399" value="CC3399"><?php _e('RGB CC3399') ?></div>
	<div style="background-color: #CC33CC" value="CC33CC"><?php _e('RGB CC33CC') ?></div>
	<div style="background-color: #CC33FF" value="CC33FF"><?php _e('RGB CC33FF') ?></div>
	<div style="background-color: #CC6600" value="CC6600"><?php _e('RGB CC6600') ?></div>
	<div style="background-color: #CC6633" value="CC6633"><?php _e('RGB CC6633') ?></div>
	<div style="background-color: #CC6666" value="CC6666"><?php _e('RGB CC6666') ?></div>
	<div style="background-color: #CC6699" value="CC6699"><?php _e('RGB CC6699') ?></div>
	<div style="background-color: #CC66CC" value="CC66CC"><?php _e('RGB CC66CC') ?></div>
	<div style="background-color: #CC66FF" value="CC66FF"><?php _e('RGB CC66FF') ?></div>
	<div style="background-color: #CC9900" value="CC9900"><?php _e('RGB CC9900') ?></div>
	<div style="background-color: #CC9933" value="CC9933"><?php _e('RGB CC9933') ?></div>
	<div style="background-color: #CC9966" value="CC9966"><?php _e('RGB CC9966') ?></div>
	<div style="background-color: #CC9999" value="CC9999"><?php _e('RGB CC9999') ?></div>
	<div style="background-color: #CC99CC" value="CC99CC"><?php _e('RGB CC99CC') ?></div>
	<div style="background-color: #CC99FF" value="CC99FF"><?php _e('RGB CC99FF') ?></div>
	<div style="background-color: #CCCC00" value="CCCC00"><?php _e('RGB CCCC00') ?></div>
	<div style="background-color: #CCCC33" value="CCCC33"><?php _e('RGB CCCC33') ?></div>
	<div style="background-color: #CCCC66" value="CCCC66"><?php _e('RGB CCCC66') ?></div>
	<div style="background-color: #CCCC99" value="CCCC99"><?php _e('RGB CCCC99') ?></div>
	<div style="background-color: #CCCCCC" value="CCCCCC"><?php _e('RGB CCCCCC') ?></div>
	<div style="background-color: #CCCCFF" value="CCCCFF"><?php _e('RGB CCCCFF') ?></div>
	<div style="background-color: #CCFF00" value="CCFF00"><?php _e('RGB CCFF00') ?></div>
	<div style="background-color: #CCFF33" value="CCFF33"><?php _e('RGB CCFF33') ?></div>
	<div style="background-color: #CCFF66" value="CCFF66"><?php _e('RGB CCFF66') ?></div>
	<div style="background-color: #CCFF99" value="CCFF99"><?php _e('RGB CCFF99') ?></div>
	<div style="background-color: #CCFFCC" value="CCFFCC"><?php _e('RGB CCFFCC') ?></div>
	<div style="background-color: #CCFFFF" value="CCFFFF"><?php _e('RGB CCFFFF') ?></div>
	<div style="background-color: #FF0000" value="FF0000"><?php _e('RGB FF0000') ?></div>
	<div style="background-color: #FF0033" value="FF0033"><?php _e('RGB FF0033') ?></div>
	<div style="background-color: #FF0066" value="FF0066"><?php _e('RGB FF0066') ?></div>
	<div style="background-color: #FF0099" value="FF0099"><?php _e('RGB FF0099') ?></div>
	<div style="background-color: #FF00CC" value="FF00CC"><?php _e('RGB FF00CC') ?></div>
	<div style="background-color: #FF00FF" value="FF00FF"><?php _e('RGB FF00FF') ?></div>
	<div style="background-color: #FF3300" value="FF3300"><?php _e('RGB FF3300') ?></div>
	<div style="background-color: #FF3333" value="FF3333"><?php _e('RGB FF3333') ?></div>
	<div style="background-color: #FF3366" value="FF3366"><?php _e('RGB FF3366') ?></div>
	<div style="background-color: #FF3399" value="FF3399"><?php _e('RGB FF3399') ?></div>
	<div style="background-color: #FF33CC" value="FF33CC"><?php _e('RGB FF33CC') ?></div>
	<div style="background-color: #FF33FF" value="FF33FF"><?php _e('RGB FF33FF') ?></div>
	<div style="background-color: #FF6600" value="FF6600"><?php _e('RGB FF6600') ?></div>
	<div style="background-color: #FF6633" value="FF6633"><?php _e('RGB FF6633') ?></div>
	<div style="background-color: #FF6666" value="FF6666"><?php _e('RGB FF6666') ?></div>
	<div style="background-color: #FF6699" value="FF6699"><?php _e('RGB FF6699') ?></div>
	<div style="background-color: #FF66CC" value="FF66CC"><?php _e('RGB FF66CC') ?></div>
	<div style="background-color: #FF66FF" value="FF66FF"><?php _e('RGB FF66FF') ?></div>
	<div style="background-color: #FF9900" value="FF9900"><?php _e('RGB FF9900') ?></div>
	<div style="background-color: #FF9933" value="FF9933"><?php _e('RGB FF9933') ?></div>
	<div style="background-color: #FF9966" value="FF9966"><?php _e('RGB FF9966') ?></div>
	<div style="background-color: #FF9999" value="FF9999"><?php _e('RGB FF9999') ?></div>
	<div style="background-color: #FF99CC" value="FF99CC"><?php _e('RGB FF99CC') ?></div>
	<div style="background-color: #FF99FF" value="FF99FF"><?php _e('RGB FF99FF') ?></div>
	<div style="background-color: #FFCC00" value="FFCC00"><?php _e('RGB FFCC00') ?></div>
	<div style="background-color: #FFCC33" value="FFCC33"><?php _e('RGB FFCC33') ?></div>
	<div style="background-color: #FFCC66" value="FFCC66"><?php _e('RGB FFCC66') ?></div>
	<div style="background-color: #FFCC99" value="FFCC99"><?php _e('RGB FFCC99') ?></div>
	<div style="background-color: #FFCCCC" value="FFCCCC"><?php _e('RGB FFCCCC') ?></div>
	<div style="background-color: #FFCCFF" value="FFCCFF"><?php _e('RGB FFCCFF') ?></div>
	<div style="background-color: #FFFF00" value="FFFF00"><?php _e('RGB FFFF00') ?></div>
	<div style="background-color: #FFFF33" value="FFFF33"><?php _e('RGB FFFF33') ?></div>
	<div style="background-color: #FFFF66" value="FFFF66"><?php _e('RGB FFFF66') ?></div>
	<div style="background-color: #FFFF99" value="FFFF99"><?php _e('RGB FFFF99') ?></div>
	<div style="background-color: #FFFFCC" value="FFFFCC"><?php _e('RGB FFFFCC') ?></div>
	<div style="background-color: #FFFFFF" value="FFFFFF"><?php _e('RGB FFFFFF') ?></div>
</div>
<script>
$(document).ready(function() {
	$('#colors-container-<?php echo $id ?> div').click(function() {
		$('input#<?php echo $id ?>').val($(this).attr('value'));
		
		$('#colors-selected-<?php echo $id ?>')
			.css('background-color', $(this).css('background-color'))
			.text($(this).text());
	});
});
</script>
<?php
	helper_end();
} //helper_price


?>