<?php
require('utils/functions.php'); 

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = validateUser($email, $password);

    switch ($loginResult) {
        case "success":
            $_SESSION['user_email'] = $email; 
            header("Location: users.php"); 
            exit();
        case "inactive":
            $error = "Your account is inactive. Please contact support.";
            break;
        case "wrong_password":
            $error = "Incorrect password. Please try again.";
            break;
        case "not_registered":
            $error = "Email not registered. <a href='index.php'>Register here</a> or try again.";
            break;
        default:
            $error = "An error occurred. Please try again later.";
            break;
    }
}
?>
