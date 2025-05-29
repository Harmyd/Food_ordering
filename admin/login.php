<?php include('../config/constants.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-content">Login</h1>
        <?php
                if(isset($_SESSION['Login failed'])){
                    echo $_SESSION['Login failed'];
                    unset($_SESSION['Login failed']);
                }
            ?>
        <?php
                if(isset($_SESSION['no_login_message'])){
                    echo $_SESSION['no_login_message'];
                    unset($_SESSION['no_login_message']);
                }
        ?>
        <!-- Login form starts here    -->
         <form action="" method="POST" class="text-content">
            Username: <br>  
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password: <br>
            <input type="text" name="password" placeholder="Enter your password"> <br><br>
            <input type="submit" name="submit" value="login" class="btn_primary">
            <br><br>                                                 
        </form>
        <p class="text-content">Created by <a href="">Harmyd</a></p>
    </div>
</body>
</html>

<?php 
    if(isset($_POST['submit'])){
        $Username = $_POST['username'];
        $Password =md5($_POST['password']);

        $sql = "SELECT *  FROM dbl_admin_2 WHERE Username = '$Username' AND Password ='$Password'";
        $res= mysqli_query($connection,$sql);
        if($res ==true){
            $count = mysqli_num_rows($res);
            if($count==1){
                //redirect
                header("location:".SITEURL."admin/index.php");
                $_SESSION['login'] = "<div class ='success'>You are welcome $Username </div>";
                $_SESSION['user']=$Username;
            }else{
                $_SESSION['Login failed']="Unable to login";
                header("location:".SITEURL."admin/login.php");
            }
        }
    }


?>