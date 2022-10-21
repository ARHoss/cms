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
                            <!-- Reading session variable -->
                            <small><?php echo $_SESSION['firstname'];  ?></small>
                        </h1>
                        
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

                       
                <!-- /.row -->
                <!-- Widget -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- Font awesome library -->
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- Dynamic data -->
                                <?php 
                                
                                $query = "SELECT * FROM posts";
                                $post_counts_query = mysqli_query($connection, $query);
                                $post_counts = mysqli_num_rows($post_counts_query);

                                echo "<div class='huge'>{$post_counts}</div>"
                                ?> 
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- Font awesome library -->
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- Dynamic data -->
                                        <?php 
                                
                                        $query = "SELECT * FROM comments";
                                        $comment_counts_query = mysqli_query($connection, $query);
                                        $comment_counts = mysqli_num_rows($comment_counts_query);

                                        echo "<div class='huge'>{$comment_counts}</div>"
                                        ?> 
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- Font awesome library -->
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- Dynamic data -->
                                        <?php 
                                
                                        $query = "SELECT * FROM users";
                                        $user_counts_query = mysqli_query($connection, $query);
                                        $user_counts = mysqli_num_rows($user_counts_query);

                                        echo "<div class='huge'>{$user_counts}</div>"
                                        ?> 
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- Font awesome library -->
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- Dynamic data -->
                                        <?php 
                                
                                        $query = "SELECT * FROM categories";
                                        $category_counts_query = mysqli_query($connection, $query);
                                        $category_counts = mysqli_num_rows($category_counts_query);

                                        echo "<div class='huge'>{$category_counts}</div>"
                                        ?>  
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Google charts -->

                <div class="row">
                    
                    <!-- JavaScript Code for google charts -->
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                            <?php




                            ?>




                        ['Posts', 1000]
                        ]);

                        var options = {
                        chart: {
                            title: 'CMS',
                            subtitle: 'Site Chart',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>

                    <!-- HTML Code for google charts -->
                    <!-- auto fits the chart width into the browser page -->
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>


                </div>


                <!-- Google charts ends-->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!--Footer -->
<?php include "includes/admin_footer.php";?>
