<?php
    $id_product = $_POST['id_product'];
    $text = $_POST['text'];
    $autor = $_POST['autor'];
    $p_autor = $_POST['p_autor'];

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query(" INSERT INTO `shop_mess` (`id`, `text`, `product`, `p_autor`, `autor`) VALUES (NULL, '$text', '$id_product', '$p_autor', '$autor'); ");
    $mysql->close();
?>