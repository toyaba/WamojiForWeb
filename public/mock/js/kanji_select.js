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
      url: 'request2.php',
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
      var _convert_data = data['convert_data'];
      var _hiragana = _convert_data['hiragana'];
      var _katakana = _convert_data['katakana'];
      var _kanji = _convert_data['kanji'];

      $('.result-hiragana__value strong').text(_hiragana);
      $('.result-katakana__value strong').text(_katakana);
      $('.result-kanji__value strong').text(_kanji);

      // 入力テキストの表示
      $('.result-input__value').text(inputText);

      // 漢字データ
      var _kanji_data = data['kanji_data'];
      var _len = Object.keys(_kanji_data).length;

      var _target = $('#js-selectKanjiList');
      _target.empty();

      for(var i = 0; i < _len; i++) {
        var $_kanjiWrapDom = $('<div>', {class: 'kanji-wrap'});
        var $_select = $('<select>', {class: 'input-reset select-kanji', name: 's_kanji' + i});

        var _kanji = _kanji_data[i];
        for(key in _kanji) {
          var $_option = $('<option>', {value: key}).text(key + '(' + _kanji[key] + ')');
          $_select.append($_option);
        }

        $_kanjiWrapDom.append($_select);
        _target.append($_kanjiWrapDom);
      }

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

  $(document).on('blur change', '.select-kanji', function(e) {
    var val = $(e.currentTarget).val();
    var kanjiIndex = $('.select-kanji').index(this);

    var $target = $('.result-kanji__value strong');
    var thisKanjiName = $target.text();
    var startText = thisKanjiName.slice(0, kanjiIndex);
    var endText = thisKanjiName.slice(kanjiIndex + 1);

    var combineText = startText + val + endText;

    $target.text(combineText);
    $('input[name="kanji"]').val(combineText);
  });
});