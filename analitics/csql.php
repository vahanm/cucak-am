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

//$query = "SELECT BENCHMARK(1000000,ENCODE('hello','goodbye'));";
//$result = mysql_query($query, $link);


$query = '
SELECT post_id, meta_key, meta_value
FROM wp_postmeta
WHERE post_id IN (  2903,2902,2901,2899,2876,
                    2891,2883,2886,2885,2884,
                    2882,2881,2880,2879,
                    2716,2869,2857,2856,2855,
                    2854,2853,2850,2849,2847
                );
';

echo '<textarea rows="10" cols="60">', $query, '</textarea>';

$result = mysql_query($query, $link);

$timeEnd = microtime_float();
echo "Time: ".($timeEnd - $timeStart)." s<br/>";
$timeStart = microtime_float();

$query = '
SELECT
  post_id,
  meta_key,
  meta_value
FROM wp_postmeta
WHERE post_id IN(   15,2748,2749,2747,2442,2441,2540,2790,414,
                    612,1792,1009,2861,627,611,626,984,983,985,1023,608,968,1043,
                    979,980,982,981,977,976,975,978,1004,1005,1006,1007,1347,
                    1008,986,715,716,1103,1377,1376,1405,745,731,736,738,742,
                    733,732,730,729,1372,728,735,734,737,739,740,741,743,824,
                    822,919,1375,1378,606,712,1379,989,1381,1382,1403,1383,1384,
                    1385,1386,1387,1388,990,992,991,996,1016,1017,2023,2022,1018,
                    1019,1020,1021,2025,1010,1011,1012,1013,1014,1032,1024,1026,
                    1976,1975,1974,1982,1527,1029,1027,1028,1526,1025,2167,2168,
                    1030,993,994,995,997,999,1000,1001,1002,1003,1031,1409,1408,1804,18
               );
';

echo '<textarea rows="10" cols="60">', $query, '</textarea>';

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
