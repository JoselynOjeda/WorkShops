<?php
session_start();
require('../utils/functions.php');

$provinces = getProvinces();

if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
    exit();
}


if (!isset($_GET['id'])) {
    header('Location: ../users.php');
    exit();
}

$user_id = $_GET['id'];
$user = getUserById($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (updateUser($_POST, $user_id)) {
        header('Location: ../users.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit User Details</h2>
        <form method="post" action="edit_user.php?id=<?php echo $user_id; ?>" class="mt-3">
            <div class="mb-3">
                <label for="FirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="LastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo htmlspecialchars($user['LastName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Province" class="form-label">Province</label>
                <select class="form-select" id="Province" name="Province" required>
                    <option value="" disabled>Seleccione una provincia</option>
                    <?php foreach ($provinces as $id => $province): ?>
                        <option value="<?php echo $id; ?>" <?php echo ($id == $user['Province_Id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($province); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">New Password (leave blank if you do not wish to change it)</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter new password">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>