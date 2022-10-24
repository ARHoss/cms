<?php 

    if(isset($_POST['update_post'])){
            
        // Retrieving Values from form
        $the_post_id = $_GET['p_id'];
        // echo $the_post_id;
        $post_title = $_POST['post_title'];
        // echo $post_category_id;
        
        $post_category_id = $_POST['post_category_id'];
        // echo $post_category_id;
        
        $post_author = $_POST['post_author'];
        // echo $post_author;

        $post_status = $_POST['post_status'];
        // echo $post_status;
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_comment_count = 4;
        $post_date = date('d-m-y');

        // Function for images
        // if it does not work provide permsission to the folder to everyone
        // Image is transferred from $post_image_temp to $post_image
        move_uploaded_file($post_image_temp, "../images/$post_image");
        

        // Re-populating the post_image when an empty image form submitted
        if(empty($post_image)){


        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $image_query = mysqli_query($connection, $query);
        

            while($row = mysqli_fetch_assoc($image_query)){
                
            
                $post_image = $row['post_image'];


            }
        }

        $query = "UPDATE posts SET post_category_id=$post_category_id, post_title='$post_title', 
        post_author='$post_author', post_date=now(), post_image='$post_image', post_content='$post_content', post_tags='$post_tags', 
        post_comment_count=$post_comment_count, post_status='$post_status' ";
        $query .= "WHERE post_id = $the_post_id";

        $create_update_query = mysqli_query($connection, $query);
        

        // Refreshes the page after deleteion
        // header("Location: posts.php");
        



        // Checking query 
        // confirmQuery($create_update_query);

        // Provides message after updating post
        // class bg success gives color to the notification
        echo "<p class='bg-success'>Post Updated: "." "."<a href=../post.php?p_id=$the_post_id>View Post</a> or <a href='posts.php'>View All Posts</a></p>";

        
    }



?>


<!-- enctype is resposible for sending different form data -->
<form action="" method="post" enctype="multipart/form-data">

    <?php 

    $the_post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $edit_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($edit_query)){
            
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];

            
    ?>
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value=<?php if(isset($post_title)){echo $post_title;} ?> type="text" class="form-control" name="post_title">
    </div>

    <!-- Populate select field-->
    <div class="form-group">
            <label for="category_title">Category</label>
            <select name="post_category_id" id="post_category_id">

            <?php 
            
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_categories)){
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

            ?>

                <option value=<?php if(isset($cat_id)){echo $cat_id;} ?>><?php echo $cat_title;?></option>
            
            <?php }  ?>
            
            </select>

    </div>
    <!-- Populate select field Ends-->

    <!-- Populate author select field-->
   <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author" id="post_author">

        <option value=<?php if(isset($post_author)){echo $post_author;} ?>><?php echo $post_author;?></option>
        <?php 
        
        $query = "SELECT user_firstname FROM users";
        $select_authors = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_authors)){
            
            $db_post_author = $row['user_firstname'];


            if(isset($post_author) && $post_author !== $db_post_author){
                
                echo "<option value=$db_post_author>$db_post_author</option>";

            }
        
        }  
        
        
        ?>
        
        </select>

   </div>

    

    <!-- Pupalting post status -->
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">

            <?php 
                if($post_status == "published"){
                    echo "<option value='published' selected='selected'>Published</option>";
                    echo "<option value='draft'>Draft</option>";
                    
                }else{
                    echo "<option value='published'>Published</option>";
                    echo "<option value='draft' selected='selected'>Draft</option>";

                }
            
            ?>
             
        </select>
   </div>



    <div class="form-group">
            <img width="100" src="../images/<?php echo $post_image;?>" alt="image">
            <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value=<?php if(isset($post_tags)){echo $post_tags;} ?> type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <!-- added WYSIWYG Editor Summernote -->
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php if(isset($post_content)){echo $post_content;} ?></textarea>
    </div>

    <?php }  ?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>  
    
</form>



