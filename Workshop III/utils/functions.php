<?php


function getProvinces() {
  $conn = getConnection();
  $sql = "SELECT Id_Province, Province FROM provinces";
  $result = $conn->query($sql);

  $provinces = [];
  while($row = $result->fetch_assoc()) {
    $provinces[$row['Id_Province']] = $row['Province'];
  }

  $conn->close();
  return $provinces;
}

function getConnection() {
  $connection = mysqli_connect('localhost', 'root', '', 'logins');
  return $connection;
}

function saveUser($user) {
  $conn = getConnection();
  $plainPassword = $user['password']; 

  $stmt = $conn->prepare("INSERT INTO logins_user (FirstName, LastName, Email, Province_Id, Password) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssis", $user['firstName'], $user['lastName'], $user['email'], $user['province_id'], $plainPassword);
  $result = $stmt->execute();
  $stmt->close();
  $conn->close();
  
  return $result;
}


function getAllUsers() {
  $conn = getConnection();
  $sql = "SELECT FirstName, LastName, Email, Province_Id FROM logins_user";
  $result = $conn->query($sql);

  $users = [];
  while($row = $result->fetch_assoc()) {
    $users[] = $row;
  }

  $conn->close();
  return $users;
}

function validateUser($email, $password) {
  $conn = getConnection();
  $email = $conn->real_escape_string($email);

  $stmt = $conn->prepare("SELECT Password FROM logins_user WHERE Email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($row = $result->fetch_assoc()) {
    if ($password === $row['Password']) { 
      return true;
    }
  }
  return false;
}
