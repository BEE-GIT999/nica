<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
         body {
            font-family: 'Sarabun', sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background: #f4f4f4;
        }

        /* Sidebar Style */
        .sidebar {
            width: 250px;
            background: linear-gradient(145deg, #000000, #003898);
            color: white;
            padding: 15px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-sizing: border-box;
        }

        /* Sidebar Links */
        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            display: block;
            padding: 15px;
            transition: background-color 0.3s;
        }

         /* กำหนดลักษณะของโลโก้ใน Sidebar */
         .sidebar img {
            max-width: 100%; /* ปรับขนาดของรูปภาพให้มีความกว้างสูงสุดเท่ากับความกว้างของ container */
            margin-bottom: 50px; /* ระยะห่างด้านล่าง */
        }


        .sidebar ul li a:hover {
            background: linear-gradient(145deg, #ffffff, #003898);
            color:
            
            #000000;
        }
    
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: linear-gradient(145deg, #000000, #003898); /* พื้นหลังแบบไล่สี */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content a {
            color: white; /* เปลี่ยนสีลิงก์เป็นสีขาว */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        table {
            width: 80%;
            margin-left: 15%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000000;
            text-align: center;
            padding: 8px;
        }
        th {
            background: linear-gradient(145deg, #000000, #003898);
            color: white;
        }        

        /* Main Content */
        .content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            box-sizing: border-box;
            margin-top: 20px;
        }

        h1 {
            font-size: 3vw;
            text-align: center; 

        }

        h2 {
            font-size: 2vw;
            margin-top: 50px;
            margin-bottom:20px;
            text-align: center;

        }

        /* Form Style */
        form {
            width: 50%;
            margin-left: 25%;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background: linear-gradient(145deg, #000000, #003898);
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: linear-gradient(145deg, #003898, #000000);

        }


        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }

            h1 {
                font-size: 6vw;
            }

            body {
                font-size: 14px;
            }
        }


        @media (max-width: 480px) {
            .sidebar {
                width: 150px;
            }

            .content {
                margin-left: 150px;
                width: calc(100% - 150px);
            }
        }
        
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <img src="/img/kpmm.png" alt="โลโก้หน่วยงาน">
    </div>
    <ul>
        <li>
            <a href="admin.html"><i class="fas fa-home"></i> หน้าหลัก</a>
        </li>

        <li>
            <div class="dropdown">
                <a href="water-quality-report_admin.html"><i class="fas fa-tint"></i> ข้อมูลคุณภาพน้ำ<span>▼</span></a>
                <div class="dropdown-content">
                    <a href="ky_admin.html"><i class="fas fa-tint"></i>เกาะยอ</a>
                    <a href="mo3_admin.html"><i class="fas fa-tint"></i>แหล่งน้ำธรรมชาติ</a>
                    <a href="st_admin.html"><i class="fas fa-tint"></i>ทะเลสาบสงขลา</a>
                    <a href="sapan_admin.html"><i class="fas fa-tint"></i>หัวสะพาน</a>
                </div>
            </div>
        </li>

        <li>
            <a href="admin-users.php"><i class="fas fa-address-book"></i> ข้อมูลผู้ใช้</a>
        </li>
        
        <li>
            <a href="/logout.html"><i class="fas fa-sign-out-alt"></i> ล็อกเอาท์</a>
        </li>
    </ul>
</div>
<!-- Main content -->
<div class="content">
    <h1>จัดการผู้ใช้</h1>
    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>อีเมล</th>
                <th>บทบาท</th>
                <th>สถานะ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>
                            <a href='edit_user.php?id=" . $row['id'] . "'><button>แก้ไข</button></a>
                            <a href='delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"คุณแน่ใจหรือไม่ว่าต้องการลบ?\")'><button>ลบ</button></a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>ไม่มีข้อมูลผู้ใช้</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <h2>เพิ่มชื่อผู้ใช้</h2>
    <form action="add_user.php" method="POST">
        <label for="email">อีเมล:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">รหัสผ่าน:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">บทบาท:</label>
        <select id="role" name="role">
            <option value="Admin">แอดมิน</option>
            <option value="User">ผู้ใช้</option>
        </select><br><br>

        <label for="status">สถานะ:</label>
        <select id="status" name="status">
            <option value="Active">ใช้งาน</option>
            <option value="Inactive">ไม่ใช้งาน</option>
        </select><br><br>

        <button type="submit">เพิ่มผู้ใช้</button>
    </form>
</div>

</body>
</html>
