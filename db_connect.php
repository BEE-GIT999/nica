<?php
// db_connect.php

$servername = "localhost";
$username = "root";  // หรือชื่อผู้ใช้ฐานข้อมูลที่คุณใช้
$password = "";      // หรือรหัสผ่านของฐานข้อมูล
$dbname = "db_nica";  // ชื่อฐานข้อมูลที่เราสร้าง

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}
?>
