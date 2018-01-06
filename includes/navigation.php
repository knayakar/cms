<?php session_start(); ?>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">CMS Home</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            
<?php

    $query = "SELECT * FROM categories";

    $result_fetched = mysqli_query($connection, $query);


    while($row = mysqli_fetch_assoc($result_fetched)) {

        $cat_title = $row['cat_title'];

        echo "<li><a href='nav_section.php?cat_title=$cat_title'>{$cat_title}</a></li>";

    }

?>
            
            
            

                <li>
                    <a href="admin/admin_index.php">Admin</a>
                </li>
<?php

    if(isset($_SESSION['user_role'])) {
        
        $user_role = $_SESSION['user_role'];
        
        if($user_role == 'Subscriber') {
            
            echo "<li><a href='includes/logout.php'>Logout</a></li>";
            
        }
        
    }

?>
                
<!--                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
