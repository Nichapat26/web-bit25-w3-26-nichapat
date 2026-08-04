<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการประเภทเกม</title>
    <style>
        /* Minimal Style Reset & Typography */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 50px auto;
            /* ขยายความกว้างรวมของหน้าจอให้กว้างขึ้น */
            max-width: 1000px; 
            padding: 0 30px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-bottom: 35px;
        }

        /* เพิ่ม Padding (ความกว้าง/สูง ในช่อง) ให้ยาวและโล่งขึ้น */
        th, td {
            padding: 20px 28px; 
            text-align: left;
        }

        th {
            background-color: #111111;
            color: #ffffff;
            font-weight: 500;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        td {
            border-bottom: 1px solid #edf2f7;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #f7fafc;
        }

        /* Button/Link Minimal Styling */
        .btn-back {
            display: inline-block;
            padding: 12px 28px;
            background-color: #ffffff;
            color: #111111;
            text-decoration: none;
            border: 1px solid #111111;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background-color: #111111;
            color: #ffffff;
        }
    </style>
</head>
<body>
    
    <?php
        // เปิดแสดง Error เพื่อความสะดวกในการดีบั๊ก
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

        include 'action/connect.php';

        // ดึงข้อมูลจากตารางประเภทเกม
        $sql = "SELECT * FROM game_types";
        $result = mysqli_query($con, $sql);
    ?>

    <table>
        <thead>
            <tr>
                <th>รหัสประเภทเกม</th>
                <th>ชื่อประเภทเกม</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result as $game_type): ?>
                <tr>
                    <td><?= htmlspecialchars($game_type["type_id"]) ?></td>
                    <td><strong><?= htmlspecialchars($game_type["type_name"]) ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn-back">กลับสู่หน้าหลัก</a>

</body>
</html>