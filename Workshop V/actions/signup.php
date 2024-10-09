<?php
require('../utils/functions.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_REQUEST['email'])) {
  $email = $_REQUEST['email'];

  if (EmailRegistered($email)) {
    $error = urlencode("El correo electrónico ya está registrado.");
    header("Location: ../index.php?error=$error");
  } else {
     
      $user['firstName'] = $_REQUEST['firstName'];
      $user['lastName'] = $_REQUEST['lastName'];
      $user['email'] = $email;
      $user['province_id'] = $_REQUEST['province'];
      $user['password'] = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);

      if (saveUser($user)) {
          header('Location: ../login.php');
          exit();
      } else {
          $errorMessage = "Hubo un error al guardar el usuario.";
          header('Location: ../index.php');
      }
  }
} else {
  header('Location: ../index.php');
}
