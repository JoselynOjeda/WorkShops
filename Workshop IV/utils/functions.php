<?php

function getProvinces() {
  $conn = getConnection();

  $sql = "SELECT Id_Province, Province FROM provinces ORDER BY Province ASC";


  $result = $conn->query($sql);

  $provinces = [];

  while($row = $result->fetch_assoc()) {
    $provinces[$row['Id_Province']] = $row['Province']; //dentro del fetch no se debe de cerrar la conexion
                                                        //debe ser afuera del while/fetch
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
  $sql = "SELECT Id, FirstName, LastName, Email, provinces.Province FROM logins_user INNER JOIN provinces ON logins_user.Province_Id = provinces.Id_Province";
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
    if (password_verify($password, $row['Password'])) { 
      return true;
    }
  }
  return false;
}

function EmailRegistered($email) {
  $conn = getConnection();  
  $email = $conn->real_escape_string($email);  


  $stmt = $conn->prepare("SELECT COUNT(*) as count FROM logins_user WHERE Email = ?");
  $stmt->bind_param("s", $email);  
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
      $conn->close();
      return $row['count'] > 0;  
  }

  $conn->close();
  return false;  
}

function deleteUser($id) {
  $conn = getConnection();
  $stmt = $conn->prepare("DELETE FROM logins_user WHERE ID = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $deleted = $stmt->affected_rows > 0;
  $stmt->close();
  $conn->close();
  return $deleted;
}

function getUserById($id) {
  $conn = getConnection();
  $stmt = $conn->prepare("SELECT FirstName, LastName, Email, Province_Id FROM logins_user WHERE ID = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  $stmt->close();
  $conn->close();
  return $user;
}

function updateUser($userData, $id) {
  $conn = getConnection();

  
  $sql = "UPDATE logins_user SET FirstName = ?, LastName = ?, Email = ?, Province_Id = ? WHERE ID = ?";
  $params = [
      $userData['FirstName'],
      $userData['LastName'],
      $userData['Email'],
      $userData['Province'],
      $id
  ];

 
  if (!empty($userData['Password'])) {
      $sql = "UPDATE logins_user SET FirstName = ?, LastName = ?, Email = ?, Province_Id = ?, Password = ? WHERE ID = ?";
      $userData['Password'] = password_hash($userData['Password'], PASSWORD_DEFAULT); 
      $params = [
          $userData['FirstName'],
          $userData['LastName'],
          $userData['Email'],
          $userData['Province'],
          $userData['Password'],
          $id
      ];
  }

  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssi", ...$params);
  $stmt->execute();

  $updated = $stmt->affected_rows > 0;
  $stmt->close();
  $conn->close();
  return $updated;
}




