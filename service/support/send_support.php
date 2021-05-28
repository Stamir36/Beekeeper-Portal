<?php
    $nofi = $_GET['nofi'];
    $mess = $_GET['mess'];
    $info = $_GET['info'];
    $url = $_GET['url'];
    
    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $mysql->query("INSERT INTO `support_ticket` (`id`, `mess`, `autor`, `info`) VALUES (NULL, '$mess', '0', '$info')");
    $mysql->close();
    echo '<script>window.close();</script>'
?>