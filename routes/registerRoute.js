// routes/registerRoute.js
const express = require('express');
const bcrypt = require('bcrypt');
const router = express.Router();

// การเชื่อมต่อฐานข้อมูล (สามารถย้ายไปในไฟล์อื่นหากต้องการ)
const mysql = require('mysql');
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'db_nica',
});

// เส้นทางสำหรับการลงทะเบียน
router.post('/register', async (req, res) => {
    const { username, email, password } = req.body;

    if (!username || !email || !password) {
        return res.status(400).json({ message: 'กรุณากรอกข้อมูลให้ครบถ้วน' });
    }

    try {
        // เข้ารหัสรหัสผ่าน
        const hashedPassword = await bcrypt.hash(password, 10);

        // เพิ่มผู้ใช้ในฐานข้อมูล
        const sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?)';
        db.query(sql, [username, email, hashedPassword], (err, result) => {
            if (err) {
                if (err.code === 'ER_DUP_ENTRY') {
                    return res.status(400).json({ message: 'อีเมลนี้ถูกใช้งานแล้ว' });
                }
                return res.status(500).json({ message: 'เกิดข้อผิดพลาด', error: err });
            }
            res.status(201).json({ message: 'ลงทะเบียนสำเร็จ' });
        });
    } catch (error) {
        res.status(500).json({ message: 'เกิดข้อผิดพลาด', error });
    }
});

module.exports = router;
