<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'shop', time() + 3600 * 24, "/");
    if(strlen($cook_id) > 0){
        include "../../service/config.php";

        $mysql = new mysqli($Host, $User, $Password, $Database);
    
        $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
        $user = $result->fetch_assoc();
    
        //Из базы данных: $user['name'];
        $name = $user['name'];
        $avatar = $user['avatar'];
        $premium = $user['premium'];
        $Reg_Date = $user['Reg_Date'];
        $banned = $user['banned'];
        $email = $user['email'];
        $Date_of_Birth = $user['Date_of_Birth'];
    }else{
        header('Location: /login/');
    }

    if(isset($_GET["page"])){
        $page = $_GET["page"];
      }
      $settings_search = "`Create_Date` DESC";
      $result_count = $mysql->query("SELECT COUNT(*) FROM `shop_product` WHERE `autor_name` = '$name' ORDER BY $settings_search");
      $count_num = $result_count->fetch_assoc();
      $count = $count_num['COUNT(*)']; // Количество записей
  
      if($page <= 0){
        header('Location: ?page=1');
      }
  
      $OFFSET = $page * 5 - 5; //С какой записи выводить
      $product = $mysql->query("SELECT * FROM `shop_product` WHERE `autor_name` = '$name' ORDER BY $settings_search limit 5 OFFSET $OFFSET");
  
      $num_page = ceil($count / 5); //Количество страниц
    /*      <?php echo();?>      */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Мої оголошення - портал пасічників</title>
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
        <script>
            let photo = false;
        </script>
    </head>
    <body onload="var input = document.getElementById('search'); input.addEventListener('keyup', function(event) {if (event.keyCode === 13) {event.preventDefault();document.getElementById('go_search').click();}});">
        
    <?php include '../../service/contextmenu.php'; include '../backmwnu.php';?>
            
            <!-- Main section -->
            <div class="section" style="padding-left: 7%; min-height: 750px;">
                <!-- Container -->
                <div class="container">
        
                    <!-- Account Layout -->
                    <div class="columns account-header">
                        <div class="column is-10 is-offset-1 is-tablet-landscape-padded">
                            <!-- Title -->
                            <div class="account-title">
                                <h2>Створенні оголошення</h2>
                                <img class="brand-filigrane" src="https://img.icons8.com/fluent/48/000000/shopping-bag.png" style="opacity: 0.1;">
                            </div>
        
                            <!-- Account tabs -->
                            <div class="tabs account-tabs">
                                <ul>
                                    <li><a href="../profile/">Профайл</a></li>
                                    <li class="is-active"><a>Мої оголошення</a></li>
                                    <li><a href="../liked/">Кошик</a></li>
                                    <li><a href="../orders/">Замовлення</a></li>
                                </ul>
                            </div>

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
                                        $look = Array();
                                        
                                        while($result = $product->fetch_assoc()){
                                            $id_product[] = $result['id'];
                                            $photo[] = $result['photo'];
                                            $name[] = $result['name'];
                                            $city[] = $result['city'];
                                            $price[] = $result['price'];
                                            $Create_Date[] = $result['Create_Date'];
                                            $look[] = $result['look'];
                                        }
        
                                        $num_prod = 0;
        
                                        if(count($photo) == count($name) && count($city) != 0 && count($name) != 0 ){
                                            while($num_prod <= (count($name) - 1)){
                                                echo("
                                                <li id='block_".$id_product[$num_prod]."' class='flat-card is-auto is-list-item'>
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
                                                        Переглядів:<br/>
                                                        <a style='justify-content: left;'>".$look[$num_prod]."</a>
                                                        <span class='view-more'>
                                                            <a class='add-review modal-trigger button upper-button rounded is-bold raised' data-modal='review-modal' onclick='document.getElementById(`del_buttom`).setAttribute(`onclick`,`DELETE(".$id_product[$num_prod].")`);' style='background-color: #FF564E; color: #fff; padding: 15px; border-radius: 2px; margin-right: 5px;'>Видалити <i data-feather='trash'></i></a>
                                                            <a class='button upper-button rounded is-bold raised' href='/shop/product/?id=".$id_product[$num_prod]."' style='padding: 15px; border-radius: 2px;'>Детальніше <i data-feather='chevron-right'></i></a>
                                                        </span>
                                                    </span>
                                                </li>
                                                ");
                                                $num_prod = $num_prod + 1;
                                            }
                                        }else{
                                            echo("
                                                <div class='columns is-account-grid is-multiline'>
                                                    <div class='column is-12'>
                                                        <div class='flat-card is-auto empty-cart-card'>
                                                            <div class='empty-cart has-text-centered'>
                                                                <h3>Немає жодного оголошення 😥</h3>
                                                                <img src='https://img.icons8.com/cotton/512/000000/create-new--v4.png'/>
                                                                <a href='../new/' class='button big-button rounded'>Створити оголошення</a>
                                                                <small>Настав час продавати та заробляти!</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ");
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
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
                                        <a class='page-link' onclick='document.location.href = `../my/?page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                                        </li>
                                    ");
                                    }else{
                                        echo("
                                        <li class='page-item' style='cursor: pointer;'>
                                        <a class='page-link' onclick='document.location.href = `../my/?page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                                        </li>
                                    ");
                                    }

                                    $start_page = $page;
                                    $end_page = $start_page + 3;
                                    $progress = true;

                                    if($page != 1){
                                        echo("
                                        <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../my/?page=".($start_page - 1)."`;'>".($start_page - 1)."</a></li>
                                        ");
                                    }

                                    while ($start_page < $end_page && $start_page <= $num_page) {
                                        if($start_page == $page){
                                        echo("
                                            <li class='page-item active' style='z-index: 0;'><a class='page-link'>".$start_page."</a></li>
                                        ");
                                        }else{
                                        echo("
                                            <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../my/?page=".$start_page."`;'>".$start_page."</a></li>
                                        ");
                                        }
                                        $start_page = $start_page + 1;
                                    }

                                    if ($num_page > 1 && $page > 0 && $num_page != $page) {
                                        $back = "../my/";
                                    echo("
                                        <li class='page-item' style='cursor: pointer;'>
                                            <a class='page-link' onclick='document.location.href = `../my/?page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                                        </li>
                                    ");
                                    }else{
                                        $back = "../my/";
                                        echo("
                                        <li class='page-item disabled'>
                                            <a class='page-link' onclick='document.location.href = `../my/?page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                                        </li>
                                        ");
                                    }                     
                                    }

                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /Container -->
            </div>

            <footer class="footer">
                <div class="row">
                    <img src="../../assets/img/shopping-bag.png" style="width: 100px;">
                    <h5>Сервіс оголошень - Beekeeper portal</h5>
                    <p>Unesell Studio @2021</p>
                </div>
            </footer>

        </div>
        <!-- /Main wrapper -->
        <!-- Modal -->
        <div id="review-modal" class="modal review-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <i data-feather='trash'></i>
                        <span>Видалення.</span>
                        <div class="modal-delete"><i data-feather="x"></i></div>
                    </div>
                    <div class="box-body">   
                        <div class="control">
                            <span>Ви дійсно хочете видалити це оголошення?</span>
                            <div class="textarea-button" style="margin-top: 15px; float: right; margin-bottom: 20px;">
                                <button class="button button raised" style="font-family: Unecoin;"><div class="modal-delete" id="modal-delete">Ні. Відмінити.</div></button>
                                <button id="del_buttom" class="button danger-button raised" onclick="DELETE(id);" style="font-family: Unecoin; background-color: #FF564E; color: #fff;">Так, видалити.</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id='note_box' class="alert alert-success alert-dismissible fade show" role="alert" style='border-radius: 10px; background-color: aqua; z-index: 100000; display: none; position: fixed; width: 350px; min-height: 55px; right: 22px; bottom: 10px; text-align: left; border: 1px solid black;'>
            <p id='note_message' style='color: rgb(0, 0, 0); padding: 10px; padding-left: 10px; margin: 3px; font-weight: bold;  text-shadow: 1px 1px 1px #FFFFFF; filter: dropshadow(color=#FFFFFF, offx=1, offy=1);'></p>
          </div>
        <script>
            function DELETE(id){
                $.ajax({
                    url: 'del.php',
                    type: 'POST',
                    data:{id: id},
                    success: function(data) {
                        document.getElementById("block_" + id).remove();
                        $("#note_box").fadeOut(0);
                        throw_message("Оголошення видалено.");
                        document.getElementById("modal-delete").click();
                    }
                });
            }
            function throw_message(str) {
                $('#note_message').html(str);
                $("#note_box").fadeIn(500).delay(3000).fadeOut(500);
            }
        </script>
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>
        </body>  
</html>
