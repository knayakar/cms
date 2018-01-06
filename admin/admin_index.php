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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                         
                    </div>
                    
                </div>
                
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
<?php 

    $post_count_query = "SELECT * FROM posts";
    $query_result = mysqli_query($connection, $post_count_query);

    $post_counts = mysqli_num_rows($query_result);

?>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'><?php echo $post_counts; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="view_all_posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
<?php

    $comment_count_query = "SELECT * FROM comments";
    $query_result = mysqli_query($connection, $comment_count_query);

    $comment_counts = mysqli_num_rows($query_result);

?>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'><?php echo $comment_counts; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
<?php 

    $user_count_query = "SELECT * FROM users";
    $query_result = mysqli_query($connection, $user_count_query);

    $user_counts = mysqli_num_rows($query_result);

?>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_counts; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="view_all_users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
<?php 

    $category_count_query = "SELECT * FROM categories";
    $query_result = mysqli_query($connection, $category_count_query);

    $category_counts = mysqli_num_rows($query_result);

?>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $category_counts; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- /.row -->
                
<?php
    
    // To get remaining posts count
    
    $remaining_post_count_query = "SELECT * FROM posts WHERE post_status = 'Drafts'";
    $query_result = mysqli_query($connection, $remaining_post_count_query); 
                
    $remaining_post_counts = mysqli_num_rows($query_result);            
                
    // To get remaining comments count
    
    $remaining_comment_count_query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $query_result = mysqli_query($connection, $remaining_comment_count_query); 
                
    $remaining_comment_counts = mysqli_num_rows($query_result);
                
    // To get subscribers count
                
    $subscriber_count_query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
    $query_result = mysqli_query($connection, $subscriber_count_query);

    $remaining_user_counts = mysqli_num_rows($query_result);
                
    // To get empty categories count            
                
    $select_categories_query = "SELECT * FROM categories";
    $query1_result = mysqli_query($connection, $select_categories_query);
    
    $remaining_category_counts = 0;            
                
    while($row = mysqli_fetch_assoc($query1_result)) {
    
        $post_category_title = $row['cat_title'];
        
        $check_post_category = "SELECT * FROM posts WHERE post_category_title = '$post_category_title'";
        $query2_result = mysqli_query($connection, $check_post_category);
        
        $count = mysqli_num_rows($query2_result);
        
        if($count == 0)
            $remaining_category_counts = $remaining_category_counts + 1;
        
    }
?>
                
<!--                Javascript Code for Chart-->
                
                <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Moderation', 'Total', 'Pending'],
                            
                          ['Posts', <?php echo $post_counts; ?>, <?php echo $remaining_post_counts; ?>],
                            
                          ['Comments', <?php echo $comment_counts; ?>, <?php echo $remaining_comment_counts; ?>],
                            
                          ['Users', <?php echo $user_counts; ?>, <?php echo $remaining_user_counts; ?>],
                            
                          ['Categories', <?php echo $category_counts; ?>, <?php echo $remaining_category_counts; ?>]
                        ]);

                        var options = {};

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                </script>

                <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>