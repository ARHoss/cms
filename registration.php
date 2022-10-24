<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">


<!-- User Regsitration Query -->
<?php   


if(isset($_POST['user_register'])){

     if(!empty($_POST['username']) && !empty($_POST['user_password']) && !empty($_POST['user_email'])){ 

        $username   = $_POST['username'];
        $user_password   = $_POST['user_password'];
        $user_email = $_POST['user_email'];


        // Checking for sql and html injections
        $username   = mysqli_real_escape_string($connection, $username);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $user_password   = mysqli_real_escape_string($connection, $user_password);

        // Encryption

        // Getting randSalt value
        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);
        if(!$select_randSalt_query){
            die("Query failed" . mysqli_error($connection));
        }

        $row = mysqli_fetch_assoc($select_randSalt_query);
        $randSalt = $row['randSalt'];

        // Encrypting Password
        $hashed_password = crypt($user_password, $randSalt);


        // insert values in DB
        $query = "INSERT INTO users(username, user_email, user_password, user_role, user_date_created) ";
        $query .= "VALUES ('{$username}', '{$user_email}', '{$hashed_password}', 'subscriber',now() ) ";
        $add_new_user_query = mysqli_query($connection, $query);
        if(!$add_new_user_query){
            die("Query failed" . mysqli_error($connection));
        }



        $message = "Your Registration has been submitted";

    } else{

        $message = "Fields Cannot Be Empty";

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
                        <h5 class="text-center"><strong><?php if(isset($message)) {echo $message;}?></strong></h5>    
                        
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
