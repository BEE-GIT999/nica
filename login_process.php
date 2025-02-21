<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header("Location: login.html");
        exit;
    }

    // ตรวจสอบข้อมูลในฐานข้อมูล
    $stmt = $conn->prepare("SELECT email, password, role FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล";
        header("Location: login.html");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_email, $db_password, $db_role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $db_role;

            error_log("Role: " . $db_role);

            if ($db_role === 'Admin') {
                header("Location: /admin/admin.html");
            } else {
                header("Location: home.html");
            }
            exit;
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $_SESSION['error'] = "ไม่พบอีเมลในระบบ";
    }

    $stmt->close();
    header("Location:login.html");
    exit;
}

$conn->close();
?>
