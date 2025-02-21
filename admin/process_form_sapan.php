<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost"; // หรือ IP Address ของเซิร์ฟเวอร์
$username = "root"; // ชื่อผู้ใช้งาน MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "db_nica"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีข้อมูลที่ส่งมาจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $points = $_POST['point'] ?? [];
    $dates = $_POST['date'] ?? [];
    $oxygen = $_POST['oxygen'] ?? [];
    $ph = $_POST['ph'] ?? [];
    $salinity = $_POST['salinity'] ?? [];
    $transparency = $_POST['transparency'] ?? [];
    $temperature = $_POST['temperature'] ?? [];
    $tan = $_POST['tan'] ?? [];
    $tn = $_POST['tn'] ?? [];
    $tp = $_POST['tp'] ?? [];

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare("INSERT INTO water_records_sapan (point, date, oxygen, ph, salinity, transparency, temperature, tan, tn, tp) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // ตรวจสอบการเตรียมคำสั่ง SQL
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // วนลูปข้อมูลที่ได้รับจากฟอร์มและบันทึกทีละแถว
    foreach ($points as $index => $point) {
        $stmt->bind_param(
            "ssdddddddd", // ชนิดของข้อมูลในคำสั่ง SQL (s = string, d = double)
            $point,
            $dates[$index],
            $oxygen[$index],
            $ph[$index],
            $salinity[$index],
            $transparency[$index],
            $temperature[$index],
            $tan[$index],
            $tn[$index],
            $tp[$index]
        );

        // ดำเนินการบันทึกข้อมูล
        $stmt->execute();
    }

    // ปิดคำสั่งและการเชื่อมต่อ
    $stmt->close();
    $conn->close();

    // แสดงข้อความสำเร็จ
    echo "<script>
            alert('ข้อมูลถูกบันทึกเรียบร้อยแล้ว');
            window.location.href = 'ky_admin.html'; // กำหนดเป็น URL ของหน้าฟอร์มของคุณ
          </script>";
} else {
    echo "<h1>โปรดส่งข้อมูลผ่านฟอร์ม</h1>";
}
?>
