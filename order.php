<?php include('partials-front/menu.php'); ?>
<?php

if (isset($_GET['food_id'])) {
    //lay id
    $food_id = $_GET['food_id'];
    //lay title phu thuoc vao id
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //thuc hien truy van
    $res = mysqli_query($conn, $sql);
    //lay gia tritu db
    $count = mysqli_num_rows($res);
    //check
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $imagine_name = $row['imagine_name'];
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Điền thông tin để xác nhận đơn hàng:</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Chọn loại đồ ăn</legend>

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
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price"><?php echo $price; ?> Đồng</p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Số lượng</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Thông tin chi tiết</legend>
                <div class="order-label">Tên</div>
                <input type="text" name="full-name" placeholder="VD: Nguyen Van Tien" class="input-responsive" required>

                <div class="order-label">Số điện thoại</div>
                <input type="tel" name="contact" placeholder="VD: 0123456789" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="VD: abc@gmail.com" class="input-responsive" required>

                <div class="order-label">Địa chỉ</div>
                <textarea name="address" rows="10" placeholder="VD: so nha, ten duong, ten phuong,..." class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Xác nhận" class="btn btn-primary">
            </fieldset>

        </form>
        <?php

        if (isset($_POST['submit'])) {

            //lay data tu form
            $food = $_POST['food'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Đã đặt hàng";
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
            //tai hinh anh len neu no duoc chon
            //luu vao db
            //truy van
            $sql2 = "INSERT INTO tbl_order SET
    food='$food',
    qty='$qty',
    price='$price',
    total='$total',
    order_date='$order_date',
    status='$status',
    customer_name='$customer_name',
    customer_contact='$customer_contact',
    customer_email='$customer_email',
    customer_address='$customer_address'
    ";
            //echo $sql2; die();
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['order'] = "<div class='success text-center'>Đặt hàng thành công. Xin chúc mừng!</div>";
                header('location:' . SITEURL);
            } else {
                $_SESSION['order'] = "<div class='error text-center'>Đặt hàng thất bại. Xin vui lòng thử lại!</div>";
                header('location:' . SITEURL);
            }
        }

        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>