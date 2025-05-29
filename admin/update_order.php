<?php include('partials/menu.php')?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Update order</h1>
        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sql= "SELECT * FROM dbl_order WHERE id = '$id'";
                $query=mysqli_query($connection,$sql);
                if($query){
                    $count = mysqli_num_rows($query);
                    if($count==1){
                        $row = mysqli_fetch_assoc($query);
                        $food_name=$row['Food'];
                        $Price=$row['Price'];
                        $Quantity=$row['Quantity'];
                        $Status=$row['Status'];
                        $Customer_name=$row['Customer_name'];
                        $Customer_contact=$row['Customer_contact'];
                        $Customer_email=$row['Customer_email'];
                        $Customer_address=$row['Customer_address'];
                    }
                }

            }else{
                header("location:".SITEURL."admin/manage_order.php");
            } 
        ?>




        <form action=""method="POST">
            <table class="tbl_30">
                <tr>
                    <td>Food Name:</td>
                    <td><?php echo $food_name?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><?php echo $Price?></td>
                    <input type="hidden" name="Price" value="<?php echo $Price?>">
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $Quantity?>">
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" >
                            <option <?php if($Status=="ordered") echo "selected";?> value="ordered">Ordered</option>
                            <option <?php if($Status=="On-Delivery") echo "selected";?> value="On-Delivery">On-Delivery</option>
                            <option <?php if($Status=="Delivered") echo "selected";?> value="Delivered">Delivered</option>
                            <option <?php if($Status=="Cancelled") echo "selected";?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="Customer_name" value="<?php echo $Customer_name?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="Customer_contact" value="<?php echo $Customer_contact?>"></td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="text" name="Customer_email" value="<?php echo $Customer_email?>"></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address"cols="30" rows="5" id=""><?php echo $Customer_address?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name="submit" value="Update Order" class="btn_secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
            <?php
                if(isset($_POST['submit'])){
                    $PRICE = $_POST['Price'];
                    $QTY=$_POST['qty'];
                    $Total=$PRICE * $QTY;
                    $STATUS = $_POST['status'];
                    $Cus_name=$_POST['Customer_name'];
                    $Cus_contact=$_POST['Customer_contact'];
                    $Cus_email=$_POST['Customer_email'];
                    $Cus_address=$_POST['customer_address'];

                    $sql2= "UPDATE dbl_order SET 
                    Price ='$PRICE',
                    Quantity = '$QTY',
                    Total='$Total',
                    Status= '$STATUS',
                    Customer_name='$Cus_name',
                    Customer_email='$Cus_email',
                    Customer_contact='$Cus_contact',
                    Customer_address='$Cus_address'
                    WHERE id = '$id'
                     ";
                    $res=mysqli_query($connection,$sql2);
                    if($res){
                        $_SESSION['order_upd']="<div class='success'>Order Updated Successfully</div>";
                        header("location:".SITEURL."admin/manage_order.php");
                    }else{
                        $_SESSION['order_upd']="<div class='error'>Failed to update order</div>";
                        header("location".SITEURL."admin/manage_order.php");
                    }
                    

                }
            
            
            
            ?>

<?php include('partials/footer.php')?>