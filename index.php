<?php include "includes/db.php";?>
<?php include "includes/header.php";?>


    <!-- Navigation -->
    <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                    <h1 class="page-header">
                        CMS
                        <small>Welcome</small>
                    </h1>

                <!-- Main content of the cms -->
                <?php
                
                // <!-------------------- Pagination -----------------> 
                // Getting noumber of posts
                $count_query = "SELECT * FROM posts";
                $post_count_query = mysqli_query($connection, $count_query);
                $post_count = mysqli_num_rows($post_count_query);

                // Calculation to show number of posts
                $post_count = $post_count/5;
                $post_count = ceil($post_count);
                

                // Getting page number
                if(isset($_GET['page'])){

                    $page = $_GET['page'];

                    
                }else{
                    $page = "";
                }

                if($page == "" || $page == 1){
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * 5) - 5;
                }
                
                
                
                // after WHERE we can put LIMIT 3 or LIMIT 0,10 so that only required posts are posted
                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT $page_1,5";
                $select_all_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author= $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_status = $row['post_status'];
                    // Shortens the content to 0 to 100 characters
                    $post_content = substr($row['post_content'], 0, 100);
                    

                ?>



                    <!-- First Blog Post -->
                    <h2>
                        <!-- Sending post_id to post.php -->
                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_id;?></a>
                    
                    </h2>
                    <p class="lead">
                        by <a href="author.php?post_author=<?php echo $post_author;?>"><?php echo $post_author;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                    <hr>
                    
                    <!-- Sending post_id to post.php -->
                    <a href="post.php?p_id=<?php echo $post_id;?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                    
                    <hr>
                    <p><?php echo $post_content;?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                <?php  
                    }

                    // Erorr code if not post
                    if(!isset($post_status)){

                        echo "<h1 class='test-center' >SORRY NO POST TO SHOW</h1>";
                        
                    }
                
                
                ?>
            

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>
        
        <!-------------------- Pagination ----------------->
        <ul class="pager">

            <?php 
            
            for ($i=1; $i <= $post_count; $i++) { 
                
                echo "<li><a href='index.php?page=$i'>$i</a></li>";

            }
                    
            ?>
            


        </ul>

        <?php include "includes/footer.php";?>