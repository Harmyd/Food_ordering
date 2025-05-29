<?php include('partials/menu.php');?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Add Category</h1>
        <br>
        <?php 
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];//Displaying Session Message
                    unset($_SESSION['upload']);//Removing Session Message
                }
            ?>
        
        <br><br>
        <form action=""method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Fearured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">NO
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">NO
                        </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn_secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit'])){
        $Title = $_POST['title'];
        //Check for if the radio button is clicked 
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured ="No";
        }
        if(isset($_POST['active'])){
            $active= $_POST['active'];
        }else{
            $active = "No";
        }
        if(isset($_FILES['image']['name'])){
            //To upload the image we need image name,source path and destination path
            $image_name=$_FILES['image']['name'];

            //Upload image only if image is selected
            if($image_name!=''){
                //Get the extension of our image(jpg,gif,png etc) 
                $ext = end(explode('.',$image_name)); 
                //Rename the image
                $image_name = "Food_category_". rand(000,999).".".$ext;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/Category/".$image_name; 

                //We can now upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                //Check whether the image is uploaded or not 
                if(!$upload){
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                    header("location:".SITEURL."admin/add_category.php");
                    //Stop the process
                    die();
                }
        }
        } 
        //Execute the sql query
        $sql = "INSERT INTO dbl_category SET
        Title = '$Title',
        Image_name ='$image_name', 
        Featured ='$featured',
        Active ='$active'        
        ";
        $res = mysqli_query($connection,$sql);
        if($res==true){
            $_SESSION['add']="<div class='success'>Category added successfully</div>";
            //redirect
            header("location:".SITEURL."admin/manage_categories.php");
            
        }else{
            $_SESSION['add']="<div class='error'>Unable to add Category</div>";
            header("location:".SITEURL."admin/manage_categories.php");
        }
    }
?>
<?php include('partials/footer.php');?>

<?php
//              Files Global variable array:
//Array ( [image] => Array ( [name] => [full_path] => [type] => [tmp_name] => [error] => 4 [size] => 0 ) )
?>