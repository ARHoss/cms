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
            <th>Change to Admin</th>
            <th>Change to Subscriber</th>
            <th>Edit</th>
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
                
                //Change Role
                echo "<td><a href=users.php?change_to_admin=$user_id>Admin</a></td>";
                echo "<td><a href=users.php?change_to_sub=$user_id>Subscriber</a></td>";

                //Edit Users
                echo "<td><a href=users.php?source=edit_users&u_id=$user_id>Edit</a></td>";

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

// change_to_admin query 
if(isset($_GET['change_to_admin'])){


    // Retreiving data from post
    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role ='admin' ";
    $query .= "WHERE user_id = $the_user_id";

    $change_to_admin_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: users.php");
    
}

// change_to_subscriber query 
if(isset($_GET['change_to_sub'])){


    // Retreiving data from post
    $the_user_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET user_role ='subscriber' ";
    $query .= "WHERE user_id = $the_user_id";

    $change_to_sub_query = mysqli_query($connection, $query);

    // Refresh page
    header("Location: users.php");
    
}

?>

