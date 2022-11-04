<!-- PHP MAiler Configurations -->
<?php use PHPMailer\PHPMailer\PHPMailer; ?>             <!-- Import PHPMailer classes into the global namespace -->
<?php use PHPMailer\PHPMailer\SMTP;  ?>
<?php use PHPMailer\PHPMailer\Exception;  ?>

<!-- PHP MAiler Configurations -->
<?php  include "./classes/config.php"; ?>
  



<?php 

class Mailer{

    var $mail;
    

    
    function __construct($user_email, $subject, $body, $altBody){
        try{
            //----------------------Configure PHP Mailer-------------------------------//

            $mail = new PHPMailer(true);                                //Create an instance; passing `true` enables exceptions               


            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            
            $mail->isSMTP();                                             //Send using SMTP
            $mail->Host       = Config::SMTP_HOST;                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
            $mail->Username   = Config::SMTP_USER;                       //SMTP username
            $mail->Password   = Config::SMTP_PASSWORD;                   //SMTP password
            $mail->Port       = Config::SMTP_PORT;                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->isHTML(true);                                         //Set email format to HTML
            $mail->CharSet = Config::SMTP_CHARSET;                                    //Sets up characters for different languages
            $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption 

            
            //Not supported by mailtrap                               
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption 
            
            

            //From
            $mail->setFrom(Config::SMTP_FROM_EMAIL, Config::SMTP_FROM_EMAIL_NAME);
            // To
            $mail->addAddress($user_email);     //Add a recipient //Name is optional    

             // Content
            $mail->Subject = $subject;
                
            // Needs to be changed to reflect site
            $mail->Body    = $body;

            $mail->AltBody = $altBody;

             // Send Email
            if($mail->send()){                                          // Send Email
                return true;
            }else{
                return false;
            }
                       
           

        }   catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }  

    }

    function mail_send(){
        
        // Send Email
        if($this -> mail->send()){                                          // Send Email
            return true;
        }else{
            return false;
        }
         

    }


   
}

?>
<!-- Autoloads all the classes for PHP Mailer -->