<?php include "db.php" ?>
<?php session_start();?>


<?php

if(isset($_POST['login'])) {
        
    $post_username = $_POST['username'];
    $post_user_password = $_POST['password'];
    
    $post_username = mysqli_real_escape_string($connection, $post_username);
    $post_user_password = mysqli_real_escape_string($connection, $post_user_password);
    
    
    $login_query = "SELECT * FROM users WHERE username = '$post_username'";
    $query_result = mysqli_query($connection, $login_query);
    
    while($row = mysqli_fetch_assoc($query_result)) {
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_email = $row['user_email'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        
    }
        
    if($post_username === $username && $post_user_password === $user_password) {
        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_firstname'] = $user_firstname;
        $_SESSION['user_lastname'] = $user_lastname;
        $_SESSION['user_role'] = $user_role;
        
        
        if($_SESSION['user_role'] == 'Admin') {
            header("Location: ../admin/admin_index.php");
        }
        else {
            header("Location: ../index.php");
        }
            
    
    }else {
            
            header("Location: ../index.php");
            
    }
}

?>