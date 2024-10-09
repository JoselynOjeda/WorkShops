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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <form method="post">
    <div class="form-group">
      <label for="email">Email Address:</label>
      <input id="email" type="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input id="password" type="password" name="password" required>
    </div>
    <?php if (!empty($error)): ?>
      <p><?= $error ?></p>
    <?php endif; ?>
    <button type="submit">Login</button>
  </form>
</body>
</html>
