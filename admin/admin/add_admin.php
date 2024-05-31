<?php include('../partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        } ?>
        <?php if (isset($_SESSION['unique'])) {
            echo $_SESSION['unique'];
            unset($_SESSION['unique']);
        } ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td><label for="full_name"> Full Name</label></td>
                    <td><input type="text" id="full_name" name="full_name" placeholder="Enter Name" required></td>
                </tr>

                <tr>
                    <td><label for="username"> User Name</label></td>
                    <td><input type="text" id="username" name="username" placeholder="Enter Username" required></td>
                </tr>

                <tr>
                    <td><label for="password"> Password</label></td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password" id="password" required>
                    </td>
                </tr>

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
    $password = md5($_POST['password']);

    //Check if Username is Exist
    $check_user_name_sql = "SELECT * FROM tbl_admin WHERE username = '$username'";
    $check_user_name_res = mysqli_query($conn, $check_user_name_sql) or die(mysqli_error()) ;

    if ($check_user_name_res and mysqli_num_rows($check_user_name_res)  > 0) {
        $_SESSION['unique'] = "<div class='error'> Username Must Be Unique, Try another one </div>";
        header('location:' . SITE_URL . 'admin/admin/add_admin.php');
    } else {
//    Sql query
        $sql = "INSERT INTO tbl_admin set
 full_name='$full_name',
  username='$username', 
  password='$password' ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($res == TRUE) {
            $_SESSION['add'] = "<div class='success'> Admin Added Successfully </div>";
            header('location:' . SITE_URL . 'admin/admin/manage_admin.php');
        } else {
            $_SESSION['add'] = "<div class='error'> Failed to Add Admin </div>";
            header('location:' . SITE_URL . 'admin/admin/add_admin.php');
        }

    }
}


?>
