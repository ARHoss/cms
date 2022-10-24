<?php  include "db.php"; ?>

<?php 


// Prints in Console Port
function console_print($data) {
    
    if (is_array($data)){
    
        $output = implode(',', $data);
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    
    }else{
        echo "<script>console.log('Debug Objects: " . $data . "' );</script>";
    }
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


?>
