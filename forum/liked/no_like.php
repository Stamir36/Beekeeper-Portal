<?php
    $id = $_POST['id'];
    $autor = $_POST['autor'];

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `liked_forum` WHERE `href` = '$id' AND `autor_liked_id`='$autor'");
    $mysql->close();
?>