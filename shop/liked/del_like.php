<?php
    if(isset($_GET["id"])){
  
        $product_id = $_GET["id"];
    }

    $user_id = htmlspecialchars($_COOKIE["id"]);

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("DELETE FROM `liked_shop` WHERE `product_id` = '$product_id' AND `user_liked`='$user_id'");
    $mysql->close();
    
    header('Location: /shop/liked/');
?>