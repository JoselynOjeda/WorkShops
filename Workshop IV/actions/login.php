<?php
require('utils/functions.php'); 

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validateUser($email, $password)) {
        $_SESSION['user_email'] = $email; 
        header("Location: users.php"); 
        exit();
    } else {
        $error = "Invalid login credentials. Please try again.";
    }
}
?>
