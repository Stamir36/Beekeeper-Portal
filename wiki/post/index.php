<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Стаття</title>
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
          <div class="d-flex align-items-center"><a href="index.html" class="navbar-brand py-1"><img src="../img/logo.png" alt="Directory logo" width="150px"></a>
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
              <li class="nav-item mt-3 mt-lg-0 ml-lg-3 d-lg-none d-xl-inline-block"><a href="../new/" class="btn btn-primary">+ Написати статтю</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- /Navbar -->
    </header>

    <!-- Hero Section-->
    <section style="background-image: url('https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2018/04/Gradient-Featured-Image-03.jpg');" class="pt-7 pb-5 d-flex align-items-end dark-overlay bg-cover">
      <div class="container overlay-content">
        <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
          <div class="text-white mb-4 mb-lg-0">
            <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">КАТЕГОРІЯ</div>
            <h1 class="text-shadow verified">НАЗВА СТАТТІ АБО КОНТЕНТУ</h1>
            <p>АВТОР</p>
            <p>Час читання: 8 мін.</p>
          </div>
          <div class="calltoactions"><a href="../../forum/" onclick="$('#leaveReview').collapse('show')" data-smooth-scroll class="btn btn-primary">Обговорити на форумі</a></div>
        </div>
      </div>
    </section>

    <section class="py-6">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <!-- About Listing-->
            <div class="text-block">
              <h3 class="mb-3">Глава</h3>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
              <p class="text-muted"> Текст - текст - текст- текст- текст- текст- текст- текст- текст- текст- текст- текст</p>
            </div>
            <div class="text-block">
              <h3 class="mb-4">Ще</h3>
            </div>

            <div class="text-block">
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
            </div>
            <div class="text-block">
              <p class="subtitle text-sm text-primary">Коментарі    </p>
              <h5 class="mb-4">Останні коментарі </h5>

              <div class="media d-block d-sm-flex review">
                <div class="media-body">
                  <h6 class="mt-2 mb-1">Анна Яндере</h6>
                  <div class="mb-2"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i>
                  </div>
                  <p class="text-muted text-sm">Мій коментар</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="pl-xl-4">
              <!-- Opening Hours      -->
              <div class="card border-0 shadow mb-5">
                <div class="card-header bg-gray-100 py-4 border-0">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="subtitle text-sm text-primary">Автор</p>
                      <h4 class="mb-0">Адам Реймс </h4>
                    </div>
                    <svg class="svg-icon svg-icon svg-icon-light w-3rem h-3rem ml-3 text-muted">
                      <use xlink:href="../#"> </use>
                    </svg>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table text-sm mb-0">
                    <tr>
                      <th class="pl-0 border-0">Назва статті</th>
                      <td class="pr-0 text-right border-0">Вчора</td>
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