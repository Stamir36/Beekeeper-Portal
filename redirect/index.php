<?php
    if (!empty($_GET['code'])) {
        // Отправляем код для получения токена (POST-запрос).
        $params = array(
            'client_id'     => '276274544204-64t8sndnhj9ldhrlv8gkfbou5mqil6tg.apps.googleusercontent.com',
            'client_secret' => '1CWo5lwQX4n5r73yHq6vc8f_',
            'redirect_uri'  => 'https://beesportal.online/redirect',
            'grant_type'    => 'authorization_code',
            'code'          => $_GET['code']
        );	
                
        $ch = curl_init('https://accounts.google.com/o/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        curl_close($ch);	
     
        $data = json_decode($data, true);
        if (!empty($data['access_token'])) {
            // Токен получили, получаем данные пользователя.
            $params = array(
                'access_token' => $data['access_token'],
                'id_token'     => $data['id_token'],
                'token_type'   => 'Bearer',
                'expires_in'   => 3599
            );
     
            $info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . urldecode(http_build_query($params)));
            $info = json_decode($info, true);
            print_r($info['id']);

            include "../service/config.php";

            $mysql = new mysqli($Host, $User, $Password, $Database);
            $user_google_id = mb_strimwidth($info['id'], 0, 7);
            $user_google_name = $info['name'];
            $user_google_email = $info['email'];
            $user_google_pictures = $user_google_id.'.png';

            $result = $mysql->query("SELECT count(*) FROM `accounts_users` WHERE `id` = $user_google_id");
            $user = $result->fetch_assoc();
            if ($row[0] > 0)
            {
                // Есть данные
                setcookie('id', $user_google_id, time() + 3600 * 24, "/");
                header('Location: /');
            }   
            else
            {
                // нет данных
                $url = $info['picture'];
                $img = $user_google_id.".png";
                file_put_contents($img, file_get_contents($url));
                rename($user_google_id.".png", "../data/users/avatar/".$user_google_id.".png");


                $mysql->query("INSERT INTO `accounts_users` (`id`, `name`, `email`, `password`, `avatar`, `Date_of_Birth`, `premium`, `Reg_Date`, `banned`) VALUES ('$user_google_id', '$user_google_name', '$user_google_email', '$user_google_id', '$user_google_pictures', NULL, 'none', current_timestamp(), 'no')");
                setcookie('id', $user_google_id, time() + 3600 * 24, "/");
                header('Location: /');
            }

        }
    }
?>