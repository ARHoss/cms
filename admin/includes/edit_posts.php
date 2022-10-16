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

    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <input value=<?php if(isset($post_category_id)){echo $post_category_id;} ?> type="text" class="form-control" name="post_category_id">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value=<?php if(isset($post_author)){echo $post_author;} ?> type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value=<?php if(isset($post_status)){echo $post_status;} ?> type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value=<?php if(isset($post_tags)){echo $post_tags;} ?> type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php if(isset($post_content)){echo $post_content;} ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>




    

    <?php }  ?>
    

    
</form>


