<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Các thể loại</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?><br><br>
        <form action="" method="POST" enctype="multipart/form-data">

            <TAble class="tbl-30">

                <tr>
                    <td>Tiêu đề: </td>
                    <td><input type="text" name="title" placeholder="Nhập tiêu đề"></td>

                </tr>
                <tr>
                    <td>Hình ảnh: </td>
                    <td><input type="file" name="image"></td>

                </tr>
                <tr>
                    <td>Đặc tính: </td>
                    <td><input type="radio" name="featured" value="yes">Có
                        <input type="radio" name="featured" value="no">Không
                    </td>

                </tr>
                <tr>
                    <td>Hoạt động: </td>
                    <td><input type="radio" name="active" value="yes">Có
                        <input type="radio" name="active" value="no">Không
                    </td>

                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Thêm thể loại" class="btn-secondary"></td>

                </tr>
            </TAble>

        </form>
        <?php
        if (isset($_POST['submit'])) {
            //echo "clicked";
            //get data from form
            $title = $_POST['title'];
            //for radio input, check radio da dc select chua
            if (isset($_POST['featured'])) {
                //lay gia tri tu form
                $featured = $_POST['featured'];
            } else {
                //neu chưa, set gia tri mac dinh
                $featured = 'No';
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = 'No';
            }
            //print_r($_FILES['image']);
            //die();
            if (isset($_FILES['image']['name'])) {
                //tai hinh anh len
                $imagine_name = $_FILES['image']['name'];
                //chon hinh anh roi moi up dc
                if ($imagine_name != "") {
                    //lay extension cua anh (jpg, png,...) vd: abc.jpg
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
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //dung tai len
                        die();
                    }
                }
            } else {
                //ko upload anh
                $imagine_name = "";
            }



            //tao truy van de insert category vo db
            $sql = "INSERT INTO tbl_category SET

            title='$title',
            imagine_name='$imagine_name',
            featured='$featured',
            active='$active'
        ";
            //thuc hien truy van va save vao db
            $res = mysqli_query($conn, $sql);

            //check truy van co chay dc hay ko va data co dc them vao chua
            if ($res == true) {
                $_SESSION['add'] = "<div class='success text-center'>Thêm thể loại thành công.</div>";
                header('location:' . SITEURL . 'admin/manager-category.php');
            } else {
                $_SESSION['add'] = "<div class='error text-center'>Thêm thể loại thất bại. Thử lại sau.</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>