<?php include('Partials_front/menu.php')?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                if(isset($_GET['Category_id'])){
                    $Category_id=$_GET['Category_id'];

                    $sql="SELECT Title FROM dbl_category WHERE id = '$Category_id'";
                    $Query=mysqli_query($connection,$sql);
                    if($Query==true){
                        $count=mysqli_num_rows($Query);
                        if($count>0){
                            $row=mysqli_fetch_assoc($Query);
                            $Title=$row['Title'];
                        }
                    }
                }
                
            ?>
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $Title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php 
            $sql2="SELECT * FROM dbl_food WHERE Category_id = '$Category_id'";
            $res=mysqli_query($connection,$sql2);
            if($res==true){
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($Row=mysqli_fetch_assoc($res)){
                        $title=$Row['Title'];
                        $Price=$Row['Price'];
                        $Description=$Row['Description'];
                        $Image_name=$Row['Image_name'];
                        ?>
            <div class="food-menu-box">
                <?php
                    if($Image_name!==''){
                        ?>

                        <div class="food-menu-img">
                        <img src="images/food/<?php echo $Image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <?php
                    }else{
                        echo "<div class='error'>Image is not available</div>";
                    }
                ?>
                <div class="food-menu-desc">
                    <h4><?php echo $title?></h4>
                    <p class="food-price">$<?php echo $Price?></p>
                    <p class="food-detail">
                    <?php echo $Description?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
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