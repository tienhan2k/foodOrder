<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật Admin</h1>
        <br><br>
        <?php
        //lay id de chon admin
        $id = $_GET['id'];
        //truy van lay thong tin     admin
        $sql = "SELECT * FROM tbl_admin  WHERE id=$id";
        //thuc hien truy van
        $res = mysqli_query($conn, $sql);
        //check xem truy van co thuc hien hay ko
        if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            //check xem co data  admin or not
            if ($count == 1) {
                //lay chi tiet
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //failed
                header('Location:' . SITEURL . 'admin/manager-admin.php');
            }
        }
        ?>
        <form action="" method="POST">

            <TAble class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>

                </tr>
                <tr>
                    <td>Tài khoản: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>

                </tr>
            </TAble>

        </form>
    </div>
</div>
<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //tao truy van update 
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username' 
    WHERE id='$id'   
    ";
    //thuc hien truy van
    $res = mysqli_query($conn, $sql);
    //check truy van chay duoc ko
    if ($res == TRUE) {
        $_SESSION['update'] = "<div class='success'>Cập nhật thành công!</div>";
        header('location:' . SITEURL . 'admin/manager-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Cập nhật thất bại. Vui lòng thử lại sau!</div>";
        header('location:' . SITEURL . 'admin/manager-admin.php');
    }
}

?>
<?php include('partials/footer.php'); ?>