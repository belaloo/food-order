<?php include('../partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <?php if (isset($_SESSION['unique'])) {
            echo '<br>' . $_SESSION['unique'];
            unset($_SESSION['unique']);
        } ?>

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else
                header('location:' . SITE_URL . 'admin/admin/manage_admin.php');
        }
        ?>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td><label for="full_name"> Full Name</label></td>
                    <td><input type="text" id="full_name" name="full_name" value="<?php echo $full_name ?>"
                               placeholder="Enter Name" required></td>
                </tr>

                <tr>
                    <td><label for="username"> User Name</label></td>
                    <td><input type="text" id="username" name="username" value="<?php echo $username ?>"
                               placeholder="Enter Username" required></td>
                </tr>

                <input type="hidden" name="id" value="<?php echo $id ?>">
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>
<?php include('../partials/footer.php') ?>

<?php
if (isset($_POST['submit'])) {
//    Get Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $id = $_POST['id'];
//Check if Username is Exist
    $check_user_name_sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
    $check_user_name_res = mysqli_query($conn, $check_user_name_sql) or die(mysqli_error());

    if ($check_user_name_res and mysqli_num_rows($check_user_name_res) > 1) {
        $_SESSION['unique'] = "<div class='error'> Username Must Be Unique, Try another one </div>";
        header('location');
    } else {


//    Sql query
        $sql = "update tbl_admin set full_name='$full_name',username='$username' where id=$id";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res == TRUE) {
            $_SESSION['update'] = "<div class='success'> Admin Updated Successfully </div>";
            header('location:' . SITE_URL . 'admin/admin/manage_admin.php');
        } else {
            $_SESSION['add'] = "<div class='error'> Failed to Updated Admin: $full_name </div>";
            header('update:' . SITE_URL . 'admin/admin/update_admin.php');
        }

    }
}


?>
