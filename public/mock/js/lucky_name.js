$(function() {
  $('.btn-convert').on('click', function(e) {
    e.preventDefault();

    // 入力された文字を取得
    var inputText = $(this).parent().find('.input-convert__text').val();

    // 入力タイプを取得
    var inputType = $(this).parent().find('.input-convert__type').val();

    // 変換タイプを取得
    var convertType = $('.input-convert__type').val();

    // overlayの表示
    showLoadingOverlay();

    // AjaxでAPIを叩く
    $.ajax({
      type: 'POST',
      url: 'request.php',
      data: {
        'str': inputText,
        'inputType': inputType,
        'convertType': convertType
      },
      dataType: 'json'
    })
    .done((data) => {
      // loading解除
      $('#js-loadingOverlay').hide();

      // 和文字データ
      var _hiragana = data['hiragana'];
      var _katakana = data['katakana'];
      var _kanji = data['kanji'];

      $('.result-hiragana__value strong').text(_hiragana);
      $('.result-katakana__value strong').text(_katakana);
      $('.result-kanji__value strong').text(_kanji);

      // 入力テキストの表示
      $('.result-input__value').text(inputText);

      // 表示
      $('#js-result').fadeIn();

      var y = $('#js-result').position().top;

      $('html, body').animate({
        scrollTop: y
      }, {
        duration: 1500
      });
    })
    .fail((data) => {
      // loading解除
      $('#js-loadingOverlay').hide();

      // エラー処理
    })
    .always((data) => {
    });

  });
});