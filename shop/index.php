<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'shop', time() + 3600 * 24, "/");

    include "../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Оголошення - портал пасічників</title>
        <link rel="icon" type="image/png" href="assets/images/logo/nephos.png" />

        <!--Core CSS -->
        <link rel="stylesheet" href="assets/css/bulma.css">
        <link rel="stylesheet" href="assets/css/core.css">
        <link rel="stylesheet" href="assets/css/content.css">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
        
        <!-- plugins -->
        <link rel="stylesheet" href="assets/js/slick/slick.css">
        <link rel="stylesheet" href="assets/js/slick/slick-theme.css">
        <link rel="stylesheet" href="assets/js/webuipopover/jquery.webui-popover.min.css">
        <link rel="stylesheet" href="assets/js/izitoast/css/iziToast.min.css">
        <link rel="stylesheet" href="assets/js/zoom/zoom.css">
        <link rel="stylesheet" href="assets/js/jpcard/card.css">
        <link rel="stylesheet" href="assets/css/chosen/chosen.css">
        <link rel="stylesheet" href="assets/css/icons.min.css">
        <style>
            @font-face {
                font-family: Unecoin; /* Имя шрифта */
                src: url(../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
            }
            html{
                font-family: Unecoin;
            }
        </style>
        
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        <?php include '../service/contextmenu.php'; include 'backmwnu.php';?>
        
            <!-- Main section -->
            <div class="section" style="margin: 0; padding: 0;">
                <section class="hero" id="top" style="margin: 0; padding: 0;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container_text">
                                <span id="text1"></span>
                                <span id="text2"></span>
                            </div>

                            <svg id="filters">
                                <defs>
                                    <filter id="threshold">
                                        <feColorMatrix in="SourceGraphic" type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 255 -140" />
                                    </filter>
                                </defs>
                            </svg>
                            <p style="width: 100%; padding-right: 20px;">Кращий сервіс оголошень, створений для пасічників і людей!</p>
                        </div>
                    </div>
                </section>
                
                <div class="promo">
                    <div class="row">
                        <div class="banner" style="background-color: rgb(114, 114, 219);">
                            <div>
                                <img src="https://img.icons8.com/cotton/64/000000/buy-with-card.png" style="position: absolute; z-index: -1;"/>
                                <div style="padding-left: 80px;">
                                    <h4 style="color: yellow;" style="margin-left: 10px;">Купуй зручно</h4>
                                    <p>Ще ніколи не було купувати потрібні речі так приємно, а найголовніше - легко!</p>
                                </div>
                            </div>
                        </div>
                        <div class="banner" style="background-color: rgb(219, 114, 137);">
                            <div>
                                <img src="https://img.icons8.com/cotton/64/000000/cash-in-hand.png" style="position: absolute; z-index: -1;"/>
                                <div style="padding-left: 80px;">
                                    <h4 style="color: yellow;" style="margin-left: 10px;">Продавай легко</h4>
                                    <p>Виставите в пару кліків щось на продаж і просто чекайте! Все безкоштовно і легко.</p>
                                </div>
                            </div>
                        </div>
                        <div class="banner" style="background-color: rgb(211, 157, 86);">
                            <div>
                                <img src="https://img.icons8.com/cotton/64/000000/laptop-search.png" style="position: absolute; z-index: -1;"/>
                                <div style="padding-left: 80px;">
                                    <h4 style="color: yellow;" style="margin-left: 10px;">Знайти роботу просто</h4>
                                    <p>Знайди собі роботу, або робота знайде тебе! Все просто і безпечно.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <!-- Container -->
                    <div class="container">
                        <div class="columns account-header">
                            <div class="column is-tablet-landscape-padded">
                                <!-- Title -->
                                <div class="account-title">
                                    <h2 style="z-index: 1;">Останні оголошення!</h2>
                                    <img class="brand-filigrane" src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" style="opacity: 0.2;">
                                </div>
            
                                <!-- tabs -->
                                <div class="tabs account-tabs">
                                    <ul>
                                        <a class="button feather-button is-small primary-button" style="margin-left: 3px;">Найкращі</a>
                                        <a class="button feather-button is-small secondary-button" style="margin-left: 3px;">Нові</a>
                                        <a class="button feather-button is-small accent-button" style="margin-left: 3px;">Всі оголошення</a>
                                    </ul>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="columns is-gapless is-vcentered">
                            <div class="row">
                                <style>
                                    @media (min-width: 991px){
                                        .t_mobile{
                                            width: 100%;
                                            margin: 15px;
                                        }
                                    }
                                    @media (max-width: 991px){
                                        .t_mobile{
                                            width: 90%;
                                            margin-top: 15px;
                                        }
                                    }
                                </style>
                            <?php
                                $product = $mysql->query("SELECT * FROM `shop_product` ORDER BY id DESC limit 20");
                                $id_product = Array();
                                $photo = Array();
                                $name = Array();
                                $city = Array();
                                $price = Array();

                                while($result = $product->fetch_assoc()){
                                    $id_product[] = $result['id'];
                                    $photo[] = $result['photo'];
                                    $name[] = $result['name'];
                                    $city[] = $result['city'];
                                    $price[] = $result['price'];
                                }

                                $num_prod = 0;

                                if(count($photo) == count($name) && count($city) != 0 && count($name) != 0 ){
                                    while($num_prod <= (count($name) - 1)){
                                        echo("
                                        <!-- Краточка -->
                                        <div style='width: 320px; padding: 10px;'>
                                                    <div class='flat-card'>
                                                        <div class='image'>
                                                            <img src='catalog/image/".$photo[$num_prod]."' data-action='zoom' alt=''>
                                                        </div>
                                                        <div class='product-info '>
                                                            <a href='product/?id=".$id_product[$num_prod]."'><h3 class='product-name'>".$name[$num_prod]."</h3></a>
                                                            <a href='product/?id=".$id_product[$num_prod]."'><p class='product-description'>".$city[$num_prod]."</p></a>
                                                            <p class='product-price' style='margin-top: 10px;'> ".$price[$num_prod]."</p>
                                                        </div>
                                                        <div class='actions'>
                                                            <div class='add'><i data-feather='shopping-cart' class='has-simple-popover' data-content='Add to Cart' data-placement='top'></i></div>
                                                            <div class='like'><i data-feather='heart' class='has-simple-popover' data-content='Add to Wishlist' data-placement='top'></i></div>
                                                        </div>
                                                    </div>
                                            </div>
                                        <!-- Конец карточки -->
                                        ");
                                        $num_prod = $num_prod + 1;
                                    }
                                }else{
                                    echo("<a class='t_mobile' href='new/' style='color: #322EFF; text-align: center; background-color: #fff; padding: 10px; border-radius: 4px;'>Ще немає жодного оголошення. Будь першим!</a>");
                                }
                            ?>
                                        
                            </div>
                        </div>
                    </div>

                    <!-- /Container -->
                </div>

                <footer class="footer">
                    <div class="row">
                        <img src="../assets/img/shopping-bag.png" style="width: 100px;">
                        <h4>Сервіс оголошень - Beekeeper portal</h4>
                        <p>Unesell Studio @2021</p>
                    </div>
                    
                </footer>

            </div>
            <!-- /Main section -->
        </div>
        <!-- /Main wrapper -->
        <!-- Concatenated plugins -->
        <script src="assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="assets/js/nephos.js"></script>

        
        
    </body>  
</html>
