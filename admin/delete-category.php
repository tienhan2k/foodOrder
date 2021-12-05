<?php
include('./config/constants.php');

if (isset($_GET['id']) and isset($_GET['imagine_name'])) {

    //echo "aloalo";
    //lay gia tri de xoa
    $id = $_GET['id'];
    $imagine_name = $_GET['imagine_name'];
    if ($imagine_name != "") {
        $path = "../images/category/" . $imagine_name;
        //remove hinh
        $remove = unlink($path);
        if($remove==false){
            //thong bao that bai
            $_SESSION['remove']="<div class='error text-center'>Không thể xoá thể loại này. Thử lại sau.</div>";
            //link ve manager category
            header('location:'.SITEURL.'admin/manager-category.php');
            //dung
            die();
        }
    }
    //xoa du lieu trong db
    $sql="DELETE FROM tbl_category WHERE id=$id";
    //chay truy van
    $res=mysqli_query($conn, $sql);
    //check xem data da dc xoa khoi db chua
    if($res==true){
        //thong bao thanh cong
        $_SESSION['delete']="<div class='success text-center'>Xoá thể loại thành công.</div>";
        //link ve manager category
        header('location:'.SITEURL.'admin/manager-category.php');

    }
    else{
          //thong bao that bai
          $_SESSION['delete']="<div class='error text-center'>Xoá thể loại thất bại. Thử lại sau.</div>";
          //link ve manager category
          header('location:'.SITEURL.'admin/manager-category.php');

    }
} else {

    header('location:' . SITEURL . 'admin/manager-category.php');
}
