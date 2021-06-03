<?php
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    $id_stasus = $_GET['id'];
    
    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("UPDATE `shop_orders` SET `status` = 'ok' WHERE `shop_orders`.`product` = $id_stasus AND `shop_orders`.`order_autor` = $cook_id; ");
    $mysql->close();
    header('Location: ../orders/');
?>