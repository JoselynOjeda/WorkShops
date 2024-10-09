<?php
include('utils/functions.php');

$provinces = getProvinces();

if (isset($_GET['error'])) {
  echo htmlspecialchars($_GET['error']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1 class="display-4">Signup</h1>
      <p class="lead">This is the signup process</p>
      <hr class="my-4">
    </div>
    <form id="myForm" method="post" action="actions/signup.php" novalidate>
      <div class="form-group">
        <label for="first-name">First Name</label>
        <input id="first-name" class="form-control" type="text" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name</label>
        <input id="last-name" class="form-control" type="text" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="province">Provincia</label>
        <select id="province" class="form-control" name="province" required>
          <option value="" selected disabled>Seleccione una provincia</option>
          <?php foreach ($provinces as $id => $province) {
            echo "<option value=\"$id\">$province</option>";
          } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" class="form-control" type="email" name="email" required>
        <div class="error-message" style="color: red;">
          <?php if (isset($errorMessage)) echo $errorMessage; ?>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Sign up</button>
    </form>

    <script>
      document.getElementById('myForm').addEventListener('submit', function(event) {
        var form = this;
        var valid = true;

        form.querySelectorAll('.form-control').forEach(function(input) {
          if (input.value.trim() === '') {
            valid = false; 
            input.classList.add('is-invalid'); 
          } else {
            input.classList.remove('is-invalid');
          }
        });

//validacion de campos vacios
        var provinceSelect = document.getElementById('province');
        if (provinceSelect.value === "") {
          valid = false;
          provinceSelect.classList.add('is-invalid');
        } else {
          provinceSelect.classList.remove('is-invalid');
        }

        if (!valid) {
          event.preventDefault();
          event.stopPropagation();
          alert("Por favor, complete todos los campos correctamente.");
        }
      }, false);
    </script>
  </div>

</body>

</html>