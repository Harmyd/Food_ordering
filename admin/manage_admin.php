<?php include ('partials/menu.php') ?>

      <!-- Main section starts -->
       <div class="Main-section">
            <div class="Wrapper">
            <h1>Manage Admin</h1>
                <br>
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//Displaying Session Message
                    unset($_SESSION['add']);//Removing Session Message
                }
            ?>
            <?php
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
             <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <?php
             if(isset($_SESSION['change_pas'])){
                echo $_SESSION['change_pas'];
                unset($_SESSION['change_pas']);
            }
            ?>
           
            <?php
                if(isset($_SESSION['user_not_found'])){
                    echo $_SESSION['user_not_found'];
                    unset($_SESSION['user_not_found']);
                }
            ?>
            

            <br><br>
            <!-- button to add admin -->
            <button class="btn_primary"><a href="add_admin.php">Add admin</a></button> 
            <br> <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    $sql = 'SELECT * FROM dbl_admin_2';
                    $res = mysqli_query($connection,$sql);
                    $sn = 1;
                    if($res==TRUE){
                        //check if there are data in the database 
                        $count = mysqli_num_rows($res);//Function to get all the rows in a database
                        if($count>0){
                            //Using While loop to get the data in the database and while loop will run 
                            //as long as we have data in the database
                            while($rows=mysqli_fetch_assoc($res)){
                                //Get individual data
                                $id = $rows['id'];
                                $full_name=$rows['Full_name'];
                                $username =$rows['Username'];
                                $password = $rows['Password'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++?></td>
                                        <td><?php echo $full_name?></td>
                                        <td><?php echo $username?></td>
                                        
                                        <td>
                                            <button class="btn_primary"><a href="<?php echo SITEURL;?>admin/update_password.php?id=<?php echo $id;?>">Change Password</a></button>
                                            <button class="btn_secondary"><a href="<?php echo SITEURL;?>admin/update_admin.php?id=<?php echo $id;?>">Update Admin</a> </button> 
                                            <button class="btn_danger"><a href="<?php echo SITEURL;?>admin/delete_admin.php?id=<?php echo $id;?>">Delete Admin</a> </button> 
                                        </td>
                                    </tr>
                                <?php
                            }
                        }

                    }else
                
                ?>
            </table>
            
            </div>
            <div class="clearfix"></div>
            </div>
       </div>
     <!-- Main section end -->

<?php include('partials/Footer.php')?>