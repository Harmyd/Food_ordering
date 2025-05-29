
<?php include('Partials_front/menu.php')?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php 
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql= "SELECT * FROM dbl_category WHERE Active = 'Yes' AND Featured='Yes' LIMIT 3";
                $res= mysqli_query($connection,$sql);
                if($res==true){
                    $count=mysqli_num_rows($res);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $image_name=$row['Image_name'];
                            $Title=$row['Title'];
                        if($image_name!==''){
                            ?>
                            <a href="category-foods.php?Category_id=<?php echo $id?>">
                                <div class="box-3 float-container">
                                <img src="images/Category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                                <h3 class="float-text text-white"><?php echo $Title?></h3>
                                </div>
                            </a>
                        <?php
                        }else{
                            echo "<div class='error'>Image is not available</div>";
                        }
                            

                            
                        }
                    }
                }
            ?>

            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
        <?php 
            $Sql2="SELECT * FROM dbl_food WHERE Active='Yes' AND Featured ='Yes'";
            $res2= mysqli_query($connection,$Sql2);
                if($res2==true){
                    $count2=mysqli_num_rows($res2);
                    if($count2>0){
                        while($row2=mysqli_fetch_assoc($res2)){
                            $Id=$row2['id'];
                            $TITLE=$row2['Title'];
                            $Price=$row2['Price'];
                            $Description=$row2['Description'];
                            $image_name2=$row2['Image_name'];
                            ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name2!==''){
                                    ?>
                                    <img src="images/food/<?php echo $image_name2?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }else{
                                    echo "<div class = 'error'>Image is not available</div>";
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $TITLE;?></h4>
                            <p class="food-price">$<?php echo $Price?></p>
                            <p class="food-detail">
                               <?php echo $Description?>
                            </p>
                            <br>

                            <a href="order.php?food_id=<?php echo $Id?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                            <?php
                        }
                    }else{
                        echo "Food is not available";
                    }

                }
                   
        ?>

            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

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
<?php include('Partials_front/footer.php');?>
</body>
</html>