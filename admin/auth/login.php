<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Order - Login</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="../../css/auth.css">
</head>
<body>
<?php include('../../config/constants.php') ?>
<div class="login">
    <h1 class="text-center">Login Form</h1>

    <?php
    if (isset($_SESSION['login'])) {
        echo ' <br> <div class="error text-center">' . $_SESSION['login'] . '</div> <br>';
        unset($_SESSION['login']);
    }
    if (isset($_SESSION['not auth'])) {
        echo $_SESSION['not auth'];
        unset($_SESSION['not auth']);
    }
    ?>

    <!--Login Form Starts Here-->
    <form action="" method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" name="username" id="username" placeholder="Enter Username" required>
        <br>
        <label for="password">Password:</label>
        <br>
        <input type="password" name="password" id="password" placeholder="Enter Password" required>
        <br>
        <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </form>
    <!--Login Form Ends Here-->

    <p class="text-center">Created By - <a href="https://belal.cliprz.org/">Belal Alshmalya</a></p>
</div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($conn, $sql);
    if ($res and mysqli_num_rows($res) == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successful!</div>";
        $_SESSION['user'] = $username;
        header('location:' . DASHBOARD_URL . '/index.php');
    } else {
        $_SESSION['login'] = "Username or Password did not match !";
        header('location:' . AUTH_URL . '/login.php');
    }
}
?>