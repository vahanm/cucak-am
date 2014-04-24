<?php

$ln = $_GET['ln'];

setcookie('mylang', $ln, 0x6FFFFFFF, '', 'cucak.am');
setcookie('mylang', $ln, 0x6FFFFFFF, '', '.cucak.am');

setcookie('mylang', $ln, 0x6FFFFFFF, '', $_SERVER['HTTP_HOST']);
setcookie('mylang', $ln, 0x6FFFFFFF, '', '.' . $_SERVER['HTTP_HOST']);

$to = $_GET['to'];
if($to) {
    header('Location: ' . str_replace(array( 'en.cucak.am', 'ru.cucak.am', 'am.cucak.am' ), 'cucak.am', $to));
} else {
	header('Location: ' . str_replace(array( 'en.cucak.am', 'ru.cucak.am', 'am.cucak.am' ), 'cucak.am', site_url()));
}
