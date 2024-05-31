<?php
if (!isset($_SESSION['user'])) {
    $_SESSION['not auth'] = "<br> <div class='error text-center'> Please Login to Access Admin Panel  </div>";
    header('location:' . AUTH_URL . '/login.php');
}
