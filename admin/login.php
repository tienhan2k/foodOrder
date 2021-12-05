<?php
include('./config/constants.php');
?>
<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="admin.css">

<body>

    <Div class="login">
        <h1 class="text-center">Đăng nhập</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //hien thi thong bao dang nhap thanh cong  
            unset($_SESSION['login']); //bo hien thi thong bao dang nhap
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message']; //hien thi thong bao dang nhap thanh cong  
            unset($_SESSION['no-login-message']); //bo hien thi thong bao dang nhap
        }
        ?>
        <br>
        <form action="" method="POST" class="text-center">
            Tài khoản: <br>
            <Input type="text" name="username" placeholder="Nhập tài khoản"> <br><br>
            Mật khẩu:<br>
            <Input type="password" name="password" placeholder="Nhập mật khẩu"><br><br>
            <Input type="submit" name="submit" value="Đăng nhập" class="btn-primary">
            <br><br>
        </form>
        <p class="text-center">Được tạo bởi - <a href="#">Nguyễn Văn Tiến</a></p>
    </Div>
</body>
</head>

</html>
<?php
if (isset($_POST['submit'])) {
    //lay du lieu tu form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //sql de check xem pass and acc co match voi username voi pass and co ton tai hay ko
    $sql = "SELECT*FROM tbl_admin WHERE username='$username' AND password='$password'";
    //thuc hien cau lenh truy van
    $res = mysqli_query($conn, $sql);
    //dem hang de check user ton tai or not
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>Đăng nhập thành công!</div>";
        $_SESSION['user'] = $username;

        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Đăng nhập thất bại. Hãy thử lại.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>