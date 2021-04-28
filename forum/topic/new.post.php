<?php
    $theme_id = filter_var(trim($_POST['theme_id']), FILTER_SANITIZE_STRING);
    $messages = filter_var(trim($_POST['messages']), FILTER_SANITIZE_STRING);
    $user_id = filter_var(trim($_POST['user_id']), FILTER_SANITIZE_STRING);
    $user_name = filter_var(trim($_POST['user_name']), FILTER_SANITIZE_STRING);

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    $mysql->query("INSERT INTO `forum_sub_mess` (`id`, `id_main_mess`, `body`, `Date_Create`, `author_id`, `author`) VALUES (NULL, '$theme_id', '$messages', CURRENT_TIMESTAMP, '$user_id', '$user_name')");

    $result_count = $mysql->query("SELECT COUNT(*) FROM `forum_sub_mess` WHERE id_main_mess = '$theme_id'");
    $count_num = $result_count->fetch_assoc();
    $count = $count_num['COUNT(*)']; // Количество записей
    $num_page = ceil($count / 10); //Количество страниц

    $mysql->close();
    
    $locate_a = "Location: /forum/topic/?id=";
    $locate = $locate_a . $theme_id . "&page=" .$num_page;
    header($locate);

?>