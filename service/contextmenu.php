<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
  <div class="menu">
    <ul class="menu-list">
      <li class="menu-item"><button class="menu-button" onclick="document.execCommand('copy')"><img src="https://img.icons8.com/color/48/000000/copy-2.png" style="width: 20px; height: 20px;"/>&nbsp;&nbsp;Копіювати</button></li>
      <li class="menu-item"><button class="menu-button" onclick="window.history.back()"><img src="https://img.icons8.com/fluent/48/000000/back.png" style="width: 20px; height: 20px;"/>&nbsp;&nbsp;Повернутися назад</button></li>
    </ul>
    <ul class="menu-list">
      <li class="menu-item"><button class="menu-button sheare" class=""><img src="https://img.icons8.com/color/48/000000/link.png" style="width: 20px; height: 22px;"/>&nbsp;&nbsp;Поділитися</button></li>
    </ul>
    <ul class="menu-list">
      <li class="menu-item"><button class="menu-button menu-button--delete" onclick="document.location.href = '/../../../../../../../../../../../';">Головна сторінка</button></li>
    </ul>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">

  <div class="shearepop">
    <header>
      <span>Поділитися посиланням</span>
      <div class="close"><i class="uil uil-times"></i></div>
    </header>
    <div class="content">
      <p>Поділіться цим посиланням через</p>
      <ul class="icons">
        <?php
          $share_text;
        ?>
        <a href="#" onclick="window.open('https:/' + '/www.facebook.com/sharer.php?src=Рекомендую подивитись! Лінк: &u=<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . ':/'.'/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>' ,'_blank');"><i class="fab fa-facebook-f"></i></a>
        <a href="#" onclick="window.open('https:/' + '/twitter.com/intent/tweet?url=<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . ':/'.'/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=Рекомендую подивитись! Лінк:', '_blank');"><i class="fab fa-twitter"></i></a>
        <a href="#" onclick="window.open('https:/' + '/vk.com/share.php?url=<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . ':/'.'/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>', '_blank');"><i class="fab fa-vk"></i></a>
        <a href="#" onclick="window.open('https:/' + '/connect.ok.ru/offer?url=<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . ':/'.'/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&title=Рекомендую подивитись! ', '_blank');"><i class="fab fa-odnoklassniki"></i></a>
        <a href="#" onclick="window.open('https:/' + '/t.me/share/url?url=<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . ':/'.'/' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=Рекомендую подивитись!', '_blank');"><i class="fab fa-telegram-plane"></i></a>
      </ul>
      <p>Або скопіюйте посилання</p>
      <div class="field">
        <i class="url-icon uil uil-link"></i>
        <input style="font-family: Unecoin;" type="url" readonly value="<?php echo(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
        <button style="font-family: Unecoin;">Копіювати</button>
      </div>
    </div>
  </div>

  <script>
    const viewBtn = document.querySelector(".sheare"),
    shearepop = document.querySelector(".shearepop"),
    close = shearepop.querySelector(".close"),
    field = shearepop.querySelector(".field"),
    input = field.querySelector("input"),
    copy = field.querySelector("button");

    viewBtn.onclick = ()=>{
      shearepop.classList.toggle("show");
    }
    close.onclick = ()=>{
      viewBtn.click();
    }

    copy.onclick = ()=>{
      input.select(); //select input value
      if(document.execCommand("copy")){ //if the selected text copy
        field.classList.add("active");
        copy.innerText = "Скопійовано";
        setTimeout(()=>{
          window.getSelection().removeAllRanges(); //remove selection from document
          field.classList.remove("active");
          copy.innerText = "Копіювати";
        }, 3000);
      }
    }
  </script>

  <style>
    *,
    *:after,
    *:before {
      box-sizing: border-box;
    }
    :root {
      --color-bg-primary: #d0d6df;
      --color-bg-primary-offset: #f1f3f7;
      --color-bg-secondary: #fff;
      --color-text-primary: #3a3c42;
      --color-text-primary-offset: #898c94;
      --color-orange: #dc9960;
      --color-green: #1eb8b1;
      --color-purple: #657cc4;
      --color-black: var(--color-text-primary);
      --color-red: #d92027;
    }
    .menu {
      flex-direction: column;
      background-color: var(--color-bg-secondary);
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(64, 64, 64, 0.15);
      width: 250px;
      display: none;
      position: absolute;
      margin: 0;
      padding: 0;
      background: #FFFFFF;
      border-radius: 5px;
      list-style: none;
      overflow: hidden;
      z-index: 999999;
    }

    .menu-list {
      margin: 0;
      display: block;
      width: 100%;
      padding: 8px;
    }
    .menu-list + .menu-list {
      border-top: 1px solid #ddd;
    }

    .menu-sub-list {
      display: none;
      padding: 8px;
      background-color: var(--color-bg-secondary);
      border-radius: 10px;
      box-shadow: 0 10px 20px rgba(64, 64, 64, 0.15);
      position: absolute;
      left: 100%;
      right: 0;
      z-index: 100;
      width: 100%;
      top: 0;
      flex-direction: column;
    }
    .menu-sub-list:hover {
      display: flex;
    }

    .menu-item {
      position: relative;
    }

    .menu-button {
      font: inherit;
      border: 0;
      padding: 8px 8px;
      padding-right: 36px;
      width: 100%;
      border-radius: 8px;
      display: flex;
      align-items: center;
      position: relative;
      background-color: var(--color-bg-secondary);
      color: black;
    }
    .menu-button:hover {
      background-color: var(--color-bg-primary-offset);
    }
    .menu-button:hover + .menu-sub-list {
      display: flex;
    }
    .menu-button:hover svg {
      stroke: var(--color-text-primary);
    }
    .menu-button svg {
      width: 20px;
      height: 20px;
      margin-right: 10px;
      stroke: var(--color-text-primary-offset);
    }
    .menu-button svg:nth-of-type(2) {
      margin-right: 0;
      position: absolute;
      right: 8px;
    }
    .menu-button--delete:hover {
      color: var(--color-red);
    }
    .menu-button--delete:hover svg:first-of-type {
      stroke: var(--color-red);
    }
    .menu-button--orange svg:first-of-type {
      stroke: var(--color-orange);
    }
    .menu-button--green svg:first-of-type {
      stroke: var(--color-green);
    }
    .menu-button--purple svg:first-of-type {
      stroke: var(--color-purple);
    }
    .menu-button--black svg:first-of-type {
      stroke: var(--color-black);
    }
    .menu-button--checked svg:nth-of-type(2) {
      stroke: var(--color-purple);
    }

    ::selection{
      color: #fff;
      background: #7d2ae8;
    }
    .shearepop{
      position: fixed;
      left: 50%;
      z-index: 99999999;
    }
    button{
      outline: none;
      cursor: pointer;
      font-weight: 500;
      border-radius: 4px;
      border: 2px solid transparent;
      transition: background 0.1s linear, border-color 0.1s linear, color 0.1s linear;
    }
    .shearepop{
      background: #fff;
      padding: 25px;
      border-radius: 15px;
      top: -150%;
      max-width: 380px;
      width: 100%;
      opacity: 0;
      pointer-events: none;
      box-shadow: 0px 10px 15px rgba(0,0,0,0.1);
      transform: translate(-50%, -50%) scale(1.2);
      transition: top 0s 0.2s ease-in-out, opacity 0.2s 0s ease-in-out, transform 0.2s 0s ease-in-out;
    }
    .shearepop.show{
      top: 50%;
      opacity: 1;
      pointer-events: auto;
      transform:translate(-50%, -50%) scale(1);
      transition: top 0s 0s ease-in-out, opacity 0.2s 0s ease-in-out, transform 0.2s 0s ease-in-out;
    }
    .shearepop :is(header, .icons, .field){
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .shearepop header{
      padding-bottom: 15px;
      border-bottom: 1px solid #ebedf9;
    }
    header span{
      font-size: 21px;
      font-weight: 600;
    }
    header .close, .icons a{
      display: flex;
      align-items: center;
      border-radius: 50%;
      justify-content: center;
      transition: all 0.3s ease-in-out;
    }
    header .close{
      color: #878787;
      font-size: 17px;
      background: #f2f3fb;
      height: 33px;
      width: 33px;
      cursor: pointer;
    }
    header .close:hover{
      background: #ebedf9;
    }
    .shearepop .content{
      margin: 20px 0;
    }
    .shearepop .icons{
      margin: 15px 0 20px 0;
    }
    .content p{
      font-size: 16px;
    }
    .content .icons a{
      height: 50px;
      width: 50px;
      font-size: 20px;
      text-decoration: none;
      border: 1px solid transparent;
    }
    .icons a i{
      transition: transform 0.3s ease-in-out;
    }
    .icons a:nth-child(1){
      color: #1877F2;
      border-color: #b7d4fb;
    }
    .icons a:nth-child(1):hover{
      background: #1877F2;
    }
    .icons a:nth-child(2){
      color: #46C1F6;
      border-color: #b6e7fc;
    }
    .icons a:nth-child(2):hover{
      background: #46C1F6;
    }
    .icons a:nth-child(3){
      color: #e1306c;
      border-color: #f5bccf;
    }
    .icons a:nth-child(3):hover{
      background: #e1306c;
    }
    .icons a:nth-child(4){
      color: #25D366;
      border-color: #bef4d2;
    }
    .icons a:nth-child(4):hover{
      background: #25D366;
    }
    .icons a:nth-child(5){
      color: #0088cc;
      border-color: #b3e6ff;
    }
    .icons a:nth-child(5):hover{
      background: #0088cc;
    }
    .icons a:hover{
      color: #fff;
      border-color: transparent;
    }
    .icons a:hover i{
      transform: scale(1.2);
    }
    .content .field{
      margin: 12px 0 -5px 0;
      height: 45px;
      border-radius: 4px;
      padding: 0 5px;
      border: 1px solid #e1e1e1;
    }
    .field.active{
      border-color: #7d2ae8;
    }
    .field i{
      width: 50px;
      font-size: 18px;
      text-align: center;
    }
    .field.active i{
      color: #7d2ae8;
    }
    .field input{
      width: 100%;
      height: 100%;
      border: none;
      outline: none;
      font-size: 15px;
    }
    .field button{
      color: #fff;
      padding: 5px 18px;
      background: #7d2ae8;
    }
    .field button:hover{
      background: #8d39fa;
    }

  </style>
  <script>
    $(document).ready(function(){
    //Show contextmenu:
    $(document).contextmenu(function(e){
      //Get window size:
      var winWidth = $(document).width();
      var winHeight = $(document).height();
      //Get pointer position:
      var posX = e.pageX;
      var posY = e.pageY;
      //Get contextmenu size:
      var menuWidth = $(".menu").width();
      var menuHeight = $(".menu").height();
      //Security margin:
      var secMargin = 10;
      //Prevent page overflow:
      if(posX + menuWidth + secMargin >= winWidth
      && posY + menuHeight + secMargin >= winHeight){
        //Case 1: right-bottom overflow:
        posLeft = posX - menuWidth - secMargin + "px";
        posTop = posY - menuHeight - secMargin + "px";
      }
      else if(posX + menuWidth + secMargin >= winWidth){
        //Case 2: right overflow:
        posLeft = posX - menuWidth - secMargin + "px";
        posTop = posY + secMargin + "px";
      }
      else if(posY + menuHeight + secMargin >= winHeight){
        //Case 3: bottom overflow:
        posLeft = posX + secMargin + "px";
        posTop = posY - menuHeight - secMargin + "px";
      }
      else {
        //Case 4: default values:
        posLeft = posX + secMargin + "px";
        posTop = posY + secMargin + "px";
      };
      //Display contextmenu:
      $(".menu").css({
        "left": posLeft,
        "top": posTop
      }).show();
      //Prevent browser default contextmenu.
      return false;
    });
    //Hide contextmenu:
    $(document).click(function(){
      $(".menu").hide();
    });
  });
  </script>