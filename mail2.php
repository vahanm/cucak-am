<?php
//phpinfo();




// несколько получателей
$to  = 'vahan.mkhitaryan@gmail.com';

$to = 'admin@cucak.am';

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

// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Дополнительные заголовки
$headers .= 'To: Vahan Mkhitaryan <' . $to . '>' . "\r\n";
//$headers .= 'To: <admin@cucak.am>' . "\r\n";
$headers .= 'From: cucak.am - Technical administrator <admin@cucak.am>' . "\r\n";



//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Отправляем
$result = mail($to, $subject, $message, $headers) ? 'True' : 'False';

echo "$result = mail($to, $subject, message, $headers);";
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
