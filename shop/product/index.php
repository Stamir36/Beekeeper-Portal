<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'shop', time() + 3600 * 24, "/");

    include "../../service/config.php";

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }else{
        header("Location: /shop/");
    }
    $query_p = $mysql->query("SELECT * FROM `shop_product` WHERE `id` = '$id'");
    $product = $query_p->fetch_assoc();

    $new_look = (int)$product['look'] + 1;
    if((int)htmlspecialchars($_COOKIE["last_view"]) != (int)$id){
        $mysql->query("UPDATE `shop_product` SET `look` = '$new_look' WHERE `shop_product`.`id` = $id");
        setcookie('last_view', $id, time() + 3600 * 24, "/");
    }

    if(strlen(htmlspecialchars($_COOKIE["curs_rub"])) > 0 && strlen(htmlspecialchars($_COOKIE["curs_usd"])) > 0){
        $curs_rub = htmlspecialchars($_COOKIE["curs_rub"]);
        $curs_usd = htmlspecialchars($_COOKIE["curs_usd"]);
    }else{
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".date("d/m/Y"));
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        
        $result = curl_exec($ch);
        
        $xml = $result;
        $xml_obj = new SimpleXMLElement($xml);
        
        $xml = $xml_obj->xpath("//Valute[@ID='R01720']"); 
        $curs_rub = strval($xml[0]->Value) / strval($xml[0]->Nominal);  // получим курс руб
        $xml2 = $xml_obj->xpath("//Valute[@ID='R01235']"); 
        $curs_usd_rub = strval($xml2[0]->Value); // получим курс доллара
        $curs_usd = $curs_rub / $curs_usd_rub;
        setcookie('curs_rub', $curs_rub, time() + 3600 * 24, "/");
        setcookie('curs_usd', $curs_usd, time() + 3600 * 24, "/");
    }
    if($premium == "yes" && $product['category'] == "Онлайн метаріали"){
        $product['price'] = $product['price'] - ($product['price'] * 0.4);
    }
