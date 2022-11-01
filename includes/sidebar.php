<?php 

    if(ifItIsMethod('POST')){

        if(isset($_POST['username']) && isset($_POST['user_password'])){

            login_user($_POST['username'], $_POST['user_password']);
        }else {
            redirect('/cms/index.php');
        }

    }


?>



<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <!-- Search Form -->
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
    </form> 
    <!-- /.input-group -->
</div>
<!-- Blog Search Well ends-->

<!-- Login -->
<div class="well">
    <!-----PHP if else statement to show different html code--------->
    <?php if(isset($_SESSION['user_role'])): ?>

        <h4>Logged in as <?php echo $_SESSION['username'];  ?></h4>
        <a class="btn btn-primary" href="includes/logout.php">Logout</a>
    
        <?php else: ?>

            <h4>Log In</h4>
            <!-- Login Form -->
            <form action="" method="post">
            
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username" autocomplete="on">
            </div>
            
            <div class="input-group">
                <input name="user.password" type="password" class="form-control" placeholder="Enter Password">
                
                <!-- Login Button -->
                <!-- Keeps butt on the same line with span -->
                <span class="input-group-btn"> 
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </span>
            </div>
            <!-- Error report for wrong username or password -->
            <p class="text-danger"><?php echo login_error_message() ?></p>

            <!-- Forgot Password -->
            <div class="form-group"><a href="../forgot_password.php?forgot=<?php  echo uniqid(true); ?>">Forgot Password</a></div>
            
        </form> 
    
            <?php endif; ?>
    


    <!-- /.input-group -->
</div>
<!-- Login Ends-->


<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">  
        <!-- /.col-lg-6 -->
        <!-- lg-12 expands the display to all the 12 rows -->
        <div class="col-lg-12">
            <ul class="list-unstyled">
                
                <!-- Displaying all the categories in Blog Categories Well -->
                <?php 
                    // Limits search results to 3
                    // $query = "SELECT * FROM categories LIMIT 3";
                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);
            
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        // Sending cat_id to category.php
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                        
                    }
                    
                                
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
</div>





<!-- Side Widget Well -->
<?php include "widget.php";?>


</div>