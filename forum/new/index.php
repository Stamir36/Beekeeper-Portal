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
    
    if(strlen($cook_id) <= 0){
        header('Location: /login/');
    }

?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
        <link rel="stylesheet" href="../assets/css/logic.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Створення нової теми - форум пасічників</title>
        <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/comment-discussion.png" type="image/png">
        <style>
          .aside-2 {
            background-image: url(https://i.gifer.com/2I3c.gif);
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
          }
          @media (max-width: 991px){
            .games_card{
              padding-right: 40px;
            }
            .category{
              width: 105%;
            }
          }
        </style>
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
                  <a class="nav-link" href="../../">Головна сторінка <span class="sr-only">(current)</span></a>
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
                            url: '../clear_notifi.php',
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
                      <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                  ");
                }else{
                  echo("
                      <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px;'>Вход не выполнен</a>
                      <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                  ");
                }
              ?>
              </div>
              </form>

            </div>
          </nav>
          
    <div class="area" style="margin-top: 56px;">
          <div class="wrapper">
            <article class="main" style="height: 100px;">
                <div class="firstcoll" style="height: 100px;">
                  <div style="height: 100px; padding: 15px;">
                    <h1 class="main_text" style="color: #fff; font-weight: 500;">Нова тема</h1>
                  </div>
              </div>
            </article>
            <aside class="aside aside-2"></aside>
          </div>

          <div class="games_card">
            <div style="padding-bottom: 0px;">
              <h2 class="text_banner">Створення нової теми:</h2>
              <div class="row row-cols-1 row-cols-md-3">
                  <style>
                    .form-group{
                      background-color: rgba(255, 245, 245, 0.65);
                      padding: 10px;
                      border-radius: 5px;
                    }
                  </style>
                <form action="create.theme.php" method="POST" id="file-form" style="padding-left: 12px;">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Назва теми обговорення</label>
                      <input name="theme" type="text" id="name" style="width: 100%;" class="form-control" placeholder="Мене цікавить...">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Виберіть категорію</label>
                      <select class="form-control" name="category">
                        <option>Пасічництво</option>
                        <option>Продукти та їжа</option>
                        <option>Робота та компанії</option>
                        <option>Життя</option>
                        <option>Інше</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Текст шапки:</label>
                      <textarea name="content" id="content" placeholder="Почніть писати ваше повідомлення..."></textarea>
                    </div>
                    <div class="field" style="padding-top: 5px;">
                      <a onclick="create_theme()" class="buttom_go" role="button">Відправити</a>
                      <div id="messages" style="color: red;"></div>
                    </div>
                </form>
  
                <div id="files" style="padding-bottom: 15px;">
                  <label for="exampleFormControlInput1">Правила написання нових тем:</label>
                  <ul id="file-list">
                      <li style="padding-left: 10px; color: tomato;"> ● Заборонено писати нецензурну лексику.</li>
                      <li style="padding-left: 10px; color: tomato;"> ● Рекламувати щось або когось.</li>
                      <li style="padding-left: 10px; color: tomato;"> ● Розміщувати і обговорювати порнографію.</li>
                      <li style="padding-left: 10px; color: tomato;"> ● Перед створенням теми, пошукайте своє питання 
                      серед створених тем. Не створюйте безліч обговорень.</li>
                      <br>
                      <div class="alert alert-warning" role="alert">
                        Всі правила діють на будь-які повідомлення в системі.
                      </div>
                      <div class="alert alert-info" role="alert">
                        Зі всіма правилами ви можете ознайомитись <br><a href="../../service/rule/">перейшовши на цю сторінку</a>
                      </div>
                  </ul>
                </div>
  
              </div>
            </div>

              
          <h2 class="text_banner" style="font-size: 16px; ">Інші опції:</h2>
            <div class="category" style="padding: 0px;">
                <div class="card preShow">
                    <a href="../">
                    <div class="card__top">
                      <img src="https://img.icons8.com/fluent/48/000000/circled-left-2.png"/>
                      <h2>Повернутись на головну</h2>
                    </div>
                    <div class="card__bottom">
                      <h2>Повернутись на головну</h2>
                      <p>
                        Вибрати інші категорії
                      </p>
                      <p><br/>
                      Пошукайте, можливо хтось вже обговорює цікаву для вас тему.
                      </p>
                    </div>
                  </a>
                </div>



                <div class="card preShow">
                  <a href="../../service/support/">
                    <div class="card__top">
                      <img src="https://img.icons8.com/fluent/48/000000/online-support.png"/>
                      <h2>Звернутися в підтримку</h2>
                    </div>
                    <div class="card__bottom">
                      <h2>Звернутися в підтримку</h2>
                      <p>
                        Якщо у вас виникли троднощі із системою.
                      </p>
                      <p><br/>
                        Якщо у вас є питання по роботі системи, або ви виявили помилки, то, будь ласка, повідомте нам.
                      </p>
                    </div>
                  </a>
                </div>
            </div>

          
          </div>
        </div>
    </div>

    <script>
      function create_theme(){
        var name, text = false;

        if(Number(document.getElementById("name").value.length) > 4){
          if(Censorship(document.getElementById("name").value)){
            name = false;
            messages("Назва теми порушує правила системи.");
          }else{
            name = true;
          }
        }else{
          name = false;
          messages("Назва теми занадто коротка.");
        }

        if(Censorship(document.getElementById("content").value)){
            text = false;
            messages("В тексті містяться заборонені слова та вирази.");
          }else{
            text = true;
          }

        if(name == true && text == true){
          var temp = document.getElementById("content").value;
          var content = document.getElementById("content").value.replace(/\n/g, "!n!");
          document.getElementById("content").value = content;

          var form = document.getElementById("file-form");
          form.submit();
          document.getElementById("content").value = temp;
        }
      }
      function messages(text){
        document.getElementById("messages").textContent = text;
      }
    </script>
    <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
    <nav class="main-menu" style="padding-top: 60px;">
            <ul>
                <li class="has-subnav">
                    <a href="../">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/menu-rounded.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Головна сторінка
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="../category/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/product-documents.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Категорії
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a class="active_menu">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/plus-math.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Ви створюєте тему
                        </span>
                    </a>  
                </li>
                <li class="has-subnav">
                    <a href="../../service/support/">
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
                      <a href='../../service/out.php'>
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
                      <a href='../../login/'>
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