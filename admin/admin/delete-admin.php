<?php
include("../../config/constants.php");
$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res)
    $_SESSION['delete'] = '<div class="success"> Admin Deleted Successfully </div>';

else
    $_SESSION['delete'] = '<div class="error"> Failed to Delete Admin </div>';

header('location:' . ADMIN_URL . 'admin/admin/manage_admin.php');
