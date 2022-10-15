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

                        <!-- Add data to database from Form -->
                        <div class="col-xs-6">

                        <?php   
                        
                        
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
                            }
                        }
                        
                        
                        
                        ?>
                        



                            
                            <form action="categories.php" method="post">

                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>

                            </form>

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
                                    <!-- DB Query -->
                                    <?php   
                
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];

                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "</tr>";
                                        }
                                            
                                    ?>
                                    <!-- DB Query ends--> 
                                </tbody>
                                
                            </table>
                        </div>







                        <!-- Content ends-->


                        
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
