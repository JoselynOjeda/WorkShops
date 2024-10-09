<?php
require('utils/functions.php');

if ($_POST && $_REQUEST['firstName']) {

  $user['firstName'] = $_REQUEST['firstName'];
  $user['lastName'] = $_REQUEST['lastName'];
  $user['email'] = $_REQUEST['email'];
  $user['province_id'] = $_REQUEST['province'];
  $user['password'] = $_REQUEST['password'];
  if (saveUser($user)) {
    header('Location: login.php');
    exit();
  } else {
    header("Location: /?error=true");
  }
}
