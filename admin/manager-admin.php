<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Tài khoản Admin</h1>

        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //hien thi thong bao them admin successful
            unset($_SESSION['add']); //bo hien thi thong bao them admin 
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //hien thi thong bao xoa admin successful
            unset($_SESSION['delete']); //bo hien thi thong bao xoa admin 
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //hien thi thong bao cap nhat admin successful
            unset($_SESSION['update']); //bo hien thi thong bao cap nhat admin 
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; 
            unset($_SESSION['user-not-found']); 
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match']; 
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; 
            unset($_SESSION['change-pwd']); 
        }
        ?>
        <br><br>
        <a href="add-admin.php" class="btn-primary">Thêm Admin</a>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Tài khoản</th>
                <th>Hành động</th>
            </tr>

            <?php
            //Truy van get all admin
            $sql = "SELECT * FROM tbl_admin";
            //thuc hien query
            $res = mysqli_query($conn, $sql);
            //kiem tra truy van co dc thuc hien hay ko
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                $sn = 01;
                if ($count > 0) {
                    //co du lieu trong db
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //dung vong lap while de lay tat ca db, chay den khi nao het db thi thoi
                        //lay du lieu ca nhan
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        //hien thi ra bang
            ?>
                        <tr>
                            <td><?php echo $sn++; ?> </td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi mật khẩu</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xoá</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            } else {
            }



            ?>


        </table>

        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>