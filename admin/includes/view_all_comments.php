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
            <th>Delete</th>
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
                
                // Populating post title and link to post title from posts table in post.php
                $query = "SELECT * FROM posts WHERE post_id={$comment_post_id }";
                $select_posts = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_posts)){
                    $post_title = $row['post_title'];
                    $post_id = $row['post_id'];
                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";

                }

                echo "<td>{$comment_date}</td>";
                
                // Approve and Unapprove
                echo "<td><a href=comments.php?approve=$comment_id>Approve</a></td>";
                echo "<td><a href=comments.php?unapprove=$comment_id>Unapprove</a></td>";

                //Delete post link
                echo "<td><a href=comments.php?delete_comment=$comment_id>Delete</a></td>";

                                                                        
                echo "</tr>";
            }
        
        ?>

    </tbody>

</table>

<!-- Deelete Comment Query -->
<?php 

    if(isset($_GET['delete_comment'])){


        // Retreiving data from post
        $the_comment_id = $_GET['delete_comment'];

        $query = "DELETE FROM comments ";
        $query .= "WHERE comment_id = $the_comment_id";

        $delete_comment_query = mysqli_query($connection, $query);

        // Refresh page
        header("Location: comments.php");
        
}


?>
<!-- Deelete Query Ends-->



<?php 

// Unapprove query 
if(isset($_GET['unapprove'])){


    // Retreiving data from post
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status ='unapproved' ";
    $query .= "WHERE comment_id = $the_comment_id";

    $unapprove_comment_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: comments.php");
    
}

// approve query 
if(isset($_GET['approve'])){


    // Retreiving data from post
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status ='approved' ";
    $query .= "WHERE comment_id = $the_comment_id";

    $approve_comment_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: comments.php");
    
}

?>

