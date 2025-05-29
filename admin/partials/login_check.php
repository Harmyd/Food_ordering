<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['no_login_message']="<div class='error'>Pls login to access the admin panel</div>";
        //redirect
        header("location:".SITEURL."admin/login.php");
    }
?>