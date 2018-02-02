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
                            <small>Edit post section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="" method="post" enctype="multipart/form-data">
                      <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"><strong></strong>Category Id</label><br>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="post_category_title" required>
<?php

    if(isset($_GET['post_category_title'])) {
        
        $get_post_id = $_GET['source'];
        $get_post_category_title = $_GET['post_category_title'];
     
        // to retrieve all the category id for selection in edit page
        
        $retrieve_category_title = "SELECT * FROM categories";
        $retrieval_result = mysqli_query($connection, $retrieve_category_title);

        checkResult($retrieval_result);

        while($row = mysqli_fetch_assoc($retrieval_result)) {

            $cat_title = $row['cat_title'];
            
            if($cat_title == $get_post_category_title) {
                echo "<option selected>$cat_title</option>";    
            }else {
                echo "<option>$cat_title</option>";   
            }
        }

        // to retrieve all the data which was selected for edit
        
        $retrieve_selected_data = "SELECT * FROM posts WHERE post_id = '$get_post_id'";
        $retrieval_result = mysqli_query($connection, $retrieve_selected_data);

        checkResult($retrieval_result);

        while($row = mysqli_fetch_assoc($retrieval_result)) {

            $cat_id = $row['cat_id'];
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
            $post_author = $row['post_author'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_status = $row['post_status'];

?>
                         </select>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post_title ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Author</label>
                        <input type="text" class="form-control" id="post_author" name="post_author" value="<?php echo $post_author ?>" required>
                      </div>
                      <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"><strong></strong>Post Status</label><br>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="post_status" required>
<?php

    if($post_status == 'Published') {
        echo "<option selected>Published</option>";    
        echo "<option>Drafts</option>";    
    }else {
        echo "<option>Published</option>";    
        echo "<option selected>Drafts</option>";
    }
                
?>
                         </select>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label><br>
                        <img src="../images/<?php echo $post_image ?>" alt="image" width="150">
                        <br><br>
                        <input type="file" class="form-control-file" id="post_image" name="post_image" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Tags</label>
                        <input type="text" class="form-control" id="post_tags" name="post_tags" value="<?php echo $post_tags ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Comment Count</label>
                        <input type="text" class="form-control" id="post_comment_count" name="post_comment_count" value="<?php echo $post_comment_count ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Content</label>
                        <textarea class="form-control" id="post_content" name="post_content" rows="15" required><?php echo "$post_content" ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Publish Post</button>
                </form>
                
<?php            
        }   
    }   


    //  Update Post 

    if(isset($_POST['submit'])) {
        
        $get_post_id = $_GET['source'];
        
        $post_category_title = $_POST['post_category_title'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        
        $post_date = date('d-m-y');
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
            move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_comment_count = $_POST['post_comment_count'];
        $post_status = $_POST['post_status'];
        
        
        $edit_post_query = "UPDATE posts SET post_category_title = '$post_category_title', post_title = '$post_title', post_author = '$post_author', post_date = now(), post_image = '$post_image', post_content = '$post_content', post_tags = '$post_tags', post_comment_count = '$post_comment_count', post_status = '$post_status' WHERE post_id = '$get_post_id'";
        
        $query_result = mysqli_query($connection, $edit_post_query);
        
        checkResult($query_result);
        
        $message = "Post Updated Successfully!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        
        header("Location: view_all_posts.php");
    }

?>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>