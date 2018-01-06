<?php


    function checkResult($query_result) {
        global $connection;
        
        if(!$query_result) {
                die("Query failed!". mysqli_error($connection));
        }
        
    }

    function insertContent() {
        global $connection;
        
        if(isset($_POST['submit'])) {
        
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)) {
                echo "Field cannot be empty";
            }

            $add_content_query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";
            $query_result = mysqli_query($connection, $add_content_query);

            checkResult($query_result);
        }
    }

    function loadContent() {
        global $connection;
        
        if(isset($_GET['update'])) {
        
            $cat_id = $_GET['update'];

            $retrieve_update_id_query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $query_result = mysqli_query($connection, $retrieve_update_id_query);

            checkResult($query_result);

            while ($row = mysqli_fetch_assoc($query_result)) {
                $cat_fetched_title = $row['cat_title'];
            }
            
?>
            
            <div class="form-group">    
                <label for="cat-title">Update Category</label>
                <input type="text" class="form-control" name="cat_title" value="<?php echo $cat_fetched_title ?>">
            </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" name="uSubmit" value="Update Category">
            </div> 
<?php          
        updateContent($cat_id);
        }
    }
    

    function updateContent($cat_id) {
        global $connection;
        
        if(isset($_POST['uSubmit'])) {
            $cat_title = $_POST['cat_title'];
            
            $update_table_query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = '$cat_id'";
            $query_result = mysqli_query($connection, $update_table_query);
            
            checkResult($query_result);
        }
    }

    function loadTable() {
        global $connection;
        
        $load_table_contents = "SELECT * FROM categories";                                
        $query_load = mysqli_query($connection, $load_table_contents);

        checkResult($query_load);

        while($row = mysqli_fetch_assoc($query_load)) {               
            $cat_id = $row['cat_id'];
            $cat_title= $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
            echo "</tr>";
        }
    }

    function deleteContent() {
        global $connection;
        
        if(isset($_GET['delete'])) {
            $cat_id = $_GET['delete'];

            $delete_entry = "DELETE FROM categories WHERE cat_id = '$cat_id'";
            $query_result = mysqli_query($connection, $delete_entry);

            checkResult($query_result);

            header("Location: categories.php");
        }
    }


?>