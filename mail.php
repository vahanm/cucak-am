
The below email script is for PHP emailing with SMTP authentication.  

 

 

<?php  

//new function  



$to = "admin@cucak.am";  
$nameto = "Admin";

$to = "dioptria@list.ru";  
$nameto = "Saqo";

$to = "vahan.mkhitaryan@gmail.com";
$nameto = "Vahan Mkhitaryan";


$from = "admin@cucak.am";  

$namefrom = "cucak.am - Administrator";  

$subject = "Hello World Again!";  

$message = "World, Hello!";  

authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);  

?>


<?php  

/* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */   



//This will send an email using auth smtp and output a log array  

//logArray - connection,   



function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message)  

{  

	//SMTP + SERVER DETAILS  

	/* * * * CONFIGURATION START * * * */ 

	$smtpServer = "mail.cucak.am";  

	$port = "25";  

	$timeout = "5";  

	$username = "support@cucak.am";  

	$password = "Chimacaq.00";

	$localhost = "mail.cucak.am";  

	$newLine = "\r\n";  

	/* * * * CONFIGURATION END * * * * */ 

	

	//Connect to the host on the specified port  

	$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);  

	$smtpResponse = fgets($smtpConnect, 515);  

	if(empty($smtpConnect))   

	{  

		$output = "Failed to connect: $smtpResponse";  

		return $output;  

	}  

	else 

	{  

		$logArray['connection'] = "Connected: $smtpResponse";  
		$logArray['connectionTime'] ='at: ' . time();

	}  

	

	//Request Auth Login  

	fputs($smtpConnect,"AUTH LOGIN" . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['authrequest'] = "$smtpResponse";  
	$logArray['authrequestTime'] ='at: ' . time();

	

	//Send username  

	fputs($smtpConnect, base64_encode($username) . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['authusername'] = "$smtpResponse";  
	$logArray['authusernameTime'] ='at: ' . time();

	

	//Send password  

	fputs($smtpConnect, base64_encode($password) . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['authpassword'] = "$smtpResponse";  
	$logArray['authpasswordTime'] ='at: ' . time();

	

	//Say Hello to SMTP  

	fputs($smtpConnect, "HELO $localhost" . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['heloresponse'] = "$smtpResponse";  
	$logArray['heloresponseTime'] ='at: ' . time();

	

	//Email From  

	fputs($smtpConnect, "MAIL FROM: $from" . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['mailfromresponse'] = "$smtpResponse";  
	$logArray['mailfromresponseTime'] ='at: ' . time();

	

	//Email To  

	fputs($smtpConnect, "RCPT TO: $to" . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['mailtoresponse'] = "$smtpResponse";  
	$logArray['mailtoresponseTime'] ='at: ' . time();

	

	//The Email  

	fputs($smtpConnect, "DATA" . $newLine);  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['data1response'] = "$smtpResponse";  
	$logArray['data1responseTime'] ='at: ' . time();

	

	//Construct Headers  

	$headers = "MIME-Version: 1.0" . $newLine;  

	$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  

	$headers .= "To: $nameto <$to>" . $newLine;  

	$headers .= "From: $namefrom <$from>" . $newLine;  

	

	fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject$newLine$headers$newLine$newLine$message$newLine.$newLine");  

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['data2response'] = "$smtpResponse";  
	$logArray['data2responseTime'] ='at: ' . time();

	

	// Say Bye to SMTP  

	fputs($smtpConnect,"QUIT" . $newLine);   

	$smtpResponse = fgets($smtpConnect, 515);  

	$logArray['quitresponse'] = "$smtpResponse";   
	$logArray['quitresponseTime'] ='at: ' . time();
	//insert var_dump here -- uncomment out the next line for debug info
	//var_dump($logArray);

	echo "$key = '$value'<br/>\n";

	foreach($logArray as $key => $value)
	{
		echo "$key = '$value'<br/>\n";
	}
}  

?>  


<?php
/*
//phpinfo();


// несколько получателей
$to = 'admin@cucak.am';
$to  = 'bachimatsaq@live.com';

// тема письма
$subject = 'Birthday Reminders for August';
// текст письма
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';
//$message = 'Birthday Reminders for August';
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Дополнительные заголовки
$headers .= 'To: ' . $to . '' . "\r\n";
$headers .= 'From: cucak.am - Technical administrator<admin@cucak.am>' . "\r\n";
// Отправляем
$result = mail($to, $subject, $message, $headers) ? 'True' : 'False';
echo "$result = mail ( '$to', '$subject', message, '$headers' );";
?>



<?php
/*
$addpostval = array();
$addpostval['post_author_name'] = 'Kokomato';
$addpostval['post_title'] = 'Test mail';
$addpostval['post_author_email'] = 'vahan.mkhitaryan@gmail.com';
$StrMailcontent1 = '
				<html>
					<head><title>Your Post has been approved</title></head>
					<body>
						<div style="border:10px solid #3AABE3;float:left;width:610px;">
							<table align="center" width="610px" border="0" cellpadding="4" cellspacing="4">
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="color:#4E6E8E;"><font size="2" face="Verdana, Arial, Helvetica, sans-serif;"><strong>Hi '.$addpostval['post_author_name'].'</strong></font></td>
								</tr>
								<tr>
									<td width="130" valign="top" style="color:#4E6E8E;">
										<font size="2" face="Verdana, Arial, Helvetica, sans-serif;"><strong>'.($addpostval['post_title']).'</strong></font>
									</td>
								</tr>';
$StrMailcontent1 .= '<tr><td>&nbsp;</td></tr>
								<tr>
									<td style="color:#4E6E8E;">
										<font size="2" face="Verdana, Arial, Helvetica, sans-serif;">Thanks &amp; Regards <br/>Admin</font>
									</td>
								</tr>
								<tr><td style="border-bottom:1px dotted #cccccc;"></td></tr>
							</table>
						</div>
					</body>
				</html>';
				
$headers1 = '';		
//$headers1 .= 'MIME-Version: 1.0' . "\r\n";
//$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers1 .= 'From: cucak.am<admin@cucak.am>'.'' . "\r\n";
$subject1 = "Your Post has been published in our site";
$ToEmail1 = $addpostval['post_author_email'];

$result = mail($ToEmail1, $subject1, $StrMailcontent1, $headers1);

var_dump("mail($ToEmail1, $subject1, StrMailcontent1, headers1)");
echo '<hr />';
var_dump($addpostval);
echo '<hr />';
var_dump($StrMailcontent1);
echo '<hr />';
var_dump($headers1);
echo '<hr />';
var_dump($ToEmail1);
echo '<hr />';
var_dump($result);
echo '<hr />';
*/
?>
