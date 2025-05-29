<?php include('Partials_front/menu.php')?>
    <!-- Navbar Section Ends Here -->
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sql="SELECT * FROM dbl_category WHERE Active = 'YES' ";
                $Result = mysqli_query($connection,$sql);
                if($Result==true){
                    $count=mysqli_num_rows($Result);
                    if($count>0){
                        while($Row = mysqli_fetch_assoc($Result)){
                            $id=$Row['id'];
                            $Title=$Row['Title'];
                            $Image_name=$Row['Image_name'];
                            if($Image_name!==''){
                                ?>
                                    <a href="category-foods.php?Category_id=<?php echo $id?>">
                                        <div class="box-3 float-container">
                                        <img src="images/Category/<?php echo $Image_name?>" alt="Pizza" class="img-responsive img-curve">

                                        <h3 class="float-text text-white"><?php echo $Title?></h3>
                                        </div>
                                    </a>
                                <?php
                            }else{
                                echo "Image is not available";
                            }
                        }
                    }
                }
            ?>

            


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


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