<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'wiki', time() + 3600 * 24, "/");
    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);
    
    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();
    
    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];

    if(isset($_GET["id"])){
      $id = $_GET["id"];
  }else{
      header("Location: /shop/");
  }

    $query_p = $mysql->query("SELECT * FROM `wiki` WHERE `id` = '$id'");
    $post = $query_p->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo($post['header']); ?> - портал пасічника. Найкращі статті.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Price Slider Stylesheets -->
    <link rel="stylesheet" href="../vendor/nouislider/nouislider.css">
    <!-- Google fonts - Playfair Display-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
    <!-- Google fonts - Poppins-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
    <!-- swiper-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
    <!-- Magnigic Popup-->
    <link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.css">
    <!-- Leaflet Maps-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
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
        <div class="d-flex align-items-center"><a href="../" class="navbar-brand py-1"><img src="../img/logo.png" alt="Directory logo" width="150px"></a>
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

    <!-- Hero Section-->
    <section style="background-image: url('../catalog/image/<?php echo($post['photo']);?>'); text-shadow: black 0.5px 0.5px 0, black -0.5px -0.5px 0,  black -0.5px 0.5px 0, black 0.5px -0.5px 0;" class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
      <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
          <div class="text-white mb-4 mb-lg-0">
            <div class="badge badge-pill badge-transparent px-3 py-2 mb-4" style="text-shadow: black 0px 0px 0, black 0px 0px 0,  black 0px 0px 0, black 0px 0px 0;"><?php echo($post['category']); ?></div>
            <h1 class="text-shadow verified"><?php echo($post['header']); ?></h1>
            <p><?php echo($user['name']); ?></p>
            <p>Час читання: <?php echo(round(intval($post['chtenieMIN'])+2)); ?> хвилин(и)</p>
          </div>
          <!--div class="calltoactions"><a href="../../forum/" onclick="$('#leaveReview').collapse('show')" data-smooth-scroll class="btn btn-primary">Обговорити на форумі</a></div-->
        </div>
      </div>
    </section>

    <section class="py-6">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <!-- About Listing-->
            <div class="text-block">
              <!--h3 class="mb-3">Глава</h3-->
              <p class="text-muted"><?php echo($post['body']);?></p>

            </div>
            <!--div class="text-block">
              <h3 class="mb-4">Ще</h3>
            </div-->

            <!--div class="text-block">
              <h3 class="mb-4">Теги статті</h3>
              <ul class="amenities-list list-inline">

                <li class="list-inline-item mb-3">
                  <div class="d-flex align-items-center">
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                    <span style="background-color: rgb(195, 255, 235); padding-left: 10px; padding-right: 10px; border-radius: 5px; margin: 5px;">#Тег</span>
                  </div>
                </li>

              </ul>
            </div -->
          </div>

          <div class="col-lg-4">
            <div class="pl-xl-4">
              <!-- Opening Hours      -->
              <div class="card border-0 shadow mb-5">
                <div class="card-header bg-gray-100 py-4 border-0">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="subtitle text-sm text-primary">Автор</p>
                      <h4 class="mb-0"><?php echo($post['author']); ?></h4>
                    </div>
                    <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ml-3 text-muted">
                      <use xlink:href="../#"> </use>
                    </svg>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table text-sm mb-0">
                    <tr>
                      <th class="pl-0 border-0"><?php echo($post['header']); ?></th>
                      <td class="pr-0 text-right border-0"><?php echo($post['Date_Create']); ?></td>
                    </tr>
                  </table>
                </div>
              </div>
        </div>
      </div>
    </section>
    
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
    <script>var basePath = ''</script>
    <!-- Main Theme JS file    -->
    <script src="js/theme.js"></script>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <script src="js/map-detail.js"></script>
    <script>
      createDetailMap({
          mapId: 'detailMap',
          mapCenter: [40.732346, -74.0014247],
          markerShow: true,
          markerPosition: [40.732346, -74.0014247],
          markerPath: 'img/marker.svg',
      })
    </script>
  </body>
</html>