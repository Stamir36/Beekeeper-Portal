<?php
//Loader data

$cook_id = htmlspecialchars($_COOKIE["id"]);
setcookie('site_page', 'shop', time() + 3600 * 24, "/");
if (strlen($cook_id) > 0) {
  include "../../service/config.php";

  $mysql = new mysqli($Host, $User, $Password, $Database);

  $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
  $user = $result->fetch_assoc();

  //Из базы данных: $user['name'];
  $name = $user['name'];
  $avatar = $user['avatar'];
  $premium = $user['premium'];
} else {
  header('Location: /login/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Нова стаття</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Playfair Display-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700">
  <!-- Google fonts - Poppins-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700">
  <!-- swiper-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
  <!-- Leaflet Maps-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="style.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="../img/favicon.png">
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
    <!-- /Navbar -->
    <script>
      let photo = false;
    </script>

  <section class="py-5">
    <div class="container">
      <p class="subtitle text-primary">Редактор</p>
      <h1 class="h2 mb-5"> Створення контенту </h1>
      <form action="new.php" method="post" enctype="multipart/form-data" id="FormID">
        <div class="row form-block">
          <div class="col-lg-4">
            <h4>Основне</h4>
            <p class="text-muted text-sm">Вкажіть назву вашої публікації, це дуже важливо, адже саме за назвою її можна буде знайти. Так само, виберіть вид, до якого відноситься ваш текст.</p>
          </div>

          <div class="col-lg-7 ml-auto">
            <div class="form-group"></div>
            <div class="form-group">
              <label for="form_name" class="form-label">Назва Статті</label>
              <input style="font-family: Unecoin;" name="name" id="form_name" class="form-control" onclick="document.getElementById('error_name').style = 'display: none;';">
              <label id="error_name" style="display: none;" for="form_street" class="form-label"><a id="error_name_text" style="color: red;"></a></label>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1" class="form-label">Виберіть категорію</label>
              <select class="form-control" id="form_category" name="category">
                <option>Пасічництво</option>
                <option>Продукти та їжа</option>
                <option>Робота та компанії</option>
                <option>Життя</option>
                <option>Інше</option>
              </select>
              <label id="error_category" style="display: none;" for="form_street" class="form-label"><a id="error_category_text" style="color: red;"></a></label>

            </div>



            <div class="form-group" <?php if (strlen($cook_id) > 0 && $premium != "yes") {
                                      echo ("style='opacity: 0.5; cursor: not-allowed;' ");
                                    } ?>>
              <label class="form-label">Вивести публікацію в <a style="background-color: rgb(255, 236, 211); border-radius: 2px; padding: 2px;">топ?</a></label>
              <br><a class="form-label" style="font-size: 14px; color: rgb(165, 165, 138);" <?php if (strlen($cook_id) > 0 && $premium != "yes") {
                                                                                              echo ("style='opacity: 1; cursor: not-allowed;' ");
                                                                                            } ?>>Тільки преміум</a>
              <div class="custom-control custom-radio">
                <input type="radio" id="guests_0" name="premium" class="custom-control-input" value="yes" <?php if (strlen($cook_id) > 0 && $premium != "yes") {
                                                                                                            echo ("disabled='disabled'");
                                                                                                          } ?>>
                <label for="guests_0" class="custom-control-label">Так, показувати на головній.</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" id="no_radio" id="guests_1" name="premium" value="no" class="custom-control-input" <?php if (strlen($cook_id) > 0 && $premium != "yes") {
                                                                                                                          echo ("disabled='enable'");
                                                                                                                        } ?>>
                <label for="guests_1" class="custom-control-label">Ні, не треба.</label>
                <script>
                  document.getElementById('no_radio').click();
                </script>
              </div>
            </div>
          </div>
        </div>

        <div class="row form-block">
          <div class="col-lg-4">
            <h4>Зміст контенту</h4>
            <p class="text-muted text-sm">Напишіть будь-яку цікаву статтю і при бажанні додайте мультимедіа. Не забувайте про правила написання контенту в системі.</p>
          </div>
          <div class="col-lg-7 ml-auto">

            <div class="form-group">
              <label for="form_street" class="form-label">Ваш текс</label>
              <textarea name="content" id="content" placeholder="Почніть писати ваше повідомлення..." class="form-control" style="min-height: 300px;"></textarea>
              <label id="error_content" style="display: none;" for="form_street" class="form-label"><a id="error_content_text" style="color: red;"></a></label>
            </div>
          </div>
        </div>

        <div class="row form-block">
          <div class="col-lg-4">
            <h4>Обкладинка.</h4>
            <div class="image" id="imeges_block" for='pct'>
              <div class="block_img">
                <img id="image_blocks" style="max-width: 340px;">
              </div>
            </div>
            <label id="fname_block" style="display: none;" for="form_street" class="form-label">Файл: <a id="files_name" style="color: red; cursor: default;">Files.png</a> </label>
          </div>
          <script>
          </script>
          <div class="col-lg-7 ml-auto">

            <style>
              @media (min-width: 991px) {
                .yes_mobile {
                  display: none;
                }
              }

              @media (max-width: 991px) {
                .yes_mobile {
                  display: inline;
                }
              }

              .img_block {
                max-width: none;
                height: 300px;
              }

              .image {
                display: inline-block;
                width: 100%;
                height: 300px;
                background: #DEDDD7;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
                align-items: center;
                justify-content: center;
              }

              #image_blocks {
                object-fit: cover;
                max-height: 300px;
                width: auto;
                margin: 0;
              }

              .block_img {
                position: absolute;
                top: 50%;
                left: 50%;
                margin-right: -50%;
                transform: translate(-50%, -50%);
              }
            </style>
            <div class="form-group">
              <p class="text-muted text-sm">Завантажуйте тільки якісне фото свого товару. Якщо ваше фото буде помилковим або не чітким, ваше стаття може стати неактивним.</p>
              <label for="form_street" class="form-label">Обкладинка статті</label> <br>
              <input style="display: none;" onchange="getFiles(this.files)" type="file" id="photo_butt" name="uploadfile" class="btn btn-warning px-3" name="photo" multiple accept="image/*,image/jpeg, image/gif">
              <a style="cursor: pointer;" onclick="upload_files();" class="btn btn-warning px-3"> Вибрати картинку </a> <br class="yes_mobile" /> <br class="yes_mobile" />
              <a onclick="resetFile();" id="form_photo_close" class="btn btn-danger px-3" style="cursor: pointer; color: #fff; display: none;"> Видалити </a>
              <br><label id="error_photo" style="display: none;" for="form_street" class="form-label"><a id="files_error" style="color: red; cursor: default;">Ви не виблали зображення.</a></label>
              <script>
                function getFiles(files) {
                  if (files[0].size <= 2000000) {
                    photo = true;
                    document.getElementById("error_photo").style = "display: none;";
                    document.getElementById('files_name').textContent = files[0].name;
                    document.getElementById('fname_block').style = "display: inline;";
                    document.getElementById("form_photo_close").style = "cursor: pointer; color: #fff; display: inline;";

                    var fr = new FileReader();
                    fr.addEventListener("load", function() {
                      //document.getElementById("imeges_block").style.backgroundImage = "url(" + fr.result + ")";
                      document.getElementById("image_blocks").src = fr.result;
                    }, false);

                    fr.readAsDataURL(files[0]);
                  } else {
                    document.getElementById("error_photo").style = "display: inline;";
                    document.getElementById("files_error").textContent = "Зображення бішьше ніж 2 Мб. Зменьшіть розмір.";
                  }

                }

                function resetFile() {
                  photo = false;
                  document.getElementById('photo_butt').value = "";
                  document.getElementById("error_photo").style = "display: none;";
                  document.getElementById('fname_block').style = "display: none;";
                  document.getElementById("image_blocks").src = "";
                  document.getElementById("form_photo_close").style = "cursor: pointer; color: #fff; display: none;";
                }

                function upload_files() {
                  document.getElementById('photo_butt').click();
                }
              </script>
            </div>
          </div>
        </div>

        

        <div class="row form-block flex-column flex-sm-row">
          <div class="col text-center text-sm-left">
          </div>
          <div class="col text-center text-sm-right">
            <a class="btn btn-danger px-3" style="cursor: pointer; color: #fff;" onclick="document.location.href = '../'" ;>Скасувати</a>
            <a class="btn btn-primary px-3" style="cursor: pointer; color: #fff;" onclick="create();">Опублікувати <i class="fa-chevron-right fa ml-2"></i></a>
          </div>
          <script src="../../assets/js/censorship.js">
            // Проверка на цензуру
          </script>
          <script>
            function create() {
              
              let name = false;
              let category = false;
              let content = false;
              let chas = false;

              if (document.getElementById("form_name").value.length > 4) {
                if (Censorship(document.getElementById("form_name").value)) {
                  document.getElementById("error_name").style = "display: inline;";
                  document.getElementById("error_name_text").textContent = "Вибачте, але ваш текст містить слова, які забороненно вживати в системі!";
                  name = false;
                } else {
                  name = true;
                }
              } else {
                document.getElementById("error_name").style = "display: inline;";
                document.getElementById("error_name_text").textContent = "Назва статті дуже меленька. Напишіть більше слів.";
                name = false;
              } // ------------------------------------------------------------------------------------------------------------------------------

              if (document.getElementById("form_category").value.length > 0) {
                if (Censorship(document.getElementById("form_category").value)) {
                  document.getElementById("error_category").style = "display: inline;";
                  document.getElementById("error_category_text").textContent = "Треба вказати категорії!";
                  category = false;
                } else {
                  category = true;
                }
              } else {
                document.getElementById("error_category").style = "display: inline;";
                document.getElementById("error_category_text").textContent = "Будь ласка, вкажіть категорію.";
                category = false;
              } // ------------------------------------------------------------------------------------------------------------------------------
              if (document.getElementById("content").value.length > 1) {
                if (Censorship(document.getElementById("content").value)) {
                  document.getElementById("error_content").style = "display: inline;";
                  document.getElementById("error_content_text").textContent = "Вибачте, але ваша стаття містить слова, які забороненно вживати в системі!";
                  content = false;
                } else {
                  content = true;
                }
              } else {
                document.getElementById("error_content").style = "display: inline;";
                document.getElementById("error_content_text").textContent = "Стаття занадто коротка.";
                content = false;
              } // ------------------------------------------------------------------------------------------------------------------------------

              // ------------------------------------------------------------------------------------------------------------------------------


              if (photo == false) {
                document.getElementById("error_photo").style = "display: inline;";
                document.getElementById("files_error").textContent = "Ви не виблали зоблаження.";
              }
              

              if (photo == true && name == true && category == true && content == true) {
                var form = document.getElementById("FormID");
                document.getElementById("content").value = document.getElementById("content").value.replace(/\n/g, "!n!");
                form.submit();
              } else {
                //alert("Not good! Info: " + "photo =="+ photo+"  name == "+name +" category == "+category+"content =="+ content);
              }
              
            }
          </script>

      </form>
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
  <!-- /Footer end-->
  <!-- JavaScript files-->
  <script>
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
  

  
</body>

</html>