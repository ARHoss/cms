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
                            All Posts
                            <small>All Users</small>
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

                            case '34';;
                            echo "Nice 34";
                            break;

                            case '100';
                            echo "Nice 100";
                            break;

                            case '21';;
                            echo "Nice 21";
                            break;

                            default:

                            // View All Posts
                            include "includes/view_all_posts.php";

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
