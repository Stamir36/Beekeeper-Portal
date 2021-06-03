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

    if(isset($_GET["sett"]) && $_GET["sett"] == 'new'){
        $settings_search = "`Create_Date` DESC";
    }else if(isset($_GET["sett"]) && $_GET["sett"] == 'pup'){
        $settings_search = "`price` ASC";
    }else if(isset($_GET["sett"]) && $_GET["sett"] == 'pdown'){
        $settings_search = "`price` DESC";
    }
    else{
        $settings_search = "`Create_Date` DESC";
    }
    
    if($_GET["c"] == "all"){
        $category = "";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }
    if($_GET["c"] == "home"){
        $category = "Для дому";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }
    if($_GET["c"] == "online"){
        $category = "Онлайн метаріали";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }
    if($_GET["c"] == "pasick"){
        $category = "Пасіка";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }
    if($_GET["c"] == "work"){
        $category = "Работа";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }
    if($_GET["c"] == "ect"){
        $category = "Інше";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` WHERE `category` = '$category' ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }if($_GET["c"] == ""){
        $category = "";
        $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` ORDER BY $settings_search");
        $count_num = $result_count->fetch_assoc();
        $count = $count_num['COUNT(*)']; // Количество записей

        if($page <= 0 && $_GET["page"] == ""){
            $page = 1;
        }
        

        $OFFSET = $page * 10 - 10; //С какой записи выводить
        $product = $mysql->query("SELECT * FROM `shop_product` ORDER BY $settings_search limit 10 OFFSET $OFFSET");
    }

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
        
    <?php include '../backmwnu.php';?>

            <!-- Main section -->
            <div class="section" style="min-height: 750px;">
                <!-- Container -->
                <div class="container">
        
                    <!-- House products -->
                    <div class="columns category-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="category-title is-product-category">
                                <h2>Всі оголошення</h2>
                                <div class="category-icon is-hidden-mobile">
                                </div>
                            </div>
        
                            <!-- Controls -->
                            <div class="listing-controls">
                                <div class="layout-controls">
                                    <!-- СТРАНИЦЫ САЙТА -->
                                </div>
                                <!-- Sort -->
                                <div class="sort-box">
                                    <div class="sort-box-select">
                                        <select data-placeholder="Default order" id="sett" class="chosen-select-no-single" onchange="sett();">
                                            <option>Самі нові</option>	
                                            <option>Найшижча ціна</option>
                                            <option>Найвища ціна</option>
                                        </select>
                                        <script>
                                            if("<?php echo($_GET['sett']);?>" == "new"){
                                                document.getElementById('sett').value = "Самі нові";
                                            }
                                            if("<?php echo($_GET['sett']);?>" == "pup"){
                                                document.getElementById('sett').value = "Найшижча ціна";
                                            }
                                            if("<?php echo($_GET['sett']);?>" == "pdown"){
                                                document.getElementById('sett').value = "Найвища ціна";
                                            }
                                            function sett(){
                                                if(document.getElementById('sett').value == "Самі нові"){
                                                    document.location.href = '?c=<?php echo($_GET['c']);?>&sett=new';
                                                }
                                                if(document.getElementById('sett').value == "Найшижча ціна"){
                                                    document.location.href = '?c=<?php echo($_GET['c']);?>&sett=pup';
                                                }
                                                if(document.getElementById('sett').value == "Найвища ціна"){
                                                    document.location.href = '?c=<?php echo($_GET['c']);?>&sett=pdown';
                                                }
                                            }
                                        </script>
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
                                                    Схоже, каталог зараз пустий...</a>
                                                </div>
                                            ");
                                        }
                                        ?>


                                    </ul>
        
                                </div>
        
                            </div>
                            <!-- /Product list -->
        
                            <nav class="wishlist-pagination" style="padding-top: 15px; z-index: -10; justify-content:left;">
                                <ul class="pagination" style="text-align: left;">
                                    
                                    <?php
                                    
                                    if($num_page == 1){
                                    echo("
                                        <li class='page-item active'>
                                            <a class='page-link'>1</a>
                                        </li>
                                        <li class='page-item disabled'>
                                            <a class='page-link'>Наступна</a>
                                        </li>
                                    ");
                                    }else{
                                    if($page == 1){
                                        $back = "../my/";
                                        echo("
                                        <li class='page-item disabled' style='pointer-events: none;'>
                                        <a class='page-link' onclick='document.location.href = `../my/?page=".($page - 1)."&c=".$_GET['c']."&sett=".$_GET['sett']."`;' tabindex='-1'>Попередня</a>
                                        </li>
                                    ");
                                    }else{
                                        echo("
                                        <li class='page-item' style='cursor: pointer;'>
                                        <a class='page-link' onclick='document.location.href = `../my/?page=".($page - 1)."&c=".$_GET['c']."&sett=".$_GET['sett']."`;' tabindex='-1'>Попередня</a>
                                        </li>
                                    ");
                                    }

                                    $start_page = $page;
                                    $end_page = $start_page + 3;
                                    $progress = true;

                                    if($page != 1){
                                        echo("
                                        <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../my/?page=".($start_page - 1)."&c=".$_GET['c']."&sett=".$_GET['sett']."`;'>".($start_page - 1)."</a></li>
                                        ");
                                    }

                                    while ($start_page < $end_page && $start_page <= $num_page) {
                                        if($start_page == $page){
                                        echo("
                                            <li class='page-item active' style='z-index: 0;'><a class='page-link'>".$start_page."</a></li>
                                        ");
                                        }else{
                                        echo("
                                            <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../my/?page=".$start_page."&c=".$_GET['c']."&sett=".$_GET['sett']."`;'>".$start_page."</a></li>
                                        ");
                                        }
                                        $start_page = $start_page + 1;
                                    }

                                    if ($num_page > 1 && $page > 0 && $num_page != $page) {
                                        $back = "../my/";
                                    echo("
                                        <li class='page-item' style='cursor: pointer;'>
                                            <a class='page-link' onclick='document.location.href = `../my/?page=".($page + 1)."&c=".$_GET['c']."&sett=".$_GET['sett']."`;' tabindex='-1'>Наступна</a>
                                        </li>
                                    ");
                                    }else{
                                        $back = "../my/";
                                        echo("
                                        <li class='page-item disabled'>
                                            <a class='page-link' onclick='document.location.href = `../my/?page=".($page + 1)."&c=".$_GET['c']."&sett=".$_GET['sett']."`;' tabindex='-1'>Наступна</a>
                                        </li>
                                        ");
                                    }                     
                                    }

                                    ?>
                                </ul>
                            </nav>
        
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
