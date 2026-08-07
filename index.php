<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คลังเกมส์</title>
    <style>
        /* Minimal Style Reset & Typography */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color: #111111;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 15px;
            font-size: 0.95rem;
        }

        /* Container เนื้อหาเดิม */
        .container {
            max-width: 1000px;
            margin: 40px auto;
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

        /* Cover Image styling */
        .game-cover {
            width: 130px;
            height: auto;
            border-radius: 6px;
            display: block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        /* Button/Link Minimal Styling */
        .btn-manage {
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

        .btn-manage:hover {
            background-color: #111111;
            color: #ffffff;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 0.85rem;
            border-top: 1px solid #edf2f7;
            background-color: #ffffff;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- 1. NAVBAR -->
    <div class="navbar">
        <a href="index.php" style="font-weight: bold; margin-left: 0;">คลังเกมส์</a>
        <div>
            <a href="index.php">หน้าหลัก</a>
            <a href="manage_game.php">จัดการเกม</a>
        </div>
    </div>

    <!-- 2. CONTENT -->
    <div class="container">
        <?php
            // เปิดแสดง Error เพื่อความสะดวกในการดีบั๊ก
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);

            include 'action/connect.php';

            // ดึงข้อมูลเกมทั้งหมด
            $sql = "SELECT * FROM games";
            $result = mysqli_query($con, $sql);
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อเกม</th>
                    <th>ราคา</th>
                    <th>ภาพปก</th>
                    <th>ประเภท</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $game): ?>
                    <tr>
                        <td><?= htmlspecialchars($game["game_id"]) ?></td>
                        <td><strong><?= htmlspecialchars($game["game_name"]) ?></strong></td>
                        <td><?= number_format($game["game_price"], 2) ?> บาท</td>
                        <td> 
                            <img 
                                src="<?= htmlspecialchars($game["game_cover"]) ?>" 
                                alt="<?= htmlspecialchars($game["game_name"]) ?>" 
                                class="game-cover"
                            > 
                        </td>
                        <td><?= htmlspecialchars($game["type_id"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="game_types.php" class="btn-manage">จัดการประเภทเกม</a>
    </div>

    <!-- 3. FOOTER -->
    <div class="footer">
        <p>ระบบคลังเกมส์ &copy; <?= date('Y') ?></p>
    </div>

</body>
</html>