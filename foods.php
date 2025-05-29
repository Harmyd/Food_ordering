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



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
<?php
            $sql="SELECT * FROM dbl_food WHERE Active ='Yes'";
            $res=mysqli_query($connection,$sql);
            if($res==true){
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $Title=$row['Title'];
                        $Price=$row['Price'];
                        $Description=$row['Description'];
                        $Image_name=$row['Image_name'];
                        
                            ?>
                               <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                    if($Image_name!==''){
                                        ?>
                                        <img src="images/food/<?php echo $Image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                    }else{
                                        echo "<div class='error'>Image is not available</div>";
                                    }
                                    ?>
                                    </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $Title?></h4>
                                    <p class="food-price">$<?php echo $Price?></p>
                                    <p class="food-detail">
                                        <?php echo $Description?>
                                    </p>
                                    <br>

                                    <a href="order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                </div>
                                </div>

                            <?php
                    }
                }
            }
?>
            <div class="clearfix"></div>  
        </div>

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

    <!-- footer Section Starts Here -->
    <?php include('Partials_front/footer.php')?>
    <!-- footer Section Ends Here -->

</body>
</html>