<!-- Header -->
<?php include "includes/admin_header.php";?>


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                    <div class="col-lg-12">
                        
                    <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['firstname']; ?></small>
                            
                    </h1>



                    <!-- Main Content -->
                    <!-- enctype is resposible for sending different form data -->
                    <form action="" method="post" enctype="multipart/form-data">

                        
                    <!-- Reading user data and inseting in form -->
                    <?php 

                    if(isset($_SESSION['id'])){
                        $the_user_id = $_SESSION['id'];
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
                        <input class="btn btn-primary" type="submit" name="update_user_profile" value="Update Profile">
                    </div>  

                    </form>

                    <?php 

                        if(isset($_POST['update_user_profile'])){
                                
                            // Retrieving Values from form
                            if(isset($_SESSION['id'])){
                                $the_user_id = $_SESSION['id'];
                            }
                    
                            $user_firstname = $_POST['user_firstname'];
                            
                            $user_lastname = $_POST['user_lastname'];
                            
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
                            user_email='$user_email', user_image='$user_image' ";
                            $user_update_query .= "WHERE user_id = $the_user_id";

                            $create_user_update_query = mysqli_query($connection, $user_update_query);

                            // Refreshes the page after deleteion
                            header("Location: index.php");

                            // Refreshes the page after deleteion
                            // header("Location: profile.php");

                            // Checking query 
                            // confirmQuery($create_update_query);

                            
                        }



                    ?>

                    

                    <!-- Main Content ends-->




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!--Footer -->
<?php include "includes/admin_footer.php";?>
