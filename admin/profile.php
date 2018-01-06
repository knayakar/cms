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
                            <small>Your profile section</small>
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->
                
                <form action="" method="post" enctype="multipart/form-data">
                      <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"><strong></strong>User Role</label><br>
                         <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="user_role" required>
                            
<?php  // Retrieve user data from DB

    if(isset($_SESSION['user_id'])) {
        
        $session_user_id = $_SESSION['user_id'];
        
        $retrieve_user_data_query = "SELECT * FROM users WHERE user_id = $session_user_id";
        $query_result = mysqli_query($connection, $retrieve_user_data_query);
        
        checkResult($query_result);
        
        while($row = mysqli_fetch_assoc($query_result)) {
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            
            if($user_role == 'Subscriber') {
                echo "<option selected>Subscriber</option>";    
                echo "<option>Admin</option>";    
            }else {
                echo "<option>Subscriber</option>";    
                echo "<option selected>Admin</option>";
            }
            
     
?>                            
                            
                            </select>
                      </div>
                      <br>
                      <div class="form-group">
                        <label for="formGroupExampleInput">First Name</label>
                        <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Last Name</label>
                        <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_lastname;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Image</label><br>
                        <img src="../images/<?php echo $user_image ?>" alt="image" width="150">
                        <br><br>
                        <input type="file" class="form-control-file" id="user_image" name="user_image" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Email Id</label>
                        <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput">Password</label>
                        <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $user_password;?>" required>
                      </div>
                      <button type="submit" class="btn btn-primary" name="p_submit">Update Profile</button>
                </form>
<?php 
            }
        }
            
            
            // Update User Details

    if(isset($_POST['p_submit'])) {
        
        $user_id = $_SESSION['user_id'];
        $user_role = $_POST['user_role'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_image = $_FILES['user_image']['name']  ;
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
            move_uploaded_file($user_image_temp, "../images/$user_image");
        
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        
        $update_user_query = "UPDATE users SET username = '$username', user_email = '$user_email', user_password = '$user_password', user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role', user_image = '$user_image' WHERE user_id = '$user_id'";
        
        $query_result = mysqli_query($connection, $update_user_query);
        
        checkResult($query_result);
        
        $message = "User Updated Successfully!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        
        header("Location: profile.php");
    }

?>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>