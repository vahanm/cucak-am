<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body>
<article>
<img id="hidden-logo" src="http://cucak.am/wp-admin/images/logo-login.png">
<br/>
<?php

echo $_SERVER['HTTP_USER_AGENT'], '<br/>', $_SERVER['REMOTE_ADDR'];

ob_start();
var_dump($_SERVER);
$data = ob_get_clean();

file_put_contents ( 'agents.txt' , $data, FILE_APPEND );
file_put_contents ( 'agents.txt' , "\n\n\n\n\n\n\n", FILE_APPEND );

?>

</article>
</body>
</html>
