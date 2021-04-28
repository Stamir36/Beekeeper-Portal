<!DOCTYPE html>
<html lang="en">
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
            font-family: Unecoin; /* Имя шрифта */
            src: url(../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
        }
        html{
            font-family: Unecoin;
        }
    </style>
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
          <div class="d-flex align-items-center"><a href="index.html" class="navbar-brand py-1"><img src="img/logo.png" alt="Directory logo" width="150px"></a>
            <form action="#" id="search" class="form-inline d-none d-sm-flex">
              <div class="input-label-absolute input-label-absolute-left input-reset input-expand ml-lg-2 ml-xl-3"> 
                <label for="search_search" class="label-absolute"><i class="fa fa-search"></i><span class="sr-only">Що ти шукаєш?</span></label>
                <input id="search_search" placeholder="Пошук" aria-label="Search" class="form-control form-control-sm border-0 shadow-0 bg-gray-200">
                <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas"></i></button>
              </div>
            </form>
          </div>
          <!-- Navbar Collapse -->
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <form action="#" id="searchcollapsed" class="form-inline mt-4 mb-2 d-sm-none">
              <div class="input-label-absolute input-label-absolute-left input-reset w-100">
                <label for="searchcollapsed_search" class="label-absolute"><i class="fa fa-search"></i><span class="sr-only">Що ти шукаєш?</span></label>
                <input id="searchcollapsed_search" placeholder="Пошук" aria-label="Search" class="form-control form-control-sm border-0 shadow-0 bg-gray-200">
                <button type="reset" class="btn btn-reset btn-sm"><i class="fa-times fas">           </i></button>
              </div>
            </form>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="login.html" class="nav-link">Статті</a></li>
              <li class="nav-item"><a href="signup.html" class="nav-link">Енциклопедія</a></li>
              <li class="nav-item mt-3 mt-lg-0 ml-lg-3 d-lg-none d-xl-inline-block"><a href="new/" class="btn btn-primary">+ Написати статтю</a></li>
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
              <form action="#">
                <div class="row">
                  <div class="pc_viev">
                    <input type="text" name="search" placeholder="Що хочете знайти?" class="form-control border-0 shadow-0" style="width: 100%;">
                  </div>
                  <div class="col-lg-2" style="  margin-left: auto; margin-right: 0.2em;">
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
          <div class="col-md-4 d-md-flex align-items-center justify-content-end"><a href="blog.html" class="text-muted text-sm">
               
            Дивитися всі статті<i class="fas fa-angle-double-right ml-2"></i></a></div>
        </div>
        <div class="row">

          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card shadow border-0 h-100"><a href="post/"><img src="https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2018/04/Gradient-Featured-Image-03.jpg" alt="..." class="img-fluid card-img-top"/></a>
              <div class="card-body"><a href="post/" class="text-uppercase text-muted text-sm letter-spacing-2">КАТЕГОРІЯ</a>
                <h5 class="my-2"><a href="post/" class="text-dark">НАЗВА СТАТТІ</a></h5>
                <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>ДАТА</p>
                <p class="my-2 text-muted text-sm">ОПИС АБО ПОЧАТОТ СТАТТІ</p><a href="#" class="btn btn-link pl-0">Читати далі<i class="fa fa-long-arrow-alt-right ml-2"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card shadow border-0 h-100"><a href="post/"><img src="https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2018/04/Gradient-Featured-Image-03.jpg" alt="..." class="img-fluid card-img-top"/></a>
              <div class="card-body"><a href="post/" class="text-uppercase text-muted text-sm letter-spacing-2">КАТЕГОРІЯ</a>
                <h5 class="my-2"><a href="post/" class="text-dark">НАЗВА СТАТТІ</a></h5>
                <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>ДАТА</p>
                <p class="my-2 text-muted text-sm">ОПИС АБО ПОЧАТОТ СТАТТІ</p><a href="#" class="btn btn-link pl-0">Читати далі<i class="fa fa-long-arrow-alt-right ml-2"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card shadow border-0 h-100"><a href="post/"><img src="https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2018/04/Gradient-Featured-Image-03.jpg" alt="..." class="img-fluid card-img-top"/></a>
              <div class="card-body"><a href="post/" class="text-uppercase text-muted text-sm letter-spacing-2">КАТЕГОРІЯ</a>
                <h5 class="my-2"><a href="post/" class="text-dark">НАЗВА СТАТТІ</a></h5>
                <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>ДАТА</p>
                <p class="my-2 text-muted text-sm">ОПИС АБО ПОЧАТОТ СТАТТІ</p><a href="#" class="btn btn-link pl-0">Читати далі<i class="fa fa-long-arrow-alt-right ml-2"></i></a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="py-6 bg-white">
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
    </section>
    
    <section class="py-7 position-relative dark-overlay"><img src="https://cdn.dribbble.com/users/45782/screenshots/11304218/gradient_02_a.jpg" alt="" class="bg-image">
      <div class="container">
        <div class="overlay-content text-white py-lg-5">
          <h3 class="display-3 font-weight-bold text-serif text-shadow mb-5">Чи готові почати з основ?</h3><a href="category-rooms.html" class="btn btn-light">Почати</a>
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
            </div>
            <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
              <h6 class="text-uppercase text-dark mb-3">Меню</h6>
              <ul class="list-unstyled">
                <li><a href="#" class="text-muted">Категорія     </a></li>
                <li><a href="#" class="text-muted">Категорія     </a></li>
                <li><a href="#" class="text-muted">Категорія     </a></li>
                <li><a href="#" class="text-muted">Категорія     </a></li>
                <li><a href="#" class="text-muted">Категорія     </a></li>
              </ul>
            </div>
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
  </body>
</html>