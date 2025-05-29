<?php include ('partials/menu.php') ?>
<!-- <?php include('../config/constants.php')?> -->


      <!-- Main section starts -->
       <div class="Main-section">
            <div class="Wrapper">
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?><br>  
            <h1>Dashboard</h1>
            <div class="col-4 text-content">
                <?php 
                    $sql = "SELECT * FROM dbl_category";
                    $res = mysqli_query($connection,$sql);
                    if($res){
                        $count= mysqli_num_rows($res);
                        
                    }
                ?>
                <h1><?php echo $count;?></h1> <br>
                <p>Categories</p>
            </div>
            <div class="col-4 text-content">
                <?php 
                    $sql2="SELECT * FROM dbl_food";
                    $res2=mysqli_query($connection,$sql2);
                    if($res2){
                        $count2 = mysqli_num_rows($res2);
                    }
                ?>
                <h1><?php echo $count2?></h1> <br>
                <p>Food</p>
            </div>
            <div class="col-4 text-content">
                <?php
                    $sql3="SELECT * FROM dbl_order";
                    $res3=mysqli_query($connection,$sql3);
                    if($res3){
                        $count3 = mysqli_num_rows($res3);
                    }
                ?>

                <h1><?php  echo $count3;?></h1> <br>
                <p>Total orders</p>
            </div>
            <div class="col-4 text-content">
                <?php 
                    $sql4= "SELECT SUM(Price) AS Total FROM dbl_order WHERE Status = 'Delivered'";
                    $res4=mysqli_query($connection,$sql4);
                    if($res4){
                        $row= mysqli_fetch_assoc($res4);
                        $Total_revenue=$row['Total'];
                    }
                ?>
                <h1>$<?php echo $Total_revenue?></h1> <br>
                <p>Total Revenue Generated</p>
            </div>
            <div class="clearfix"></div>
            </div>
       </div>
     <!-- Main section end -->
<?php include('partials/Footer.php')?>
     