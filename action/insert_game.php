<?php

$game_id = $_POST["game_id"];
$game_name = $_POST["game_name"];
$game_price = $_POST["game_price"];
$game_cover = $_POST["game_cover"];
$type_id = $_POST["type_id"];

include 'connect.php';

$sql = "INSERT INTO `games`
        (`game_id`, `game_name`, `game_price`, `game_cover`, `type_id`) 
        VALUES 
        ('$game_id','$game_name','$game_price','$game_cover','$type_id')";
        
$result = mysqli_query($con, $sql);

if(!$result){
    echo "error";
}else{
    header("location: ../index.php");
    exit;
}