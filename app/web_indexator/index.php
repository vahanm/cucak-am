<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Web Indexator</title>

    <style type="text/css">
    #webPage, #resultData
    {
    	border: 4px double #999;
    	height: 350px;
    	margin-top: 20px;
    	overflow: scroll;
    }
	input:text
	{
		width: 300px;
		margin-left: 10px;
	}
    </style>

    <script type="text/javascript" src="jquery-1.8.2.js" ></script>

    <script type="text/javascript">
        function collectData() {
			$p = $('#webPage');
			$d = $p.find('#print_content');
			$l = $d.find('.fll.autopage_leftblock');
			$r = $d.find('.fll.autopage_rightblock');
			$s = $d.find('div.carpageTitleNew');
			
			$t = $('#resultData');
			
			var ass = [0, 'arm', 2, 3, 4, 5, 6];
			var cId = $s.find('div.fll.mtop7:eq(0) img.fll.mright10.paddingtop5').attr('src').split('/flags_s/')[1].split('.jpg')[0];
			
			$t.append('<span>post_country</span> <input name="post_country" type="text" value="' + ass[cId] + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_</span> <input name="post_" type="text" value="' + $s.find('div.fll.mtop7:eq(0) a.black.fs18.fnormal:first').text().trim() + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_</span> <input name="post_" type="text" value="' + $s.find('div.fll.mtop7:eq(0) a.black.fs18.fnormal:last').text().trim() + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_</span> <input name="post_" type="text" value="' + $s.find('div.fll.mtop7:eq(1) a.black.fs18.fnormal').text().trim() + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_</span> <input name="post_" type="text" value="' + $s.find('div.fll.mtop7:eq(2)').text().trim() + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_allow_sale</span> <input name="post_allow_sale" type="text" value="1" />');
			$t.append('<br/>');
			
			$t.append('<span>post_sale_price</span> <input name="post_sale_price" type="text" value="' + $s.find('div.fll.mtop7:eq(3) div.red').text().replace('.', '').replace('(by exchange)', '').trim() + '" />');
			$t.append('<br/>');
			
			$t.append('<span>post_allow_exchange</span> <input name="post_allow_exchange" type="text" value="' + (($s.find('div.fll.mtop7:eq(3) div.red').text().trim().indexOf('by exchange')) ? 1 : 0) + '" />');
			$t.append('<br/>');
			
			$images = $('<ul></ul>');
			$l.find('img.big_image').each(function() {
				$images.append('<li>' + $(this).attr('src') + '</li>')
			});
			$images.appendTo($t);
        }

        function loadData() {
            $.ajax({
                url: $('#pageUrl').val(),
                success: function (data) {
                    $('#webPage').html(data);
                }
            });
        }
    </script>
</head>
<body>
    <h2>Web Indexator</h2>
    <div id="webPage">
	<?php
	if(isset($_POST['pageurl'])) {
		echo file_get_contents($_POST['pageurl']);
	}
	?>
	</div>
	<form method="post">
		<input type="text" id="pageUrl" name="pageurl" value="<?php echo $_POST['pageurl'] ?>" />
		<input type="submit" value="Load" />
		<input type="button" onclick="collectData()" value="Collect" />
	</form>
	
	<form action="http://cucak.am/addnew/?type=295" method="post">
		<div id="resultData"></div>
		<input type="submit" value="Add post" />
	</form>
</body>
</html>
