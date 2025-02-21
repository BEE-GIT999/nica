<?php
// เชื่อมต่อฐานข้อมูล
$host = "localhost";
$user = "root";  // แก้ไขให้ตรงกับเซิร์ฟเวอร์ของคุณ
$pass = "";
$dbname = "db_nica"; // แก้เป็นชื่อฐานข้อมูลของคุณ

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "User deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();

header("Location: admin-users.php");
exit;
?>
