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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="navId">
        <li class="nav-item">
            <a href="index.php" class="nav-link active">Signup</a>
        </li>
        <li class="nav-item">
            <a href="login.php" class="nav-link active">Login</a>
        </li>
        <li class="nav-item">
            <a href="actions/logout.php" class="nav-link active">Logout</a>
        </li>

        <li class="nav-item">
            <a href="users.php" class="nav-link active">Users</a>
        </li>
    </ul>
    <div class="container">
        <h1 class="mt-4">Welcome, <?php echo $_SESSION['user_email']; ?></h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Provincia</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['FirstName']); ?></td>
                        <td><?php echo htmlspecialchars($user['LastName']); ?></td>
                        <td><?php echo htmlspecialchars($user['Email']); ?></td>
                        <td><?php echo htmlspecialchars($user['Province']); ?></td>
                        <td>
                            <?php
                            echo '<a href="actions/edit_user.php?id=' . $user['Id'] . '" class="btn btn-primary">Edit</a>'; 
                            echo '<a href="actions/delete_user.php?id=' . $user['Id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>