<?php
    $id = $_POST['id'];
    
    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `shop_product` WHERE `shop_product`.`id` = $id");
    $mysql->close();
?>