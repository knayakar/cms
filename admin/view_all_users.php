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
                            <small>View all users section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <table class="table table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">User</th>
                          <th scope="col">Email Id</th>
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Role</th>
                          <th scope="col">Change Role</th>
                        </tr>
                      </thead>
                      <tbody>
                      
<?php  // Display the users table from DB
    
    $view_all_users = "SELECT * FROM users";
    $query_result = mysqli_query($connection, $view_all_users);

    checkResult($query_result);

    while($row = mysqli_fetch_assoc($query_result)) {
        
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        
?>


                      
                      <tr>
                          <td><?php echo $user_id; ?></td>
                          <td><img src="../images/<?php echo $user_image; ?>" alt="image" width="64" height="64"><br><?php echo $username; ?></td>
                          <td><?php echo $user_email; ?></td>
                          <td><?php echo $user_firstname; ?></td>
                          <td><?php echo $user_lastname; ?></td>
                          <td><?php echo $user_role; ?></td>
                          <td><a href="view_all_users.php?change_role_id=<?php echo $user_id; ?>">Change</a></td>
                          <td><a href="edit_user.php?user_id=<?php echo $user_id; ?>">Edit</a></td>
                          <td><a href="view_all_users.php?delete=<?php echo $user_id ?>">Delete</a></td>
                      </tr>
                      
<?php
        
    }   

    // Delete a selected post


    if(isset($_GET['delete'])) {
        
        $user_id = $_GET['delete'];
        
        $delete_user = "DELETE FROM users WHERE user_id = $user_id";
        $query_result = mysqli_query($connection, $delete_user);

        checkResult($query_result);

        header("Location: view_all_users.php");
        
    }

    // Change the user role
    
    if(isset($_GET['change_role_id'])) {
        
        $change_role_id = $_GET['change_role_id'];
        
        $retrieve_user_role = "SELECT * FROM users WHERE user_id = $change_role_id";
        $query_result = mysqli_query($connection, $retrieve_user_role);
        
            $row = mysqli_fetch_assoc($query_result);
        
        if($row['user_role'] == 'Subscriber') {
            
            $change_user_role = "UPDATE users SET user_role = 'Admin' WHERE user_id = $change_role_id";
            $query_result = mysqli_query($connection, $change_user_role);
            
        }else {
            
            $change_user_role = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $change_role_id";
            $query_result = mysqli_query($connection, $change_user_role);
            
        }
        
        header("Location: view_all_users.php");
        
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