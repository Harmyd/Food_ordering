<?php include('partials/menu.php')?>
<?php 
    $Id = $_GET['id'];
    $Image_name=$_GET['Image_name'];
    if(isset($_GET['id'])){
        //Get the data from the db
        $sql = "SELECT * FROM dbl_food WHERE id ='$Id'";
        $query = mysqli_query($connection,$sql);
        if($query==true){
            //Check if there are existing data
            $Count = mysqli_num_rows($query);
            if($Count>0){
                while($ROW = mysqli_fetch_assoc($query)){
                    $id=$ROW['id'];
                    $Title=$ROW['Title'];
                    $Description=$ROW['Description'];
                    $Price=$ROW['Price'];
                    $Current_image_name=$ROW['Image_name'];
                    $Current_category=$ROW['Category_id'];
                    $Featured=$ROW['Featured'];
                    $Active=$ROW['Active'];
                }
            }
        }
    }
?>

<div class="Main-section">
    <div class="Wrapper">
        <h1>Update Food</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" value="<?php echo $Title?>">
                    </td> 
                </tr>
                
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="10"><?php echo $Description?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" id="" value="<?php echo $Price?>"></td>
                </tr>
                <tr>
                    <td>Current_image</td>
                    <td>
                    <?php if($Current_image_name!==''){?>
                        <img src="../images/food/<?php echo $Current_image_name?>" width="100px" height="100px">
                    <?php
                    }else{
                        echo $_SESSION['no_image']="<div class='error'>Image not added</div>";
                    }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                <td>Category:</td>
                    <td>
                        <select name="category" id="">
                            <?php 
                                //Create php code to display categories from the database
                                //Create Sql to get all the active categories from the database 
                                $sql = "SELECT * FROM dbl_category WHERE Active = 'yes'";
                                $RES = mysqli_query($connection,$sql);
                                if($RES==true){
                                    $count=mysqli_num_rows($RES);
                                    if($count>0){
                                        while($row=mysqli_fetch_assoc($RES)){
                                            $id=$row['id'];
                                            $Title =$row['Title'];
                                            ?>
                                                <option <?php if($Current_category==$id){echo 'selected';}?> value=<?php echo $id?>><?php echo $Title?></option>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <option value=0>No Categories available</option> 
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($Featured=='Yes')echo 'checked';?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($Featured=='No')echo 'checked';?> type="radio" name="featured" value="No">NO
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($Active=='yes')echo 'checked';?> type="radio" name="active" value="yes">Yes
                        <input <?php if($Active=='no')echo 'checked';?> type="radio" name="active" value="no">NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn_secondary">
                    </td>
                </tr>



            </table>
        </form>
    </div>
</div>
<?php 
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id=$_POST['category'];
        $price = $_POST['price'];
        //Check if the featured and active field is clicked or not
        if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
        }else{
            $featured='No';
        }
        if(isset($_POST['active'])){
            $active=$_POST['active'];
        }else{
            $active='No';
        }
    //Check if image is selected
        if(isset($_FILES['image']['name'])){
            $New_image=$_FILES['image']['name'];
            //Upload the image only if image is selected 
            if($New_image!==''){
                //Cut the extension from the image chosen so it can be added to defined name
                $ext=end(explode('.',$New_image));
                //Rename the image
                $New_image="Food name_".rand(000,999).'.'.$ext;
                $Source_path=$_FILES['image']['tmp_name'];
                $Destination_path="../images/food/".$New_image;
                //Upload the image
                $Upload=move_uploaded_file($Source_path,$Destination_path);
                if(!$Upload){
                    echo "Unable to upload";
                    die();
                }
                if($Current_image_name!==''){
                    $path="../images/food/".$Current_image_name;
                    $Remove= unlink($path);
                    if(!$Remove){
                        $_SESSION['no_remove']="<div class='error'>Unable to remove the category image</div>";
                    }
                }else{

            }
            }else{
                $New_image=$Current_image_name;
            }
        }
         //Create the query to update
         $query2="UPDATE dbl_food SET 
         Title = '$title',
         Description = '$description',
         Price ='$price',
         Image_name='$New_image',
         Category_id='$category_id',
         Featured = '$featured',
         Active='$active'
         WHERE id ='$Id'
         ";
         $Res=mysqli_query($connection,$query2);
         if(!$Res){
            $_SESSION['uPdate']="<div class='error'>Unable to Update food</div>";
            //redirect
            header("location:".SITEURL."admin/manage_food.php");
         }else{
            $_SESSION['uPdate']="<div class='success'>Food updated successfully</div>";
            //redirect
            header("location:".SITEURL."admin/manage_food.php");
         }
         
    }

    // echo mysqli_affected_rows($connection);
   
    // echo $Id;
?>
<?php include('partials/footer.php')?>
