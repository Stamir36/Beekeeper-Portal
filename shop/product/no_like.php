<?php
    $product_id = $_POST['product_id'];
    $user_id = htmlspecialchars($_COOKIE["id"]);

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `liked_shop` WHERE `product_id` = '$product_id' AND `user_liked`='$user_id'");
    $mysql->close();
?>