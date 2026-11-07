<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "college";
$port = 3307;

$conn = new mysqli($host, $user, $pass, $db, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Database connected successfully!";
?>
