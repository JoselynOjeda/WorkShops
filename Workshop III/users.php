<?php
session_start();
require('utils/functions.php');

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php'); 
    exit();
}


$users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_email']; ?></h1>
    <table>
      
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
       
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['FirstName']); ?></td>
            <td><?php echo htmlspecialchars($user['LastName']); ?></td>
            <td><?php echo htmlspecialchars($user['Email']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php" class="btn">Back to Home</a>

</body>
</html>