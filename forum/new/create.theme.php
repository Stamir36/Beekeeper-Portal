<?php

    $name = filter_var(trim($_POST['theme']), FILTER_SANITIZE_STRING);
    $category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING);
    $content = filter_var(trim($_POST['content']), FILTER_SANITIZE_STRING);

    $content = str_replace("!n!","<br/>", $content);
    $cook_id = htmlspecialchars($_COOKIE["id"]);

    include "../../service/config.php";

    if(strlen($cook_id) > 0){
        $mysql = new mysqli($Host, $User, $Password, $Database);

        $result_name = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
        $user = $result_name->fetch_assoc();

        //Из базы данных: $user['name'];
        $names_user = $user['name'];

        $mysql->query("INSERT INTO `forum_main_mess` (`id`, `header`, `body`, `category`, `Date_Create`, `author_id`, `author`) VALUES (NULL, '$name', '$content', '$category', CURRENT_TIMESTAMP, '$cook_id', '$names_user')");
        $result = $mysql->query("SELECT id FROM `forum_main_mess` WHERE author_id = $cook_id ORDER BY Date_Create DESC LIMIT 1");

        $user = $result->fetch_assoc();
        $id_theme = $user['id'];
        $mysql->query("INSERT INTO `notifications` (`id`, `user_id`, `text`, `href`, `data`) VALUES (NULL, '$cook_id', 'Тема успішно створена.', '../../forum/topic/?id=$id_theme', CURRENT_TIMESTAMP)");
        
        header('Location: /forum/');
      }else{
        header('Location: /login/');
    }
    
?>