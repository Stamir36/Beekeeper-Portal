<?php
    $nofi = $_GET['nofi'];
    $mess = $_GET['mess'];
    $info = $_GET['info'];
    $url = $_GET['url'];
    
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    if(strlen($cook_id) > 0){
        $autor = $cook_id;
      }else{
        $autor = 0;
    }

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $mysql->query("INSERT INTO `support_ticket` (`id`, `mess`, `autor`, `info`) VALUES (NULL, '$mess', '$autor', '$info')");
    $mysql->query("INSERT INTO `notifications` (`user_id`, `text`, `href`, `data`) VALUES ('$nofi', 'На ваш пост была отправлена жалоба.', '$url', CURRENT_TIMESTAMP)");
    $mysql->close();
    echo '<script>window.close();</script>'
?>