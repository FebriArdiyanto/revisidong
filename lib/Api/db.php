<?php
// db.php
$host = 'localhost';
$db_name = 'bristore';  // Ganti dengan nama database Anda
$username = 'root';     // Ganti dengan username database Anda
$password = '';         // Ganti dengan password database Anda
$conn;

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
