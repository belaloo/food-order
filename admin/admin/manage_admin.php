<?php include('../partials/menu.php') ?>
    <!--start content section-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>
            <?php if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['404'])) {
                echo $_SESSION['404'];
                unset($_SESSION['404']);
            }
            if (isset($_SESSION['change_password'])) {
                echo $_SESSION['change_password'];
                unset($_SESSION['change_password']);
            }
            ?>
            <br><br>
            <a class="btn btn-primary" href="../admin/add_admin.php"> Create new admin </a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($res)) {

                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];

                        ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo ADMIN_URL; ?>/change_password.php?id=<?php echo $id ?>"
                                   class="btn btn-primary">Change Password</a>
                                <a href="<?php echo ADMIN_URL; ?>/update_admin.php?id=<?php echo $id ?>"
                                   class="btn btn-secondary"> Update</a>
                                <a href="<?php echo ADMIN_URL; ?>/delete-admin.php?id=<?php echo $id ?>"
                                   class="btn btn-danger"> Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                }
                ?>

            </table>

        </div>
    </div>
    <!--end content section-->
<?php include('../partials/footer.php') ?>