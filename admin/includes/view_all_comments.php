<table class = "table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
        </tr>
    </thead>

    <tbody>

        <!-- Show All Posts Query -->
        <?php   
        
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_comments)){
                
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                
        
                echo "<tr>";
                
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";
                
                // Populating category title from category table
                $query = "SELECT * FROM posts WHERE post_id={$comment_post_id }";
                $select_posts = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_posts)){
                    $post_title = $row['post_title'];
                echo "<td>{$post_title}</td>";
                }

                echo "<td>{$comment_date}</td>";
                
                // Approve and Unapprove
                echo "<td><a href=comments.php?source=edit_comments&c_id=$comment_id>Approve</a></td>";
                echo "<td><a href=comments.php?source=edit_comments&c_id=$comment_id>Unapprove</a></td>";
                
                //Edit post link
                echo "<td><a href=comments.php?source=edit_comments&c_id=$comment_id>Edit</a></td>";

                //Delete post link
                echo "<td><a href=comments.php?delete=$comment_id>Delete</a></td>";

                                                                        
                echo "</tr>";
            }
        
        ?>

    </tbody>

</table>

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
