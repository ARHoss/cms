<!-- Dasboard widget -->
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
                $post_counts = recordCount("posts");
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
                        $comment_counts = recordCount("comments");
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
                        $user_counts = recordCount("users");
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
                        $category_counts = recordCount("categories");
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
<!-- Dasboard widget -ends->

<?php 


// Google Chart Variables
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_posts_query = mysqli_query($connection, $query);
$published_post_counts = mysqli_num_rows($select_all_published_posts_query);

// Draft posts count
$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts_query = mysqli_query($connection, $query);
$draft_post_counts = mysqli_num_rows($select_all_draft_posts_query);
// Unapproved comments count
$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$select_all_unapproved_comments_query = mysqli_query($connection, $query);
$unapproved_comment_counts = mysqli_num_rows($select_all_unapproved_comments_query);
// Subscriber Users
$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$select_all_subscriber_user_query = mysqli_query($connection, $query);
$subscriber_user_counts = mysqli_num_rows($select_all_subscriber_user_query);


?>

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
            

                $element_texts =['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscriber', 'Categories'];
                $element_counts =[$post_counts, $published_post_counts, $draft_post_counts, $comment_counts, $unapproved_comment_counts,$user_counts, $subscriber_user_counts, $category_counts];
                
                for ($i=0; $i < 8; $i++) { 
                # code... - replicating this data below -> 
                // ['Posts', 1000]
                // ['Posts', 1000],
                // ['Posts', 1000],
                // ['Posts', 1000],


                echo "['{$element_texts[$i]}'".","."{$element_counts[$i]}],";
                
                }

            ?>                       
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