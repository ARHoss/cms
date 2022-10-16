<?php 


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
