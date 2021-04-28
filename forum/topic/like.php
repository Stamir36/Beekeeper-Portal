<?php
    $id = $_POST['id'];
    $autor = $_POST['autor'];
    $header = $_POST['header'];

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $result = $mysql->query("INSERT INTO `liked_forum` (`id`, `header`, `href`, `autor_liked_id`) VALUES (NULL, '$header', '$id', '$autor')");
    $mysql->close();
?>