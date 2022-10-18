                <!-- Blog Comments -->

                
                <!-- Add Comment -->
                <?php 
                
                if(isset($_POST['create_comment'])){

                    $the_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    // insert values
                    $query = "INSERT INTO comments(comment_post_id, comment_author, 
                    comment_email, comment_content, comment_status, comment_date) ";

                    // use '' for strings
                    $query .= "VALUES ({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}',
                    'unapproved',now()) ";

                    $create_comment_query = mysqli_query($connection, $query);

                    // Increasing post_comment_count
                    $increase_comment_query ="UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                    $increase_post_comment_count_query = mysqli_query($connection, $increase_comment_query);

                    // Refresh page
                    header("Location: post.php?p_id=$the_post_id");

                }
                
                  
                ?>
                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <!-- Show all comment -->
                <?php 
                
                
            
                if(isset($_GET['p_id'])){
                    
                    $the_post_id = $_GET['p_id'];

                }


                $query = "SELECT * FROM comments WHERE comment_post_id=$the_post_id ";
                $query .="AND comment_status='approved' ";
                $query .="ORDER BY comment_date DESC ";
                $select_all_comments_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_comments_query)){
                    
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date']; 
                
                ?>


                <!-- Show all comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;  ?>
                        
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content;?>
                            
                    </div>
                </div>
                

                <?php }  ?>
                

                <!-- Comment + Nested comment not required -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
                        <!-- Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div> -->
                        <!-- End Nested Comment -->
                    <!-- </div>
                </div> -->