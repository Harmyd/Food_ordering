<?php include('partials/menu.php');?>
<div class="Main_section">
    <div class="Wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            
             if(isset($_SESSION['pas_not_match'])){
                echo $_SESSION['pas_not_match'];
                unset($_SESSION['pas_not_match']);
            }
            
        ?>
<br>

        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="text" name="current_password" placeholder="Old Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="text" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="text" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- <input type="hidden" name="id" value=<?php echo $id;?>>  -->
                        <input class="btn_secondary" type="submit" name="submit" value="Update Password">
                    </td>

                </tr>

            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        // $id = $_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password =md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        $query ="SELECT * FROM dbl_admin_2 WHERE id='$id' AND Password ='$current_password'";
        $res = mysqli_query($connection,$query);
        if($res==true)
        {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $Sql="UPDATE dbl_admin_2 SET
                    Password = '$new_password'
                    WHERE id = '$id'
                    ";
                    $res2=mysqli_query($connection,$Sql);
                        if($res2==true)
                        {
                            $_SESSION['change_pas']="<div class='success'>Password changed successfully</div>";
                            //redirect
                            header("location:".SITEURL."admin/manage_admin.php");
                        }
                }
                else
                {
                    $_SESSION['pas_not_match']="<div class='error'>Password did not match</div>";
                    //redirect
                    header("location:".SITEURL."admin/update_password.php");
                }
            }
            else
            {
                $_SESSION['user_not_found']="<div class='error'>User is not found</div>";
                header("location:".SITEURL."admin/manage_admin.php");
            }
        }
    } 
?>
<?php include('partials/Footer.php')?>