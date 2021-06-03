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

    if($_GET['prod'] == 'all'){
        $price_count = $mysql->query("SELECT SUM(product_price) FROM `liked_shop` WHERE `user_liked` = '$cook_id' ");
        $arrl_price = $price_count->fetch_assoc();
        $all_price = $arrl_price['SUM(product_price)'];
        if($all_price == ""){ $all_price = 0; }

        $result_count = $mysql->query("SELECT COUNT(*) FROM `liked_shop` WHERE `user_liked` = '$cook_id' ");
        $count_num = $result_count->fetch_assoc();
        $all_liked = $count_num['COUNT(*)'];
    }else{
        if(is_numeric($_GET['prod'])){
            $id = $_GET['prod'];
            $result = $mysql->query("SELECT * FROM `shop_product` WHERE `id` = '$id'");
            $product = $result->fetch_assoc();
        }
    }
    if($_GET['prod'] == ''){
        $all_price = 0;
        $all_liked = 0;
    }
    /*      <?php echo();?>      */
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Оформлення замовлення - портал пасічників</title>
        <link rel="icon" type="image/png" href="../assets/images/logo/nephos.png" />

        <!--Core CSS -->
        <link rel="stylesheet" href="https://nephos.cssninja.io/assets/css/main.css">
        <link rel="stylesheet" href="https://nephos.cssninja.io/assets/css/app.css">
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
            body{
                font-family: Unecoin;
            }
        </style>
        <script>
            let photo = false;
        </script>
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        
    
    <!-- Pageloader -->   
    <div class="pageloader"></div>
        <div class="infraloader is-active"></div>

        <!-- Main Sidebar-->
        <div class="main-sidebar">
            <div class="sidebar-brand">
                <a href="/../../../../shop/"><img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt=""></a>
            </div>
            <div class="sidebar-inner">
                <ul class="icon-menu">
                    <!-- Shop sidebar trigger -->
                    <li>
                        <a onclick="window.history.back()" id="open-shop"><i data-feather="chevrons-left"></i></a>
                    </li>  
                </ul>
        
                <!-- User account -->
                <ul class="bottom-menu is-hidden-mobile">
                    <li>
                    <?php
                        if(strlen(htmlspecialchars($_COOKIE["id"])) > 0){ // ПОИСК АВТОРИЗАЦИИ
                            echo("
                                <a href='/shop/profile/'><i>    
                                <img id='user_avatar' src='/../../../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                            ");
                        }else{
                            echo("
                                <a href='/login/'><i> 
                                <img data-feather='user' id='user_avatar' src='/../../../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                            ");
                        }
                    ?>
                </i></a></li>
                </ul>
            </div>
        </div>

        <!-- /Main Sidebar-->
        <div class="action-bar is-centered is-mobile">
            <div class="steps-wrapper">
                <ol class="step-list">
                    <li class="active" id="step_1"></li>
                    <li id="step_2"></li>
                    <li id="step_3"></li>
                    <li id="step_4"></li>
                </ol>
            </div>
        </div>
        <link rel="stylesheet" href="style.css">
       
        <!-- Main section -->
       <form action="check.php" method="post" id="FormID">
        <div id="checkout-1" class="section no-padding">
            <div class="checkout-wrapper" data-checkout-step="1">
            
                <!--Checkout step 1-->
                <div class="checkout-main">
                    <div class="checkout-container">
                        <div class="flex-table">
                                            
                            <div class="inner">
                        
                                <div class="tabs-wrapper underline-tabs animated-tabs">
                                    <div class="tabs" style="display: none;">
                                        <ul>
                                            <li class="is-active" data-tab="t4"><a>Корзина</a></li>
                                            <li data-tab="t5" id="t5_c"><a>Данные</a></li>
                                            <li data-tab="t6" id="t6_c"><a>Оплата</a></li>
                                        </ul>
                                    </div>
                                    <div id="t4" class="navtab-content is-active">
                                        <h2 style="font-size: 21px;">Ваше замовлення</h2>
                                        <!--Table header-->
                                        <div class="flex-table-header" style="text-align: left;">
                                            <span style="font-family: Unecoin;" class="product"><span style="font-family: Unecoin;">Оголошення</span></span>
                                            <span style="font-family: Unecoin;" class="" style="width: 0px; text-align: left;">Ціна</span>
                                        </div>
                                    <?php
                                            if($_GET['prod'] == ''){
                                                echo("
                                                    <div class='flex-table-item'>
                                                        <div class='product'>
                                                            <span style='font-family: Unecoin;' class='product-name'>Немає товарів</span>
                                                        </div>
                                                    </div>
                                                ");
                                            }
                                            

                                            if($_GET['prod'] == 'all'){
                                                $liked = $mysql->query("SELECT * FROM `liked_shop` WHERE `user_liked` = '$cook_id'");
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
                                                            <div class='flex-table-item'>
                                                                <div class='product'>
                                                                    <img src='/shop/catalog/image/".$product_image[$num_prod]."' alt=''>
                                                                    <span style='font-family: Unecoin;' class='product-name'>".$name_product[$num_prod]."</span>
                                                                </div>
                                                                <div class='product'>
                                                                    <span style='font-family: Unecoin; mardin: 0px; color:orange;'>₴".$product_price[$num_prod]."</span>
                                                                </div>
                                                            </div>
                                                            ");
                                                            $num_prod = $num_prod + 1;
                                                        }
                                                    }else{
                                                        echo("
                                                            <div class='flex-table-item'>
                                                                <div class='product'>
                                                                    <span style='font-family: Unecoin;' class='product-name'>Немає товарів</span>
                                                                </div>
                                                            </div>
                                                        ");
                                                    }
                                                
                                            }else{
                                                if(is_numeric($_GET['prod'])){
                                                    echo("
                                                        <div class='flex-table-item'>
                                                            <div class='product'>
                                                                <img src='/shop/catalog/image/".$product['photo']."' alt=''>
                                                                <span style='font-family: Unecoin;' class='product-name'>".$product['name']."</span>
                                                            </div>
                                                            <div class='product'>
                                                                <span style='font-family: Unecoin; mardin: 0px; color:orange;'>₴".$product['price']."</span>
                                                            </div>
                                                        </div>
                                                    ");
                                                    $all_price = $product['price'];
                                                    $all_liked = 1;
                                                }
                                            }


                                        ?>
                                    </div>
                                    <div id="t5" class="navtab-content">
                                        <input type="text" name="product" value="<?php echo($_GET['prod']); ?>" style="display: none;">
                                        <h2 style="font-size: 21px;">Інформація отримувача</h2><br>
                                        <h2 style="font-size: 18px; font-weight: 600;">Отримувач</h2><br>
                                        <p>Повне ім'я отримувача</p>
                                        <input class="input is-default" type="name" id="name" name="name" placeholder="" onclick="document.getElementById('error_name').style = 'display: none;';">
                                        <label id="error_name" style="display: none;" for="form_street" class="form-label"><a id="error_name_text" style="color: red; cursor: default; font-weight: 500;"></a></label>
                                        <p style="margin-top: 5px;">Номер телефону</p>
                                        <input class="input is-default" type="phone" id="phone" name="phone" placeholder="" onclick="document.getElementById('error_phone').style = 'display: none;';"><br>
                                        <label id="error_phone" style="display: none;" for="form_street" class="form-label"><a id="error_phone_text" style="color: red; cursor: default; font-weight: 500;"></a></label>
                                        <br><h2 style="font-size: 18px; font-weight: 600;">Доставка</h2><br>

                                        <div id="payment-methods-main" class="checkout-payment-methods" style="margin: 0px 0;">
                                            <div class="payment-methods-grid" style="margin: 0px 0;">
                                                <div class="columns is-multiline">
                                                    <!--Payment Method-->
                                                    <div class="column is-6">
                                                        <div class="method-card">
                                                            <input id="newpochta" type="radio" name="pochta" value="newpochta" data-value-id="newpochta">
                                                            <div class="method-card-inner">
                                                                <div class="icon-container">
                                                                    <img src="/shop/assets/images/logo/newpochta.png" alt="">
                                                                    <div class="indicator gelatine">
                                                                        <i data-feather="check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="meta">
                                                                    <h3>Нова пошта</h3>
                                                                    <p>Продавець відпривить товар "Новою поштою".</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column is-6">
                                                        <div class="method-card">
                                                            <input id="ukrposhta" type="radio" name="pochta" value="ukrposhta" data-value-id="ukrposhta">
                                                            <div class="method-card-inner">
                                                                <div class="icon-container">
                                                                    <img src="/shop/assets/images/logo/ukrposhta.png" alt="">
                                                                    <div class="indicator gelatine">
                                                                        <i data-feather="check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="meta">
                                                                    <h3>Укрпошта</h3>
                                                                    <p>Продавець відпривить товар "Укрпоштою".</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div><br>
                                        <p>Адреса відділення (Місто, Номер відділення)</p>
                                        <input class="input is-default" type="name" id="adress" name="adress" placeholder="" onclick="document.getElementById('error_adress').style = 'display: none;';">
                                        <label id="error_adress" style="display: none;" for="form_street" class="form-label"><a id="error_adress_text" style="color: red; cursor: default; font-weight: 500;"></a></label>
                                    </div>
                                    <div id="t6" class="navtab-content">
                                        <h2 style="font-size: 21px;">Метод оплати</h2>
                                        <p>Виберіть зручний для вас метод оплати замовлення.</p>
                                            <div id="payment-methods-main" class="checkout-payment-methods">
                                            <div class="payment-methods-grid">
                                                <div class="columns is-multiline">

                                                    <!--Payment Method-->
                                                    <div class="column is-6">
                                                        <div class="method-card">
                                                            <input id="card" type="radio" name="payment_methods" value="card" data-value-id="card" disabled>
                                                            <div class="method-card-inner">
                                                                <div class="icon-container">
                                                                    <img src="https://img.icons8.com/fluent/48/000000/bank-card-front-side.png" alt="">
                                                                    <div class="indicator gelatine">
                                                                        <i data-feather="check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="meta">
                                                                    <h3>Онлайн оплата</h3>
                                                                    <p>Вибачте, але цей спосіб поки що недоступний.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--Payment Method-->
                                                    <div class="column is-6">
                                                        <div class="method-card">
                                                            <input id="money" type="radio" name="payment_methods" value="money" data-value-id="money">
                                                            <div class="method-card-inner">
                                                                <div class="icon-container">
                                                                    <img src="https://img.icons8.com/fluent/48/000000/cash-in-hand.png" alt="">
                                                                    <div class="indicator gelatine">
                                                                        <i data-feather="check"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="meta">
                                                                    <h3>При отриманні</h3>
                                                                    <p>Відправка замовлення післяплатою. Обговорюйте з продавцем.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--div class="coupon-wrapper">
                            <h3>Apply Coupon Code</h3>
                            <p>Enter any promotional code you have here. Promotional codes can only be used once.</p>
                            <div class="field">
                                <div class="control has-icon is-bigger">
                                    <input type="text" class="input is-default" placeholder="Paste Coupon Code">
                                    <div class="form-icon">
                                        <i data-feather="tag"></i>
                                    </div>
                                    <button style="font-family: Unecoin;" class="button primary-button raised coupon-button">Apply Coupon</button>
                                </div>
                            </div>
                        </div-->

                    </div>
        </div>
       </form>
       


                <!-- ////////////////////////////////////////////////////////////////////////////////////////////// BACK MENU ////////////////////////////////////////////////////////////////////////////////////////////-->
                <div class="checkout-side">
                    <div class="side-header">
                        <h2 style="font-family: Unecoin;" class="side-title">Оформлення</h2>
                        <a onclick="window.history.back()" class="button is-rounded checkout-back">Назад</a>
                    </div>
                    <div class="side-inner has-slimscroll">
                        <div class="side-card user-card">
                            <div class="avatar-container">
                                <img id="checkout-avatar" src="/data/users/avatar/<?php echo($avatar); ?>" alt="">
                            </div>
                            <div class="meta">
                                <span style="font-family: Unecoin;">Оформлення на</span>
                                <span style="font-family: Unecoin;" id="checkout-username"><?php echo($name); ?></span>
                            </div>
                        </div>

                        <div class="side-card is-address">
                            <label class="form-switch is-vhidden">
                                <input id="shipping-switch" type="checkbox" class="is-switch">
                                <i></i>
                            </label>
                            <h3 class="address-title" style="font-family: Unecoin;">Адреса доставки</h3>
                            <p class="address">
                                <var id="shipping-address1">Не заповнено</var>
                            </p>
                        </div>

                        <div class="side-card is-totals">
                            <h3 class="info-title" style="font-family: Unecoin;">Деталі платежу</h3>
                            <div class="payment-block">
                                <span style="font-family: Unecoin;">Кількість товарів</span>
                                <div></div>
                                <span style="font-family: Unecoin;" ><?php echo($all_liked);?></span>
                            </div>
                            <div class="payment-block">
                                <span style="font-family: Unecoin;" class="is-bold">Ціна</span><div></div>
                                <span style="font-family: Unecoin;" id="checkout-grandtotal-value" class="has-price is-bold">₴<?php echo($all_price);?></span>
                            </div>
                        </div>

                        <div class="side-action">
                            <a style="font-family: Unecoin;" id="checkout-next" class="button primary-button raised is-fullwidth is-rounded" <?php if($_GET['prod'] == ''){echo("disabled");} if($_GET['prod'] != ''){echo('onclick=next()');}?> >Продовжити</a>
                            <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
                            <script>
                                var tab = 1;
                                document.getElementById("newpochta").click();
                                document.getElementById("money").click();
                                function next(){
                                    if(tab == 1){
                                        document.getElementById("t5_c").click();
                                        document.getElementById("step_2").className = "active";
                                        tab = 2;
                                        return;
                                    }
                                    if(tab == 2){
                                        var name = false;
                                        var phone = false;
                                        var adress = false;

                                        if(document.getElementById("name").value.length > 4){
                                            if(Censorship(document.getElementById("name").value)){
                                                document.getElementById("error_name").style = "display: inline;";
                                                document.getElementById("error_name_text").textContent = "Вибачте, але ваш текст містить слова, які забороненно вживати в системі!";
                                                name = false;
                                            }else{
                                                name = true;
                                            }
                                        }else{
                                            document.getElementById("error_name").style = "display: inline;";
                                            document.getElementById("error_name_text").textContent = "Ваш текст дуже меленький. Напишіть більше слів.";
                                            name = false;
                                        }

                                        if(document.getElementById("phone").value.length > 6){
                                            if(Censorship(document.getElementById("phone").value)){
                                                document.getElementById("error_phone").style = "display: inline;";
                                                document.getElementById("error_phone_text").textContent = "Вибачте, але це не номер телефону.";
                                                phone = false;
                                            }else{
                                                phone = true;
                                            }
                                        }else{
                                            document.getElementById("error_phone").style = "display: inline;";
                                            document.getElementById("error_phone_text").textContent = "Вибачте, але номер телефону дуже короткий.";
                                            phone = false;
                                        }
                                        
                                        if(document.getElementById("adress").value.length > 6){
                                            if(Censorship(document.getElementById("adress").value)){
                                                document.getElementById("error_adress").style = "display: inline;";
                                                document.getElementById("error_adress_text").textContent = "Вибачте, але це не адресса.";
                                                adress = false;
                                            }else{
                                                adress = true;
                                            }
                                        }else{
                                            document.getElementById("error_adress").style = "display: inline;";
                                            document.getElementById("error_adress_text").textContent = "Вибачте, але ваша адреса відділення дуже коротка.";
                                            adress = false;
                                        }
                                        
                                        if(name == true && phone == true && adress == true){
                                            document.getElementById("checkout-username").textContent = document.getElementById("name").value;
                                            document.getElementById("shipping-address1").textContent = document.getElementById("adress").value;
                                            document.getElementById("t6_c").click();
                                            document.getElementById("step_3").className = "active";
                                            tab = 3;
                                            return;
                                        }
                                    }
                                    if(tab == 3){
                                        var form = document.getElementById("FormID");
                                        form.submit();
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main section -->
        <div id="checkout-blocked-modal" class="modal checkout-blocked-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <img src="assets/img/logo/nephos-greyscale.svg" alt="">
                        <span style="font-family: Unecoin;"></span>
                    </div>
                    <div class="box-body">
                        <div class="inner-content">
                            <div class="modal-placeholder">
                                <div class="placeholder-content">
                                    <img src="assets/img/illustrations/payment.svg" alt="">
                                    <h3>Checkout is Blocked</h3>
                                    <p>You currently don't have any checkout data. Please start checkout from the cart page.</p>
                                    <div class="button-wrap">
                                        <a href="cart.html" class="button big-button primary-button rounded raised">View My Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="checkout-unauth-modal" class="modal checkout-unauth-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <img src="assets/img/logo/nephos-greyscale.svg" alt="">
                        <span style="font-family: Unecoin;"></span>
                    </div>
                    <div class="box-body">
                        <div class="inner-content">
                            <div class="modal-placeholder">
                                <div class="placeholder-content">
                                    <img src="assets/img/illustrations/login.svg" alt="">
                                    <h3>Hello, guest</h3>
                                    <p>You cannot start checking out without being logged to your account. Please login to your account first.</p>
                                    <div class="button-wrap">
                                        <a href="authentication.html" class="button big-button primary-button rounded raised">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <!-- /Main wrapper -->
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>
        </body>  
</html>
