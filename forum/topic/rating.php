<?php
    $id_mess = $_POST['id_mess'];
    $account = $_POST['account'];
    $score = $_POST['score'];
    $type = $_POST['type'];
    $new = $_POST['new'];
    
    include "../../service/config.php";
    
    $mysql = new mysqli($Host, $User, $Password, $Database);
    $mysql->query("INSERT INTO `rating_theme` (`id`, `theme_id`, `account_id`, `types`) VALUES (NULL, '$id_mess', '$account', '$type')");
    $mysql->query("UPDATE $type SET `rating` = '$new' WHERE $type.`id` = $id_mess");
    $mysql->close();
?>