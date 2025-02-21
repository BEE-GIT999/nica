<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['email'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit;
}

// ส่งค่าข้อมูล Session กลับไปเป็น JSON
echo json_encode([
    "status" => "success",
    "email" => $_SESSION['email'],
    "role" => $_SESSION['role'] ?? "guest" // ถ้าไม่มี role ให้เป็น guest
]);
?>
