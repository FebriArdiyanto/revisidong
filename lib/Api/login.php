<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// Terima data POST dari permintaan x-www-form-urlencoded
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

// Log data yang diterima untuk debugging
error_log("Received data: email=$email, password=$password");

if (!$email || !$password) {
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
    exit();
}

// Lakukan koneksi ke database
$conn = new mysqli("localhost", "root", "", "bristore");

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Cek email dan password
$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
}

$stmt->close();
$conn->close();
?>
