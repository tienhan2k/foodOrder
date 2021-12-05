<?php include('partials-front/menu.php'); ?>
<?php

if (isset($_GET['category_id'])) {
    //lay id
    $category_id = $_GET['category_id'];
    //lay title phu thuoc vao id
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    //thuc hien truy van
    $res = mysqli_query($conn, $sql);
    //lay gia tritu db
    $row = mysqli_fetch_assoc($res);
    //lay title
    $category_title = $row['title'];
} else {
    header('location:' . SITEURL);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Các loại đồ ăn trong <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu</h2>
        <?php
        //tao  truy van de display thuc an tu db   
        $sql2 = "SELECT *FROM tbl_food  WHERE category_id=$category_id";
        //thuc hien  truy  van
        $res2 = mysqli_query($conn, $sql2);
        //dem hang de check coi the loai co hay ko
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            //co the loai
            while ($row2 = mysqli_fetch_assoc($res2)) {
                //lay id, title, imagine name
                $id=$row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $imagine_name = $row2['imagine_name'];
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

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<div class='error'>Hiện tại không có thức ăn nào.</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>