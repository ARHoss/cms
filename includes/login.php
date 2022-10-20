<?php include "db.php";  ?>



<?php 


    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];

        // Sanitize data
        $username = mysqli_real_escape_string($connection, $username);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_login_query = mysqli_query($connection, $query);

        if(!$select_user_login_query){
            die ("QUERY FAILED".mysqli_error($connection));
        }

        while($row=mysqli_fetch_assoc($select_user_login_query)){

            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firsname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            
        }

        // login check
        if($username !== $db_username && $user_password !== $db_user_password){ // if username and password dont match
            header("Location: ../index.php");
        }else if ($username == $db_username && $user_password == $db_user_password){ // if username and password matches
            header("Location: ../admin");
 
        }else{ // anything else
            header("Location: ../index.php");
        }


    }


?>

