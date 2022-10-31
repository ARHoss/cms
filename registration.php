<?php  include "includes/header.php"; ?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">


<!-- User Regsitration Query -->
<?php   

// Checks for post on this page
if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Sanitizing for SQL injection
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $user_email = escape($_POST['user_email']);

    // ---------------Error checking----------------------//
    $error = [
        'username' => '',
        'email' => '',
        'password' => ''

    ];


    if(strlen($username) < 4){

        $error['username'] = "Username Needs to be longer";

    }

    if(empty($username)){

        $error['username'] = "Username cannot be empty";

    }

    if(username_exists($username)){

        $error['username'] = "Username already exists, please try another one";

    }

    if(empty($user_email)){

        $error['user_email'] = "Email cannot be empty";

    }

    if(email_exists($user_email)){

        $error['user_email'] = "Email already exists, <a href='index.php'>Please login</a>";

    }

    if(empty($user_password)){

        $error['user_password'] = "Password cannot be empty";

    }

    // Change it to 8
    if(strlen($user_password) < 2){

        $error['user_password'] = "Password Needs to be longer";

    }
    // ---------------Error checking----------------------//

    // Error Reporting 
    foreach ($error as $key => $value) {
        # code...
        if(empty($value)){

            // Clearing $key in assocaitive array
            unset($error[$key]);      

        }
    }

    if(empty($error)){
        
        // Regsiter function
        register_user($username, $user_password, $user_email);

        // Login Function
        login_user($username, $user_password);
        $message = "Logged in";

    }


}

?>

<!-- User Registration Form -->
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        
                        <!-- Registration Message -->
                        <h5 class="text-center"><strong><?php if(isset($message)) {print_console($message);}?></strong></h5>    
                        
                        <!-- Username Field -->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            
                            <!-- Reproducing the values & using shorthand if statement-->
                            <input type="text" id="username" class="form-control" placeholder="Enter Desired Username" name="username" 
    
                            autocomplete="on"
                            
                            value="<?php echo isset($username) ? $username : '' ?>"
                            >

                            <!-- Error reporting in form -->
                            <p><?php echo isset($error['username']) ? $error['username'] : ''  ?></p>
                                                
                        </div>
                         
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                        
                            <!-- Reproducing the values & using shorthand if statement-->
                            <input type="email" id="email" class="form-control" placeholder="somebody@example.com" name="user_email" 
                            
                            autocomplete="on"
                            
                            value="<?php echo isset($user_email) ? $user_email : '' ?>"            
                            >

                            <!-- Error reporting in form -->
                            <p><?php echo isset($error['user_email']) ? $error['user_email'] : ''  ?></p>
                        
                        </div>
                        
                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" id="key" class="form-control" placeholder="Password" name="user_password">
                            
                            <!-- Error reporting in form -->
                            <p><?php echo isset($error['user_password']) ? $error['user_password'] : ''  ?></p>
                        
                        </div>
                
                        <input type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block " value="Register" name="user_register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
