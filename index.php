<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm..." required>
            <input type="submit" name="submit" value="Tìm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
        if (isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Khám phá</h2>
        <?php
        //tao  truy van de display the loai tu db   
        $sql = "SELECT *FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        //thuc hien  truy  van
        $res = mysqli_query($conn, $sql);
        //dem hang de check coi the loai co hay ko
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //co the loai
            while ($row = mysqli_fetch_assoc($res)) {
                //lay id, title, imagine name
                $id = $row['id'];
                $title = $row['title'];
                $imagine_name = $row['imagine_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //check xem co hinh anh hay ko
                        if ($imagine_name == "") {
                            //hien thi thong bao
                            echo "<div class='error'>Không có hình ảnh nào.</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $imagine_name; ?>" class="img-responsive img-curve">
                        <?php
                        }

                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>

        <?php
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
        <h2 class="text-center">Menu</h2>


        <?php
        $sql2 = "SELECT*FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row = mysqli_fetch_assoc($res2)) {
                //lay id, title, imagine name
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $imagine_name = $row['imagine_name'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                    <?php
                        //check xem co hinh anh hay ko
                        if ($imagine_name == "") {
                            //hien thi thong bao
                            echo "<div class='error'>Không có hình ảnh nào.</div>";
                        } else {

                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $imagine_name; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?> Đồng</p>
                        <p class="food-detail">
                        <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt hàng</a>
                    </div>
                </div>
        <?php


            }
        } else {
            echo "<div class='error'>Không có thức ăn nào. Vui lòng đợi.</div>";
        }

        ?>


        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>