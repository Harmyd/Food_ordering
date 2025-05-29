<?php include('../config/constants.php')?>
<?php 
    //Destroy Session
    session_destroy();
    //redirect
    header("location:".SITEURL."admin/login.php");

?>