<?
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $user_id = htmlspecialchars($_COOKIE["id"]);

    $product = filter_var(trim($_POST['product']), FILTER_SANITIZE_STRING); //Что заказываем
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING); // Имя
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING); //Телефон
    $pochta = filter_var(trim($_POST['pochta']), FILTER_SANITIZE_STRING); // Сервис почты
    $adress = filter_var(trim($_POST['adress']), FILTER_SANITIZE_STRING); // Адрес доставки
    $payment_methods = filter_var(trim($_POST['payment_methods']), FILTER_SANITIZE_STRING); // Метод оплаты

    include "../../service/config.php";

    if($payment_methods == "money"){
        if($product == "all"){
            $mysql = new mysqli($Host, $User, $Password, $Database);
            $liked = $mysql->query("SELECT * FROM `liked_shop` WHERE `user_liked` = $user_id");

            while($result = $liked->fetch_assoc()){
                $idp = $result['product_id'];
                $result = $mysql->query("SELECT * FROM `shop_product` WHERE `id` = $idp");
                $name_autor = $result->fetch_assoc();
                $p_autor = $name_autor['autor_name'];

                $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `name` = '$p_autor'");
                $id_autor = $result->fetch_assoc();
                $p_autor = $id_autor['id'];


                $result = $mysql->query("INSERT INTO `shop_orders` (`id`, `product`, `name`, `phone`, `pochta`, `adress`, `payment_methods`, `p_autor`, `order_autor`, `Create_Date`, `status`) VALUES (NULL, '$idp', '$name', '$phone', '$pochta', '$adress', '$payment_methods', '$p_autor', '$user_id', CURRENT_TIMESTAMP, 'complect');");
            }
            $mysql->query("DELETE FROM `liked_shop` WHERE `user_liked`='$user_id'");
            $mysql->close();
            
            header('Location: /shop/checkout/complete/');
        } else if(is_numeric($product) && $product != "all"){
            $mysql = new mysqli($Host, $User, $Password, $Database);

            $result = $mysql->query("SELECT * FROM `shop_product` WHERE `id` = '$product'");
            $name_autor = $result->fetch_assoc();
            $p_autor = $name_autor['autor_name'];

            $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `name` = '$p_autor'");
            $id_autor = $result->fetch_assoc();
            $p_autor = $id_autor['id'];

            $result = $mysql->query("INSERT INTO `shop_orders` (`id`, `product`, `name`, `phone`, `pochta`, `adress`, `payment_methods`, `p_autor`, `order_autor`, `Create_Date`, `status`) VALUES (NULL, '$product', '$name', '$phone', '$pochta', '$adress', '$payment_methods', '$p_autor', '$user_id', CURRENT_TIMESTAMP, 'complect');");
            $mysql->close();
            
            header('Location: /shop/checkout/complete/');
        }
    }else{ //Онлайн оплата
        setcookie('$product', $product, time() + 3600 * 24, "/");
        setcookie('$name', $name, time() + 3600 * 24, "/");
        setcookie('$phone', $phone, time() + 3600 * 24, "/");
        setcookie('$pochta', $pochta, time() + 3600 * 24, "/");
        setcookie('$adress', $adress, time() + 3600 * 24, "/");
        setcookie('$payment_methods', $payment_methods, time() + 3600 * 24, "/");
        header('Location: /shop/ ');
    }
    

?>