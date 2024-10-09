<?php
require('actions/login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post">
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email Address:</label>
            <input id="email" type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="password" class="form-label">Password:</label>
            <input id="password" type="password" name="password" class="form-control" required>
          </div>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
              <?= $error ?>
            </div>
          <?php endif; ?>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
