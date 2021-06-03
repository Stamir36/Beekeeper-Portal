<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'shop', time() + 3600 * 24, "/");
    if(strlen($cook_id) > 0){
        include "../../service/config.php";

        $mysql = new mysqli($Host, $User, $Password, $Database);
    
        $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
        $user = $result->fetch_assoc();
    
        //Из базы данных: $user['name'];
        $name = $user['name'];
        $avatar = $user['avatar'];
        $premium = $user['premium'];
        $Reg_Date = $user['Reg_Date'];
        $banned = $user['banned'];
        $email = $user['email'];
        $Date_of_Birth = $user['Date_of_Birth'];
    }else{
        header('Location: /login/');
    }
    /*      <?php echo();?>      */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Мій профайл - портал пасічників</title>
        <link rel="icon" type="image/png" href="../assets/images/logo/nephos.png" />

        <!--Core CSS -->
        <link rel="stylesheet" href="../assets/css/bulma.css">
        <link rel="stylesheet" href="../assets/css/core.css">
        <link rel="stylesheet" href="../assets/css/content.css">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
        
        <!-- plugins -->
        <link rel="stylesheet" href="../assets/js/slick/slick.css">
        <link rel="stylesheet" href="../assets/js/slick/slick-theme.css">
        <link rel="stylesheet" href="../assets/js/webuipopover/jquery.webui-popover.min.css">
        <link rel="stylesheet" href="../assets/js/izitoast/css/iziToast.min.css">
        <link rel="stylesheet" href="../assets/js/zoom/zoom.css">
        <link rel="stylesheet" href="../assets/js/jpcard/card.css">
        <link rel="stylesheet" href="../assets/css/chosen/chosen.css">
        <link rel="stylesheet" href="../assets/css/icons.min.css">
        <style>
            @font-face {
                font-family: Unecoin; /* Имя шрифта */
                src: url(../../../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
            }
            html{
                font-family: Unecoin;
            }
        </style>
        <script>
            let photo = false;
        </script>
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        
    <?php include '../../service/contextmenu.php'; include '../backmwnu.php';?>
            
            <!-- Main section -->
            <div class="section" style="padding-left: 7%; min-height: 750px;">
                <!-- Container -->
                <div class="container">
        
                    <!-- Account Layout -->
                    <div class="columns account-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="account-title">
                                <h2>Ваш профайл</h2>
                                <img class="brand-filigrane" src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" style="opacity: 0.1;">
                            </div>
        
                            <!-- Account tabs -->
                            <div class="tabs account-tabs">
                                <ul>
                                    <li class="is-active"><a>Профайл</a></li>
                                    <li><a href="../my/">Мої оголошення</a></li>
                                    <li><a href="../liked/">Кошик</a></li>
                                    <li><a href="../orders/">Замовлення</a></li>
                                </ul>
                            </div>
        
                            <!-- Account layout -->
                            <div class="columns is-account-grid is-multiline">
        
                                <div class="column is-5">
                                    <!-- User card -->
                                    <div class="flat-card profile-card is-auto">
                                        <div class="card-body">
                                            <div class="profile-image">
                                                <img src="/data/users/avatar/<?php echo($avatar);?>" class='round' alt="">
                                            </div>
                                            <div class="username has-text-centered">
                                                <span><?php $idname = $user['name']; echo($idname);?></span>
                                                <small>Дата реєстрації: <?php echo(date("F j, Y", strtotime($Reg_Date)));?></small>
                                            </div>
                                        </div>
                                        <!-- div class="profile-footer has-text-centered">
                                            <span class="achievement-title">///</span>
                                            <div class="count">
                                                ******
                                            </div>
                                        </div -->
                                    </div>
                                    <!-- Gold Customer card -->
                                    <div class="flat-card profile-info-card is-auto is-dark is-achievement">
                                        <div class="card-body">
                                            <?php
                                                if($premium == "yes"){
                                                    echo("
                                                    <img src='\assets\img\gif\smiling_face_with_sunglasses.gif' style='width: 15%; height: 15%;'>
                                                    <div class='achievement-name'>
                                                        <span class='is-gold'>Преміум активний</span>
                                                        <span>Ви круті! Отримуйте додаткові знижки та підіймайте свої оголошення в топ!</span>
                                                    ");
                                                }else{
                                                    echo("
                                                    <img src='\assets\img\gif\hushed_face.gif' style='width: 15%; height: 15%;'>
                                                    <div class='achievement-name'>
                                                        <span class='is-gold'>Преміум не активований</span>
                                                        <span>Поки ваш статус такий же як і у всіх нас! Активуйте преміум, щоб отримати більше можливостей.</span>
                                                    ");
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Referal card -->
                                    <div class="flat-card profile-info-card is-auto is-dark is-achievement">
                                        <div class="card-body">
                                        <?php
                                                if($banned == "no"){
                                                    echo("
                                                    <img src='\assets\img\gif\waving_hand.gif' style='width: 15%; height: 15%;'>
                                                    <div class='achievement-name'>
                                                        <span class='is-green'>Вільний як метелик</span>
                                                        <span>Ви не отримували скарг, які б могли призвести до блокування аккаунта.</span>
        
                                                    ");
                                                }else{
                                                    echo("
                                                    <img src='https://img.icons8.com/fluent/48/000000/remove-user-male.png' style='width: 15%; height: 15%;'>
                                                    <div class='achievement-name'>
                                                        <span class='is-green'>БАН. Ви заблоковані.</span>
                                                        <span>Ваш аккаунт має обмеження. Будь ласка, зв'яжіться з підтримкою за додатковою інформацією.</span>
        
                                                    ");
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Details -->
                                <div class="column is-7">
                                    <div class="flat-card profile-info-card is-auto">
                                        <!-- Title -->
                                        <div class="card-title">
                                            <h3>Деталі облікового запису</h3>
        
                                            <div class="edit-account has-simple-popover popover-hidden-mobile" data-content="Edit Account" data-placement="top">
                                                <a><i class="feather-icons" data-feather="settings"></i></a>
                                            </div>
                                        </div>
                                        <!-- Contact Info -->
                                        <div class="card-body">
                                            <div class="columns">
                                                <div class="column is-6">
                                                    <div class="info-block">
                                                        <span class="label-text">Имя</span>    
                                                        <span class="label-value"><?php echo($name );?></span>
                                                    </div>
        
                                                    <div class="info-block">
                                                        <span class="label-text">Email</span>
                                                        <span class="label-value"><?php echo($email);?></span>
                                                    </div>
                                                </div>
        
                                                <div class="column is-6">
                                                    <div class="info-block">
                                                        <span class="label-text">Дата народження</span>
                                                        <span class="label-value"><?php echo(date("F j, Y", strtotime($Date_of_Birth)));?></span>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Background Nephos Icon -->
                                        <img class="card-bg" src="../assets/images/logo/nephos-greyscale.svg" alt="">
                                    </div>
        
                                    <!-- Address Info -->
                                    <div class="flat-card profile-info-card is-auto">
                                        <!-- Title -->
                                        <div class="card-title">
                                            <h3>Повідомлення</h3>
                                            <!-- Cog Button -->
        
                                        </div>
                                        <style>
                                            .box-block{
                                                background-color: rgb(240, 240, 240); width: 98%; padding: 15px; padding-left: 20px; border-radius: 10px; border: 1px solid rgb(240, 240, 240);
                                                cursor: pointer;
                                            }
                                            .box-block:hover{
                                                background-color: rgb(250, 250, 250); border: 1px solid wheat;
                                            }
                                        </style>
                                        <!-- Billing Address -->
                                        <div class="card-body" style="padding: 10px;">
                                                <div class="column is-6" style="width: 100%; margin:0px; padding: 0px; overflow: auto; max-height: 250px;">
                                                    <?php
                                                        $product = $mysql->query("SELECT * FROM `shop_mess` WHERE `p_autor` = '$idname';");
                                                        $id_block = Array();
                                                        $text = Array();
                                                        $autor = Array();
                                                        $products = Array();
                        
                                                        while($result = $product->fetch_assoc()){
                                                            $text[] = $result['text'];
                                                            $autor[] = $result['autor'];
                                                            $id_block[] = $result['id'];
                                                            $products[] = $result['product'];
                                                        }
                        
                                                        $num_prod = 0;
                        
                                                        if(count($text) == count($autor) && count($text) != 0 && count($autor) != 0 ){
                                                            while($num_prod <= (count($text) - 1)){
                                                                echo("
                                                                <div class='info-block box-block flat-card profile-info-card is-auto modal-trigger' data-modal='review-modal' id='block_".$id_block[$num_prod]."' onclick='mess_ref(`".$autor[$num_prod]."`,`".$text[$num_prod]."`, `".$id_block[$num_prod]."`, `".$products[$num_prod]."`)'>
                                                                    <span class='label-text'>Від: ".$autor[$num_prod]."</span>
                                                                    <span class='label-value'>".mb_strimwidth($text[$num_prod], 0, 50, '...')."</span>
                                                                </div>
                                                                ");
                                                                $num_prod = $num_prod + 1;
                                                            }
                                                        }else{
                                                            echo("<a class='t_mobile' style='color: #322EFF; text-align: center; background-color: #fff; margin: 10px; border-radius: 4px;'>Немає повідомлень</a>");
                                                        }
                                                    ?>

                                                </div>
                                        </div>
                                        <!-- /Address Form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Container -->
            </div>

            <footer class="footer">
                    <div class="row">
                        <img src="../../assets/img/shopping-bag.png" style="width: 100px;">
                        <h5>Сервіс оголошень - Beekeeper portal</h5>
                        <p>Unesell Studio @2021</p>
                    </div>
            </footer>

        </div>
        <!-- /Main wrapper -->
        <div id="review-modal" class="modal review-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <i data-feather='info'></i>
                        <span>Повідомлення.</span>
                        <div class="modal-delete"><i data-feather="x"></i></div>
                    </div>
                    <div class="box-body">   
                        <div class="control">
                            <span id="text_mess_autor" style="color: #00497a;"></span><br>
                            <span id="text_mess_info"></span>
                            <div class="textarea-button" style="margin-top: 15px; float: right; margin-bottom: 20px;">
                                <button class="button button raised" style="font-family: Unecoin;"><div class="modal-delete" id="modal-delete">Закрити</div></button>
                                <button id="del_buttom" class="button danger-button raised" onclick="DELETE(id);" style="font-family: Unecoin; background-color: #00497a; color: #fff;">Видалити</button>
                                <button id="go_buttom" class="button danger-button raised" onclick="" style="font-family: Unecoin; background-color: #c97200; color: #fff;">Сторінка оголошення</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function mess_ref(autor, text, id, id_p){
                document.getElementById("text_mess_autor").textContent = "Автор: " + autor;
                document.getElementById("text_mess_info").textContent = text;
                document.getElementById("del_buttom").setAttribute('onclick','DELETE(' + id + ');');
                document.getElementById("go_buttom").setAttribute('onclick','document.location.href = `/shop/product/?id=' + id_p + '`');
            }
            function DELETE(id){
                $.ajax({
                    url: 'del.php',
                    type: 'POST',
                    data:{id: id},
                    success: function(data) {
                        document.getElementById("block_" + id).remove();
                        document.getElementById("modal-delete").click();
                    }
                });
            }
        </script>
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>
        </body>  
</html>
