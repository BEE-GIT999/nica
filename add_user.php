<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username'], $data['email'], $data['password'], $data['status'])) {
    $username = $conn->real_escape_string($data['username']);
    $email = $conn->real_escape_string($data['email']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $status = $conn->real_escape_string($data['status']); // รับสถานะ (Admin หรือ User)

    $sql = "INSERT INTO users (username, email, password, status) VALUES ('$username', '$email', '$password', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "User added successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}

$conn->close();
?>
