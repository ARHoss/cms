<?php 

// DB Query using All Data and returning number of rows
function recordCount($table){

    global $connection;
    $query = "SELECT * FROM ".$table;
    $result = mysqli_query($connection, $query);
    
    return mysqli_num_rows($result);

}

// DB Query using WHERE and returning number of rows
function checkStatus($table, $table_column, $value){

    global $connection;
    $query = "SELECT * FROM $table WHERE $table_column = '$value'";
    $select_all_published_posts_query = mysqli_query($connection, $query);
    return mysqli_num_rows($select_all_published_posts_query);


}



function randSalt(){

    global $connection;

     // Getting randSalt value
     $query = "SELECT randSalt FROM users";
     $select_randSalt_query = mysqli_query($connection, $query);
     if(!$select_randSalt_query){
         die("Query failed" . mysqli_error($connection));
     }

     $row = mysqli_fetch_assoc($select_randSalt_query);
    return $row['randSalt'];

}


// Protects from SQL injection
function escape($string){

    // Must for function
    global $connection;

    // Checking for sql and html injections
    return mysqli_real_escape_string($connection, trim($string));


}

// Prints in Console Port
function print_console($data) {
    
    if (is_array($data)){
        $output = implode(',', $data);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }else{echo "<script>console.log('Debug Objects: " . $data . "' );</script>";}
}


function insertCategories(){

    // Adds data from add category
    if(isset($_POST['submit'])){

        // Must for function
        global $connection;

        // Retreiving data from post
        $cat_title = $_POST['cat_title'];



        if($cat_title == "" || empty($cat_title)){

            echo "This Field should not be empty";

        }else{
            // Sanitize data
            $cat_title= mysqli_real_escape_string($connection, $cat_title);                           

                // insert values
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUES ('$cat_title')";
    
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }else{
                echo "record updated";
            }

            // Refreshes the page after deleteion - fixes the issue for posting after refresh
            header("Location: categories.php");

        }
    }
}

function findAllCategories(){

    // Must for function
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";

        // Delete - Passing commant to GET - array returned - ([delete]=>$cat_id) 
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";

        // Edit - Passing commant to GET - array returned - ([delete]=>$cat_id) 
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        
        echo "</tr>";
    }

}

function deleteCategories(){
    
    // Must for function
    global $connection;

    // _GET looking for delete key
    if(isset($_GET['delete'])){

        
                            
        // Retreiving data from post
        $the_cat_id = $_GET['delete'];
        


        $query = "DELETE FROM categories ";
        $query .= "WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        
        // Checks if the query fails - not printing if works - need to fix
        // if(!$deletes_query){
        //     die("QUERY FAILED" . mysqli_error($connection));
        // }else{
        //     echo "<font color='blue'>".$myvariable."</font>";
        // }
        
        // Refreshes the page after deleteion
        header("Location: categories.php");
        

    }
}

function confirmQuery($result){

    // Must for function
    global $connection;

    if(!$result){
        die('Query Failed'.mysqli_error($connection));
    }

}



// Admin new section

function is_standard($username){

    // Must for function
    global $connection;
    
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $user_role_query = mysqli_query($connection, $query);
    confirmQuery($user_role_query);
    $row = mysqli_fetch_assoc($user_role_query);

    if($row['user_role'] === "standard"){
        return true;
    }else{
        return false;
    }
    
}

function username_exists($username){

    // Must for function
    global $connection;

    $username   = escape($username);

    $query = "SELECT username FROM users WHERE username = '$username' ";
    $username_query = mysqli_query($connection, $query);
    confirmQuery($username_query);
  
    if(mysqli_num_rows($username_query) > 0){
        return true;
    }else{
        return false;
    }

}

function email_exists($user_email){

    // Must for function
    global $connection;

    $user_email = escape($user_email);

    $query = "SELECT user_email FROM users WHERE user_email = '$user_email' ";
    $user_email_query = mysqli_query($connection, $query);
    confirmQuery($user_email_query);
  
    if(mysqli_num_rows($user_email_query) > 0){
        return true;
    }else{
        return false;
    }

}


function redirect($location){

    return header("Location: ".$location);
}


function register_user($username, $user_password, $user_email){
 
    // Must for function
    global $connection;

    //----------------------Encrypting Password---------------------
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10)); 
    //----------------------Encrypting Password---------------------

    // insert values in DB
    $query = "INSERT INTO users(username, user_email, user_password, user_role, user_date_created) ";
    $query .= "VALUES ('{$username}', '{$user_email}', '{$hashed_password}', 'subscriber',now() ) ";
    $add_new_user_query = mysqli_query($connection, $query);
    confirmQuery($add_new_user_query);

}

function send_mail($to, $from, $subject, $email_message){
 
     // Header
     $header = "From: ".$from;


     if($_SERVER['HTTP_HOST'] !== 'localhost'){

         // send email
         mail($to,$subject,$email_message, $header);

     }

}

function login_user($username, $user_password){

    // Must for function
    global $connection;

    // Sanitize data
    $username = escape($username);
    $user_password = escape($user_password);

    // Retrieving information from DB
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_login_query = mysqli_query($connection, $query);

    if(!$select_user_login_query){
        die ("QUERY FAILED".mysqli_error($connection));
    }

    while($row=mysqli_fetch_assoc($select_user_login_query)){

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        
    }

    //--------------dencrypt the password-----------------------------

    // Left is entered password - right password stored in database
    // $user_password = crypt($user_password, $db_user_password);
    //--------------dencrypt the password-----------------------------

    // login check verify function
    // Redirects user to admin or index depending on role
    if(isset($db_user_password) && password_verify($user_password, $db_user_password)){ // if username and password matches
        
         // setting Session variables
         $_SESSION['id'] = $db_user_id;
         $_SESSION['username'] = $db_username;
         $_SESSION['firstname'] = $db_user_firstname;
         $_SESSION['lastname'] = $db_user_lastname;
         $_SESSION['user_role'] = $db_user_role;

        //  Redirects to root and then to the page
         redirect("/cms/index.php");
                   
    }else { // anything else
            //  Redirects to root and then to the page
            redirect("/cms/index.php");
            
        }



}




?>
