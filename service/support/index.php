<!DOCTYPE html>
<html lang="ua">
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

  <title>Підтримка - портал пасічника.</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon" />
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="../../assets/css/main/bootstrap.min.css" type="text/css" />
  <!-- animate -->
  <link rel="stylesheet" href="../../assets/css/main/animate.css" type="text/css" />
  <!-- Swiper -->
  <link rel="stylesheet" href="../../assets/css/main/swiper.min.css" />
  <!-- aos -->
  <link rel="stylesheet" href="../../assets/css/main/aos.css" type="text/css" />
  <!-- icons -->
  <link rel="stylesheet" href="../../assets/css/main/icons.css" type="text/css" />
  <!-- main css -->
  <link rel="stylesheet" href="../../assets/css/main/main.css" type="text/css" />
  <!-- normalize -->
  <link rel="stylesheet" href="../../assets/css/main/normalize.css" type="text/css" />
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
  <!-- js for Brwoser -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="contact_inner_three">
  <div id="wrapper">
    <div id="content">
      <!-- Start header -->
      <header class="header-nav-center no_blur header_software active-green2" id="myNavbar">
        <div class="container">
          <!-- navbar -->
          <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
            <a class="navbar-brand" href="../../">
              <img class="logo" src="../../assets/img/logo.svg" alt="logo" />
              <span>Beekeeper portal</span>  
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
              <ul class="navbar-nav mx-auto nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="../../">Головна</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="../../forum">Форум</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="../../shop">Оголошення</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="../../wiki">Енциклопедія</a>
                </li>

                

              </ul>
              <div class="nav_account btn_demo3">
                <button type="button" data-toggle="modal" data-target="#mdllLogin"
                  class="btn btn_sm_primary opacity-1 sweep_letter scale sweep_top rounded-8">
                  <?php             
                    if(strlen(htmlspecialchars($_COOKIE["id"])) > 0){
                      echo("
                      <div class='inside_item'>
                        <span data-hover='Поїхали 🤟' onclick='window.history.back()'>Повернутись назад</span>
                      </div>
                      ");
                    }else{
                      echo("
                      <div class='inside_item'>
                        <span data-hover='Приєднуйся!' onclick='document.location.href = `/login/`'>Вхід у систему</span>
                      </div>
                      ");
                    }
                  ?>
                </button>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->

      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start banner_cotact_one -->
        <section class="demo__charity banner_cotact_one banner_cotact_three">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5">
                <div class="banner_title_inner margin-b-4">
                  <h1 class="c-white" data-aos="fade-up" data-aos-delay="0">
                    Підтримка
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                  З'явилися питання або проблеми? Зв'яжіться з нами!
                  </p>
                </div>
                <div class="row">
                  <div class="col-lg-10">
                    <div class="information_content">
                      <div class="link_item" data-aos="fade-up" data-aos-delay="200">
                        <a href="https://t.me/unesell">
                          <i class="tio telegram"></i>
                          @unesell
                        </a>
                      </div>

                      <div class="link_item selecr_mark" data-aos="fade-up" data-aos-delay="300">
                        <a href="mailto:unesell@outlook.co">
                          <i class="tio email"></i>
                          unesell@outlook.com
                        </a>
                      </div>

                      <div class="link_item" data-aos="fade-up" data-aos-delay="400">
                        <p class="d-flex">
                          <i class="tio poi"></i>
                          проспект Науки, 14, Харків, Харківська область, 61000
                        </p>
                      </div>

                    </div>
                    <div class="cc_socialmedia">
                      <a href="https://t.me/unesell">
                        <i class="tio telegram"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 ml-md-auto my-auto">
                <form action="" class="row form_contact_two">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Електронна пошта</label>
                      <div class="input_group">
                        <input id = "email" type="email" class="form-control" placeholder="Наприклад unesell@outlook.co">
                        <i class="tio online"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Призвіще та Ім'я</label>
                      <div class="input_group">
                        <input id="pib"type="text" class="form-control" placeholder="Наприклад Важкий Ігор">
                        <i class="tio account_square_outlined"></i>
                      </div>

                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Повідомлення</label>
                      <textarea id="text_support" type="text" class="form-control" rows="5" placeholder="Опишіть вашу проблему тут..."></textarea>
					  <!--<input id="text_support" type="text" style="width: 100%"> -->
                    </div>
                  </div>


                  <div id='note_box' class="alert alert-success alert-dismissible fade show" role="alert" style='background-color: aqua; z-index: 100000; display: none; position: fixed; width: 350px; min-height: 55px; left: 22px; bottom: 10px; text-align: left; border: 1px solid black;'>
                    <p id='note_message' style='color: rgb(0, 0, 0); margin: 3px; font-weight: bold;  text-shadow: 1px 1px 1px #FFFFFF; filter: dropshadow(color=#FFFFFF, offx=1, offy=1);'></p>
                  </div>


                  <div class="col-12 d-md-flex justify-content-end margin-t-2">
                       <button id="sent_support" type="button" class="btn btn-warning" onclick="send_support()">Відправити</button>
						<script>
						function send_support(){
                      if(document.getElementById("text_support").value.length > 3){
                        if(Censorship(document.getElementById("text_support").value)){
                          $("#note_box").fadeOut(0);
                          throw_message("Вибачте, але ваша скарга містить слова, які забороненно вживати в системі!");
                          }else{
                            var system_info = "Account_violator_id: " + 0 + " DATA: " + "Онлайн підтримка";
                            var povid =document.getElementById("pib").value +":" + document.getElementById("email").value +":" + document.getElementById("text_support").value;
                            window.open("send_support.php?nofi=" + 0 + "&mess=" + povid + "&info=" + system_info + "&url=" + "<?php echo("../../../..".$_SERVER['REQUEST_URI']); ?>" ,"_blank");
							window.focus();
                            $("#note_box").fadeOut(0);
                            throw_message("Скарга відправлена.");
                            document.getElementById("text_support").value = "";                           
                            document.getElementById("pib").value = "";                           
                            document.getElementById("email").value = "";                           
                        }
                      }else{
                          $("#note_box").fadeOut(0);
                          throw_message("Вибачте, але ваша скарга дуже маленька, напишіть більше деталей.");
                      }
                    }

					  </script>
                  </div>
                </form>
              </div>

            </div>

            <div class="shape_circle">
              <div></div>
              <div></div>
            </div>

          </div>

        </section>
        <!-- End. Banner -->

      </main>
    </div>
    <!-- [id] content -->
    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>

  </div>
  <!-- End. wrapper -->

  <!-- jquery -->
  <script src="../../assets/js/jquery-3.5.0.js" type="text/javascript"></script>
  <!-- jquery-migrate -->
  <script src="../../assets/js/jquery-migrate.min.js" type="text/javascript"></script>
  <!-- popper -->
  <script src="../../assets/js/popper.min.js" type="text/javascript"></script>
  <!-- bootstrap -->
  <script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!--
  ============
  vendor file
  ============
   -->
  <!-- particles -->
  <script src="../../assets/js/vendor/particles.min.js" type="text/javascript"></script>
  <!-- TweenMax -->
  <script src="../../assets/js/vendor/TweenMax.min.js" type="text/javascript"></script>
  <!-- ScrollMagic -->
  <script src="../../assets/js/vendor/ScrollMagic.js" type="text/javascript"></script>
  <!-- animation.gsap -->
  <script src="../../assets/js/vendor/animation.gsap.js" type="text/javascript"></script>
  <!-- addIndicators -->
  <script src="../../assets/js/vendor/debug.addIndicators.min.js" type="text/javascript"></script>
  <!-- Swiper js -->
  <script src="../../assets/js/vendor/swiper.min.js" type="text/javascript"></script>
  <!-- countdown -->
  <script src="../../assets/js/vendor/countdown.js" type="text/javascript"></script>
  <!-- simpleParallax -->
  <script src="../../assets/js/vendor/simpleParallax.min.js" type="text/javascript"></script>
  <!-- waypoints -->
  <script src="../../assets/js/vendor/waypoints.min.js" type="text/javascript"></script>
  <!-- counterup -->
  <script src="../../assets/js/vendor/jquery.counterup.min.js" type="text/javascript"></script>
  <!-- charming -->
  <script src="../../assets/js/vendor/charming.min.js" type="text/javascript"></script>
  <!-- imagesloaded -->
  <script src="../../assets/js/vendor/imagesloaded.pkgd.min.js" type="text/javascript"></script>
  <!-- BX-Slider -->
  <script src="../../assets/js/vendor/jquery.bxslider.min.js" type="text/javascript"></script>
  <!-- Sharer -->
  <script src="../../assets/js/vendor/sharer.js" type="text/javascript"></script>
  <!-- sticky -->
  <script src="../../assets/js/vendor/sticky.min.js" type="text/javascript"></script>
  <!-- Aos -->
  <script src="../../assets/js/vendor/aos.js" type="text/javascript"></script>
  <!-- main file -->
  <script src="../../assets/js/main.js" type="text/javascript"></script>
  
  
  <script src="script.js" type="text/javascript"></script>
  <!-- Censorship -->
  <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
</body>

</html>