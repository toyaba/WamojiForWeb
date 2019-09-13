$(function() {
  $('.btn-forward').on('click', function(e) {
    e.preventDefault();

    var href = $(e.currentTarget).attr('href');

    // overlayの表示
    showLoadingOverlay();

    // AjaxでAPIを叩く
    $.ajax({
      type: 'POST',
      url: 'request4.php'
    })
    .done((data) => {
      // loading解除
      // ※どのみち画面遷移するので不要であれば削除していただいて大丈夫です
      $('#js-loadingOverlay').hide();

      // 次の画面へ遷移
      location.href = href;
    })
    .fail((data) => {
      // loading解除
      // ※どのみち画面遷移するので不要であれば削除していただいて大丈夫です
      $('#js-loadingOverlay').hide();

      // システムエラー画面へ遷移
      location.href = 'error.html';
    })
    .always((data) => {
    });
  });
});