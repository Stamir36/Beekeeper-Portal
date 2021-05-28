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

    var progressPath = document.querySelector('.prgoress_indicator path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    }
                  updateProgress();
                  $(window).on('scroll', updateProgress);
                  var offset = 250;
                  var duration = 550;
                  jQuery(window).on('scroll', function () {
                    if (jQuery(this).scrollTop() > offset) {
                      jQuery('.prgoress_indicator').addClass('active-progress');
                    } else {
                      jQuery('.prgoress_indicator').removeClass('active-progress');
                    }
                  });
                  jQuery('.prgoress_indicator').on('click', function (event) {
                    event.preventDefault();
                    jQuery('html, body').animate({ scrollTop: 0 }, duration);
                    return false;
                  });

                  function setModalMaxHeight(element) {
                    this.$element     = $(element);  
                    this.$content     = this.$element.find('.modal-content');
                    var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
                    var dialogMargin  = $(window).width() < 768 ? 20 : 60;
                    var contentHeight = $(window).height() - (dialogMargin + borderWidth);
                    var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
                    var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
                    var maxHeight     = contentHeight - (headerHeight + footerHeight);
                  
                    this.$content.css({
                        'overflow': 'hidden'
                    });
                    
                    this.$element
                      .find('.modal-body').css({
                        'max-height': maxHeight,
                        'overflow-y': 'auto'
                      });
                  }
                  
                  $('.modal').on('show.bs.modal', function() {
                    $(this).show(); 
                    setModalMaxHeight(this);
                  });
                  
                  $(window).resize(function() {
                    if ($('.modal.in').length == 1) {
                      setModalMaxHeight($('.modal.in'));
                    }
                  });
                  
                  /* CodeMirror */
                  $('.code').each(function() {
                    var $this = $(this),
                        $code = $this.text(),
                        $mode = $this.data('language');
                  
                    $this.empty();
                    $this.addClass('cm-s-bootstrap');
                    CodeMirror.runMode($code, $mode, this);
                  });