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
<?php
include '../service/contextmenu.php';
?>
<html lang="ua">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Енциклопедія та статті - Beekeeper portal.</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Price Slider Stylesheets -->
  <link rel="stylesheet" href="vendor/nouislider/nouislider.css">
  <!-- Google fonts - Playfair Display-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
  <!-- Google fonts - Poppins-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
  <!-- swiper-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
  <!-- Magnigic Popup-->
  <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.png">
  <style>
    @font-face {
      font-family: Unecoin;
      /* Имя шрифта */
      src: url(../assets/fonts/font_bolt.ttf);
      /* Путь к файлу со шрифтом */
    }

    html {
      font-family: Unecoin;
    }
  </style>
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body style="padding-top: 72px;">
  <header class="header">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
      <div class="container-fluid">
        <div class="d-flex align-items-center"><a href="../wiki" class="navbar-brand py-1"><img src="img/logo.png" alt="Directory logo" width="150px"></a>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Головна сторінка <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
        <!-- Navbar Collapse -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="/wiki/catalog/" class="nav-link">Статті</a></li>
            <li class="nav-item"><a href="/wiki/docs/" class="nav-link">Енциклопедія</a></li>
            <li class="nav-item mt-3 mt-lg-0 ml-lg-3 d-lg-none d-xl-inline-block"><a href="/wiki/new/" class="btn btn-primary">+ Написати статтю</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /Navbar -->
  </header>
  <section class="hero-home">
    <div class="swiper-container hero-slider">
      <div class="swiper-wrapper dark-overlay">
        <div style="background-image:url(https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2018/04/Gradient-Featured-Image-03.jpg)" class="swiper-slide"></div>
      </div>
    </div>
    <div class="container py-6 py-md-7 text-white z-index-20">
      <div class="row">
        <div class="col-xl-10">
          <div class="text-center text-lg-left">
            <p class="subtitle letter-spacing-4 mb-2 text-secondary text-shadow">Заходи та читай кращі статті</p>
            <h1 class="display-3 font-weight-bold text-shadow">Енциклопедія пасічника</h1>
          </div>
          <div class="search-bar mt-5 p-3 p-lg-1 pl-lg-4">

            <form action="/wiki/search/" method="GET">
              <div class="row">
                <div class="pc_viev">
                  <input type="text" name="search" placeholder="Що хочете знайти?" class="form-control border-0 shadow-0" style="width: 100%;">
                </div>
                <div class="col-lg-2" style="margin-left: auto; margin-right: 0.2em;">
                  <button type="submit" class="btn btn-primary btn-block rounded-xl h-100">Пошук </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 bg-gray-100">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <p class="subtitle text-secondary">Досліджуй більше</p>
          <h2>Останні статті</h2>
        </div>
        <div class="col-md-4 d-md-flex align-items-center justify-content-end"><a href="catalog/" class="text-muted text-sm">
          Дивитися всі статті<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
      
      <div class="row">
        
        <style>
          @media (min-width: 991px) {
            .t_mobile {
              width: 100%;
              margin: 15px;
            }
          }

          @media (max-width: 991px) {
            .t_mobile {
              width: 90%;
              margin-top: 15px;
            }
          }
        </style>
        <?php
        $wiki = $mysql->query("SELECT * FROM `wiki` ORDER BY id DESC limit 20");
        $category = array();
        $id_wiki = array();
        $data = array();
        $photo = array();
        $name = array();
        $text = array();
        $chas = array();


        while ($result = $wiki->fetch_assoc()) {
          $category[] = $result['category'];
          $id_wiki[] = $result['id'];
          $photo[] = $result['photo'];
          $name[] = $result['header'];
          $text[] = $result['body'];
          $data[] = $result['Date_Create'];
          $chas[] = $result['chtenieMIN'];
        }

        $num_wiki = 0;

        if (count($photo) == count($name) && count($data) != 0 && count($name) != 0) {
          while ($num_wiki <= (count($name) - 1) && $num_wiki != 3) {
            echo ("
                <div class='col-lg-4 col-sm-6 mb-4'>
                  <div class='card shadow border-0 h-100'><a href='post/?id=".$id_wiki[$num_wiki]."'><img style='max-height: 300px;' src='../wiki/catalog/image/" . $photo[$num_wiki] . "' alt='...' class='img-fluid card-img-top'/></a>
                    <div class='card-body'><a href='post/?id=".$id_wiki[$num_wiki]."' class='text-uppercase text-muted text-sm letter-spacing-2'>".$category[$num_wiki]."</a>
                      <h5 class='my-2'><a href='post/?id=".$id_wiki[$num_wiki]."' class='text-dark'>".$name[$num_wiki]."</a></h5>
                      <p class='text-gray-500 text-sm my-3'><i class='far fa-clock mr-2'></i>".round(intval($chas[$num_wiki])+2)." хвилин(и) читання</p>
                      <p class='my-2 text-muted text-sm'>".mb_strimwidth($text[$num_wiki], 0, 50, '...')."</p><a href='post/?id=".$id_wiki[$num_wiki]."' class='btn btn-link pl-0'>Читати далі<i class='fa fa-long-arrow-alt-right ml-2'></i></a>
                    </div>
                  </div>
                </div>
                  ");
            $num_wiki = $num_wiki + 1;
          }
        } else {
          echo ("<a class='t_mobile' href='new/' style='color: #322EFF; text-align: center; background-color: #fff; padding: 10px; border-radius: 4px;'>Ще немає жодної статті. Будь першим!</a>");
        }
        ?>
      </div>


    </div>
  </section>

  <!--section class="py-6 bg-white">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8">
          <p class="subtitle text-primary">Початор роботи</p>
          <h2>Як користуватись?</h2>
        </div>
        <div class="col-md-4 d-lg-flex align-items-center justify-content-end">
          <a href="video/" class="text-muted text-sm">

            Дивитись всі відео<i class="fas fa-angle-double-right ml-2"></i></a></div>
      </div>
      <div class="row">
        <div class="swiper-container guides-slider">

        </div>
      </div>
    </div>
  </section-->

  <section class="py-7 position-relative dark-overlay"><img src="https://cdn.dribbble.com/users/45782/screenshots/11304218/gradient_02_a.jpg" alt="" class="bg-image">
    <div class="container">
      <div class="overlay-content text-white py-lg-5">
        <h3 class="display-3 font-weight-bold text-serif text-shadow mb-5">Чи готові почати з основ?</h3><a href="docs/" class="btn btn-light">Почати</a>
      </div>
    </div>
  </section>

  <!-- Footer-->
  <footer class="position-relative z-index-10 d-print-none">
    <div class="py-6 bg-gray-200 text-muted">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="font-weight-bold text-uppercase text-dark mb-3">Енциклопедія</div>
            <p>&copy; 2021 Beekeeper portal / Unesell Studio</p>
            <div class="names_user" style="padding-left: 10px;">
            <?php
              if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                if($premium == "yes"){
                  echo("<span class='badge bg-warning text-dark'>Premium</span>");
                }
                echo("
                    <a id='user' style='color: black; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$user['name']."</a>
                    <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                ");
              }else{
                echo("
                    <a id='user' style='color: black; font-weight: 400; padding-right: 15px;'>Вход не выполнен</a>
                    <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                ");
              }
            ?>
          </div>
          </div>
          <!--div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
            <h6 class="text-uppercase text-dark mb-3">Меню</h6>
            <ul class="list-unstyled">
              <li><a href="#" class="text-muted">Категорія </a></li>
              <li><a href="#" class="text-muted">Категорія </a></li>
              <li><a href="#" class="text-muted">Категорія </a></li>
              <li><a href="#" class="text-muted">Категорія </a></li>
              <li><a href="#" class="text-muted">Категорія </a></li>
            </ul>
          </div-->
        </div>
      </div>
    </div>
  </footer>

  <script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }
    // to avoid CORS issues when viewing using file:// protocol, using the demo URL for the SVG sprite
    // use your own URL in production, please :)
    // https://demo.bootstrapious.com/directory/1-0/icons/orion-svg-sprite.svg
    //- injectSvgSprite('icons/orion-svg-sprite.svg'); 
    injectSvgSprite('https://demo.bootstrapious.com/directory/1-1/icons/orion-svg-sprite.svg');
  </script>
  <!-- jQuery-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap JS bundle - Bootstrap + PopperJS-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Magnific Popup - Lightbox for the gallery-->
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <!-- Smooth scroll-->
  <script src="vendor/smooth-scroll/smooth-scroll.polyfills.min.js"></script>
  <!-- Bootstrap Select-->
  <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <!-- Object Fit Images - Fallback for browsers that don't support object-fit-->
  <script src="vendor/object-fit-images/ofi.min.js"></script>
  <!-- Swiper Carousel                       -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
  <script>
    var basePath = ''
  </script>
  <!-- Main Theme JS file    -->
  <script src="js/theme.js"></script>
</body>

</html>