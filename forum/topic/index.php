<?php
    //Loader data
    $cook_id = htmlspecialchars($_COOKIE["id"]);
    setcookie('site_page', 'forum', time() + 3600 * 24, "/");

    include "../../service/config.php";

    if(strlen(htmlspecialchars($_COOKIE["id"])) <= 0){
      $cook_id = "";
      $forum_rating_mess = false;
    }

    $mysql = new mysqli($Host, $User, $Password, $Database);

    $result = $mysql->query("SELECT * FROM `accounts_users` WHERE `id` = '$cook_id'");
    $user = $result->fetch_assoc();

    //Из базы данных: $user['name'];
    $name = $user['name'];
    $avatar = $user['avatar'];
    $premium = $user['premium'];

    if(isset($_GET["id"])){
      $id = $_GET["id"];
    }
    if(isset($_GET["page"])){
      $page = $_GET["page"];
    }

    $mess_result = $mysql->query("SELECT * FROM `forum_main_mess` WHERE `id` = '$id'");
    $main_mess = $mess_result->fetch_assoc();

    $result_count = $mysql->query("SELECT COUNT(*) FROM `forum_sub_mess` WHERE id_main_mess = '$id'");
    $count_num = $result_count->fetch_assoc();
    $count = $count_num['COUNT(*)']; // Количество записей

    if($page <= 0){
      header('Location: ?id='.$id.'&page=1');
    }

    if($id <= 0){
      header('Location: ../');
    }

    $OFFSET = $page * 10 - 10; //С какой записи выводить
    $theme = $mysql->query("SELECT * FROM `forum_sub_mess` WHERE id_main_mess = '$id' ORDER BY Date_Create ASC limit 10 OFFSET $OFFSET");

    $num_page = ceil($count / 10); //Количество страниц

    $sub_id = Array();
    $names_add = Array();
    $texts = Array();
    $datas = Array();
    $autors = Array();
    $rating = Array();
                              
    while($results = $theme->fetch_assoc()){
      $sub_id[] = $results['id'];
      $names_add[] = $results['author_id'];
      $texts[] = $results['body'];
      $datas[] = $results['Date_Create'];
      $autors[] = $results['author'];
      $rating[] = $results['rating'];
    }

    $like_sql = $mysql->query("SELECT id FROM `liked_forum` where `href` = $id AND `autor_liked_id` = '$cook_id'");
    $likes = $like_sql->fetch_assoc();
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/sidebar.css">
        <link rel="stylesheet" href="../assets/css/logic.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="style.css">
        <title><?php echo($main_mess['header']);?> - Форум. Обговорення теми.</title>
        <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/comment-discussion.png" type="image/png">
      </head>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../" style="color: #2344FF; font-weight: 600;"><img src="https://img.icons8.com/fluent/48/000000/comment-discussion.png" style="width: 30px; height: 30px;"/>   Форум</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="../../">Головна сторінка <span class="sr-only">(current)</span></a>
                </li>
              </ul>

              
              <form class='form-inline my-2 my-lg-0'>

              <li class="nav-item dropdown notification-dropdown" style="list-style-type: none;">

                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                    </a>
                    <div style="padding: 15px;" class="dropdown-menu position-absolute e-animated e-fadeInUp" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll" style="width: 250px;">
                            
                            <?php
                                $notifi = $mysql->query("SELECT * FROM `notifications` WHERE `user_id` = '$cook_id'");
                                $mess = Array();
                                $href = Array();
                                $data = Array();
                                while($result = $notifi->fetch_assoc()){
                                    $mess[] = $result['text'];
                                    $href[] = $result['href'];
                                    $data[] = $result['data'];
                                }

                                $num_notifi = 0;

                                
                                if(count($mess) == count($href) && count($mess) != 0 && count($href) != 0 ){
                                    echo("<a style='color: #2E90FF; font-size: 14px;' id='text_notifi'>Уведомления:</a>");
                                    echo("<div style='overflow: auto; max-height: 300px; padding-top: 5px;' id='notifi_clear'>");
                                    while($num_notifi <= (count($mess) - 1)){
                                        echo("
                                        <hr />
                                        <div>
                                            <a href='".$href[$num_notifi]."'>
                                                <div class='media'>
                                                <img src='https://img.icons8.com/fluent/48/000000/filled-chat.png'  width='30' height='25' style='padding-right: 5px;'/>
                                                    <div class='media-body'>
                                                        <div class='notification-para'>".$mess[$num_notifi]."</div>
                                                        <div class='notification-meta-time'>".date("d.m.Y", strtotime($data[$num_notifi]))."</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <hr />

                                        ");
                                        $num_notifi = $num_notifi + 1;
                                    }
                                    echo("</div>");
                                    echo("<a onclick='dell_notifi()' class='btn btn-primary btn-block mb-4 mr-2' style='position: relative; bottom: -20px;' id='notifi_clear2'>Очистить всё</a>");
                                }else{
                                    echo("<a style='color: #322EFF; text-align: center;'>Повідомлень немає</a>");
                                }
                            ?>
                        </div>
                    </div>
                </li>

                <script>
                    function dell_notifi(){
                        $.ajax({
                            url: '../clear_notifi.php',
                            type: 'POST',
                            data:{id: <?php echo($cook_id); ?> },
                            success: function(data) {
                                clears_notifi();
                            }
                        });
                    }
                    function clears_notifi(){
                        var texts = document.getElementById("text_notifi");
                        texts.textContent = "Уведомлений нет";
                        texts.style = "color: #322EFF; text-align: center;";
                        
                        var notifi_blocks = document.getElementById("notifi_clear");
                        notifi_blocks.style = "display: none;";
                        var notifi_blocks2 = document.getElementById("notifi_clear2");
                        notifi_blocks2.style = "display: none;";
                    }
                </script>
              
              
              <div class="names_user">
              
              <?php
                if(strlen($cook_id) > 0){ // ПОИСК АВТОРИЗАЦИИ
                  if($premium == "yes"){
                    echo("<span class='badge bg-warning text-dark'>Premium</span>");
                  }
                  echo("
                      <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$name."</a>
                      <img id='user_avatar' src='../../data/users/avatar/".$avatar."' class='round' width='40px' height='40px'>
                  ");
                }else{
                  echo("
                      <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px;'>Вход не выполнен</a>
                      <img id='user_avatar' src='../../data/users/avatar/default.png' class='round' width='40px' height='40px'>
                  ");
                }
              ?>
              </div>
              </form>

            </div>
          </nav>
    <div class="area" style="margin-top: 56px;">  
          <div class="wrapper">
            <article class="main" style="height: 100px;">
                <div class="firstcoll" style="height: 100px;">
                  <div style="height: 100px; padding: 15px;">
                    <h1 class="main_text" style="color: #fff; font-weight: 500;">Обговорення</h1>
                  </div>
              </div>
            </article>
            <aside class="aside aside-2"></aside>
          </div>

          <div class="games_card">

            <!-- Modal Support -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Скарга на пост</h4>
                  </div>
                  <div class="modal-body">
                    <p>Будь ласка, вкажіть причину скарги:</p>
                    <input type="text" style="width: 100%">
                    <br><br>
                    <p style="color: red; font-size: 10px; width: 80%;">* Якщо від вас будуть надходити хибні скарги, ваш акаунт може бути видалений.
                      <br>** Автор поста отримає повідомлення.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                    <button type="button" class="btn btn-warning" onclick="send_supp();">Відправити</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div style="padding-bottom: 0px;">
                <div class='block_mess'>
                  <div class="row">
                    <div class="autor" style="width: 300px;">
                      <?php
                      echo("
                        <div class='pc'>
                          <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$main_mess['author']."</a><br/>
                          <img id='user_avatar' src='../../data/users/avatar/".$main_mess['author_id'].".png' class='round' width='100px' height='100px'>
                        </div>
                        <div class='row mobile'>
                          <img id='user_avatar' src='../../data/users/avatar/".$main_mess['author_id'].".png' class='round' width='100px' height='100px'>
                          <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$main_mess['author']."</a><br/>
                        </div>
                      ");
                      ?>
                          <div style="padding-top: 15px;">
                            <?php
                            
                            //Rating
                            if($forum_rating_mess){
                              
                              $main_theme = $mysql->query("SELECT COUNT(*) FROM `rating_theme` WHERE `theme_id` = '$id' AND `account_id` = '$cook_id' AND `types` = 'forum_main_mess';");
                              $count_main = $main_theme->fetch_assoc();

                              if($count_main['COUNT(*)'] == '0'){
                                echo("
                                <a id='rating_".$id."' style='font-size: 22px; padding: 10px; display: none;'>".$main_mess['rating']."</a>
                                <a onclick='plus(".$id.", `forum_main_mess`);' id='plus_".$id."' class='btn btn-primary' role='button'>+</a>
                                <a onclick='minus(".$id.", `forum_main_mess`);' id='minus_".$id."' class='btn btn-primary' role='button'>-</a>
                              ");
                              }else{
                                echo("
                                <a id='rating_".$id."' class='btn' style='display: inline; cursor: default; font-size: 22px; padding: 5px; margin-right: 5px; margin-top: 5px; background-color: rgba(255, 221, 70, 0.45); border-radius: 10px;'>".$main_mess['rating']."</a>
                              ");
                              }

                            }

                            ?>
                            <a><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Скарга</button></a><br>
                            <?php
                              if(strlen($cook_id) > 0){
                                echo("
                                  <a id='like' style='margin-top: 10px' class='btn btn-danger' onclick='like();'' role='button'>♥ Слідкувати</a>
                                ");
                              }
                            ?>
                          </div>
                        <br>
                    </div>
                    <div class="message" style="padding-left: 5px;">
                      <h4 style="color: rgb(182, 118, 0);"><?php echo($main_mess['header']);?></h4>
                      <p><?php echo($main_mess['body']);?></p><hr />
                      <p style='font-size: 12px;'> <?php echo date("F j, Y, g:i a", strtotime($main_mess['Date_Create']));?> </p>
                    </div>
                  </div>
            </div>
            <hr/>
            <?php
              $num_theme = 0;
              if(count($names_add) == count($texts) && count($names_add) != 0 && count($texts) != 0 ){                             
                while($num_theme <= (count($names_add) - 1)){
                  echo("
                  <div style='padding-top: 20px;'>
                    <div class='block_mess'>
                      <div class='row'>
                        <div class='autor' style='width: 300px;'>
                            <div class='pc'>
                              <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$autors[$num_theme]."</a><br/>
                              <img id='user_avatar' src='../../data/users/avatar/".$names_add[$num_theme].".png' class='round' width='100px' height='100px'>
                            </div>
                            <div class='row mobile'>
                              <img id='user_avatar' src='../../data/users/avatar/".$names_add[$num_theme].".png' class='round' width='100px' height='100px'>
                              <a id='user' style='color: blueviolet; font-weight: 400; padding-right: 15px; padding-left: 10px;'>".$autors[$num_theme]."</a><br/>
                            </div>
                              <div style='padding-top: 15px;'>");
                              
                            if($forum_rating_mess){
                              
                              $main_theme = $mysql->query("SELECT COUNT(*) FROM `rating_theme` WHERE `theme_id` = '".$sub_id[$num_theme]."' AND `account_id` = '$cook_id' AND `types` = 'forum_sub_mess';");
                              $count_main = $main_theme->fetch_assoc();

                              if($count_main['COUNT(*)'] == '0'){
                                  echo("
                                  <a id='rating_".$sub_id[$num_theme]."' style='font-size: 22px; padding: 10px; display: none;'>".$rating[$num_theme]."</a>
                                  <a onclick='plus(".$sub_id[$num_theme].", `forum_sub_mess`);' id='plus_".$sub_id[$num_theme]."' class='btn btn-primary' role='button'>+</a>
                                  <a onclick='minus(".$sub_id[$num_theme].", `forum_sub_mess`);' id='minus_".$sub_id[$num_theme]."' class='btn btn-primary' role='button'>-</a>
                                ");
                                }else{
                                  echo("
                                  <a id='rating_".$sub_id[$num_theme]."' class='btn' style='display: inline; cursor: default; font-size: 22px; padding: 5px; margin-right: 5px; margin-top: 5px; background-color: rgba(255, 221, 70, 0.45); border-radius: 10px;'>".$rating[$num_theme]."</a>
                                ");
                                }

                              }
                                
                              echo("<a class='btn btn-primary' role='button'>Скарга</a>
                              </div>
                            <br>
                        </div>
                        <div class='message' style='padding-left: 5px;'>
                        <br>
                          <p>".$texts[$num_theme]."</p><hr />
                          <p style='font-size: 12px;'> ".date("F j, Y, g:i a", strtotime($datas[$num_theme]))." </p>
                        </div>
                      </div>
                </div>
                  ");
                  $num_theme = $num_theme + 1;
                }
              }                        
            ?>
                
                <nav style="padding-top: 15px; z-index: -10;">
                  <ul class="pagination">
                    
                    <?php
                    
                    if($num_page == 1){
                      echo("
                        <li class='page-item active' style='z-index: 0;'><a class='page-link'>1</a></li>
                        <li class='page-item disabled'>
                          <a class='page-link'>Наступна</a>
                        </li>
                      ");
                    }else{
                      if($page == 1){
                        $back = "../topic/";
                        echo("
                        <li class='page-item disabled'>
                          <a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                        </li>
                      ");
                      }else{
                        echo("
                        <li class='page-item' style='cursor: pointer;'>
                          <a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".($page - 1)."`;' tabindex='-1'>Попередня</a>
                        </li>
                      ");
                      }

                      $start_page = $page;
                      $end_page = $start_page + 3;
                      $progress = true;

                      if($page != 1){
                        echo("
                          <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".($start_page - 1)."`;'>".($start_page - 1)."</a></li>
                        ");
                      }

                      while ($start_page < $end_page && $start_page <= $num_page) {
                        if($start_page == $page){
                          echo("
                            <li class='page-item active' style='z-index: 0;'><a class='page-link'>".$start_page."</a></li>
                          ");
                        }else{
                          echo("
                            <li class='page-item' style='cursor: pointer; z-index: 0;'><a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".$start_page."`;'>".$start_page."</a></li>
                          ");
                        }
                        $start_page = $start_page + 1;
                      }

                      if ($num_page > 1 && $page > 0 && $num_page != $page) {
                        $back = "../topic/";
                      echo("
                        <li class='page-item' style='cursor: pointer;'>
                          <a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                        </li>
                      ");
                      }else{
                        $back = "../topic/";
                        echo("
                          <li class='page-item disabled'>
                            <a class='page-link' onclick='document.location.href = `../topic/?id=".$id."&page=".($page + 1)."`;' tabindex='-1'>Наступна</a>
                          </li>
                        ");
                      }                     
                    }

                    ?>
                  </ul>
                </nav>

                <br><br><br>
          </div>

          <?php             
            if(strlen($cook_id) > 0){
              echo("
                <div class='text_block'>
                <form action='new.post.php' method='POST' id='sends'>
                  <div class='row'>
                    <input name='theme_id' style='display: none;' type='text' value='".$id."'>
                    <input name='user_id' style='display: none;' type='text' value='".$cook_id."'>
                    <input name='user_name' style='display: none;' type='text' value='".$name."'>
                      <input type='comment' id='messag' name='messages' style='width: 80%;' placeholder='Ваше повідомлення...'>
                      <a onclick='send();' class='send' style='margin-left: 10px; cursor: pointer; '>
                        <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAEJ0lEQVRoge2YXW8UZRTHf+fZ7Xa32+72jWLQxBhviN5oqiVUQiEVNRIjSNZyw5UfwYQv4WfwHgliiAYvxLRU1CglxAtMjPENkATLUjrb7b50Zo4X7dJ2d2Z2ZutuMdn/5czzPOf8zvOfZ84MdNVVV/9ryW4n4CtVGb9mTcQcZlQ4ofDrwlT2zfph8d3ILUivzi69hInNMG/NAM/pRomNYLzGPxEAB+YLL6i67yvMAPtBG8a48KnX3F0DePnrpWfjcXMCyLnqvhZiyideFzv6DByYzT/jmvgpIAdMRoj/x/XDmecRadiatu/AxBVrhB49rsIZV5mmSdKuo1TLNsl0z+ZFlXNeyUObAA5982io6so7quRU9C0g7mHrBpWLaxQelhnel952XWKOp33gP7TQ+FcPs7FE7F1VcghvAImwc9VVlh+UWbWqDD+VJtm/pa7KL9ePZPf7zd3RDhz8TlN2tfC6GM2pckqhL2pJKqs2j+6XcByX1EDP9uQBEc4FzY8McGRWk0UpHBOjOWfNOonQryHsUa+tVQcwcUN2NNUwTsScD1onFEDuvMZ+31M4aAxnilingUwrSddUWbV59M8qjr25yOCeJCZWt30qP/0wNfBz0Fr+AKpmfK4waYzm/sQ6bWCs9ZTX5bqKtaXqNfUNJLafOjUZ1/fhrckTYGLOOqvz1oeYnSddU3nVZrmu6rBuncxo0nOOu0agfcAHQEXPAiMt5NmYhE/VaxoaSzVaZ10LN6YHf2u2vmeDpCIfAN4RI6hStlm8veKbfF8mQW+fn4sl8PSpyRNg4XDmksJJoBIq0zqpC1a+TP7vIo7teo6JxQyZEW/rAGrbzoUwsTwBABamspcV3iMiRLVks3inwMpSxaupfKzBvb7WQYRvb04P/RUmni8ARINQVax8mQf3ithr3lWvKdg64Pp0nl4KBIBwENWyzeKdlaZVB4gFnDobch0Tv9gsr5qaAoA/RK3q+btF7Gpw1WsaHEthTGC/MXvzUPpeqMUICQCNENWy87jqYV/K6WywdQBQDW0fiAAAmxBWvuTk766ErjpAvMeQGWnsdeq0JrYJbR9osZ1++uPb0TohgdF9/SRSsWbDLv84lT0eZelIO9Cq0plE0+Q3FMk+0AGAkNYBqDhV51LU9dsLIOunjoSIoqpf3jg2vBw1RFsB0tleEqmQ30xGItsH2ggQTxgyI71hh6+WnMoXrcRpD4BAdiyFSOhD7vNbR8dWWgnVKsC1oJv9gwmnNxn+c1u0NftAm/7MvXJ1+W2Bi0AYDxXiPZm9309KqZVYbbFQpC4WPms1eWjjQxwBomX7QJuP0RAQS6XRzJWdxGj7mzgQQuTCrRdlR9/eHemF/CGa//dppo4AgCfEYtrJXt3puh0DgA0IkRngvop8NHdU7E7G76qrrp5A/Qt6254Uf9sShQAAAABJRU5ErkJggg==' style='width: 40px; height: 40px;'/>
                      </a>
                  </div>
                </form>
              </div>
              ");
            }else{
              echo("
              <div class='text_block'>
                <a style='color: black; padding-top: 10px;'>Щоб написати повідомлення, увійдіть в аккаунт</a>
            </div>
              ");
            }
          ?>
            

            
          
          </div>
        </div>
    </div>

    <div id='note_box' class="alert alert-danger alert-dismissible fade show" role="alert" style='display: none; position: fixed; width: 350px; min-height: 55px; right: 12px; top: 80px; text-align: left; border: 1px solid black;'>
      <p id='note_message' style='color: rgb(0, 0, 0); margin: 3px; font-weight: bold;  text-shadow: 1px 1px 1px #FFFFFF; filter: dropshadow(color=#FFFFFF, offx=1, offy=1);'></p>
    </div>

    <script>
        function throw_message(str) {
            $('#note_message').html(str);
            $("#note_box").fadeIn(500).delay(3000).fadeOut(500);
        }
    </script>
    
    <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
    <script>
      function plus(id, type){
        var scores_new = Number(document.getElementById("rating_" + id).textContent) + 0.1;
        $.ajax({
          url: 'rating.php',
          type: 'POST',
          data:{id_mess: id, account: "<?php echo($cook_id);?>", score: 'plus', type: type, new: scores_new},
          success: function(data) {
            document.getElementById("rating_" + id).style = "display: inline; cursor: default; font-size: 22px; padding: 5px; margin-right: 5px; margin-top: 5px; background-color: rgba(255, 221, 70, 0.45); border-radius: 10px;";
            document.getElementById("rating_" + id).textContent = scores_new;
            document.getElementById("plus_" + id).style = "display: none;";
            document.getElementById("minus_" + id).style = "display: none;";
            $("#note_box").fadeOut(0);
            throw_message("Ви проголосували позитивно.");
          }
        });
      }

      function minus(id, type){
        var scores_new = Number(document.getElementById("rating_" + id).textContent) - 0.1;
        $.ajax({
          url: 'rating.php',
          type: 'POST',
          data:{id_mess: id, account: "<?php echo($cook_id);?>", score: 'minus', type: type, new: scores_new},
          success: function(data) {
            document.getElementById("rating_" + id).style = "display: inline; cursor: default; font-size: 22px; padding: 5px; margin-right: 5px; margin-top: 5px; background-color: rgba(255, 221, 70, 0.45); border-radius: 10px;";
            document.getElementById("rating_" + id).textContent = scores_new;
            document.getElementById("plus_" + id).style = "display: none;";
            document.getElementById("minus_" + id).style = "display: none;";
            $("#note_box").fadeOut(0);
            throw_message("Ви проголосували негативно.");
          }
        });
      }

      function send(){
          if(document.getElementById("messag").value.length > 2){
            if(Censorship(document.getElementById("messag").value)){
              $("#note_box").fadeOut(0);
              throw_message("Вибачте, але ваш тект містить слова, які забороненно вживати в системі!");
          }else{
            var form = document.getElementById("sends");
            form.submit();
          }
        }else{
          $("#note_box").fadeOut(0);
          throw_message("Вибачте, але ваш текст дуже маленький, напишіть більше.");
        }
      }

      function send_supp(){
        throw_message("Скарга відправлена.");
      }

      function like(){
        $.ajax({
          url: 'like.php',
          type: 'POST',
          data:{id: "<?php echo($id);?> ", header: "<?php echo($main_mess['header']);?>", autor: "<?php echo($cook_id);?>"},
          success: function(data) {
            document.getElementById("like").textContent = "Не слідкувати 💔";
            document.getElementById("like").setAttribute('onclick','no_like()');
            document.getElementById("like").setAttribute('class','btn btn-warning');
          }
        });
      }

      function no_like(){
        $.ajax({
          url: '../liked/no_like.php',
          type: 'POST',
          data:{id: "<?php echo($id);?> ", autor: "<?php echo($cook_id);?>"},
          success: function(data) {
            document.getElementById("like").textContent = "♥ Слідкувати";
            document.getElementById("like").setAttribute('onclick','like()');
            document.getElementById("like").setAttribute('class','btn btn-danger');
          }
        });
      }
      
    </script>

    <nav class="main-menu" style="padding-top: 60px;">
            <ul>
                <li class="has-subnav">
                    <a href="../">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/menu-rounded.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Головна сторінка
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="../category/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/product-documents.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Категорії
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="../new">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/plus-math.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Створити тему
                        </span>
                    </a>  
                </li>
                <li class="has-subnav">
                    <a href="../../service/support/">
                        <i class="fa fa-2x"><img src="https://img.icons8.com/fluent/48/000000/technical-support.png" width="25px" height="25px"></i>
                        <span class="nav-text">
                            Онлайн підтримка
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
              <?php
              
              if(strlen($cook_id) > 0){
                echo("
                  <li>
                      <a href='../../service/out.php'>
                            <i class='fa fa-2x'><img src='https://img.icons8.com/fluent/48/000000/import.png' width='25px' height='25px'></i>
                          <span class='nav-text'>
                              Вийти з системи
                          </span>
                      </a>
                  </li> 
                ");
              }else{
                echo("
                  <li>
                      <a href='../../login/'>
                            <i class='fa fa-2x'><img src='https://img.icons8.com/fluent/48/000000/enter-2.png' width='25px' height='25px'></i>
                          <span class='nav-text'>
                            Увійти до системи
                          </span>
                      </a>
                  </li> 
                ");
              }

              ?> 
            </ul>
        </nav>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <!-- Навигатор наверх -->
      <div class="prgoress_indicator">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
          <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
      </div>

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
      <script>
        function like(){
          $.ajax({
              url: 'like.php',
              type: 'POST',
              data:{id: "<?php echo($id);?> ", header: "<?php echo($main_mess['header']);?>", autor: "<?php echo($cook_id);?>"},
              success: function(data) {
                document.getElementById("like").textContent = "Не слідкувати 💔";
                document.getElementById("like").setAttribute('onclick','no_like()');
                document.getElementById("like").setAttribute('class','btn btn-warning');
              }
            });
          }

          function no_like(){
            $.ajax({
              url: '../liked/no_like.php',
              type: 'POST',
              data:{id: "<?php echo($id);?> ", autor: "<?php echo($cook_id);?>"},
              success: function(data) {
                document.getElementById("like").textContent = "♥ Слідкувати";
                document.getElementById("like").setAttribute('onclick','like()');
                document.getElementById("like").setAttribute('class','btn btn-danger');
              }
            });
          }
      </script>
      <script src="script.js" type="text/javascript"></script>

    <!-- Конец навигатора наверх -->
    <?php
        if(strlen($likes['id']) > 0){
          echo("
          <script>
            document.getElementById('like').textContent = 'Не слідкувати 💔';
            document.getElementById('like').setAttribute('onclick','no_like()');
            document.getElementById('like').setAttribute('class','btn btn-warning');
          </script>
          ");
        }else{
          echo("
          <script>
            document.getElementById('like').textContent = '♥ Слідкувати';
            document.getElementById('like').setAttribute('onclick','like()');
            document.getElementById('like').setAttribute('class','btn btn-danger');
          </script>
          ");
        }
    ?>
 </body>
</html>



<!-- 
/*
<?php             
if(strlen($cook_id) > 0){
  echo("");
}else{
  echo("");
}
?>
*/
-->