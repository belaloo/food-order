<?php include('../partials/menu.php') ?>
    <!--start content section-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Categories</h1>
            <br>
            <?php if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                echo "<br>";
            } ?>
            <a class="btn btn-primary" href="<?php echo Category_URL . '/add_category.php' ?>"> Create new Category </a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($res)) {

                        $id = $row['id'];
                        $title = $row['title'];
                        $image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'] ? "Yes" : "No";

                        ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $title ?></td>
                            <td><img src="<?php echo SITE_URL ?>images/category/<?php echo $image ?>" class="avatar"></td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>

                                <a href="<?php echo ADMIN_URL; ?>/update_admin.php?id=<?php echo $id ?>"
                                   class="btn btn-secondary"> Update</a>
                                <a href="<?php echo ADMIN_URL; ?>/delete-admin.php?id=<?php echo $id ?>"
                                   class="btn btn-danger"> Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center error">
                            <div> No Category Added</div>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        </div>
    </div>
    <!--end content section-->
<?php include('../partials/footer.php') ?>