<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // โหลด Composer autoloader

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // สร้างรหัสสำหรับลิงก์รีเซ็ตรหัสผ่าน
        $resetToken = bin2hex(random_bytes(16)); // สร้าง token แบบสุ่ม
        $resetLink = "http://yourdomain.com/forget-password.html?token=" . $resetToken;

        // สร้างอ็อบเจกต์ PHPMailer
        $mail = new PHPMailer(true);
        try {
            // ตั้งค่าการเชื่อมต่อ SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io'; // ตั้งค่าผู้ให้บริการ SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'yourusername'; // ใช้ค่าที่ได้จาก Mailtrap หรือ SMTP ของคุณ
            $mail->Password = 'yourpassword'; // ใช้ค่าที่ได้จาก Mailtrap หรือ SMTP ของคุณ
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // ตั้งค่าข้อมูลผู้ส่ง
            $mail->setFrom('no-reply@yourdomain.com', 'Your Company');
            $mail->addAddress($email);

            // ตั้งหัวข้อและเนื้อหาของอีเมล
            $mail->Subject = 'ลิงก์รีเซ็ตรหัสผ่าน';
            $mail->Body    = "คลิกที่ลิงก์นี้เพื่อล็อกอินใหม่: " . $resetLink;

            // ส่งอีเมล
            $mail->send();
            echo json_encode(['success' => true]); // ส่งคืนข้อความสำเร็จ
        } catch (Exception $e) {
            echo json_encode(['success' => false]); // ถ้ามีข้อผิดพลาดส่งคืนข้อความล้มเหลว
        }
    } else {
        echo json_encode(['success' => false]); // หากอีเมลไม่ถูกต้อง
    }
}
?>
