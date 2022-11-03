<!-- PHP MAiler Configurations -->
<?php use PHPMailer\PHPMailer\PHPMailer; ?>             <!-- Import PHPMailer classes into the global namespace -->
<?php use PHPMailer\PHPMailer\SMTP;  ?>


<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- PHP MAiler Configurations -->
<?php  include "./vendor/autoload.php"; ?>              <!-- Autoloads all the classes for PHP Mailer -->

<?php 
    // Redirects if it is not get method or forgot variable not set
    // Needs refactoring
    if(!isset($_GET['forgot'])){
        redirect('/cms');
    }

    if(ifItIsMethod('POST')){
        if(isset($_POST['user_email'])){

            $user_email = $_POST['user_email'];
            $user_email = escape($user_email);

            // Creates random token to insert in DB and send through email
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            // Checking for email and creating error_message
            //-----------------------Prepare Statements INSERT PHP-----------------------//
            if(email_exists($user_email)){

                // Sets up the connection and updates value
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email = ?")){
                    // s stands for sting
                    mysqli_stmt_bind_param($stmt, 's', $user_email);
                    // Executes
                    mysqli_stmt_execute($stmt);
                    // Close the connection
                    mysqli_stmt_close($stmt);
                } 
                // Query testing 
                // else {
                //     echo mysqli_error($connection);
                // }


                //----------------------Configure PHP Mailer-------------------------------//

                $mail = new PHPMailer(true);                                //Create an instance; passing `true` enables exceptions               
                // echo get_class($mail);                                   // Checks if we received the class


                
                $mail->isSMTP();                                             //Send using SMTP
                $mail->Host       = Config::SMTP_HOST;                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
                $mail->Username   = Config::SMTP_USER;                       //SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;                   //SMTP password
                
                // Mailtrap works with tls
                $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption                                            
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          //Enable implicit TLS encryption //Not supported by mailtrap
                
                $mail->Port       = Config::SMTP_PORT;                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->isHTML(true);                                         //Set email format to HTML
                $mail->CharSet = 'UTF-8';                                    //Sets up characters for different languages

                //Recipients
                $mail->setFrom('edwin@edwindiaz.com', 'Mailer');
                $mail->addAddress($user_email);     //Add a recipient //Name is optional          
                
                // Content
                $mail->Subject = 'Reset Password for CMS';
                
                // Sends link with the user's email and unique token
                // Needs to be changed to reflect site
                $mail->Body    = "<p>
                
                <a href='http://localhost/cms/reset.php?email=$user_email&token=$token'>Please click to reset password</a>      

                </p>";
                
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if($mail->send()){                                          // Send Email
                    $email_sent = true;
                }else {
                    $email_sent = false;
                }                                          

                
                
                
                



            }
                
        }
    }

?>



<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <?php if(!isset($email_sent)):?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="user_email" name="user_email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">

                                        <!-- Error report if email already exists -->
                                        <p class="text-danger"><?php echo error_message() ?></p>

                                        
                                    </form>
                                <?php else:  ?>                                    
                                    <h3>Please check your email</h3>

                                <?php endif;  ?>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

