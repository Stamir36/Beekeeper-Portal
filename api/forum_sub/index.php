<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }

    header('Content-Type: application/json; charset=utf-8');
    /*
    include "../service/config.php";
    $mysql = new mysqli($Host, $User, $Password, $Database);
    */
    $mysql = new mysqli();
    

    $result = $mysql->query("SELECT * FROM `forum_sub_mess` WHERE `id_main_mess` =  $id");
    $forum = $result->fetch_assoc();
    $cout = 0;
    while($forum = $result->fetch_assoc()){
        $cout++;
    }

    $result_m = $mysql->query("SELECT * FROM `forum_sub_mess` WHERE `id_main_mess` =  $id");
    $forum_mess = $result_m->fetch_assoc();
    echo "[\n";
    $i = 0;
    while($forum_mess = $result_m->fetch_assoc()){
        $i++;
        echo json_encode($forum_mess, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        if($i != $cout){
            echo ",\n";
        }
    }
    echo "\n]";
    
?>
