<?php

// how to install pear to make php mailer work w/ html

//https://help.dreamhost.com/hc/en-us/articles/214392988-How-do-I-install-PEAR-

//sending the html mail with pear and smtp
//https://help.dreamhost.com/hc/en-us/articles/216140597

//sending HTML with Pear
//https://stackoverflow.com/questions/1361762/how-to-send-html-mails-using-pear-mail

require_once "Mail.php"; 
include('Mail/mime.php');

function sendMail($email_body, $to, $type) {

    include($type, '.php');

    $host = "ssl://smtp.dreamhost.com";
    $username = "support@adrkos1.dreamhosters.com";
    $password = "4hdKuVE3";
    $port = "465";
 
    $to = $to; // EMAIL TO SEND TO 
    $email_from = "support@adrkos1.dreamhosters.com"; // FROM US (OUR EMAIL)
    $email_subject = "Subject Line Here:" ; // MESSAGE TITLE 
    $email_body = $email_body; // MESSAGE 
    $email_address = "support@adrkos1.dreamhosters.com"; // FROM US (OUR EMAIL)

    $text = 'This is a text message.';// Text version of the email
    $html = $email_body;
    $crlf = "\r\n";
    $contenttype = 'text/html; charset=UTF-8';
    $headers = array('From' => $email_from, 'To' => $to, 'Return-Path' => $email_from, 'Subject' => $email_subject, 'Reply-To' => $email_address,'Content-Type' => $contenttype);

    // Creating the Mime message
    $mime = new Mail_mime($crlf);

    // Setting the body of the email
    $mime->setTXTBody($text);
    $mime->setHTMLBody($html);

    $body = $mime->get();
    $headers = $mime->headers($headers);
    $message = mb_convert_encoding($body, 'HTML-ENTITIES', "UTF-8");

    // // Sending the email
    $mail =& Mail::factory('mail');
    $mail->send($to, $headers, $body);
    
    //$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
    //$mail = $smtp->send($to, $headers, $email_body);
    
}

if (PEAR::isError($mail)) {
    echo 'Error';
// echo("<p>" . $mail->getMessage() . "</p>");
} else {
//echo("<p>Message successfully sent!</p>");
}

?> 