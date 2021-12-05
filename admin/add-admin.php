<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Admin</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//hien thi thong bao them admin successful
            unset($_SESSION['add']);//bo hien thi thong bao them admin successful
        }
        ?>
        <br><br>
        <form action="" method="POST">

            <TAble class="tbl-30">
                <tr>
                    <td>Họ và tên: </td>
                    <td><input type="text" name="full_name" placeholder="Nhap ten cua ban"></td>

                </tr>
                <tr>
                    <td>Tài khoản: </td>
                    <td><input type="text" name="username" placeholder="Nhap tai khoan"></td>

                </tr>
                <tr>
                    <td>Mật khẩu: </td>
                    <td><input type="password" name="password" placeholder="Nhap mat khau"></td>

                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary" ></td>

                </tr>
            </TAble>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

if (isset($_POST['submit'])) {
    //clicked
    //get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //ma hoa pass md5   
    //query to save data into database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
";
    //execute query and save data into db
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    
    //check the data is inserted or not and display message
    if ($res==TRUE) {
        //echo "da insert du lieu";
        $_SESSION['add']="Thêm Admin thành công!";
        header("Location:".SITEURL.'admin/manager-admin.php');
    } else {
        //echo "ko the  insert du lieu";
        $_SESSION['add']="Thêm Admin thất bại! Thử lại sau.";
        header("location:".SITEURL.'admin/add-admin.php');//xem lại
    }
}
?>
