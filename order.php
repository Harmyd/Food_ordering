<?php include('Partials_front/menu.php')?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
     <?php 
        if(isset($_GET['food_id'])){
            $id = $_GET['food_id']; 

            $sql = "SELECT * FROM dbl_food WHERE id = '$id'";
            $query= mysqli_query($connection,$sql);
            if($query==true){
                $count = mysqli_num_rows($query);
                if($count>0){
                    $row = mysqli_fetch_assoc($query);
                    $Title= $row['Title'];
                    $PRice= $row['Price'];
                    $Image_name=$row['Image_name'];
                }
            }
        }else{
            header("location".SITEURL."index.php");
        }

    ?>
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($Image_name!==''){
                        ?>
                            <img src="images/food/<?php echo $Image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                        } else{
                            echo "<div class ='error'>Image is not available</div>";
                        }
                        ?>
                    </div>
                    
    
                    <div class="food-menu-desc">
                        <h3><?php echo $Title?></h3>
                        <input type="hidden" name="Title" value="<?php echo $Title?>">

                        <p class="food-price"><?php echo $PRice?></p>
                        <input type="hidden" name="Price" value="<?php echo $PRice?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Harmyd" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 0904580419" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. harmyd@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
                if(isset($_POST['submit'])){
                    $Food=$_POST['Title'];
                    $Price=$_POST['Price'];
                    $Quantity = $_POST['qty'];
                    $Total = $Price * $Quantity;
                    $Order_date=date("Y-m-d h:i:sa");
                    $Status ="Ordered";
                    $Full_name=$_POST['full-name'];
                    $contact=$_POST['contact'];
                    $Email=$_POST['email'];
                    $Address=$_POST['address'];

                    $sql="INSERT INTO dbl_order SET 
                    Food ='$Food',
                    Price ='$Price',
                    Quantity ='$Quantity',
                    Total ='$Total',
                    Order_date='$Order_date',
                    Status = '$Status',
                    Customer_name='$Full_name',
                    Customer_contact ='$contact',
                    Customer_email ='$Email',
                   Customer_address = '$Address'
                    ";
                $result=mysqli_query($connection,$sql);
                if($result==true){
                    $_SESSION['order']="<div class='success'> Food ordered successfully</div>";
                    header("location:".SITEURL);
                }else{
                    $_SESSION['order']="<div class='error'>Failed to order food</div>";
                    header("location:".SITEURL);
                }
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php include('Partials_front/footer.php')?>
    <!-- footer Section Ends Here -->

</body>
</html>