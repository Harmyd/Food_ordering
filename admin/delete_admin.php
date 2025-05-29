<?php include ('partials/menu.php') ?>

<?php 
$id = $_GET['id'];

$sql = "DELETE FROM dbl_admin_2 WHERE id = $id";
$res = mysqli_query($connection,$sql);
if($res==TRUE){
    $_SESSION['delete']="<div class='success'>Admin has been deleted successfully</div>";
    //Redirect
    header("location:".SITEURL."admin/manage_admin.php");
}else{
    $_SESSION['delete']="Failed to delete admin.Try again later";
    //Redirect
    header("location:".SITEURL."admin/manage_admin.php");
}
?>