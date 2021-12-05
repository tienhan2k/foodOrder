<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý thức ăn</h1>

        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];   
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
         ?><br><br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Thêm thức ăn</a>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Đặc tính</th>
                <th>Hoạt động</th>
                <th>Hành động</th>
            </tr>
            <?php
            //tao truy van lay do an
            $sql = "SELECT * FROM  tbl_food";
            //thuc  hien truy van
            $res = mysqli_query($conn, $sql);
            //
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                //co du lieu trong db
                //lay foods trong db va display
                while ($row = mysqli_fetch_assoc($res)) {
                    //
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $imagine_name = $row['imagine_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php
                            if ($imagine_name == "") {
                                echo "<div class='error'>Chưa thêm ảnh.</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $imagine_name ?>" width="100px">

                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&imagine_name=<?php echo $imagine_name; ?>" class="btn-secondary">Cập nhập</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&imagine_name=<?php echo $imagine_name; ?>" class="btn-danger">Xóa</a>
                        </td>
                    </tr>
            <?php


                }
            } else {

                echo "<tr><td colspan='7' class='error'>Chưa thêm đồ ăn.</td></tr>";
            }

            ?>


        </table>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>