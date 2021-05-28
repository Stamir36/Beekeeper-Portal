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
                                                <span><?php echo($name);?></span>
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
                                            <div class="edit-account is-vhidden">
                                                <a href="account-edit.html"><i class="feather-icons" data-feather="settings"></i></a>
                                            </div>
        
                                        </div>
                                        <!-- Billing Address -->
                                        <div class="card-body">
                                            <div class="columns">
                                                <div class="column is-6">
                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>
        
                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>
                                                    
                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>
                                                </div>
        
                                                <div class="column is-6">
                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>

                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>

                                                    <div class="info-block">
                                                        <span class="label-text">НАЗВАНИЕ</span>
                                                        <span class="label-value">ЗНАЧЕНИЕ</span>
                                                    </div>
                                                </div>
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
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>
        </body>  
</html>
