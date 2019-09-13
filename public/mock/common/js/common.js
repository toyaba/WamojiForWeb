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
      }
    });
  }
});

var showLoadingOverlay = function() {
  // 画面全体の高さを取得
  var h = $('html').outerHeight();

  // loading開始
  $('#js-loadingOverlay').css({height: h});
  $('#js-loadingOverlay').show();
};