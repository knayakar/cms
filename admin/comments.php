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
                            <small>Comments Section</small>
                        </h1>
                         
                    </div>
                    
                </div>
                <!-- /.row -->
             
             <table class="table table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Author</th>
                          <th scope="col">Comment</th>
                          <th scope="col">Email</th>
                          <th scope="col">Status</th>
                          <th scope="col">In response to</th>
                          <th scope="col">Date</th>
                          <th scope="col">Approve</th>
                          <th scope="col">Unapprove</th>
                          <th scope="col">Delete</th> 
                        </tr>
                      </thead>
                      <tbody>
                      
<?php   // Collect all contents in comments table from DB
    
    $comment_retrieval_query = "SELECT * FROM comments";
    $query_result = mysqli_query($connection, $comment_retrieval_query);

//    checkResult($query_result);

    while($row = mysqli_fetch_assoc($query_result)) {
        
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        
        
        $post_title_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $query_result2 = mysqli_query($connection, $post_title_query);
        
        while($row = mysqli_fetch_assoc($query_result2)) {
        
            $comment_post_title = $row['post_title'];
        
?>


                      
                      <tr>
                          <td><?php echo $comment_id; ?></td>
                          <td><?php echo $comment_author; ?></td>
                          <td><?php echo $comment_content; ?></td>
                          <td><?php echo $comment_email; ?></td>
                          <td><?php echo $comment_status; ?></td>
                          <td><a href="../post.php?post_id=<?php echo $comment_post_id; ?>"><?php echo $comment_post_title; ?></a></td>
                          <td><?php echo $comment_date; ?></td>
                          <td><a href="comments.php?approve=<?php echo $comment_id; ?>">Approve</a></td>
                          <td><a href="comments.php?unapprove=<?php echo $comment_id; ?>">Unapprove</a></td>
                          <td><a href="comments.php?delete=<?php echo $comment_id ?>">Delete</a></td>
                      </tr>
                      
<?php
        }
    }   

    // Delete a selected comment


    if(isset($_GET['delete'])) {
        
        $comment_id = $_GET['delete'];
        
        $delete_comment = "DELETE FROM comments WHERE comment_id = $comment_id";
        $query_result = mysqli_query($connection, $delete_comment);

//        checkResult($query_result);

        header("Location: comments.php");
        
    }

    // Approve a comment
    
    if(isset($_GET['approve'])) {
        
        $comment_id = $_GET['approve'];
        
        $approve_comment_query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
        
        $query_result = mysqli_query($connection, $approve_comment_query);
        
        header("Location: comments.php");
        
//        chechResult($query_result);
        
    }

    // Unapprove a comment

    if(isset($_GET['unapprove'])) {
        
        $comment_id = $_GET['unapprove'];
        
        $approve_comment_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
        
        $query_result = mysqli_query($connection, $approve_comment_query);
        
        header("Location: comments.php");
        
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