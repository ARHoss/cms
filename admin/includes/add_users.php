

<?php 

    if(isset($_POST['create_user'])){
        
        // Retrieving Values from form
        $username = $_POST['username'];

        //----------------------Encryption-------------------------------------//
        $user_password = $_POST['user_password'];
        // Getting randSalt value
        $randSalt = randSalt();
        // Encrypting Password
        $hashed_password= crypt($user_password, $randSalt);
        //----------------------Encryption-------------------------------------//


        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        
        // Function for images
        // if it does not work provide permsission to the folder to everyone
        move_uploaded_file($user_image_temp, "../images/$user_image");


        // insert values
        $query = "INSERT INTO users(username, user_password, 
        user_firstname, user_lastname, user_email, user_date_created, user_image, 
        user_role) ";
        
        // use '' for strings
        $query .= "VALUES ('{$username}', '{$hashed_password}', '{$user_firstname}', '{$user_lastname}',
         '{$user_email}',now(), '{$user_image}', '{$user_role}' ) ";

        $add_user_query = mysqli_query($connection, $query);

        // Checking query 
        // confirmQuery($create_user_query);


        // Provides message after creating user
        $message = "User Created Successfully";

        
    }

?>




<!-- enctype is resposible for sending different form data -->
<!-- Form to add user -->
<form action="" method="post" enctype="multipart/form-data">


    <!-- Success Message -->
    <h5 class="text-center"><strong><?php if(isset($message)) {echo $message;}?></strong></h5>  

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <!-- user role -->
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">

            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>

        </select>
   </div>
   <!-- user role Ends-->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="image">
    </div>
   
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>