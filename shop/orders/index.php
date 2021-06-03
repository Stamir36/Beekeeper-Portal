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
        
    <?php /*include '../../service/contextmenu.php'; */ include '../backmwnu.php';?>
            
            <!-- Main section -->
            <div class="section" style="padding-left: 7%; min-height: 750px;">
                <!-- Container -->
                <div class="container">
        
                    <!-- Account Layout -->
                    <div class="columns account-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="account-title">
                                <h2>Статус замовлень</h2>
                                <img class="brand-filigrane" src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" style="opacity: 0.1;">
                            </div>
        
                            <!-- Account tabs -->
                            <div class="tabs account-tabs">
                                <ul>
                                    <li><a href="../profile/">Профайл</a></li>
                                    <li><a href="../my/">Мої оголошення</a></li>
                                    <li><a href="../liked/">Кошик</a></li>
                                    <li class="is-active"><a>Замовлення</a></li>
                                </ul>
                            </div>


                            <h4 style="margin-bottom: 20px;">Мої замовлення</h4>
                            <div class="columns is-account-grid is-multiline">
                                
                            <?php
                                $product_query = $mysql->query("SELECT * FROM `shop_orders` WHERE `order_autor` = '$cook_id';");
                                $order_id = Array();
                                $product = Array(); //Идентификатор продукта
                                $name = Array(); // Имя покупателя
                                $phone = Array(); // Телефон покупателя 
                                $pochta = Array(); // Почта
                                $adress = Array(); // Адрес покупателя
                                $payment_methods = Array(); // Метод оплаты
                                $Create_Date = Array(); // Дата создания
                                $status = Array(); // Статус

                                while($result = $product_query->fetch_assoc()){
                                    $order_id[] = $result['id'];
                                    $product[] = $result['product'];
                                    $name[] = $result['name'];
                                    $phone[] = $result['phone']; 
                                    $pochta[] = $result['pochta'];
                                    $adress[] = $result['adress'];
                                    $payment_methods[] = $result['payment_methods'];
                                    $Create_Date[] = $result['Create_Date'];
                                    $status[] = $result['status'];
                                }

                                $num_prod = 0;

                                if(count($product) == count($name) && count($phone) != 0 && count($pochta) != 0 ){
                                    while($num_prod <= (count($product) - 1)){

                                        echo("
                                        <!-- Order card -->
                                        <div class='column is-4'>
                                            <div class='flat-card order-card has-popover-top'>
                                                <div class='order-info'>
                                                    <span>Замовлення-".$order_id[$num_prod]."</span>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("<span class='tag is-warning'>Чекаємо відправку</span>");
                                                    }else if($status[$num_prod] == "go"){
                                                        echo("<span class='tag is-primary'>Товар в дорозі</span>");
                                                    }else if($status[$num_prod] == "ok"){
                                                        echo("<span class='tag is-info'>Замовлення виконано</span>");
                                                    }else{
                                                        echo("<span class='tag is-primary'>Дані відсутні</span>");
                                                    }
                                                
                                                    echo("</div>
                                                <!-- Progress Circle -->
                                                <div class='circle-chart-wrapper'>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("
                                                        <svg class='circle-chart' viewbox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431' />
                                                            <circle class='circle-chart-circle' stroke='#0023ff' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431' />
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='box'></i>
                                                        </div>
                                                    ");
                                                    }else if($status[$num_prod] == "go"){
                                                        echo("
                                                        <svg class='circle-chart' viewBox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                            <circle class='circle-chart-circle' stroke='#eda514' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='truck'></i>
                                                        </div>
                                                    ");
                                                    }else if($status[$num_prod] == "ok"){
                                                        echo("
                                                        <svg class='circle-chart' viewBox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                            <circle class='circle-chart-circle' stroke='#FF7273' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='check'></i>
                                                        </div>
                                                    ");
                                                    }else{
                                                        echo("<span class='tag is-primary'>Дані відсутні</span>");
                                                    }
                                                    
                                                    echo("<!-- Label -->
                                                    <div class='ring-title has-text-centered'>
                                                        <span>Дата замовлення: ".date("d.m.Y", strtotime($Create_Date[$num_prod]))."</span>
                                                    </div>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("<a class='button feather-button secondary-button btn-outlined' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `../product/?id=".$product[$num_prod]."`;'>Сторінка товару</a>");
                                                    }else if($status[$num_prod] == "go"){
                                                        echo("<a class='button feather-button primary-button btn-outlined' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `status_ok.php?id=".$product[$num_prod]."`;'>Підтвердити отримання</a>");
                                                    }
                                                    
                                                
                                                    echo("</div>
                                            </div>
                
                                            <div class='webui-popover-content'>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Ім'я відправника</label>
                                                        <span>".$name[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Телефон</label>
                                                        <span>".$phone[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Пошта</label>");
                                                        if($pochta[$num_prod] == "newpochta"){
                                                            echo("<span>Нова пошта</span>");
                                                        }else{
                                                            echo("<span>Укрпошта</span>");
                                                        }
                                                echo("</div>
                                                </div>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Адреса пошти</label>
                                                        <span>".$adress[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <a class='button feather-button secondary-button btn-outlined' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `../product/?id=".$product[$num_prod]."`;'>Сторінка товару</a>
                                            </div>
                                        </div>
                                        ");
                                        $num_prod = $num_prod + 1;
                                    }
                                }else{
                                    echo("
                                        <div class='columns is-account-grid is-multiline' style='width: 100%; padding-left: 20px;'>
                                            <div class='column is-12'>
                                                <div class='flat-card is-auto empty-cart-card'>
                                                    <div class='empty-cart has-text-centered'>
                                                        <h3>Ще немає жодного замовлення</h3>
                                                        <small>Замовте що-небудь з товарів, і ордер з'явиться тут</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ");
                                }
                            ?>  
                                
                            </div>
                            <h4 style="margin-bottom: 20px;">Відправка замовлень</h4>
                            <div class="columns is-account-grid is-multiline">
                                
                            <?php
                                $product_query = $mysql->query("SELECT * FROM `shop_orders` WHERE `p_autor` = '$cook_id';");
                                $order_id = Array();
                                $product = Array(); //Идентификатор продукта
                                $name = Array(); // Имя покупателя
                                $phone = Array(); // Телефон покупателя 
                                $pochta = Array(); // Почта
                                $adress = Array(); // Адрес покупателя
                                $payment_methods = Array(); // Метод оплаты
                                $Create_Date = Array(); // Дата создания
                                $status = Array(); // Статус

                                while($result = $product_query->fetch_assoc()){
                                    $order_id[] = $result['id'];
                                    $product[] = $result['product'];
                                    $name[] = $result['name'];
                                    $phone[] = $result['phone']; 
                                    $pochta[] = $result['pochta'];
                                    $adress[] = $result['adress'];
                                    $payment_methods[] = $result['payment_methods'];
                                    $Create_Date[] = $result['Create_Date'];
                                    $status[] = $result['status'];
                                }

                                $num_prod = 0;

                                if(count($product) == count($name) && count($phone) != 0 && count($pochta) != 0 ){
                                    while($num_prod <= (count($product) - 1)){

                                        echo("
                                        <!-- Order card -->
                                        <div class='column is-4'>
                                            <div class='flat-card order-card has-popover-top'>
                                                <div class='order-info'>
                                                    <span>#-".$order_id[$num_prod]."</span>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("<span class='tag is-danger'>Чекаємо вашого відправлення</span>");
                                                    }else if($status[$num_prod] == "go"){
                                                        echo("<span class='tag is-warning'>Товар в дорозі</span>");
                                                    }else if($status[$num_prod] == "ok"){
                                                        echo("<span class='tag is-info'>Замовлення виконано</span>");
                                                    }else{
                                                        echo("<span class='tag is-primary'>Дані відсутні</span>");
                                                    }
                                                
                                                    echo("</div>
                                                <!-- Progress Circle -->
                                                <div class='circle-chart-wrapper'>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("
                                                        <svg class='circle-chart' viewBox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                            <circle class='circle-chart-circle' stroke='#00b289' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='box'></i>
                                                        </div>
                                                    ");
                                                    }else if($status[$num_prod] == "go"){
                                                        echo("
                                                        <svg class='circle-chart' viewBox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                            <circle class='circle-chart-circle' stroke='#eda514' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='truck'></i>
                                                        </div>
                                                    ");
                                                    }else if($status[$num_prod] == "ok"){
                                                        echo("
                                                        <svg class='circle-chart' viewBox='0 0 33.83098862 33.83098862' width='140' height='140' xmlns='http://www.w3.org/2000/svg'>
                                                            <circle class='circle-chart-background' stroke='#efefef' stroke-width='2' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                            <circle class='circle-chart-circle' stroke='#FF7273' stroke-width='2' stroke-dasharray='0' stroke-linecap='round' fill='none' cx='16.91549431' cy='16.91549431' r='15.91549431'></circle>
                                                        </svg>
                                                        <!-- Icon -->
                                                        <div class='chart-icon' style='top: 40%;'>
                                                            <i data-feather='check'></i>
                                                        </div>
                                                    ");
                                                    }else{
                                                        echo("<span class='tag is-primary'>Дані відсутні</span>");
                                                    }
                                                    
                                                    echo("<!-- Label -->
                                                    <div class='ring-title has-text-centered'>
                                                        <span>Дата замовлення: ".date("d.m.Y", strtotime($Create_Date[$num_prod]))."</span>
                                                    </div>");
                                                    if($status[$num_prod] == "complect"){
                                                        echo("<a class='button feather-button buy-button upper-button rounded is-bold raised' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `status_go.php?id=".$product[$num_prod]."`;'>Товар відправлено</a>");
                                                    }
                                                echo("</div>
                                            </div>
                
                                            <div class='webui-popover-content'>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Ім'я замовника</label>
                                                        <span>".$name[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Телефон</label>
                                                        <span>".$phone[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Пошта, для відправки</label>");
                                                        if($pochta[$num_prod] == "newpochta"){
                                                            echo("<span>Нова пошта</span>");
                                                        }else{
                                                            echo("<span>Укрпошта</span>");
                                                        }
                                                echo("</div>
                                                </div>
                                                <!-- Popover Block -->
                                                <div class='popover-flex-block'>
                                                    <div class='content-block'>
                                                        <label>Адреса пошти, на яку відправляти</label>
                                                        <span>".$adress[$num_prod]."</span>
                                                    </div>
                                                </div>
                                                <a class='button feather-button secondary-button btn-outlined' style='margin-top: 10px; width: 100%;' onclick='document.location.href = `../product/?id=".$product[$num_prod]."`;'>Сторінка товару</a>
                                            </div>
                                        </div>
                                        ");
                                        $num_prod = $num_prod + 1;
                                    }
                                }else{
                                    echo("
                                        <div class='columns is-account-grid is-multiline t_mobile' style='width: 100%; padding-left: 20px;'>
                                            <div class='column is-12'>
                                                <div class='flat-card is-auto empty-cart-card'>
                                                    <div class='empty-cart has-text-centered'>
                                                        <h3>Поки що нічого відправляти 🗳</h3>
                                                        <small>Як тільки хтось зробить замовлення, ордер з'явиться тут.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ");
                                }
                            ?>  
                                
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
