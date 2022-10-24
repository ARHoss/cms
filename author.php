<!-- Search-->

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
             
            <!--Searches for post_author  -->
            <?php 

            if(isset($_GET['post_author'])){
                // post_author variable
                $post_author = $_GET['post_author'];

                // Database query for search
                $query = "SELECT * FROM posts WHERE post_author = '$post_author'";

                $post_author_query = mysqli_query($connection, $query);

                if(!$post_author_query){
                    die("QUERY FAILES".mysqli_error($connection));
                }


            // Searches for post_author ends here

                echo "<p class='lead'>All Post by <a href='author.php?post_author=$post_author;'>$post_author</a></p>";    
                     
                    // Displays the search results same as index .php
                    while($row = mysqli_fetch_assoc($post_author_query)){
                        
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author= $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
    
                    ?>
    

                    <!-- First Blog Post -->
                    <h2>
                        <!-- Sending post_id to post.php -->
                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                    </h2>

                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?></p>
                    <hr>

                    <!-- Sending post_id to post.php -->
                    <a href="post.php?p_id=<?php echo $post_id;?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                    <hr>
                    <p><?php echo $post_content;?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>   
                    <hr>
    
                <?php  
                    // closing bracket for while loop
                    }
                    // closing bracket for else
                }
                // closing bracket for isset
                ?>
                
        <!-- Same as index.php -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php";?>