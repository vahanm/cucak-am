<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>MySQL Connection test</title>
</head>
<body>

<div style="width: 800px; margin: 5px; border: 1px solid #aaa;">
	MySQL Connection test
</div>

<?php
$___begin = microtime(true);
	
$connection = @mysql_connect( 'sql.byethost17.org', 'parapam_cucak', 'Chimacaq.00', true );
	
$___end = microtime(true);

echo('<div style="width: 800px; margin: 5px; border: 1px solid #aaa;">from ' . $___begin . ' to ' . $___end. ' ( ' . number_format(($___end - $___begin), 4) . ' seconds )</div>');
?>

<div style="width: 800px; margin: 5px; border: 1px solid #aaa;">
	PHP Code
</div>

	<textarea cols="120" rows="10" style="margin: 5px; border: 1px solid #aaa;">
$___begin = microtime(true);
	
	$connection = @mysql_connect( 'localhost', '509_cucak', 'Chimacaq.00', true );
	
$___end = microtime(true);

echo('from ' . $___begin . ' to ' . $___end. ' ( ' . number_format(($___end - $___begin), 4) . ' seconds )');
	
	</textarea>
</body>
</html>
