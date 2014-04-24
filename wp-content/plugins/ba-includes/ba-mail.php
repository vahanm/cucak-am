<?php
/* Plugin Name: BA Email sender
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: This plugin helps to send emails
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/


global $moderators_emails;

$moderators_emails =	'Support Team <support@cucak.am>,' .
                        'Vahan Mkhitaryan <vahan.mkhitaryan@gmail.com>,' .
                        'Sargis Grigoryan <sargis.grigor89@gmail.com>';
                        
$moderators_emails =	'Support Team <support@cucak.am>';

//The below email script is for PHP emailing with SMTP authentication.  

//new function  
/*

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
*/


function sendPostDataAdmin($to, $nameto, $postId)
{
    $from = "support@cucak.am";  
    $namefrom = "cucak.am - Support team";  

    $subject = __("Added an announcement on cucak.am");

    $message .= __("Added an announcement on cucak.am");
    //$message .= "<br/><br/>";
    //$message = "From $nameto.";
    $message .= "<br/><br/>";
    $message .= "<a href=\"http://cucak.am/?p=$postId\">Click here</a> to view post.";
        
    return authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);
    //echo "authSendEmail($from, $namefrom, $to, $nameto, $subject, $message)";
}

function sendPostData($to, $nameto, $postId) {
    $from = "support@cucak.am";  
    $namefrom = "cucak.am - Support team";  

    $headers = array(
        "From: $namefrom <$from>",
        "To: $to",
    );
    
    $subject = __("You have added an announcement on cucak.am");

    $message = "Hi $nameto.";
    $message .= "<br/><br/>";
    $message .= __("You have added an announcement on cucak.am");
    $message .= "<br/><br/>";
    $message .= "<a href=\"http://cucak.am/?p=$postId\">Click here</a> to view post.";
    
    return wp_mail( $to, $subject, $message, $headers , /*$attachments*/ '' );
    //return authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);
    //echo "authSendEmail($from, $namefrom, $to, $nameto, $subject, $message)";
}

function convertToHttpString($text)
{
    $result = '';
    for ($i=0; $i < strlen($text); $i++) {
        $result .= '&#' . Ord(substr($text, $i, 1)) . ';';
    }
    return $result;
}

/* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */   



//This will send an email using auth smtp and output a log array  

//logArray - connection,   



function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message) {  
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

    $logArray = array();

    //Connect to the host on the specified port  

    $smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);  
        
    $smtpResponse = fgets($smtpConnect, 515);  

    if(empty($smtpConnect)) {
        $output = "Failed to connect: $smtpResponse";
        return $output;
    } else {
        $logArray['connection'] = "Connected: $smtpResponse";  
        $logArray['connectionTime'] ='at: ' . date("Y-m-d H:i:s");
    }
    
    //Request Auth Login  
    fputs($smtpConnect,"AUTH LOGIN" . $newLine);  

    $smtpResponse = fgets($smtpConnect, 515);  
    $smtpResponse .= fgets($smtpConnect, 515);  
    $smtpResponse .= fgets($smtpConnect, 515);  
    //$smtpResponse .= fgets($smtpConnect, 515);  
    //$smtpResponse .= fgets($smtpConnect, 515);  
    //$smtpResponse .= fgets($smtpConnect, 515);  
    //$smtpResponse .= fgets($smtpConnect, 515);  

    $logArray['authrequest'] = "$smtpResponse";  
    $logArray['authrequestTime'] ='at: ' . date("Y-m-d H:i:s");

    //Send username  
    fputs($smtpConnect, base64_encode($username) . $newLine);
    
    $smtpResponse = fgets($smtpConnect, 515);
    
    $logArray['authusername'] = "$smtpResponse";  
    $logArray['authusernameTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //Send password
    fputs($smtpConnect, base64_encode($password) . $newLine);
    
    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['authpassword'] = "$smtpResponse";  
    $logArray['authpasswordTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //Say Hello to SMTP  

    fputs($smtpConnect, "HELO $localhost" . $newLine);  

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['heloresponse'] = "$smtpResponse";  
    $logArray['heloresponseTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //Email From  

    fputs($smtpConnect, "MAIL FROM: $from" . $newLine);  

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['mailfromresponse'] = "$smtpResponse";  
    $logArray['mailfromresponseTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //Email To  

    fputs($smtpConnect, "RCPT TO: $to" . $newLine);  

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['mailtoresponse'] = "$smtpResponse";  
    $logArray['mailtoresponseTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //The Email  

    fputs($smtpConnect, "DATA" . $newLine);  

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['data1response'] = "$smtpResponse";  
    $logArray['data1responseTime'] ='at: ' . date("Y-m-d H:i:s");

    

    //Construct Headers  

    $headers = "MIME-Version: 1.0" . $newLine;  

    $headers .= "Content-type: text/html; charset=UTF-8" . $newLine;

    $headers .= "To: $nameto <$to>" . $newLine;  

    $headers .= "From: $namefrom <$from>" . $newLine;  

    

    fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject$newLine$headers$newLine$newLine$message$newLine.$newLine");  

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['data2response'] = "$smtpResponse";  
    $logArray['data2responseTime'] ='at: ' . date("Y-m-d H:i:s");

    

    // Say Bye to SMTP  

    fputs($smtpConnect,"QUIT" . $newLine);   

    $smtpResponse = fgets($smtpConnect, 515);  

    $logArray['quitresponse'] = "$smtpResponse";   
    $logArray['quitresponseTime'] ='at: ' . date("Y-m-d H:i:s");
    //insert var_dump here -- uncomment out the next line for debug info
    //var_dump($logArray);

/*
    echo "<br/>\n";

    foreach($logArray as $key => $value)
    {
        echo "$key = '$value'<br/>\n";
    }
*/

    return $logArray;
}
