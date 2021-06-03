<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'main', time() + 3600 * 24, "/");

    include "service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];

?>

<!DOCTYPE html>
<html lang="ua">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Портал українського пасічника. Форум, оголошення, контент, вікі - все для вас!" />
  <meta name="keywords"
    content="HTML, CSS, JavaScript, Bootstrap, jQuery, Rakon, Themeforest, Template, envato, SASS, SCSS, HTML5, landing page, SaaS Product, SaaS Modern,  MultiPurpose, Crypto, Currency, ICO, Hosting, Agency, Mobile, App, Interior, Charity" />
  <meta name="author" content="Unesell Studio" />

  <title>Beekeeper portal - портал і форум пасічників</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="assets/css/main/bootstrap.min.css" type="text/css" />
  <!-- animate 
  <link rel="stylesheet" href="assets/css/main/animate.css" type="text/css" /> -->
  <!-- Swiper 
  <link rel="stylesheet" href="assets/css/main/swiper.min.css" /> -->
  <!-- icons -->
  <link rel="stylesheet" href="assets/css/main/icons.css" type="text/css" />
  <!-- aos 
  <link rel="stylesheet" href="assets/css/main/aos.css" type="text/css" /> -->
  <!-- main css -->
  <link rel="stylesheet" href="assets/css/main/main.css" type="text/css" />
  <!-- normalize -->

  <!--New Style Beekeeper portal-->
  <link rel="stylesheet" href="assets/css/main/new_style.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/main/card.css" type="text/css" />
  <style>
    svg {
      flex-shrink: 0;
      width: 800px;
      max-width: 90vw;
    }
  </style>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- js for Brwoser -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div id="wrapper">
    <div id="content">
      <!-- Start header -->
      <header class="header-nav-center active-blue" id="myNavbar">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
            <a class="navbar-brand" href="/" style="width: 40px; height: 40px;">
              <img class="" src="assets/img/logo.svg" alt="logo" width="40px" height="40px"/>
              
            </a>

            <button class="navbar-toggler menu ripplemenu" type="button" data-toggle="collapse"
              data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <svg viewBox="0 0 64 48">
                <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
              </svg>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- ///////////////////////////////// MOBILE NAV ////////////////////////////////////////// --> 
            <div class="mobile">
              <h5>Меню:</h5>
              <p style="padding: 0; margin: 0; color: blue;">‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾</p>
              <ul class="navbar-nav ml-auto nav-pills" style="padding-left: 30px;">
                  <li class="nav-item" style="color: #DE7D00">
                    <a class="nav-link" href="forum/"><font color="#DE7D00">Форум</font></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="shop/"><font color="#DE7D00">Оголошення</font></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="wiki/"><font color="#DE7D00">Енциклопедія</font></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="service/support/"><font color="#DE7D00">Підтримка</font></a>
                  </li>
              </ul>
            </div>
            <!-- ///////////////////////////////// PC NAV ////////////////////////////////////////// --> 

              <nav id="menu" class="nav_menu">
                  <div class="menu-item">
                      <div class="menu-text">
                          <a href="forum/">Форум</a>
                      </div>
                      <div class="sub-menu">
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/plus-math.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" style="cursor: pointer;" onclick="document.location.href = '/forum/new/';">
                                  <div class="title">Створити нову тему <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Задати питання на форумі.</div>
                              </div>
                          </div>
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/sorting-answers.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" style="cursor: pointer;" onclick="document.location.href = '/forum/category/';">
                                  <div class="title">Дивитися категорії <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Всі категорії та теми на форумі</div>
                              </div>
                          </div>
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/search.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" style="cursor: pointer;" onclick="document.location.href = '/forum/';">
                                  <div class="title">Пошук питання <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Виконати пошук по темам та питанням.</div>
                              </div>
                          </div>
                          <div class="sub-menu-holder"></div>
                      </div>
                  </div>
                  <div class="menu-item highlight">
                      <div class="menu-text">
                          <a href="shop/" >Оголошення</a>
                      </div>
                      <div class="sub-menu double">
                          <div class="icon-box gb a" onclick="document.location.href = '/shop/catalog/?c=all';">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/search-property.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu">
                                  <div class="title">Всі оголошення <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Переглядай та шукай</div>
                              </div>
                          </div>
                          <div class="icon-box gb b">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/four-squares.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" onclick="document.location.href = '/shop/';">
                                  <div class="title">Категорії <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Теми оголошень</div>
                              </div>
                          </div>
                          <div class="icon-box gb c">
                              <div class="icon"><img src="https://img.icons8.com/emoji/48/000000/plus-emoji.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" onclick="document.location.href = '/shop/new/';">
                                  <div class="title">Подати оголошення <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Продати все що завгодно.</div>
                              </div>
                          </div>
                          <div class="icon-box gb d">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/bursts.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" onclick="document.location.href = '/shop/my/';">
                                  <div class="title">Мої оголошення<i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Все що ви опублікували</div>
                              </div>
                          </div>
                          <div class="icon-box gb e">
                            <a href="service/premium/">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/expensive-2.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" onclick="document.location.href = '/service/premium/';">
                                  <div class="title">Преміум <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Нові можливості</div>
                              </div>
                            </a>
                          </div>
                          <div class="icon-box gb f">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/love-circled.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" onclick="document.location.href = '/shop/liked/';">
                                  <div class="title">Мені подобається<i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Збережені закладки</div>
                              </div>
                          </div>
                          <div class="bottom-container">
                              Подати оголошення? <a href="#">Вперед!</a>
                          </div>
                          <div class="sub-menu-holder"></div>
                      </div>
                  </div>

                  <div style="padding-top: 8px; padding-left: 25px;">
                      <div class="menu-text">
                          <a href="wiki/">Енциклопедія</a>
                      </div>
                  </div>

                  <div class="menu-item">
                      <div class="menu-text">
                          <a href="service/support/">Підтримка</a>
                      </div>
                      <div class="sub-menu">
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/chat.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu" style="cursor: pointer;" onclick="document.location.href = '/service/support/';">
                                  <div class="title">Підтримка користувачів <i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Написати розробникам проекту</div>
                              </div>
                          </div>
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/telegram-app.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu">
                                  <a class="title" href="https://t.me/unesell">Соціальні мережі <i class="far fa-arrow-right"></i></a>
                                  <div class="sub-text">Підписуйтесь!</div>
                              </div>
                          </div>
                          <div class="icon-box">
                              <div class="icon"><img src="https://img.icons8.com/fluent/48/000000/computer-chat.png" style="width: 30px; height: 30px;"/></div>
                              <div class="text_menu">
                                  <div class="title"style="cursor: pointer;" onclick="document.location.href = '/service/rule/';">Правила корристування сайтом<i class="far fa-arrow-right"></i></div>
                                  <div class="sub-text">Регламент та угода користувача</div>
                              </div>
                          </div>
                          <div class="sub-menu-holder"></div>
                      </div>
                  </div>
                  <div id="sub-menu-container">
                      <div id="sub-menu-holder">
                          <div id="sub-menu-bottom">
                            
                          </div>
                      </div>
                  </div>
              </nav>

              <div class="nav_account btn_demo2">
                <?php 
                if(strlen($cook_id) > 0){
                  echo("
                      <!--a href='profile/' class='btn btn_sm_primary border-0 sweep_letter sweep_top bg-blue c-white rounded-pill'>
                      <div class='inside_item'>
                        <span data-hover='Профіль ✌'>Особистий кабінет</span>
                      </div>
                    </a-->
                    <a href='service/out.php' class='btn btn_sm_primary effect-letter rounded-8'>
                    Вихід
                  </a>
                  ");
                }else{
                  echo("<a href='login/' class='btn btn_sm_primary border-0 sweep_letter sweep_top bg-lightgreen c-white rounded-pill'>
                  <div class='inside_item'>
                    <span data-hover='Вперед ✌'>Вхід у систему</span>
                  </div>
                </a>
              <a href='registration/' class='btn btn_sm_primary effect-letter rounded-8'>
                Реєстрація
              </a>");
                }
                
                ?>
            </div>

            <script>
              function profile(){
                window.location.href = 'registration/'
              }
            </script>

          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->

      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="demo_1 banner_section banner_demo7">
          <div class="container">
            <div class="row">
              <div class="col-md-5 my-auto">
                <div class="banner_title" style="margin-top: 100px;">
                  <h1>Привіт! Ти зараз на <a style="color: blue;">Beekeeper portal</a>!</h1>
                  <p>
                    Найкращий портал, в якому ти <a style="color: rgb(0, 200, 0);">навчаєшся, знаходиш нових колег</a> і не тільки. Почни пізнавати світ бджільництва <a style="color: rgb(200, 0, 200);">прямо зараз!</a>
                  </p>
                  
                  <?php
                    if(strlen($cook_id) > 0){
                      
                    }else{
                      echo("
                          <div class='col-md-4 col-lg-2 mb-5' style='width: 200px; left: -20px;' onclick='profile()'>
                          <button type='button'
                            class='btn btn_md_primary scale border-0 sweep_letter sweep_top bg-blue c-white rounded-pill'>
                            <div class='inside_item'>
                              <span data-hover='Ми тебе чекаємо!'>Зареєструватися</span>
                            </div>
                          </button>
                        </div>
                      ");
                    }
                  ?>

                  <!--div class="margin-t-8">
                    <button type="button" class="btn btn_video" data-toggle="modal"
                      data-src="№" data-target="#mdllVideo">
                      <div class="scale rounded-circle play_video">
                        <i class="tio play_outlined"></i>
                      </div>
                      <span class="ml-3 font-s-16 c-dark">Дивитись відео проекту</span>
                    </button>
                  </div-->
                </div>
              </div>
              <div class="col-md-7" style="padding: 0;">
                <img class="ill_05" src="assets/img/girl.png" />
                
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->

        <!-- Start About -->
        <section class="abo_company">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item bg-blue">
                  <span class="d-block c-white font-s-16">Beekeeper portal</span>
                  <div class="title_sections">
                    <img class="mb-3" src="assets/img/gif/waving_hand.gif" width="60" />
                    <h2 class="c-white">Привіт! Приєднуйся!</h2>
                    <p class="c-white">
                    Ми раді кожному користувачу нашого сайту.
                    На ньому ти можеш навчатися, задавати питання,
                    шукати нових колег і друзів.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo mb-4 mb-lg-0">
                <div class="gq_item ill_item">
                  <span class="d-block c-dark font-s-16">Найкраще ком'юніті в світі.</span>
                  <img class="img-fluid ill_sec" src="assets/img/illus2.svg" />
                  <div class="title_sections">
                    <img src="assets/img/gif/nerd_face.gif" width="60" style="position: absolute; bottom: 180px; left: 30px;" />
                    <h2 class="c-dark">Читай цікаві статті та факти!</h2>
                    <p class="c-gray">
                      І розвивайтеся в темі бджільництва.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 emo">
                <div class="gq_item ill_item">
                  <span class="d-block c-dark font-s-16">Купуй, продавай, працюй.</span>
                  <img class="img-fluid ill_sec" src="assets/img/illus1.svg" />
                  <div class="title_sections">
                    <img src="assets/img/gif/smiling_face_with_sunglasses.gif" width="60" style="position: absolute; bottom: 180px; left: 30px;" />
                    <h2 class="c-dark">Безліч цікавих оголошень!</h2>
                    <p class="c-gray">
                      Знайти нове обладнання, продати мед, або просто знайти роботу? Легко!
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. About -->

        <!-- Start logos -->
        <section class="logos_section logos_demo2 padding-t-10">
          <div class="container">
            <div class="row">
              <div class="col-lg-5">
                <div class="title_sections mb-0">
                  <h2>
                    Наша <a style="color: coral;">система краща в своєму роді</a>.
                  </h2>
                  <p>
                    Яка <a style="color: deeppink;">створена спеціально для людей</a>, які займаються бджільництвом, шукають нових працівників, або хоча освоїти нові напрямки в житті. І ми вам в цьому допоможемо!
                  </p>
                </div>
              </div>
              <div class="col-lg-6 ml-auto">
                <div class="cards_pc">
                <!-- Unecard -->

                <script src="https://kit.fontawesome.com/48764efa36.js" crossorigin="anonymous">
                  el.onmousedown = function (e) {
                      if (window.event.stopPropagation) window.event.stopPropagation();
                      window.event.cancelBubble = true;
                      e.cancelBubble = true;
                  }
                </script>
                  <link rel="preconnect" href="https://fonts.gstatic.com">
                  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">

              <h1 style="color: #f167ac;">Проведи час з користю!!</h1>
              <div id="album-rotator">
                  <div id="album-rotator-holder" style="width: 500px;">
                      <a target="_top" class="album-item" href="forum/">
                          <span class="album-details">
                              <span class="title">Форум</span>
                              <span class="icon">Для пасічників, та будь яких тем.</span>
                              <span class="subtext">Обговорити важні теми.</span>
                          </span>
                      </a>      
                      <a target="_top" class="album-item" href="wiki/">
                          <span class="album-details">
                              <span class="title">Вікі</span>
                              <span class="icon">Читай цікаві статті, або напиши свою.</span>
                              <span class="subtext">Шукати щось цікаве...</span>
                          </span>
                      </a>
                      <a target="_top" class="album-item" href="shop/">
                          <span class="album-details">
                              <span class="title" style="font-size: 32px;">Оголошення</span>
                              <span class="icon">Купуй та продавай легко.</span>
                              <span class="subtext">Купити 💵</span>
                          </span>
                      </a>
                      <a target="_top" class="album-item" href="https://t.me/unesell">
                        <span class="album-details">
                            <span class="icon"><i class="far fa-at"></i> unesell</span>
                            <span class="title">Чат в</span>
                            <span class="subtitle">Telegram</span>
                            <span class="subtext">Вперед!👉</span>
                        </span>
                    </a>
                  </div>
              </div>
              <script id="noise" type="x-shader/x-fragment">
                #define NUM_OCTAVES 5

              vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
              vec2 mod289(vec2 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
              vec3 permute(vec3 x) { return mod289(((x*34.0)+1.0)*x); }

              float rand(float n){return fract(sin(n) * 43758.5453123);}
              float rand(vec2 n) { 
                  return fract(sin(dot(n, vec2(12.9898, 4.1414))) * 43758.5453);
              }
              float noise(float p){
                  float fl = floor(p);
                float fc = fract(p);
                  return mix(rand(fl), rand(fl + 1.0), fc);
              }
              float noise(vec2 n) {
                  const vec2 d = vec2(0.0, 1.0);
                vec2 b = floor(n), f = smoothstep(vec2(0.0), vec2(1.0), fract(n));
                  return mix(mix(rand(b), rand(b + d.yx), f.x), mix(rand(b + d.xy), rand(b + d.yy), f.x), f.y);
              }

              float snoise(vec2 v) {
                  const vec4 C = vec4(0.211324865405187,  // (3.0-sqrt(3.0))/6.0
                                      0.366025403784439,  // 0.5*(sqrt(3.0)-1.0)
                                      -0.577350269189626,  // -1.0 + 2.0 * C.x
                                      0.024390243902439); // 1.0 / 41.0
                  vec2 i  = floor(v + dot(v, C.yy) );
                  vec2 x0 = v -   i + dot(i, C.xx);
                  vec2 i1;
                  i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
                  vec4 x12 = x0.xyxy + C.xxzz;
                  x12.xy -= i1;
                  i = mod289(i); // Avoid truncation effects in permutation
                  vec3 p = permute( permute( i.y + vec3(0.0, i1.y, 1.0 ))
                      + i.x + vec3(0.0, i1.x, 1.0 ));

                  vec3 m = max(0.5 - vec3(dot(x0,x0), dot(x12.xy,x12.xy), dot(x12.zw,x12.zw)), 0.0);
                  m = m*m ;
                  m = m*m ;
                  vec3 x = 2.0 * fract(p * C.www) - 1.0;
                  vec3 h = abs(x) - 0.5;
                  vec3 ox = floor(x + 0.5);
                  vec3 a0 = x - ox;
                  m *= 1.79284291400159 - 0.85373472095314 * ( a0*a0 + h*h );
                  vec3 g;
                  g.x  = a0.x  * x0.x  + h.x  * x0.y;
                  g.yz = a0.yz * x12.xz + h.yz * x12.yw;
                  return 130.0 * dot(m, g);
              }
              const mat2 m2 = mat2(0.8,-0.6,0.6,0.8);

              #define NB_OCTAVES 8
              #define LACUNARITY 10.0
              #define GAIN 0.5

              float fbm(in vec2 p) {
                  float total = 0.0,
                      frequency = 1.0,
                      amplitude = 1.0;
                  
                  for (int i = 0; i < NB_OCTAVES; i++) {
                      total += snoise(p * frequency) * amplitude;
                      frequency *= LACUNARITY;
                      amplitude *= GAIN;
                  }    
                  return total;
              }

              </script>
              <script id="vertex" type="x-shader/x-fragment">
                uniform float u_time;
              uniform float u_height;
              uniform vec2 u_rand;

              float xDistortion;
              float yDistortion;

              varying float vDistortion;
              varying vec2 vUv;

              void main() {
                  vUv = uv;
                  vDistortion = snoise(vUv.xx * 3. - vec2(u_time / u_rand.x, u_time / u_rand.x) + cos(vUv.yy) * u_rand.y) * u_height;
                  xDistortion = snoise(vUv.xx * 1.) * u_height * u_rand.x / 10.;
                  vec3 pos = position;
                  pos.z += (vDistortion * 55.);
                  pos.x += (xDistortion * 55.);
                  pos.y += (sin(vUv.y) * 55.);
                  
                  gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);
              }

              </script>
              <script id="fragment" type="x-shader/x-fragment">
                vec3 rgb(float r, float g, float b) {
                  return vec3(r / 255., g / 255., b / 255.);
              }
              vec3 rgb(float c) {
                  return vec3(c / 255., c / 255., c / 255.);
              }

              uniform vec3 u_lowColor;
              uniform vec3 u_highColor;
              uniform float u_time;

              varying vec2 vUv;
              varying float vDistortion;
              varying float xDistortion;

              void main() {
                  vec3 highColor = rgb(u_highColor.r, u_highColor.g, u_highColor.b);
                  
                  vec3 colorMap = rgb(u_lowColor.r, u_lowColor.g, u_lowColor.b);

                  colorMap = mix(colorMap, highColor, vDistortion);
                  
                  gl_FragColor = vec4(colorMap, 1.);
              }

                </script>

                <!-- End unecard -->
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End logos -->

        <!-- Start Services -->
        <section class="products_section product_demo2 features_hosting margin-t-8 padding-t-10"
          id="Services">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 margin-b-3">
                <div class="title_sections mb-0">
                  <div class="before_title">
                    <span>Наші</span>
                    <span class="c-blue">переваги</span>
                  </div>
                  <h2>Краща система для спілкування, постинга і покупок.</h2>
                  <p>
                    Яка поєднана з приємним інтерфейсом. А ще наш сервіс ...
                  </p>
                </div>
              </div>
              <div class="col-lg-7 ml-sm-auto">
                <div class="row">
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon_t">
                        <img src="assets/img/icons/Employee.svg" />
                      </div>
                      <h3>Один аккаунт</h3>
                      <p>
                        Один аккаунт і доступ до всіх сервісів порталу.
                        Швидка реєстрація і початок роботи за 5 хвилин.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="100">
                      <div class="icon_t">
                        <img src="assets/img/icons/Binocular.svg" />
                      </div>
                      <h3>Пристрасть до приватності</h3>
                      <p>
                        Всі ваші дані в безпеці.
                        Ніхто не буде знати, хто ви і де живете, поки ви самі про це не скажите.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5 mb-3 mb-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="200">
                      <div class="icon_t">
                        <img src="assets/img/icons/Shield-check.svg" />
                      </div>
                      <h3>Любов до безпеки</h3>
                      <p>
                        Ніхто не зможе отримати доступ до аккаунту,
                        без ваших даних, які в системі ніде не з'являються.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 item pr-sm-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="300">
                      <div class="icon_t">
                        <img src="assets/img/icons/Door-open.svg" />
                      </div>
                      <h3>Доступ в будь-який час.</h3>
                      <p>
                        Система працює 24/7 і завжди доступна в будь-який час. Для вас.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .container -->
        </section>
        <!-- End. Services -->

        <!-- Start Statistic -->
        <section class="margin-t-12 section_state" id="Statistic">
          <!-- particle background -->
          <div id="particles-js"></div>
          <div class="container">
            <div id="triggerBlur"></div>
            <div class="row justify-content-center text-center">
              <div class="col-md-5">
                <div class="title_sections">
                  <div class="before_title">
                    <span>Beekeeper portal</span><br>
                    <span class="c-blue">Статистика</span>
                  </div>
                  <h2>Нас з вами вже</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="bb_qgency_state">
                  <div class="number_state">
                    <div class="txt">
                      <?php
                      
                          $res = $mysql->query("SELECT count(*) FROM accounts_users");
                          $row = $res->fetch_row();
                          echo($row[0]);
                      
                      ?>
                    </div>
                  </div>
                  <!--<div class="blur_item" style="height: 80%;"></div>-->
                  <div class="content_state">
                    <div class="row justify-content-md-center">
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="assets/img/icons/1f469.png" />
                          </div>
                          <div class="info_txt">
                            <h4>
                              <?php
                        
                                  $res = $mysql->query("SELECT count(*) FROM accounts_users");
                                  $row = $res->fetch_row();
                                  echo($row[0]);
                              
                              ?>
                            </h4>
                            <p>
                              Акаунтів зареєстровано
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="assets/img/icons/2665.png" />
                          </div>
                          <div class="info_txt">
                            <h4>
                            <?php
                        
                                  $res = $mysql->query("SELECT count(*) FROM liked_forum");
                                  $row = $res->fetch_row();
                                  echo($row[0]);
                              
                              ?>
                            </h4>
                            <p>
                              Збережених матеріалів
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="assets/img/icons/1f58c.png" />
                          </div>
                          <div class="info_txt">
                            <h4>
                                <?php
                          
                                  $res = $mysql->query("SELECT count(*) FROM forum_main_mess");
                                  $row = $res->fetch_row();
                                  echo($row[0]);
                      
                                ?>
                            </h4>
                            <p>
                              Створених тем та оголошень
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="it__em">
                          <div class="icon">
                            <img src="assets/img/icons/1f647-2640.png" />
                          </div>
                          <div class="info_txt">
                            <h4>
                            <?php
                          
                              $res = $mysql->query("SELECT count(*) FROM wiki");
                              $row = $res->fetch_row();
                              echo($row[0]);
                  
                            ?>
                            </h4>
                            <p>
                              Статей на вікі
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="users_profile">
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                    <img src="assets/img/default.png"/>
                  </div>
                  <div class="link_state">
                    <a href="registration/" class="btn btn_xl_primary btn_join effect-letter rounded-8 mb-3 mb-sm-0">
                      Приєднатися до нас</a>
                    <a href="login/" class="btn btn_xl_primary btn_touch rounded-8">
                      <img src="assets/img/icons/1f607.png" />
                      Вже з вами!
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. Statistic -->

        <!-- Start products App -->
        <section class="productsapp_section bg-white position-relative" id="Testimonial" style="padding-top: 50px;">
          <div class="product--app">
            <img class="Whangaehu" src="assets/img/polyans/Whangaehu.svg" alt="" />
            <div class="container-fluid position-relative z-index-3">
              <div class="row">
                <div class="col-lg-5">
                  <div class="title_sections">
                    <h2 class="c-beiget">Доступно для твого Смартфона.</h2>
                    <p class="c-light">
                      Всі можливості Вашого улюбленого порталу у тебе в телефоні! Залишайся з нами, де б ти не був.
                    </p>
                  </div>
                  <div class="app_smartphone">
                    <!--div class="btn--app mb-3 mb-sm-0">
                      <a class="media" href="#" target="_blank">
                        <div class="icon bg-blue">
                          <i class="tio google_play"></i>
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span>Завантажити</span>
                          </div>
                          <h4>Play Market</h4>
                        </div>
                      </a>
                    </div-->
                    <div class="btn--app">
                      <a class="media" href="#" target="_blank">
                        <div class="icon">
                          <i class="tio download"></i>
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span>Завантажити</span>
                          </div>
                          <h4>З нашого сервера</h4>
                        </div>
                      </a>
                    </div>
                  </div>
                  <!--div class="dashed-line margin-my-3"></div>
                  <div class="block_testimonial">
                    <h3 class="c-white">Що думають наші користувачі про нас?</h3>

                    <div class="swiper-container gallery-top content_swiper">
                      <div class="swiper-wrapper">

                        <div class="swiper-slide">
                          <div class="content">
                            "Відгук перший"
                          </div>
                          <div class="man👨">
                            <h4 class="d-inline-block">Ім'я</h4>
                            <a class="d-inline-block" href="#">@tommyres</a>
                            <h6>Професія</h6>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div-->
                </div>
                <div class="col-lg-5 ml-lg-auto">
                  <div class="mobile_app">
                    <img class="forward" src="assets/img/app01.png" />
                    <div id="targetRotate" class="spacer s0"></div>
                    <img class="back" id="animateRotate" src="assets/img/appdark01.png" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. products App -->

      </main>
      <!-- end main -->
    </div>
    <!-- [id] content -->

    <!-- footr -->
    <footer class="defalut-footer foot_demo3 light margin-t-12 padding-py-8">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="item_about">
              <a class="">
                <img src="assets/img/logo.svg" alt="" width="40px" height="40px"/>
              </a>
              <p>
                Найкраще місце для пасичників та бджолярів! Перевір це сам!
              </p>
              <div class="address">
                <span>@2021 Beekeeper portal / Unesell Studio</span>
                <span>Зв'язок: <a href="mailto:support@beesportal.online">support@beesportal.online</a></span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Система</h4>
              <a class="nav-link" href="service/premium/">Преміум</a>
              <a class="nav-link" href="service/rule/">Правила сервиса</a>
              <a class="nav-link" href="service/support/">Підтримка</a>              
            </div>
          </div>
          <!--div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Проект</h4>
              <a class="nav-link" href="">Автори</a>
            </div>
          </div-->
        </div>
        <div class="col-12 text-center padding-t-4">
          <div class="copyright">
            <span>© 2021
              <a href="http://unesell.pp.ua" target="_blank">Unesell Studio.</a>
              Всі права захищені.</span>
          </div>
        </div>
      </div>
    </footer>
    <!-- End. -->

    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>

    <!-- Tosts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div class="toast toast_demo" id="myTost" role="alert" aria-live="assertive" aria-atomic="true"
        data-animation="true" data-autohide="false">
        <div class="toast-body">
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <i class="tio clear"></i>
          </button>
          <h5>Ми використовуємо cookie 🍪</h5>
          <p>Все за правилами <a href="service/rule/">системи</a>.</p>
        </div>
      </div>
    </div>
    <!-- End. Toasts -->

    <!-- Video Modal -->
    <div class="modal mdll_video fade" id="mdllVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <!-- Close -->
      <button type="button" class="close bbt_close ripple_circle" data-dismiss="modal" aria-label="Close">
        <i class="tio clear"></i>
      </button>
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                allow="autoplay"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Start Section Loader 
    <section class="loading_overlay">
      <div class="loader_logo">
        <img class="logo" src="assets/img/logo.svg" />
      </div>
    </section>
     End. Loader -->
  </div>
  <!-- End. wrapper -->

  <!-- jquery -->
  <script src="assets/js/jquery-3.5.0.js" type="text/javascript"></script>
  <!-- jquery-migrate -->
  <script src="assets/js/jquery-migrate.min.js" type="text/javascript"></script>
  <!-- popper -->
  <script src="assets/js/popper.min.js" type="text/javascript"></script>
  <!-- bootstrap -->
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!--
  ============
  vendor file
  ============
  <script src='assets/js/new.js'></script>
  -->
  
  

  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.1/gsap.min.js'></script>
  <script  src="assets/js/main_girl.js"></script>
  
  <!--
  <script src="assets/js/vendor/particles.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/TweenMax.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/ScrollMagic.js" type="text/javascript"></script>
  <script src="assets/js/vendor/simpleParallax.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/waypoints.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/sharer.js" type="text/javascript"></script>
  <script src="assets/js/vendor/sticky.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/aos.js" type="text/javascript"></script>
  <script src="assets/js/vendor/animation.gsap.js" type="text/javascript"></script>
  <script src="assets/js/vendor/debug.addIndicators.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/swiper.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/countdown.js" type="text/javascript"></script>
  <script src="assets/js/vendor/jquery.counterup.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/charming.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/imagesloaded.pkgd.min.js" type="text/javascript"></script>
  <script src="assets/js/vendor/jquery.bxslider.min.js" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/628c8d2499.js" crossorigin="anonymous"></script>
  -->

  <!-- main file -->
  <script src="assets/js/main.js" type="text/javascript"></script>
  <!-- agency -->
  <script src="assets/js/pages/agency.js" type="text/javascript"></script>
  <!-- new -->
  <script src="assets/js/card.js" type="module"></script>
</body>

</html>