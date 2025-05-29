<?php include ('partials/menu.php') ?>
<?php 
 $id = $_GET['id'];
 $image_name=$_GET['image_name'];
 echo $id;
if(isset($_GET['id'])){
    //delete image
    if($image_name!=""){
        //Get the location of image in your computer
    $path ="../images/Category/".$image_name;
    $remove = unlink($path);
        if($remove==false){
            $_SESSION['deletee']="<div class='error'>Failed to remove Category image</div>";
            //redirect
            header("location:".SITEURL."admin/manage_categories.php");
            die();
        }
    }
    //Delete from the database
    $sql = "DELETE FROM dbl_category WHERE id ='$id'";
    $res = mysqli_query($connection,$sql);
    if($res==true){
        $_SESSION['deletee']="<div class='success'>Category deleted successfully</div>";
        //redirect
        header("location:".SITEURL."admin/manage_categories.php");
    }else{
        $_SESSION['deletee']="<div class = 'error'>Unable to delete Category try again later</div>";
        header("location:".SITEURL."admin/manage_categories.php");
    }
}else{
    header("location:".SITEURL."admin/manage_categories.php");
    
}
?>