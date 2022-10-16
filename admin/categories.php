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
                            <small>Author Name</small>
                        </h1>

                        
                        <!-- Content -->
                        <!-- Add & update data to database from Form -->
                        <div class="col-xs-6">

                        <?php   
                        
                        // Adds data from add category
                        if(isset($_POST['submit'])){
                        
                            // Retreiving data from post
                            $cat_title = $_POST['cat_title'];
                    


                            if($cat_title == "" || empty($cat_title)){

                                echo "This Field should not be empty";

                            }else{
                                // Sanitize data
                                $cat_title= mysqli_real_escape_string($connection, $cat_title);                           
                    
                                    // insert values
                                    $query = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUES ('$cat_title')";
                        
                                $create_category_query = mysqli_query($connection, $query);
                                if(!$create_category_query){
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }else{
                                    echo "record updated";
                                }

                                // Refreshes the page after deleteion - fixes the issue for posting after refresh
                                header("Location: categories.php");

                            }
                        }
                        
                        
                        
                        ?>
                            <!-- Adds data form -->
                            <form action="categories.php" method="post">

                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>

                            </form>

                            <!-- Update data form -->
                            <?php 
                            
                            if(isset($_GET['edit'])){

                                               

                                include "includes/update_categories.php";  

                            }
                            
                            
                            
                            ?>
                            

                        </div>

                        <!-- Add data to database from Form ends-->

                        <!-- Reading data to table -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                
    
                                <tbody>                                    
                                    <!-- DB Query to read All data to table-->
                                    <?php   
                
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];

                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";

                                            // Delete - Passing commant to GET - array returned - ([delete]=>$cat_id) 
                                            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";

                                            // Edit - Passing commant to GET - array returned - ([delete]=>$cat_id) 
                                            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                            
                                            echo "</tr>";
                                        }
                                            
                                    ?>
                                    <!-- DB Query ends--> 
                                </tbody>

                                <!-- DB Query to Delete Data -->
                                <?php 
                                
                                // _Get looking for 'delete' key
                                if(isset($_GET['delete'])){

    
                            
                                    // Retreiving data from post
                                    $the_cat_id = $_GET['delete'];
                                    
                            
                            
                                    $query = "DELETE FROM categories ";
                                    $query .= "WHERE cat_id = {$the_cat_id} ";
                                    $delete_query = mysqli_query($connection, $query);
                                    
                                    // Checks if the query fails - not printing if works - need to fix
                                    // if(!$deletes_query){
                                    //     die("QUERY FAILED" . mysqli_error($connection));
                                    // }else{
                                    //     echo "<font color='blue'>".$myvariable."</font>";
                                    // }
                                    
                                    // Refreshes the page after deleteion
                                    header("Location: categories.php");
                                    
      
                                }
                                
                                ?>
                                <!-- DB Query to Delete Data ends-->
                                
                                
                            </table>
                        </div>
                        <!-- Content ends-->


                        <!-- Not required -->
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!--Footer -->
<?php include "includes/admin_footer.php";?>
