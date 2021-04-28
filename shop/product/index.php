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

        <title> Продукт - портал пасічників</title>
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
                        <a href="../" class="navbar-item">Головна сторінка</a>
                        <a href="../new/" class="navbar-item">Нове оголошення</a>
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
                <a href="../"><img src="../assets/images/logo/nephos.png" alt=""></a>
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
                </i></li>
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
        <div class="shop-quickview has-background-image" data-background="../assets/images/bg/sidebar.jpeg">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Меню</h2>
                    <span id="close-shop-sidebar"><i data-feather="x"></i></span>
                </div>
                <!-- Shop menu -->
                <ul class="shop-menu">
                    <li>
                        <a href="../">
                            <span>Головна сторінка</span>
                            <i data-feather="grid"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../new/">
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
                        <img src="../assets/images/icons/new-cart.svg" alt="">
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
            <!-- Left product panel -->
            <div class="product-panel">
                <!-- Left Header -->
                <div class="panel-header">
                    <div class="likes">
                        <span>Подобається</span>
                        <i data-feather="heart"></i>
                    </div>
                </div>
        
                <!-- Product image -->
                <div id="product-view" class="product-image translateLeft">
                    <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" data-action="zoom" alt="">
                </div>
        
                <!-- Product details -->
                <div id="meta-view" class="translateLeft is-hidden">
                    <!-- Product description -->
                    <div class="detailed-description">
                        <div class="meta-block">
                            <h3>Назва</h3>
                            <p>НАЗВАТОВАРУ</p>
                        </div>
                        <div class="meta-block">
                            <h3>Продавець</h3>
                            <p>ІМ'ЯПРОДАВЦЯ</p>
                        </div>
                        <!-- Product colors -->
                        <div class="meta-block">
                            <h3>Телефон</h3>
                            <p>+380900000000</p>
                        </div>
                        <!-- Product long description -->
                        <div class="meta-block">
                            <h3 class="spaced">Детальніше про оголошення.</h3>
                            <p class="spaced">ОПИС</p>
                        </div>
                    </div>
                </div>
        
                <!-- Product Ratings -->
                <div id="ratings-view" class="translateLeft is-hidden">
                    <div class="product-ratings">
                        <div class="main-rating">
        
                            <!-- Average Rating -->
                            <h3>Автор оголошення</h3>
                            <div class="stars">
                                <h2>ІМ'ЯПРОДАВЦЯ</h2>
                            </div>
                            <span>Місто: <small>Харків</small></span>
                            <span class="add-review modal-trigger" data-modal="review-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>    
                            Написати повідомлення.</span>
                        </div>
        
                        <!-- Customer reviews -->
                        <div class="customer-ratings">
                        
                            <div class="media">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162757.7258273428!2d30.392608628224863!3d50.40217023842684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf4ee15a4505%3A0x764931d2170146fe!2z0JrQuNC10LIsIDAyMDAw!5e0!3m2!1sru!2sua!4v1618001058895!5m2!1sru!2sua" width="100%" height="360" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
        
                        </div>
                    </div>
                </div>
                <!-- /Product Ratings -->
        
                <!-- Product panel actions -->
                <div class="product-actions">
                    <!-- Zoom Action -->
                    <div class="zoom-buttons">
                        <h4>Переглядів: 0</h4>
                    </div>
                    <!-- Navigation icons -->
                    <div class="right-actions">
                        <!-- Product image panel -->
                        <span id="show-product" class="product-action is-active"><i data-feather="image"></i></span>
                        <!-- Product meta panel -->
                        <span id="show-meta" class="product-action"><i data-feather="menu"></i></span>
                        <!-- Product ratings panel -->
                        <span id="show-ratings" class="product-action"><i data-feather="message-circle"></i></span>
                    </div>
                </div>
            </div>
        
            <!-- Right product panel -->
            <div class="product-info-panel">
                <div class="inner-panel">
                    <div class="panel-header">
                        <div class="category-title" style="padding-left: 20px;">
                            <h2>Перегляд оголошення</h2>
                        </div>
                    </div>
                    <!-- Panel body -->
                    <div class="panel-body">
                        <!-- Product Meta -->
                        <h3 class="product-name">НАЗВАТОВАРУ <span></span></h3>
                        <p class="product-description">ОПИС</p>
        
                        <!-- Product controls -->
                        <div class="product-controls">
                            <!-- Price -->
                            <div class="product-price">
                                <div class="heading">Ціна</div>
                                <div class="value">100грн</div>
                            </div>
                            <!-- Quantity -->
                            <div class="product-quantity">
                                <div style="text-align: right;">Телефон</div>
                                <div>
                                    <h1 style="font-size: 25px;">+38090000000</h1>
                                </div>
                            </div>
                            <!-- Add to Cart -->
                            <div class="add-to-cart">
                                <div class="heading is-vhidden">Показати номер телефона</div>
                                <button class="button big-button primary-button upper-button rounded is-bold raised">Показати номер телефона</button>
                            </div>
                        </div>
                    </div>
                    <!-- Panel footer -->
                    <div class="panel-footer">
                        <div class="footer-inner">
                            <div class="recommended">Інщі товари</div>
                            <!-- Recommended items -->
                            <div class="columns has-text-centered">
                                
                                <div class="column"></div>
                                
                                <!-- Item -->
                                <div class="column is-3">
                                    <div class="featured-product">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" alt="">
                                        </div>
                                        <div class="product-info has-text-centered">
                                            <a href="#"><h3 class="product-name">ІТ_НАЗВА</h3></a>
                                            <p class="product-description">ІТ_ОПИС</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item -->
                                <div class="column is-3">
                                    <div class="featured-product">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" alt="">
                                        </div>
                                        <div class="product-info has-text-centered">
                                            <a href="#"><h3 class="product-name">ІТ_НАЗВА</h3></a>
                                            <p class="product-description">ІТ_ОПИС</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item -->
                                <div class="column is-3">
                                    <div class="featured-product">
                                        <div class="image">
                                            <img src="https://img.icons8.com/cotton/256/000000/cardboard-box.png" alt="">
                                        </div>
                                        <div class="product-info has-text-centered">
                                            <a href="#"><h3 class="product-name">ІТ_НАЗВА</h3></a>
                                            <p class="product-description">ІТ_ОПИС</p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="column"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Panel footer -->
                </div>
            </div>
            <!-- /Right product panel -->
        </div>
        <!-- /Main wrapper -->
        
        <!-- Modal -->
        <div id="review-modal" class="modal review-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <img src="../assets/images/avatars/elie.jpg" alt="">
                        <span>Rate this product</span>
                        <div class="modal-delete"><i data-feather="x"></i></div>
                    </div>
                    <div class="box-body">
        
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Great - 4.5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Very good - 4 stars"></label>
                            <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Pretty good - 3.5 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Good - 3 stars"></label>
                            <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Average - 2.5 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Mediocre - 2 stars"></label>
                            <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Weak - 1.5 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Bad - 1 star"></label>
                            <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Terrible - 0.5 stars"></label>
                        </fieldset>
        
                        <div class="control">
                            <textarea class="textarea is-button" placeholder="write something..."></textarea>
                            <div class="textarea-button">
                                <button class="button primary-button raised">Post review</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--button class="modal-close is-large" aria-label="close"></button-->
        </div>
        <!-- /Modal -->
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>    </body>  
</html>
