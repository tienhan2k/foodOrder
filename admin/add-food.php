<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý thức ăn</h1>

        <br /><br />
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>

                    <td>Tiêu đề:</td>
                    <td>
                        <input type="text" name="title" placeholder="Tiêu đề">
                    </td>
                </tr>
                <tr>
                    <td>Miêu tả:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Mô tả thức ăn"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Giá:</td>
                    <td> <input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Chọn hình:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Thể loại:</td>
                    <td><select name="category">
                            <?php
                            //tao code display category tu db
                            //tao truy van
                            $sql = "SELECT *FROM tbl_category WHERE active='Yes'";
                            //chay truy van
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            //
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">Không tìm thấy thể loại nào.</option>
                            <?php
                            }

                            ?>

                        </select></td>
                </tr>
                <tr>
                    <td>Thể loại:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Có
                        <input type="radio" name="featured" value="No">Không
                    </td>
                </tr>
                <tr>
                    <td>Hoạt động:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Có 
                        <input type="radio" name="active" value="No">Không
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Thêm" class="btn-secondary"></td>

                </tr>


            </table>

        </form>
        <?php

        if (isset($_POST['submit'])) {

            //lay data tu form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //tai hinh anh len neu no duoc chon
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            //up anh len neu dc chon
            if (isset($_FILES['image']['name'])) {
                //lay chi tiet cua anh dc chon
                $imagine_name = $_FILES['image']['name'];
                if ($imagine_name != "") {
                    //hinh da dc chon
                    //doi ten
                    //lay cai extension 
                    $ext = end(explode('.', $imagine_name));
                    //tao ten moi
                    $imagine_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
                    //upload hinh
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $imagine_name;
                    $upload = move_uploaded_file($src, $dst);
                    //check  da up chua
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Tải ảnh thất bại.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        //stop
                        die();
                    }
                }
            } else {
                $imagine_name = ""; //set default
            }
            //insert vo db
            //tao truy van de luu va add food
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price='$price',
            imagine_name='$imagine_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            ";
            //thuc hientruy van
            $res2=mysqli_query($conn, $sql2);

            //check data da insert chua
            if($res2==true){

                $_SESSION['add']="<div class='success'>Thêm thức ăn thành công.</div>";
                header('location:'.SITEURL.'admin/manager-food.php');
            }else{
                $_SESSION['add']="<div class='error'>Thêm thức ăn thất bại. Thử lại sau.</div>";
                header('location:'.SITEURL.'admin/manager-food.php');
            }

            //link  toi manager food voi thong bao

        }

        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>