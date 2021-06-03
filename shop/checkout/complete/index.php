<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'shop', time() + 3600 * 24, "/");
    if(strlen($cook_id) > 0){
        include "../../../service/config.php";

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
<html lang="ua" style="background-color: rgba(237, 237, 237, 1);">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Оформлення замовлення - портал пасічників</title>
        <link rel="icon" type="image/png" href="../../assets/images/logo/nephos.png" />

        <!--Core CSS -->
        <link rel="stylesheet" href="https://nephos.cssninja.io/assets/css/main.css">
        <link rel="stylesheet" href="https://nephos.cssninja.io/assets/css/app.css">
        <link rel="stylesheet" href="../../assets/css/content.css">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
        
        <!-- plugins -->
        <link rel="stylesheet" href="../../assets/js/slick/slick.css">
        <link rel="stylesheet" href="../../assets/js/slick/slick-theme.css">
        <link rel="stylesheet" href="../../assets/js/webuipopover/jquery.webui-popover.min.css">
        <link rel="stylesheet" href="../../assets/js/izitoast/css/iziToast.min.css">
        <link rel="stylesheet" href="../../assets/js/zoom/zoom.css">
        <link rel="stylesheet" href="../../assets/js/jpcard/card.css">
        <link rel="stylesheet" href="../../assets/css/chosen/chosen.css">
        <link rel="stylesheet" href="../../assets/css/icons.min.css">
        <style>
            @font-face {
                font-family: Unecoin; /* Имя шрифта */
                src: url(../../../../../../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
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
                <a href="/../../../../../../../../shop/"><img src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" alt=""></a>
            </div>
            <div class="sidebar-inner">
                <ul class="icon-menu">
                    <!-- Shop sidebar trigger -->
                    <li>
                        <a href="../../liked/" id="open-shop"><i data-feather="chevrons-left"></i></a>
                    </li>  
                </ul>
        
                <!-- User account -->
                <ul class="bottom-menu is-hidden-mobile">
                    <li>
                    <?php
                        if(strlen(htmlspecialchars($_COOKIE["id"])) > 0){ // ПОИСК АВТОРИЗАЦИИ
                            echo("
                                <a href='/shop/profile/'><i>    
                                <img id='user_avatar' src='/../../../../../../../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                            ");
                        }else{
                            echo("
                                <a href='/login/'><i> 
                                <img data-feather='user' id='user_avatar' src='/../../../../../../../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                            ");
                        }
                    ?>
                </i></a></li>
                </ul>
            </div>
        </div>

        <!-- /Main Sidebar-->
        <div class="action-bar is-centered is-mobile" style="width: 100%;">
            <div class="steps-wrapper">
                <ol class="step-list">
                    <li class="active" id="step_1"></li>
                    <li class="active" id="step_2"></li>
                    <li class="active" id="step_3"></li>
                    <li class="active" id="step_4"></li>
                </ol>
            </div>
        </div>
        <link rel="stylesheet" href="style.css">
       
        <!-- Main section -->
       <form action="" method="post" id="FormID">
        <div id="checkout-1" class="section no-padding">
            <div class="checkout-wrapper" style="display: inline;">
            
            <div class="checkout-main" style="width: 100%;">
                    <div class="checkout-container">
                        <div class="checkout-success">
                            <div class="success-card" style="margin-top: 100px;">
                                <div class="success-content has-text-centered">
                                    <svg class="SuccessAnimation is-primary animated" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70">
                                        <path class="SuccessAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"></path>
                                        <circle class="SuccessAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"></circle>
                                        <polyline class="SuccessAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"></polyline>
                                    </svg>
                                    <h3>Замовлення виконано!</h3>
                                    <p>Дякуємо вам! Тепер потрібно почекати, коли це побачить продавець і відправить вам товар.</p>
                                    <div class="button-wrap" onclick="document.location.href = '../../orders/';">
                                        <a href="../../orders/" class="button primary-button" >Мої замовлення</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       </form>
       


                <!-- ////////////////////////////////////////////////////////////////////////////////////////////// BACK MENU ////////////////////////////////////////////////////////////////////////////////////////////-->
                
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
        <script src="../../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../../assets/js/nephos.js"></script>
        </body>  
</html>
