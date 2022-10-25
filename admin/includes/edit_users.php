<!-- enctype is resposible for sending different form data -->
<form action="" method="post" enctype="multipart/form-data">

    
    <!-- Reading user data and inseting in form -->
    <?php 

    if(isset($_GET['u_id'])){
        $the_user_id = $_GET['u_id'];
    }

    
    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $edit_user_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($edit_user_query)){
            
             // Retrieving Values from form
            $username = $row['username'];

            $db_user_password = $row['user_password'];
            
            
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];

            
    ?>
    
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value=<?php if(isset($user_firstname)){echo $user_firstname;}else{echo "NoName";} ?> type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value=<?php if(isset($user_lastname)){echo $user_lastname;}else{echo "NoName";} ?> type="text" class="form-control" name="user_lastname">
    </div>

    <!-- Pupalting user role -->
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">

            <?php 
                if($user_role == "admin"){

                    echo "<option value='admin' selected='selected'>Admin</option>";
                    echo "<option value='subscriber'>Subscriber</option>";
                    
                }else{
                    echo "<option value='admin'>Admin</option>";
                    echo "<option value='subscriber' selected='selected'>Subscriber</option>";

                }
            
            ?>
             
        </select>
   </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input value=<?php if(isset($username)){echo $username;} ?> type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value=<?php if(isset($user_email)){echo $user_email;} ?> type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="db_user_password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
            <img width="100" src="../images/<?php echo $user_image;?>" alt="image">
            <input type="file" name="user_image">
    </div>

    <?php }  ?>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>  
    
</form>

<?php 

    if(isset($_POST['edit_user'])){
            
        // Retrieving Values from form
        $the_user_id = $_GET['u_id'];
 
        $user_firstname = $_POST['user_firstname'];
        
        $user_lastname = $_POST['user_lastname'];
        
        $user_role = $_POST['user_role'];
    
        $username = $_POST['username'];

        $user_email = $_POST['user_email'];

        //----------------------Encryption-------------------------------------//
        $user_password = $_POST['user_password'];

        if(!empty($user_password)){
            
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10)); 


        }else{ 
            $hashed_password = $db_user_password;

        }
        //----------------------Encryption-------------------------------------//

        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
        // Function for images
        // if it does not work provide permsission to the folder to everyone
        // Image is transferred from $user_image_temp to $user_image
        move_uploaded_file($user_image_temp, "../images/$user_image");
        

        // Re-populating the user_image when an empty image form submitted
        if(empty($user_image)){


        $user_post_query = "SELECT * FROM users WHERE user_id = $the_user_id";
        $user_image_query = mysqli_query($connection, $user_post_query);
        

            while($row = mysqli_fetch_assoc($user_image_query)){
                
            
                $user_image = $row['user_image'];


            }
        }

        $user_update_query = "UPDATE users SET username='$username', user_password='$hashed_password', user_firstname='$user_firstname', user_lastname='$user_lastname', 
        user_email='$user_email', user_image='$user_image', user_role='$user_role' ";
        $user_update_query .= "WHERE user_id = $the_user_id";

        $create_user_update_query = mysqli_query($connection, $user_update_query);

        // Refreshes the page after deleteion
        header("Location: users.php");
        



        // Checking query 
        // confirmQuery($create_update_query);

        
    }



?>



