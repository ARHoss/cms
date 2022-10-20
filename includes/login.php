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

            echo $db_id = $row['user_id'];
        }


    }


?>

