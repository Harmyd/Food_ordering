<?php include('partials/menu.php')?>
<div class="Main-section">
    <div class="Wrapper">
        <h1>Manage Order</h1>
        <?php 
            if(isset($_SESSION['order_upd'])){
                echo $_SESSION['order_upd'];
                unset($_SESSION['order_upd']);
            }
        ?>
    
            <table class="tbl-full">
                <tr >
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order_date</th>
                    <th>Status</th>
                    <th>Customer_name</th>
                    <th>Customer_contact</th>
                    <th>Customer_email</th>
                    <th>Customer_address</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <?php 
                        $sql = "SELECT * FROM dbl_order ORDER BY id DESC";
                        $RES= mysqli_query($connection,$sql);
                        $sn=1;
                        if($RES==true){
                            $count = mysqli_num_rows($RES);
                            if($count>0){
                                while($row = mysqli_fetch_assoc($RES)){
                                    $id = $row['id'];
                                    $Food= $row['Food'];
                                    $Price= $row['Price'];
                                    $Quantity=$row['Quantity'];
                                    $Total=$row['Total'];
                                    $Order_date=$row['Order_date'];
                                    $Status=$row['Status'];
                                    $Customer_name=$row['Customer_name'];
                                    $Customer_contact=$row['Customer_contact'];
                                    $Customer_email=$row['Customer_email'];
                                    $Customer_address=$row['Customer_address'];
                                    ?>
                                <tr>
                                        <td><?php echo $sn++?></td>
                                        <td><?php echo $Food?></td>
                                        <td><?php echo $Price?></td>
                                        <td><?php echo $Quantity?></td>
                                        <td><?php echo $Total?></td>
                                        <td><?php echo $Order_date?></td>
                                        <td>
                                            <?php 
                                                if($Status=="ordered"){
                                                    echo "<label>$Status</label>";
                                                }elseif($Status=="On-Delivery"){
                                                    echo "<label style= 'color:Orange;'>$Status</label>";
                                                }elseif($Status=="Delivered"){
                                                    echo "<label style= 'color:Green;'>$Status</label>";
                                                }elseif($Status=="Cancelled"){
                                                    echo "<label style= 'color:#ff4757;'>$Status</label>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $Customer_name?></td>
                                        <td><?php echo $Customer_contact?></td>
                                        <td><?php echo $Customer_email?></td>
                                        <td><?php echo $Customer_address?></td>
                                        <td>
                                            <button class="btn_secondary"><a href="update_order.php?id=<?php echo $id?>">Update Order</a> </button> 
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