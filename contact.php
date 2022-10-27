<?php  include "includes/header.php"; ?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">


<!-- User Regsitration Query -->
<?php   


if(isset($_POST['send_email'])){
    

     if(!empty($_POST['user_email']) && !empty($_POST['user_subject']) && !empty($_POST['user_message'])){ 

        // This field needs to be hardcoded
        $to   = "raufhossain2010@gmail.com";

        $subject   = $_POST['user_subject'];
        $header = "From: ".$_POST['user_email'];
        $message = $_POST['user_message'];

        // the message
        // $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        // $msg = wordwrap($msg,70);

        // send email
        mail($to,$subject,$message, $header);
               
        $message = "Your Email has been sent";

    } else{

        $message = "Fields cannot be empty";

    }



}

?>

<!-- User Registration Form -->
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        
                        <!-- Registration Message -->
                        <h5 class="text-center"><strong><?php if(isset($message)) {echo $message;}?></strong></h5>
                        
                        <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email" name="user_email" >
                        </div>

                        <div class="form-group">
                            <label for="user_subject" class="sr-only">Subject</label>
                            <input type="text" id="user_subject" class="form-control" placeholder="Enter Subject" name="user_subject" >
                        </div>
                         
                        <div class="form-group">
                            <textarea class="form-control" id="body" cols="30" rows="10" name="user_message"></textarea>
                        </div>
                
                        <input type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block " value="Send Email" name="send_email">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
