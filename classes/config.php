<?php 

// Keeps all our configuration for sending email
class Config {


    const SMTP_HOST             = 'smtp.mailtrap.io';                   //Set the SMTP server to send through
    const SMTP_PORT             = 2525;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    const SMTP_USER             = '376d18bda4391c';                     //SMTP username
    const SMTP_PASSWORD         = 'fd15113f5c347f';                     //SMTP password
    const SMTP_CHARSET          = 'UTF-8';                              //Sets up characters for different languages
    const SMTP_FROM_EMAIL       = 'edwin@edwindiaz.com';                //Email From
    const SMTP_FROM_EMAIL_NAME  = 'Mailer';                             //Email From Name


}






?>
