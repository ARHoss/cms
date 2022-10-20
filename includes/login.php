<?php include "db.php"; ?>
<?php session_start(); ?>



<?php 


    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];

        // Sanitize data
        $username = mysqli_real_escape_string($connection, $username);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        // Retrieving information from DB
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_login_query = mysqli_query($connection, $query);

        if(!$select_user_login_query){
            die ("QUERY FAILED".mysqli_error($connection));
        }

        while($row=mysqli_fetch_assoc($select_user_login_query)){

            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            
        }

        // login check
        // === check if the variables are exactly identical
        if($username === $db_username && $user_password === $db_user_password){ // if username and password matches
            
             // setting Session variables
             $_SESSION['username'] = $db_username;
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['user_role'] = $db_user_role;
             
             header("Location: ../admin");
            
        }else { // anything else
            
            header("Location: ../index.php");
            
        }


    }


?>

