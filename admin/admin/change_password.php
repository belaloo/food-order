<?php include('../partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php if (isset($_SESSION['not match'])) {
            echo "<div class='error'>" . $_SESSION['not match'] . "</div>";
            unset($_SESSION['not match']);
        } ?>
        <br><br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td><label for="current_password"> Current Password</label></td>
                    <td><input type="text" id="current_password" name="current_password"
                               placeholder="Enter Current Password" required></td>
                </tr>

                <tr>
                    <td><label for="new_password"> New Password</label></td>
                    <td><input type="text" id="new_password" name="new_password"
                               placeholder="Enter New Password" required></td>
                </tr>

                <tr>
                    <td><label for="confirm_password"> Rewrite Password</label></td>
                    <td><input type="text" id="confirm_password" name="confirm_password"
                               placeholder="Rewrite Password" required></td>
                </tr>

                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Change Password" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id = '$id' and password = '$current_password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        if ($new_password == $confirm_password) {
            $sql = "UPDATE tbl_admin SET password = '$new_password' WHERE id = '$id'";
            $change_password_result = mysqli_query($conn, $sql);

            if ($change_password_result) {
                $_SESSION['change_password'] = "<div class='success'>Password Changed Successfully</div>";
            }
            else
            {
                $_SESSION['change_password'] = "<div class='error'>Failed to Change Password</div>";
            }
        } else {
            $_SESSION['not match'] = 'Password did not match';
        }
    } else {
        $_SESSION['404'] = 'User Not Found';
    }
    header('location:' . ADMIN_URL . '/manage_admin.php');
}
?>
<?php include('../partials/footer.php'); ?>
