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
    
    if(isset($_GET["page"])){
        $page = $_GET["page"];
      }

      $price_count = $mysql->query("SELECT SUM(product_price) FROM `liked_shop` WHERE `user_liked` = '$cook_id' ");
      $arrl_price = $price_count->fetch_assoc();
      $all_price = $arrl_price['SUM(product_price)'];
      if($all_price == ""){ $all_price = 0; }

      $result_count = $mysql->query("SELECT COUNT(*) FROM `liked_shop` WHERE `user_liked` = '$cook_id' ");
      $count_num = $result_count->fetch_assoc();
      $count = $count_num['COUNT(*)']; $all_liked = $count_num['COUNT(*)'];// Количество записей.
  
      if($page <= 0){
        header('Location: ?page=1');
      }
  
      $OFFSET = $page * 5 - 5; //С какой записи выводить
      $liked = $mysql->query("SELECT * FROM `liked_shop` WHERE `user_liked` = '$cook_id' limit 5 OFFSET $OFFSET");
  
      $num_page = ceil($count / 5); //Количество страниц.
    /*      <?php echo();?>      */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Нове оголошення - портал пасічників</title>
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
                                <h2>Мені подобається</h2>
                                <img class="brand-filigrane" src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" style="opacity: 0.1;">
                            </div>
        
                            <!-- Account tabs -->
                            <div class="tabs account-tabs">
                                <ul>
                                    <li><a href="../profile/">Профайл</a></li>
                                    <li><a href="../my/">Мої оголошення</a></li>
                                    <li class="is-active"><a>Кошик</a></li>
                                    <li><a href="../orders/">Замовлення</a></li>
                                </ul>
                            </div>


                            <!-- Row -->
                            <div class="columns is-account-grid is-multiline">
                                
        
                                <div class="column is-8">
                                    <div class="wishlist-card is-auto">
                                        <!-- List of Wishlist Items -->
                                        <ul class="wishlist">

                                            <?php
                                                $product_id = Array();
                                                $name_product = Array();
                                                $product_image = Array();
                                                $product_price = Array();

                                                while($result = $liked->fetch_assoc()){
                                                    $product_id[] = $result['product_id'];
                                                    $name_product[] = $result['name_product'];
                                                    $product_image[] = $result['product_image'];
                                                    $product_price[] = $result['product_price'];
                                                }
                    
                                                    $num_prod = 0; 
                    
                                                    if(count($product_id) == count($name_product) && count($product_image) != 0 && count($product_price) != 0 ){
                                                        while($num_prod <= (count($product_id) - 1)){
                                                            echo("
                                                            <li id='block_".$product_id[$num_prod]."' class='wishlist-item flat-card' onclick='return true' style='min-height: 0;'>
                                                                <div class='item-wrapper'>
                                                                    <span class='item-wrapper is-account-grid is-multiline' style='cursor: pointer; padding: 0px 0px; width: 80%;' onclick='document.location.href = `/shop/product/?id=".$product_id[$num_prod]."`;'>
                                                                        <!-- Product Image -->
                                                                        <div style='width: 120px; justify-content: center; display: inline block; text-align: center;'>
                                                                            <img src='/shop/catalog/image/".$product_image[$num_prod]."' alt=''>
                                                                        </div>
                                                                        <!-- Product meta -->
                                                                        <span class='product-info'>
                                                                            <span>".$name_product[$num_prod]."</span>
                                                                            <span class='product-price' style='color:orange; font-size: 18px;'>".$product_price[$num_prod]."</span>
                                                                        </span>
                                                                    </span>
                                                                    <div class='action no-mobile' style='z-index: 10000;'>
                                                                        <!-- Dropdown button -->
                                                                        <div class='dropdown is-right'>
                                                                            <span class='dropdown-trigger'>
                                                                                <span class='dropdown-button' >
                                                                                    <a onclick='document.location.href = `del_like.php/?id=".$product_id[$num_prod]."`' ><i data-feather='x'></i></a>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            ");
                                                            $num_prod = $num_prod + 1;
                                                        }
                                                    }else{
                                                        echo("
                                                        <!-- Empty Cart card -->
                                                        <div class='columns is-account-grid is-multiline'>
                                                            <div class='column is-12'>
                                                                <div class='flat-card is-auto empty-cart-card'>
                                                                    <div class='empty-cart has-text-centered'>
                                                                        <h3>Наразі ваш кошик порожній</h3>
                                                                        <img src='../assets/images/icons/shop.svg' alt='' style='max-height: 250px; max-width: 250px;'>
                                                                        <a href='../catalog/' class='button big-button rounded'>Продовжити покупки</a>
                                                                        <small>Відкрийте наші найпопулярніші предмети</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ");
                                                }
                                                ?>

                                        </ul>
                                    </div>
        
                                    <!-- List Pagination -->
                                    <nav class="wishlist-pagination" style="padding-top: 20px; z-index: -10; justify-content:left;">
                                        <ul class="pagination" style="text-align: left;">
                                            
                                            <?php
                                            
                                            if($num_page == 1){
                                            echo("
                                                <li class='page-item active'>
                                                    <a class='page-link'>1</a>
                                                </li>
                                                <li class='page-item disabled'>
                                                    <a class='page-link'>Наступна</a>
                                                </li>
                                            ");
                                            }else{
                                            if($page == 1){
                                                $back = "../liked/";
                                                echo("
                                                <li class='page-item disabled' style='pointer-events: none;'>
                                                <a class='page-link' onclick='document.location.href = `../liked/?page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                                                </li>
                                            ");
                                            }else{
                                                echo("
                                                <li class='page-item' style='cursor: pointer;'>
                                                <a class='page-link' onclick='document.location.href = `../liked/?page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                                                </li>
                                            ");
                                            }

                                            $start_page = $page;
                                            $end_page = $start_page + 3;
                                            $progress = true;

                                            if($page != 1){
                                                echo("
                                                <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../liked/?page=".($start_page - 1)."`;'>".($start_page - 1)."</a></li>
                                                ");
                                            }

                                            while ($start_page < $end_page && $start_page <= $num_page) {
                                                if($start_page == $page){
                                                echo("
                                                    <li class='page-item active' style='z-index: 0;'><a class='page-link'>".$start_page."</a></li>
                                                ");
                                                }else{
                                                echo("
                                                    <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../liked/?page=".$start_page."`;'>".$start_page."</a></li>
                                                ");
                                                }
                                                $start_page = $start_page + 1;
                                            }

                                            if ($num_page > 1 && $page > 0 && $num_page != $page) {
                                                $back = "../liked/";
                                            echo("
                                                <li class='page-item' style='cursor: pointer;'>
                                                    <a class='page-link' onclick='document.location.href = `../liked/?page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                                                </li>
                                            ");
                                            }else{
                                                $back = "../liked/";
                                                echo("
                                                <li class='page-item disabled'>
                                                    <a class='page-link' onclick='document.location.href = `../liked/?page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                                                </li>
                                                ");
                                            }                     
                                            }

                                            ?>
                                        </ul>
                                    </nav>
                                    <!-- /List Pagination -->
                                </div>
                                <!-- Wishlists -->
                                <div class="column is-4">
                                    <!-- List of Wishlists -->
                                    <div class="flat-card is-auto menu-card">
                                        <div class="card-title">
                                            <h3>Інформація 📝</h3>
        
                                            <div class="edit-account">
                                            </div>
                                        </div>
                                        <div class='cart-action' id='total_sum_block' style="margin: 20px;">
                                            <span class='cart-total' style='cursor: default;'>
                                                <p>Ціна за все:</p>
                                                <small style="font-size: 18px; color: #0023ff;">₴</small><span id='all_price' style="font-size: 24px; color: #0023ff;"><?php echo($all_price); ?></span>
                                                <p style="margin-top: 10px;">Кількість:</p>
                                                <span id='all_price' style="font-size: 21px; color: orange;"><?php echo($all_liked); ?></span>
                                                <br>
                                                <?php
                                                    if($all_liked > 0){
                                                        echo("
                                                        <a class='button feather-button primary-button btn-outlined' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `../checkout/?prod=all`;'>Оформити замовлення</a>
                                                        ");
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                        <!--
                                        <a href='/shop/liked/' class='button primary-button upper-button raised is-bold'>
                                            <span>Детальніше</span>
                                        </a>
                                        -->
                                    </div>
                                </div>
                            </div>
                            <!-- /Row -->

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
