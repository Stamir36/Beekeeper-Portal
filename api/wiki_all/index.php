<?php
    header('Content-Type: application/json; charset=utf-8');
    /*
    include "../service/config.php";
    $mysql = new mysqli($Host, $User, $Password, $Database);
    */
    $mysql = new mysqli('localhost', 'u663391372_beekeeper', 'Beekeeper2021', 'u663391372_beekeeper');
    

    $result = $mysql->query("SELECT * FROM `wiki`");
    $forum = $result->fetch_assoc();
    $cout = 0;
    while($forum = $result->fetch_assoc()){
        $cout++;
    }

    $result = $mysql->query("SELECT * FROM `wiki`");
    $forum = $result->fetch_assoc();
    echo "[\n";
    $i = 0;
    while($forum = $result->fetch_assoc()){
        $i++;
        echo json_encode($forum, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        if($i != $cout){
            echo ",\n";
        }
    }
    echo "\n]";
    
?>