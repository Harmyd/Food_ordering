<?php include('Partials_front/menu.php')?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php $Search=$_POST['search'];?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $Search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                if(isset($_POST['submit'])){
                    $Search = $_POST['search'];
                    
                    $Sql="SELECT * FROM dbl_food WHERE Title LIKE '%$Search%' OR Description LIKE '%$Search%'";
                    $query = mysqli_query($connection,$Sql);
                    if($query==true){
                        $count = mysqli_num_rows($query);
                        if($count>0){
                            while($row=mysqli_fetch_assoc($query)){
                                $id= $row['id'];
                                $Title=$row['Title'];
                                $Description=$row['Description'];
                                $Price=$row['Price'];
                                $Image_name=$row['Image_name'];
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
                                    echo "<div class ='error'>Image is not available</div>";
                                }
                            ?>
                           

                        <div class="food-menu-desc">
                            <h4><?php echo $Title;?></h4>
                            <p class="food-price">$<?php echo $Price;?></p>
                            <p class="food-detail">
                               <?php echo $Description;?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                        </div>
                        <?php
                            }
                        }
                    }else{
                        echo "<div class = 'error'>Food is not found;</div>";
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