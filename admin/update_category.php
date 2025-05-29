<?php include('partials/menu.php')?>
<?php 
    $id=$_GET['id'];
    $Image_name=$_GET['image_name'];
    if(isset($_GET['id'])){
        //Get the current image
        $sql = "SELECT * FROM dbl_category WHERE id = '$id' ";
        $result = mysqli_query($connection,$sql);
        if($result==true){
            $count = mysqli_num_rows($result);
            if($count==1){
                $row=mysqli_fetch_assoc($result);
                $id = $row['id'];
                $Title=$row['Title'];
                $Current_image=$row['Image_name'];
                $Featured=$row['Featured'];
                $Active=$row['Active'];


            }
        }else{

        }
    }else{

    }
?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Update Category</h1>

        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl_30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" value="<?php echo $Title?>"></td>
            </tr>
            
            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                    if($Current_image!=''){
                        ?>
                        <img src="../images/Category/<?php echo $Current_image;?>" width="120px" height="80px">
                        <?php
                    }else{
                        echo $_SESSION['no_image'];
                    }
                    
                    ?>
                </td>
            </tr>

            <tr>
                <td>New image:</td>
                <td>
                    <input type="file" name="image" id="">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($Featured =='Yes') echo 'checked';?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($Featured =='No') echo 'checked';?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($Active =='Yes') echo 'checked';?> type="radio" name="active" value="Yes">Yes
                    <input  <?php if($Active =='No') echo 'checked';?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id?>"></td>
                <td><input type="hidden" name="current_image" value="<?php echo $Current_image?>"></td>
                <td colspan="2">
                    <input type="submit" name="submit" value="Update Category" class="btn_secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $Title = $_POST['title'];
        $Current_image= $_POST['current_image'];
        //Check if the radio button of featured and active is checked or not
        if(isset ($_POST['featured'])){
            $Featured = $_POST['featured'];
        }else{
            $Featured="No";
        }
        if(isset($_POST['active'])){
            $Active = $_POST['active'];
        }else{
            $Active = "No";
        }
    if(isset($_FILES['image']['name'])){
        $New_image=$_FILES['image']['name'];
        //Upload image only if image is selected
            if($New_image!=''){
                //Create extension
                $ext = end(explode('.',$New_image));
                        //Create the image name 
                $New_image= "Food Category_".rand(0000,9999).'.'.$ext;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/Category/".$New_image;
                        //upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                    if(!$upload){
                        $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                        header("location:".SITEURL."admin/add_category.php");
                                //Stop the process
                        die();
                    }
                                        //Remove the image from your Pc
                    if($Current_image!=''){
                        $remove_path="../images/Category/".$Current_image;
                        $Remove=unlink($remove_path);
                            if(!$Remove){
                            $_SESSION['deleteei']="unable";
                            die();
                            }
                        }else{
                           //no
                        }

            }else{
                $New_image=$Current_image;                
            }            
                
    }else{
        $New_image=$Current_image;
    }
         $sql = "UPDATE dbl_category SET
        Title = '$Title',
        Image_name ='$New_image', 
        Featured ='$Featured',
        Active ='$Active' 
        WHERE id ='$id'
        ";
        $res = mysqli_query($connection,$sql);
        if($res==true){
            $_SESSION['update']="<div class='success'>Category updated successfully</div>";
            //redirect
            header("location:".SITEURL."admin/manage_categories.php");
        }
    }

?>
<?php include('partials/footer.php')?>
