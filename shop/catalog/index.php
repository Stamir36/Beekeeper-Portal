<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'forum', time() + 3600 * 24, "/");

    include "../../service/config.php";

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

        <title> Каталог оголошень - портал пасічників</title>
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
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        
    <?php include '../backmwnu.php';?>

            <!-- Main section -->
            <div class="section" style="min-height: 750px;">
                <!-- Container -->
                <div class="container">
        
                    <!-- House products -->
                    <div class="columns category-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="category-title is-product-category">
                                <h2>Всі оголошення</h2>
                                <div class="category-icon is-hidden-mobile">
                                </div>
                            </div>
        
                            <!-- Controls -->
                            <div class="listing-controls">
                                <div class="layout-controls">
                                    <!-- СТРАНИЦЫ САЙТА -->
                                </div>
                                <!-- Sort -->
                                <div class="sort-box">
                                    <div class="sort-box-select">
                                        <select data-placeholder="Default order" class="chosen-select-no-single">
                                            <option>Самі нові</option>	
                                            <option>Найшижча ціна</option>
                                            <option>Найвища ціна</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /Controls -->
        
                            <!-- Product List -->
                            <div class="columns is-product-list is-multiline">
                                <div class="column is-12">
                                    <ul>
                                        <!-- Product -->
                                        <li class="flat-card is-auto is-list-item">
                                            <!-- Product image -->
                                            <span class="image">
                                                <img src="../assets/images/products/red-seat.png" alt="">
                                            </span>
                                            <!-- Product meta -->
                                            <span class="product-info">
                                                <!-- Rating -->
                                                <span class="rating">
                                                    <a>Дата створення</a>
                                                </span>
                                                <!-- Meta -->
                                                <a href="#"><span class="product-name">Назва</span></a>
                                                <span class="product-description">Місто</span>
                                                <span class="product-price">
                                                    ЦІНА
                                                </span>
                                            </span>
        
                                            <!-- Abstract -->
                                            <span class="product-abstract is-hidden-mobile">
                                                ОПИС ПРОДУКТУ
                                                <span class="view-more">
                                                    <a href="product.html">Детальніше <i data-feather="chevron-right"></i></a>
                                                </span>
                                            </span>
        
                                            <!-- Actions -->
                                            <span class="actions">
                                                <span class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></span>
                                                <span class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></span>
                                            </span>

                                        </li>

                                    </ul>
        
                                </div>
        
                            </div>
                            <!-- /Product list -->
        
                            <div class="show-more"><a href="#">Показати більше</a></div>
        
                        </div>
                    </div> 
                    <!-- /products -->

                </div>
                <!-- /Container -->
            </div>
            <!-- /Main section -->
        </div>
        <!-- /Main wrapper -->
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>    </body>  
</html>
