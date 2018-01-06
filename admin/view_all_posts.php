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
                            <small>View all posts section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Title</th>
                          <th scope="col">Author</th>
                          <th scope="col">Category</th>
                          <th scope="col">Image</th>
                          <th scope="col">Content</th>
                          <th scope="col">Tags</th>
                          <th scope="col">Comments</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      
<?php  // Display the post table from DB
    
    $view_all_posts = "SELECT * FROM posts";
    $query_result = mysqli_query($connection, $view_all_posts);

    checkResult($query_result);

    while($row = mysqli_fetch_assoc($query_result)) {
        
        $post_id = $row['post_id'];
        $post_category_title = $row['post_category_title'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
      
        
?>


                      
                      <tr>
                          <td><?php echo $post_id; ?></td>
                          <td><?php echo $post_title; ?></td>
                          <td><?php echo $post_author; ?></td>
                          <td><?php echo $post_category_title; ?></td>
                          <td><img src="../images/<?php echo $post_image; ?>" alt="image" width="100" height="50"></td>
                          <td><?php echo $post_content; ?></td>
                          <td><?php echo $post_tags; ?></td>
                          <td><?php echo $post_comment_count; ?></td>
                          <td><?php echo $post_status; ?></td>
                          <td><a href="view_all_posts.php?change_status=<?php echo $post_id ?>">Change Status</a></td>
                          <td><a href="edit_post.php?source=<?php echo $post_id; ?>&post_category_title=<?php echo $post_category_title ?>">Edit</a></td>
                          <td><a href="view_all_posts.php?delete=<?php echo $post_id ?>">Delete</a></td>
                      </tr>
                      
<?php
        
    }   

    // Delete a selected post


    if(isset($_GET['delete'])) {
        
        $post_id = $_GET['delete'];
        
        $delete_post = "DELETE FROM posts WHERE post_id = '$post_id'";
        $query_result = mysqli_query($connection, $delete_post);

        checkResult($query_result);

        header("Location: view_all_posts.php");
        
    }

    // Change post status

    if(isset($_GET['change_status'])) {
        
        $change_status = $_GET['change_status'];
        
        $retrieve_post_status = "SELECT * FROM posts WHERE post_id = $change_status";
        $query_result = mysqli_query($connection, $retrieve_post_status);
        
            $row = mysqli_fetch_assoc($query_result);
        
        if($row['post_status'] === 'Drafts') {
            
            $change_post_status = "UPDATE posts SET post_status = 'Published' WHERE post_id = $change_status";
            $query_result = mysqli_query($connection, $change_post_status);
            
        }else {
            
            $change_post_status = "UPDATE posts SET post_status = 'Drafts' WHERE post_id = $change_status";
            $query_result = mysqli_query($connection, $change_post_status);
            
        }
        
        header("Location: view_all_posts.php");
        
//        chechResult($query_result);
        
    }



?>
                                      
                      </tbody>
                </table> 
               
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>