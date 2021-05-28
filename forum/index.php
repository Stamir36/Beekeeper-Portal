<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'forum', time() + 3600 * 24, "/");

    include "../service/config.php";
    include '../service/contextmenu.php';

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];
    
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/sidebar.css">
        <link rel="stylesheet" href="assets/css/logic.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Форум</title>
        <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/comment-discussion.png" type="image/png">
        <style>
          .aside-2 {
            background-image: url(https://i.gifer.com/iCg.gif);
          }
          ::-webkit-scrollbar {
              width: 10px;
          }
          
          ::-webkit-scrollbar-track {
              border-radius: 10px;
              background-color: rgba(25,147,147,0.1);
          }
          
          ::-webkit-scrollbar-thumb {
              border-radius: 10px;
              background-color: rgba(46, 196, 255, 0.50);
              background-color: linear-gradient(180deg, rgba(46,196,255,0.50) 0%, rgba(192,0,255,0.75) 100%);
          }
          ::-webkit-scrollbar-thumb:hover {
              border-radius: 10px;
              background: rgb(46,196,255);
              background: linear-gradient(180deg, rgba(46,196,255,0.75) 0%, rgba(192,0,255,1) 100%);
          }
          @media screen and (max-width: 900px) {
              .breadcrumb-two{
                  display: none;
              }
              .games_card{
                padding-right: 30px;
              }
          }
        </style>
        <script>
          let card = document.getElementsByClassName("card");

          setTimeout(function(){ 
                for(var i =0; i<card.length; i++) {
            card[i].classList.remove("preShow")
          }
          },2000);
        </script>
      </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="../" style="color: #2344FF; font-weight: 600;"><img src="https://img.icons8.com/fluent/48/000000/comment-discussion.png" style="width: 30px; height: 30px;"/>   Форум</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../">Головна сторінка <span class="sr-only">(current)</span></a>
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
                              echo("<a style='color: #2E90FF; font-size: 14px;' id='text_notifi'>Повідомлення:</a>");
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
                              echo("<a onclick='dell_notifi()' class='btn btn-primary btn-block mb-4 mr-2' style='position: relative; bottom: -20px;' id='notifi_clear2'>Очистити все</a>");
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
                    <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$name."</a>
                    <img id='user_avatar' src='../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                ");
              }else{
                echo("
                    <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px;'>Вход не выполнен</a>
                    <img id='user_avatar' src='../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                ");
              }
            ?>
          </div>
        </form>

      </div>
    </nav>

    <div class="area" style="margin-top: 56px;">
          <div class="wrapper">
            <article class="main">
              <div class="firstcoll">
                <div class="jumbotron">
                  <h1 class="display-4" style="color: #fff; font-weight: 500;">Ласкаво просимо на форум пасічників!</h1>
                  <p class="lead" style="color: #fff; font-weight: 100;">Знайдіть цікаву для вас тему та приєднайтесь до обговорення.</p>
                  <hr class="my-4">
                  <p class="text_pc_mobile" style="color: #FFBF08;">Пошук по темам</p>

                  <input type="text" id="search_box" class="search_box"> <br class="yes_mobile"/><br class="yes_mobile" />
                  <a class="buttom_go" role="button" onclick="document.location.href = 'search/?s=' + document.getElementById('search_box').value + '&page=1';">Пошук</a>
                </div>
            </div>
            </article>
            <aside class="aside aside-2"></aside>
          </div>

          <div class="games_card" style="padding-bottom: 20px;">
            <h2 class="text_banner">Що ви бажаєте зробити?</h2>


            <div class="category">

                <div class="card preShow">
                  <a href="new/">
                    <div class="card__top">
                    <img src="https://img.icons8.com/fluent/48/000000/plus-math.png"/>
                      <h2>Створити тему</h2>
                    </div>
                    <div class="card__bottom">
                      <h2>Створити тему</h2>
                      <p>
                        Задати питання на форумі
                      </p>
                      <p><br/>
                      Створіть повідомлення на цікаву для вас тему.
                      Всі користувачі форуму зможуть приєднатися до вашої теми обговорення.
                      </p>
                    </div>
                  </a>
                </div>

              <div class="card preShow"> <!-- id="new" -->
              <a href="category/">
                <div class="card__top">
                  <img src="https://img.icons8.com/fluent/48/000000/sorting-answers.png"/>
                  <h2>Категорії</h2>
                </div>
                  <div class="card__bottom">
                    <h2>Категорії</h2>
                    <p>
                    Загальні теми
                    </p>
                    <p><br/>
                    Дивіться всі теми в певному розділі, щоб не звертати увагу на те, що вам нецікаво.
                    </p>
                  </div>
                  </a>
              </div>

              <!-- /////////////////////// ДЛЯ ЗАРЕГЕСТРИРОВАНЫХ ПОЛЬЗОВАТЕЛЕЙ   //////////////////// -->

              <?php             
                if(strlen($cook_id) > 0){
                  echo("
                    <div class='card preShow'>
                    <a href='my/'>
                    <div class='card__top'>
                    <img src='https://img.icons8.com/fluent/48/000000/reservation-2--v2.png'/>
                      <h2>Мої теми</h2>
                    </div>
                    <div class='card__bottom'>
                      <h2>Мої теми</h2>
                      <p>
                        Редагування і перегляд моїх тем на форумі.
                      </p>
                      <p><br/>
                      Швидкий доступ до моїх тем.
                      </p>
                    </div>
                    </a>
                  </div>
    
                  <div class='card preShow'>
                  <a href='liked/'>
                    <div class='card__top'>
                    <img src='https://img.icons8.com/fluent/48/000000/like.png'/>
                      <h2>Мені подобається</h2>
                    </div>
                    <div class='card__bottom'>
                      <h2>Мені подобається</h2>
                      <p>
                        Все що я читаю та слідкую...
                      </p>
                      <p><br/>
                      Список ваших закладок на теми,
                      до яких ви можете повернутися швидко в будь-який момент.
                      </p>
                    </div>
                    </a>
                  </div>
                  ");
                }else{
                  echo("
                    <div class='card preShow'>
                    <a href='../login/'>
                      <div class='card__top'>
                      <img src='https://img.icons8.com/fluent/48/000000/add-user-group-woman-man.png'/>
                        <h2>Увійти до системи</h2>
                      </div>
                      <div class='card__bottom'>
                        <h2>Увійти до системи</h2>
                        <p>
                          Всі можливості сервісу
                        </p>
                        <p><br/>
                        Увійдіть або зареєструйтесь, щоб мати можливість писати,
                        зберігати, спілкуватися та ще до тисяч інших можливостей!
                        </p>
                      </div>
                      </a>
                    </div>
                  ");
                }
              ?>
              
            </div>

          </div>

          <div class="games_card" style="padding-top: 0px;">
            <h2 class="text_banner">Останні створені теми на форумі.</h2>

            <style>
              .link{
                background-color: aliceblue;
                width: 100%;
              }
            </style>

            <div class="last_theme">
                
              <div class="row" id="cancel-row">
              
                  <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                      <div class="widget-content widget-content-area br-6">
                          <div class="table-responsive mb-4 mt-4" style="background-color: rgb(255, 255, 255); padding: 5px; border-radius: 5px;">
                                    <style>
                                      .theme_point:hover{
                                          background-color: #93a4e9;
                                          color: yellow;
                                        }
                                    </style>
                                    <?php
                                      $theme = $mysql->query("SELECT * FROM `forum_main_mess` ORDER BY Date_Create DESC limit 6");
                                      
                                      $id_theme = Array();
                                      $names = Array();
                                      $category = Array();
                                      $data = Array();
                                      $autor = Array();
                                      
                                      while($results = $theme->fetch_assoc()){
                                        $id_theme[] = $results['id'];
                                        $names[] = $results['header'];
                                        $category[] = $results['category'];
                                        $dates[] = $results['Date_Create'];
                                        $autor[] = $results['author'];
                                      }

                                      $num_theme = 0;
                                      if(count($id_theme) == count($names) && count($id_theme) != 0 && count($names) != 0 ){
                                        echo("
                                        <table id='zero-config' class='table table-hover' style='width:100%' >
                                        <thead>
                                            <tr>
                                                <th>Назва теми</th>
                                                <th class='no_mobile'>Автор</th>
                                                <th class='no_mobile'>Дата</th>
                                                <th class='no_mobile'>Категорія</th>
                                                <th class='no-content'></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        ");
                                        
                                        while($num_theme <= (count($id_theme) - 1)){
                                          echo("
                                          <div class='theme_point'>
                                            <tr  onclick='go_href(".$id_theme[$num_theme].")' style='cursor: pointer;'>
                                              <td>".$names[$num_theme]."</td>
                                              <td class='no_mobile'>".$autor[$num_theme]."</td>
                                              <td class='no_mobile'>".date("F j, Y, g:i a", strtotime($dates[$num_theme]))."</td>
                                              <td class='no_mobile'>".$category[$num_theme]."</td>
                                              <td></td>
                                            </tr>
                                          </div>
                                          ");
                                          $num_theme = $num_theme + 1;
                                        }

                                        echo("</tbody> </table>");
                                      }else{
                                        echo("
                                        <div style='margin: 10px;'>
                                          <a style='color:red; padding: 10px;'>Ще немає створених тем на форумі. Будь першим!</a>
                                        </div>
                                        ");
                                      }
                                      
                                    ?>
                          </div>
                      </div>
                  </div>
            </div>
            
          </div>

          <h2 class="text_banner" style="font-size: 22px;"><a style="color: #2344FF;">Статистика</a></h2>
            <div class="blogs">
             <div class="blog anim" style="--delay: .4s">
              <div class="blog-by">Кількість користувачів:</div>
              <?php
                $res = $mysql->query("SELECT count(*) FROM accounts_users");
                $row = $res->fetch_row();
                
                echo("
                  <div class='blog-name'><a style='font-size: 32px;'>".$row[0]."</a></div>
                  <div class='blog-view'></div>
                ");
              ?>
             </div>
             <div class="blog anim" style="--delay: .5s">
              <div class="blog-by offline">Кількість тем</div>
              <?php
                $res = $mysql->query("SELECT count(*) FROM forum_main_mess");
                $row = $res->fetch_row();
                
                echo("
                  <div class='blog-name'><a style='font-size: 32px;'>".$row[0]."</a></div>
                  <div class='blog-view'></div>
                ");

              ?>
             </div>
             <div class="blog anim" style="--delay: .6s">
              <div class="blog-by offline">Кількість повідомлень</div>
              <?php
                $res = $mysql->query("SELECT count(*) FROM forum_sub_mess");
                $row = $res->fetch_row();
                
                echo("
                  <div class='blog-name'><a style='font-size: 32px;'>".$row[0]."</a></div>
                  <div class='blog-view'></div>
                ");
              ?>
             </div>
             <div class="blog anim" style="--delay: .7s">
             <div class="blog-by offline">Останній зареєстрований</div>
             <?php
                $res = $mysql->query("SELECT * FROM `accounts_users` WHERE id=(SELECT MAX(id) FROM `accounts_users`)");
                $row = $res->fetch_assoc();

                $acc_name = $row['name'];
                $acc_date = $row['Date_of_Birth'];

                echo("
                  <div class='blog-name'><a style='font-size: 32px;'>".$acc_name."</a></div>
                ");

                echo("
                  <div class='blog-view'>День народження: <span class='seperate blog-seperate'></span>".date("d.m.Y", strtotime($acc_date))."</div>
                ");
              ?>
             </div>
          </div>

    </div>
    
        <!-- Site footer -->
        <footer class="site-footer">
          <div class="row">
            <div style="padding-left: 20px; right: 0;">
              <h3>Про сайт</h3>
              <p style="max-width: 800px;">Форум бджолярів - найкраще місце, де ви можете 
                обговорити з іншими людьми будь-які теми, задати питання, 
                навчитися чомусь новому і бути в курсі свіжих подій.</p>
            </div>
            <div class='no_mobile' style="right: 50px; position: absolute; float: right;">
              <p style="color: blanchedalmond;">Unesell Studio. <?php echo date("Y"); ?></p>
            </div>
          </div>
        </footer>

    <script>
      function go_href(href){
        document.location.href = "topic/?id=" + href + "&page=1";
      }  
    </script>

    <nav class="main-menu" style="padding-top: 60px;">
            <ul>
                <li class="has-subnav">
                    <a href="/" class="active_menu">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/menu-rounded.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Головна сторінка
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="category/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/product-documents.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Категорії
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="new/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/plus-math.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Створити тему
                        </span>
                    </a>  
                </li>
                <li class="has-subnav">
                    <a href="../service/support/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/technical-support.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Онлайн підтримка
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
              <?php
              
              if(strlen($cook_id) > 0){
                echo("
                  <li>
                      <a href='../service/out.php'>
                            <i class='fa fa-2x'><img src='https://img.icons8.com/fluent/48/000000/import.png' width='25px' height='25px'></i>
                          <span class='nav-text'>
                              Вийти з системи
                          </span>
                      </a>
                  </li> 
                ");
              }else{
                echo("
                  <li>
                      <a href='../login/'>
                            <i class='fa fa-2x'><img src='https://img.icons8.com/fluent/48/000000/enter-2.png' width='25px' height='25px'></i>
                          <span class='nav-text'>
                            Увійти до системи
                          </span>
                      </a>
                  </li> 
                ");
              }

              ?> 
            </ul>
        </nav>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        
        <!-- Навигатор наверх -->
      <div class="prgoress_indicator">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
          <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
      </div>

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        
        <script>
                  var progressPath = document.querySelector('.prgoress_indicator path');
                  var pathLength = progressPath.getTotalLength();
                  progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
                  progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
                  progressPath.style.strokeDashoffset = pathLength;
                  progressPath.getBoundingClientRect();
                  progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
                  var updateProgress = function () {
                    var scroll = $(window).scrollTop();
                    var height = $(document).height() - $(window).height();
                    var progress = pathLength - (scroll * pathLength / height);
                    progressPath.style.strokeDashoffset = progress;
                  }
                  updateProgress();
                  $(window).on('scroll', updateProgress);
                  var offset = 250;
                  var duration = 550;
                  jQuery(window).on('scroll', function () {
                    if (jQuery(this).scrollTop() > offset) {
                      jQuery('.prgoress_indicator').addClass('active-progress');
                    } else {
                      jQuery('.prgoress_indicator').removeClass('active-progress');
                    }
                  });
                  jQuery('.prgoress_indicator').on('click', function (event) {
                    event.preventDefault();
                    jQuery('html, body').animate({ scrollTop: 0 }, duration);
                    return false;
                  });
      </script>
    <!-- Конец навигатора наверх -->
      


  </body>
</html>



<!-- 
/*
<?php             
if(strlen($cook_id) > 0){
  echo("");
}else{
  echo("");
}
?>
*/
-->