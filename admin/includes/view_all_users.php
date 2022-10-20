<table class = "table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>User Role</th>
            <th>Date Created</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

        <!-- Show All users Query -->
        <?php   
        
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_users)){
                
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_date_created = $row['user_date_created'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                
        
                echo "<tr>";
                
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                // Showing image    
                echo "<td><img width='100' height='50' src='../images/$user_image' alt='image' ></td>"; 
                echo "<td>{$user_role}</td>";
                echo "<td>{$user_date_created}</td>";
                
                // Approve and Unapprove
                echo "<td><a href=users.php?approve_user=$user_id>Approve</a></td>";
                echo "<td><a href=users.php?unapprove_user=$user_id>Unapprove</a></td>";

                //Delete post link
                echo "<td><a href=users.php?delete_user=$user_id>Delete</a></td>";

                                                                        
                echo "</tr>";
            }
        
        ?>

    </tbody>

</table>

<!-- Delete User Query -->
<?php 

    if(isset($_GET['delete_user'])){


        // Retreiving data from post
        $the_user_id = $_GET['delete_user'];
        

        $query = "DELETE FROM users ";
        $query .= "WHERE user_id = $the_user_id";

        $delete_user_query = mysqli_query($connection, $query);

        // Refresh page
        header("Location: users.php");
        
}


?>
<!-- Deelete Query Ends-->



<?php 

// Unapprove query 
if(isset($_GET['unapprove_user'])){


    // Retreiving data from post
    $the_user_id = $_GET['unapprove_user'];

    $query = "UPDATE users SET comment_status ='unapproved' ";
    $query .= "WHERE comment_id = $the_user_id";

    $unapprove_comment_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: users.php");
    
}

// approve query 
if(isset($_GET['approve'])){


    // Retreiving data from post
    $the_user_id = $_GET['approve_user'];

    $query = "UPDATE users SET comment_status ='approved' ";
    $query .= "WHERE comment_id = $the_user_id";

    $approve_comment_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: users.php");
    
}

?>

