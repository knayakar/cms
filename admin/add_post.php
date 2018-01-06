<?php include "includes/admin_header.php" ?>

<body>
    
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/admin_navigation.php" ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">
 
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Add post section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="" method="post" enctype="multipart/form-data">
                      <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"><strong></strong>Category Id</label><br>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="post_category_title" required>
                            <option selected>Choose...</option>
<?php

    $retrieve_category_id = "SELECT * FROM categories";
    $retrieval_result = mysqli_query($connection, $retrieve_category_id);

    checkResult($retrieval_result);

    while($row = mysqli_fetch_assoc($retrieval_result)) {
        
        $cat_title = $row['cat_title'];

        echo "<option>$cat_title</option>";
        
    }

?>
                         </select>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Author</label>
                        <input type="text" class="form-control" id="post_author" name="post_author" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label>
                        <input type="file" class="form-control-file" id="post_image" name="post_image" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Tags</label>
                        <input type="text" class="form-control" id="post_tags" name="post_tags" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea class="form-control" id="post_content" name="post_content" rows="5" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Publish Post</button>
                </form>
<?php

    if(isset($_POST['submit'])) {
        
        $post_category_title = $_POST['post_category_title'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        
        $post_date = date('d-m-y');
        
        $post_image = $_FILES['post_image']['name']  ;
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
            move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        
        
        $add_post_query = "INSERT INTO posts(post_category_title, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        
        $add_post_query .= "VALUE('$post_category_title', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', 0, 'Published')";
        
        $query_result = mysqli_query($connection, $add_post_query);
        
        checkResult($query_result);
        
        $message = "Post Uploaded Successfully!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

?>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>