<?php
    header('Content-Type: application/json; charset=utf-8');
    /*
    include "../service/config.php";
    $mysql = new mysqli($Host, $User, $Password, $Database);
    */
    $mysql = new mysqli();
    

    $result = $mysql->query("SELECT * FROM `forum_main_mess`");
    $forum = $result->fetch_assoc();
    $cout = 0;
    while($forum = $result->fetch_assoc()){
        $cout++;
    }

    $result = $mysql->query("SELECT * FROM `forum_main_mess`");
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
