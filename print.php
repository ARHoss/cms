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


?>
