<?php
    $id = $_POST['id'];
    
    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `shop_mess` WHERE `shop_mess`.`id` = $id");
    $mysql->close();
?>