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
    

    if(isset($_GET["page"])){
        $page = $_GET["page"];
      }
      if(isset($_GET["s"])){
        $value_search = urldecode($_GET["s"]); // Получение результата поиска
      }
      if(strlen($value_search) <= 0){
        header('Location: /forum/');
      }
      $settings_search = "`Create_Date` DESC";
      $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `name` LIKE '%$value_search%' ORDER BY $settings_search");
      $count_num = $result_count->fetch_assoc();
      $count = $count_num['COUNT(*)']; // Количество записей
  
      if($page <= 0){
        header('Location: ?s='.$value_search.'&page=1');
      }
  
      $OFFSET = $page * 10 - 10; //С какой записи выводить
      $product = $mysql->query("SELECT * FROM `shop_product` WHERE `name` LIKE '%$value_search%' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
  
      $num_page = ceil($count / 10); //Количество страниц

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Каталог оголошень - портал пасічників</title>
        <link rel="icon" type="image/png" href="../assets/images/logo/nephos.png" />

        <!--Core CSS -->
        <link rel="stylesheet" href="../assets/css/bulma.css">
        <link rel="stylesheet" href="../assets/css/core.css">
        <link rel="stylesheet" href="../assets/css/content.css">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,400" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet">
        
        <!-- plugins -->
        <link rel="stylesheet" href="../assets/js/slick/slick.css">
        <link rel="stylesheet" href="../assets/js/slick/slick-theme.css">
        <link rel="stylesheet" href="../assets/js/webuipopover/jquery.webui-popover.min.css">
        <link rel="stylesheet" href="../assets/js/izitoast/css/iziToast.min.css">
        <link rel="stylesheet" href="../assets/js/zoom/zoom.css">
        <link rel="stylesheet" href="../assets/js/jpcard/card.css">
        <link rel="stylesheet" href="../assets/css/chosen/chosen.css">
        <link rel="stylesheet" href="../assets/css/icons.min.css">
        <style>
            @font-face {
                font-family: Unecoin; /* Имя шрифта */
                src: url(../../../assets/fonts/font_bolt.ttf); /* Путь к файлу со шрифтом */
            }
            html{
                font-family: Unecoin;
            }
        </style>
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        
    <?php include '../../service/contextmenu.php'; include '../backmwnu.php';?>

            <!-- Main section -->
            <div class="section">
                <!-- Container -->
                <div class="container">
        
                    <!-- House products -->
                    <div class="columns category-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="category-title is-product-category">
                                <h2>Пошук оголошень</h2>
                                <div class="category-icon is-hidden-mobile">
                                </div>
                            </div>
        
                            <!-- Controls -->
                            <div class="listing-controls">
                                <div class="layout-controls">
                                    <p>Ви шукали: <a style="color: orange; cursor: text;"><?php echo($value_search);?></a></p>
                                </div>
                                <!-- Sort -->
                                <div class="sort-box">
                                    <div class="sort-box-select">
                                        <select data-placeholder="Default order" class="chosen-select-no-single">
                                            <option>Самі нові</option>	
                                            <option>Найшижча ціна</option>
                                            <option>Найвища ціна</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /Controls -->
        
                            <!-- Product List -->
                            <div class="columns is-product-list is-multiline">
                                <div class="column is-12">
                                    <ul>

                                        <?php
                                        $id_product = Array();
                                        $photo = Array();
                                        $name = Array();
                                        $city = Array();
                                        $price = Array();
                                        $Create_Date = Array();
                                        $autor_name = Array();
                                        while($result = $product->fetch_assoc()){
                                            $id_product[] = $result['id'];
                                            $photo[] = $result['photo'];
                                            $name[] = $result['name'];
                                            $city[] = $result['city'];
                                            $price[] = $result['price'];
                                            $Create_Date[] = $result['Create_Date'];
                                            $autor_name[] = $result['autor_name'];
                                        }
        
                                        $num_prod = 0;
        
                                        if(count($photo) == count($name) && count($city) != 0 && count($name) != 0 ){
                                            while($num_prod <= (count($name) - 1)){
                                                echo("
                                                <li class='flat-card is-auto is-list-item'>
                                                    <!-- Product image -->
                                                    <span class='image'>
                                                        <img src='/shop/catalog/image/".$photo[$num_prod]."' alt=''>
                                                    </span>
                                                    <!-- Product meta -->
                                                    <span class='product-info'>
                                                        <!-- Rating -->
                                                        <span class='rating'>
                                                            <a href='/shop/product/?id=".$id_product[$num_prod]."'>".$name[$num_prod]."</a>
                                                        </span>
                                                        <!-- Meta -->
                                                        <a href='/shop/product/?id=".$id_product[$num_prod]."'><span class='product-name'>".$city[$num_prod]."</span></a>
                                                        <span class='product-description'>".date("F j, Y", strtotime($Create_Date[$num_prod]))."</span>
                                                        <span class='product-price'>
                                                            ".$price[$num_prod]."
                                                        </span>
                                                    </span>
                                                    <!-- Abstract -->
                                                    <span class='product-abstract is-hidden-mobile'>
                                                        Продавець:<br/>
                                                        <a style='justify-content: left;'>".$autor_name[$num_prod]."</a>
                                                        <span class='view-more'>
                                                            <a class='button upper-button rounded is-bold raised' href='/shop/product/?id=".$id_product[$num_prod]."' style='padding: 15px; border-radius: 2px;'>Детальніше <i data-feather='chevron-right'></i></a>
                                                        </span>
                                                    </span>
                                                </li>
                                                ");
                                                $num_prod = $num_prod + 1;
                                            }
                                        }else{
                                            echo("
                                                <div style='padding: 20px; width: 100%; background-color: #fff; border-radius: 10px;'>
                                                    <a style='color:red;'>Нічого не знайдено 😥 <br/>
                                                    Спробуйте змінити запит, або параметри.</a>
                                                </div>
                                            ");
                                        }
                                        ?>

                                    </ul>
        
                                </div>
        
                            </div>
                            <!-- /Product list -->
        
                            <div class="show-more"><a href="#">Показати більше</a></div>
        
                        </div>
                    </div> 
                    <!-- /products -->

                </div>
                <!-- /Container -->
            </div>
            <!-- /Main section -->
        </div>
        <!-- /Main wrapper -->
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>    </body>  
</html>
