<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">


<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <!-- Search Form -->
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
    </form> 
    <!-- /.input-group -->
</div>
<!-- Blog Search Well ends-->


<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">  
        <!-- /.col-lg-6 -->
        <!-- lg-12 expands the display to all the 12 rows -->
        <div class="col-lg-12">
            <ul class="list-unstyled">
                
                <!-- Displaying all the categories in Blog Categories Well -->
                <?php 
                    // Limits search results to 3
                    // $query = "SELECT * FROM categories LIMIT 3";
                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);
            
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='#'>{$cat_title}</a></li>";
                        
                    }
                    
                                
                ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->

    </div>
    <!-- /.row -->
</div>





<!-- Side Widget Well -->
<?php include "widget.php";?>


</div>