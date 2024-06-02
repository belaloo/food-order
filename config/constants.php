<?php
session_start();
const SITE_URL = 'https://food-order.test/';
const ADMIN_URL = SITE_URL . 'admin/admin';
const Category_URL = SITE_URL . 'admin/category';
const AUTH_URL = SITE_URL . 'admin/auth';
const DASHBOARD_URL = SITE_URL . 'admin/dashboard';
const LOCALHOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'food';
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>