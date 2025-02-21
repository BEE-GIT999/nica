<?php
// เชื่อมต่อฐานข้อมูล
$host = "localhost";
$user = "root";  
$pass = "";
$dbname = "db_nica"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าจากฟอร์ม
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // เข้ารหัสรหัสผ่าน
$role = $_POST['role'] ?? 'user';  // ใช้ค่า default ถ้าไม่ได้ส่งมา
$status = $_POST['status'] ?? 'Active';  // ใช้ค่า default ถ้าไม่ได้ส่งมา

// เตรียม SQL Statement (ไม่ใส่ id และ created_at เพราะมีค่า default)
$sql = "INSERT INTO users (email, password, role, status) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// ผูกตัวแปร 4 ตัว (ssss คือ string ทั้งหมด)
$stmt->bind_param("ssss", $email, $password, $role, $status);

if ($stmt->execute()) {
    echo "<script>
            alert('✅ เพิ่มผู้ใช้สำเร็จ!');
            document.location.href = 'admin-users.php'; // กลับไปที่หน้าหลัก
          </script>";
} else {
    echo "<script>
            alert('❌ เกิดข้อผิดพลาด: " . $stmt->error . "');
          </script>";
}

$stmt->close();

$conn->close();
?>