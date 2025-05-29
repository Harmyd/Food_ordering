<?php include('partials/menu.php')?>
<?php 
    $id = $_GET['id'];
    $Image_name=$_GET['Image_name'];
    //Delete the Image from your pc
    if(isset($_GET['id'])){
        //Delete the image only if image is available 
        if($Image_name!=''){
            //Get the location of the image in your pc
            $path = "../images/food/".$Image_name;
            $Remove = unlink($path);
            if(!$Remove){
                $_SESSION['undelete']="<div class='error'>Failed to remove the image</div>";
                //redirect
                header("location:".SITEURL."admin/manage_food.php");
                die();
            }
        }
    }
    
    //Create the query to delete the data from the database
    $sql= "DELETE FROM dbl_food WHERE id = '$id'";
    $query = mysqli_query($connection,$sql);
    if($query==true){
        $_SESSION['delette']="<div class='success'>Food deleted successfully</div>";
        //redirect
        header("location:".SITEURL."admin/manage_food.php");
    }else{
        $_SESSION['delette']="<div class='error'>Unable to delete Food</div>";
        header("location:".SITEURL."admin/manage_food.php");
    }
?>