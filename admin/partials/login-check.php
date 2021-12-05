<?php

if(!isset($_SESSION['user']))
{

    $_SESSION['no-login-message']="<div class='error text-center'>Hãy đăng nhập bằng tài khoản Admin.</div>";
    header('location:'.SITEURL.'admin/login.php');
}

?>  