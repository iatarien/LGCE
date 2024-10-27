<?php 

$database = "lgce";
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$query = "UPDATE company SET license ='2025-10-31'";

try {
    $stmt = $conn->prepare($query);
    $stmt->execute();
    die();
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}

?>