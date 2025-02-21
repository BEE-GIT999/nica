<?php
// กำหนดค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost"; // หรือ IP ของเซิร์ฟเวอร์ฐานข้อมูล
$username = "root";        // ชื่อผู้ใช้ฐานข้อมูล
$password = "";            // รหัสผ่านฐานข้อมูล
$dbname = "db_nica"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$location_name = $_POST['location'];
$record_time = $_POST['time'];
$depth_cm = $_POST['depth'];
$transparency_cm = $_POST['transparency'];
$temperature_c = $_POST['temperature'];
$salinity_ppth = $_POST['salinity'];
$ph = $_POST['ph'];
$dissolved_oxygen_mg_l = $_POST['oxygen'];
$alkalinity_mg_l = $_POST['alkalinity'];
$ammonia_mg_l = $_POST['ammonia'];
$nitrite_mg_l = $_POST['nitrite'];
$climate_description = $_POST['climate'];
$water_condition = $_POST['water-condition'];

// สร้างคำสั่ง SQL สำหรับเพิ่มข้อมูล
$sql = "INSERT INTO waterky (
    location_name, record_time, depth_cm, transparency_cm, temperature_c,
    salinity_ppth, ph, dissolved_oxygen_mg_l, alkalinity_mg_l,
    ammonia_mg_l, nitrite_mg_l, climate_description, water_condition
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

// ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssddddddddsss", 
    $location_name, $record_time, $depth_cm, $transparency_cm, $temperature_c,
    $salinity_ppth, $ph, $dissolved_oxygen_mg_l, $alkalinity_mg_l,
    $ammonia_mg_l, $nitrite_mg_l, $climate_description, $water_condition
);

// ตรวจสอบผลการบันทึก
if ($stmt->execute()) {
    echo "success";  // ส่งค่าผลลัพธ์ 'success' ถ้าบันทึกข้อมูลสำเร็จ
} else {
    echo "error";    // ส่งค่าผลลัพธ์ 'error' ถ้ามีข้อผิดพลาด
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>
