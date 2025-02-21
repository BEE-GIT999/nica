<?php
session_start();
include 'db_connect.php';  // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    // ตรวจสอบว่าอีเมลหรือรหัสผ่านว่าง
    if (empty($email) || empty($password)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
        exit;
    }

    // ตรวจสอบรูปแบบอีเมล
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('รูปแบบอีเมลไม่ถูกต้อง');</script>";
        exit;
    }

    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // ตรวจสอบว่าอีเมลมีอยู่ในระบบแล้วหรือไม่
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('อีเมลนี้ถูกใช้งานแล้ว กรุณาใช้อีเมลอื่น');
            window.location.href = 'register.html'; // เปลี่ยนไปที่หน้าลงทะเบียนใหม่</script>";
        } else {
            // หากอีเมลยังไม่ถูกใช้งาน ลงทะเบียนผู้ใช้ใหม่
            $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'user')");
            if ($stmt) {
                $stmt->bind_param("ss", $email, $hashedPassword);
                if ($stmt->execute()) {
                    echo "<script>
                            alert('ลงทะเบียนสำเร็จ! คุณสามารถเข้าสู่ระบบได้แล้ว.');
                            window.location.href = 'login.html'; // เปลี่ยนไปที่หน้า login
                          </script>";
                } else {
                    echo "<script>alert('เกิดข้อผิดพลาดในการลงทะเบียน: " . $stmt->error . "');</script>";
                }
                // ปิดการเชื่อมต่อหลังจากทำการ execute
                $stmt->close();
            } else {
                echo "<script>alert('ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error . "');</script>";
            }
        }

    } else {
        echo "<script>alert('ข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('การเข้าถึงข้อมูลไม่ถูกต้อง');</script>";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
