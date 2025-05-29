<?php include ('partials/menu.php') ?>
<?php 
    if(isset($_POST['submit'])){
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //Sql query to save Data into Database    
        $Sql = "INSERT INTO dbl_admin_2 SET
            Full_name = '$full_name',
            Username ='$username',
            Password ='$password'
        " ;
        //Executing query and saving data into database
        $res = mysqli_query($connection,$Sql);
        //Check whether the data is executed or not
        if($res==true){
            //create a session variable to display messsage
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            //Redirect
            header("location:".SITEURL.'admin/manage_admin.php');
        }else{
            $_SESSION['add'] = "Failed to add admin";
            //Redirect
            header("location:".SITEURL.'admin/add_admin.php');
        }
    }

    
?>



<div class="Main-section">
    <div class="Wrapper">
    <br>
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//Displaying Session Message
                    unset($_SESSION['add']);//Removing Session Message
                }
            ?>
            <br><br>
        <h1>Add Admin</h1>
        <br>
        <form action="" method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Fullname</td>
                    <td><input type="text" name="full_name" id="" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="" placeholder="Enter your Username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" id="" placeholder="Enter your Password"></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn_secondary">

                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/Footer.php')?>
