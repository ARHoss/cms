<?php include_once "includes/db.php";?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            
        <!-- Brand and toggle get grouped for better mobile display -->
        
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Home</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- This section is the black header at the top of the home page -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                    
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        //------------Active Navigation Link code-----------
                        $category_class = '';
                        $registration_class = '';
                        $contact_class = '';
                        $login_class = '';

                        
                        // function for current page
                        $pageName = currentPage();

                        if(isset($_GET['category']) && $_GET['category'] == $cat_id){

                            $category_class = 'active';
                            
                        }else{
                            if(isset($pageName)){
                                switch ($pageName) {
                                
                                    case 'registration.php':
                                        # code...
                                        $registration_class = 'active';
                                        break;
                                    
                                    case 'contact.php':
                                        # code...
                                        $contact_class = 'active';
                                        break;
                                    
                                    case 'login.php':
                                        # code...
                                        $login_class = 'active';
                                        break;
                                
                                    default:
                                        # code...
                                        break;
                                }
                            }
                            
                        } 
                        
                        
                        
                        
                        // if($pageName == $registration) {
                        //     $registration_class = 'active';
                        // }else if ($pageName == $contact){
                        //     $contact_class = 'active';
                        // }
                        
                        echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        
                    }
        
                    
                    ?>
                    <li>
                        <?php  
                            // Only subscriber are not allowed to have this tab
                            if(isLoggedIn()){
                                if(isAdminUser() || isStandardUser()){
                                    echo "<a href='admin'>Admin</a>";
                                }
                            }
                        
                        
                        ?>
                    </li>
                    
                    <!-- Dynamic edit post link for admin -->
                    <li>
                        <?php 
                        
                            if(isLoggedIn() && isAdminUser()){  
                                if(isset($_GET['p_id'])){
                                    
                                    $post_id= $_GET['p_id'];
                                    echo "<a class='btn btn-primary' href=admin/posts.php?source=edit_posts&p_id=$post_id>Edit Post</a>";
                                }                               
                            }
                                
                            
                        ?>
                    </li>

                    <!-- Link for registration -->
                    <?php if(isLoggedOut()){echo "<li class='$registration_class'><a href=registration.php>Registration</a></li>";} ?>

                    <!-- Link for contact -->
                    <li class="<?php echo $contact_class;?>" ><a href="contact.php">Contact</a></li>
                                                    
                    <!-- Link for login -->
                    <?php if(isLoggedOut()){echo "<li class='$login_class'><a href=login.php>Login</a></li>";} ?>
                                                                 

                </ul>
                
               
                <!-- Logout Nav bar when user logged in -->
                <?php if(isLoggedIn()): ?>
                <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'];  ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!-- <li>
                                    <a href="admin/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                                </li> -->

                                <!-- Inbox for emails - not required -->
                                <!-- <li>
                                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                                </li> -->

                                <!-- Settings - not required -->
                                <!-- <li>
                                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                                </li> -->


                                <!-- <li class="divider"></li> -->
                                <li>
                                    <a class="btn btn-primary btn-lg active" href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>

                </ul>
                <?php endif; ?>

            </div>
            <!-- /.navbar-collapse -->
            

        </div>
        <!-- /.container -->
    </nav>