<?php
    $product_id = $_POST['product_id'];
    $name_product = $_POST['name_product'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $user_id = htmlspecialchars($_COOKIE["id"]);

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("INSERT INTO `liked_shop` (`id`, `product_id`, `name_product`, `product_image`, `product_price`, `user_liked`) VALUES (NULL, '$product_id', '$name_product', '$product_image', '$product_price', '$user_id')");
    $mysql->close();
?>