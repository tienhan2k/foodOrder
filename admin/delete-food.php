<?php
include('./config/constants.php');

if (isset($_GET['id']) and isset($_GET['imagine_name'])) {

    //lay id va ten hinh
    $id = $_GET['id'];
    $imagine_name = $_GET['imagine_name'];
    //remove hinh   
    if ($imagine_name != "") {
        $path = "../images/food/" . $imagine_name;
        $remove = unlink($path);
        if ($remove == false) {
            $_SESSION['upload'] = "<div class='error text-center'>Xoá thất bại. Thử lại sau.</div>";
            header('location:' . SITEURL . 'admin/manager-food.php');
            die(); //stop
        }
    }
    //truy van xoa
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //thuc hien truy van
    $res = mysqli_query($conn, $sql);
    //check truy van da thuc hien dc ko 
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success text-center'>Xoá thành công.</div>";
        header('location:' . SITEURL . 'admin/manager-food.php');
    } else {    
        $_SESSION['delete'] = "<div class='error text-center'>Xoá thất bại. Thử lại sau.</div>";
        header('location:' . SITEURL . 'admin/manager-food.php');
    }
} else {
    $_SESSION['unauthorize'] = "<div class='error text-center'>Hành động không thể thực hiện.</div>";
    header('location:' . SITEURL . 'admin/manager-food.php');
}
?>