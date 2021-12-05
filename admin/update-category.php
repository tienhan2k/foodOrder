<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật thể loại</h1>
        <br><br>
        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?><br><br>
        <?php
        if (isset($_GET['id'])) {
            //echo "alo";
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            //thuc hien truy van
            $res = mysqli_query($conn, $sql);
            //dem  hangg de check id co ko
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //lay du lieu
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['imagine_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //link toi manager category voi  thong bao
                $_SESSION['no-category-found'] = "<div class='error text-center'>Không tìm thấy thể loại nào.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manager-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <TAble class="tbl-30">

                <tr>
                    <td>Tiêu đề: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>

                </tr>
                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //hien thi hinh anh
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            //thong bao chua them hinh
                            echo "<div class='error'>Chưa thêm ảnh.</div>";
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
            $current_image = $_POST['current_image'];
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
                    $imagine_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //vd: Food_Category_656.
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $imagine_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check xem thu anh dc tai len chua
                    //neu ko tai dc hien thi thong bao loi
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error text-center'>Không tải được ảnh.</div>";
                        header('location:' . SITEURL . 'admin/manager-category.php');
                        //dung tai len
                        die();
                    }
                    //remove anh hien tai
                    if($current_image!=""){
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);
                        if($remove==false){
                            $_SESSION['failed-remove']="<div class='error text-center'>Không thể xoá ảnh hiện tại. Thử lại sau.</div>";
                            header('location:'.SITEURL.'admin/manager-category.php');
                            die();//dung qua trinh
                        }
                    }
                    
                } else {
                    $imagine_name = $current_image;
                }
            } else {
                $imagine_name = $current_image;
            }
            //update db
            $sql2 = "UPDATE  tbl_category SET
                title='$title',
                imagine_name='$imagine_name',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";
            //thuc hien truy van
            $res2 = mysqli_query($conn, $sql2);
            //link ve manager  category

            if ($res2 == true) {
                //uploader
                $_SESSION['update'] = "<div class='success text-center'>Cập nhập thể loại thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            } else {
                //failed to up
                $_SESSION['update'] = "<div class='error text-center'>Cập nhập thể loại thất bại. Thử lại sau.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>