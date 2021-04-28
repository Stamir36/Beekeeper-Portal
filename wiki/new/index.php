<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Нова стаття</title>
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
              <li class="nav-item"><a href="#" class="nav-link">Статті</a></li>
              <li class="nav-item"><a href="#" class="nav-link">Енциклопедія</a></li>
              <li class="nav-item mt-3 mt-lg-0 ml-lg-3 d-lg-none d-xl-inline-block"><a href="../new/" class="btn btn-primary">+ Написати статтю</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- /Navbar -->
    </header>

    <section class="py-5">
      <div class="container">
        <p class="subtitle text-primary">Редактор</p>
        <h1 class="h2 mb-5"> Створення контенту </h1>
        <form>
          <div class="row form-block">
            <div class="col-lg-4">
              <h4>Основне</h4>
              <p class="text-muted text-sm">Вкажіть назву вашої публікації, це дуже важливо, адже саме за назвою її можна буде знайти. Так само, виберіть вид, до якого відноситься ваш текст.</p>
            </div>
            <div class="col-lg-7 ml-auto">
              <div class="form-group"></div>
              <div class="form-group">
                <label for="form_name" class="form-label">Назва публікації</label>
                <input name="name" id="form_name" class="form-control">
              </div>
              <div class="form-group">
                      <label for="exampleFormControlSelect1" class="form-label">Виберіть категорію</label>
                      <select class="form-control" name="category">
                        <option>Пасічництво</option>
                        <option>Продукти та їжа</option>
                        <option>Робота та компанії</option>
                        <option>Життя</option>
                        <option>Інше</option>
                      </select>
                    </div>
              <div class="form-group">
                <label class="form-label">Вивести публікацію в <a style="background-color: rgb(255, 236, 211); border-radius: 2px; padding: 2px;">топ?</a></label>
                <br><a class="form-label" style="font-size: 14px; color: rgb(165, 165, 138);">Тільки преміум</a>
                <div class="custom-control custom-radio">
                  <input type="radio" id="guests_0" name="guests" class="custom-control-input">
                  <label for="guests_0" class="custom-control-label">Так, показувати на головній.</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="guests_1" name="guests" class="custom-control-input">
                  <label for="guests_1" class="custom-control-label">Ні</label>
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
              <!-- Text wiki -->
              <div class="form-group">
                <label for="form_street" class="form-label">Ваш текс</label>
                <textarea name="content" id="content" placeholder="Почніть писати ваше повідомлення..." class="form-control" style="min-height: 300px;"></textarea>
              </div>
              <div class="form-group">
                <label for="form_street" class="form-label">Обкладинка публікації</label> <br>
                <a href="#" class="btn btn-warning px-3"> Вибрати картинку </a>
              </div>
            </div>
          </div>

          <div class="row form-block">
            <div class="col-lg-4">
              <h4>Зв'язок</h4>
              <p class="text-muted text-sm">Ви можете з'єднати свою статтю зі своєю темою на форумі, щоб користувачі могли більш детально обговорити тему.</p>
            </div>
            <div class="col-lg-7 ml-auto">
              <!-- Text wiki -->
              <div class="form-group">
                <label for="form_street" class="form-label">Виберіть тему:</label>
                <div class="form-group">
                  <select class="form-control" name="category">
                    <option>Не прив'язувати</option>
                    <option>Назва теми 1</option>
                    <option>Назва теми 2</option>
                    <option>Назва теми 3</option>
                    <option>Назва теми 4</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row form-block flex-column flex-sm-row">
            <div class="col text-center text-sm-left">
            </div>
            <div class="col text-center text-sm-right"><a href="#" class="btn btn-primary px-3"> Опублікувати <i class="fa-chevron-right fa ml-2"></i></a></div>
          </div>
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