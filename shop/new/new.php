<?php
    
    include "../../service/config.php";

    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING); //Название объявления
    $price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING); //Цена
    $category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING); //Категория
    $premium = filter_var(trim($_POST['premium']), FILTER_SANITIZE_STRING); // Наличие премиума
    $content = filter_var(trim($_POST['content']), FILTER_SANITIZE_STRING); // Описание товара.
    $photo = filter_var(trim($_POST['uploadfile']), FILTER_SANITIZE_STRING); // Фото.
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING); // Номер телефона
    $city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING); // Город
    $cook_id = htmlspecialchars($_COOKIE["id"]);

    /*
    echo("Название объявления: ".$name."\n");
    echo("Цена: ".$price."\n");
    echo("Категория: ".$category."\n");
    echo("Наличие премиума: ".$premium."\n");
    echo("Описание товара: ".$content."\n");
    echo("Фото: ".$photo."\n");
    echo("Номер телефона: ".$phone."\n");
    echo("Город: ".$city."\n");
    */

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
        $mysql->query("INSERT INTO `shop_product` (`id`, `name`, `info`, `category`, `premium`, `city`, `price`, `photo`, `phone`, `autor_name`) VALUES (NULL, '$name', '$content', '$category', '$premium', '$city', '$price', '$sqlname', '$phone', '$user_name')");
        $mysql->close();
        header('Location: /shop/');
    }
    else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер! Попробуйте ещё раз.</h3>"; exit; }
    //Конец загрузки аватара

?>