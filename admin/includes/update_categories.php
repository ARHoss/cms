<?php include "print.php";  ?>

<form action="categories.php" method="post">

<div class="form-group">
    <label for="cat_title">Edit Category</label>

    <!-- Query to populate the edit category form placeholder -->
    <?php 
    
    
            // Retreiving data from post
            $cat_id = $_GET['edit'];
            
            
            
            $select_categories_id = "SELECT * FROM categories WHERE cat_id= $cat_id";
            $select_categories = mysqli_query($connection, $select_categories_id);

            while($row = mysqli_fetch_assoc($select_categories)){
            
            $cat_title = $row['cat_title'];



            
    ?>                                           
        <!-- The inpute where the vaulue needs to be passed -->
        <input value=<?php if(isset($cat_title)){echo $cat_title;} ?> class="form-control" type="text" name="cat_title">
        
        
    <?php 

            }
    

    
    ?>
    <!-- Query to populate the edit category form placeholder -ends -->

    <!-- Queryt to update category title -->

    <?php 
    
    // Updates data
    if(isset($_POST['update_category'])){
    
        // Retreiving data from post
        $the_cat_title = $_POST['cat_title'];
        console_print("I am here");
                                 

                // insert values
                $query = "UPDATE categories SET ";
                $query .= "cat_title = '{$the_cat_title}' ";
                $query .= "WHERE cat_id = {$cat_id} ";
        
                $update_query = mysqli_query($connection, $query);
                if(!$update_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }else{
                    echo "record updated";
                }


    }
           
    ?>
    
    <!-- Queryt to update category title ends-->
    
</div>
<div class="form-group">
    <!-- changed value of submit to create another post object -->
    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
</div>

</form>