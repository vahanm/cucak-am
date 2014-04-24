<?php
//var_dump($_REQUEST);

require_once(dirname(__FILE__).'/../wp-config.php');


//echo "Started\r\n";

$userId = $_REQUEST['userId'];
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$text = $_REQUEST['text'];

$content = "<p>Subdomain request from $name (ID: $userId) &lt;$email&gt; for <strong>$address.cucak.am</strong></p><p>$text</p>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: $name<$email>\r\n";

$subject = 'Subdomain request';

//echo $content;
//echo $headers;
//echo $subject;

/* ****************** For Moderators ******* BEGIN ******* */
global $moderators_emails;

echo wp_mail($moderators_emails, $subject, $content, $headers) ? 'true' : 'false';
/* ****************** For Moderators *******  END  ******* */

add_client_to_db('Private/send_email');
