<?php 
include('./config/constants.php');
//lay id de xoa
$id=$_GET['id'];   
//truyvan xoa admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//thuc hien truy van
$res=mysqli_query($conn, $sql);
//check truy van thuc hien hay ko
if($res==TRUE)
{
    //successful
   $_SESSION['delete']="<div class='success'>Xoá admin thành công!</div>";
   header("Location:".SITEURL.'admin/manager-admin.php');
}
else{
    //failed
    $_SESSION['delete']="<div class='error'>Xoá admin thất bại. Thử lại sau.</div>";
    header("Location:".SITEURL.'admin/manager-admin.php');
    
}
//quay lai trnag manager va thong bao
?>