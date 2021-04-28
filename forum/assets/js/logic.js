//Поиск авторизации

var coki = document.cookie;
var cooki = coki.split('; ');

for(i = 0; i <= cooki.length; i++){
    var search = cooki[i];
    var result = search.split('=');
    if(result[0] == "user"){
        login(result[1]);
    }
    /*
    var search1 = cooki[i];
    var result1 = search1.split('=');
    if(result1[0] == "balance"){
          balance(result[1]);
    }
    */
    var search1 = cooki[i];
    var result1 = search1.split('=');
    if(result1[0] == "avatar"){
        avatar_active(result[1]);
    }
}
function login(user){
    document.getElementById("user").textContent = user;
    logtrue = 1;
}

function avatar_active(userimage){
    document.getElementById("user_avatar").src = "../logic/users/avatar/" + userimage;
}

/*
function balance(bal){
  document.getElementById("balance").textContent = "Ваш баланс: " + bal / 100 + "$";
}
*/
let card = document.getElementsByClassName("card");

setTimeout(function(){ 
      for(var i =0; i<card.length; i++) {
   card[i].classList.remove("preShow")
}
},2000);

