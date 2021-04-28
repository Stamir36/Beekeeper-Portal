<?php
    $var_err = htmlspecialchars($_COOKIE["error"]);

    if($var_err == 1){
      echo("
      <script>
        var errors = 1;
      </script>
      ");
    }

    if( isset( $_POST['login_chek'] ) )
    {
      $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
      $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
      
      include "../service/config.php";

      $mysql = new mysqli($Host, $User, $Password, $Database);

      $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `email` = '$email' AND `password` = '$pass'");
      $user = $result->fetch_assoc();
      
      if(count($user) == 0){
        setcookie('error', 1, time() + 10, "/");
        header('Location: /login/');
      }else{
        setcookie('error', 1, time() - 10, "/");
        setcookie('mail', $user['email'], time() + 3600 * 24, "/");
        setcookie('name', $user['name'], time() + 3600 * 24, "/");
        setcookie('id', $user['id'], time() + 3600 * 24, "/");

        $mysql->close();

        // ВОЗВРАТ НА СТРАНИЦУ, С КОТОРОЙ ПЫТАЛИСЬ ВОЙТИ В АККАУНТ
        if(strlen(htmlspecialchars($_COOKIE["site_page"])) > 0){
          if(htmlspecialchars($_COOKIE["site_page"]) == "main"){
            header('Location: /');
          }elseif(htmlspecialchars($_COOKIE["site_page"]) == "forum"){
            header('Location: /forum/');
          }elseif(htmlspecialchars($_COOKIE["site_page"]) == "shop"){
            header('Location: /shop/');
          }else{
            header('Location: /');
          }
        }else{
          header('Location: /');
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Welcome to Rakon Multi-Purpose HTML5 Templates RTL Supported, built with HTML, JS, SASS, CSS3 and jQuery, RTL Supported, Easy User Experience and Responsive to all devices" />
  <meta name="keywords"
    content="HTML, CSS, JavaScript, Bootstrap, jQuery, Rakon, Themeforest, Template, envato, SASS, SCSS, HTML5, landing page, SaaS Product, SaaS Modern,  MultiPurpose, Crypto, Currency, ICO, Hosting, Agency, Mobile, App, Interior, Charity" />
  <meta name="author" content="Rakon - Creative Multi-Purpose HTML5 Templates" />

  <title>Вход в Beekeeper portal</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon" />
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="../assets/css/main/bootstrap.min.css" type="text/css" />
  <!-- animate -->
  <link rel="stylesheet" href="../assets/css/main/animate.css" type="text/css" />
  <!-- Swiper -->
  <link rel="stylesheet" href="../assets/css/main/swiper.min.css" />
  <!-- icons -->
  <link rel="stylesheet" href="../assets/css/main/icons.css" type="text/css" />
  <!-- aos -->
  <link rel="stylesheet" href="../assets/css/main/aos.css" type="text/css" />
  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/main/main.css" type="text/css" />
  <link rel="stylesheet" href="../assets/css/main/main_add.css" type="text/css" />
  <!-- normalize -->
  <link rel="stylesheet" href="../assets/css/main/normalize.css" type="text/css" />
  <!--New Style Beekeeper portal-->
  <link rel="stylesheet" href="../assets/css/main/new_style.css" type="text/css" />

  <!-- js for Brwoser -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="signup_full bg_dark">

  <!-- Start form_signup_onek -->
  <section class="form_signup_one signup_two">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-1 my-auto">

          <div class="item_brand margin-b-3">
            <a href="../login/">
              <img class="mr-2" src="../assets/img/logo-l.png" alt="">
              <span>Beekeeper portal.</span>
            </a>
          </div>

          <div class="title_sections margin-b-5">
            <h2 class="c-white mb-1">Вхід до акаунту</h2>
            <p class="c-orange2">Новий користувач? <a href="../registration/" style="color: yellow;">Створіть свій аккаунт зараз!</a></p>
          </div>

          <div class="no_mobile">
            <div class="list__point">
              <div class="item media">
                <div class="icob">
                  <i class="tio account_circle"></i>
                </div>
                <div class="media-body my-auto">
                  <p>Використовуй всі можливості сервісу</p>
                </div>
              </div>
              <div class="item media">
                <div class="icob">
                  <i class="tio explore_outlined"></i>
                </div>
                <div class="media-body my-auto">
                  <p>Вчися і розвивайся з безліччю навчальних матеріалів.</p>
                </div>
              </div>
              <div class="item media">
                <div class="icob">
                  <i class="tio call_talking"></i>
                </div>
                <div class="media-body my-auto">
                  <p>Спілкуйся з іншими користувачами або звертайся в підтримку. Тобі допоможуть і дадуть відповідь на всі питання!</p>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-7 col-lg-5 ml-lg-auto">
          <div class="item_group">
            <a style="font-size: 18px; margin-bottom: 20px; color: orange;">Добро пожаловатть!</a>
            <form method="POST" class="row">

              <div class="col-12">
                <div class="form-group">
                  <label>Email адресс</label>
                  <input type="email" name="email" class="form-control" placeholder="Ваша почта">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group --password" id="show_hide_password">
                  <label>Пароль</label>
                  <div class="input-group">
                    <input type="password" class="form-control" data-toggle="password" name="pass" placeholder="Введите ваш пароль"
                      required="" />
                    <div class="input-group-prepend hide_show">
                      <a href=""><span class="input-group-text tio hidden_outlined"></span></a>
                    </div>
                  </div>
                </div>
                <!--
                <a href="forgot-3.html" class="d-flex justify-content-end font-s-13 c-blue">Forgot Password?</a>
                -->
              </div>
              
              <div class="col-12" id="error_block" style="display: none;">
                <div class="alert alert-danger" role="alert">
                  <a style="font-size: 14px;">Не верно указаны данные, почта или пароль.</a>
                </div>
              </div>

              <div class="col-12">
                <input type="submit" class="btn w-100 margin-t-3 btn_account bg-orange-red c-white rounded-8" style="margin-bottom: 20px;" name="login_chek" value="Вход в аккаунт" />
                <a style="font-size: 14px;">Другой способ входа.</a>
                <a href="#" class="btn w-100 btn_account rounded-8" style="margin-top: 10px; background: rgb(235, 235, 220); color: #000">Вход с помощью Google</a>
                <a href="#" class="btn w-100 btn_account c-white rounded-8" style="margin-top: 10px; background: rgb(30, 102, 236);">Вход с помощью Facebook</a>
              </div>
              
            </form>
        </div>
    </div>
  </section>
  <!-- End.form_signup_one -->

  <!-- Start item_footer -->
  <div class="item_footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 offset-lg-1">
          <p>© 2021 <a href="http://unesell.pp.ua" target="_blank">Unesell Studio.</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- End. item_footer -->


  <!-- Back to top with progress indicator-->
  <div class="prgoress_indicator">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>

  <!-- jquery -->
  <script src="../assets/js/jquery-3.5.0.js" type="text/javascript"></script>
  <!-- jquery-migrate -->
  <script src="../assets/js/jquery-migrate.min.js" type="text/javascript"></script>
  <!-- popper -->
  <script src="../assets/js/popper.min.js" type="text/javascript"></script>
  <!-- bootstrap -->
  <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!--
  ============
  vendor file
  ============
   -->
  <!-- particles -->
  <script src="../assets/js/vendor/particles.min.js" type="text/javascript"></script>
  <!-- TweenMax -->
  <script src="../assets/js/vendor/TweenMax.min.js" type="text/javascript"></script>
  <!-- ScrollMagic -->
  <script src="../assets/js/vendor/ScrollMagic.js" type="text/javascript"></script>
  <!-- animation.gsap -->
  <script src="../assets/js/vendor/animation.gsap.js" type="text/javascript"></script>
  <!-- addIndicators -->
  <script src="../assets/js/vendor/debug.addIndicators.min.js" type="text/javascript"></script>
  <!-- Swiper js -->
  <script src="../assets/js/vendor/swiper.min.js" type="text/javascript"></script>
  <!-- countdown -->
  <script src="../assets/js/vendor/countdown.js" type="text/javascript"></script>
  <!-- simpleParallax -->
  <script src="../assets/js/vendor/simpleParallax.min.js" type="text/javascript"></script>
  <!-- waypoints -->
  <script src="../assets/js/vendor/waypoints.min.js" type="text/javascript"></script>
  <!-- counterup -->
  <script src="../assets/js/vendor/jquery.counterup.min.js" type="text/javascript"></script>
  <!-- charming -->
  <script src="../assets/js/vendor/charming.min.js" type="text/javascript"></script>
  <!-- imagesloaded -->
  <script src="../assets/js/vendor/imagesloaded.pkgd.min.js" type="text/javascript"></script>
  <!-- BX-Slider -->
  <script src="../assets/js/vendor/jquery.bxslider.min.js" type="text/javascript"></script>
  <!-- Sharer -->
  <script src="../assets/js/vendor/sharer.js" type="text/javascript"></script>
  <!-- sticky -->
  <script src="../assets/js/vendor/sticky.min.js" type="text/javascript"></script>
  <!-- Aos -->
  <script src="../assets/js/vendor/aos.js" type="text/javascript"></script>
  <!-- main file -->
  <script src="../assets/js/main.js" type="text/javascript"></script>
  <script src="error.js" type="text/javascript"></script>
</body>

</html>