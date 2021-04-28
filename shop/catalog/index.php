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
    <body>
        
        <!-- Pageloader -->
        <div class="pageloader"></div>
        <div class="infraloader is-active"></div>
        <nav class="navbar mobile-navbar is-hidden-desktop is-hidden-tablet" aria-label="main navigation">
            <!-- Brand -->
            <div class="navbar-brand">
                <a class="navbar-item" href="../">
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
                    </li>            <!-- Shop Filters -->
                    <li>
                        <a id="open-filters"><i data-feather="settings"></i></a>
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
                        <img src="../assets/images/icons/new-cart.svg" alt="">
                        <a href="shop.html" class="button big-button rounded">Почніть купувати</a>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filters quickview -->
        <div class="filters-quickview">
            <div class="inner">
                <!-- Header -->
                <div class="quickview-header">
                    <h2>Filters</h2>
                    <span id="close-filters-sidebar"><i data-feather="x"></i></span>
                </div>
        
                <!-- Filters body -->
                <div class="filters-body">
                    
        
                    <!-- Categories checkboxes -->
                    <div class="filter-block">
                        <h3 class="filter-title has-padding">Categories</h3>
                        <div class="columns is-checkboxes is-gapless is-multiline">
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="house" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            House
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="office" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Office
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="kids" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Kids
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="kitchen" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Kitchen
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="accessories" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Misc
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Categories -->
        
                    <!-- Types -->
                    <div class="filter-block">
                        <h3 class="filter-title has-padding">Types</h3>
                        <div class="columns is-checkboxes is-gapless is-multiline">
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="chairs" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Chairs
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="couches" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Couches
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="tables" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Tables
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="beds" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Beds
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="lights" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Lights
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox -->
                            <div class="column is-6">
                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox-wrap is-small">
                                            <input id="devices" type="checkbox" class="d-checkbox" checked>
                                            <span></span>
                                            Devices
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Types -->
                    
                    <!-- Price range filter -->
                    <div class="filter-block">
                        <h3 class="filter-title">Price</h3>
                        <div class="price-range-wrapper">
                            <div class="price-limit">0</div>
                            <div class="range-slider">
                                <input class="input-range" type="range" value="1500" min="1" max="1500">
                                <div class="slider-output">
                                    <small>Show between</small><span class="range-value"></span>
                                </div>
                            </div>   
                            <div class="price-limit">1500</div>
                        </div>
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
            <div class="section">
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
