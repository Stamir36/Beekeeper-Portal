<?php
if (!empty($_GET['code'])) {
	// var_dump($_GET['state']);
 
	$params = array(
		'client_id'     => '593035361614028',
		'client_secret' => '6042479c0718602517ee708cc0926b78',
		'redirect_uri'  => 'https://beesportal.online/redirect/facabook.php',
		'code'          => $_GET['code']
	);
	
	// Получение access_token
	$data = file_get_contents('https://graph.facebook.com/oauth/access_token?' . urldecode(http_build_query($params)));
	$data = json_decode($data, true);
 
	if (!empty($data['access_token'])) {
		$params = array(
			'access_token' => $data['access_token'],
			'fields'       => 'id,email,first_name,last_name,picture'
		);
 
		// Получение данных пользователя
		$info = file_get_contents('https://graph.facebook.com/me?' . urldecode(http_build_query($params)));
		$info = json_decode($info, true);
 
		print_r($info['id']);

        include "../service/config.php";

            $mysql = new mysqli($Host, $User, $Password, $Database);
            $user_facebook_id = mb_strimwidth($info['id'], 0, 7);
            $user_facebook_name = $info['first_name']." ".$info['last_name'];
            $user_facebook_email = $info['email'];
            $user_facebook_pictures = $user_facebook_id.'.png';

            $result = $mysql->query("SELECT count(*) FROM `accounts_users` WHERE `id` = $user_facebook_id");
            $user = $result->fetch_assoc();
            if ($row[0] > 0)
            {
                // Есть данные
                setcookie('id', $user_facebook_id, time() + 3600 * 24, "/");
                header('Location: /');
            }   
            else
            {
                // нет данных
                $pic = $info['picture'];
                $pic1 = $pic['data'];
                $url = $pic1['url'];
                $img = $user_facebook_id.".png";
                file_put_contents($img, file_get_contents($url));
                rename($user_facebook_id.".png", "../data/users/avatar/".$user_facebook_id.".png");


                $mysql->query("INSERT INTO `accounts_users` (`id`, `name`, `email`, `password`, `avatar`, `Date_of_Birth`, `premium`, `Reg_Date`, `banned`) VALUES ('$user_facebook_id', '$user_facebook_name', '$user_facebook_email', '$user_facebook_id', '$user_facebook_pictures', NULL, 'none', current_timestamp(), 'no')");
                setcookie('id', $user_facebook_id, time() + 3600 * 24, "/");
                header('Location: /');
            }
	}		
}
?>