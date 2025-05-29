<?php include('partials/menu.php');?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['no_upload'])){
                echo $_SESSION['no_upload'];
                unset($_SESSION['no_upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td> 
                </tr>
                
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" id=""></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
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
                                                <option value=<?php echo $id?>><?php echo $Title?></option>
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
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">NO
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn_secondary">
                    </td>
                </tr>



            </table>
        </form>
    </div>
</div>
<?php 
    if(isset($_POST['submit'])){
        //Add the food in the database
        //1.Get the data from the form
        $Title = $_POST['title'];
        $Description = $_POST['description'];
        $Price =$_POST['price'];
        $Category_id=$_POST['category'];

        //check whether the radio button for featured and active are checked or not
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured="No";
        }
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }else{
            $active="No";
        }
        //2.Upload the image if it is selected
        if(isset($_FILES['image']['name'])){
            $Image = $_FILES['image']['name'];
        if($Image!=''){
            //Cut the extension from the name of d image chosen from user pc
            $ext = end(explode('.',$Image));
            //Create name
            $Image="Food_Category_".rand(000,999).".".$ext;
            //Get the source path
            $Source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/food/".$Image;

            $upload = move_uploaded_file($Source_path,$destination_path);
            if(!$upload){
                $_SESSION['no_upload']= "<div class='error'>Failed to upload</div>";
                die();
            }else{

            }
        }else{
            //$_SESSION['no_image']="<div class='error'>Image not added</div>";
        }
    }
    //insert the data into the database
    $sql ="INSERT INTO dbl_food SET
    Title = '$Title',
    Description ='$Description',
    Price ='$Price',
    Image_name='$Image',
    Category_id='$Category_id',
    Featured ='$featured',
    Active = '$active'
    ";
    $res = mysqli_query($connection,$sql);
    if($res == true){
        $_SESSION['food']="<div class = 'success'>Food is added successfully</div>";
        //Redirect
        header("location:".SITEURL."admin/manage_food.php");
    }else{
        $_SESSION['food']="<div class = 'error'>Unable to add food</div>";
        header("location:".SITEURL."admin/add_food.php");

    }
}
?>
<?php include('partials/footer.php');?>
