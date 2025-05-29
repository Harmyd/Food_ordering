<?php include('partials/menu.php')?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Manage Categories</h1>
        <br>
        <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//Displaying Session Message
                    unset($_SESSION['add']);//Removing Session Message
                }
                if(isset($_SESSION['deletee'])){
                    echo $_SESSION['deletee'];//Displaying Session Message
                    unset($_SESSION['deletee']);//Removing Session Message
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];//Displaying Session Message
                    unset($_SESSION['upload']);//Removing Session Message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];//Displaying Session Message
                    unset($_SESSION['update']);//Removing Session Message
                }

            ?>
        <br>
            <!-- button to add admin -->
            <button class="btn_primary"><a href="<?php echo SITEURL;?>admin/add_category.php">Add Categories</a></button> 
            <br> <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image_name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    $sql = "SELECT * FROM dbl_category";
                    $result = mysqli_query($connection,$sql);
                    $sn = 1;
                    if($result == true){
                        $count = mysqli_num_rows($result);
                        if($count>0){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $Title = $row['Title'];
                                $Image_name=$row['Image_name'];
                                $Featured=$row['Featured'];
                                $active=$row['Active'];
                        ?>
                <tr>
                    <td><?php echo $sn++?></td>
                    <td><?php echo $Title?></td>
                    <td>
                        <?php 
                        if($Image_name!=''){

                            echo $Image_name;
                        }else{
                            echo $_SESSION['no_image'] = "<div class ='error'>Image not added</div>";
                        }
                        ?>
                
                    </td>
                    <td><?php echo $Featured?></td>
                    <td><?php echo $active?></td>
                    <td>
                        <button class="btn_secondary"><a href="<?php echo SITEURL ?>admin/update_category.php?id=<?php echo $id?>&image_name=<?php echo $Image_name?>">Update Category</a> </button> 
                        <button class="btn_danger"><a href="<?php echo SITEURL ?>admin/delete_category.php?id=<?php echo $id?>&image_name=<?php echo $Image_name?>">Delete Category</a> </button> 
                    </td>
                </tr>
<?php
                            }   
                        }
                    }
                ?>
            </table>
    </div>
</div>

<?php include('partials/Footer.php') ?>