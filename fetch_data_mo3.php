<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nica";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบค่าที่ส่งมาจาก AJAX
$timePeriod = $_POST['timePeriod'];
$response = [];

if ($timePeriod == "monthly") {
    $month = $_POST['month'];
    $sql = "SELECT * FROM water_records_mo3 WHERE DATE_FORMAT(date, '%Y-%m') = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $month);
} elseif ($timePeriod == "yearly") {
    $year = $_POST['year'];
    $sql = "SELECT * FROM water_records_mo3 WHERE YEAR(date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $year);
} elseif ($timePeriod == "latest") {
    $sql = "SELECT * FROM water_records_mo3 ORDER BY date DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
} else {
    $response['error'] = "Invalid time period.";
    echo json_encode($response);
    exit();
}

$stmt->execute();
$result = $stmt->get_result();

// เก็บผลลัพธ์ลงใน array
while ($row = $result->fetch_assoc()) {
    $response[] = $row;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
