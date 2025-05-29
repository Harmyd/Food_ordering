<?php include ('partials/menu.php'); ?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Update Admin</h1>

        <?php 
        //Get id of selected admin
        $id=$_GET['id'];
        
        //Create sql to get all the details
        $Sql = "SELECT * FROM dbl_admin_2 WHERE id=$id";
        $Res = mysqli_query($connection,$Sql);
        if($Res==TRUE){
        //Check if data exist in the database
        $count=mysqli_num_rows($Res);
        if($count==1){
            $row = mysqli_fetch_assoc($Res);
            $full_name = $row['Full_name'];
            $username=$row['Username'];
        }
        }
        ?>
   

        <form action="" method="post">
            <table class='tbl-30'>
                <tr>
                    <td>Fullname:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username?>"></td>
                </tr>
                <tr>
                    <td><input type="hidden"name="id"></td>
                    <td colspan="2"><input class="btn_secondary" type="submit" name="submit" value="Update admin"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
            if(isset($_POST['submit'])){
                $Full_name = $_POST['full_name'];
                $Username =$_POST['username'];
                // $dd=$_POST['id'];
                // $id=$_GET['id'];
                $Sql = "UPDATE dbl_admin_2 SET
                        Full_name='$Full_name',
                        Username='$Username'
                        WHERE id = '$id'
                ";
                $Res = mysqli_query($connection,$Sql);
                if($Res==True){
                    $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
                    //redirect
                    header("location:".SITEURL."admin/manage_admin.php");
                }else{
                    $_SESSION['update']="Admin unable to update try again";
                }

            }
        ?>

<?php include('partials/Footer.php')?>