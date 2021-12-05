<?php include('partials-front/menu.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <?php
        //lay search keyword
        $search = $_POST['search'];

        ?>

        <h2>Có phải bạn đang tìm <a href="#" class="text-white">"<?php echo $search; ?>"?</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        //truy van
        $sql = "SELECT *FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        //thuc hien truy van
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
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

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php

            }
        } else {
            echo "<div class='error'>Không tìm thấy đồ ăn nào.</div>";
        }

        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>