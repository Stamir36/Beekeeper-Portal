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
    }else{
        header('Location: /login/');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title> Нове оголошення - портал пасічників</title>
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
        <link rel="stylesheet" href="style.css">
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
            
            <section class="py-5">
                <div class="container" style="margin-top: 20px;">
                    <p class="subtitle text-primary">Нове оголошення</p>
                    <h1 class="h2 mb-1"> Основна інфорація </h1>
                    <form action="new.php" method="post" enctype="multipart/form-data" id="FormID">
                    <div class="row form-block">
                        <div class="col-lg-4">
                        <h4>Основне</h4>
                        <p class="text-muted text-sm">Вкажіть назву вашого оголошення. Так само, виберіть категорію, до якого відноситься ваш товар. За бажанням, ви можете прорекламувати ваше оголошення.<br><br>За правилами сервісу "Онлайн матеріали" для преміум користувачів дешевше на 40%.</p>
                        </div>
                        <div class="col-lg-7 ml-auto">
                        <div class="form-group"></div>
                        <div class="form-group">
                            <label for="form_name" class="form-label">Назва оголошення</label>
                            <input style="font-family: Unecoin;" name="name" id="form_name" class="form-control" onclick="document.getElementById('error_name').style = 'display: none;';">
                            <label id="error_name" style="display: none;" for="form_street" class="form-label"><a id="error_name_text" style="color: red;"></a></label>
                        </div>
                        <div class="form-group">
                            <label for="form_name" class="form-label">Ціна товару</label>
                            <input id="form_price" onchange="price_update()" style="font-family: Unecoin; color: #9043FF;" name="price" class="form-control"  onclick="document.getElementById('error_price').style = 'display: none;';">
                            <label id="error_price" style="display: none;" for="form_street" class="form-label"><a id="error_price_text" style="color: red;"></a></label>
                            <label id="price_premium" style="display: none;" for="form_street" class="form-label"><a id="error_price_text" style="color: rgb(112, 112, 112); cursor:default;">Ціна для преміум користувачів: <a style="color: orange;" id="premium_price">0.00 <a style="color: orange; font-size: 10px;"> грн</a></a></a></label>
                            <script>
                                function price_update(){
                                    if(document.getElementById('category_select').value == "Онлайн метаріали"){
                                        document.getElementById('price_premium').style.display = "";
                                        var price = Number(document.getElementById('form_price').value);
                                        price = price - (price * 0.4);
                                        document.getElementById('premium_price').textContent = price;
                                    }else{
                                        document.getElementById('price_premium').style.display = "none";
                                    }
                                }
                            </script>
                        </div>
                        <div class="form-group">
                                <label for="exampleFormControlSelect1" class="form-label">Виберіть категорію</label>
                                <select onchange="price_update()" id="category_select" class="form-control" name="category" style="font-family: Unecoin;">
                                    <option>Для дому</option>
                                    <option>Пасіка</option>
                                    <option>Онлайн метаріали</option>
                                    <option>Робота</option>
                                    <option>Інше</option>
                                </select>
                                </div>

                        <div class="form-group" <?php if(strlen($cook_id) > 0 && $premium != "yes"){ echo("style='opacity: 0.5; cursor: not-allowed;' "); } ?>>
                            <label class="form-label">Вивести оголошення в <a style="background-color: rgb(255, 236, 211); border-radius: 2px; padding: 2px;">топ?</a></label>
                            <br><a class="form-label" style="font-size: 14px; color: rgb(165, 165, 138);" <?php if(strlen($cook_id) > 0 && $premium != "yes"){ echo("style='opacity: 1; cursor: not-allowed;' "); } ?>>Тільки преміум</a>
                            <div class="custom-control custom-radio">
                            <input type="radio" id="guests_0" name="premium" class="custom-control-input" value="yes" <?php if(strlen($cook_id) > 0 && $premium != "yes"){ echo("disabled='disabled'"); } ?>>
                            <label for="guests_0" class="custom-control-label">Так, показувати на головній.</label>
                            </div>
                            <div class="custom-control custom-radio">
                            <input type="radio" id="no_radio" id="guests_1" name="premium" value="no" class="custom-control-input" <?php if(strlen($cook_id) > 0 && $premium != "yes"){ echo("disabled='disabled'"); } ?>>
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
                        <h4>Зміст оголошення</h4>
                        <p class="text-muted text-sm">Будь ласка, напишіть опис вашого товару, щоб користувачі знали повні характеристики. Так само додайте зображення. Не забувайте про правила написання повідомлень в системі.</p>
                        </div>
                        <div class="col-lg-7 ml-auto">
                        <!-- Text wiki -->
                        <div class="form-group">
                            <label for="form_street" class="form-label">Опис оголошення</label>
                            <textarea name="content" id="content" placeholder="Почніть писати опис товару..." class="form-control" style="min-height: 300px; font-family: Unecoin;" onclick="document.getElementById('error_content').style = 'display: none;';"></textarea>
                            <label id="error_content" style="display: none;" for="form_street" class="form-label"><a id="error_content_text" style="color: red;"></a></label>
                        </div>
                        </div>
                    </div>


                    <div class="row form-block">
                        <div class="col-lg-4">
                            <style>
                                
                            </style>
                            <h4>Обкладинка.</h4>
                            <div class="image" id="imeges_block" for='pct'>
                                <div class="block_img">
                                    <img id="image_blocks" data-action="zoom" unselectable="on">
                                </div>
                            </div>
                            <label id="fname_block" style="display: none;" for="form_street" class="form-label">Файл: <a id="files_name" style="color: red; cursor: default;">Files.png</a> </label>
                            </div>
                            <script>
                            </script>
                        <div class="col-lg-7 ml-auto">
                        <!-- Text wiki -->
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
                            .img_block {
                                max-width: none;
                                height: 300px;
                            }
                            .image{
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
                            #image_blocks{
                                object-fit: cover; max-height: 300px; width: auto;
                                margin: 0;
                            }
                            .block_img{
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                margin-right: -50%;
                                transform: translate(-50%, -50%);
                            }
                        </style>
                        <div class="form-group">
                        <p class="text-muted text-sm">Завантажуйте тільки якісне фото свого товару. Якщо ваше фото буде помилковим або не чітким, ваше оголошення може стати неактивним.</p>
                            <label for="form_street" class="form-label">Обкладинка оголошення</label> <br>
                            <input style="display: none;" onchange="getFiles(this.files)" type="file" id="photo_butt" name="uploadfile" class="btn btn-warning px-3" name="photo" multiple accept="image/*,image/jpeg, image/gif">
                            <a style="cursor: pointer;" onclick="upload_files();" class="btn btn-warning px-3"> Вибрати картинку </a> <br class="yes_mobile"/> <br class="yes_mobile"/>
                            <a onclick="resetFile();" id="form_photo_close" class="btn btn-danger px-3" style="cursor: pointer; color: #fff; display: none;"> Видалити </a>
                            <br><label id="error_photo" style="display: none;" for="form_street" class="form-label"><a id="files_error" style="color: red; cursor: default;">Ви не виблали зображення.</a></label>
                            <script>
                                function getFiles(files){
                                    if(files[0].size <= 2000000){
                                        photo = true;
                                        document.getElementById("error_photo").style = "display: none;";
                                        document.getElementById('files_name').textContent = files[0].name;
                                        document.getElementById('fname_block').style = "display: inline;";
                                        document.getElementById("form_photo_close").style = "cursor: pointer; color: #fff; display: inline;";
                                        
                                        var fr = new FileReader();
                                        fr.addEventListener("load", function () {
                                            //document.getElementById("imeges_block").style.backgroundImage = "url(" + fr.result + ")";
                                            document.getElementById("image_blocks").src = fr.result;
                                        }, false);

                                        fr.readAsDataURL(files[0]);
                                    }else{
                                        document.getElementById("error_photo").style = "display: inline;";
                                        document.getElementById("files_error").textContent = "Зображення бішьше ніж 2 Мб. Зменьшіть розмір.";
                                    }
                                    
                                }
                                function resetFile(){
                                    photo = false;
                                    document.getElementById('photo_butt').value = "";
                                    document.getElementById("error_photo").style = "display: none;";
                                    document.getElementById('fname_block').style = "display: none;";
                                    document.getElementById("image_blocks").src = "";
                                    document.getElementById("form_photo_close").style = "cursor: pointer; color: #fff; display: none;";
                                }
                                function upload_files(){
                                    document.getElementById('photo_butt').click();
                                }
                            </script>
                        </div>
                        </div>
                    </div>


                    <div class="row form-block">
                        <div class="col-lg-4">
                        <h4>Персональні дані</h4>
                        <p class="text-muted text-sm">Будь ласка, вкажіть назву міста, в якому ви живете та номер свого телефону.</p>
                        </div>
                        <div class="col-lg-7 ml-auto">
                        <!-- Text wiki -->
                        <div class="form-group">
                            <label for="form_street" class="form-label">Номер телефону:</label>
                            <input style="font-family: Unecoin;" name="phone" id="form_phone" class="form-control" value="" onclick="document.getElementById('error_phone').style = 'display: none;';">
                            <label id="error_phone" style="display: none;" for="form_street" class="form-label"><a id="error_phone_text" style="color: red;"></a></label>
                        </div>
                        <div class="form-group">
                            <label for="form_street" class="form-label">Введіть місто:</label>
                            <input style="font-family: Unecoin;" name="city" id="form_city" class="form-control" value=""><br>
                            <a class="btn btn-info px-3" style="cursor: pointer; color: #fff;" onclick="locations();">Визначити автоматично.</a>
                            <script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
                            <script>
                                function locations(){
                                    if(ymaps.geolocation.city != undefined){
                                        document.getElementById("form_city").value = ymaps.geolocation.city;
                                    }else{
                                        document.getElementById("form_city").value = ymaps.geolocation.region + ", " + ymaps.geolocation.country;
                                    }
                                }
                            </script>
                        </div>
                        </div>
                    </div>

                    <div class="row form-block flex-column flex-sm-row">
                        <div class="col text-center text-sm-left">
                        </div>
                        <div class="col text-center text-sm-right">
                            <a class="btn btn-danger px-3" style="cursor: pointer; color: #fff;" onclick="document.location.href = '../'";>Скасувати</a>
                            <a class="btn btn-primary px-3" style="cursor: pointer; color: #fff;" onclick="create();">Опублікувати <i class="fa-chevron-right fa ml-2"></i></a>
                        </div>
                    </div>
                    <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
                    <script>
                        function create(){
                            let name = false;
                            let price = false;
                            let content = false;
                            let phone = false;
                            let city = false;

                            if(document.getElementById("form_name").value.length > 4){
                                if(Censorship(document.getElementById("form_name").value)){
                                    document.getElementById("error_name").style = "display: inline;";
                                    document.getElementById("error_name_text").textContent = "Вибачте, але ваш текст містить слова, які забороненно вживати в системі!";
                                    name = false;
                                }else{
                                    name = true;
                                }
                            }else{
                                document.getElementById("error_name").style = "display: inline;";
                                document.getElementById("error_name_text").textContent = "Ваш текст дуже меленький. Напишіть більше слів.";
                                name = false;
                            }// ------------------------------------------------------------------------------------------------------------------------------

                            if(document.getElementById("form_price").value.length > 0){
                                if(Censorship(document.getElementById("form_price").value)){
                                    document.getElementById("error_price").style = "display: inline;";
                                    document.getElementById("error_price_text").textContent = "Треба вказати ціну!";
                                    price = false;
                                }else{
                                    price = true;
                                }
                            }else{
                                document.getElementById("error_price").style = "display: inline;";
                                document.getElementById("error_price_text").textContent = "Будь ласка, вкажіть ціну товару.";
                                price = false;
                            }// ------------------------------------------------------------------------------------------------------------------------------
                            if(document.getElementById("content").value.length >= 4){
                                if(Censorship(document.getElementById("content").value)){
                                    document.getElementById("error_content").style = "display: inline;";
                                    document.getElementById("error_content_text").textContent = "Вибачте, але ваш опис містить слова, які забороненно вживати в системі!";
                                    content = false;
                                }else{
                                    content = true;
                                }
                            }else{
                                document.getElementById("error_content").style = "display: inline;";
                                document.getElementById("error_content_text").textContent = "Опис занадто короткий.";
                                content = false;
                            } // ------------------------------------------------------------------------------------------------------------------------------
                            if(document.getElementById("form_phone").value.length > 8){
                                if(Censorship(document.getElementById("form_phone").value)){
                                    document.getElementById("error_phone").style = "display: inline;";
                                    document.getElementById("error_phone_text").textContent = "Вибачте, але це не номер телефону. Ганьба.";
                                    phone = false;
                                }else{
                                    phone = true;
                                }
                            }else{
                                document.getElementById("error_phone").style = "display: inline;";
                                document.getElementById("error_phone_text").textContent = "Номер занадто короткий.";
                                phone = false;
                            }// ------------------------------------------------------------------------------------------------------------------------------
                            if(document.getElementById("form_city").value.length > 3){
                                if(Censorship(document.getElementById("form_city").value)){
                                    document.getElementById("form_city").value = ymaps.geolocation.region + ", " + ymaps.geolocation.country;
                                    city = true;
                                }else{
                                    city = true;
                                }
                            }else{
                                document.getElementById("form_city").value = ymaps.geolocation.region + ", " + ymaps.geolocation.country;
                                city = true;
                            }// ------------------------------------------------------------------------------------------------------------------------------
                            

                            if(photo == false){
                                document.getElementById("error_photo").style = "display: inline;";
                                document.getElementById("files_error").textContent = "Ви не виблали зображення.";
                            }

                            if(photo == true && name == true && price == true && content == true && phone == true && city == true){
                                var form = document.getElementById("FormID");
                                form.submit();
                            }else{
                                //alert("Not good! Info: " + "photo = " + photo + " | name = " + name + " | price = " + price + " | content = " + content + " | phone = " + phone + " | city = " + city);
                            }
                        }
                    </script>

                    </form>
                </div>
            </section>
            <footer class="footer">
                    <div class="row">
                        <img src="../../assets/img/shopping-bag.png" style="width: 100px;">
                        <h5>Сервіс оголошень - Beekeeper portal</h5>
                        <p>Unesell Studio @2021</p>
                    </div>
                    
                </footer>

        </div>
        <!-- /Main wrapper -->
        <!-- Concatenated plugins -->
        <script src="../assets/js/app.js"></script>
        <!-- Helios js -->
        <script src="../assets/js/nephos.js"></script>
        </body>  
</html>
