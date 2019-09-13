$(function() {
  $('.drawer').drawer();

  var isSwitchType = $('#js-switchType').length;

  if(isSwitchType) {
    $('#js-switchType a').on('click', function(e) {
      e.preventDefault();

      if(!$(this).hasClass('current')) {
        $('#js-switchType').find('.current').removeClass('current');
        $(this).addClass('current');

        var _href = $(this).attr('href');
        var $_switchTarget = $(_href);

        $('#type-convert > *').removeClass('db');
        $('#type-convert > *').addClass('dn');

        $_switchTarget.removeClass('dn');
        $_switchTarget.addClass('db');

        $('#inputName').val($_switchTarget.find('.input-convert__text').val());
        $('#inputType').val($_switchTarget.find('.input-convert__type').val());
      }
    });
  }

  // $('.input-convert__text').on('keyup', function() {
  //   var text = $(this).val();
  //   if(text.length > 20) {
  //     text = text.substring(0, 20);
  //   }
  //   $('#inputName').val(text);
  //   $(".alert").removeClass("db");
  //   $(".alert").addClass("dn");
  // });
  $('.input-convert__text').bind({
      textchange: function() {
        var text = $(this).val();
        if(text.length > 20) {
          text = text.substring(0, 20);
        }
        $('#inputName').val(text);
        $(".alert").removeClass("db");
        $(".alert").addClass("dn");
      }
    }
  );
});

var showLoadingOverlay = function() {
  // 画面全体の高さを取得
  var h = $('html').outerHeight();

  // loading開始
  $('#js-loadingOverlay').css({height: h});
  $('#js-loadingOverlay').show();
};
