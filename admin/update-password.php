<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Đổi mật khẩu</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }


        ?>
        <form action="" method="POST">

            <TAble class="tbl-30">
                <tr>
                    <td>Mật khẩu hiện tại:</td>
                    <Td>
                        <input type="password" name="current_password" placeholder="Mật khẩu hiện tai">
                    </Td>
                </tr>
                <tr>
                    <td>Mật khẩu mới:</td>
                    <Td>
                        <input type="password" name="new_password" placeholder="Mật khẩu mới">
                    </Td>
                </tr>
                <tr>
                    <td>Xác nhận mật khẩu mới:</td>
                    <Td>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới">
                    </Td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Thay đổi" class="btn-secondary">
                    </td>
                </tr>
            </TAble>

        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {

    //lay du lieu tu form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    //check id va mat khau hien tai co hay ko
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //thuc hien truy van
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user ton tai va co the  doi pass
            //echo "found";
            //check mat khau moi va xac nhan mat khau moi co giong nhau hay ko
            if ($new_password == $confirm_password) {
                $sql2="UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id
                ";
                $res2=mysqli_query($conn, $sql2);
                if($res2==TRUE){
                    $_SESSION['change-pwd'] = "<div class='success'>Đã thay đổi mật khẩu.</div>";
                    header('location:' . SITEURL . 'admin/manager-admin.php');
                }
                else{
                    $_SESSION['change-pwd'] = "<div class='error'>Thay đổi thất bại. Thử lại sau.</div>";
                    header('location:' . SITEURL . 'admin/manager-admin.php');
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu không khớp. Hãy thử lại.</div>";
                header('location:' . SITEURL . 'admin/manager-admin.php');
            }
        } else {
            //user ko ton tai ko the doi pass
                $_SESSION['user-not-found'] = "<div class='error'>Người dùng không tồn tại.</div>";
                header('location:' . SITEURL . 'admin/manager-admin.php');

        }
    } 
    }


    //doi mat khau neu vuot qua cac dieu kien tren


?>

<?php include('partials/footer.php'); ?>