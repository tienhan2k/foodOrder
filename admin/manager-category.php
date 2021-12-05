<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Các thể loại</h1>

        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?><br><br>
        
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Thêm thể loại</a>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Đặc tính</th>
                <th>Hoạt động</th>
                <th>Hành động</th>
            </tr>
            <?php
            //truy van lay du lieu category tu db
            $sql = "SELECT * FROM tbl_category";
            //thuc hien truy van
            $res = mysqli_query($conn, $sql);
            //dem hang
            $count = mysqli_num_rows($res);
           
            //tao so thu tu
            $sn = 01;
             //check xem co du lieu trong db hay ko
            if ($count > 0) {
                //lay data va display
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $imagine_name = $row['imagine_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php

                            if ($imagine_name != "") {
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $imagine_name; ?>" width="200px">

                            <?php
                            } else {
                                echo "<div class='error'>Chưa thêm ảnh.</div>";
                            }

                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Cập nhập</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&imagine_name=<?php echo $imagine_name;?>" class="btn-danger">Xoá</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error text-center">Không có thể loại nào để thêm.</div>
                    </td>
                </tr>
            <?php
            }

            ?>


        </table>
        <div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>