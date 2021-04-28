<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'forum', time() + 3600 * 24, "/");

    include "../config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];
    
?>
<!DOCTYPE html>
<html lang="en" >
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Преміум функції - портал пасічників</title>
      <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
      <style>
        .round{
          border-radius: 100px; /* Радиус скругления */
          border: 3px solid #677eff;
        }
        @font-face {
          font-family: Unecoin; /* Имя шрифта */
          src: url(../../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
        }
        body{
          font-family: Unecoin;
        }
      </style>
  </head>
<body>

<header>
  <nav class="navbar fixed-top navbar-toggleable-sm navbar-inverse bg-inverse">
    <div class="container">
      
      <a class="navbar-brand" href="../../" style="color: #ffffff; font-weight: 600;"><img src="https://img.icons8.com/clouds/100/000000/money.png" style="width: 30px; height: 30px;"/>   Преміум</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto" style="padding-top: 5px;">
                  <li class="nav-item active">
                  <a class="nav-link scroll" href="#top">Потаток</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link scroll" href="#features">Особливості</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link scroll" href="#pricing">Ціна</a>
                </li>  
              </ul>
              <form class='form-inline my-2 my-lg-0'>
        <li class="nav-item dropdown notification-dropdown" style="list-style-type: none;">
              <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
              </a>
              <div style="padding: 15px;" class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="notificationDropdown">
                  <div class="notification-scroll" style="width: 250px;">
                      
                      <?php
                          $notifi = $mysql->query("SELECT * FROM `notifications` WHERE `user_id` = '$cook_id'");
                          $mess = Array();
                          $href = Array();
                          $data = Array();
                          while($result = $notifi->fetch_assoc()){
                              $mess[] = $result['text'];
                              $href[] = $result['href'];
                              $data[] = $result['data'];
                          }

                          $num_notifi = 0;

                          
                          if(count($mess) == count($href) && count($mess) != 0 && count($href) != 0 ){
                              echo("<a style='color: #2E90FF; font-size: 14px;' id='text_notifi'>Уведомления:</a>");
                              echo("<div style='overflow: auto; max-height: 300px; padding-top: 5px;' id='notifi_clear'>");
                              while($num_notifi <= (count($mess) - 1)){
                                  echo("
                                  <hr />
                                  <div>
                                      <a href='".$href[$num_notifi]."'>
                                          <div class='media'>
                                          <img src='https://img.icons8.com/fluent/48/000000/filled-chat.png'  width='30' height='25' style='padding-right: 5px;'/>
                                              <div class='media-body'>
                                                  <div class='notification-para'>".$mess[$num_notifi]."</div>
                                                  <div class='notification-meta-time'>".date("d.m.Y", strtotime($data[$num_notifi]))."</div>
                                              </div>
                                          </div>
                                      </a>
                                  </div>
                                  <hr />

                                  ");
                                  $num_notifi = $num_notifi + 1;
                              }
                              echo("</div>");
                              echo("<a onclick='dell_notifi()' class='btn btn-primary btn-block mb-4 mr-2' style='position: relative; bottom: -20px;' id='notifi_clear2'>Очистить всё</a>");
                          }else{
                              echo("<a style='color: #322EFF; text-align: center;'>Повідомлень немає</a>");
                          }
                      ?>
                  </div>
              </div>
          </li>

          <script>
              function dell_notifi(){
                  $.ajax({
                      url: 'clear_notifi.php',
                      type: 'POST',
                      data:{id: <?php echo($cook_id); ?> },
                      success: function(data) {
                          clears_notifi();
                      }
                  });
              }
              function clears_notifi(){
                  var texts = document.getElementById("text_notifi");
                  texts.textContent = "Уведомлений нет";
                  texts.style = "color: #322EFF; text-align: center;";
                  
                  var notifi_blocks = document.getElementById("notifi_clear");
                  notifi_blocks.style = "display: none;";
                  var notifi_blocks2 = document.getElementById("notifi_clear2");
                  notifi_blocks2.style = "display: none;";
              }
          </script>
          <div class="names_user">
            <?php
              if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                if($premium == "yes"){
                  echo("<span class='badge bg-warning text-dark'>Premium</span>");
                }
                echo("
                    <a id='user' style='color: rgb(255, 255, 255); font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$name."</a>
                    <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                ");
              }else{
                echo("
                    <a id='user' style='color: rgb(255, 255, 255); font-weight: 400; padding-right: 15px;'>Вход не выполнен</a>
                    <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                ");
              }
            ?>
          </div>
        </form>
      </div>
    </div> <!-- /container -->
  </nav>

</header>

<section class="hero" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="display-3">Хочу більше з преміумом!</h1><br>
        <p>Підключи преміум і отримай необмежений доступ до всіх функцій на порталі.</p>
      </div>
    </div>
  </div>
</section>

<section class="features" id="features">
  <div class="container">
    <h1 class="mb-5 display-4">Особливості</h1>
    <div class="row">
      <div class="col-md-4">
        <h3>Більше ніякої реклами</h3>
        <p>Набридла реклама, від якої вже очі втомилися? Тепер її більше не буде. Чистий дизайн, такий, який він проектувався спочатку.</p>
      </div>
      <div class="col-md-4">
        <h3>Твої теми бачать всі!</h3>
        <p>Твої теми на форумі або оголошення виходять в топ і на головну сторінку, щоб якомога більше людей побачило їх.</p>
      </div>
      <div class="col-md-4">
        <h3>Більше цікавого!</h3>
        <p>Необмежений доступ до того, що постійно матеріалу в енциклопедії для преміум користувачів. Отримай більше, ніж зазвичай.</p>
      </div>
    </div>
  </div>
</section>

<section class="pricing" id="pricing">
  <div class="container">
    <h1 class="mb-5 display-4">Pricing</h1>
    <div class="row">
      <div class='container_price' >
  <section class='card'>
    <div class='card_inner'>
      <div class='card_inner__circle'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/rocket.png'>
      </div>
      <div class='card_inner__header'>
        <img src='http://www.pixeden.com/media/k2/galleries/343/002-city-vector-background-town-vol2.jpg'>
      </div>
      <div class='card_inner__content'>
        <div class='title'>Спільнота</div>
        <div class='price'><a style="font-size: 35px;">Безкоштовно</a></div>
        <div class='text'>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Основний функціонал</p>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Підтримка користувачів</p>
          <hr>
          <p> <img src="https://img.icons8.com/emoji/48/000000/cross-mark-emoji.png" width="25px" height="25px" style="margin-right: 10px;"/> Без реклами</p>
          <hr>
          <p> <img src="https://img.icons8.com/emoji/48/000000/cross-mark-emoji.png" width="25px" height="25px" style="margin-right: 10px;"/>Показ своїх оголошень і постів в ТОП</p>
          <hr>
        </div>
      </div>
      <div class='card_inner__cta'>
        <button>
          <span>Вже в тебе!</span>
        </button>
      </div>
    </div>
  </section>
  <section class='card'>
    <div class='card_inner'>
      <div class='card_inner__circle'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/cog.png'>
      </div>
      <div class='card_inner__header'>
        <img src='https://www.5genergy.ca/wp-content/uploads/2016/01/free-vector-modern-city_093317_bluecity1.jpg'>
      </div>
      <div class='card_inner__content'>
        <div class='title'>Комфорт-стайл</div>
        <div class='price'>28<a style="font-size: 20px;">грн/міс</a></div>
        <div class='text'>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Основний функціонал</p>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Підтримка користувачів</p>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Без реклами</p>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/>Показ своїх оголошень і постів в ТОП</p>
          <hr>
        </div>      </div>
      <div class='card_inner__cta'>
        <button>
          <span>Купити</span>
        </button>
      </div>
    </div>
  </section>
  <section class='card'>
    <div class='card_inner'>
      <div class='card_inner__circle'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/paperplane.png'>
      </div>
      <div class='card_inner__header'>
        <img src='https://c7.uihere.com/files/859/510/385/abstract-forest-landscape.jpg'>
      </div>
      <div class='card_inner__content'>
        <div class='title'>Професіонал</div>
        <div class='price'>48<a style="font-size: 20px;">грн/міс</a></div>
        <div class='text'>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Всі попередні функції</p>
          <hr>
          <p> <img src="https://img.icons8.com/fluent/48/000000/checkmark.png" width="25px" height="25px" style="margin-right: 10px;"/> Доступ до преміум матеріалу в енциклопедії</p>
          <hr>
          <br><br><br><br><br>
        </div>
      <div class='card_inner__cta'>
        <button>
          <span>Купити</span>
        </button>
      </div>
    </div>
  </section>

      </div>
    </div>
  </div>
</section>

<footer>
  <p>Все для тебе!</p>
</footer>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script><script  src="./script.js"></script>

</body>
</html>
