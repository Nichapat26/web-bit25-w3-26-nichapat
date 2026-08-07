<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลเกม</title>
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

        /* Container */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 30px;
        }

        /* Form Styling */
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #edf2f7;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 0.95rem;
        }

        button {
            margin-top: 20px;
            padding: 12px 28px;
            background-color: #111111;
            color: #ffffff;
            border: 1px solid #111111;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button:hover {
            background-color: #333333;
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
            $id = $_GET['id'];
            
            include 'action/connect.php';

            $sql = "SELECT * FROM games WHERE game_id = '$id' ";

            $result = mysqli_query($con, $sql);
        
            $game = mysqli_fetch_assoc($result);

            // var_dump($game);
        ?>

        <form action="action/update_game.php" method="post">

            <label for="">รหัสเกม</label>
            <input type="text" name="game_id" value="<?= $game['game_id'] ?>" readonly style="background-color: #f0f0f0;"> <br>

            <label for="">ชื่อเกม</label>
            <input type="text" name="game_name" value="<?= $game['game_name'] ?>"> <br>

            <label for="">ราคา</label>
            <input type="text" name="game_price" value="<?= $game['game_price'] ?>"> <br>

            <label for="">ลิ้งค์ภาพปก</label>
            <input type="text" name="game_cover" value="<?= $game['game_cover'] ?>"> <br>

            <?php
                include 'action/connect.php';

                $sql = "SELECT * FROM game_types";

                $result = mysqli_query($con, $sql);
            ?>

            <label for="">ประเภท</label>
            <select name="type_id" id="">
                <?php
                    foreach($result as $type){
                        ?>
                            <option value="<?= trim($type["type_id"]) ?>" <?= trim($type["type_id"]) == trim($game["type_id"]) ? "selected" : "" ?>><?= $type["type_name"] ?></option>
                        <?php
                    }
                ?>
            </select>
            
            <br>
            <button type="submit">บันทึก</button>

        </form>
    </div>

    <!-- 3. FOOTER -->
    <div class="footer">
        <p>ระบบคลังเกมส์ &copy; <?= date('Y') ?></p>
    </div>

</body>
</html>