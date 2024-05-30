<?php include('../partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
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


?>
