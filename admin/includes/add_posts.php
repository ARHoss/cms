

<?php 

    if(isset($_POST['create_post'])){
        
        // Retrieving Values from form
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_comment_count = 0;
        $post_date = date('d-m-y');

        // Function for images
        // if it does not work provide permsission to the folder to everyone
        move_uploaded_file($post_image_temp, "../images/$post_image");


        // insert values
        $query = "INSERT INTO posts(post_category_id, post_title, 
        post_author, post_date, post_image, post_content, post_tags, 
        post_comment_count, post_status) ";
        
        // use '' for strings
        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}',now(), '{$post_image}',
         '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' ) ";

        $create_post_query = mysqli_query($connection, $query);

        // Pull the last created id
        $the_post_id = mysqli_insert_id($connection);

        // Checking query 
        // confirmQuery($create_post_query);

        // Provides message after adding post
        // class bg success gives color to the notification
        echo "<p class='bg-success'>Post Successfully Added: "." "."<a href=../post.php?p_id=$the_post_id>View Post</a> or <a href='posts.php'>View All Posts</a></p>";

        
    }




?>




<!-- enctype is resposible for sending different form data -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <!-- Populate category select field-->
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

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="post_status">

            <option value="published">Published</option>
            <option value="draft">Draft</option>
        
        </select>
   </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <!-- Adding summernote id -->
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>

</form>