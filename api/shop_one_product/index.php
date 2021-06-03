<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }

    header('Content-Type: application/json; charset=utf-8');
    /*
    include "../service/config.php";
    $mysql = new mysqli($Host, $User, $Password, $Database);
    */
    $mysql = new mysqli('localhost', 'u663391372_beekeeper', 'Beekeeper2021', 'u663391372_beekeeper');
    

    $result = $mysql->query("SELECT * FROM `shop_product` WHERE `id` =  $id");
    $forum = $result->fetch_assoc();
    echo "[\n";
    echo json_encode($forum_mess, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    echo "\n]";
    
?>