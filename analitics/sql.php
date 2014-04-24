<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body>
<?php


/*
PHP Script to benchmark a MySQL-Server
(c) www.webdesign-informatik.deSQL Code for Testtable:CREATE TABLE IF NOT EXISTS `mytable` (
`mycol` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `mytable` (`mycol`) VALUES (23);

 */
$db_server = 'cucak.am';
$db_user = '509_cucak';
$db_pw = 'Chimacaq.00';
$db_name = '509_cucak';


$timeStart = microtime_float();
$link = mysql_connect($db_server, $db_user, $db_pw);
mysql_select_db($db_name, $link);

$query = "SELECT BENCHMARK(1000000,ENCODE('hello','goodbye'));";
$result = mysql_query($query, $link);
$query = 'BENCHMARK(10000, (SELECT * FROM sqltest)';
$result = mysql_query($query, $link);

$timeEnd = microtime_float();
echo "Time: ".($timeEnd - $timeStart)." s";
mysql_close($link);

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


?>
</body>
</html>
