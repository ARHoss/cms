

<!-- Creating bulk options container -->
<!-- bulk_post 1 -->
<form action="" method="post">


    <!-- Creating select field -->
    <!-- bulk_post 2 -->
    <!-- using inline style as css sb-admin.css not working -->
    <div class="col-xs-4 bulkOptionsContainer" style="padding: 0px;">
        <!-- Pupalting post status -->
        <select class="form-control" name="bulk_post_status" id="bulk_post_status">

            <option value='' selected='selected'>Select Options</option>
            <option value='published'>Published</option>
            <option value='draft'>Draft</option>
            <option value='delete'>Delete</option>

        </select>

    </div>
    
    <!-- Creating Submit button and link to add post -->
    <div class="col-xs-4">
        <!-- bulk_post 3  -->
        <input class="btn btn-success" type="submit" name="" value="Apply">
        
        <!-- Add post button -->
        <a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>

        
    </div>


    <table class = "table table-bordered table-hover">
        <thead>
            <tr>
                <!-- Check Box -->
                <!-- bulk_post 4 Selects all-->
                <th><input class="allCheckBoxes" type="checkbox"></th>
                
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>

            <!-- Show All Posts Query -->
            <?php   
            
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_posts)){
                    
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

            
                    echo "<tr>";
            ?>
            
            
            <!-- Check Boxes -->
            <!-- bulk_post 5 -->
            <!-- Sends id to the array checkBoxArray[] -->
            <!-- Selects each post one at time -->
            <th><input class="checkBox" type="checkbox" value="<?php echo $post_id; ?>" name="checkBoxArray[]"></th>
            
            
            
            <?php
            
                    echo "<td>{$post_id}</td>";
                    echo "<td>{$post_author}</td>";
                    echo "<td>{$post_title}</td>";


                    // Populating category title from category table
                    $query = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                    $select_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_categories)){
                        $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                    }
                    
                    echo "<td>{$post_status}</td>";
                    // Showing image
                    echo "<td><img width='100' src='../images/$post_image' alt='image' ></td>";
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_date}</td>";

                    //Edit post link
                    echo "<td><a href=posts.php?source=edit_posts&p_id=$post_id>Edit</a></td>";

                    //Delete post link
                    echo "<td><a href=posts.php?delete=$post_id>Delete</a></td>";

                                                                            
                    echo "</tr>";
                }
            
            ?>

        </tbody>

    </table>
</form>


<?php 

    // Check for the checkbox array or error is generated
    if(isset($_POST['checkBoxArray'])){

        $bulk_posts_id = $_POST['checkBoxArray'];
        $bulk_post_status = $_POST['bulk_post_status'];

        // loop
        foreach ($bulk_posts_id as $checkbox_post_id) {
            
            
            switch ($bulk_post_status) {
                case 'published':
                    
                    $query = "UPDATE posts SET post_status='$bulk_post_status' ";
                    $query .= "WHERE post_id = $checkbox_post_id";
                    $bulk_update_status_query = mysqli_query($connection, $query);
                    header("Location: posts.php");
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status='$bulk_post_status' ";
                    $query .= "WHERE post_id = $checkbox_post_id";
                    $bulk_update_status_query = mysqli_query($connection, $query);
                    header("Location: posts.php");
                    break;

                case 'delete':
                    $query = "DELETE FROM posts ";
                    $query .= "WHERE post_id = $checkbox_post_id";
                    $bulk_update_delete_query = mysqli_query($connection, $query);
                    header("Location: posts.php");
                    break;
    
                default:
                    // Prints default message
                    echo "No Options Selected";
                    break;
            }
            
        }





    }



?>




<!-- Deelete Query -->
<?php 

    if(isset($_GET['delete'])){


        // Retreiving data from post
        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts ";
        $query .= "WHERE post_id = $the_post_id";

        $delete_query = mysqli_query($connection, $query);

        // Refresh page
        header("Location: posts.php");
        
}





?>
<!-- Deelete Query Ends-->
