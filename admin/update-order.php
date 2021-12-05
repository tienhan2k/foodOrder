<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật đơn hàng</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            //echo "alo";
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            //thuc hien truy van
            $res = mysqli_query($conn, $sql);
            //dem  hangg de check id co ko
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //lay du lieu
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            } else {
                //link toi manager category voi  thong bao
                $_SESSION['no-category-found'] = "<div class='error text-center'>Không tìm thấy đơn hàng nào.</div>";
                header('location:' . SITEURL . 'admin/manager-order.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manager-order.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tên</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Giá</td>
                    <td>
                        <b><?php echo $price; ?> Đồng</b>
                    </td>
                </tr>
                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Đã đặt hàng") {
                                        echo "selected";
                                    } ?> value="Đã đặt hàng">Đã đặt hàng</option>
                            <option <?php if ($status == "Đang giao") {
                                        echo "selected";
                                    } ?> value="Đang giao">Đang giao</option>
                            <option <?php if ($status == "Đã nhận") {
                                        echo "selected";
                                    } ?> value="Đã nhận">Đã nhận</option>
                            <option <?php if ($status == "Đã huỷ") {
                                        echo "selected";
                                    } ?> value="Đã huỷ">Đã huỷ</option>
                        </select>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Tên KH</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>SĐT</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
                </td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            //lay gia tri tu form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
            //cap nhat gia tri
            $sql2 = "UPDATE tbl_order SET 
            qty=$qty,
            total=$total,
            status='$status',
            customer_name='$customer_name',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
            WHERE id=$id
            ";
            //thuc hien truyvan
            $res2 = mysqli_query($conn, $sql2);
            //checkcoi da update chua
            //link toi manager-oder
            if ($res2 == true) {
                //uploader
                $_SESSION['update'] = "<div class='success text-center'>Cập nhập đơn hàng thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-order.php');
            } else {
                //failed to up
                $_SESSION['update'] = "<div class='error text-center'>Cập nhập đơn hàng thất bại. Thử lại sau.</div>";
                header('location:' . SITEURL . 'admin/manager-order.php');
            }
        }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>