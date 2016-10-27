<?php
$to       = 't.deakin@live.com.au'; //email address
$subject  = 'Test Email'; //subject line of email
$message  = 'This is a test email.'; //email body
$headers  = 'From: ifb299event@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed"; //logging and debugging for email is enabled
?>