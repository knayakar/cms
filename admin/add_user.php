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
                            <small>Add user section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="" method="post" enctype="multipart/form-data">
                      <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"><strong></strong>User Role</label><br>
                         <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="user_role" required>
                            <option selected>Select Options...</option>
                            <option>Admin</option>
                            <option>Subscriber</option>
                         </select>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="formGroupExampleInput">First Name</label>
                        <input type="text" class="form-control" id="user_firstname" name="user_firstname" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Last Name</label>
                        <input type="text" class="form-control" id="user_lastname" name="user_lastname" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Image</label>
                        <input type="file" class="form-control-file" id="user_image" name="user_image" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Email Id</label>
                        <input type="text" class="form-control" id="user_email" name="user_email" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Password</label>
                        <input type="text" class="form-control" id="user_password" name="user_password" required>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Add User</button>
                </form>
<?php

    if(isset($_POST['submit'])) {
        
        $user_role = $_POST['user_role'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_image = $_FILES['user_image']['name']  ;
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
            move_uploaded_file($user_image_temp, "../images/$user_image");
        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        
        $add_user_query = "INSERT INTO users(username, user_email, user_password, user_firstname, user_lastname, user_role, user_image) ";
        
        $add_user_query .= "VALUES('$username', '$user_email', '$user_password', '$user_firstname', '$user_lastname', '$user_role', '$user_image')";
        
        $query_result = mysqli_query($connection, $add_user_query);
        
        checkResult($query_result);
        
        $message = "New User Created Successfully!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        
        header("Location: view_all_users.php");
    }

?>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>