<?php 

// DB All Data Query returning number of rows
function recordCount($table){

    global $connection;
    $query = "SELECT * FROM ".$table;
    $result = mysqli_query($connection, $query);
    
    return mysqli_num_rows($result);

}

// DB Where Query returning number of rows
function checkStatus($table, $table_column, $value){

    global $connection;
    $query = "SELECT * FROM $table WHERE $table_column = '$value'";
    $select_all_published_posts_query = mysqli_query($connection, $query);
    return mysqli_num_rows($select_all_published_posts_query);


}

function test(){
    echo "test";
    print_console("test");
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

    function confirmQuery($result){

        // Must for function
        global $connection;

        if(!$result){
            die('Query Failed'.mysqli_error($connection));
        }

    }




}




?>
