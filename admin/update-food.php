<?php include('partials/menu.php'); ?>

<?php
if (isset($_GET['id'])) {
    //echo "alo";
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //thuc hien truy van
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['imagine_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
    //dem  hangg de check id co ko
    $count = mysqli_num_rows($res2);
    if ($count == 1) {
        //lay du lieu
        $row = mysqli_fetch_assoc($res2);
    } else {
        //link toi manager category voi  thong bao
        $_SESSION['no-category-found'] = "<div class='error text-center'>Không tìm thấy thể loại nào.</div>";
        header('location:' . SITEURL . 'admin/manager-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manager-category.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật thúc ăn</h1>
        <br><br>
    
<form action="" method="POST" enctype="multipart/form-data">

    <TAble class="tbl-30">

        <tr>
            <td>Tiêu đề: </td>
            <td><input type="text" name="title" placeholder="Nhập tiêu đề" value="<?php echo $title; ?>"></td>

        </tr>
        <tr>
            <td>Mô tả: </td>
            <td>
                <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
            </td>

        </tr>
        <tr>
            <td>Giá: </td>
            <td><input type="number" name="price" value="<?php echo $price; ?>">
            </td>
        </tr>
        <tr>
            <td>Hình ảnh hiện tại: </td>
            <td>
                <?php
                if ($current_image == "") {
                    //hien thi hinh anh
                    echo "<div class='error'>Chưa thêm ảnh.</div>";
                } else {
                    //thong bao chua them hinh
                ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                <?php

                }
                ?>
            </td>

        </tr>
        <tr>
            <td>Hình ảnh mới: </td>
            <td><input type="file" name="image">
            </td>

        </tr>
        <tr>
            <td>Thể loại:</td>
            <td>
                <select name="category">

                    <?php
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $category_title = $row['title'];
                            $category_id = $row['id'];
                            //echo "<option value='$category_id'>$category_title</option>";
                    ?>
                            <option <?php if($current_category==$category_id){echo "Đã chọn.";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                    <?php
                        }
                    } else {
                        echo "<option value='0'>Không có thể loại nào.</option>";
                    }
                    ?>

                    <option value="0"></option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Đặc tính: </td>
            <td><input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes">Có
                <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No">Không
            </td>
        </tr>
        <tr>
            <td>Hoạt động: </td>
            <td><input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes">Có
                <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">Không
            </td>
        </tr>
        <tr>

            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Cập nhật" class="btn-secondary">
            </td>
        </tr>
    </TAble>

</form>
<?php
 if (isset($_POST['submit'])) {
     //lay gia tri tu form
     $id = $_POST['id'];
     $title = $_POST['title'];
     $description=$_POST['description'];
     $price=$_POST['price'];
     $current_image = $_POST['current_image'];
     $category=$_POST['category'];
     $featured = $_POST['featured'];
     $active = $_POST['active'];
     //up hinh moi
     //check xem da chon dc hinh chua
     if (isset($_FILES['image']['name'])) {
         //lay chi tiet  hinh anh
         $imagine_name = $_FILES['image']['name'];
         if ($imagine_name != "") {
             //up hinh moi
             $ext = end(explode('.', $imagine_name));
             //doi ten hinh anh
             $imagine_name = "Food_Name_" . rand(0000, 9999) . '.' . $ext; //vd: Food_Category_656.
             $src_path = $_FILES['image']['tmp_name'];
             $dest_path = "../images/food/" . $imagine_name;
             $upload = move_uploaded_file($src_path, $dest_path);
             //check xem thu anh dc tai len chua
             //neu ko tai dc hien thi thong bao loi
             if ($upload == false) {
                 $_SESSION['upload'] = "<div class='error text-center'>Không tải được ảnh.</div>";
                 header('location:' . SITEURL . 'admin/manager-food.php');
                 //dung tai len
                 die();
             }
             //remove anh hien tai
             if($current_image!=""){
                 $remove_path="../images/food/".$current_image;
                 $remove=unlink($remove_path);
                 if($remove==false){
                     $_SESSION['failed-remove']="<div class='error text-center'>Không thể xoá ảnh hiện tại. Thử lại sau.</div>";
                     header('location:'.SITEURL.'admin/manager-food.php');
                     die();//dung qua trinh
                 }
             }
             
         } else {
             $imagine_name = $current_image;//mac dinh neu hinh ko dc chon
         }
     } else {
         $imagine_name = $current_image;
     }
     //update db
     $sql3 = "UPDATE  tbl_food SET
         title='$title',
         description='$description',
         price='$price',
         imagine_name='$imagine_name',
         category_id='$category',
         featured='$featured',
         active='$active'
         WHERE id=$id
         ";
     //thuc hien truy van
     $res3 = mysqli_query($conn, $sql3);
     //link ve manager  category

     if ($res3 == true) {
         //uploader
         $_SESSION['update'] = "<div class='success text-center'>Cập nhập thức ăn thành công.</div>";
         header('location:' . SITEURL . 'admin/manager-food.php');
     } else {
         //failed to up
         $_SESSION['update'] = "<div class='error text-center'>Cập nhập thức ăn thất bại. Thử lại sau.</div>";
         header('location:' . SITEURL . 'admin/manager-food.php');
     }
 }
 ?>


</div>
</div>
<?php include('partials/footer.php'); ?>