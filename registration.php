<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">


<!-- User Regsitration Query -->
<?php   


if(isset($_POST['user_register'])){



    $username   = $_POST['username'];
    $password   = $_POST['user_password'];
    $user_email = $_POST['user_email'];


    // Checking for sql and html injections
    $username   = mysqli_real_escape_string($connection, $username);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $password   = mysqli_real_escape_string($connection, $password);

    // Encryption

    // Getting randSalt value
    $query = "SELECT randSalt FROM users";
    $select_randSalt_query = mysqli_query($connection, $query);

    if(!$select_randSalt_query){
        die("Query failed" . mysqli_error($connection));
    }

    // $password = crypt($password, $hashF_and_salt);




    // $hashF_and_salt = $hashFormat.$salt;







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
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" id="username" class="form-control" placeholder="Enter Desired Username" name="username" >
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="somebody@example.com" name="user_email" >
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" id="key" class="form-control" placeholder="Password" name="user_password">
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
