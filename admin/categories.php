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
                        
                        <!-- Content -->
                        
                        <!-- Add & update data to database from Form -->
                        <div class="col-xs-6">

                        <!-- Adds data form -->
                        <?php  insertCategories(); ?>
                            
                            
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
                                    <?php  findAllCategories();  ?>
                                    <!-- DB Query ends--> 
                                </tbody>

                                <!-- DB Query to Delete Data -->
                                <?php deleteCategories(); ?>
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