?>
<!DOCTYPE html>
<html lang="ua">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Продукт: <? echo($product['name']); ?> - портал пасічників</title>
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
    
            <!-- Left product panel -->
            <div class="product-panel">
                <!-- Left Header -->
                <style>
                    @media (min-width: 991px){
                        .yes_mobile{
                            display: none;
                        }
                    }
                    @media (max-width: 991px){
                        .yes_mobile{
                            display: inline;
                        }
                    }
                </style>
                <br class="yes_mobile"/>
                <div class='panel-header'>
                <?php             
                    if(strlen($cook_id) > 0){
                    echo(" 
                            <div id='liked_block' class='likes button buy-button upper-button rounded is-bold raised' style='background: #EF92C6;'>   
                                <span id='like' onclick='like()' style='font-size: 14px; color: #fff;'>Зберегти в кошик 💛</span>
                            </div>
                    ");
                    }
                    echo("</div>");
                    $like_sql = $mysql->query("SELECT * FROM `liked_shop` where `product_id` = $id AND `user_liked` = '$cook_id'");
                    $likes = $like_sql->fetch_assoc();
                    if(strlen($likes['product_id']) > 0){
                        echo("
                        <script>
                                document.getElementById('like').textContent = 'Видалити з кошика 💔';
                                document.getElementById('like').setAttribute('onclick','no_like()');
                                document.getElementById('liked_block').style.background = '#92BBEF';
                                document.getElementById('like').style.color = '#535353';
                        </script>
                        ");
                    }else{
                        echo("
                        <script>
                                document.getElementById('like').textContent = 'Зберегти в кошик 💛';
                                document.getElementById('like').setAttribute('onclick','like()');
                                document.getElementById('liked_block').style.background = '#EF92C6';
                                document.getElementById('like').style.color = '#fff';
                        </script>
                        ");
                    }
                ?>
                
                <script>
                    function like(){
                        $.ajax({
                        url: 'like.php',
                        type: 'POST',
                        data:{product_id: "<?php echo($id);?>", name_product: "<?php echo($product['name']); ?>", product_image: "<?php echo($product['photo']); ?>" , product_price: "<?php echo($product['price']); ?>"},
                        success: function(data) {
                            document.getElementById("like").textContent = "Видалити з кошика 💔";
                            document.getElementById("like").setAttribute('onclick','no_like()');
                            document.getElementById("liked_block").style.background = '#92BBEF';
                            document.getElementById("like").style.color = '#535353';
                            document.getElementById("all_price").textContent = Number(document.getElementById("all_price").textContent) + Number(<?php echo($product['price']); ?>);
                            var names = "<?php echo($product['name']); ?>";
                            var price_p = "<?php echo($product['price']); ?>";
                            var add_code = "<li class='clearfix' id='block_<?php echo($id);?>'><div style='width: 70px; justify-content: center; display: inline block; text-align: center;'><img src='/shop/catalog/image/<?php echo($product['photo']); ?>' alt='' style='cursor: pointer; float: initial;' onclick='document.location.href = `/shop/product/?id=<?php echo($id);?>`;' /></div><span class='item-meta' style='width: 150px; cursor: pointer;' onclick='document.location.href = `/shop/product/?id=<?php echo($id);?>`;'><span class='item-name' style='width: 150px;'>" + names + "</span><span class='item-price'>" + price_p + "₴</span></span><span class='remove-item'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x has-simple-popover' data-content='Видалити з кошика' data-placement='top' onclick='del_like(<?php echo($id);?>, <?php echo($product['price']); ?>);' data-target='webuiPopover0'><line x1='18' y1='6' x2='6' y2='18' onclick='del_like(<?php echo($id);?>, <?php echo($product['price']); ?>);'></line><line x1='6' y1='6' x2='18' y2='18' onclick='del_like(<?php echo($id);?>, <?php echo($product['price']); ?>);'></line></svg></span></li>";
                            document.getElementById("innerProduct").innerHTML = add_code;
                            document.getElementById("none_card").remove();
                            document.getElementById("total_sum_block").style.display = "";
                        }
                        });
                    }
                    function no_like(){
                        $.ajax({
                        url: 'no_like.php',
                        type: 'POST',
                        data:{product_id: "<?php echo($id);?>"},
                        success: function(data) {
                            document.getElementById('like').textContent = 'Зберегти в кошик 💛';
                            document.getElementById('like').setAttribute('onclick','like()');
                            document.getElementById('liked_block').style.background = '#EF92C6';
                            document.getElementById('like').style.color = '#fff';
                            del_like("<?php echo($id);?>", "<?php echo($product['price']); ?>");
                        }
                        });
                    }
                </script>
                <!-- Product image -->
                <div id="product-view" class="translateLeft" style="text-align: center; padding: 10% 2% 10% 2%; margin: 0;">
                    <img style="max-height: 600px;" src="../catalog/image/<?php echo($product['photo']); ?>" data-action="zoom" alt="">
                </div>
        
                <!-- Product details -->
                <div id="meta-view" class="translateLeft is-hidden">
                    <!-- Product description -->
                    <div class="detailed-description">
                        <div class="meta-block">
                            <h3>Назва</h3>
                            <p><?php echo($product['name']); ?></p>
                        </div>
                        <div class="meta-block">
                            <h3>Продавець</h3>
                            <p><?php $name_autor = $product['autor_name']; echo($name_autor); ?></p>
                        </div>
                        <!-- Product colors -->
                        <div class="meta-block">
                            <h3>Телефон</h3>
                            <p id="phone">+38₀⁰₀⁰₀⁰₀⁰₀⁰₀⁰</p>
                        </div>
                        <!-- Product long description -->
                        <div class="meta-block">
                            <h3 class="spaced">Детальніше про оголошення.</h3>
                            <p class="spaced"><?php echo($product['info']); ?></p>
                        </div>
                    </div>
                </div>
        
                <!-- Product Ratings -->
                <div id="ratings-view" class="translateLeft is-hidden">
                    <div class="product-ratings">
                        <div class="main-rating">
        
                            <!-- Average Rating -->
                            <h3>Автор оголошення</h3>
                            <div class="stars">
                                <h2><?php echo($product['autor_name']); ?></h2>
                            </div>
                            <span>Місто: <small><?php echo($product['city']); ?></small></span>
                            <?php
                            if(strlen($cook_id) > 0){
                                echo("
                                <span class='add-review modal-trigger button big-button buy-button upper-button rounded is-bold raised' data-modal='review-modal' style='margin-top: 10px;' id='send_Buttom'>Написати повідомлення.</span>       
                                ");
                                }
                            ?>
                        </div>
        
                        <!-- Customer reviews -->
                        <div class="customer-ratings">
                        
                            <div class="media">
                                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA5uc5_VAYbdr-ZgkGmr-tlr_iHr8MAmhQ&q=<?php echo($product['city']);?>" width="100%" height="360" style="pointer-events: none; border:0; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
        
                        </div>
                    </div>
                </div>
                <!-- /Product Ratings -->
        
                <!-- Product panel actions -->
                <div class="product-actions">
                    <!-- Zoom Action -->
                    <div class="zoom-buttons">
                        <h4>Переглядів: <?php echo($new_look); ?></h4>
                    </div>
                    <!-- Navigation icons -->
                    <div class="right-actions">
                        <!-- Product image panel -->
                        <span id="show-product" class="product-action is-active"><i data-feather="image"></i></span>
                        <!-- Product meta panel -->
                        <span id="show-meta" class="product-action"><i data-feather="menu"></i></span>
                        <!-- Product ratings panel -->
                        <span id="show-ratings" class="product-action"><i data-feather="message-circle"></i></span>
                    </div>
                </div>
            </div>
        
            <!-- Right product panel -->
            <div class="product-info-panel">
                <div class="inner-panel">
                    <div class="panel-header">
                        <div class="category-title" style="padding-left: 20px;">
                            <h2>Перегляд оголошення</h2>
                        </div>
                    </div>
                    <!-- Panel body -->
                    <div class="panel-body">
                        <!-- Product Meta -->
                        <h3 class="product-name"><?php echo($product['name']); ?><span></span></h3>
                        <p class="product-description"><?php echo($product['info']); ?></p>
        
                        <!-- Product controls -->
                        <div class="product-controls">
                            <!-- Price -->
                            <div class="product-price">
                                <div class="heading">Ціна</div>
                                <?php
                                    if($premium == "yes" && $product['category'] == "Онлайн метаріали"){
                                        echo("<div class='value has-simple-popover' style='color: #FF8300;' data-content='Знижка 40% для преміум<br>Курс: ≈ ".round($product['price'] * $curs_rub, 2)."₽ | ".round($product['price'] * $curs_usd, 2)."$' data-placement='top'>".$product['price']."<span style='font-size: 20px;'>₴</span></div>");
                                    }else{
                                        echo("<div class='value has-simple-popover' data-content='Курс: ≈ ".round($product['price'] * $curs_rub, 2)."₽ | ".round($product['price'] * $curs_usd, 2)."$' data-placement='top'>".$product['price']."<a style='font-size: 20px;'>₴</a></div>");
                                    }
                                ?>
                            </div>
                            <!-- Quantity -->
                            <div class="product-quantity">
                                <div style="text-align: right;">Телефон</div>
                                <div>
                                    <h1 style="font-size: 25px;" id="phone2">+38₀⁰₀⁰₀⁰₀⁰₀⁰₀⁰</h1>
                                </div>
                            </div>
                            <!-- Add to Cart -->
                            <div class="add-to-cart">
                                <div class="heading is-vhidden">Показати номер телефона</div>
                                <button onclick="visPhone()" class="button big-button primary-button upper-button rounded is-bold raised">Показати номер телефона</button>
                                <br class="yes_mobile"/><br class="yes_mobile"/>
                                <button class="button big-button buy-button upper-button rounded is-bold raised" onclick="document.location.href = '/shop/checkout/?prod=<?php echo($id);?>';">Замовити товар</button>
                                <script>
                                    function visPhone(){
                                        document.getElementById("phone").textContent = "<?php echo($product['phone']); ?>";
                                        document.getElementById("phone2").textContent = "<?php echo($product['phone']); ?>";
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Panel footer -->
                    <div class="panel-footer">
                        <div class="footer-inner">
                            <div class="recommended">Інщі товари</div>
                            <!-- Recommended items   style="overflow: scroll;" -->
                            <div class="columns has-text-centered">
                                
                                <div class="column"></div>

                                <?php
                                $product = $mysql->query("SELECT * FROM  (SELECT * FROM `shop_product` ORDER BY id DESC LIMIT 3) T1 ORDER BY RAND()");
                                $id_product = Array();
                                $photo = Array();
                                $name = Array();
                                $city = Array();
                                $price = Array();

                                while($result = $product->fetch_assoc()){
                                    $id_product[] = $result['id'];
                                    $photo[] = $result['photo'];
                                    $name[] = $result['name'];
                                    $price[] = $result['price'];
                                }

                                $num_prod = 0;

                                if(count($photo) == count($name) && count($price) != 0 && count($name) != 0 ){
                                    while($num_prod <= (count($name) - 1)){
                                        echo("
                                        <!-- Item -->
                                        <div class='column is-3'>
                                            <a href='?id=".$id_product[$num_prod]."'>
                                                <div class='featured-product'>
                                                    <div class='image' style='height: 100px; text-align: center; display: table-cell; vertical-align: middle;'>
                                                        <img src='../catalog/image/".$photo[$num_prod]."' style='max-height: 100px; width: auto;'>
                                                    </div>
                                                    <div class='product-info has-text-centered'>
                                                        <a><h3 class='product-name'>".$name[$num_prod]."</h3></a>
                                                        <p class='product-description' style='color: orange; font-size: 14px;'>".$price[$num_prod]."₴</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        ");
                                        $num_prod = $num_prod + 1;
                                    }
                                }else{
                                    echo("<a class='t_mobile' style='color: #322EFF; text-align: center; background-color: #fff; padding: 10px; border-radius: 4px;'>Ще немає рекомендацій. 💫</a>");
                                }

                                ?>
                                
                                <div class="column"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Panel footer -->
                </div>
            </div>
            <!-- /Right product panel -->
        </div>
        <!-- /Main wrapper -->
        <div id='note_box' class="alert alert-success alert-dismissible fade show" role="alert" style='border-radius: 15px; background-color: rgb(132, 200, 255); z-index: 100000; display: none; position: fixed; width: 350px; min-height: 55px; right: 22px; bottom: 10px; text-align: left; border: 1px solid black;'>
            <p id='note_message' style='color: rgb(0, 0, 0); margin: 10px; font-weight: bold;  text-shadow: 1px 1px 1px #FFFFFF; filter: dropshadow(color=#FFFFFF, offx=1, offy=1);'></p>
        </div>
        <!-- Modal -->
        <div id="review-modal" class="modal review-modal">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <span>Зв'язщок з автором</span>
                        <div class="modal-delete" id="close_modal"><i data-feather="x"></i></div>
                    </div>
                    <div class="box-body">   
                        <div class="control">
                            <textarea class="textarea is-button" placeholder="Повідомлення" style="font-family: Unecoin; color:black; " id="mess_autore"></textarea>
                            <div class="textarea-button"> 
                                <button class="button primary-button raised" style="font-family: Unecoin;" onclick="send_mess_prod();">Відправити</button>
                                <script>
                                    function throw_message(str) {
                                        $('#note_message').html(str);
                                        $("#note_box").fadeIn(500).delay(3000).fadeOut(500);
                                    }
                                    function send_mess_prod(){
                                        var text_box = document.getElementById("mess_autore").value;
                                        $.ajax({
                                                url: 'send_mess.php',
                                                type: 'POST',
                                                data:{id_product: "<?php echo($id);?>", text: text_box, autor: "<?php echo($user['name']);?>", p_autor: "<?php echo($name_autor); ?>"},
                                                success: function(data) {
                                                    $("#note_box").fadeOut(0);
                                                    throw_message("Повідомлення відправлено.");
                                                    document.getElementById("close_modal").click();
                                                    document.getElementById("send_Buttom").setAttribute('onclick','no_mess()');
                                                    document.getElementById("send_Buttom").setAttribute('data-modal','');
                                                    document.getElementById("send_Buttom").textContent = "Подівомлення відправлено";
                                                },
                                                error: function(data){
                                                    $("#note_box").fadeOut(0);
                                                    throw_message("Помилка.");
                                                    document.getElementById("close_modal").click();
                                                }
                                         });
                                    }
                                    function no_mess(){
                                        $("#note_box").fadeOut(0);
                                        throw_message("Ви вже написали повідомлення.");
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>    </body>  
</html>
