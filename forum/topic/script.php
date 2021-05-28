<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

      <script src="../../assets/js/censorship.js">// Проверка на цензуру</script>
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
      function send_supp(id, type){
        if(document.getElementById("text_support").value.length > 4){
            if(Censorship(document.getElementById("text_support").value)){
              $("#note_box").fadeOut(0);
              throw_message("Вибачте, але ваша скарга містить слова, які забороненно вживати в системі!");
          }else{
            var system_info = "Account_violator_id: " + id + " DATA: " + type;

            $.ajax({
              url: 'send_support.php',
              type: 'POST',
              data:{nofi: id, mess: document.getElementById("text_support").value, info: system_info, url: <?php echo("../../../..".$_SERVER['REQUEST_URI']); ?>},
              success: function(data) {
                throw_message("Скарга відправлена.");
                document.getElementById("close_support").click();
                document.getElementById("text_support").value = "";
              }
            });
          }
        }else{
          $("#note_box").fadeOut(0);
          throw_message("Вибачте, але ваша скарга дуже маленька, напишіть більше деталей.");
        }
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