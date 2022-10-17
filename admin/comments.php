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
                            Welcome to admin
                            <small>Author</small>
                    </h1>



                    <!-- Main Content -->
                    
                    <!-- View All Posts -->
                    <?php 
                    
                        if(isset($_GET['source'])){

                            $source = $_GET['source'];
                            
                        }else{
                            $source='';
                        }

                        
                        switch($source){

                            // Add Posts
                            case 'add_posts';;
                            include "includes/add_posts.php";
                            break;

                            case 'edit_posts';
                            include "includes/edit_posts.php";
                            break;

                            case '21';;
                            echo "Nice 21";
                            break;

                            // View All Posts
                            default:
                            include "includes/view_all_comments.php";
                            break;



                        }
                     
                    
                    ?>
                    <!-- View All Posts ends-->

                    

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
