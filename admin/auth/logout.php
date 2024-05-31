<?php
include('../../config/constants.php');
session_destroy();

header('location:' . AUTH_URL . '/login.php');

