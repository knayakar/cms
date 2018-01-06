<?php include "includes/db.php" ?>
 

<!DOCTYPE html>
<html lang="en">


<?php include "includes/header.php" ?>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

 <!-- Page Content -->
    <div class="container">

        <div class="row">    

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
<?php  // Display the complete post
    
    if(isset($_GET['post_id'])) {
        
        $post_id = $_GET['post_id'];

        $query = "SELECT * FROM posts WHERE post_id = $post_id"; 

        $result_fetched = mysqli_query($connection, $query);

        if(!$result_fetched) {
                die("Query failed. " . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($result_fetched)) {

            $post_title= $row['post_title'];
            $post_author= $row['post_author'];
            $post_date= $row['post_date'];
            $post_image= $row['post_image'];
            $post_content= $row['post_content'];

?>
                
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Posts -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="image is not loading">
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <hr>
                
                
<?php 

        }
    }

?>
            
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment" required></textarea>
                        </div>
                        <div class="form-group">
                            <h4>Author</h4>
                            <input type="text" class="form-control" name="author" required>
                        </div>
                        <div class="form-group">
                            <h4>Email</h4>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
<?php   // Submit a comment

    if(isset($_POST['submit'])) {
        
        $comment_content = $_POST['comment'];
        $comment_author = $_POST['author'];
        $comment_email = $_POST['email'];
        $comment_post_id = $_GET['post_id'];
        
        $insert_comment_query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_date, comment_status) VALUES($comment_post_id, '$comment_author', '$comment_email', '$comment_content', now(), 'approved')";
        
        $query_result = mysqli_query($connection, $insert_comment_query);
        
        if(!$query_result) {
            die("Query failed. " . mysqli_error($connection));
        }else {
            
            // Increment comments count of the selected post
            
            $retrive_post_comment_count = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id";
            
            $query_result = mysqli_query($connection, $retrive_post_comment_count);
            
            $post_comment_count = mysqli_num_rows($query_result);
            
            $increment_post_comment_count = "UPDATE posts SET post_comment_count = $post_comment_count WHERE post_id = $comment_post_id";  
            
            $query_result = mysqli_query($connection, $increment_post_comment_count);  
        }
    }
?>
                <hr>

                <!-- Posted Comments -->

               
               
<?php  // Display all comments of that post
  
    if(isset($_GET['post_id'])) {
                
        $comment_post_id = $_GET['post_id'];            

        $retrieve_comments = "SELECT * FROM comments WHERE comment_status = 'approved' AND comment_post_id = $comment_post_id ORDER BY comment_id DESC";
        $query_result = mysqli_query($connection, $retrieve_comments);

        if(mysqli_num_rows($query_result) == 0) {
            echo "<h3 class= 'text-center'>Be the first to comment on this post!</h3>";
        }

        while($row = mysqli_fetch_assoc($query_result)) {

            $comment_author = $row['comment_author'];
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];

?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
<?php
        }
    }
?>
                <!-- Comment -->
   <!--             <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                -->        <!-- Nested Comment -->
    <!--                    <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
          -->              <!-- End Nested Comment -->
    <!--                </div>
                </div>
-->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
