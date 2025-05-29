<?php include('partials/menu.php')?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Manage Food</h1>
        <br>
            <!-- button to add admin -->
            <button class="btn_primary"><a href="<?php echo SITEURL?>admin/add_food.php">Add Food</a></button> 
            <br> <br>
            <?php
                if(isset($_SESSION['food'])){
                    echo $_SESSION['food'];
                    unset($_SESSION['food']);
                } 
                if(isset($_SESSION['delette'])){
                    echo $_SESSION['delette'];
                    unset($_SESSION['delette']);
                } 
                if(isset($_SESSION['uPdate'])){
                    echo $_SESSION['uPdate'];
                    unset($_SESSION['uPdate']);
                } 
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Images</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //Create a query to get the data from the database
                    $sn=1;
                    $sql="SELECT * FROM dbl_food ";
                    $query =mysqli_query($connection,$sql);
                    if($query==true){
                        //Check if data exists in the table
                        $count = mysqli_num_rows($query);
                        if($count>0){
                            while($row = mysqli_fetch_assoc($query)){
                                $id=$row['id'];
                                $Title=$row['Title'];
                                $Description=$row['Description'];
                                $Price =$row['Price'];
                                $Image_name=$row['Image_name'];
                                $Category_id=$row['Category_id'];
                                $Featured=$row['Featured'];
                                $Active=$row['Active'];
                                ?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $Title?></td>
                    <td><?php echo $Price?></td>
                    <td><?php  
                            if($Image_name==''){
                                echo "<div class='error'>Image not added</div>";
                            }else{
                                ?>
                                <img src="../images/food/<?php echo $Image_name;?>" width="120px" height="50px" alt="">
                                <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $Featured?></td>
                    <td><?php echo $Active?></td>
                    <td>
                    <button class="btn_secondary"><a href="<?php echo SITEURL ?>admin/Update_food.php?id=<?php echo $id?>&Image_name=<?php echo $Image_name?>">Update Food</a> </button> 
                    <button class="btn_danger"><a href="<?php echo SITEURL ?>admin/Delete_food.php?id=<?php echo $id?>&Image_name=<?php echo $Image_name?>">Delete Food</a> </button> 
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