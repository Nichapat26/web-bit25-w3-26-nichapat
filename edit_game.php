<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
        <input type="text" name="game_id" value="<?= $game['game_id'] ?>" > <br>

        <label for="">ชื่อเกม</label>
        <input type="text" name="game_name"value="<?= $game['game_name'] ?>" > <br>

        <label for="">ราคา</label>
        <input type="text" name="game_price"value="<?= $game['game_price'] ?>" > <br>

        <label for="">ลิ้งค์ภาพปก</label>
        <input type="text" name="game_cover"value="<?= $game['game_cover'] ?>" > <br>

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
                        <option value=" <?= $type["type_id"]?>"<?= $type["type_id"] == $game["type_id"]  ? "selected" : "" ?>> <?= $type["type_name"]?></option>
                        
                
                    <?php
                }
            ?>
        </select>
        
        <br>
        <button>บันทึก</button>

    </form>
</body>
</html>
