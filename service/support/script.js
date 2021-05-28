  // ECT
  function throw_message(str) {
      $('#note_message').html(str);
      $("#note_box").fadeIn(500).delay(3000).fadeOut(500);
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