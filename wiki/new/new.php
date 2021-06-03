<?php
    
    include "../../service/config.php";

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING); //Название объявления
    $category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING); //Категория
    $content = filter_var(trim($_POST['content']), FILTER_SANITIZE_STRING); // Текст статьи.
    $content = str_replace("!n!","<br/>", $content);
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    $chas = strlen($content)/300;

    
    echo("Название : ".$name."\n");
    echo("Категория: ".$category."\n");
    echo("Контент: ".$content."\n");
    echo("Фото: ".$photo."\n");
    echo("Время: ".$chas."\n");

    //Загрузка аватара
    // Каталог, в который мы будем принимать файл:
    $uploaddir = '../catalog/image/';
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
    $names = $cook_id."-".rand(0, 999999);
    $sqlname = $names.substr(str_shuffle($permitted_chars), 0, 10).'.png';

    $max_filesize = 2000000; // Максимальный размер загружаемого файла в байтах (в данном случае он равен 2 Мб).

    if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
    die('Файл слишком большой.');


    // Копируем файл из каталога для временного хранения файлов:
    if (copy($_FILES['uploadfile']['tmp_name'], $uploaddir . $sqlname))
    {
        $mysql = new mysqli($Host, $User, $Password, $Database);
        $autor_info = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
        $user = $autor_info->fetch_assoc();
        $user_name = $user['name'];
        $mysql->query("INSERT INTO `wiki` (`id`, `header`, `body`, `category`, `Date_Create`, `author_id`, `author`, `photo`, `chtenieMIN`) VALUES (NULL,'$name','$content','$category',CURRENT_TIMESTAMP,'$cook_id','$user_name','$sqlname','$chas')");
        $mysql->close();
        header('Location: /wiki/');
    }
    else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер! Попробуйте ещё раз.</h3>"; exit; }
    //Конец загрузки аватара
    

?>