<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logins";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$horas = isset($argv[1]) ? (int)$argv[1] : 24;  

$sql = "SELECT Email, Last_login_datetime FROM logins_user WHERE Status = 1";
$result = $conn->query($sql);

$foundInactive = false; // Variable para rastrear si se encontraron usuarios inactivos

if ($result->num_rows > 0) {
    $now = new DateTime();
    
    while ($row = $result->fetch_assoc()) {
        $lastLogin = new DateTime($row["Last_login_datetime"]);
        $diff = $now->diff($lastLogin);
        $hours = (int) ($diff->days * 24 + $diff->h);
        
        if ($hours > $horas) {
            echo "El usuario " . $row["Email"] . " tiene más de $horas horas desde el último inicio de sesión.\n";
            $foundInactive = true; // Se encontró al menos un usuario inactivo
        }
    }

    if (!$foundInactive) {
        echo "No hay usuarios inactivos que hayan superado las $horas horas desde su último inicio de sesión.\n";
    }
} else {
    echo "No hay usuarios activos o no se encontraron datos.\n";
}

$conn->close();
?>

