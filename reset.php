<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



<?php 
    // Redirects if variable email and token not set in get method
    if(!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('/cms');
    }

    $user_email = $_GET['email'];
    $user_email = escape($user_email);

    $token = $_GET['token'];
    $token = escape($token);


    //-----------------------Prepare Statements SELECT PHP-----------------------//
    // Sets up the connection and compares the token in the database
    if($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token = ?")){
        // s stands for sting
        mysqli_stmt_bind_param($stmt, 's', $token);
        // Executes
        mysqli_stmt_execute($stmt);

        // bind the results
        mysqli_stmt_bind_result($stmt, $DBusername, $DBuser_email, $DBtoken);

        // fetch
        mysqli_stmt_fetch($stmt);

        // Close the connection
        mysqli_stmt_close($stmt);

        // Redirecting user if token or email does not match
        if($token !== $DBtoken || $user_email !== $DBuser_email){
            redirect('/cms/login.php');
        }
    }


    // Seting up the password using POST and prepared statement

    if(ifItIsMethod('POST')){
        if(!empty($_POST['user_password']) && !empty($_POST['user_password_verify'])){
            if($_POST['user_password'] === $_POST['user_password_verify']){

                $user_password = $_POST['user_password'];
                $user_password = escape($user_password);

                //----------------------Encrypting Password---------------------
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

                // Sets up the connection and updates value
                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashed_password}' WHERE token = ?")){
                    // s stands for sting
                    mysqli_stmt_bind_param($stmt, 's', $token);
                    // Executes
                    mysqli_stmt_execute($stmt);

                    // check result
                    if(mysqli_stmt_affected_rows($stmt) >= 1){
                        
                        redirect('/cms/login.php');
                    }

                    // Close the connection
                    mysqli_stmt_close($stmt);
                }else {
                    echo "Bad Query";
                }


            }else{
                $_SESSION['message'] = "Password do not match";
            }
        }else{
            $_SESSION['message'] = "Fields cannot be empty";
        }
    }



?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">


        <div class="form-gap"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                
                                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                                    <h2 class="text-center">Password Reset</h2>
                                    <p>You can enter your new password here.</p>
                                    <div class="panel-body">

                                        <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                    <input id="user_password" name="user_password" placeholder="enter new password" class="form-control"  type="password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>
                                                    <input id="user_password_verify" name="user_password_verify" placeholder="retype password" class="form-control"  type="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                            </div>

                                            <input type="hidden" class="hide" name="token" id="token" value="">

                                                                                    <!-- Error report if email already exists -->
                                            <p class="text-danger"><?php echo error_message() ?></p>
                                        </form>

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

