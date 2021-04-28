<?php
    $id = $_POST['id'];

    include "../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `notifications` WHERE `notifications`.`user_id` = '$id'");
    $mysql->close();
?>