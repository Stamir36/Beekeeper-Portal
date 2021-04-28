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
    <body>
        
        <!-- Pageloader -->
        <div class="pageloader"></div>
        <div class="infraloader is-active"></div>
        <nav class="navbar mobile-navbar is-hidden-desktop is-hidden-tablet" aria-label="main navigation">
            <!-- Brand -->
            <div class="navbar-brand">
                <a class="navbar-item" href="?">
                    <img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt="">
                </a>
        
                <!-- Sidebar mode toggler icon -->
                <a id="sidebar-mode" class="navbar-item is-icon is-sidebar-toggler" href="javascript:void(0);">
                    <i data-feather="sidebar"></i>
                </a>
        
                <!-- Mobile menu toggler icon -->
                <div class="navbar-burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!-- Navbar mobile menu -->
            <div class="navbar-menu">
                <!-- Account -->
                <div class="navbar-item has-dropdown">
                    <a class="navbar-link">
                        <?php
                            if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                                echo("
                                    <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                                    <span class='is-heading'>".$name."</span>
                                ");
                            }else{
                                echo("
                                    <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                                    <span class='is-heading'>Вход не выполнен</span>
                                ");
                            }
                        ?>                         
                    </a>
        
                    <!-- Mobile Dropdown -->
                    <div class="navbar-dropdown">
                        <a href="#" class="navbar-item">Головна сторінка</a>
                        <a href="#" class="navbar-item">Нове оголошення</a>
                        <a href="#" class="navbar-item">Мої оголошення</a>
                        <a href="#" class="navbar-item">Обрані оголошення</a>
                    </div>
                </div>
        
                <!-- More -->
                <div class="navbar-item has-dropdown">
                    <a class="navbar-link">
                        <i data-feather="grid"></i>
                        <span class="is-heading">Категорії</span>
                    </a>
        
                    <!-- Mobile Dropdown -->
                    <div class="navbar-dropdown">
                        <a href="#" class="navbar-item">Для дому</a>
                        <a href="#" class="navbar-item">Для пасіки</a>
                        <a href="#" class="navbar-item">Онлайн матеріали</a>
                        <a href="#" class="navbar-item">Робота</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main Sidebar-->
        <div class="main-sidebar">
            <div class="sidebar-brand">
                <a href="?"><img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt=""></a>
            </div>
            <div class="sidebar-inner">
                <ul class="icon-menu">
                    <!-- Shop sidebar trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-shop"><i data-feather="home"></i></a>
                    </li>            <!-- Cart sidebar trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-cart"><i data-feather="shopping-cart"></i></a>
                    </li>            <!-- Search trigger -->
                    <li>
                        <a href="javascript:void(0);" id="open-search"><i data-feather="search"></i></a>
                        <a href="javascript:void(0);" id="close-search" class="is-hidden is-inactive"><i data-feather="x"></i></a>
                    </li>            <!-- Mobile mode trigger -->
                    <li class="is-hidden-desktop is-hidden-tablet">
                        <a href="javascript:void(0);" id="mobile-mode"><i data-feather="smartphone"></i></a>
                    </li>        </ul>
        
                <!-- User account -->
                <ul class="bottom-menu is-hidden-mobile">
                    <li>
                        <a href="authentication.html"><i>
                    
                    <?php
                        if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                            echo("
                                <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                            ");
                        }else{
                            echo("
                                <img data-feather='user' id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                            ");
                        }
                    ?>
                </i></a></li>
                </ul>
            </div>
        </div>
        <!-- /Main Sidebar-->
        
        <!-- FAB -->
        <div id="quickview-trigger"  class="menu-fab is-hidden-mobile">
            <a class="hamburger-btn" href="javascript:void(0);">
                <span class="menu-toggle">	
                    <span class="icon-box-toggle"> 	
                        <span class="rotate">
                            <i class="icon-line-top"></i>
                            <i class="icon-line-center"></i>
                            <i class="icon-line-bottom"></i> 
                        </span>
                    </span>
                </span>
            </a>
        </div><!-- /FAB -->
        
        <!-- Categories Right quickview -->
        <div class="category-quickview">
            <div class="inner">
                <ul class="category-menu">
                    <li>
                        <a href="catalog/">
                            <span>Для дому</span>
                            <img src="https://img.icons8.com/fluent/48/000000/cottage.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="catalog/">
                            <span>Для пасіки</span>
                            <img src="https://img.icons8.com/fluent/48/000000/beeswax.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="catalog/">
                            <span>Онлайн матеріали</span>
                            <img src="https://img.icons8.com/fluent/48/000000/book-stack.png"/>
                        </a>
                    </li>
                    <li>
                        <a href="catalog/">
                            <span>Робота</span>
                            <img src="https://img.icons8.com/fluent/48/000000/find-matching-job.png"/>
                        </a>
                    </li>
                </ul>
        
                <!--div class="all-categories is-hidden-mobile">
                    <a href="products.html">Всі категорії</a>
                    <div class="centered-divider"></div>
                </div-->
            </div>
        </div>
        
        <!-- Shop quickview -->
        <div class="shop-quickview has-background-image" data-background="assets/images/bg/sidebar.jpeg">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Меню</h2>
                    <span id="close-shop-sidebar"><i data-feather="x"></i></span>
                </div>
                <!-- Shop menu -->
                <ul class="shop-menu">
                    <li>
                        <a href="#">
                            <span>Головна сторінка</span>
                            <i data-feather="grid"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Нове оголошення</span>
                            <i data-feather="user"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Мої оголошення</span>
                            <i data-feather="credit-card"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Обрані оголошення</span>
                            <i data-feather="heart"></i>
                        </a>
                    </li>
                </ul>
                <!-- Profile image -->
                <ul class="user-profile">
                    <li>
                        <a href="account.html">
                            <?php
                                if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                                    echo("
                                        <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                                        <span class='user'>
                                            <span>".$name."</span>
                                            <span>В особистий кабінет</span>
                                        </span>
                                    ");
                                }else{
                                    echo("
                                        <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                                        <a href='../login/'>
                                            <span class='user'>
                                                <span>Вітаю, Гість</span>
                                                <span>Авторизуватися</span>
                                            </span>
                                        </a>
                                    ");
                                }
                            ?>  
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Cart quickview -->
        <div class="cart-quickview">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Мені подобається</h2>
                    <span id="close-cart-sidebar"><i data-feather="x"></i></span>
                </div>
                <!-- Cart quickview body -->
                <div class="cart-body">
                    <div class="empty-cart has-text-centered">
                        <h3>Тут пусто...</h3>
                        <img src="assets/images/icons/new-cart.svg" alt="">
                        <a href="shop.html" class="button big-button rounded">Почніть купувати</a>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main wrapper -->
        <div class="shop-wrapper">
        
            <!-- Search overlay -->
            <div class="search-overlay"></div>
            
            <!-- Search input -->
            <div class="search-input-wrapper is-desktop is-hidden">
                <div class="field">
                    <div class="control">
                        <input type="text" name="search" autofocus required>
                        <span id="clear-search" role="button"><i data-feather="x"></i></span>
                        <span class="search-help">Введіть назву товару, який ви шукаєте</span>
                    </div>
                </div>
            </div>
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
                                    <h2 style="z-index: 1;">Найкращі оголошення!</h2>
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
    
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->

                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->

                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
                                <!-- Краточка -->
                                <div style="width: 320px; padding: 10px;">
                                    <div class="flat-card">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                                        </div>
                                        <div class="product-info ">
                                            <a href="product/"><h3 class="product-name">Название обьявления</h3></a>
                                            <p class="product-description">Описание или город</p>
                                            <p class="product-price">
                                            Цена
                                            </p>
                                        </div>
                                        <div class="actions">
                                            <div class="add"><i data-feather="shopping-cart" class="has-simple-popover" data-content="Add to Cart" data-placement="top"></i></div>
                                            <div class="like"><i data-feather="heart" class="has-simple-popover" data-content="Add to Wishlist" data-placement="top"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Конец карточки -->
    
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
        <script src="assets/js/nephos.js"></script>    </body>  
</html>
