<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลเกม - คลังเกมส์</title>
    <style>
        /* Modern Reset & Base Styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* 1. Navbar Component */
        .navbar {
            background-color: #111111;
            color: #ffffff;
            padding: 18px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        .navbar-menu {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .navbar-menu a {
            color: #aaaaaa;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            color: #ffffff;
        }

        /* 2. Main Content Layout */
        .main-content {
            flex: 1;
            max-width: 1000px;
            width: 100%;
            margin: 40px auto;
            padding: 0 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111111;
        }

        /* Add Game Button */
        .btn-add {
            display: inline-block;
            background-color: #111111;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .btn-add:hover {
            background-color: #333333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        th, td {
            padding: 20px 28px;
            text-align: left;
        }

        th {
            background-color: #111111;
            color: #ffffff;
            font-weight: 500;
            font-size: 0.9rem;
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

        .game-cover {
            width: 110px;
            height: auto;
            border-radius: 6px;
            display: block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .action-link {
            color: #111111;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .action-link:hover {
            background-color: #111111;
            color: #ffffff;
        }

        .action-link.delete {
            color: #dc2626;
        }

        .action-link.delete:hover {
            background-color: #dc2626;
            color: #ffffff;
        }

        .action-divider {
            color: #ccc;
            margin: 0 2px;
        }

        /* 3. Footer Component */
        .footer {
            background-color: #ffffff;
            border-top: 1px solid #edf2f7;
            padding: 20px 0;
            text-align: center;
            color: #777777;
            font-size: 0.85rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- 1. NAVBAR -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">GAME STORE</a>
            <ul class="navbar-menu">
                <li><a href="index.php">หน้าหลัก (Index)</a></li>
                <li><a href="manage_game.php" class="active">จัดการเกม (Manage)</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

        include 'action/connect.php';

        $sql = "SELECT * FROM games";
        $result = mysqli_query($con, $sql);
        ?>

        <div class="page-header">
            <h1 class="page-title">จัดการข้อมูลเกม</h1>
            <!-- ปุ่มเพิ่มข้อมูลเมนู add_game.php -->
            <a href="add_game.php" class="btn-add">+ เพิ่มข้อมูลเกม</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>รหัสเกม</th>
                    <th>ชื่อเกม</th>
                    <th>ราคา</th>
                    <th>ภาพปก</th>
                    <th>ประเภท</th>
                    <th>จัดการ</th>
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
                    <td>
                        <a href="edit_game.php?id=<?= $game['game_id'] ?>" class="action-link">แก้ไข</a>
                        <span class="action-divider">|</span>
                        <a href="action/delete_game.php?id=<?= $game['game_id'] ?>" class="action-link delete" onclick="return confirm('คุณต้องการลบเกมนี้ใช่หรือไม่?');">ลบ</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- 3. FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Game Store System. All rights reserved.</p>
    </footer>

</body>
</html>