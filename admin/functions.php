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




?>
