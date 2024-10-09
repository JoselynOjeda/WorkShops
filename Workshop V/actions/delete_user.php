<?php
session_start();
require('../utils/functions.php');

if (!isset($_SESSION['user_email']) || !isset($_GET['id'])) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_GET['id'];

if (deleteUser($user_id)) {  
    header('Location: ../users.php');
    exit();
} else {
    echo "Error deleting user.";
}
